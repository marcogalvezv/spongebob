<script type="text/javascript" src="<?=base_url()?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=base_url()?>ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/jquery/jquery-ui-timepicker-addon.js"></script>
<link rel="stylesheet" type="text/css"  href="<?=base_url()?>js/extras/TableTools/media/css/TableTools.css" media=""/>

<?//JSON?>
<?/*<script type="text/javascript" src="<?=base_url()?>js/jquery/jquery-latest.js"></script>*/?>

<link rel="stylesheet" href="<?=base_url()?>plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css" type="text/css" />

<script type="text/javascript" src="<?=base_url()?>plupload/js/browserplus-min.js"></script>

<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.js"></script>
<?if($this->session->userdata('language') == "en"){?>
<?}else{?>
	<script type="text/javascript" src="<?=base_url()?>plupload/js/languages/es.js"></script>
<?}?>

<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.gears.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.silverlight.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.flash.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.browserplus.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.html4.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/plupload.html5.js"></script>
<script type="text/javascript" src="<?=base_url()?>plupload/js/jquery.ui.plupload/jquery.ui.plupload.js"></script>
	
	<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		<h3>Inicio</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="#" id="id-tab-1">Admin Dashboard</a></li>
		</ul>
		<h3>Usuarios</h3>
		<ul class="toggle">
			<li class="icn_view_users"><a href="#" id="id-tab-2">Usuarios</a></li>
			<li class="icn_view_users"><a href="#" id="id-tab-3">Clientes</li>
			<li class="icn_add_user"><a href="#" id="id-tab-4">Taxis</a></li>
		</ul>
		<h3>Catalogos</h3>
		<ul class="toggle">
			<li class="icn_world"><a href="#" id="id-tab-5">Paises</a></li>
			<li class="icn_world"><a href="#" id="id-tab-6">Ciudades</a></li>
			<li class="icn_language"><a href="#" id="id-tab-7">Lenguajes</a></li>
			<li class="icn_folder"><a href="#" id="id-tab-8">Tipos</a></li>
			<li class="icn_folder"><a href="#" id="id-tab-9">Commisiones</a></li>
			<li class="icn_categories"><a href="#" id="id-tab-10">Categorias</a></li>
			<li class="icn_tags"><a href="#" id="id-tab-11">Premios</a></li>
			<li class="icn_tags"><a href="#" id="id-tab-12">Badges</a></li>
			<li class="icn_messages"><a href="#" id="id-tab-13">Mensajes</a></li>
			<li class="icn_messages"><a href="#" id="id-tab-14">Pagos</a></li>
		</ul>
		<h3>Empresas Radio Taxi</h3>
		<ul class="toggle">
			<li class="icn_folder"><a href="#" id="id-tab-15">Empresas</a></li>
			<li class="icn_folder"><a href="#" id="id-tab-16">Taxis</a></li>
			<li class="icn_folder"><a href="#" id="id-tab-17">Estadisticas</a></li>
			<li class="icn_folder"><a href="#" id="id-tab-19">Calendarios</a></li>
		</ul>
		<h3>Admin</h3>
		<ul class="toggle">
			<li class="icn_settings"><a href="#" id="id-tab-20">Options</a></li>
			<li class="icn_security"><a href="#" id="id-tab-21">Security</a></li>
			<li class="icn_jump_back"><a href="<?= base_url()?>admin/user/logout">Logout</a></li>
		</ul>

		<!-- ICON SOCIALS-->
		<div id="icon_social_dashboard" class="frame100per ma1011">
			<a href="http://www.facebook.com/Solicitaxi"><img src="<?=base_url()?>images/icons/facebook.png"></a>
			<a href="http://twitter.com/SoliciTaxi"><img src="<?=base_url()?>images/icons/twitter.png" class="ma0001"></a>
			<a href="#"><img src="<?=base_url()?>images/icons/foursquare.png" class="ma0001"></a>
			<a href="#"><img src="<?=base_url()?>images/icons/linkedin.png" class="ma0001"></a>
		</div>
		<!-- END ICON SOCIALS-->

		<footer>
			<hr />
			<p><strong>Copyright &copy; <?= date('Y')?> Admin Backend Website</strong></p>
			<p>By <a href="<?= base_url()?>">SoliciTaxi</a></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		<div id="errordiv" style="display:none;">		
			<h4 class="alert_error"><span id="errormsg"><span></h4>
		</div>
		<div id="successbox" style="display:none;">
			<h4 class="alert_success"><span id="successmsg"><span></h4>
		</div>
		
		<div id="tabcontent">
		</div>
		<div class="spacer"></div>
	</section>
	
