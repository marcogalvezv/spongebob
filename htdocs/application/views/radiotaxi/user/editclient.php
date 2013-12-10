<style>
    #map-canvas-editclient {
        background: #000066;
        margin: 0;
        padding: 0;
        height: 600px;
        width: 600px;
    }
</style>

<article class="module width_full">
<header><h3>Cliente</h3></header>
<div class="mws-panel grid_8">
<div class="mws-panel-header">
    <span><i class="icon-ok"></i>Cliente</span>
</div>


<div id="dialog_addressclient" title="Direccion" style="display:none; overflow:hidden;">

    <div class="mws-panel grid_8">
        <form id="address-form-edit-client" class="mws-form" action="form_elements.html">
            <div id="mws-address-validate-error" class="mws-form-message error" style="display:none;"></div>
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">Nombre</label>

                    <div class="mws-form-item">
                        <input type="text" name="address[fullname]" class="required small" id="txt_addressname"
                               title="<?= lang('dialog.fieldrequired'); ?>"
                               value="" required
                               disabled="true"/>
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label">Telefono</label>

                    <div class="mws-form-item">
                        <input type="text" name="address[phone]" class="required small" id="txt_phone"
                               title="<?= lang('dialog.fieldrequired'); ?>"
                               value="" required/>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Latitud</label>

                    <div class="mws-form-item">
                        <input type="text" name="address[lat]" class="required small" id="txt_lat"
                               title="<?= lang('dialog.fieldrequired'); ?>"
                               value="" autofocus required/>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Longitud</label>

                    <div class="mws-form-item">
                        <input type="text" name="address[lng]" class="required small" id="txt_lng"
                               title="<?= lang('dialog.fielrequired'); ?>"
                               value="" required/></div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Descripcion</label>

                    <div class="mws-form-item">
                        <input type="text" name="address[address1]" class="small" id="txt_desc"
                               title="<?= lang('dialog.fieldrequired'); ?>"
                               value=""
                               autofocus required/>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">Direccion Principal</label>

                    <div class="mws-form-item">
                        <ul class="mws-form-list">
                            <li><input id="radio_main_yes" type="radio" name="address[main]"
                                       value="Si">
                                <label for="radio_main_yes">Si</label></li>
                            <li><input id="radio_main_no" type="radio" name="address[main]"
                                       value="No">
                                <label for="radio_main_no">No</label></li>
                        </ul>
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label">Direccion</label>

                    <div class="mws-form-item">
                        <div id="map-canvas-editclient"></div>

                    </div>
                </div>
                <?php if (isset($user)) { ?>
                    <input type='hidden' name='address[uid]' value="<?= $user->id ?>" id="hidden_address_uid"/>
                <? } ?>
                <input type='hidden' name='address[id]' value="" id="hidden_address_id" />

            </div>

        </form>
    </div>

</div>
<!--/dialog!-->
<div class="mws-panel-body no-padding">
<form id="users-form" class="mws-form" action="form_elements.html">
<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
<div class="mws-form-inline">
<div class="mws-form-row">
    <label class="mws-form-label"><?= lang('users.tab.dialog.username'); ?></label>

    <div class="mws-form-item">
        <input type="text" name="user[username]" class="required small" id="txt_username"
               title="<?= lang('dialog.fieldrequired'); ?>"
               value="<?php if (isset($user)) echo $user->username ?>" autofocus required/>
    </div>
</div>
<div class="mws-form-row">
    <label class="mws-form-label"><?= lang('users.tab.dialog.email'); ?></label>

    <div class="mws-form-item">
        <input type="text" name="profile[email]" class="required email small" id="txt_email"
               title="<?= lang('dialog.emailrequired'); ?>" validate="email:true"
               value="<?php if (isset($profile)) echo $profile->email ?>" required/></div>
</div>
<div class="mws-form-row">
    <label class="mws-form-label"><?= lang('users.tab.dialog.password'); ?></label>

    <div class="mws-form-item">
        <input type="password" name="user[password]" class="small" id="txt_password"/>
    </div>
