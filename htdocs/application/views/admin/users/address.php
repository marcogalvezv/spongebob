
<div class="mws-panel grid_8">
        <form id="address-form" class="mws-form" action="form_elements.html">
            <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label"><?=lang('users.client.dialog.latitude');?></label>
                    <div class="mws-form-item">
                        <input type="text" name="address[lat]" id="txt_latitude" class="required large" value="<?php if(isset($address)) echo $address->lat ?>"/>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label"><?=lang('users.client.dialog.longitude');?></label>
                    <div class="mws-form-item">
                        <input type="text" name="address[lng]" id="txt_longitude" class="required large" value="<?php if(isset($address)) echo $address->lng ?>"/>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label"><?=lang('users.client.dialog.address1');?></label>
                    <div class="mws-form-item">
                        <textarea rows="2" cols="20" name="address[address1]" id="txt_address1" class="required large"><?php if(isset($address)) echo $address->address1 ?></textarea>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label"><?=lang('users.client.dialog.address2');?></label>
                    <div class="mws-form-item">
                        <textarea rows="2" cols="20" name="address[address2]" id="txt_address2" class="required large"><?php if(isset($address)) echo $address->address2 ?></textarea>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label"><?=lang('users.client.dialog.phone');?></label>
                    <div class="mws-form-item">
                        <input type="text" name="address[phone]]" id="txt_phone" class="required large" value="<?php if(isset($address)) echo $address->phone ?>" />
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label"><?=lang('users.client.dialog.extension');?></label>
                    <div class="mws-form-item">
                        <input type="text" name="address[extension]]" id="txt_extension" class="required large" value="<?php if(isset($address)) echo $address->extension ?>" />
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label"><?=lang('users.client.dialog.city');?></label>
                    <div class="mws-form-item">
                        <input type="text" name="address[idcity]]" id="txt_city" class="required large" value="<?php if(isset($address)) echo $address->idcity ?>"/>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label"><?=lang('users.client.dialog.state');?></label>
                    <div class="mws-form-item">
                        <input type="text" name="address[state]]" id="txt_state" class="required large" value="<?php if(isset($address)) echo $address->state ?>"/>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label"><?=lang('users.client.dialog.main');?></label>
                    <div class="mws-form-item">
                        <input type="text" name="address[main]]" id="txt_main" class="required large" value="<?php if(isset($address)) echo $address->main ?>"/>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label"><?=lang('users.client.dialog.status');?></label>
                    <div class="mws-form-item">
                        <input type="text" name="address[status]]" id="txt_status" class="required large" value="<?php if(isset($address)) echo $address->status ?>"/>
                    </div>
                </div>

                <div class="submit_link">

                    <?php if(isset($address)){?>
                    <input type='hidden' name='address[id]' value="<?= $address->id?>" />
                    <input type='hidden' name='address[uid]' value="<?= $address->uid?>" />
                    <?}?>
                    <!--                <input onclick="saveaddress()" value="--><?//= lang('users.tab.dialog.save');?><!--" type="button" style="margin-right: 65em" />&nbsp;&nbsp;-->
                    <!--            </div>-->


                </div>

        </form>

</div>

<script type="text/javascript">

    $(document).ready(function()
    {
        // Validation
        if( $.validator ) {
            $("#address-form").validate({
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
    $("#address-form").submit(function() { return false; });

    function saveaddress()
    {
        if(!$('#address-form').valid())
        {
            return false;
        }
        $.ajax({
            type: "post",
            url: "<?=base_url()?>admin/users/ajaxsaveaddress" ,
            dataType: "json",
            data: $('#address-form').serialize(),
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

</script>
