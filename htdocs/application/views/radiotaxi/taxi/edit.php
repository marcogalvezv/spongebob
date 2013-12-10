<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.js"></script>

<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.gears.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.silverlight.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.flash.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.browserplus.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.html4.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.html5.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/jquery.ui.plupload/jquery.ui.plupload.js"></script>


<article class="module width_full">
    <header><h3>Editar Taxi</h3></header>
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-ok"></i>Datos del taxi</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form id="users-form" class="mws-form" action="form_elements.html">
                <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                <div class="mws-form-inline">
                    <fieldset class="mws-form-inline">
                        <legend>Taxi</legend>
                        <div class="mws-form-row">
                            <label class="mws-form-label">Numero</label>

                            <div class="mws-form-item">
                                <input type="text" name="taxi[number]" class="required small" id="txt_taxinumber"
                                       title="<?=lang('dialog.fieldrequired');?>" value="<?php if (isset($taxi)) echo
                                $taxi->number ?>" autofocus required/>
                                <input type="hidden" name="taxi[id]" value="<?php if (isset($taxi)) echo
                                $taxi->id ?>"/>
                            </div>
                        </div>
                        <div class="mws-form-row">
                            <label class="mws-form-label">Placa</label>

                            <div class="mws-form-item">
                                <input type="text" name="taxi[plate]" class="required small" id="txt_taxiplate"
                                       title="<?=lang('dialog.fieldrequired');?>" value="<?php if (isset($taxi)) echo
                                $taxi->plate ?>" required/></div>
                        </div>
                        <div class="mws-form-row">
                            <label class="mws-form-label">Descripcion</label>

                            <div class="mws-form-item">
                                <input type="text" name="taxi[desc]" class="small" id="txt_taxidesc"
                                       value="<?php if (isset($taxi)) echo
                                       $taxi->desc ?>"/>
                            </div>
                        </div>
                        <div class="mws-form-row">
                            <label class="mws-form-label">Color</label>

                            <div class="mws-form-item">
                                <input type="text" name="taxi[taxicolor]" class="required small" id="txt_taxicolor"
                                       title="<?=lang('dialog.fieldrequired');?>" value="<?php if (isset($taxi)) echo
                                $taxi->taxicolor ?>" required/>
                            </div>
                        </div>
                        <div class="mws-form-row">
                            <label class="mws-form-label">Estado</label>

                            <div class="mws-form-item">
                                <select class="required small" name="taxi[status]" id="cb_taxistatus" title="<?=lang
                                ('dialog.fieldrequired');?>">
                                    <option value="Libre" <? if (isset($taxi) && ($taxi->status == "0")) {
                                        echo
                                        "selected='selected'";
                                    }?>>Libre
                                    </option>
                                    <option value="Ocupado" <? if (isset($taxi) && ($taxi->status == "1")) {
                                        echo
                                        "selected='selected'";
                                    }?>>Ocupado
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="mws-form-row">
                            <label class="mws-form-label">Fotografia</label>

                            <div class="mws-form-item">
                                <div id="filelisttaxiimage"></div>
                                <input id="taxipickfiles_" onclick="javascript:;"
                                       value="<?= lang('dialog.selectfile');?>"
                                       type="button"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?/*<a id="taxipickfiles_" href="javascript:;">[Select files]</a> */?>
                                <input id="taxiuploadfiles" onclick="javascript:;"
                                       value="<?= lang('dialog.uploadfile');?>" type="button"/>
                                <?/*<a id="taxiuploadfiles" href="javascript:;">[Upload files]</a>*/?>
                                <input type="hidden" name="taxi[taxiphoto]" id="taxiadmin"
                                       value="<?php if (isset($taxi))
                                           echo $taxi->taxiphoto; else '';?>"/>
                            </div>
                        </div>
                        <div class="mws-form-row">
                            <div class="mws-form-item">
                                <div id="imgContentsTaxiAdmin"><?php if (isset($taxi->taxiphoto)) echo "<img src='"
                                        .base_url(). $taxi->taxiphoto . "' border='0' /><br /><a href='javascript:void(0);'
                                id='deleteThumbsTaxiAdmin' title='" . lang('dialog.delete') . "'>(" . lang('dialog.delete')
                                    . ")</a>";?></div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="mws-form-inline">
                        <legend>Conductor</legend>
                        <div class="mws-form-row">
                            <label class="mws-form-label">Documento</label>

                            <div class="mws-form-item">
                                <select class="required small" name="driver[document]" id="cb_driverdocument"
                                        title="<?=lang
                                        ('dialog.fieldrequired');?>">
                                    <?if (!empty($drivers)) { ?>
                                    <?php foreach ($drivers as $driver) { ?>
                                        <option value="<?= $driver['uid']?>" <? if
                                        (isset($taxi) && ($driver['uid'] ==
                                                $taxi->uid)
                                        ) {
                                            echo "selected='selected'";
                                        }?>><?= $driver['document']
                                            ?></option>
                                        <? } ?>
                                    <? }?>

                                </select>
                            </div>
                        </div>
                        <div class="mws-form-row">
                            <label class="mws-form-label">Nombre</label>

                            <div class="mws-form-item">
                                <select class="required small" name="taxi[uid]" id="cb_drivername" title="<?=lang
                                ('dialog.fieldrequired');?>">
                                    <?if (!empty($drivers)) { ?>
                                    <?php foreach ($drivers as $driver) { ?>
                                        <option value="<?= $driver['uid']?>" <? if
                                        (isset($taxi) && ($driver['uid'] ==
                                                $taxi->uid)
                                        ) {
                                            echo "selected='selected'";
                                        }?>><?= $driver['firstname']
                                            . " " . $driver['lastname']?></option>
                                        <? } ?>
                                    <? }?>
                                </select>
                            </div>

                            <select name="profile[avatar]" id="cb_driveravatar" style="visibility:hidden">
                                <?if (!empty($drivers)) { ?>
                                <?php foreach ($drivers as $driver) { ?>
                                    <option value="<?= $driver['uid']?>" <? if
                                    (isset($taxi) && ($driver['uid'] ==
                                            $taxi->uid)
                                    ) {
                                        echo "selected='selected'";
                                    }?>><?= $driver['avatar']
                                        ?></option>
                                    <? } ?>
                                <? }?>
                            </select>


                        </div>
                        <div class="mws-form-row">
                            <div class="mws-form-item">
                                <div id="imgContentsDriverPicture"><?php if (isset($profile->avatar)) echo "<img
                                src='"
                                    .base_url(). $profile->avatar . "' border='0' /><br />";?></div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="mws-button-row">
                    <input class="btn btn-danger" value="<?= lang('users.tab.dialog.save');?>" type="button"
                           onclick="save()">
                </div>
            </form>
        </div>
    </div>
</article>





<script type="text/javascript">
    var pluploader = new plupload.Uploader({
        runtimes:'silverlight,gears,html5,flash,silverlight,browserplus',
        browse_button:'taxipickfiles_',
        max_file_size:'10mb',
        url:'<?=base_url()?>plupload/uploadtaxi.php',
        resize:{width:80, height:60, quality:90},
        flash_swf_url:'<?=base_url()?>plupload/js/plupload.flash.swf',
        silverlight_xap_url:'<?=base_url()?>plupload/js/plupload.silverlight.xap',
        filters:[
            {title:"Image files", extensions:"jpg,gif,png"},
            {title:"Zip files", extensions:"zip"}
        ]
    });

    pluploader.bind('FilesAdded', function (up, files) {
        for (var i in files) {
            document.getElementById("filelisttaxiimage").innerHTML = '<div id="' + files[i].id + '">' + files[i].name
                    + ' (' + plupload.formatSize(files[i].size) + ') <b></b></div>';
        }
    });

    pluploader.bind('UploadProgress', function (up, file) {
        document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
    });

    pluploader.bind('FileUploaded', function (up, file, objresponse) {
        var path = "<?=base_url()?>";
        var newinput = "<img src='" + path + "temp/taxi/" + file.name + "' alt='" + file.name + "' />" + "<a href='javascript:void" +
                "(0);' id='deleteThumbsTaxiAdmin' title='<?=lang('dialog.delete')?>'>(<?=lang('dialog.delete')?>)</a>";
        document.getElementById("imgContentsTaxiAdmin").innerHTML = newinput;
        document.getElementById("taxiadmin").value = "temp/taxi/" + file.name;
        document.getElementsByName('taxi[taxiphoto]').value = "temp/taxi/" + file.name;
    });

    document.getElementById("taxiuploadfiles").onclick = function () {
        pluploader.start();
        return false;
    };

    pluploader.init();


    $(document).ready(function () {
        // Validation
        if ($.validator) {
            $("#users-form").validate({
                rules:{
                    spinner:{
                        required:true,
                        max:5
                    }
                },
                invalidHandler:function (form, validator) {
                    var errors = validator.numberOfInvalids();
                    if (errors) {
                        var message = errors == 1 ? 'Un campo no fue llenado, el campo fue resaltado' : errors + ' campos no fueron llenados . Fueron Resaltados';
                        $("#mws-validate-error").html(message).show();
                    } else {
                        $("#mws-validate-error").hide();
                    }
                }
            });
        }

        //ComboBox and image Sync
        $("#cb_driverdocument").change(function () {
            $("#cb_drivername").val(this.value);
        });

        $("#cb_drivername").change(function () {
            $("#cb_driverdocument").val(this.value);
        });

        $("#cb_drivername").change(function () {
            $("#cb_driveravatar").val(this.value);
            var path = "<?=base_url()?>";
            var newinput = "<img src='" + path + $("#cb_driveravatar option:selected").text() + "' alt='" + $("#cb_driveravatar option:selected").text()
                    + "' />";
            document.getElementById("imgContentsDriverPicture").innerHTML = newinput;
        });

        $("#cb_driverdocument").change(function () {
            $("#cb_driveravatar").val(this.value);
            var path = "<?=base_url()?>";

            var newinput = "<img src='" + path + $("#cb_driveravatar option:selected").text() + "' alt='" + $("#cb_driveravatar option:selected").text()
                    + "' />";
            document.getElementById("imgContentsDriverPicture").innerHTML = newinput;
        });

    });

    function closeformuser() {
        $('#dialog_useredit').dialog('close');
    }

    //cancel submmit
    $("#users-form").submit(function () {
        return false;
    });

    function save() {
        if (!$('#users-form').valid()) {
            return false;
        }
        $.ajax({
            type:"post",
            url:"<?=base_url()?>radiotaxi/taxi/ajaxsave",
            dataType:"json",
            data:$('#users-form').serialize(),
            success:function (data) {
                if (data.success) {
                    $().toastmessage('showToast', {
                        text:'<?= lang('users.tab.dialog.saved');?>',
                        no_sticky:true,
                        position:'middle-center',
                        type:'success',
                        closeText:''
                    });
                    //$('#dialog_useredit').dialog('close');
                    oAdminTableUsers.fnDraw();

                    $('#successmsg').text(data.message);
                    $('#successbox').show();

                    var tviewurl2 = '<?=base_url()?>radiotaxi/taxi';
                    //SET TAB STATUS ON SESSION
                    settabsession('taxi');
                    loadtabcontentnum(tviewurl2, 2);
                } else {
                    $('#errormsg').text(data.message);
                    $('#errordiv').show();
                }
            }
        });
        return false;
    }


</script>