<script type="text/javascript">

//GENERIC CONTENT TAB LOADER BY TAB NUMBER
function loadtabcontentnum(loadurl, num) {
	$('#ajaxLoadAni').fadeIn( 'slow' );
	$('#tabcontent').fadeOut('slow');
	$('#tabcontent').load(loadurl, function(){
		$('#ajaxLoadAni').fadeOut('slow');
		$('#tabcontent').fadeIn('slow');
	});

/*		$.ajax({
				type: "post",
				url: loadurl,
				dataType: "html",
				data: { 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					$("#tabcontent").html(data);
				}
			});  
*/
};

function loadtabcontent(loadurl) {
	$('#ajaxLoadAni').fadeIn( 'slow' );
	$('#tabcontent').fadeOut('slow');
	
	$('#tabcontent').load(loadurl, function(){
		$('#ajaxLoadAni').fadeOut('slow');
		$('#tabcontent').fadeIn('slow');
	});
};

//SELECTED TAB IN SESSION
function settabsession(tab){
	$.ajax({
			type: "get",
			url: "<?=base_url()?>admin/dashboard/ajaxtabs/"+tab ,
			async : false,
			success: function(data) {
			}
		});
};

$(function() {
	// LOAD TAB 1 //
	$('#id-tab-1').click(function() {
		var tviewurl1 = '<?=base_url()?>admin/ajaxtabshome';
		//SET TAB STATUS ON SESSION
		settabsession('home');
		loadtabcontentnum(tviewurl1, 1);
	});
	// LOAD TAB 2 //
	$('#id-tab-2').click(function() {
		var tviewurl2 = '<?=base_url()?>admin/users';
		//SET TAB STATUS ON SESSION
		settabsession('users');
		loadtabcontentnum(tviewurl2, 2);
	});
	// LOAD TAB 3 //
	$('#id-tab-3').click(function() {
		var tviewurl3 = '<?=base_url()?>admin/users/viewClient';
		//SET TAB STATUS ON SESSION
		settabsession('clients');
		loadtabcontentnum(tviewurl3, 3);
	});
	// LOAD TAB 4 //
	$('#id-tab-4').click(function() {
         var tviewurl3 = '<?=base_url()?>admin/users/viewCorporativo';
        //SET TAB STATUS ON SESSION
        settabsession('corporativos');
        loadtabcontentnum(tviewurl3, 3);
	});
	// LOAD TAB 5 //
	$('#id-tab-5').click(function() {
//		var tviewurl5 = '<?=base_url()?>admin/admin/ajaxoptions';
		//SET TAB STATUS ON SESSION
		settabsession('options');
//		loadtabcontentnum(tviewurl5, 5);
		options_view('1');/*user_id*/
	});
	// LOAD TAB 6 //
	$('#id-tab-6').click(function() {
//		var tviewurl6 = '<?=base_url()?>admin/admin/ajaxsecurity';
		//SET TAB STATUS ON SESSION
		settabsession('security');
//		loadtabcontentnum(tviewurl5, 5);
		security_view('1');/*user_id*/
	});
	// LOAD TAB 7 //
	$('#id-tab-7').click(function() {
		var tviewurl7 = '<?=base_url()?>admin/manage';
		//SET TAB STATUS ON SESSION
		settabsession('manage');
		loadtabcontentnum(tviewurl7, 7);
	});
	// LOAD TAB 8 //
	$('#id-tab-8').click(function() {
		var tviewurl8 = '<?=base_url()?>admin/type';
		//SET TAB STATUS ON SESSION
		settabsession('type');
		loadtabcontentnum(tviewurl8, 8);
	});
	// LOAD TAB 9//
	$('#id-tab-9').click(function() {
		var tviewurl9 = '<?=base_url()?>admin/commission';
		//SET TAB STATUS ON SESSION
		settabsession('commission');
		loadtabcontentnum(tviewurl9, 9);
	});
	// LOAD TAB 11//
	$('#id-tab-11').click(function() {
		var tviewurl11 = '<?=base_url()?>admin/prize';
		//SET TAB STATUS ON SESSION
		settabsession('prize');
		loadtabcontentnum(tviewurl11, 11);
	});
	// LOAD TAB 10 //
/*	$('#id-tab-10').click(function() {
		var tviewurl10 = '<?=base_url()?>admin/airline';
		//SET TAB STATUS ON SESSION
		settabsession('airlines');
		loadtabcontentnum(tviewurl10, 10);
	});
*/	
		<? $tabcurrent = $this->session->userdata('tabcurrent');?>

		<?if ($tabcurrent == "home"){?>
			$('#id-tab-1').click();
		<?}elseif ($tabcurrent == "users"){?>
			$('#id-tab-2').click();
		<?}elseif ($tabcurrent == "adduser"){?>
			$('#id-tab-3').click();
		<?}elseif ($tabcurrent == "profile"){?>
			$('#id-tab-4').click();
		<?}elseif ($tabcurrent == "options"){?>
			$('#id-tab-5').click();
		<?}elseif ($tabcurrent == "security"){?>
			$('#id-tab-6').click();
		<?}elseif ($tabcurrent == "manage"){?>
			$('#id-tab-7').click();
		<?}elseif ($tabcurrent == "type"){?>
			$('#id-tab-8').click();
		<?}elseif ($tabcurrent == "commission"){?>
			$('#id-tab-9').click();
		<?}elseif ($tabcurrent == "prize"){?>
			$('#id-tab-11').click();
		<?}else{?>
			$('#id-tab-1').click();
		<?}?>
});

