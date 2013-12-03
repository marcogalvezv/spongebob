<script type="text/javascript">
	var listLanguages = new Array(500);
	
	<? for($i=0; $i<sizeof($language);$i++){?>
		listLanguages[<?=$language[$i]->id?>] = "<?=$language[$i]->short?>";
	<?}?>
</script>
<form name="adminpages_form" id="adminpages_form" method="post">
	<div align="center">
	  <div id="pagesleft" class="formdialog100per">
		<div id="pagesheader" class="form100per formtext">
			<fieldset class="ui-corner-all">
				<legend><b><?= lang('admin.pages');?></b></legend>
				<div class="fila">
					<div class="col" style="width:100px"><?=lang('pages.title');?>:<span class="fieldreq">*</span></div>
					<?/*<input type="hidden" name="pages[title]" id="txt_pagestitle" value="<?php if(isset($pages)) echo $pages->title ?>" validate="required:true" />*/?>
					<div class="col" style="width:200px">
						<input type="text" name="pages[title]" id="txt_pagestitle" value="<?php if(isset($pages)) echo $pages->title ?>" validate="required:true" onKeyUp="setUriTitle(this.value)"/>
					</div>
				</div>

				<div class="fila">
					
					<div class="col" style="width:100px"><?=lang('pages.uri');?>:<span class="fieldreq">*</span></div>
					<div class="col" style="width:120px; margin-right: 20px;">
						<input type="text" name="uri[default]" id="txt_uridefault" disabled="disabled" value="<?php if(isset($uri_default)) echo $uri_default ?>" validate="required:true" />
					</div>
					<div class="col" style="width:200px; margin-right: 20px;">
						<input type="text" name="pages[uri]" id="txt_pagesuri" value="<?php if(isset($pages)) echo $pages->uri ?>" validate="required:true" />
					</div>
					<div class="col" style="width:50px">
						<input type="text" name="uri[language]" id="txt_urilanguage" disabled="disabled" value="<?php if(isset($uri_language)) echo $uri_language ?>" validate="required:true" />
					</div>
				</div>
				
				<div class="fila">
					<div class="col" style="width:100px"><?= lang('language.name');?>:</div>
					<div class="col" style="width:580px" class="textbox" align="left">
					<select name="pages[idlan]" id="cb_language" style="width:200px" onChange="setLanguageUri(this.value)">
					<?php 
					for($i=0; $i<sizeof($language);$i++)
					{
						if(isset($pages))
						{	
							if($pages->idlan == $language[$i]->id)
								echo "<option value='".$language[$i]->id."' selected='selected'>".$language[$i]->short." - ".$language[$i]->name."</option><br />\n";
							else echo "<option value='".$language[$i]->id."'>".$language[$i]->short." - ".$language[$i]->name."</option><br />\n";
						}
						else echo "<option value='".$language[$i]->id."'>".$language[$i]->short." - ".$language[$i]->name."</option><br />\n";
						
					}
					?>
					</select>
					</div>
				</div>
			</fieldset>
		</div>
		
		<div id="pageslongdesc" class="form100per">
			<fieldset class="ui-corner-all">
				<legend><b><?=lang('pages.content');?></b></legend>
				<div class="fila">
					<textarea id="ckeditorpagescontent_" class="ckeditorpagescontent1" name="pages[content]" cols="100" rows="22"><?php if(isset($pages)) echo $pages->content ?></textarea>
				</div>

			</fieldset>
		</div>

		<div class="fila" align="left">
		<div class="col" style="width:100%; text-align:center;" align="center">
			<?php if(isset($pages)) echo "<input type='hidden' name='pages[id]' value='".$pages->id."' />";?>
			<?php if(isset($pages)) echo "<input type='hidden' name='pages[status]' value='".$pages->status."' />";?>
			<input onclick="saveformpages()" value="<?= lang('shop.save');?>" type="button" />&nbsp;&nbsp;
			<input onclick="closeformpages()" value="<?= lang('shop.cancel');?>" type="button" />
		</div>
		</div>
		
	  </div><!--/formDialog60per-->
</div><!--/center-->
</form>
	

<script type="text/javascript">
	$(document).ready(function()
	{
		$("#adminpages_form").validate();
	});
	
	//FUNCTIONS OUTSIDE THE DOCUMENT.READY	
	
	function saveformpages()
	{
		$('#adminpages_form').submit();
	}

	$('#adminpages_form').submit(function() 
	{
		if(!$('#adminpages_form').valid())
		{
			return false;
		}

		$.ajax({
			type: "post",
			url: "<?=base_url()?>admin/pages/checkuri" ,
			dataType: "json",
			data: $('#adminpages_form').serialize(),
			async: false,
			success: function(data) {
				if(!data.success)
				{
					$.ajax({
						type: "post",
						url: "<?=base_url()?>admin/pages/ajaxsave" ,
						dataType: "json",
						data: $('#adminpages_form').serialize(),
						async: false,
						success: function(data) {
							if(data.success)
							{
								$().toastmessage('showToast', {
									text     : '<?= lang('shop.saved');?>',
									no_sticky : true,
									position : 'middle-center',
									type     : 'success',
									closeText: ''
								});
					
								$('#dialog_cmspagesedit').dialog('close');
								//[by carlos] THIS CODE MAKES THE DATATABLE TO RELOAD TWICE !!!!
								//$('#id-tab-1').click();
								oAdminTablePages.fnDraw();
							}				
						}
					});
				}else{
					alert('This URI exist on de Data Base.');
				}
			}
			}); 
			return false;		
	});	
	
	function closeformpages()
	{	
		$('#dialog_cmspagesedit').dialog('close');
	}

	$("input:button").button();	

	function setLanguageUri(idLanguage){
		document.getElementById("txt_urilanguage").value = '/'+listLanguages[idLanguage];
		document.getElementsByName('uri[language]').value = '/'+listLanguages[idLanguage];
	}
	
	function setUriTitle(chrText){
		document.getElementById("txt_pagesuri").value = chrText.replace(/ /g, "_");
		document.getElementsByName('pages[uri]').value = chrText.replace(/ /g, "_");
	}

	function checkExist(uri){
		$.ajax({
				type: "get",
				url: "<?=base_url()?>admin/pages/checkuri/"+uri ,
				async : false,
				success: function(data) {
				}
			});
	};

</script>
