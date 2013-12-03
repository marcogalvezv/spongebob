<div class="form90per" id="successPanel">
	<h3 class="titlefront"><?= $title;?></h3>
	<?/*<div class="breadcrumbs"><?= implode(' > ', $breads);?></div>*/?>
	<div class="form90per" id="successtext">
		<p><?= $text;?></p>
	</div>
	<?if(!empty($text2)){?>
	<div class="form90per" id="successtext2">
		<p><?= $text2;?></p>
	</div>	
	<?}?>
	<?if(!empty($text3)){?>
	<div class="form90per" id="successtext2">
		<p><?= $text3;?></p>
	</div>	
	<?}?>
	<?/*<div class="fila" align="left">
	<div class="col" style="width:100%; text-align:center;" align="center">
		<input onclick="submitform();" value="<?= lang('front.success.continue');?>" type="button" />
	</div>
	</div>*/?>
</div>

<script type="text/javascript">
	$(document).ready(function()
	{
		$( "input:submit").button();
		$( "input:button").button();
	});
		
	function submitform()
	{
		window.location = '<?= $link;?>';
	}
</script>