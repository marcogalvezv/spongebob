<div id="message" style="color: Red;">
<?php if(isset($message)) echo $message; ?>
</div>

<div>
  <!--Top Gap Area Start-->
  <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="38" /></div>
  <!--Top Gap Area End-->
  <!--Body Main Start-->
  <div>
    <!--Left Right Box Section Start-->
    <div class="Height">
      <!--Left Box Section Start-->
      <div class="Left" style="width: 243px; overflow: hidden; display:none;">
        <!--Category Section Start-->
        <div class="Box-TopBg">
          <div class="Box-BtmBg">
            <div class="Box-LftBg">
              <div class="Box-RightBg">
                <div class="Box-LftTopCorner">
                  <div class="Box-RightTopCorner">
                    <div class="DownloadAdBox-LftBtmCorner">
                      <div class="DownloadAdBox-RightBtmCorner">
                        <div style="padding: 18px;" class="Content">
                          <div class="BoxBg-1" style="min-height: 200PX;">AD SPACE</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Left Box Section End-->
      <!--Right Box Section Start-->
      <div class="Right" style="width: 715px; margin-right: 30px;">
        <!--Required Box Top Title Section Start-->
        <div class="StartBox-TopBg">
          <div class="StartBox-LftTopCorner">
            <div class="StartBox-RightTopCorner">
              <div style="padding-left: 31px; padding-top: 21px; padding-right: 21px;">
                <!--Left Content Section Start-->
                <div style="overflow: hidden;">
                  <div class="Cnt11">&nbsp;</div>
                  <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="2" /></div>
                  <div class="Cnt22" style="font-size: 26px;">User Register Form.</div>
                  <div class="Cnt11" style="text-transform: none; text-align: right; font-size: 12px; padding-top: 6px;">(*) required fields.</div>
                </div>
                <!--Left Content Section End-->
              </div>
            </div>
          </div>
        </div>
        <!--Required Box Top Title Section End-->
        <div style="padding-left: 2px; padding-right: 2px;">
          <!--<div class="WhiteBox-TopBg">-->
          <div class="WhiteBox-BtmBg">
            <div class="WhiteBox-LftBg">
              <div class="WhiteBox-RightBg">
                <div class="StartBox-LftBtmCorner">
                  <div class="StartBox-RightBtmCorner">
                    <div style="padding: 9px; padding-top: 0px;" class="Content">
                      <div class="WhiteBg" style="min-height: 345px; padding: 25px;">
                        <!--Button Section Start-->
                        <div id="wrapper_results">
                          <div id="loaderbox" class="loader" style="display:none"> <img src="<?=base_url()?>images/ajax-loader-big.gif" />Registering... </div>
                          <div id="finishbox"></div>
                        </div>
                        <div id="registeruser" class="WhiteBg">
                          <div class="CntTitleGrey">Please fill the fields in the form below for the user and profile registration. </div>
                          <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="15" /></div>
                          <!--Form Section Start-->
                          <form method="post" action="<?= base_url()?>user/complete" class="cmxform" id="registerform">
                            <div style="overflow: hidden; width: 570px;" class="CntTitleGrey">
                              <!--Name Section Start-->
                              <div class="Height">
                                <div class="form-label"><span class="required">*</span> Firstname :</div>
                                <div class="form-fields">
                                  <input id="mfirstname" name="profile[firstname]" type="text" class="Input-Txt264" value="<?= isset($profile)?$profile->firstname:""?>" validate="required:true" />
                                  <br />
                                  <label style="display:none" for="mfirstname" class="error">Please enter your firstname.</label>
                                </div>
                              </div>
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
                              <div class="Height">
                                <div class="form-label"><span class="required">*</span> Lastname :</div>
                                <div class="form-fields">
                                  <input id="mlastname" name="profile[lastname]" type="text" class="Input-Txt264" value="<?= isset($profile)?$profile->lastname:""?>" validate="required:true" />
                                  <br />
                                  <label style="display:none" for="mlastname" class="error">Please enter your lastname.</label>
                                </div>
                              </div>
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
                              <div class="Height">
                                <div class="form-label"><span class="required">*</span> Email :</div>
                                <div class="form-fields">
                                  <input id="memail" name="profile[email]" type="text" class="Input-Txt264" value="<?= isset($profile)?$profile->email:""?>" validate="required:true, email:true" />
                                  <br />
                                  <!--<label style="display:none" for="memail" class="error">Please enter a valid email address.</label>!-->
                                </div>
                              </div>
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
                              <div class="Height">
                                <div class="form-label"><span class="required">*</span> Username :</div>
                                <div class="form-fields">
                                  <input id="musername" name="user[username]" type="text" class="Input-Txt264" validate="required:true, usernamecheck: true" />
                                  <br />
                                  <!--<label style="display:none" for="musername" class="error">Please enter a valid username.</label>!-->
                                </div>
                              </div>
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
                              <div class="Height">
                                <div class="form-label"><span class="required">*</span> Password :</div>
                                <div class="form-fields">
                                  <input id="mpassword" name="user[password]" type="password" class="Input-Txt264" validate="required:true, minlength: 6" />
                                  <br />
                                  <label style="display:none" for="mpassword" class="error">Please enter a password.</label>
                                </div>
                              </div>
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
							  <div class="Height">
                                <div class="form-label"><span class="required">*</span> Confirm Password :</div>
                                <div class="form-fields">
                                  <input id="mconfirmpass" name="confirm_password" type="password" class="Input-Txt264" validate='required:true, minlength: 6, equalTo: "#mpassword"' />
                                  <br />
                                  <label style="display:none" for="mconfirmpass" class="error">Please confirm the password.</label>
                                </div>
                              </div>
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
                              <div class="Height">
                                <div class="form-label"><span class="required">*</span> Company :</div>
                                <div class="form-fields">
                                  <input id="mcompany" name="profile[company]" type="text" class="Input-Txt264" validate="required:true"/>
                                  <br />
                                  <label style="display:none" for="mcompany" class="error">Please enter your company name.</label>
                                </div>
                              </div>
							  <!--
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
                              <div class="Height">
                                <div class="form-label"><span class="required">*</span> Address 1 :</div>
                                <div class="form-fields">
                                  <input id="maddress1" name="profile[address1]" type="text" class="Input-Txt264" validate="required:true"/>
                                  <br />
                                  <label style="display:none" for="maddress1" class="error">Please enter your address line 1.</label>
                                </div>
                              </div>
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
                              <div class="Height">
                                <div class="form-label">Address 2 :</div>
                                <div class="form-fields">
                                  <input id="maddress2" name="profile[address2]" type="text" class="Input-Txt264"/>
                                  <br />
                                  <label style="display:none" for="maddress2" class="error">Please enter your address line 2.</label>
                                </div>
                              </div>
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
                              <div class="Height">
                                <div class="form-label"><span class="required">*</span> City :</div>
                                <div class="form-fields">
                                  <input id="mcity" name="profile[city]" type="text" class="Input-Txt264" validate="required:true"/>
                                  <br />
                                  <label style="display:none" for="mcity" class="error">Please enter your city.</label>
                                </div>
                              </div>
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
                              <div class="Height">
                                <div class="form-label"><span class="required">*</span> State :</div>
                                <div class="form-fields">
									<select id="mstate" class="Input-Drop264" name="profile[state]" validate="required:true">
										<option value="">-- Select State --</option>
									<?foreach($states as $code => $name){?>
									  <option value="<?= $code?>"><?= $name?></option>
									<?}?>
									</select>
									<br />
									<label style="display:none" for="mstate" class="error">Please select your state.</label>
                                </div>
                              </div>
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
                              <div class="Height">
                                <div class="form-label"><span class="required">*</span> Country :</div>
                                <div class="form-fields">
									<select id="mcountry" class="Input-Drop264" name="profile[country]" validate="required:true">
										<option value="">-- Select Country --</option>
									<?foreach($countrylist as $code => $name){?>
										<option value="<?= $name?>"><?= $name?></option>
									<?}?>
									</select>
									<br />
									<label style="display:none" for="mcountry" class="error">Please select your country.</label>
                                </div>
                              </div>
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
                              <div class="Height">
                                <div class="form-label"><span class="required">*</span> Zip Code :</div>
                                <div class="form-fields">
                                  <input id="mzip" name="profile[zip]" type="text" class="Input-Txt264" validate="required:true"/>
                                  <br />
                                  <label style="display:none" for="mzip" class="error">Please enter your zip code.</label>
                                </div>
                              </div>
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
                              <div class="Height">
                                <div class="form-label"><span class="required">*</span> Phone :</div>
                                <div class="form-fields">
                                  <input id="mphone" name="profile[phone]" type="text" class="Input-Txt264" validate="required:true"/>
                                  <br />
                                  <label style="display:none" for="mphone" class="error">Please enter your phone name.</label>
                                </div>
                              </div>
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
                              <div class="Height">
                                <div class="form-label"><span class="required">*</span> User Type :</div>
                                <div class="form-fields">
									<select id="mtype" class="Input-Drop264" name="profile[type]" validate="required:true">
										<option value="">-- Select Type --</option>
									<?foreach($types as $code => $name){?>
									  <option value="<?= $code?>"><?= $name?></option>
									<?}?>
									</select>
									<br />
									<label style="display:none" for="mtype" class="error">Please select the user type.</label>
                                </div>
                              </div>
							  !-->
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>							  
                              <div class="Height">
                                <div class="form-label">
								</div>
								<div class="form-fields">
									<div class="agreeterms">
										<input id="magree" type="checkbox" name="agreed" validate="required:true" />
										<label for="magree"> I agree with the <a href="javascript:void(0);" id="termslink">Terms of Service</a></label>
									</div>
									<label style="display:none" for="agreed" class="error">Please check for agree with the Terms of Service.</label>
									
								</div>
                              </div>
                              <div><img src="<?= base_url()?>images/spacer.gif" alt="" width="10" height="10" /></div>
                              <div>
                                <input id="usertype" name="profile[type]" type="hidden" value="member"/>
								<input type="hidden" id="pid" name="profile[id]" value="<?= isset($profile)?$profile->id:""?>" />
								<input name="Submit" type="submit" class="ButtonBg-Big" value="Register" />
                              </div>
                            </div>
                          </form>
                          <!--Form Section End-->
                        </div>
                        <div id="membermsg" class="membermessage" align="left">
                          <h3 style="color:blue">Register Member Success</h3>
                          <p>The member profile has been registered successfully.</p>
                          <p>An email has been sent to your email address and contains the survey results and more information.</p>
                          <p><span style="color: red;">If you don't see this email in your inbox, please check your junk or spam folder as well.</span></p>
                          <p><span style="color: red;">If you don't receive the email, please contact support and we can get your survey results right away.</span></p>
                        </div>
                        <!--Button Section End-->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Right Box Section End-->
    </div>
    <!--Left Right Box Section End-->
  </div>
  <!--Body Main End-->
</div>
<div id="termsdialog" title="Propose2 Terms of Use">
  <?= $terms;?>
</div>

<script type="text/javascript">
	$.metadata.setType("attr", "validate");
    $(document).ready(function(){
		$("#registerform").validate();		
		$('#membermsg').hide();
		
		
		$('#termsdialog').hide();
		$("#termslink").click(function(){
			$("#termsdialog").dialog("destroy");
			$("#termsdialog").dialog({
				modal: true,
				width: 800,
				height: 600,			
				buttons: {
					Ok: function() {
						$(this).dialog('close');
					}
				}
			});
			$("#termscontent").scrollTop(0);
			return false;
		});
 	});

	$('#registerform').submit(function() {
		if(!$('#registerform').valid())
		{
			return false;
		} 
	});	
	
</script>