</div>
<div class="mws-form-row">
    <label class="mws-form-label"><?= lang('users.tab.dialog.firstname'); ?></label>

    <div class="mws-form-item">
        <input type="text" name="profile[firstname]" class="required small" id="txt_firstname"
               title="<?= lang('dialog.fieldrequired'); ?>"
               value="<?php if (isset($profile)) echo $profile->firstname ?>" required/>
    </div>
</div>
<div class="mws-form-row">
    <label class="mws-form-label"><?= lang('users.tab.dialog.lastname'); ?></label>

    <div class="mws-form-item">
        <input type="text" name="profile[lastname]" class="required small" id="txt_lastname"
               title="<?= lang('dialog.fieldrequired'); ?>"
               value="<?php if (isset($profile)) echo $profile->lastname ?>" required/>
    </div>
</div>
<div class="mws-form-row">
    <label class="mws-form-label"><?= lang('users.tab.dialog.gender'); ?></label>

    <div class="mws-form-item">
        <select class="required small" name="profile[gender]" id="cb_gender"
                title="<?= lang('dialog.fieldrequired'); ?>">
            <option value="male" <? if (isset($profile) && ($profile->gender == "male")) {
                echo "selected='selected'";
            }?>><?= lang('users.tab.dialog.male'); ?></option>
            <option value="female" <? if (isset($profile) && ($profile->gender == "female")) {
                echo "selected='selected'";
            }?>><?= lang('users.tab.dialog.female'); ?></option>
        </select>
    </div>
</div>
<div class="mws-form-row">
    <label class="mws-form-label"><?= lang('users.tab.dialog.country'); ?></label>

    <div class="mws-form-item">
        <select class="required small" name="profile[idcountry]" id="cb_country"
                title="<?= lang('dialog.fieldrequired'); ?>">
            <? if (!empty($countries)) { ?>
                <?php foreach ($countries as $country) { ?>
                    <option
                        value="<?= $country->id ?>" <? if (isset($profile) && ($country->id == $profile->idcountry)) {
                        echo "selected='selected'";
                    }?>><?= $country->name ?></option>
                <? } ?>
            <? } ?>
        </select>
    </div>
</div>
<div class="mws-form-row">
    <label class="mws-form-label"><?= lang('users.tab.dialog.country'); ?></label>

    <div class="mws-form-item">
        <select class="required small" name="profile[idcity]" id="cb_city"
                title="<?= lang('dialog.fieldrequired'); ?>">
            <? if (!empty($cities)) { ?>
                <?php foreach ($cities as $city) { ?>
                    <option
                        value="<?= $city->id ?>" <? if (isset($profile) && ($city->id == $profile->idcity)) {
                        echo "selected='selected'";
                    }?>><?= $city->name ?></option>
                <? } ?>
            <? } ?>
        </select>
    </div>
</div>
<div class="mws-form-row">
    <label class="mws-form-label"><?= lang('users.tab.dialog.document'); ?></label>

    <div class="mws-form-item">
        <input type="text" name="profile[document]" class="small" id="txt_document"
               title="<?= lang('dialog.fieldrequired'); ?>"
               value="<?php if (isset($profile)) echo $profile->document ?>"/>
    </div>
</div>
<div class="mws-form-row">
    <label class="mws-form-label"><?= lang('users.tab.dialog.typedoc'); ?></label>

    <div class="mws-form-item">
        <select class="required small" name="profile[typedoc]" id="cb_typedoc"
                title="<?= lang('dialog.fieldrequired'); ?>">
            <? if (!empty($typedocs)) { ?>
                <?php foreach ($typedocs as $typedoc) { ?>
                    <option
                        value="<?= $typedoc ?>" <? if (isset($profile) && ($typedoc == $profile->typedoc)) {
                        echo "selected='selected'";
                    }?>><?= $typedoc ?></option>
                <? } ?>
            <? } ?>
        </select>
    </div>
