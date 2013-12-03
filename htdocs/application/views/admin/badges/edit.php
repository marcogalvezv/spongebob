<form name="adminBadgeEdit-form" id="adminBadgeEdit-form" method="post"><br />
<fieldset class="formshop ui-corner-all">
    <legend class="ui-corner-all">&nbsp;&nbsp;<b><?= lang('badges.editdialog.legend');?></b>&nbsp;&nbsp;</legend>
    <div class="fila">
        <div class="col" style="width:70px"></div>
        <div class="col" style="width:120px"><?= lang('badges.editdialog.code');?><span class="fieldreq">*</span></div>
        <div class="col" style="width:580px"><input type="text" name="badge[cod]" id="txt_adminbadgecod" class="textbox" validate="required:true" value="<?php if(isset($badge)) echo $badge->cod; else '';?>" style="width:150px" /></div>
    </div>
    <div class="fila">
        <div class="col" style="width:70px"></div>
        <div class="col" style="width:120px"><?= lang('badges.editdialog.name');?><span class="fieldreq">*</span></div>
        <div class="col" style="width:580px"><input type="text" name="badge[name]" id="txt_adminbadgename" class="textbox" validate="required:true" value="<?php if(isset($badge)) echo $badge->name; else '';?>" style="width:400px" /></div>
    </div>
    <div class="fila">
        <div class="col" style="width:70px"></div>
        <div class="col" style="width:120px"><?= lang('badges.tab.message');?><span class="fieldreq">*</span></div>
        <div class="col" style="width:580px"><input type="text" name="badge[message]" id="txt_adminbadgemessage" class="textbox" validate="required:true" value="<?php if(isset($badge)) echo $badge->message; else '';?>" style="width:500px" /></div>
    </div>
    <div class="fila">
        <div class="col" style="width:70px"></div>
        <div class="col" style="width:120px"><?= lang('badges.tab.question');?><span class="fieldreq">*</span></div>
        <div class="col" style="width:580px"><input type="text" name="badge[question]" id="txt_adminbadgequestion" class="textbox" validate="required:true" value="<?php if(isset($badge)) echo $badge->question; else '';?>" style="width:500px" /></div>
    </div>
    <div class="fila">
        <div class="col" style="width:70px"></div>
        <div class="col" style="width:120px"><?= lang('badges.editdialog.image');?></div>
        <div class="col" style="width:300px" align="left">
			<div id="filelistbadgeimage"></div>
			<input id="badgepickfiles_" onclick="javascript:;" value="<?= lang('dialog.selectfile');?>" type="button" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?/*<a id="badgepickfiles_" href="javascript:;">[Select files]</a> */?>
			<input id="badgeuploadfiles" onclick="javascript:;" value="<?= lang('dialog.uploadfile');?>" type="button" />
			<?/*<a id="badgeuploadfiles" href="javascript:;">[Upload files]</a>*/?>
			<input type="hidden" name="badge[filename]" id="bagdeadmin" value="<?php if(isset($badge)) echo $badge->filename; else '';?>" />
        </div>
        <div class="col" style="width:100px">
			<div id="imgContentsBadgeAdmin" align="center"><?php if(isset($badge->filename)) echo "<img src='".$badge->filename."' border='0' /><br /><a href='javascript:void(0);' id='deleteThumbsBadgeAdmin' title='".lang('dialog.delete')."'>(".lang('dialog.delete').")</a>";?></div>
        </div>
    </div>
</fieldset>
<div class="fila">    
    <div class="col" style="width:100%;">
    <center>
		<?php
		if(isset($badge)) echo "<input type='hidden' name='badge[id]' value='".$badge->id."' />";
		/*if(isset($badge)) echo "<input type='hidden' name='badge[rating]' value='1' />";*/
		?>
		<input onclick="saveformbadge()" value="<?= lang('dialog.save');?>" type="button" />&nbsp;&nbsp;
		<input onclick="closeformbadge()" value="<?= lang('dialog.cancel');?>" type="button" />
	</center>
    </div>
</div>
</form>

