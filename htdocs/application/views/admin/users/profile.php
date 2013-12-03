<article class="module width_full">
	<header><h3>User Profile</h3></header>
		<div class="module_content">
			<fieldset class="width_3_quarter">
				<legend><b><?=lang('users.tab.dialog.legend');?></b></legend>
				<div class="fieldset_content">
					<p>
						<b><?=lang('users.tab.dialog.username');?>: </b>
						<?php if(isset($user)) echo $user->username ?>
					</p>
					<p>
						<b><?=lang('users.tab.dialog.email');?>: </b>
						<?php if(isset($profile)) echo $profile->email ?>
					</p>
					<p>
						<b><?=lang('users.tab.dialog.firstname');?>: </b>
						<?php if(isset($profile)) echo $profile->firstname ?>
					</p>
					<p>
						<b><?=lang('users.tab.dialog.lastname');?>: </b>
						<?php if(isset($profile)) echo $profile->lastname ?>
					</p>
					<p>
						<b><?=lang('users.tab.dialog.gender');?>: </b>
						<?php if(isset($profile) && ($profile->gender == "male")){echo "Male";}else{echo "Female";}?>
					</p>
					<p>
					<b><?=lang('users.tab.dialog.country');?>: </b>
					<?if(!empty($countries)){?>
						<?php foreach($countries as $country){?>
							<? if(isset($profile) && ($country->id == $profile->idcountry)){echo $country->fullname;}?>
						<?}?>
					<?}?>
					</p>
					<p>
						<b><?=lang('users.tab.dialog.occupation');?>: </b>
						<?php if(isset($profile)) echo $profile->occupation; ?>
					</p>
					<p>
					<p>
						<b><?=lang('users.tab.dialog.bio');?>: </b>
						<?php if(isset($profile)) echo $profile->bio; ?>
					</p>
					<p>
						<b><?=lang('users.tab.dialog.selfdesc');?>: </b>
						<?php if(isset($profile)) echo $profile->selfdesc; ?>
					</p>
					<p>
						<b><?=lang('users.tab.dialog.interests');?>: </b>
						<?php if(isset($profile)) echo $profile->interests; ?>
					</p>
					<p>
						<b><?=lang('users.tab.dialog.level');?>: </b>
						<?php if(!empty($levels)){?>
							<?php foreach($levels as $level){?>
								<?php if(isset($user) && ($level->id == $user->idlevel)){echo $level->name;}?>
							<?}?>
						<?}?>
					</p>
					<p>
						<b><?=lang('users.tab.dialog.status');?>: </b>
						<?php if(isset($user) && ($user->status == 1)){echo lang('users.tab.dialog.approved');} else {echo lang('users.tab.dialog.blocked');} ?>
					</p>
				</div>
			</fieldset>

			<fieldset class="width_quarter" style="margin-left:20px">
				<legend class="ui-corner-all"><b><?=lang('users.tab.dialog.legend.avatar');?></b></legend>
				<div class="fieldset_content">
					<center>
						<div id="imgContentsUserAdmin">
							<?php if(isset($profile->avatar)){?>
							<img src="<?= $profile->avatar?>" border="1" />
							<?}else{?>
							<img src="<?= base_url()?>images/no-image.jpg" border="1" width="80px" />
							<?}?>
						</div>
					</center>
				</div>
			</fieldset>

			<fieldset class="width_quarter" style="margin-left:20px">
				<legend class="ui-corner-all"><b><?=lang('users.tab.dialog.legend.social');?></b></legend>
				<div class="fieldset_content">
					<img title="Facebook" src="<?= base_url()?>images/social/FaceBook_48x48.png" />
					<?php if(!empty($usersocial) && isset($usersocial[1])) { echo "Yes, ";} else { echo "No, ";}?>
					<?=lang('users.tab.dialog.legend.connect.facebook');?>
					<br/>
					<img title="Twitter" src="<?= base_url()?>images/social/Twitter_48x48.png" />
					<?php if(!empty($usersocial) && isset($usersocial[2])) { echo "Yes, ";} else { echo "No, ";}?>
					<?=lang('users.tab.dialog.legend.connect.twitter');?>
					<br/>
					<img title="LinkedIn" src="<?= base_url()?>images/social/LinkedInBlue_48x48.png" />
					<?php if(!empty($usersocial) && isset($usersocial[3])) { echo "Yes, ";} else { echo "No, ";}?>
					<?=lang('users.tab.dialog.legend.connect.linkedin');?>
				</div>
			</fieldset>
<?/*	<div class="Clear"></div>*/?>
	
		</div>

	<footer style="height:40px">
		<div class="submit_link">
			<input onclick="edituser('<?= $user->id?>')" value="<?= lang('common.dialog.edit');?>" type="button" />&nbsp;&nbsp;
			<input onclick="closeformprofile()" value="<?= lang('common.dialog.close');?>" type="button" />
		</div>
	</footer>
</article>

<!--SCRIPTS REC-->

<script type="text/javascript">

$(document).ready(function()
{
	$('#errordiv').hide();
	$('#successbox').hide();
	$("input:button").button();

});

	function edituser(id)
	{
		v_userprofile_edit(id);
	}

	function closeformprofile()
	{
		$('#dialog_useredit').dialog('close');
	}	

</script>