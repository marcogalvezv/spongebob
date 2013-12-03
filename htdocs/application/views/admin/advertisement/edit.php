<form name="adminAdsEdit-form" id="adminAdsEdit-form" method="post"><br />
<fieldset class="formshop ui-corner-all">
    <legend class="ui-corner-all">&nbsp;&nbsp;<b><?= lang('ads.editdialog.legend');?></b>&nbsp;&nbsp;</legend>
    <div class="fila">
        <div class="col" style="width:70px"></div>
        <div class="col" style="width:120px"><?= lang('ads.table.title');?><span class="fieldreq">*</span></div>
        <div class="col" style="width:580px"><input type="text" name="ads[title]" id="txt_adminadstitle" class="textbox" validate="required:true" value="<?php if(isset($ads)) echo $ads->title; else '';?>" style="width:350px" /></div>
    </div>
    <div class="fila">
        <div class="col" style="width:70px"></div>
        <div class="col" style="width:120px"><?= lang('ads.table.position');?><span class="fieldreq">*</span></div>
		<div class="col" style="width:200px">
			<select name="ads[position]" id="cb_adminadsposition" style="width:100px" >
				<option value='1' <?php if(isset($ads)&&($ads->position == 1)) echo "selected='selected'"; else '';?>>1 - Default</option>
				<option value='2' <?php if(isset($ads)&&($ads->position == 2)) echo "selected='selected'"; else '';?>>2 - Platinum</option>
				<option value='3' <?php if(isset($ads)&&($ads->position == 3)) echo "selected='selected'"; else '';?>>3 - Gold</option>
				<option value='4' <?php if(isset($ads)&&($ads->position == 4)) echo "selected='selected'"; else '';?>>4 - Diamond</option>
			</select>
		</div>
    </div>
    <div class="fila">
        <div class="col" style="width:70px"></div>
        <div class="col" style="width:120px"><?= lang('ads.table.startdate');?><span class="fieldreq">*</span></div>
        <div class="col" style="width:580px"><input type="text" name="ads[startdate]" id="txt_adminadsstartdate" class="textbox" validate="required:true" value="<?php if(isset($ads)) echo $ads->startdate; else '';?>" style="width:150px" /></div>
    </div>
    <div class="fila">
        <div class="col" style="width:70px"></div>
        <div class="col" style="width:120px"><?= lang('ads.table.duration');?><span class="fieldreq">*</span></div>
        <div class="col" style="width:580px"><input type="text" name="ads[duration]" id="txt_adminadsduration" class="textbox" validate="required:true" value="<?php if(isset($ads)) echo $ads->duration; else '';?>" style="width:50px" /></div>
    </div>
    <div class="fila">
        <div class="col" style="width:70px"></div>
        <div class="col" style="width:120px"><?= lang('ads.table.status');?><span class="fieldreq">*</span></div>
		<div class="col" style="width:200px">
			<select name="ads[status]" id="cb_adminadsstatus" style="width:100px" >
				<option value='1' <?php if(isset($ads)&&($ads->status == 1)) echo "selected='selected'"; else '';?>>Created</option>
				<option value='2' <?php if(isset($ads)&&($ads->status == 2)) echo "selected='selected'"; else '';?>>Approved</option>
				<option value='3' <?php if(isset($ads)&&($ads->status == 3)) echo "selected='selected'"; else '';?>>Rejected</option>
			</select>
		</div>
    </div>
    <div class="fila">
    	<div class="col" style="width:70px"></div>
        <div class="col" style="width:120px"><?= lang('ads.table.country');?></div>
        <div class="col" style="width:580px" class="textbox" align="left">
        <select name="ads[idcountry]" id="cb_adsidcountry" style="width:200px">
        <?php
        for($i=0; $i<sizeof($countries);$i++)
        {
            if(sizeof($ads) > 1)
            {	
                if($ads['idcountry']==$countries[$i]->id) 
                    echo "<option value='".$countries[$i]->id."' selected='selected'>".$countries[$i]->fullname."</option><br />\n";
                else echo "<option value='".$countries[$i]->id."'>".$countries[$i]->fullname."</option><br />\n";
            }
            else echo "<option value='".$countries[$i]->id."'>".$countries[$i]->fullname."</option><br />\n";
        }
        ?>
        </select>
        </div>
    </div>
    <div class="fila">
        <div class="col" style="width:70px"></div>
        <div class="col" style="width:120px"><?= lang('ads.table.image');?></div>
        <div class="col" style="width:300px" align="left">
			<div id="filelistadsimage"></div>
			<input id="adspickfiles_" onclick="javascript:;" value="<?= lang('dialog.selectfile');?>" type="button" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?/*<a id="adspickfiles_" href="javascript:;">[Select files]</a> */?>
			<input id="adsuploadfiles" onclick="javascript:;" value="<?= lang('dialog.uploadfile');?>" type="button" />
			<?/*<a id="adsuploadfiles" href="javascript:;">[Upload files]</a>*/?>
			<input type="hidden" name="ads[filename]" id="adsadmin" value="<?php if(isset($ads)) echo $ads->filename; else '';?>" />
        </div>
        <div class="col" style="width:100px">
			<div id="imgContentsAdsAdmin" align="center"><?php if(isset($ads->filename)) echo "<img src='".$ads->filename."' border='0' /><br /><a href='javascript:void(0);' id='deleteThumbsAdsAdmin' title='".lang('dialog.delete')."'>(".lang('dialog.delete').")</a>";?></div>
        </div>
    </div>
