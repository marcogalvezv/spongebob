<article class="module width_full">
	<header><h3>Options</h3></header>
	<form name="options-form" id="options-form" method="post">
		<div class="module_content">
			<fieldset class="width_quarter" style="margin-left:20px">
				<legend class="ui-corner-all"><b>Settings</b></legend>
				<div class="fieldset_content">
					<input type="checkbox" name="usersocial[]" id="check_FB" value="1" />
					Option 1
					<br/>
					<input type="checkbox" name="usersocial[]" id="check_TW" value="2" />
					Option 2
					<br/>
					<input type="checkbox" name="usersocial[]" id="check_TW" value="2" />
					Option 3
					<br/>
					<input type="checkbox" name="usersocial[]" id="check_TW" value="2" />
					Option 4
					<br/>
					<input type="checkbox" name="usersocial[]" id="check_TW" value="2" />
					Option 5
					<br/>
				</div>
			</fieldset>
		</div>

	<footer style="height:40px">
		<div class="submit_link">
			<input onclick="saveoptions()" value="<?= lang('users.tab.dialog.save');?>" type="button" />&nbsp;&nbsp;
			<input onclick="closeformoptions()" value="<?= lang('users.tab.dialog.cancel');?>" type="button" />
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