<?php
$name = array(
	'name'	=> 'name',
	'id'	=> 'name',
	'maxlength'	=> 255,
	'size'	=> 30
);
$code = array(
	'name'	=> 'code',
	'id'	=> 'code',
	'maxlength'	=> 255,
	'size'	=> 30
);
$description = array(
	'name'	=> 'description',
	'id'	=> 'description',
	'maxlength'	=> 255,
	'size'	=> 30
);
$is_manufactured = array(
	'name'	=> 'is_manufactured',
	'id'	=> 'is_manufactured',
	'value'	=> 1,
	'style' => 'margin:0;padding:0'
);
$is_sales_ready = array(
	'name'	=> 'is_sales_ready',
	'id'	=> 'is_sales_ready',
	'value'	=> 1,
	'style' => 'margin:0;padding:0'
);
$quantity = array(
	'name'	=> 'quantity',
	'id'	=> 'quantity',
	'maxlength'	=> 10,
	'size'	=> 30
);
$weight_value = array(
	'name'	=> 'weight_value',
	'id'	=> 'weight_value',
	'maxlength'	=> 14,
	'size'	=> 30
);
$weight_per_units = array(
	'name'	=> 'weight_per_units',
	'id'	=> 'weight_per_units',
	'maxlength'	=> 10,
	'size'	=> 30
);
$cost_value = array(
	'name'	=> 'cost_value',
	'id'	=> 'cost_value',
	'maxlength'	=> 14,
	'size'	=> 30
);
$cost_per_units = array(
	'name'	=> 'cost_per_units',
	'id'	=> 'cost_per_units',
	'maxlength'	=> 10,
	'size'	=> 30
);
$sales_price_value = array(
	'name'	=> 'sales_price_value',
	'id'	=> 'sales_price_value',
	'maxlength'	=> 14,
	'size'	=> 30
);
$sales_price_per_units = array(
	'name'	=> 'sales_price_per_units',
	'id'	=> 'sales_price_per_units',
	'maxlength'	=> 10,
	'size'	=> 30
);
?>
<div class="column_01">
	<div class="menu_inline">
		<ul>
			<li>
				<?php echo anchor('/inventory/stockroom', 'Stockroom'); ?>
			</li>
			<li class="sub selected">
				<?php echo anchor('/inventory/stockroom/new_item', 'Create New Item'); ?>
			</li>
		</ul>
	</div>
</div>

<div class="column_02">
	<div class="content">
		<h2 class="title_02">New Item</h2>
		<div class="block_01">
		
		<ul class="form-layout">
			<li>
				<label for="name" class="label-top">Name</label>
				<input type="text" id="name" name="name" size="50" />
			</li>
			<li>
				<div class="split-left">
					<label for="code" class="label-top">Code</label>
					<input type="text" id="code" name="code" size="20" />
				</div>
				<div class="split-right">
					<label for="type" class="label-top">Type</label>
					<select id="type" name="type">
						<option value="material">Material</option>
						<option value="module">Module</option>
						<option value="product">Product</option>
					</select>
				</div>
			</li>
			<li>
				<label for="weight_value" class="label-top">Weight</label>
				<div class="split-left">
					<input type="text" id="weight_value" name="weight_value" size="6" /><span class="faded-text">lbs</span>
				</div>
				<div class="split-right">
					<label>Per&nbsp;<input type="text" id="weight_per_units" name="weight_per_units" size="4" />&nbsp;units</label>
				</div>
			</li>
			<li>
				<label for="cost_value" class="label-top">Cost</label>
				<div class="split-left">
					<input type="text" id="cost_value" name="cost_value" size="6" /><span class="faded-text">CND</span>
				</div>
				<div class="split-right">
					<label>Per&nbsp;<input type="text" id="cost_per_units" name="cost_per_units" size="4" />&nbsp;units</label>
				</div>
			</li>
			<li>
				<label> <input type="checkbox" name="is_sales_ready" id="is_sales_ready" /> Sales Ready Item</label>
			</li>
			<li id="sales_price" style="display: none">
				<label for="sales_price_value" class="label-top">Sales Price</label>
				<div class="split-left">
					<input type="text" id="sales_price_value" name="sales_price_value" size="6" /><span class="faded-text">CND</span>
				</div>
				<div class="split-right">
					<label>Per&nbsp;<input type="text" id="sales_price_per_units" name="sales_price_per_units" size="4" />&nbsp;units</label>
				</div>
			</li>
			<li>
				<label> <input type="checkbox" name="is_manufactured" id="is_manufactured" /> Manufactured in house</label>
			</li>
			<li id="materials_list" style="display: none">
				and a materials list here
			</li>
			
			<li></li>
			
		</ul>
		
		</div>
	</div>
</div>