</fieldset>
<div class="fila">    
    <div class="col" style="width:100%;">
    <center>
		<?php
		if(isset($ads)) echo "<input type='hidden' name='ads[id]' value='".$ads->id."' />";
		/*if(isset($ads)) echo "<input type='hidden' name='ads[rating]' value='1' />";*/
		?>
		<input onclick="saveformads()" value="<?= lang('dialog.save');?>" type="button" />&nbsp;&nbsp;
		<input onclick="closeformads()" value="<?= lang('dialog.cancel');?>" type="button" />
	</center>
    </div>
</div>
</form>

<script type="text/javascript">
//PLUPLOAD
var pluploader = new plupload.Uploader({
	runtimes : 'silverlight,gears,html5,flash,silverlight,browserplus',
	browse_button : 'adspickfiles_',
	max_file_size : '10mb',
	url : '<?=base_url()?>plupload/uploadads.php',
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
		document.getElementById("filelistadsimage").innerHTML = '<div id="' + files[i].id + '">' + files[i].name + ' (' + plupload.formatSize(files[i].size) + ') <b></b></div>';
	}
});

pluploader.bind('UploadProgress', function(up, file) {
	document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
});

pluploader.bind('FileUploaded', function(up, file, objresponse) {
		var path = "<?=base_url()?>";
		var newinput = "<img src='"+path+"temp/ads/"+file.name+"' alt='"+file.name+"' />"+"<a href='javascript:void(0);' id='deleteThumbsAdsAdmin' title='<?=lang('dialog.delete')?>'>(<?=lang('dialog.delete')?>)</a>";
		document.getElementById("imgContentsAdsAdmin").innerHTML = newinput;
		document.getElementById("adsadmin").value = "/temp/ads/"+file.name;
		document.getElementsByName('ads[filename]').value = "/temp/ads/"+file.name;
});
	
document.getElementById("adsuploadfiles").onclick = function() {
	pluploader.start();
	return false;
};

pluploader.init();

function deleteThumbImageAds()
{
	if($("#adsadmin").val() != "")
	{
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/ads/deletethumb" ,
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
	$("#adminAdsEdit-form").validate();
	  
	$("#deleteThumbsBadgeAdmin").live("click", function () {
		deleteThumbImageShop();
    });
});

	function saveformads()
	{
		$('#adminAdsEdit-form').submit();
	}
	
	$('#adminAdsEdit-form').submit(function() 
	{
		if(!$('#adminAdsEdit-form').valid())
		{
			return false;
		}
	
		$.ajax({
			type: "post",
			url: "<?=base_url()?>admin/ads/ajaxsave" ,
			dataType: "json",
			data: $('#adminAdsEdit-form').serialize(),
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
					oAdminTableAds.fnDraw();
				}
			}
		}); 
		$('#dialog_adsedit').dialog('close');
		//$('#id-tab-2').click();
		return false;		
	});	
	
	function closeformads()
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
		$('#dialog_adsedit').dialog('close');
	}
	
</script>