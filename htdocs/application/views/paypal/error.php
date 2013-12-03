<div class="form90per" id="successPanel">
	<h3 class="titlefront"><?= lang('front.paypal.title')?></h3>
	<div class="form90per" id="successtext">
		<p>ERROR: <?= $error;?></p>
	</div>
	<div class="fila" align="left">
	<div class="col" style="width:100%; text-align:center;" align="center">
		<input onclick="submitform();" value="<?= lang('front.success.continue');?>" type="button" />
	</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function()
	{
		$( "input:submit").button();
		$( "input:button").button();
	});
		
	function submitform()
	{
		window.location = '<?= $continue;?>';
	}
</script>