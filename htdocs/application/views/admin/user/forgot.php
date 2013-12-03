<div id="contentdiv" align="center">
	<div class="ui-widget">
		<? 	$message = $this->session->flashdata('message');
			if(!empty($message)){
		?>
		<div style="padding: 0 .7em;" class="ui-state-error ui-corner-all"> 
			<p><span style="float: left; margin-right: .3em;" class="ui-icon ui-icon-alert"></span> 
			<strong>Error:</strong> <?= $message?></p>
		</div>
		<br />
		<?}?>
	</div>
	<form id="forgotform" method="post" action="<?= base_url()?>admin/user/forgot">
		<h1>Recuperar Contrase&ntilde;a</h1>
		<fieldset class="inputs">
			<div class="inputfields"> 
				<label>Email:</label><input id="memail" name="profile[email]" type="text" placeholder="Email" Title="Ingresar Email Valido" autofocus required email="true" />
			</div>
			<div class="clear"></div> 
			<div class="actions">
				<button type="submit" id="submit" value="Recuperar">Recuperar</button>
				<a href="<?= base_url()?>admin/user/login">Iniciar Sesion?</a>
			</div>
		</fieldset>
	</form>
</div>
<script type="text/javascript">
   $(document).ready(function(){
		$("#forgotform").validate();		
 	});

	$('#forgotform').submit(function() {
		if(!$('#forgotform').valid())
		{
			return false;
		} 
	});	
	
	$('#submitbutton').click(function() {
		$('#forgotform').submit();
		return false;
	});
</script>