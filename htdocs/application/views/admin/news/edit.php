<form name="news-form" id="news-form" method="post">
	<?/*if(isset($news)){?> 
		<h2><b><?= lang('news.editnews');?></b> <?php if(isset($news)) echo $news->title; ?></h2>
	<?}*/?>
	<div align="center">
	  <div id="newsleft" class="formdialog80per">
		<div id="newsheader" class="form100per formtext">
			<fieldset class="ui-corner-all">
				<legend><b><?= lang('news.legend');?></b></legend>

				<div class="fila">
					<div class="col" style="width:15%"><?=lang('news.title');?><span class="fieldreq">*</span></div>
					<div class="col" style="width:85%">
						<input type="text" name="news[title]" id="txt_newstitle" value="<?php if(isset($news->title)) echo $news->title ?>" validate="required:true" />
					</div>
				</div>

				<div class="fila">
					<div class="col" style="width:15%"><?=lang('news.date');?><span class="fieldreq">*</span></div>
					<div class="col" style="width:85%">
						<input type="text" name="news[date_time]" id="txt_newsdate" style="width:200px" validate="required:true" value="<?php if(isset($news->date_time)){if($news->date_time != "0000-00-00") echo $news->date_time;} else { echo date('Y-m-d H:i'); }?>" />
					</div>
				</div>

				<div class="fila">
					<div class="col" style="width:15%"><?=lang('news.author');?><span class="fieldreq">*</span></div>
					<div class="col" style="width:85%">
						<input type="text" name="news[author]" id="txt_newsauthor"  style="width:200px" value="<?php if(isset($news->author)) echo $news->author ?>" validate="required:true" />
					</div>
				</div>
				
				<div class="fila">
					<div class="col" style="width:15%"></div>
					<div class="col" style="width:85%">
						<input type="checkbox" name="news[published]" id="txt_newspublish" value="1" <?php if(isset($news->published) && $news->published == 1) {echo "checked='true'";} ?> />
						<label for="txt_newspublish"><?=lang('news.published');?></label>
					</div>
				</div>
			</fieldset>
		</div>
		
		<div id="newslongdesc" class="form100per">
			<fieldset class="ui-corner-all">
				<legend><b><?=lang('news.content');?></b></legend>
				<div class="fila">
					<textarea id="ckeditornewscontent_" class="ckeditorlongdesc1" name="news[content]" cols="80" rows="5"><?php if(isset($news->content)) echo $news->content ?></textarea>
				</div>

			</fieldset>
		</div>

		<div class="fila" align="left">
			<div class="col" style="width:100%; text-align:center;" align="center">
				<input onclick="saveformEditnews()" value="<?= lang('news.butsave');?>" type="button" />&nbsp;&nbsp;
				<input onclick="closeformEditnews()" value="<?= lang('news.butcancel');?>" type="button" />
			</div>
		</div>
		
		</div><!--/formDialog60per-->
		<?php if(isset($news->id)) echo "<input type='hidden' name='news[id]' value='".$news->id."' />"; ?>

	</div><!--/center-->
</form>
	

<script type="text/javascript">

	$(document).ready(function()
	{	

		$.metadata.setType("attr", "validate");		
		$.validator.addMethod("checkDate", function(value, element) {
			var status = false;
			var value = $("#txt_newsdate").val();
			//alert(value);
			if(value == "") return true;
			status = isDate(value);

			//if(status && $("#bannerid").length == 0) ==> THIS WAS THE ERROR - THIS WAS EVALUATING ONLY ON THE ADD BANNER OPERATION  
			//CARLOS FIX: IF VALID DATE THEN REVIEW VALUE >= CURRENT DATE
			if(status)
			{
			  var dateEntered = value.split('-');
			  var eyear = dateEntered[0];
			  var emonth = dateEntered[1];
			  if(emonth < 10 && emonth.length == 1) emonth = "0"+emonth;
			  var eday = dateEntered[2];
			  if(eday < 10 && eday.length == 1) eday = "0"+eday;
			  //var sdate = Date.parse(eyear+"-"+emonth+"-"+eday);
			  var sdate = parseDate(eyear+"-"+emonth+"-"+eday);
			  var cminMonth = minMonth;
			  var cminday = minday;
			  if(minMonth < 10) cminMonth = "0"+minMonth;
			  if(minday < 10) cminday = "0"+minday;
			  //var cdate = Date.parse(minYear+"-"+cminMonth+"-"+cminday);
			  var cdate = parseDate(minYear+"-"+cminMonth+"-"+cminday);
			  if(sdate < cdate) return false;
			}
			return status;
		}, '<?= lang('news.validDate')?>');

		$("#news-form").validate();
		
		
		//$("#txt_newsdate").datepicker({dateFormat: 'yy-mm-dd', onSelect: function() { $(".ui-datepicker a").removeAttr("href"); }});
		$('#txt_newsdate').datetimepicker({
			showButtonPanel: false,
			dateFormat: 'yy-mm-dd'
		});

	});
	
	function saveformEditnews()
	{
		$('#news-form').submit();
	}

	$('#news-form').submit(function() 
	{
		if(!$('#news-form').valid())
		{
			return false;
		}
		
		$.ajax({
			type: "post",
			url: "<?=base_url()?>admin/site/ajaxnewssave" ,
			dataType: "json",
			data: $('#news-form').serialize(),
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
					
					$('#dialog_newsedit').dialog('close');
					oAdminTableNews.fnDraw();
				}				
			}
		}); 
		return false;		
	});	
	
	function closeformEditnews()
	{	
		$('#dialog_newsedit').dialog('close');
	}

	$("input:button").button();

</script>
