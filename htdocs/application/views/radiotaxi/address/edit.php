<style>
    #map-canvas {
        background: #000066;
        margin: 0;
        padding: 0;
        height: 600px;
        width: 800px;
    }
</style>

<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.js"></script>

<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.gears.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.silverlight.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.flash.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.browserplus.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.html4.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.html5.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/jquery.ui.plupload/jquery.ui.plupload.js"></script>


<article class="module width_full">
    <header><h3>Editar Direccion</h3></header>


    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-ok"></i>Direccion</span>
        </div>
        <div class="mws-panel-body no-padding">
            <form id="address-form" class="mws-form" action="form_elements.html">
                <div id="mws-address-validate-error" class="mws-form-message error" style="display:none;"></div>
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">Nombre</label>
                    <div class="mws-form-item">
                        <select class="required small" name="address[uid]" id="cb_clientname" title="<?=lang
                        ('dialog.fieldrequired');?>">
                            <?if (!empty($clients)) { ?>
                            <?php foreach ($clients as $client) { ?>
                                <option value="<?= $client['uid']?>" <? if
                                (isset($address) && ($client['uid'] ==
                                        $address->uid)
                                ) {
                                    echo "selected='selected'";
                                }?>><?= $client['firstname']
                                    . " " . $client['lastname']?></option>
                                <? } ?>
                            <? }?>
                        </select>
                    </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">Telefono</label>

                        <div class="mws-form-item">
                            <input type="text" name="address[phone]" class="required small" id="txt_phone"
                                   title="<?=lang('dialog.fieldrequired');?>"
                                   value="<?php if (isset($address)) echo $address->phone ?>" required/>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">Latitud</label>

                        <div class="mws-form-item">
                            <input type="text" name="address[lat]" class="required small" id="txt_lat"
                                   title="<?=lang('dialog.fieldrequired');?>"
                                   value="<?php if (isset($address)) echo $address->lat ?>" autofocus required/>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">Longitud</label>

                        <div class="mws-form-item">
                            <input type="text" name="address[lng]" class="required small" id="txt_lng"
                                   title="<?=lang('dialog.fielrequired');?>"
                                   value="<?php if (isset($address)) echo $address->lng ?>" required/></div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">Descripcion</label>

                        <div class="mws-form-item">
                            <input type="text" name="address[address1]" class="small" id="txt_desc"
                                   title="<?=lang('dialog.fieldrequired');?>"
                                   value="<?php if (isset($address)) echo $address->address1 . " " .$address->address2 ?>" autofocus required/>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">Direccion Principal</label>

                        <div class="mws-form-item">
                            <ul class="mws-form-list">
                                <li><input id="gender_male" type="radio" name="address[main]" value="Si" <?php if (isset($address)) echo $address->main== 1 ? "checked" : "" ?> > <label for="gender_male">Si</label></li>
                                <li><input id="gender_female" type="radio" name="address[main]" value="No" <?php if (isset($address)) echo $address->main== 0 ? "checked" : ""; else echo "checked" ?> > <label for="gender_female">No</label></li>
                            </ul>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">Direccion</label>

                        <div class="mws-form-item">
                            <div id="map-canvas"></div>

                        </div>
                    </div>

                </div>

                <div class="mws-button-row">
                    <?php if (isset($address)) { ?>
                    <input type='hidden' name='address[id]' value="<?= $address->id?>"/>
                    <? }?>
                    <input class="btn btn-danger" value="<?= lang('users.tab.dialog.save');?>" type="button"
                           onclick="save()">
                </div>
            </form>
        </div>
    </div>
</article>





<script type="text/javascript">

    $(document).ready(function () {
        // Validation
        if ($.validator) {
            $("#address-form").validate({
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


        initializemap();
    });

    function closeformuser() {
        $('#dialog_useredit').dialog('close');
    }

    //cancel submmit
    $("#address-form").submit(function () {
        return false;
    });

    function save() {
        if (!$('#address-form').valid()) {
            return false;
        }
        $.ajax({
            type:"post",
            url:"<?=base_url()?>radiotaxi/address/ajaxsave",
            dataType:"json",
            data:$('#address-form').serialize(),
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
                    var tviewurl5 = '<?=base_url()?>radiotaxi/address';
                    //SET TAB STATUS ON SESSION
                    settabsession('address');
                    loadtabcontentnum(tviewurl5, 5);

                } else {
                    $('#errormsg').text(data.message);
                    $('#errordiv').show();
                }
            },
            error: function (xml, textStatus, errorThrown) {
                alert(xml.status + "||" + xml.responseText);
            }
        });
        return false;
    }

    function initializemap() {
        var mapOptions = {
            zoom:14,
            center:new google.maps.LatLng(<?php if (isset($address)) echo $address->lat; else echo -17.390183?>, <?php if (isset($address)) echo $address->lng; else echo -66.163101?>),
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);

        var marker = new google.maps.Marker({
            position:new google.maps.LatLng(<?php if (isset($address)) echo $address->lat; else echo -17.390183?>, <?php if (isset($address)) echo $address->lng; else echo -66.163101?>),
            map:map, // handle of the map
            draggable:true
        });

        google.maps.event.addListener(
                marker,
                'dragend',
                function () {
                    document.getElementById('txt_lat').value = marker.position.lat();
                    document.getElementById('txt_lng').value = marker.position.lng();
                }
        );
    }
</script>








