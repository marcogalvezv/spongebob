<style>
    #map-canvas {
        background: #000066;
        margin: 0;
        padding: 0;
        height: 300px;
        width: 300px;
    }
</style>
<article class="module width_full">
    <header><h3>Editar Reserva</h3></header>
    <div class="mws-panel grid_8 mws-collapsible">
        <div class="mws-panel-header">
            <span><i class="icon-ok"></i>Reserva</span>
        </div>
        <div class="mws-panel-inner-wrap">
            <div class="mws-panel-body no-padding">
                <form id="users-form" class="mws-form" action="form_elements.html">
                    <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                    <fieldset class="mws-form-inline">
                        <legend>Cliente</legend>
                        <div class="mws-form-cols">
                            <div class="mws-form-col-4-8">
                                <div class="mws-form-row">
                                    <label class="mws-form-label"><?=lang('users.tab.dialog.phone');?></label>
                                    <div class="mws-form-item">
                                        <select class="required small" name="user[iduser]" id="cb_user" title="<?=lang
                                        ('dialog.fieldrequired');?>">
                                            <?if(!empty($users)){?>
                                            <?php foreach($users as $user){?>
                                                <option value="<?= $user->id?>" <? if(isset($profile) && ($user->id ==
                                                    $profile->mobile)){echo "selected='selected'";}?>><?= $user->name?></option>
                                                <?}?>
                                            <?}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label"><?=lang('users.tab.dialog.firstname');?></label>
                                    <div class="mws-form-item">
                                        <input type="text" name="profile[firstname]" class="required small" id="txt_firstname" title="<?=lang('dialog.fieldrequired');?>" value="<?php if(isset($profile)) echo $profile->firstname ?>" required />
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Direccion</label>
                                    <div class="mws-form-item">
                                        <textarea rows="" cols="" class="small"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mws-form-col-4-8">
                                <div class="mws-form-row">
                                    <input class="btn btn-danger" style="width: 100px" value="editar"
                                           type="button" onclick="save()">
                                </div>
                                <div class="mws-form-row">
                                <div id="map-canvas"></div>
                                </div>
                            </div>
                    </fieldset>
                    <fieldset class="mws-form-inline">
                        <legend>Taxi</legend>
                        <div class="mws-form-row">
                            <div class="mws-form-cols">
                                <div class="mws-form-col-4-8">
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Numero de Movil</label>
                                        <div class="mws-form-item">
                                            <select class="required small" name="user[iduser]" id="cb_taxi" title="<?=lang
                                            ('dialog.fieldrequired');?>">
                                                <?if(!empty($users)){?>
                                                <?php foreach($users as $user){?>
                                                    <option value="<?= $user->id?>" <? if(isset($profile) && ($user->id ==
                                                        $profile->mobile)){echo "selected='selected'";}?>><?= $user->name?></option>
                                                    <?}?>
                                                <?}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Placa</label>
                                        <div class="mws-form-item">
                                            <input type="text" name="profile[firstname]" class="required small" id="txt_taxiplate"
                                                   title="<?=lang('dialog.fieldrequired');?>" value="<?php if(isset($profile)) echo $profile->firstname ?>" required />
                                        </div>
                                    </div>
                                    <div class="mws-form-row">
                                        <label class="mws-form-label">Color</label>
                                        <div class="mws-form-item">
                                            <input type="text" name="profile[firstname]" class="required small" id="txt_taxicolor"
                                                   title="<?=lang('dialog.fieldrequired');?>" value="<?php if(isset($profile)) echo $profile->firstname ?>" required />
                                        </div>
                                    </div>
                                    <div class="mws-form-row">
                                        <label class="mws-form-label"><?=lang('users.tab.dialog.firstname');?> Conductor</label>
                                        <div class="mws-form-item">
                                            <input type="text" name="profile[lastname]" class="required small"
                                                   id="txt_drivername" title="<?=lang('dialog.fieldrequired');?>" value="<?php if
                                            (isset($profile)) echo $profile->lastname ?>" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="mws-form-col-4-8">
                                    <div class="mws-form-row">
                                        <span class="thumbnail"><img src="http://cartoscreen.com/stockwall/th-2808-picture-alfa-romeo-8c-wallpapers-alfa-romeo-8c.jpg" alt=""></span>
                                    </div>
                                    <div class="mws-form-row">
                                        <span class="thumbnail"><img src="http://t1.gstatic.com/images?q=tbn:ANd9GcSle3Hby8-1n68bmihnnhIoxljdIT09vCQlB__cmVkWH8XxR9e3" alt=""></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="mws-button-row">
                        <input class="btn btn-danger" value="<?= lang('users.tab.dialog.save');?>" type="button" onclick="save()">
                    </div>

                </form>
            </div>
        </div>
    </div>

</article>




<script type="text/javascript">

    $(document).ready(function()
    {
        initialize();
        // Validation
        if( $.validator ) {
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
                        var message = errors == 1 ? 'Un campo no fue llenado, el campo fue resaltado' :  errors + ' campos no fueron llenados . Fueron Resaltados';
                        $("#mws-validate-error").html(message).show();
                    } else {
                        $("#mws-validate-error").hide();
                    }
                }
            });}

    });

    function closeformuser()
    {
        $('#dialog_useredit').dialog('close');
    }

    //cancel submmit
    $("#users-form").submit(function() { return false; });

    function save()
    {
        if(!$('#users-form').valid())
        {
            return false;
        }
        $.ajax({
            type: "post",
            url: "<?=base_url()?>admin/users/ajaxsave" ,
            dataType: "json",
            data: $('#users-form').serialize(),
            success: function(data) {
                if(data.success)
                {
                    $().toastmessage('showToast', {
                        text     : '<?= lang('users.tab.dialog.saved');?>',
                        no_sticky   : true,
                        position : 'middle-center',
                        type     : 'success',
                        closeText: ''
                    });
                    //$('#dialog_useredit').dialog('close');
                    oAdminTableUsers.fnDraw();

                    $('#successmsg').text(data.message);
                    $('#successbox').show();
                } else {
                    $('#errormsg').text(data.message);
                    $('#errordiv').show();
                }
            }
        });
        return false;
    }

    function initialize() {
        var mapOptions = {
            zoom: 8,
            center: new google.maps.LatLng(-34.397, 150.644),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map-canvas'),
                mapOptions);
    }


</script>