<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<!-- Themer (Remove if not needed) -->
<div id="mws-themer">
    <div id="mws-themer-content">
        <div id="mws-themer-ribbon"></div>
        <div id="mws-themer-toggle">
            <i class="icon-bended-arrow-left"></i>
            <i class="icon-bended-arrow-right"></i>
        </div>
        <div id="mws-theme-presets-container" class="mws-themer-section">
            <label for="mws-theme-presets">Color Presets</label>
        </div>
        <div class="mws-themer-separator"></div>
        <div id="mws-theme-pattern-container" class="mws-themer-section">
            <label for="mws-theme-patterns">Background</label>
        </div>
        <div class="mws-themer-separator"></div>
        <div class="mws-themer-section">
            <ul>
                <li class="clearfix"><span>Base Color</span> <div id="mws-base-cp" class="mws-cp-trigger"></div></li>
                <li class="clearfix"><span>Highlight Color</span> <div id="mws-highlight-cp" class="mws-cp-trigger"></div></li>
                <li class="clearfix"><span>Text Color</span> <div id="mws-text-cp" class="mws-cp-trigger"></div></li>
                <li class="clearfix"><span>Text Glow Color</span> <div id="mws-textglow-cp" class="mws-cp-trigger"></div></li>
                <li class="clearfix"><span>Text Glow Opacity</span> <div id="mws-textglow-op"></div></li>
            </ul>
        </div>
        <div class="mws-themer-separator"></div>
        <div class="mws-themer-section">
            <button class="btn btn-danger small" id="mws-themer-getcss">Get CSS</button>
        </div>
    </div>
    <div id="mws-themer-css-dialog">
        <form class="mws-form">
            <div class="mws-form-row">
                <div class="mws-form-item">
                    <textarea cols="auto" rows="auto" readonly="readonly"></textarea>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Themer End -->

<!-- Header -->
<div id="mws-header" class="clearfix">

    <!-- Logo Container -->
    <div id="mws-logo-container">

        <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        <div id="mws-logo-wrap">
            <img src="<?= base_url()?>images/admin/mws-logo.png" alt="mws admin">
        </div>
    </div>

    <!-- User Tools (notifications, logout, profile, change password) -->
    <div id="mws-user-tools" class="clearfix">

        <!-- Notifications -->
        <div id="mws-user-notif" class="mws-dropdown-menu">
            <a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-exclamation-sign"></i></a>

            <!-- Unread notification count -->
            <span class="mws-dropdown-notif">35</span>

            <!-- Notifications dropdown -->
            <div class="mws-dropdown-box">
                <div class="mws-dropdown-content">
                    <ul class="mws-notifications">
                        <li class="read">
                            <a href="#">
                                    <span class="message">
                                        Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                            </a>
                        </li>
                        <li class="read">
                            <a href="#">
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                            </a>
                        </li>
                        <li class="unread">
                            <a href="#">
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                            </a>
                        </li>
                        <li class="unread">
                            <a href="#">
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                            </a>
                        </li>
                    </ul>
                    <div class="mws-dropdown-viewall">
                        <a href="#">View All Notifications</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages -->
        <div id="mws-user-message" class="mws-dropdown-menu">
            <a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-envelope"></i></a>

            <!-- Unred messages count -->
            <span class="mws-dropdown-notif">35</span>

            <!-- Messages dropdown -->
            <div class="mws-dropdown-box">
                <div class="mws-dropdown-content">
                    <ul class="mws-messages">
                        <li class="read">
                            <a href="#">
                                <span class="sender">John Doe</span>
                                    <span class="message">
                                        Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                            </a>
                        </li>
                        <li class="read">
                            <a href="#">
                                <span class="sender">John Doe</span>
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                            </a>
                        </li>
                        <li class="unread">
                            <a href="#">
                                <span class="sender">John Doe</span>
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                            </a>
                        </li>
                        <li class="unread">
                            <a href="#">
                                <span class="sender">John Doe</span>
                                    <span class="message">
                                        Lorem ipsum dolor sit amet
                                    </span>
                                    <span class="time">
                                        January 21, 2012
                                    </span>
                            </a>
                        </li>
                    </ul>
                    <div class="mws-dropdown-viewall">
                        <a href="#">View All Messages</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Information and functions section -->
        <div id="mws-user-info" class="mws-inset">

            <!-- User Photo -->
            <div id="mws-user-photo">
                <img src="example/profile.jpg" alt="User Photo">
            </div>

            <!-- Username and Functions -->
            <div id="mws-user-functions">
                <div id="mws-username">
                    Hola, <?= $this->Systemmodel->user()->username; ?>
                </div>
                <ul>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Change Password</a></li>
                    <li><a href="<?= base_url()?>admin/user/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Start Main Wrapper -->
