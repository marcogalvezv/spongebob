<div id="contentmyfriends" class="frame100per">
	<div id="contentright_myfriends" class="frame100per" >
		<div class="ma1000 pa2022 Border3330 ui-corner-right-gift overflow BgCelestial BgTransp90per font13px18px shadow" style="z-index:1;" >
			<div id="RightContentView">
				<div id="FormSignUpSmall" class="formsignup">
					<div class="frame50per">
						<h4 class="Blue"><?=$profile->firstname?>'s Friends</h4><br/>
					</div>
					<div class="frame45per" style="text-align:right;">
						<a id="lk_findFriends" href="<?=base_url()?>member/dashboard/findfriends">
							Find Friends
						</a>
					</div>
					<div class="frame95per">
						<?if(!empty($friends))foreach($friends as $friend):
							/*if($friend->status == "1" or $friend->uidinvitation != $profile->uid):*/?>
						<div class="frame3columns">
							<div id="friend_<?=$friend->firstname?>" class="Border2px ui-corner-all-gift ma1 overflow BgImgGrayBottom">
								<div class="frame100per">
									<div class="widget-header-panel ui-corner-top-gift overflow">
										<span class="ui-dialog-title">Member</span>
										<?if($own):?>
										<span class="ui-dialog-titlebar-close ui-corner-all frienddelete" friendid = "<?=$friend->uid?>" role="button">
											<span class="ui-icon ui-icon-closethick">close</span>
										</span>
										<?endif;?>
									</div>
								</div>
								<div class="frame100per ma1000">
									<div class="frame30per TextAlignCenter" style="height:70px">
										<? if((isset($friend->avatar))&&(! empty($friend->avatar))):?>
											<img src="<?=base_url().$friend->avatar?>" class="BorderImg5px" width="70%">
										<? else:?>
											<img src="<?=base_url()?>images/no_picture.jpg" class="BorderImg5px" width="70%">
										<? endif;?>
									</div>
									<div class="frame65per TextAlignLeft ma0010">
										<?if($own):?>
											<a href="<?=base_url()?>member/dashboard/profile/<?=$friend->uid?>"><b><?=$friend->firstname." ".$friend->lastname?></b></a><br/>
										<?else:?>
											<b><?=$friend->firstname." ".$friend->lastname?></b><br/>
										<?endif;?>
										<span class="Gray"><?=$friend->fullname?></span><br/>
										Last checked in:<br/>
										<span class="Blue">Perth Airport</span>
									</div>
									<?if($own && $friend->status=='0'):?>
									<div class="frame95per TextAlignCenter ma0010">
										<input type="button" class="addfriend" friendid="<?=$friend->uid?>"  value="Add as Friend"/>
									</div>
									<?else:?>
									<div class="frame95per TextAlignCenter ma0010" style="visibility:hidden">
										<input type="button" value=""/>
									</div>
									<?endif;?>
								</div>
<?/*								<div class="frame100per ma1000">
									<div class="frame30per TextAlignCenter" style="height:70px">
										<?if(file_exists($_SERVER['DOCUMENT_ROOT']."/upload/images/users/perfil_00$i.jpg")){?>
											<img src="<?=base_url()?>upload/images/users/perfil_00<?=$i?>.jpg" width="50px" class="BorderImg5px">
										<?}else{?>
											<img src="<?=base_url()?>upload/images/users/perfil_000.jpg" width="50px" class="BorderImg5px">
										<?}?>
									</div>
									<div class="frame65per TextAlignLeft">
										<b>Benjamin kara</b><br/>
										<span class="Gray">Australia</span><br/>
										Last checked in:<br/>
										<span class="Blue">Perth Airport</span>
									</div>
									<div class="frame95per TextAlignCenter ma1010">
										<input type="button" id="button_addAsFriend" value="Add as Friend"/>
									</div>
								</div>  */?>
							</div>
						</div>
						<?/*endif;*/ endforeach;?>
						<form id="formfriend" action="<?=base_url()?>member/dashboard/myfriends" method="post">
							<input type="text" name="friendid" id="textfriend" readonly="readonly" style="display:none"/>
							<input type="text" name="friendidAdd" id="textadd" readonly="readonly" style="display:none"/>
						</form>
					</div>
				</div>

			</div>

		</div>
	</div>