/*
***************************************
* v_userprofile users functions
***************************************
*/


	//ADD
	function v_userprofile_add(){
		loadtabcontent("<?=base_url()?>admin/users/ajaxadd");
/*		$( "#dialog_useradd" ).dialog( "destroy" );
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/users/ajaxadd",
				dataType: "html",
				data: { 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					$("#dialog_useradd").html(data);
					$("#dialog_useradd").dialog(
					{ 
						autoOpen: false,
						width: 550,
						modal: true
					});
				}
			});  
		$('#dialog_useradd').dialog('open');*/
	};
	
	//EDIT
	function v_userprofile_edit(iduser){
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/users/ajaxedit",
				dataType: "html",
				data: { 'id' : iduser, 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					//$('#ajaxLoadAni').fadeOut('slow');
					$("#tabcontent").html(data);
				}
			});
	};

function v_userprofile_editclient(iduser){
    $.ajax({
        type: "post",
        url: "<?=base_url()?>admin/users/ajaxeditclient",
        dataType: "html",
        data: { 'id' : iduser, 'rnd': new Date().getTime() },
        async: false,
        success: function(data) {
            //$('#ajaxLoadAni').fadeOut('slow');
            $("#tabcontent").html(data);
        }
    });
};

function v_userprofile_editcorporativo(iduser){
    $.ajax({
        type: "post",
        url: "<?=base_url()?>admin/users/ajaxeditcorporativo",
        dataType: "html",
        data: { 'id' : iduser, 'rnd': new Date().getTime() },
        async: false,
        success: function(data) {
            //$('#ajaxLoadAni').fadeOut('slow');
            $("#tabcontent").html(data);
        }
    });
};
	//PROFILE
	function v_userprofile_view(iduser){
//		loadtabcontent("<?=base_url()?>admin/users/ajaxedit");
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/users/ajaxprofile",
				dataType: "html",
				data: { 'id' : iduser, 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					//$('#ajaxLoadAni').fadeOut('slow');
					$("#tabcontent").html(data);
				}
			});
	};
	
	function options_view(iduser){
//		loadtabcontent("<?=base_url()?>admin/users/ajaxedit");
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/admin/ajaxoptions",
				dataType: "html",
				data: { 'id' : iduser, 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					//$('#ajaxLoadAni').fadeOut('slow');
					$("#tabcontent").html(data);
				}
			});
	};
	
	function security_view(iduser){
//		loadtabcontent("<?=base_url()?>admin/users/ajaxedit");
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/admin/ajaxsecurity",
				dataType: "html",
				data: { 'id' : iduser, 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					//$('#ajaxLoadAni').fadeOut('slow');
					$("#tabcontent").html(data);
				}
			});
	};
	
	//LOGIN
	function v_userprofile_login(iduser){
		window.location = '<?=base_url()?>admin/users/login/' + iduser;
	};
	
	//STATS
	function v_userprofile_stats(iduser){
		$( "#dialog_userstats" ).dialog( "destroy" );
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/users/ajaxstats",
				dataType: "html",
				data: { 'id' : iduser, 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					$("#dialog_userstats").html(data);
					$("#dialog_userstats").dialog(
					{ 
						autoOpen: false,
						width: 750,
						modal: true
					});
				}
			});  
		$('#dialog_userstats').dialog('open');
	};

