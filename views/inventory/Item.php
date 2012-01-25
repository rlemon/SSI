<?php
	$item = array('id' => 40, 'key'=>'0123456789ABC');
?>
<div class="ui-widget">
	<div class="ui-widget-header ui-padded-all">
		Item 99
	</div>
	<div class="ui-widget-content ui-padded-all">
		<table class="small">
			<tr>
				<td class="ui-priority-secondary">
					Part Code (P.C)
				</td>
				<td class="ui-priority-primary">
					<?php echo $item['key']; ?>
				</td>
				<td class="ui-priority-secondary">
					Part Supplier
				</td>
				<td class="ui-priority-primary">
					<?php echo $item['key']; ?>
				</td>
			</tr>
			<tr>
				<td class="ui-priority-secondary">
					Description
				</td>
				<td class="ui-priority-primary">
					<?php echo $item['key']; ?>
				</td>
				<td class="ui-priority-secondary">
					Supplier P.C
				</td>
				<td class="ui-priority-primary">
					<?php echo $item['key']; ?>
				</td>
			</tr>
			<tr>
				<td class="ui-priority-secondary">
					LOC
				</td>
				<td class="ui-priority-primary">
					<?php echo $item['key']; ?>
				</td>
				<td class="ui-priority-secondary">
					Unit Cost (CND)
				</td>
				<td class="ui-priority-primary">
					<?php echo $item['key']; ?>
				</td>
			</tr>
			<tr>
				<td class="ui-priority-secondary">
					Quantity
				</td>
				<td class="ui-priority-primary">
					<?php echo $item['key']; ?>
				</td>
				<td class="ui-priority-secondary">
					Group(s)
				</td>
				<td class="ui-priority-primary">
					<?php echo $item['key']; ?>
				</td>
			</tr>
		</table>
	</div>
</div>

<?php 
	echo button(array(
		array('title' => 'Edit', 'url' => URL . 'inventory/editItem/' . $item['id']),
		array('title' => 'Cancel', 'url' => $this->refer ),
		array('title' => 'Test', 'url' => '#', 'disabled' => true)
	), $this->refer);
?>

