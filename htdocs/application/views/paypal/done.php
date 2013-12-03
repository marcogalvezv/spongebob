<div class="form90per" id="successPanel">
	<h3 class="titlefront"><?= lang('front.paypal.title.success')?></h3>
	<div id="successPanelInformation" class="rail BgWhite ui-corner-all-gift frame90per">
		<div class="form90per" id="successtext">
			<p>TOKEN: <?= $token;?></p>
			<p>PAYER ID: <?= $payerID;?></p><br/>
			<p>ORDER ID: <?if(isset($idorders)) echo $idorders;?></p>
		</div>
		<div class="fila" align="left">
			<div class="col" style="width:100%; text-align:center;" align="center">
				<input onclick="submitform();" value="<?= lang('front.success.continue');?>" type="button" />
			</div>
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