function v_userprofile_block(id)
{
    //$( "#dialog_confirm_user" ).dialog( "destroy" );

    $( "#dialog_confirm_userblock" ).dialog({
        resizable: false,
        height:180,
        modal: true,
        buttons: {
            "<?= lang('users.tab.dialog.block');?>": function() {
                $( this ).dialog( "close" );

                $.ajax({
                    type: "post",
                    url: "<?=base_url()?>admin/users/ajaxblock" ,
                    dataType: "json",
                    data: { id: id, rnd: new Date().getTime() },
                    success: function(data) {
                        $().toastmessage('showToast', {
                            text     : '<?= lang('users.tab.dialog.blocked');?>',
                            no_sticky   : true,
                            position : 'middle-center',
                            type     : 'success',
                            closeText: ''
                        });
                        oAdminTableUsers.fnDraw();
                    }
                });

            },
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });

};

function v_userprofile_unblock(id)
{
    //$( "#dialog_confirm_user" ).dialog( "destroy" );

    $( "#dialog_confirm_userapprove" ).dialog({
        resizable: false,
        height:180,
        modal: true,
        buttons: {
            "<?= lang('users.tab.dialog.approve');?>": function() {
                $( this ).dialog( "close" );

                $.ajax({
                    type: "post",
                    url: "<?=base_url()?>admin/users/ajaxunblock" ,
                    dataType: "json",
                    data: { id: id, rnd: new Date().getTime() },
                    success: function(data) {
                        $().toastmessage('showToast', {
                            text     : '<?= lang('users.tab.dialog.approved');?>',
                            no_sticky   : true,
                            position : 'middle-center',
                            type     : 'success',
                            closeText: ''
                        });
                        oAdminTableUsers.fnDraw();
                    }
                });

            },
            Cancel: function() {
                $( this ).dialog( "close" );
            }
        }
    });

};
	

/*
***************************************
* type functions
***************************************
*/

	//ADD/EDIT
	function type_edit(id){
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/type/ajaxedit",
				dataType: "html",
				data: { 'id' : id, 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					//$('#ajaxLoadAni').fadeOut('slow');
					$("#tabcontent").html(data);
				}
			});  