<script type="text/javascript">
//PLUPLOAD
var pluploader = new plupload.Uploader({
	runtimes : 'silverlight,gears,html5,flash,silverlight,browserplus',
	browse_button : 'badgepickfiles_',
	max_file_size : '10mb',
	url : '<?=base_url()?>plupload/uploadbadge.php',
	resize : {width : 80, height : 60, quality : 90},
	flash_swf_url : '<?=base_url()?>plupload/js/plupload.flash.swf',
	silverlight_xap_url : '<?=base_url()?>plupload/js/plupload.silverlight.xap',
	filters : [
		{title : "Image files", extensions : "jpg,gif,png"},
		{title : "Zip files", extensions : "zip"}
	]
});

pluploader.bind('FilesAdded', function(up, files) {
	for (var i in files) {
		document.getElementById("filelistbadgeimage").innerHTML = '<div id="' + files[i].id + '">' + files[i].name + ' (' + plupload.formatSize(files[i].size) + ') <b></b></div>';
	}
});

pluploader.bind('UploadProgress', function(up, file) {
	document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
});

pluploader.bind('FileUploaded', function(up, file, objresponse) {
		var path = "<?=base_url()?>";
		var newinput = "<img src='"+path+"temp/badge/"+file.name+"' alt='"+file.name+"' />"+"<a href='javascript:void(0);' id='deleteThumbsBadgeAdmin' title='<?=lang('dialog.delete')?>'>(<?=lang('dialog.delete')?>)</a>";
		document.getElementById("imgContentsBadgeAdmin").innerHTML = newinput;
		document.getElementById("bagdeadmin").value = "/temp/badge/"+file.name;
		document.getElementsByName('badge[filename]').value = "/temp/badge/"+file.name;
});
	
document.getElementById("badgeuploadfiles").onclick = function() {
	pluploader.start();
	return false;
};

pluploader.init();

function deleteThumbImageShop()
{
	if($("#bagdeadmin").val() != "")
	{
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/badges/deletethumb" ,
				dataType: "html",
				data: {image : $("#bagdeadmin").val(), rnd: new Date().getTime()},
				success: function(data) {}
		   });
	}
	
	$("#bagdeadmin").val("");
	$("#imgContentsBadgeAdmin").html("");
}

$(document).ready(function()
{	
	$.metadata.setType("attr", "validate");

	$( "input:submit").button();
	$( "input:button").button();
	$( "#dialog:ui-dialog" ).dialog( "destroy" );
	$("#adminBadgeEdit-form").validate();
	  
	$("#deleteThumbsBadgeAdmin").live("click", function () {
		deleteThumbImageShop();
    });
});

	function saveformbadge()
	{
		$('#adminBadgeEdit-form').submit();
	}
	
	$('#adminBadgeEdit-form').submit(function() 
	{
		if(!$('#adminBadgeEdit-form').valid())
		{
			return false;
		}
	
		$.ajax({
			type: "post",
			url: "<?=base_url()?>admin/badges/ajaxsave" ,
			dataType: "json",
			data: $('#adminBadgeEdit-form').serialize(),
			success: function(data) {
				if(data.success)
				{
					$().toastmessage('showToast', {
						text     : '<?= lang('dialog.saved');?>',
						no_sticky   : true,
						position : 'middle-center',
						type     : 'success',
						closeText: ''
					});
					oAdminTableBadges.fnDraw();
				}
			}
		}); 
		$('#dialog_badgeedit').dialog('close');
		//$('#id-tab-2').click();
		return false;		
	});	
	
	function closeformbadge()
	{
/*		var uploader = $('#uploader').plupload('getUploader');
		
		if (uploader.files.length > 0) {
			for (var i in uploader.files) {
				$.ajax({
					type: "post",
					url: "<?=base_url()?>shop/inventory/ajaxdeleteImgUploader",
					async : false,
					data: {'filename': uploader.files[i].name},
					success: function(data) {
					}
				});
			}
		}
*/	
		$('#dialog_badgeedit').dialog('close');
	}
	
</script>