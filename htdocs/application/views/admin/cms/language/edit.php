	<form name="adminlanguage_form" id="adminlanguage_form" method="post"><br />
	<fieldset class="formshop ui-corner-all">
		<legend class="ui-corner-all">&nbsp;&nbsp;<b><?= lang('language.name');?></b>&nbsp;&nbsp;</legend>
		<div class="fila">
			<div class="col" style="width:70px"></div>
			<div class="col" style="width:120px"><?= lang('language.short');?><span class="fieldreq">*</span></div>
			<div class="col" style="width:580px"><input type="text" maxlength="2" id="txt_adminshortd" class="textbox" value="<?php if(isset($language)) echo $language->short;?>" style="width:50px" validate="required:true" disabled="disabled" /></div>
			<input type="hidden" name="language[short]" id="txt_adminshort" class="textbox" value="<?php if(isset($language)) echo $language->short;?>" style="width:50px" />
		</div>
		
<?/*		<div class="fila">
			<div class="col" style="width:70px"></div>
			<div class="col" style="width:120px"><?= lang('language.name');?><span class="fieldreq">*</span></div>
			<div class="col" style="width:580px"><input type="text" name="language[name]" id="txt_adminname" class="textbox" validate="required:true" value="<?php if(isset($language)) echo $language->name;?>" style="width:400px" /></div>
		</div>
*/?>
		<div class="fila">
			<div class="col" style="width:70px"></div>
			<div class="col" style="width:120px"><?= lang('language.name');?>:<span class="fieldreq">*</span></div>
			<div class="col" style="width:580px">
				<select name="language[name]" id="cb_languagename" style="width:400px" onChange="changeLanguage(this.value)" validate="required:true">
				<option value=''><?= lang('language.selectlanguage');?></option>
				<?php
				foreach ($languages_iso->result() as $language_iso)
				{
					if(isset($language))
					{
						if($language->name == $language_iso->nameen) echo "<option value='".$language_iso->nameen."' selected='selected'>".$language_iso->nameen." - ".$language_iso->short."</option><br />\n";
						else echo "<option value='".$language_iso->nameen."'>".$language_iso->nameen." - ".$language_iso->short."</option><br />\n";
					}
					else echo "<option value='".$language_iso->nameen."'>".$language_iso->nameen." - ".$language_iso->short."</option><br />\n";
				}
				?>
				</select>
			</div>
		</div>
	</fieldset>
	<div class="fila">    
		<div class="col" style="width:100%;padding-top:20px;"><?php if(isset($language)) echo "<input type='hidden' name='language[id]' value='".$language->id."' />";?>
		<center>
			<?/*<input value="<?= lang('shop.save');?>" type="submit" />*/?>
			<input onclick="saveformlanguage()" value="<?= lang('shop.save');?>" type="button" />&nbsp;&nbsp;
			<input onclick="closeformlanguage()" value="<?= lang('shop.cancel');?>" type="button" />
		</center>
		</div>
	</div>
	</form>
<script type="text/javascript">
var datosshort = new Array(300);
var datosname = new Array(300);
<?php
$i = 0;
foreach ($languages_iso->result() as $language_iso)
{
?>
	datosshort[<?=$i?>] = "<?=$language_iso->short?>";
	datosname[<?=$i?>] = "<?=$language_iso->nameen?>";
<?	$i++;
}
?>

$(document).ready(function()
{	
	$.metadata.setType("attr", "validate");

	$( "input:submit").button();
	$( "input:button").button();
	
	$( "#dialog:ui-dialog" ).dialog( "destroy" );
	
	$("#adminlanguage_form").validate();
	
});

	function saveformlanguage()
	{
		$('#adminlanguage_form').submit();
	}
	
	$('#adminlanguage_form').submit(function() 
	{
		if(!$('#adminlanguage_form').valid())
		{
			return false;
		}
	
		$.ajax({
			type: "post",
			url: "<?=base_url()?>admin/language/ajaxsave" ,
			dataType: "json",
			data: $('#adminlanguage_form').serialize(),
			success: function(data) {
				if(data.success)
				{
					$().toastmessage('showToast', {
						text     : '<?= lang('shop.saved');?>',
						no_sticky   : true,
						position : 'middle-center',
						type     : 'success',
						closeText: ''
					});
				}
			}
		}); 
		oAdminTableLanguage.fnDraw();
		
		$('#dialog_cmseditadmin').dialog('close');
		//$('#id-tab-2').click();
		return false;		
	});	
	
	function closeformlanguage()
	{
		$('#dialog_cmseditadmin').dialog('close');
	}

	function findLanguage(name)
	{
		var i = 0;
		while((datosname[i] != name)&&(i < 300)){
			i++;
		}
		return i;
	}
	function changeLanguage(idname){
		// changing datas name, currency
		//countries_iso = jQuery.parseJSON(countries_iso);
		if(idname != '')
		{
			var i = findLanguage(idname);
			document.getElementById("txt_adminshort").value = datosshort[i];
			document.getElementById("txt_adminshortd").value = datosshort[i];
			document.getElementsByName("language[short]").value = datosshort[i];

		}else{
			document.getElementById("txt_adminshort").value = '';
			document.getElementById("txt_adminshortd").value = '';
			document.getElementsByName("language[short]").value = '';
		}
	}

</script>