</div>

<script type="text/javascript">

/*function setHeight() {
//    var mydiv = document.getElementById("contentright_addflights");
    var mydiv = document.getElementById("contentrightmatches");
    var setdiv = document.getElementById("panel_myflights");
	
    var curr_height = parseInt(mydiv.style.height);
/*alert(curr_height);
alert(mydiv.style.height);
*/
/*    setdiv.style.height = curr_height +"px";
}
	*/
$(document).ready(function(){
		
	$( "input:submit").button();
	$( "input:button").button();

	/*$(".addfriend").click(function(){
		var friendid = $(this).attr("friendid");
		$("#textadd").attr("value",friendid);	
		$("#textadd").removeAttr("disabled");	
		$("#textfriend").attr("disabled","disabled");	
//		$("#formfriend").submit();
	});*/

	$(".frienddelete, .addfriend").click(function(){
		var friendid = $(this).attr("friendid");
		if($(this).hasClass("frienddelete")){
			$("#textfriend").attr("value",friendid);	
			$("#textadd").attr("disabled", "disabled");	
			$("#textfriend").removeAttr("disabled");
		}else{
			$("#textadd").attr("value",friendid);	
			$("#textadd").removeAttr("disabled");	
			$("#textfriend").attr("disabled","disabled");	
		}	
		$("#formfriend").submit();
	});

/*		var icons = {
			header: "ui-icon-circle-arrow-e",
			headerSelected: "ui-icon-circle-arrow-s"
		};
		$( "#accordion_menu_member" ).accordion({
			icons: icons
		});
		$( "#accordion_menu_share_find" ).accordion({
			icons: icons
		});


	$.metadata.setType("attr", "validate");
	$("#signupsmalluser_form").validate();

	$('#matches_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});

	$('#posts_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});

    ofrontTableMyFlights = $('#myflights_table').dataTable({
        'bServerSide'    : true,
        'bAutoWidth'     : false,
		"bJQueryUI": true,
        'sPaginationType': 'full_numbers',
        'sAjaxSource': '<?=base_url()?>flights/listener',
        'aoColumns' : [
            { 'sName': 'v_myflights.date_out'},
            { 'sName': 'v_myflights.code'},
            { 'sName': 'v_myflights.coutname'},
            { 'sName': 'v_myflights.cinname'},
            { 'sName': 'v_myflights.matches'},
            { 'sName': 'v_myflights.id',"bSortable": false, 'bSearchable': false }
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
		},
		"aoColumnDefs": [ 
			{ "sClass": "TextAlignLeft", "aTargets": [ 0,1,2,3 ] },
			{ "sClass": "TextAlignRight", "aTargets": [ 4 ] }
		]
    });
	$('#myflights_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});

	$("#btn_addflight").live("click", function () {
			$("#contentrightmatches").hide('fast');
			$("#contentright_addflights").show('fast');
	});
	$("#lk_closeAddFlight").live("click", function () {
//			$("#contentright_addflights").hide('slow');
			$("#contentright_addflights").hide('fast');
	});
	$("#lk_closeMatches").live("click", function () {
//			$("#contentright_addflights").hide('slow');
			$("#contentrightmatches").hide('fast');
	});

	//setHeight();*/
});

/*	function saveformpages()
	{
		$('#signupsmalluser_form').submit();
	}

	$('#signupsmalluser_form').submit(function() 
	{
		if(!$('#signupsmalluser_form').valid())
		{
			return false;
		}
		
/*		$.ajax({
			type: "post",
			url: "<?=base_url()?>user/register" ,
			dataType: "json",
			data: $('#signupsmalluser_form').serialize(),
			async: false,
			success: function(data) {
				if(data.success)
				{
					$().toastmessage('showToast', {
						text     : '<?= lang('shop.saved');?>',
						no_sticky : true,
						position : 'middle-center',
						type     : 'success',
						closeText: ''
					});
					window.location = data.successpage;
				}				
			}
		}); 
		return false;
	});
*/		
	
</script>
