<div id="contentbadgedetail" class="frame100per">
	<div id="contentright_badgedetail" class="frame100per" >
		<div class="ma1000 pa2022 Border3330 ui-corner-right-gift overflow BgCelestial BgTransp90per font13px18px shadow" style="z-index:1;" >
			<div id="RightContentView">
				<div id="FormBadgeDetail" class="formsignup">
					<div class="frame95per TextAlignCenter">
						<h2 class="Blue"><?=$badgeearned->name?></h2><br/>
					</div>
					<div class="frame95per">

						<div class="frame70per" style="padding-left:140px">
							<div id="badge_detail" class="Border2px ui-corner-all-gift ma1 overflow BgImgGrayBottom">
								<div class="frame100per ma1000">
									<div class="frame100per TextAlignCenter divCenter" style="height:200px">
										<img src="<?=base_url()?><?=$badgeearned->image?>" width="550px" >
									</div>
								</div>
								<div class="frame100per">
									<div class="TextAlignCenter">
										<h4 class="Black">You've checked in 20 time in a month</h4>
										<h6 class="TextAlignCenter Gray">
											Unlocked by <a href="#"><?=$profile->firstname?></a> <?=date_format(date_create($badgeearned->date_earned), "d M, Y")?>
										</h6>
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

});

	
</script>
