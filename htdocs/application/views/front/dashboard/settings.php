<div id="contentprofilesettings" class="frame100per">
	<div id="contentright_profilesettings" class="frame100per" >
		<div class="ma1000 pa2022 Border3330 ui-corner-right-gift overflow BgCelestial BgTransp90per font13px18px shadow" style="z-index:1;" >
			<div id="RightContentView">
				<div id="FormProfileSettings"> <!--class="formsignup">-->
					<div class="frame50per">
						<h4 class="Blue">Settings</h4><br/>
					</div>
					<div class="frame95per">
						<form id="user_setting_form" name="user_setting_form" method="post" >
							<?//print_r($notifications); echo "|||||||||||"; print_r($b); echo "___________"; print_r($a);?>
							<div class="frame100per ma2000">
									<div align="center">
										<div id="userscontainer" class="formdialog100per formtext">
											<div id="tabs_settings">
												<ul>
													<li><a href="#edit_profile_tab">Edit Profile</a></li>
													<li><a href="#edit_notifications_tab">Notifications</a></li>
													<li><a href="#edit_setting_user_tab">User Setting</a></li>
												</ul>
												
												<!--PROFILE TAB-->
												<div id="edit_profile_tab" style="font-size:0.8em">
		
													<div class="formdialog60per formtext">
													<!--MEMBER FIELDSET-->
														
														<fieldset class="ui-corner-all">
															<legend class="ui-corner-all"><b><?=lang('users.tab.dialog.legend');?></b></legend>
															
															<div class="fila">
																<div class="col" style="width:20px"></div>
																<div class="col" style="width:150px"><b><?=lang('users.tab.dialog.firstname');?><span class="fieldreq">*</span></b></div>
																<div class="col" style="width:270px">
																	<input type="text" name="profile[firstname]" id="txt_firstname" validate="required:true" value="<?php if(isset($profile)) echo $profile->firstname ?>" />
																</div>
															</div>
															
															<div class="fila">
																<div class="col" style="width:20px"></div>
																<div class="col" style="width:150px"><b><?=lang('users.tab.dialog.lastname');?><span class="fieldreq">*</span></b></div>
																<div class="col" style="width:270px">
																	<input type="text" name="profile[lastname]" id="txt_lastname" validate="required:true" value="<?php if(isset($profile)) echo $profile->lastname ?>" />
																</div>
															</div>
															
															<div class="fila">
																<div class="col" style="width:20px"></div>
																<div class="col" style="width:150px"><b><?=lang('users.tab.dialog.email');?><span class="fieldreq">*</span></b></div>
																<div class="col" style="width:270px">
																	<input type="text" name="profile[email]" id="txt_email" validate="required:true, email:true" value="<?php if(isset($profile)) echo $profile->email ?>" />
																</div>
															</div>

															<div class="fila">
																<div class="col" style="width:20px"></div>
																<div class="col" style="width:150px"><b><?=lang('users.tab.dialog.gender');?></b></div>
																<div class="col" style="width:270px" class="textbox" align="left">
																<select name="profile[gender]" id="cb_status" style="width:270px">
																	<option value="male" <? if(isset($profile) && ($profile->gender == "male")){echo "selected='selected'";}?>><?=lang('users.tab.dialog.male');?></option>
																	<option value="female" <? if(isset($profile) && ($profile->gender == "female")){echo "selected='selected'";}?>><?=lang('users.tab.dialog.female');?></option>
																</select>
																</div>
															</div>
															

															<div class="fila">
																<div class="col" style="width:20px"></div>
																<div class="col" style="width:150px"><b>Birth Date<span class="fieldreq">*</span></b></div>
																<div class="col" style="width:270px">
																	<input type="text" name="profile[birthdate]" id="txt_brithdate" validate="required:true, date:true" value="<?php if(isset($profile)) echo $profile->birthdate ?>" />
																</div>
															</div>

															<div class="fila">
																<div class="col" style="width:20px"></div>
																<div class="col" style="width:150px"><b><?=lang('users.tab.dialog.country');?></b></div>
																<div class="col" style="width:270px" class="textbox" align="left">
																<select name="profile[idcountry]" id="cb_country" style="width:270px">
																<?if(!empty($countries)){?>
																<?php foreach($countries as $country){?>
																	<option value="<?= $country->id?>" <? if(isset($profile) && ($country->id == $profile->idcountry)){echo "selected='selected'";}?>><?= $country->fullname?></option>
																<?}?>
																<?}?>
																</select>
																</div>
															</div>
															
															<div class="fila">
																<div class="col" style="width:20px"></div>
																<div class="col" style="width:150px"><b><?=lang('users.tab.dialog.occupation');?></b></div>
																<div class="col" style="width:270px">
																	<input type="text" name="profile[occupation]" id="txt_occupation" value="<?php if(isset($profile)) echo $profile->occupation ?>" />
																</div>
															</div>
															
															<div class="fila">
																<div class="col" style="width:20px"></div>
																<div class="col" style="width:150px"><b><?=lang('users.tab.dialog.bio');?></b></div>
																<div class="col" style="width:270px; height: 100px;">
																	<textarea style="width:270px;" rows="3" cols="35" name="profile[bio]" id="txt_bio" value=""><?php if(isset($profile)) echo $profile->bio ?></textarea>
																</div>
															</div>
															
															<div class="fila">
																<div class="col" style="width:20px"></div>
																<div class="col" style="width:150px"><b><?=lang('users.tab.dialog.selfdesc');?></b></div>
																<div class="col" style="width:270px">
																	<input type="text" name="profile[selfdesc]" id="txt_selfdesc" value="<?php if(isset($profile)) echo $profile->selfdesc ?>" />
																</div>
															</div>
															
															<div class="fila">
																<div class="col" style="width:20px"></div>
																<div class="col" style="width:150px"><b><?=lang('users.tab.dialog.interests');?></b></div>
																<div class="col" style="width:270px; height: 100px;">
																	<textarea style="width:270px;" rows="3" cols="35" name="profile[interests]" id="txt_interests" value=""><?php if(isset($profile)) echo $profile->interests ?></textarea>
																</div>
															</div>
															
														<!--END MEMBER FIELDSET-->
														
														</fieldset>
													</div>
													<div id="avatarcontainer" class="formdialog35per formtext">
																
													<!--IMAGE FIELDSET-->
														<fieldset class="ui-corner-all">
															<legend class="ui-corner-all"><b><?=lang('users.tab.dialog.legend.avatar');?></b></legend>
															
															<div class="fila">
																<div class="col" style="width:320px; text-align: center;">
																	<div id="filelistuserimage"></div>
																	<input id="userpickfiles_" style="z-index:9999;" onclick="javascript:;" value="<?= lang('dialog.selectfile');?>" type="button" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																	<input id="useruploadfiles"  style="z-index:9999;" onclick="javascript:;" value="<?= lang('dialog.uploadfile');?>" type="button" />
																	<input type="hidden" name="profile[avatar]" id="useravatar" value="<?php if(isset($profile)) echo $profile->avatar;?>" />
																</div>
																<div class="col" style="width:320px; text-align: center;">
																	<div id="imgContentsUserAdmin">
																		<div class="frame100per">
																		<?php if(isset($profile->avatar)){?>
																		<img src="<?= $profile->avatar?>" border="1" style="width:160px"/>
																		<?}else{?>
																		<img src="<?= base_url()?>images/no-image.jpg" border="1" style="width:160px"/>
																		<?}?>
																		</div>
																		<a href="javascript:void(0);" id="deleteThumbUserImage" title="<?= lang('dialog.delete')?>">(<?= lang('dialog.delete')?>)</a>
																	</div>
																</div>
															</div>
														<!--END IMAGE FIELDSET-->
														</fieldset>

														<!--SOCIAL FIELDSET-->

														<fieldset class="ui-corner-all">
															<legend class="ui-corner-all"><b><?=lang('users.tab.dialog.legend.social');?></b></legend>
																<div class="fila">
																	<div class="col" style="width:80px">
																		<img title="Facebook" src="<?= base_url()?>images/social/FaceBook_48x48.png" />
																	</div>
																	<div class="col" style="width:150px; margin:15px 0px;" class="textbox" align="left">
																		<input type="checkbox" name="usersocial[]" id="check_FB" value="1" <?php if(!empty($usersocial) && isset($usersocial[1])) { echo "checked='checked'";}?> />
																		<label for="check_FB"><?=lang('users.tab.dialog.legend.connect.facebook');?></label>
																	</div>
																</div>
																<div class="fila">
																	<div class="col" style="width:80px">
																		<img title="Twitter" src="<?= base_url()?>images/social/Twitter_48x48.png" />
																	</div>
																	<div class="col" style="width:150px; margin:15px 0px;" class="textbox" align="left">
																		<input type="checkbox" name="usersocial[]" id="check_TW" value="2" <?php if(!empty($usersocial) && isset($usersocial[2])) { echo "checked='checked'";}?> />
																		<label for="check_TW"><?=lang('users.tab.dialog.legend.connect.twitter');?></label>
																	</div>
																</div>
																<div class="fila">
																	<div class="col" style="width:80px">
																		<img title="LinkedIn" src="<?= base_url()?>images/social/LinkedInBlue_48x48.png" />
																	</div>
																	<div class="col" style="width:150px; margin:15px 0px;" class="textbox" align="left">
																		<input type="checkbox" name="usersocial[]" id="check_LK" value="3" <?php if(!empty($usersocial) && isset($usersocial[3])) { echo "checked='checked'";}?> />
																		<label for="check_LK"><?=lang('users.tab.dialog.legend.connect.linkedin');?></label>
																	</div>
																</div>
														</fieldset>
																			<!--END SOCIAL FIELDSET-->

													</div>
												</div>

												<!--END PROFILE TAB-->
												
												<!--NOTIFICATION TAB-->
												<div id="edit_notifications_tab"  style="font-size:0.8em">
													<div class="frame65per formtext pa0100">
														<div class="frame100per">
															<fieldset class="ui-corner-all">
																<legend class="ui-corner-all">SocialFlying will notify you when someone</legend>
																<div class="frame100per pa0010">
																	<div class="frame60per TextAlignLeft ma0010">
																	</div>
																	<div class="frame10per Blue Bold">
																		None
																	</div>
																	<div class="frame10per">
																		<img src="<?=base_url()?>images/elements/icons/mail.png"/>
																	</div>
																	<div class="frame10per">
																		<img src="<?=base_url()?>images/elements/icons/phone.png"/> 
																	</div>
																	<div class="frame10per Blue Bold">
																		Both
																	</div>
																</div>
															
																<div class="frame100per pa0010" >
																	<div class="frame55per TextAlignLeft ma0002">
																	Sends you a private message
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[send_private]" value="0" <?if(isset($setup)){if($setup->send_private==0) echo "checked='checked'";} ?>/>
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[send_private]" value="1" <?if(isset($setup)){if($setup->send_private==1) echo "checked='checked'";}else echo "checked='checked'" ?> />
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[send_private]" value="2" <?if(isset($setup)){if($setup->send_private==2) echo "checked='checked'";} ?>/>
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[send_private]" value="3" <?if(isset($setup)){if($setup->send_private==3) echo "checked='checked'";} ?> />
																	</div>
																</div>
																<div class="frame100per pa0010" >
																	<div class="frame55per TextAlignLeft ma0002">
																	Adds you as a friend
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[add_friend]" value="0" <?if(isset($setup)){if($setup->add_friend==0) echo "checked='checked'";} ?> /> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[add_friend]" value="1" <?if(isset($setup)){if($setup->add_friend==1) echo "checked='checked'";}else echo "checked='checked'" ?> /> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[add_friend]" value="2" <?if(isset($setup)){if($setup->add_friend==2) echo "checked='checked'";} ?> /> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[add_friend]" value="3"<?if(isset($setup)){if($setup->add_friend==3) echo "checked='checked'";} ?> /> 
																	</div>
																</div>
																<div class="frame100per pa0010" >
																	<div class="frame55per TextAlignLeft ma0002">
																	Confirms a friend request
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[confirm_friend]" value="0" <?if(isset($setup)){if($setup->confirm_friend==0) echo "checked='checked'";} ?> /> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[confirm_friend]" value="1" checked="checked" <?if(isset($setup)){if($setup->confirm_friend==1) echo "checked='checked'";}else echo "checked='checked'" ?>/> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[confirm_friend]" value="2" <?if(isset($setup)){if($setup->confirm_friend==2) echo "checked='checked'";} ?>/> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[confirm_friend]" value="3" <?if(isset($setup)){if($setup->confirm_friend==3) echo "checked='checked'";} ?> /> 
																	</div>
																</div>
																<div class="frame100per pa0010" >
																	<div class="frame55per TextAlignLeft ma0002">
																	You have a new Match
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[new_match]" value="0" <?if(isset($setup)){if($setup->new_match==0) echo "checked='checked'";} ?>/> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[new_match]" value="1" <?if(isset($setup)){if($setup->confirm_friend==1) echo "checked='checked'";}else echo "checked='checked'"; ?> /> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[new_match]" value="2" <?if(isset($setup)){if($setup->new_match==2) echo "checked='checked'";} ?>/> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[new_match]" value="3" <?if(isset($setup)){if($setup->new_match==3) echo "checked='checked'";} ?>/> 
																	</div>
																</div>
																<div class="frame100per pa0010" >
																	<div class="frame55per TextAlignLeft ma0002">
																	Joins a event your attending to
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[join_attending]" value="0" <?if(isset($setup)){if($setup->join_attending==0) echo "checked='checked'";} ?>/> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[join_attending]" value="1" <?if(isset($setup)){if($setup->join_attending==1) echo "checked='checked'";}else echo "checked='checked'"; ?> />
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[join_attending]" value="2" <?if(isset($setup)){if($setup->join_attending==2) echo "checked='checked'";} ?>/> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[join_attending]" value="3" <?if(isset($setup)){if($setup->join_attending==3) echo "checked='checked'";} ?>/> 
																	</div>
																</div>
																<div class="frame100per pa0010">
																	<div class="frame55per TextAlignLeft ma0002">
																	Posts a message on the general wall after you
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[post_general]" value="0" <?if(isset($setup)){if($setup->post_general==0) echo "checked='checked'";} ?>/> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[post_general]" value="1" <?if(isset($setup)){if($setup->post_general==1) echo "checked='checked'";}else echo "checked='checked'"; ?> /> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[post_general]" value="2" <?if(isset($setup)){if($setup->post_general==2) echo "checked='checked'";} ?>/> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[post_general]" value="3" <?if(isset($setup)){if($setup->post_general==3) echo "checked='checked'";} ?>/> 
																	</div>
																</div>
																<div class="frame100per pa0010" >
																	<div class="frame55per TextAlignLeft ma0002">
																	When a friend checks in
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[friend_checkin]" value="0" <?if(isset($setup)){if($setup->friend_checkin==0) echo "checked='checked'";} ?>/> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[friend_checkin]" value="1" <?if(isset($setup)){if($setup->friend_checkin==1) echo "checked='checked'";}else echo "checked='checked'"; ?> /> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[friend_checkin]" value="2" <?if(isset($setup)){if($setup->friend_checkin==2) echo "checked='checked'";} ?>/> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[friend_checkin]" value="3" <?if(isset($setup)){if($setup->friend_checkin==3) echo "checked='checked'";} ?>/> 
																	</div>
																</div>

															</fieldset>
															
															<fieldset class="ui-corner-all">
																<legend class="ui-corner-all">Notify me</legend>
																<div class="frame100per pa0010">
																	<div class="frame60per TextAlignLeft ma0010">
																	</div>
																	<div class="frame10per Blue Bold">
																		None
																	</div>
																	<div class="frame10per">
																		<img src="<?=base_url()?>images/elements/icons/mail.png"/>
																	</div>
																	<div class="frame10per">
																		<img src="<?=base_url()?>images/elements/icons/phone.png"/> 
																	</div>
																	<div class="frame10per Blue Bold">
																		Both
																	</div>
																</div>
																<div class="frame100per pa0010" >
																	<div class="frame55per TextAlignLeft ma0002">
																		When i need to check-in
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[need_checkin]" value="0" <?if(isset($setup)){if($setup->need_checkin==0) echo "checked='checked'";} ?>/> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[need_checkin]" value="1" <?if(isset($setup)){if($setup->need_checkin==1) echo "checked='checked'";}else echo "checked='checked'"; ?> /> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[need_checkin]" value="2" <?if(isset($setup)){if($setup->need_checkin==2) echo "checked='checked'";} ?>/> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[need_checkin]" value="3" <?if(isset($setup)){if($setup->need_checkin==3) echo "checked='checked'";} ?>/> 
																	</div>
																</div>
																<div class="frame100per pa0010" >
																	<div class="frame55per TextAlignLeft ma0002">
																		When my friends Check-in to the same airport
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[friend_airport]" value="0" <?if(isset($setup)){if($setup->friend_airport==0) echo "checked='checked'";} ?>/> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[friend_airport]" value="1" <?if(isset($setup)){if($setup->friend_airport==1) echo "checked='checked'";}else echo "checked='checked'"; ?> /> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[friend_airport]" value="2" <?if(isset($setup)){if($setup->friend_airport==2) echo "checked='checked'";} ?>/> 
																	</div>
																	<div class="frame10per">
																		<input type="radio" name="setup[friend_airport]" value="3" <?if(isset($setup)){if($setup->friend_airport==3) echo "checked='checked'";} ?>/> 
																	</div>
																</div>
															</fieldset>
														</div>
													</div>
													
													<div class="frame30per formtext">
													
														<div class="frame100per ">
															<fieldset class="ui-corner-all">
																<legend class="ui-corner-all">Privacy</legend>
																<div class="frame100per pa01" style="height:1em"></div>
																
																<div class="frame100per pa0010">
																	<div class="frame10per">
																		<input class="input_checkbox" type="checkbox" name="setup[search_me_email]" <?/*value="1"*/?> <?if(isset($setup)){if($setup->search_me_email==1) echo "checked='checked'";} ?> /> 
																	</div>
																	<div class="frame90per TextAlignLeft">
																		Allow people to search me using my email
																	</div>
																</div>
																<div class="frame100per pa0010">
																	<div class="frame10per">
																		<input class="input_checkbox" type="checkbox" name="setup[see_me_airport]" <?/*value="1"*/?> <?if(isset($setup)){if($setup->see_me_airport==1) echo "checked='checked'";} ?> /> 
																	</div>
																	<div class="frame90per TextAlignLeft">
																		Allow people to see me in airport checkins
																	</div>
																</div>
																<div class="frame100per pa0010">
																	<div class="frame10per">
																		<input  class="input_checkbox" type="checkbox" name="setup[send_me_mail]" <?/*value="1"*/?> <?if(isset($setup)){if($setup->send_me_mail==1) echo "checked='checked'";} ?>/> 
																		<?/*<input name="setup[id]" type="hidden" value="<?php if(isset($setup)) echo $setup['id'] ?>"/>*/?>
																	</div>
																	<div class="frame90per TextAlignLeft">
																		Allow people i dont know to send me mail
																	</div>
																</div>
															</fieldset>
														</div>
													</div>
												</div>
												<!--END NOTIFICATION TAB-->
												
												<div id="edit_setting_user_tab" class="formtext" style="font-size:0.8em">
													<div class="frame60per pa0100">
														<fieldset class="ui-corner-all">
															<legend class="ui-corner-all">Change Account</legend>
															<div class="fila">
																<div class="col" style="width:20px"></div>
																<div class="col" style="width:150px"><b>Username:<span class="fieldreq">*</span></b></div>
																<div class="col" style="width:270px">
																	<input type="text" name="user[username]" value="<?if(isset($user)) echo $user->username;?>" validate = "required:true" >
																</div>
															</div>
															<div class="fila">
																<div class="col" style="width:20px"></div>
																<div class="col" style="width:150px"><b>Password:<span class="fieldreq">*</span></b></div>
																<div class="col" style="width:270px">
																	<input id="validation" type="password" name="user[password]"> 
																</div>
															</div>
															<div class="fila">
																<div class="col" style="width:20px"></div>
																<div class="col" style="width:150px"><b>Repeat Password:<span class="fieldreq">*</span></b></div>
																<div class="col" style="width:270px">
																	<input type="password" validate="equalTo:'#validation'">
																</div>
															</div>
														</fieldset>
													</div>
													<div class="frame35per">
														<fieldset class="ui-corner-all">
															<legend class="ui-corner-all">Account State</legend>
															<div class="frame100per pa20">
																<select name="user[state]" style="width:100px">
																	<option value="1" <?if(isset($user)){if($user->status == 1) echo "selected='selected'";}else{echo "selected='selected'";}?> >Active</option>
																	<option value="0" <?if(isset($user)){if($user->status == 0) echo "selected='selected'";}?>>Deactive</option>
																</select>
															</div>
														</fieldset>
													</div>
												</div>
											</div><!--TABS-->
			
										</div>
										<div class="Clear"></div>
										
										<div class="fila" align="left">
											<div class="col" style="width:100%; text-align:center;" align="center">
												<?php if(isset($profile)){?>
													<input type="hidden" name="profile[id]" value="<?= $profile->id?>" />
													<input type="hidden" name="profile[uid]" value="<?= $profile->uid?>" />
												<?}?>
												<?php if(isset($setup)){?>
													<input type="hidden" name="setup[id]" value="<?= $setup->id?>" />
												<?}?>
												<?php if(isset($user)){?>
													<input type='hidden' name='user[id]' value="<?= $user->id?>" />
													<input type="hidden" name="user[gid]" value="<?= $user->gid?>" />
													<input type="hidden" name="setup[uid]" value="<?= $user->id?>" />
												<?}else{?>
													<input type="hidden" name="user[gid]" value="2" />
												<?}?>
													<input onclick="savesettingprofile()" value="<?= lang('users.tab.dialog.save');?>" type="button" />&nbsp;&nbsp;