/*		$( "#dialog_typeedit" ).dialog( "destroy" );
		
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/type/ajaxedit",
				dataType: "html",
				data: { 'id' : id, 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					$("#dialog_typeedit").html(data);
					$("#dialog_typeedit").dialog(
					{ 
						autoOpen: false,
						width: 850,
						modal: true
					});
				}
			});  
		$('#dialog_typeedit').dialog('open');*/
	};
	

	//DELETE
	function type_delete(id)
	{
		$( "#dialog_confirm_type" ).dialog( "destroy" );
	
		$( "#dialog_confirm_type" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"<?= lang('dialog.delete');?>": function() {
					$( this ).dialog( "close" );

					$.ajax({
						type: "post",
						url: "<?=base_url()?>admin/type/ajaxdelete" ,
						dataType: "json",
						data: { id: id, rnd: new Date().getTime() },
						success: function(data) {
							$().toastmessage('showToast', {
								text     : '<?= lang('dialog.deleted');?>',
								no_sticky   : true,
								position : 'middle-center',
								type     : 'success',
								closeText: ''
							});
							oAdminTableType.fnDraw();
							
							$('#successmsg').text(data.message);
							$('#successbox').show();
						}
					});

				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

	};	
	
/*
***************************************
* commission functions
***************************************
*/

	//ADD/EDIT
	function commission_edit(id){
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/commission/ajaxedit",
				dataType: "html",
				data: { 'id' : id, 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					//$('#ajaxLoadAni').fadeOut('slow');
					$("#tabcontent").html(data);
				}
			});  
	};
	

	//DELETE
	function commission_delete(id)
	{
		$( "#dialog_confirm_commission" ).dialog( "destroy" );
	
		$( "#dialog_confirm_commission" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"<?= lang('dialog.delete');?>": function() {
					$( this ).dialog( "close" );

					$.ajax({
						type: "post",
						url: "<?=base_url()?>admin/commission/ajaxdelete" ,
						dataType: "json",
						data: { id: id, rnd: new Date().getTime() },
						success: function(data) {
							$().toastmessage('showToast', {
								text     : '<?= lang('dialog.deleted');?>',
								no_sticky   : true,
								position : 'middle-center',
								type     : 'success',
								closeText: ''
							});
							oAdminTableCommission.fnDraw();
						}
					});

				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

	};	
	
/*
***************************************
* prize functions
***************************************
*/
	//ADD/EDIT
	function prize_edit(id){
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/prize/ajaxedit",
				dataType: "html",
				data: { 'id' : id, 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					//$('#ajaxLoadAni').fadeOut('slow');
					$("#tabcontent").html(data);
				}
			});  
	};

	//DELETE
	function prize_delete(id)
	{
		$( "#dialog_confirm_prize" ).dialog( "destroy" );
	
		$( "#dialog_confirm_prize" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"<?= lang('dialog.delete');?>": function() {
					$( this ).dialog( "close" );

					$.ajax({
						type: "post",
						url: "<?=base_url()?>admin/prize/ajaxdelete" ,
						dataType: "json",
						data: { id: id, rnd: new Date().getTime() },
						success: function(data) {
							$().toastmessage('showToast', {
								text     : '<?= lang('dialog.deleted');?>',
								no_sticky   : true,
								position : 'middle-center',
								type     : 'success',
								closeText: ''
							});
							oAdminTablePrize.fnDraw();
						}
					});
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	};	

/*
***************************************
* v_airline airlines functions
***************************************
*/


	//ADD/EDIT
	function v_airline_edit(id){
		$( "#dialog_airlineedit" ).dialog( "destroy" );
		
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/airline/ajaxedit",
				dataType: "html",
				data: { 'id' : id, 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					$("#dialog_airlineedit").html(data);
					$("#dialog_airlineedit").dialog(
					{ 
						autoOpen: false,
						width: 550,
						modal: true
					});
				}
			});  
		$('#dialog_airlineedit').dialog('open');
	};
	

	//DELETE
	function v_airline_delete(id)
	{
		$( "#dialog_confirm_airline" ).dialog( "destroy" );
	
		$( "#dialog_confirm_airline" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"<?= lang('airlines.tab.dialog.delete');?>": function() {
					$( this ).dialog( "close" );

					$.ajax({
						type: "post",
						url: "<?=base_url()?>admin/airline/ajaxdelete" ,
						dataType: "json",
						data: { id: id, rnd: new Date().getTime() },
						success: function(data) {
							$().toastmessage('showToast', {
								text     : '<?= lang('airlines.tab.dialog.deleted');?>',
								no_sticky   : true,
								position : 'middle-center',
								type     : 'success',
								closeText: ''
							});
							oAdminTableAirlines.fnDraw();
						}
					});

				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

	};	

/*
***************************************
* Badge functions
***************************************
*/


	//ADD/EDIT
	function v_badge_edit(id){
		$( "#dialog_badgeedit" ).dialog( "destroy" );
		
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/badges/ajaxedit",
				dataType: "html",
				data: { 'id' : id, 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					$("#dialog_badgeedit").html(data);
					$("#dialog_badgeedit").dialog(
					{ 
						autoOpen: false,
						width: 850,
						modal: true
					});
				}
			});  
		$('#dialog_badgeedit').dialog('open');
	};
	

	//DELETE
	function v_badge_delete(id)
	{
		$( "#dialog_confirm_badge" ).dialog( "destroy" );
	
		$( "#dialog_confirm_badge" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"<?= lang('dialog.delete');?>": function() {
					$( this ).dialog( "close" );

					$.ajax({
						type: "post",
						url: "<?=base_url()?>admin/badges/ajaxdelete" ,
						dataType: "json",
						data: { id: id, rnd: new Date().getTime() },
						success: function(data) {
							$().toastmessage('showToast', {
								text     : '<?= lang('dialog.deleted');?>',
								no_sticky   : true,
								position : 'middle-center',
								type     : 'success',
								closeText: ''
							});
							oAdminTableBadges.fnDraw();
						}
					});

				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

	};	
/*
***************************************
* Ads functions
***************************************
*/

	//ADD/EDIT
	function v_ads_edit(id){
		$( "#dialog_adsedit" ).dialog( "destroy" );
		
		$.ajax({
				type: "post",
				url: "<?=base_url()?>admin/ads/ajaxedit",
				dataType: "html",
				data: { 'id' : id, 'rnd': new Date().getTime() },
				async: false,
				success: function(data) {
					$("#dialog_adsedit").html(data);
					$("#dialog_adsedit").dialog(
					{ 
						autoOpen: false,
						width: 850,
						modal: true
					});
				}
			});  
		$('#dialog_adsedit').dialog('open');
	};
	

	//DELETE
	function v_ads_delete(id)
	{
		$( "#dialog_confirm_ads" ).dialog( "destroy" );
	
		$( "#dialog_confirm_ads" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"<?= lang('dialog.delete');?>": function() {
					$( this ).dialog( "close" );

					$.ajax({
						type: "post",
						url: "<?=base_url()?>admin/ads/ajaxdelete" ,
						dataType: "json",
						data: { id: id, rnd: new Date().getTime() },
						success: function(data) {
							$().toastmessage('showToast', {
								text     : '<?= lang('dialog.deleted');?>',
								no_sticky   : true,
								position : 'middle-center',
								type     : 'success',
								closeText: ''
							});
							oAdminTableAds.fnDraw();
						}
					});

				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

	};	
	
/*
***************************************
* Graphs Badges functions
***************************************
*/
var showDates = false;
//$("#doSearch").live("click", function () {
function filterSearchBagdes() {

	if($("#cb_filterbadgesthis").val() == "0")
	{
		alert("Please [Select] a Date Range");
		return false;
	}

	if(showDates && $("#txt_fromdatebadge").val() == "")
	{
		alert("Enter begin date");
		return false;
	}
	if(showDates && $("#txt_todatebadge").val() == "")
	{
		alert("Enter end date");
		return false;
	}
	if(showDates && ($("#txt_fromdatebadge").val() > $("#txt_todatebadge").val()))
	{
		alert("The initial date must be less than or equal to the final date");
		return false;
	}
	if(!$('#filter_badge_form').valid())
	{
		return false;
	}
	getBadgesStats();
};

function getBadgesStats()
{
	$('#graphContent').html("<img src='/images/ajax-loader.gif' border='0' />");
	
	var thisperiod = $("#cb_filterbadgesthis").val();
	var datefrom = $("#txt_fromdatebadge").val();
	var dateto = $("#txt_todatebadge").val();
	var byperiod = $("#cb_filterbadgesby").val();

	$.ajax({
		type: "post",
		url: "<?=base_url()?>admin/badges/getbadgestas" ,
		dataType: "html",
		data: { period: thisperiod, datefrom: datefrom, dateto: dateto, groupby: byperiod, rnd: new Date().getTime()},
		async:false,
		success: function(data) {
			$('#graphContent').html(data);
		}
	}); 
};

/*
***************************************
* Graphs Ads functions
***************************************
*/
var showDates = false;
//$("#doSearch").live("click", function () {
function filterSearchAds() {

	if($("#cb_filteradsthis").val() == "0")
	{
		alert("Please [Select] a Date Range");
		return false;
	}

	if(showDates && $("#txt_fromdateads").val() == "")
	{
		alert("Enter begin date");
		return false;
	}
	if(showDates && $("#txt_todateads").val() == "")
	{
		alert("Enter end date");
		return false;
	}
	if(showDates && ($("#txt_fromdateads").val() > $("#txt_todateads").val()))
	{
		alert("The initial date must be less than or equal to the final date");
		return false;
	}
	if(!$('#filter_ads_form').valid())
	{
		return false;
	}
	getAdsStats();
};

function getAdsStats()
{
	$('#graphContentAds').html("<img src='/images/ajax-loader.gif' border='0' />");
	
	var thisperiod = $("#cb_filteradsthis").val();
	var datefrom = $("#txt_fromdateads").val();
	var dateto = $("#txt_todateads").val();
	var byperiod = $("#cb_filteradsby").val();

	$.ajax({
		type: "post",
		url: "<?=base_url()?>admin/advertisement/getadsstats" ,
		dataType: "html",
		data: { period: thisperiod, datefrom: datefrom, dateto: dateto, groupby: byperiod, rnd: new Date().getTime()},
		async:false,
		success: function(data) {
			$('#graphContentAds').html(data);
		}
	}); 
};

/*
***************************************
* Flights Badges functions
***************************************
*/
function searchFlightsStat() {
/*	if(showDates && $("#txt_fromdate").val() == "")
	{
		alert("Enter begin date");
		return false;
	}
	if(showDates && $("#txt_todate").val() == "")
	{
		alert("Enter end date');?>");
		return false;
	}
*/
	if(!$('#filter_flights_form').valid())
	{
		return false;
	}
	getFlightsStats();
};

function getFlightsStats()
{
	$('#graphFlightsContent').html("<img src='/images/ajax-loader.gif' border='0' />");
	
	var option = $("#cb_filterflightsoption").val();
	var thisperiod = $("#cb_filterflightsthis").val();
	var qty = $("#cb_filterflightsqty").val();
	
	$.ajax({
		type: "post",
		url: "<?=base_url()?>admin/flights/getflightsstas" ,
		dataType: "html",
		data: { option: option, period: thisperiod, qty: qty, rnd: new Date().getTime()},
		async:false,
		success: function(data) {
			$('#graphFlightsContent').html(data);
		}
	}); 
};

/*
***************************************
* Graphs Stats Wide-Site functions
***************************************
*/
var showDates = false;
//$("#doSearch").live("click", function () {
function filterSearchStats() {

	if($("#cb_filterstatsthis").val() == "0")
	{
		alert("Please [Select] a Date Range");
		return false;
	}

	if(showDates && $("#txt_fromdatestats").val() == "")
	{
		alert("Enter begin date");
		return false;
	}
	if(showDates && $("#txt_todatestats").val() == "")
	{
		alert("Enter end date");
		return false;
	}
	if(showDates && ($("#txt_fromdatestats").val() > $("#txt_todatestats").val()))
	{
		alert("The initial date must be less than or equal to the final date");
		return false;
	}
	if(!$('#filter_stats_form').valid())
	{
		return false;
	}
	getStats();
};

function getStats()
{
	$('#graphContentStats').html("<img src='/images/ajax-loader.gif' border='0' />");
	
	var seloption = $("#cb_filterstatsoption").val();
	var thisperiod = $("#cb_filterstatsthis").val();
	var datefrom = $("#txt_fromdatestats").val();
	var dateto = $("#txt_todatestats").val();
	var byperiod = $("#cb_filterstatsby").val();

	$.ajax({
		type: "post",
		url: "<?=base_url()?>admin/stats/getstats" ,
		dataType: "html",
		data: { option: seloption,period: thisperiod, datefrom: datefrom, dateto: dateto, groupby: byperiod, rnd: new Date().getTime()},
		async:false,
		success: function(data) {
			$('#graphContentStats').html(data);
		}
	}); 
};
	//DELETE
	function urlreferral_delete(id)
	{
		$( "#dialog_confirm_url" ).dialog( "destroy" );
	
		$( "#dialog_confirm_url" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"<?= lang('dialog.delete');?>": function() {
					$( this ).dialog( "close" );

					$.ajax({
						type: "post",
						url: "<?=base_url()?>admin/stats/ajaxdelete" ,
						dataType: "json",
						data: { id: id, rnd: new Date().getTime() },
						success: function(data) {
							$().toastmessage('showToast', {
								text     : '<?= lang('dialog.deleted');?>',
								no_sticky   : true,
								position : 'middle-center',
								type     : 'success',
								closeText: ''
							});
							oAdminHomeUrlRefer.fnDraw();
						}
					});

				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

	};	

	//DELETE ALL LIST URL REFERRAL
	function urlreferral_deleteall()
	{
		$( "#dialog_confirm_url" ).dialog( "destroy" );
	
		$( "#dialog_confirm_url" ).dialog({
			resizable: false,
			height:180,
			modal: true,
			buttons: {
				"<?= lang('dialog.delete');?>": function() {
					$( this ).dialog( "close" );

					$.ajax({
						type: "post",
						url: "<?=base_url()?>admin/stats/ajaxdeleteall" ,
						dataType: "json",
						data: { rnd: new Date().getTime() },
						success: function(data) {
							$().toastmessage('showToast', {
								text     : '<?= lang('dialog.deleted');?>',
								no_sticky   : true,
								position : 'middle-center',
								type     : 'success',
								closeText: ''
							});
							oAdminHomeUrlRefer.fnDraw();
						}
					});

				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

	};	


</script>
