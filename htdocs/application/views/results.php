<div id="allResults" class="frame100per">
	<h3 class="Red"><?= lang('search.title')?></h3>
	
	<div class="frame95per Black pa1" id="contentResults">
		<fieldset class="ui-corner-all frame95per">
			<div class="fila">
				<div class="col" style="width:250px"> <p class="TextAlignRight ma0100 Bold"><?= lang('community.filter.bycountry');?>:</p></div>
				<div class="col" style="width:400px" class="textbox" align="left">
				<select name="country" id="cb_country" style="width:200px">
				<option value='' selected="selected"><?=lang('home.allcountry');?></option>
				<?php foreach($countries as $country){?>
					<option value="<?= $country->name?>"><?= $country->fullname?></option>
				<?}?>
				</select>
				<input onclick="changeCountry()" value="<?= lang('community.button.bycountry');?>" type="button" />
				</div>
			</div>
			<br/>
				<table cellpadding="4" cellspacing="0" border="0" class="display" id="allresults_table">
					<thead>
						<tr>
							<th style="width: 10%"><b><?=lang('search.table.image');?></b></th>
							<th style="width: 40%"><b><?=lang('search.table.name');?></b></th>
							<th style="width: 10%"><b><?=lang('search.table.datecommenced');?></b></th>
							<th style="width: 30%"><b><?=lang('search.table.costs');?></b></th>
							<th style="width: 10%"><b><?=lang('search.table.action');?></b></th>
							<th style="width: 0%">country</th>
						</tr>
					</thead>
					<tbody>
					<?if(isset($offers)&&(!empty($offers))){
						foreach($offers as $offer){?>
						<tr>
							<td class="TextAlignCenter"><?if(isset($offer['filename'])){echo $offer['filename'];}else{?><img src="/images/noimage_product.png"><?}?></td>
							<td class="TextAlignLeft"><a href="<?=base_url()?>front/product/single/<?=$offer['id']?>"><?=$offer['name']?></a><br/><?if(strlen($offer['shortdesc'])<200) echo $offer['shortdesc']; else echo substr($offer['shortdesc'],0,200)."...";?></td>
							<td class="TextAlignLeft"></td>
							<td class="TextAlignLeft">
								<? if(strlen($offer['fullname']) > 10){?>
									<img src="<? if(file_exists($_SERVER['DOCUMENT_ROOT']."/images/elements/flags/30x20/".strtolower($offer['namecountry']).".png")){ echo "/images/elements/flags/30x20/".strtolower($offer['namecountry']).".png"; }else{ echo "/images/elements/flags/30x20/noflg.png";}?>" align="left" style="margin-right:2px;">
								<?}else{?>
									<img src="<? if(file_exists($_SERVER['DOCUMENT_ROOT']."/images/elements/flags/30x20/".strtolower($offer['namecountry']).".png")){ echo "/images/elements/flags/30x20/".strtolower($offer['namecountry']).".png"; }else{ echo "/images/elements/flags/30x20/noflg.png";}?>" align="bottom" style="margin-right:2px;">
								<?}?>
								<br/>
								<?= lang('front.checkout.vendor');?>: <?=$offer['nameshop']?><br/>
								<?= lang('front.checkout.unit');?>: <?=$offer['unit']?><br/>
								<?= lang('front.checkout.unitprice');?>: $<?=$offer['unit_price']?> (<?=$offer['currcountry']?>)<br/>
								<?= lang('single.shipcost');?>: $<?=$offer['shipcost']?> (<?=$offer['currcountry']?>)p/u
							</td>
							<td class="TextAlignCenter"><a href="<?=base_url()?>front/product/single/<?=$offer['id']?>"><img src="/images/elements/buttons/cart.png" /></a></td>
							<td class="TextAlignLeft"><?=$offer['namecountry']?></td>
						</tr>
						<?}?>
					<?}?>
					<?if((isset($projects)) &&(!empty($projects))){
						foreach($projects as $project){?>
						<tr>
							<td class="TextAlignCenter"><img src="<?=$project['logo']?>" /></td>
							<td class="TextAlignLeft"><a href="<?=base_url()?>front/project/details/<?=$project['id']?>"><?=$project['name']?></a><br/><?if(strlen($project['description'])<200) echo $project['description']; else echo substr($project['description'],0,200)."...";?></td>
							<td class="TextAlignLeft"><?=$project['date']?></td>
							<td class="TextAlignLeft">
								<?= lang('community.table.amountneeded');?>: $<?=$project['amount_required']?><br/>
								<?= lang('community.table.amountfunded');?>: $<?=$project['amount_funded']?><br/>
								<?= lang('community.table.amountdonated');?>: $<?=$project['donation']?><br/>
								<?= lang('community.table.stillneeded');?>: $<?=($project['amount_required']-$project['amount_funded']-$project['donation'])?>
							</td>
							<td class="TextAlignCenter"><a href="<?=base_url()?>front/project/donations/<?=$project['id']?>"><img src="/images/elements/icons/paypal_donate.png" /></a></td>
							<td class="TextAlignLeft"><?=$project['country']?></td>
						</tr>
						<?}?>
					<?}?>
					<tfoot>
						<tr>
							<th class="TextAlignCenter"><?=lang('search.table.image');?></th>
							<th class="TextAlignLeft"><?=lang('search.table.name');?></th>
							<th class="TextAlignLeft"><?=lang('search.table.datecommenced');?></th>
							<th class="TextAlignLeft"><?=lang('search.table.costs');?></th>
							<th class="TextAlignCenter"><?=lang('search.table.action');?></th>
							<th class="TextAlignLeft">country</th>
						</tr>
					</tfoot>
					</tbody>
				</table>
		</fieldset>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function()
{	
	$( "input:submit").button();
	$( "input:button").button();
		
	$('#allresults_table').styleTable({
		tr_hover_bgcolor: '#BCD4EC'
	});

	oFrontTableResults = $('#allresults_table').dataTable({
		"bJQueryUI": true,
        'sPaginationType': 'full_numbers',
        'aoColumns' : [
            { 'sName': '<?=lang('search.table.logo');?>',"bSortable": false, 'bSearchable': false },
            { 'sName': '<?=lang('search.table.name');?>'},
            { 'sName': '<?=lang('search.table.datecommenced');?>'},
            { 'sName': '<?=lang('search.table.costs');?>' },
            { 'sName': '<?=lang('search.table.action');?>',"bSortable": false, 'bSearchable': false },
            { 'sName': 'country' }
        ],
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
			{ "sClass": "TextAlignLeft", "aTargets": [ 1,3 ] },
			{ "sClass": "TextAlignRight", "aTargets": [ 2 ] },
			{ "sClass": "TextAlignCenter", "aTargets": [ 0,4,5 ] }
		]
    });
	oFrontTableResults.fnSetColumnVis (5, false );

});
	function changeCountry(){
		//config DataTable
		var country = document.getElementById("cb_country").value;

		oFrontTableResults.fnFilter( country, 5 );
		//Refresh DataTable
		//oAdminTableProject.fnDraw();
	}

</script>
