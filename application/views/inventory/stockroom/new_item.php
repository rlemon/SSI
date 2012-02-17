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
			<li class="sub">
				<?php echo anchor('/inventory/stockroom/manage', 'Manage Stock Levels'); ?>
			</li>
			<li class="sub <?php if( $type === 'material' ) echo "selected"; ?>">
				<?php echo anchor('/inventory/stockroom/new_item/material', 'Create New Material'); ?>
			</li>
			<li class="sub <?php if( $type === 'module' ) echo "selected"; ?>">
				<?php echo anchor('/inventory/stockroom/new_item/module', 'Create New Module'); ?>
			</li>
			<li class="sub <?php if( $type === 'product' ) echo "selected"; ?>">
				<?php echo anchor('/inventory/stockroom/new_item/product', 'Create New Product'); ?>
			</li>
		</ul>
	</div>
</div>

<div class="column_02">
	<div class="content">
		<h2 class="title_02">New <?php echo ucfirst($type); ?></h2>
		<div class="block_01">
		
        <ul class="form-list">
            <li>
                <div class="title-top">
                    Name
                </div>
                <input type="text" name="name" id="name" class="wide" />
            </li>

            <li>
                <div class="split">
                    <div class="title-top">
                        Part Code
                    </div>
                    <input type="text" name="code" id="code" class="wide" />
                </div>

                <div class="split">
                    <div class="title-top">
                        Location
                    </div>
                    <select name="location" id="location" class="wide">
                        <option value="0">
                            A
                        </option>
                        
                        <option value="1">
                            B
                        </option>

                        <option value="3">
                            C
                        </option>
                        
                        <option value="4">
                            D
                        </option>
                    </select>
                </div>
                <div style="clear: both;"></div>
            </li>

            <li>
                <div class="split">
                    <div class="title-top">
                        Weight
                    </div>
                    <input type="text" name="weight" id="weight" class="small-input" /><small> lbs. per </small><input type="text" name="weight_units" id="weight_units" class="smaller-input" /><small> units.</small>
                </div>

                <div class="split">
                    <div class="title-top">
                        Cost <small>(CND)</small>
                    </div>
                    <input type="text" name="cost" id="cost" class="small-input" /><small> $ per </small><input type="text" name="cost_units" id="cost_units" class="smaller-input" /><small> units.</small>
                </div>
                <div style="clear: both;"></div>
            </li>
<?php if( $type === 'module' ): ?>
            <li>
                <div class="title-top">
                <label><input type="checkbox" name="is_sales_ready" id="is_sales_ready" onclick="document.getElementById('price_input').style.display = this.checked?'block':'none';" /> Is Sales Item</label>
                </div>
            </li>
<?php endif; ?>
<?php if( $type !== 'material' ): ?>
            <li <?php if( $type !== 'product' ) echo 'hidden="hidden"'; ?> id="price_input">
                <div class="title-top">
                    Price <small>(CND)</small>
                </div>
                <input type="text" name="price" id="price" class="small-input" /><small> $ per </small><input type="text" name="price_units" id="price_units" class="smaller-input" /><small> units.</small>
            </li>
<?php endif; ?>
<?php if( $type !== 'material' ): ?>
            <li>
                <div class="title-top">
                    Required Materials
                </div>
                <div>
					here will be a form for the user to select materials / modules from a list of existing items. 
					The user will be able to specify the quantity of each of these items. 
                </div>
            </li>
<?php endif; ?>
            <li>
                <div class="title-top">
                    Description
                </div>
                <textarea rows="4" id="description" name="description" class="wide"></textarea>
            </li>
            
            <li>
				<input type="submit" name="save" id="save" value="Save New Item" />
            </li>
        </ul>
		<div style="clear: both;"></div>
		</div>
	</div>
</div>