</div>
<div class="mws-form-row">
    <label class="mws-form-label">Telefono</label>

    <div class="mws-form-item">
        <input type="text" name="profile[mobile]" class="required small" id="txt_mobile"
               title="<?= lang('dialog.fieldrequired'); ?>"
               value="<?php if (isset($profile)) echo $profile->mobile ?>" required/>
    </div>
</div>
<div class="mws-form-row">
    <label class="mws-form-label"><?= lang('users.tab.dialog.status'); ?></label>

    <div class="mws-form-item">
        <select name="user[status]" class="required small" id="cb_status"
                title="<?= lang('dialog.fieldrequired'); ?>">
            <option value="1" <? if (isset($user) && ($user->status == 1)) {
                echo "selected='selected'";
            }?>><?= lang('users.tab.dialog.approved'); ?></option>
            <option value="0" <? if (isset($user) && ($user->status == 0)) {
                echo "selected='selected'";
            }?>><?= lang('users.tab.dialog.blocked'); ?></option>
        </select>
    </div>
</div>
<div class="mws-form-row">
    <div class="mws-panel grid_8">
        <form name="admin_members_form" id="admin_members_form" method="post" class="mws-form">
            <div class="mws-panel-header">
                <span><i class="icon-table"></i>Direcciones</span>
            </div>
            <div class="mws-panel-body no-padding">
                <table class="mws-table" id="v_addressediclient">
                    <thead>
                    <tr>
                        <th
                        "width: 5%"><?= lang('users.tab.select'); ?></th>
                        <th
                        "width: 15%">Latitud</th>
                        <th
                        "width: 15%">Longitud</th>
                        <th
                        "width: 30%">Descripcion</th>
                        <th
                        "width: 15%">Telefono</th>
                        <th
                        "width: 5%">Principal</th>
                        <th
                        "width: 18%">Opciones</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?= lang('datatable.loading'); ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <footer style="height:40px">
                <div class="mws-button-row">
                    <input class="btn btn-danger" value="<?= lang('users.tab.dialog.save'); ?>" type="button"
                           onclick="save()">

                    <input onclick="openClientDireccion()" value="Agregar Direccion" type="button"
                           class="btn"/>
                </div>
            </footer>
        </form>
    </div>
</div>
<div class="submit_link">
    <?php if (isset($profile)) { ?>
        <input type='hidden' name='profile[id]' value="<?= $profile->id ?>"/>
        <input type='hidden' name='profile[uid]' value="<?= $profile->uid ?>"/>
    <? } ?>
    <?php if (isset($user)) { ?>
        <input type='hidden' name='user[id]' value="<?= $user->id ?>"/>
        <input type="hidden" name="user[gid]" value="<?= $user->gid ?>"/>
    <? } else { ?>
        <input type="hidden" name="user[gid]" value="2"/>
    <? } ?>
</div>

</div>

</form>
</div>
</div>


</article>


<!--SCRIPTS REC-->

<script type="text/javascript">


