<article class="module width_full">
	<header><h3>Security</h3></header>
	<form name="options-form" id="options-form" method="post">
		<div class="module_content">
			<fieldset class="width_quarter" style="margin-left:20px">
				<legend class="ui-corner-all"><b>Settings</b></legend>
				<div class="fieldset_content">
					<input type="checkbox" name="usersocial[]" id="check_FB" value="1" />
					Option Security 1
					<br/>
					<input type="checkbox" name="usersocial[]" id="check_TW" value="2" />
					Option Security 2
					<br/>
					<input type="checkbox" name="usersocial[]" id="check_TW" value="2" />
					Option Security 3
					<br/>
					<input type="checkbox" name="usersocial[]" id="check_TW" value="2" />
					Option Security 4
					<br/>
					<input type="checkbox" name="usersocial[]" id="check_TW" value="2" />
					Option Security 5
					<br/>
					<input type="checkbox" name="usersocial[]" id="check_TW" value="2" />
					Option Security 6
					<br/>
					<input type="checkbox" name="usersocial[]" id="check_TW" value="2" />
					Option Security 7
					<br/>
					<input type="checkbox" name="usersocial[]" id="check_TW" value="2" />
					Option Security 8
					<br/>
				</div>
			</fieldset>
		</div>

	<footer style="height:40px">
		<div class="submit_link">
			<input onclick="savesecurity()" value="<?= lang('users.tab.dialog.save');?>" type="button" />&nbsp;&nbsp;
			<input onclick="closeformsecurity()" value="<?= lang('users.tab.dialog.cancel');?>" type="button" />
		</div>
	</footer>
	</form>
</article>

<!--SCRIPTS REC-->

<script type="text/javascript">
$(document).ready(function()
{
	$('#errordiv').hide();
	$('#successbox').hide();
	$("input:button").button();
		
});
</script>