<?/*													<input onclick="closeformsettingprofile()" value="<?= lang('users.tab.dialog.cancel');?>" type="button" />*/?>
											</div>
										</div>

									</div>

							</div>
						</form>
					</div>
				</div>

			</div>

		</div>
	</div>

</div>

<script type="text/javascript">
$(document).ready(function()
{
	var icons = {
		header: "ui-icon-circle-arrow-e",
		headerSelected: "ui-icon-circle-arrow-s"
	};
	
	var optionmenu = <?php echo $this->Systemmodel->optionmember()?>;
	$( "#accordion_settings_profile" ).accordion({
		icons: icons/*,
		active: optionmenu*/
	});
	$( "input:submit").button();
	$( "input:button").button();

	$("#tabs_settings").tabs();
			
	$('#errordiv').hide();
	$('#successbox').hide();

	$("#deleteThumbUserImage").live("click", function () {
		deleteThumbImageUser();
    });
	
	$.metadata.setType("attr", "validate");
	$('#user_setting_form').validate();

    $('.input_checkbox').click(function(e) {
//		var option = $(this).val();
		var option = $(this);
		if(option.is(':checked')) {
//      alert("aqui");
			//$('#using_pregenerated_keys_checkbox').attr('checked', false);
			option.attr('value', '1');
		} else {
//      alert("aqui NO");
			option.attr('value', '0');
		}
    });
});
	
	function savesettingprofile()
	{
		$('#user_setting_form').submit();
	}
	
	$('#user_setting_form').submit(function() 
	{
		if(!$('#user_setting_form').valid())
		{
			return false;
		}
	
		$.ajax({
			type: "post",
			url: "<?=base_url()?>member/dashboard/ajaxsavesettings" ,
			dataType: "json",
			data: $('#user_setting_form').serialize(),
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
				}
			}
		});
//		oAdminTableOrganization.fnDraw();
//		$('#dialog_adminorganizationedit').dialog('close');
//		$('#id-tab-2').click();
		return false;		
	});	
	
/*	function closeformsettingprofile()
	{
		$('#closeformsettingprofile').hide('fast');
	}
*/
</script>
