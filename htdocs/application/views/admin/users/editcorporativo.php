<article class="module width_full">
    <header><h3><?=lang('users.tab.dialog.title');?>Corporativo</h3></header>
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-ok"></i><?=lang('users.tab.dialog.legend');?></span>
        </div>
        <div class="mws-panel-body no-padding">
            <form id="users-form" class="mws-form" action="form_elements.html">
                <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label"><?=lang('users.tab.dialog.username');?></label>
                        <div class="mws-form-item">
                            <input type="text" name="user[username]" class="required small" id="txt_username" title="<?=lang('dialog.fieldrequired');?>" value="<?php if(isset($user)) echo $user->username ?>" autofocus required/>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label"><?=lang('users.tab.dialog.email');?></label>
                        <div class="mws-form-item">
                            <input type="text" name="profile[email]" class="required email small" id="txt_email"  title="<?=lang('dialog.emailrequired');?>" validate="email:true" value="<?php if(isset($profile)) echo $profile->email ?>" required />                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label"><?=lang('users.tab.dialog.password');?></label>
                        <div class="mws-form-item">
                            <input type="password" name="user[password]" class="small" id="txt_password" />
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label"><?=lang('users.tab.dialog.firstname');?></label>
                        <div class="mws-form-item">
                            <input type="text" name="profile[firstname]" class="required small" id="txt_firstname" title="<?=lang('dialog.fieldrequired');?>" value="<?php if(isset($profile)) echo $profile->firstname ?>" required />
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label"><?=lang('users.tab.dialog.lastname');?></label>
                        <div class="mws-form-item">
                            <input type="text" name="profile[lastname]" class="required small" id="txt_lastname" title="<?=lang('dialog.fieldrequired');?>" value="<?php if(isset($profile)) echo $profile->lastname ?>" required />
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label"><?=lang('users.tab.dialog.gender');?></label>
                        <div class="mws-form-item">
                            <select class="required small" name="profile[gender]" id="cb_gender" title="<?=lang('dialog.fieldrequired');?>">
                                <option value="male" <? if(isset($profile) && ($profile->gender == "male")){echo "selected='selected'";}?>><?=lang('users.tab.dialog.male');?></option>
                                <option value="female" <? if(isset($profile) && ($profile->gender == "female")){echo "selected='selected'";}?>><?=lang('users.tab.dialog.female');?></option>
                            </select>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label"><?=lang('users.tab.dialog.country');?></label>
                        <div class="mws-form-item">
                            <select class="required small" name="profile[idcountry]" id="cb_country" title="<?=lang('dialog.fieldrequired');?>">
                                <?if(!empty($countries)){?>
                                <?php foreach($countries as $country){?>
                                    <option value="<?= $country->id?>" <? if(isset($profile) && ($country->id == $profile->idcountry)){echo "selected='selected'";}?>><?= $country->name?></option>
                                    <?}?>
                                <?}?>
                            </select>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label"><?=lang('users.tab.dialog.country');?></label>
                        <div class="mws-form-item">
                            <select class="required small" name="profile[idcity]" id="cb_city" title="<?=lang('dialog.fieldrequired');?>">
                                <?if(!empty($cities)){?>
                                <?php foreach($cities as $city){?>
                                    <option value="<?= $city->id?>" <? if(isset($profile) && ($city->id == $profile->idcity)){echo "selected='selected'";}?>><?= $city->name?></option>
                                    <?}?>
                                <?}?>
                            </select>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label"><?=lang('users.tab.dialog.document');?></label>
                        <div class="mws-form-item">
                            <input type="text" name="profile[document]" class="required small" id="txt_document" title="<?=lang('dialog.fieldrequired');?>" value="<?php if(isset($profile)) echo $profile->document ?>" required />
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label"><?=lang('users.tab.dialog.typedoc');?></label>
                        <div class="mws-form-item">
                            <select class="required small" name="profile[typedoc]" id="cb_typedoc" title="<?=lang('dialog.fieldrequired');?>">
                                <?if(!empty($typedocs)){?>
                                <?php foreach($typedocs as $typedoc){?>
                                    <option value="<?= $typedoc?>" <? if(isset($profile) && ($typedoc == $profile->typedoc)){echo "selected='selected'";}?>><?= $typedoc?></option>
                                    <?}?>
                                <?}?>
                            </select>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label"><?=lang('users.tab.dialog.company');?></label>
                        <div class="mws-form-item">
                            <input type="text" name="profile[company]" class="small" id="txt_company" value="<?php if(isset($profile)) echo $profile->company ?>" />
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label"><?=lang('users.tab.dialog.status');?></label>
                        <div class="mws-form-item">
                            <select name="user[status]" class="required small" id="cb_status" title="<?=lang('dialog.fieldrequired');?>">
                                <option value="1" <? if(isset($user) && ($user->status == 1)){echo "selected='selected'";}?>><?=lang('users.tab.dialog.approved');?></option>
                                <option value="0" <? if(isset($user) && ($user->status == 0)){echo "selected='selected'";}?>><?=lang('users.tab.dialog.blocked');?></option>
                            </select>
                        </div>
                    </div>
                    <div class="submit_link">
                        <?php if(isset($profile)){?>
                        <input type='hidden' name='profile[id]' value="<?= $profile->id?>" />
                        <input type='hidden' name='profile[uid]' value="<?= $profile->uid?>" />
                        <?}?>
                        <?php if(isset($user)){?>
                        <input type='hidden' name='user[id]' value="<?= $user->id?>" />
                        <input type="hidden" name="user[gid]" value="<?= $user->gid?>" />
                        <?}else{?>
                        <input type="hidden" name="user[gid]" value="3" />
                        <?}?>
                    </div>

                </div>
                <div class="mws-button-row">
                    <input class="btn btn-danger" value="<?= lang('users.tab.dialog.save');?>" type="button" onclick="save()">
                </div>
            </form>
        </div>
    </div>
</article>




<script type="text/javascript">

    $(document).ready(function()
    {
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


</script>