<div id="mws-wrapper">

    <!-- Necessary markup, do not remove -->
    <div id="mws-sidebar-stitch"></div>
    <div id="mws-sidebar-bg"></div>

    <!-- Sidebar Wrapper -->
    <div id="mws-sidebar">

        <!-- Hidden Nav Collapse Button -->
        <div id="mws-nav-collapse">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <!-- Main Navigation -->
        <div id="mws-navigation">
            <ul>

                <li>
                    <a href="#"><i class="icon-users"></i>Usuarios</a>
                    <ul>
                        <li><a href="#" id="id-tab-1">Reservas</a></li>
                        <li><a href="#" id="id-tab-2">Taxis</a></li>
                        <li><a href="#" id="id-tab-3">Conductores</a></li>
                        <li><a href="#" id="id-tab-4">Clientes</a></li>
                        <li><a href="#" id="id-tab-5">Operadores</a></li>
                    </ul>
                </li>
                <li>

                </li>
            </ul>
        </div>
    </div>

    <!-- Main Container Start -->
    <div id="mws-container" class="clearfix">

        <!-- Inner Container Start -->
        <div class="container" id="tabcontent">
            <!-- Panels Start -->
            <div id="errordiv" style="display:none;">
                <h4 class="alert_error"><span id="errormsg"><span></h4>
            </div>
            <div id="successbox" style="display:none;">
                <h4 class="alert_success"><span id="successmsg"><span></h4>
            </div>

            <div class="mws-panel grid_5">
                <div class="mws-panel-header">
                    <span><i class="icon-graph"></i> Charts</span>
                </div>
                <div class="mws-panel-body">
                    <div id="mws-dashboard-chart" style="height: 222px;"></div>
                </div>
            </div>


            </form>
        </div>
    </div>


    <!-- Panels End -->
</div>
<!-- Inner Container End -->

<!-- Footer -->
<!--<div id="mws-footer">-->
<!--    Copyright Your Website 2012. All Rights Reserved.-->
<!--</div>-->

</div>
<!-- Main Container End -->

</div>



<script type="text/javascript">

//GENERIC CONTENT TAB LOADER BY TAB NUMBER
function loadtabcontentnum(loadurl, num) {
    $('#ajaxLoadAni').fadeIn( 'slow' );
    $('#tabcontent').fadeOut('slow');
    $('#tabcontent').load(loadurl, function(){
        $('#ajaxLoadAni').fadeOut('slow');
        $('#tabcontent').fadeIn('slow');
    });
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
        var tviewurl1 = '<?=base_url()?>admin/defaultmap';
        //SET TAB STATUS ON SESSION
        settabsession('home');
        loadtabcontentnum(tviewurl1, 1);
    });
    // LOAD TAB 2 //
    $('#id-tab-2').click(function() {
        var tviewurl2 = '<?=base_url()?>radiotaxi/taxi';
        //SET TAB STATUS ON SESSION
        settabsession('users');
        loadtabcontentnum(tviewurl2, 2);
    });
    // LOAD TAB 3 //
    $('#id-tab-3').click(function() {
        var tviewurl3 = '<?=base_url()?>radiotaxi/users/viewDriver';
        //SET TAB STATUS ON SESSION
        settabsession('drivers');
        loadtabcontentnum(tviewurl3, 3);
    });
    // LOAD TAB 4 //
    $('#id-tab-4').click(function() {
        var tviewurl4 = '<?=base_url()?>radiotaxi/users/viewClient';
        //SET TAB STATUS ON SESSION
        settabsession('corporativos');
        loadtabcontentnum(tviewurl4, 4);
    });
    // LOAD TAB 5 //
    $('#id-tab-5').click(function() {
        var tviewurl5 = '<?=base_url()?>admin/users/viewCompany';
        //SET TAB STATUS ON SESSION
        settabsession('company');
        loadtabcontentnum(tviewurl5, 5);
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
    $('#id-tab-17').click(function() {
        var tviewurl17 = '<?=base_url()?>admin/defaultmap';
        //SET TAB STATUS ON SESSION
        settabsession('map');
        loadtabcontentnum(tviewurl17, 17);
    });
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

function v_userprofile_editdriver(iduser){
    $.ajax({
        type: "post",
        url: "<?=base_url()?>radiotaxi/users/ajaxeditdriver",
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
        url: "<?=base_url()?>radiotaxi/users/ajaxeditclient",
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

</script>
