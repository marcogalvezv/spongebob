<style>
    .fg-toolbar{
        height:25px;
    }
</style>
<div class="mws-panel grid_8">
    <form name="admin_members_form" id="admin_members_form" method="post" class="mws-form">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i>Clientes</span>
        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table" id="v_userprofiletable">
                <thead>
                <tr>
                    <th "width: 5%"><?= lang('users.tab.select');?></th>
                    <th "width: 5%"><?= lang('users.tab.uid');?></th>
                    <th "width: 15%"><?= lang('users.tab.name');?></th>
                    <th "width: 15%"><?= lang('users.tab.email');?></th>
                    <!--                    <th "width: 7%">--><?//= lang('users.tab.activated');?><!--</th>-->
                    <th "width: 7%"><?= lang('users.tab.approved');?></th>
                    <th "width: 15%" ><?= lang('users.tab.created');?></th>
                    <th "width: 18%" ><?= lang('users.tab.actions');?></th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?= lang('datatable.loading');?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <footer style="height:40px">
            <div class="mws-button-row">
                <input onclick="v_userprofile_editclient()" value="<?= lang('users.tab.add');?>" type="button"
                       class="btn"/>
                <input onclick="blockusers()" value="<?= lang('users.tab.block');?>" type="button" class="btn"/>
                <input onclick="approveusers()" value="<?= lang('users.tab.approve');?>" type="button" class="btn"/>
            </div>
        </footer>
    </form>
</div>

<!-- Panels End -->
</div>



</article><!-- end of contentform article -->

<!--DIALOG ADD!-->
<div id="dialog_useradd" title="<?= lang('users.tab.dialog.addtitle');?>" style="display:none; overflow:hidden;">
</div><!--/dialog!-->

<!--DIALOG EDIT!-->
<div id="dialog_useredit" title="<?= lang('users.tab.dialog.title');?>" style="display:none; overflow:hidden;">
</div><!--/dialog!-->

<!--DIALOG STATS!-->
<div id="dialog_userstats" title="<?= lang('users.stats.dialog.title');?>" style="display:none; overflow:hidden;">
</div><!--/dialog!-->

<!--DIALOG CONFIRMATION!-->
<div id="dialog_confirm_userblock" title="<?= lang('users.tab.dialog.confirmation');?>" style="display:none;">
    <p>
        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
        <?= lang('users.tab.dialog.msgofblock');?>
    </p>
</div>
<div id="dialog_confirm_userapprove" title="<?= lang('users.tab.dialog.confirmation');?>" style="display:none;">
    <p>
        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
        <?= lang('users.tab.dialog.msgofapprove');?>
    </p>
</div>

<!--DIALOG CONFIRMATION BLOCK!-->
<div id="dialog_confirm_bulk_userblock" title="<?= lang('users.tab.dialog.confirmblock');?>" style="display:none;">
    <p>
        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
        <?= lang('users.tab.dialog.msgofbulkblock');?>
    </p>
</div>
<!--DIALOG CONFIRMATION APPROVE!-->
<div id="dialog_confirm_bulk_userapprove" title="<?= lang('users.tab.dialog.confirmapprove');?>" style="display:none;">
    <p>
        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
        <?= lang('users.tab.dialog.msgofbulkapprove');?>
    </p>
</div>
<div id="dialog_error_user" title="<?= lang('users.tab.errordelete');?>" style="display:none;">
    <p>
        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
        <?= lang('users.tab.dialog.msgoferrordelete');?>
    </p>
</div>

<script type="text/javascript">

    function blockusers()
    {
//TODO: Check if this could be removed
        //$( "#dialog_confirm_userblock" ).dialog( "destroy" );

        $( "#dialog_confirm_bulk_userblock" ).dialog({
            resizable: false,
            height:180,
            modal: true,
            buttons: {
                "<?= lang('users.tab.dialog.block');?>": function() {
                    $( this ).dialog( "close" );
                    $.ajax({
                        type: "post",
                        url: "<?=base_url()?>admin/users/ajaxstatusbulk" ,
                        dataType: "json",
                        data: $('#admin_members_form').serialize() + '&status=0',
                        success: function(data) {
                            if(data.success)
                            {
                                $().toastmessage('showToast', {
                                    text     : '<?= lang('users.tab.dialog.blocked');?>',
                                    no_sticky   : true,
                                    position : 'middle-center',
                                    type     : 'success',
                                    closeText: ''
                                });
                                oAdminTableUsers.fnDraw();

                                $('#successmsg').text(data.message);
                                $('#successbox').show();
                            } else {
                                $('#errormsg').text(data.message);
                                $('#errordiv').show();
                            }
                        }
                    });

                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        return false;
    };

    function approveusers()
    {

        //$( "#dialog_confirm_userapprove" ).dialog( "destroy" );

        $( "#dialog_confirm_bulk_userapprove" ).dialog({
            resizable: false,
            height:180,
            modal: true,
            buttons: {
                "<?= lang('users.tab.dialog.approve');?>": function() {
                    $( this ).dialog( "close" );
                    $.ajax({
                        type: "post",
                        url: "<?=base_url()?>admin/users/ajaxstatusbulk" ,
                        dataType: "json",
                        data: $('#admin_members_form').serialize() + '&status=1',
                        success: function(data) {
                            if(data.success)
                            {
                                $().toastmessage('showToast', {
                                    text     : '<?= lang('users.tab.dialog.approved');?>',
                                    no_sticky   : true,
                                    position : 'middle-center',
                                    type     : 'success',
                                    closeText: ''
                                });
                                oAdminTableUsers.fnDraw();

                                $('#successmsg').text(data.message);
                                $('#successbox').show();
                            } else {
                                $('#errormsg').text(data.message);
                                $('#errordiv').show();
                            }
                        }
                    });

                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
        return false;
    };


    $(document).ready(function(){
        oAdminTableUsers = $('#v_userprofiletable').dataTable({
            'bServerSide'    : true,
            'bAutoWidth'     : false,
            // "bJQueryUI": true,
            'sPaginationType': 'full_numbers',
            'sAjaxSource': '<?= base_url()?>radiotaxi/users/listenerClient',
            'aoColumns' : [
                { 'sName': 'v_userprofile.selected'},
                { 'sName': 'v_userprofile.uid'},
                { 'sName': 'v_userprofile.name'},
                { 'sName': 'v_userprofile.email' },
//                { 'sName': 'v_userprofile.activated' },
                { 'sName': 'v_userprofile.status' },
                { 'sName': 'v_userprofile.signupdate' },
                { 'sName': 'v_userprofile.id',"bSortable": false, 'bSearchable': false }
            ],
            'fnServerData': function(sSource, aoData, fnCallback){
                $.ajax({
                    'dataType': 'json',
                    'type': 'POST',
                    'url': sSource,
                    'data': aoData,
                    'success': fnCallback
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
                    "sFirst":    "<?= lang('datatable.First');?>",
                    "sPrevious": "<?= lang('datatable.Previous');?>",
                    "sNext":     "<?= lang('datatable.Next');?>",
                    "sLast":     "<?= lang('datatable.Last');?>"
                }
            }

        });
    });

</script>