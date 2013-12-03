<div id="contentmybadges" class="frame100per">
	<div id="contentright_mybadges" class="frame100per" >
		<div class="ma1000 pa2022 Border3330 ui-corner-right-gift overflow BgCelestial BgTransp90per font13px18px shadow" style="z-index:1;" >
			<div id="RightContentView">
				<div id="FormMyBadges" class="formsignup">
					<div class="frame50per">
						<h4 class="Blue"><?=$profile->firstname?>'s Badges</h4><br/>
					</div>
					<div class="frame45per" style="text-align:right;">
					</div>
					<div class="frame95per">
						<?if(!empty($badgeearned)) foreach($badgeearned as $badge):?>
						<div class="frame4columns">
							<?if($own):?><a href="<?=base_url()?>member/dashboard/badgedetail/<?=$badge->idbadge?>"><?endif;?>
							<div id="" class="Border2px ui-corner-all-gift ma1 overflow BgImgGrayBottom">
								<div class="frame100per ma1000">
									<div class="frame100per TextAlignCenter divCenter" style="height:60px">
										<img src="<?=base_url().$badge->filename?>" width="150px" >
									</div>
								</div>
								<div class="frame100per">
									<div class="TextAlignCenter">
										<h6 class="Black"><?=$badge->name?></h6>
										<p class="TextAlignCenter Gray">
											<?=date_format(date_create($badge->updated), "Y-m-d")?>
										</p>
									</div>
								</div>
							</div>
							<?if($own):?></a><?endif;?>
						</div>
						<?endforeach;?>
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