$(document).ready(function () {
    var clientId = 0;
    <?php if (isset($user)) { ?>
    <?= 'clientId='.  $user->id.';'?>
    <? }?>
    initializeEditClientMap(-17.390183, -66.163101);
    initializeadress(clientId);

    // Validation
    if ($.validator) {
        $("#users-form").validate({
            rules: {
                spinner: {
                    required: true,
                    max: 5
                }
            },
            invalidHandler: function (form, validator) {
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

});


function closeformuser() {
    $('#dialog_useredit').dialog('close');
}


function save() {
    document.getElementById('mws-validate-error').style.display = 'none';
    if (!$('#users-form').valid()) {
        return false;
    }
    $.ajax({
        type: "post",
        url: "<?=base_url()?>radiotaxi/users/ajaxsave",
        dataType: "json",
        async: false,
        data: $('#users-form').serialize(),
        success: function (data) {
            if (data.success) {

                $().toastmessage('showToast', {
                    text: '<?= lang('users.tab.dialog.saved');?>',
                    no_sticky: true,
                    position: 'middle-center',
                    closeText: ''
                });
                //$('#dialog_useredit').dialog('close');
                oAdminTableUsers.fnDraw();

                $('#successmsg').text(data.message);
                $('#successbox').show();
                //setTimeout("", 3000);
                tviewurl3 = '<?=base_url()?>radiotaxi/users/viewClient';
                //SET TAB STATUS ON SESSION
                settabsession('client');
                loadtabcontentnum(tviewurl3, 3);

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


$('#loadingDiv')
    .hide()// hide it initially
    .ajaxStart(function () {
        $(this).show();
    })
    .ajaxStop(function () {
        $(this).hide();
    })
;

function initializeadress(clientId) {
    oAdminTableUsers = $('#v_addressediclient').dataTable({
        'bServerSide': true,
        'bAutoWidth': false,
        // "bJQueryUI": true,
        'sPaginationType': 'full_numbers',
        'sAjaxSource': '<?= base_url()?>radiotaxi/address/listenerAddressByUserId/' + clientId,
        'aoColumns': [
            { 'sName': 'v_address.selected'},
            { 'sName': 'v_address.lat'},
            { 'sName': 'v_address.lng'},
            { 'sName': 'v_address.fulladdress'},
            { 'sName': 'v_address.phone'},
            { 'sName': 'v_address.main'},
            { 'sName': 'v_address.id', "bSortable": false, "bSearchable": false }
        ],
        'fnServerData': function (sSource, aoData, fnCallback) {
            $.ajax({
                'dataType': 'json',
                'type': 'POST',
                'url': sSource,
                'data': aoData,
                'success': fnCallback,
                'error': function (xml, textStatus, errorThrown) {
                    alert(xml.status + "||" + xml.responseText);
                }
            });
        },
        "oLanguage": {
            "sProcessing": "<?= lang('datatable.Processing');?>",
            "sLengthMenu": "<?= lang('datatable.LengthMenu');?>",
            "sSearch": "<?= lang('datatable.Search');?>",
            "sZeroRecords": "<?= lang('datatable.ZeroRecords');?>",
            "sEmptyTable": "<?= lang('datatable.EmptyTable');?>",
            "sInfo": "<?= lang('datatable.Info');?>",
            "sInfoEmpty": "<?= lang('datatable.InfoEmpty');?>",
            "sInfoFiltered": "<?= lang('datatable.InfoFiltered');?>",
            "oPaginate": {
                "sFirst": "<?= lang('datatable.First');?>",
                "sPrevious": "<?= lang('datatable.Previous');?>",
                "sNext": "<?= lang('datatable.Next');?>",
                "sLast": "<?= lang('datatable.Last');?>"
            }
        }
    });
}


function openClientDireccion() {
    //copying user fullname
    var fullname = $("#txt_firstname").val() + ' ' + $("#txt_lastname").val();
    $("#txt_addressname").val(fullname);
    $("#dialog_addressclient").dialog({
        resizable: true,
        height: 1100,
        width: 1000,
        modal: true,
        buttons: {
            "Guardar": function () {
                $(this).dialog("close");
                saveEditClientAddress();
            },
            Cancel: function () {
                $(this).dialog("close");
            }
        }
    });
}

function saveEditClientAddress() {
    if (!$('#address-form-edit-client').valid()) {
        return false;
    }
    $.ajax({
        type:"post",
        url:"<?=base_url()?>radiotaxi/address/ajaxsave",
        dataType:"json",
        data:$('#address-form-edit-client').serialize(),
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

function initializeEditClientMap(lat, lng) {
    var mapOptions = {
        zoom: 14,
        center: new google.maps.LatLng(lat, lng),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById('map-canvas-editclient'),
        mapOptions);
//lat -17.390183 lng -66.163101
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(lat, lng),
        map: map, // handle of the map
        draggable: true
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