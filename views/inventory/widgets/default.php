<?php
function save_cancel_buttons() {
	return <<<WGT
<div class="ui-padded-all">
	<input type="hidden" name="ref_url" value="{$_SERVER['HTTP_REFERER']}" />
	<input type="submit" name="save" class="ui-btn small" value="Save" />
	<input type="submit" name="cancel" class="ui-btn small" value="Cancel" />
</div>
WGT;
}

function data_table($type, $columns, $rows, $sort, $direction, $rpp, $offset, $len) {
	$i = 0; // i am used to determine if the row is odd or even
	$url = URL;
	$clen = count( $columns );
	$rlen = count( $rows );
	/*
	 *  Table Header 
	 */
	$head = <<<HEAD
	<thead class="ui-widget-header">
HEAD;
	foreach( $columns as $column ) {
		$static = $column['is_static'] ? ' class="static-column"' : '';
		
		$handle = $column['name'] == $sort ? '<span id="order_handle" class="ui-icon left ui-icon-triangle-1-'. ($direction == 'ASC' ? 's' : 'n') .'"></span>' : '';
		$head .= <<<HEAD
		<th{$static}>{$handle}<a href="#" class="order-by" name="{$column['name']}">{$column['title']}</a></th>
HEAD;
	}
	$head .= <<<HEAD
	</thead>
HEAD;

	/*
	 *  Table Body 
	 */
	$body = <<<BODY
	<tbody>
BODY;
	if( $rlen < 1 ) {
		$body .= <<<BODY
		<tr><td colspan="{$clen}">Zero(0) Records Found.</td></tr>
BODY;
	} else {
		foreach( $rows as $row ) {
			$alt_style = $i++%2 ? ' class="ui-widget-content"' : '';
			$body .= <<<BODY
		<tr{$alt_style}>
BODY;
			foreach( $columns as $column ) {
				if( $column['name'] != 'actions' ) {
					$body .= <<<BODY
			<td>{$row[$column['name']]}</td>
BODY;
				}
			}
			
			$body .= <<<BODY
			<td><span>
				<a href="{$url}inventory/edit{$type}/{$row['id']}" class="ui-btn" data-icon-only="ui-icon-pencil" title="Edit {$type}">Edit {$type}</a>
				<a href="{$url}inventory/delete{$type}/{$row['id']}" class="ui-btn ui-btn-delete" data-icon-only="ui-icon-trash" title="Delete {$type}">Delete {$type}</a>
			</span></td>
		</tr>
BODY;
		}
		
	}
	$body .= <<<BODY
		</tbody>
BODY;

	$table = <<<TABLE
<table class="ui-widget data-table">
{$head}
{$body}
</table>
TABLE;

	$paging = "";
	if( $rlen > 0 ) {
		
		$paging .= <<<PAGING
	<div class="ui-padded-top paging-buttons">
	<span class="small">Page: </span>
PAGING;

	$pages = ceil($len / $rpp);
	for( $i = 0; $i < $pages; $i++) {
		$disabled = '';
		$val = $i + 1;
		if( $offset == $val ) {
			$disabled .= 'data-disabled="disabled" ';
		}
		$paging .= <<<PAGING
			<input class="ui-btn xsmall" {$disabled}type="submit" name="ro" value="{$val}" />
PAGING;
	}
	$paging .= <<<PAGING
	</div>
PAGING;
	}
	return $table . $paging;
}
?>
