<?php
/*
 * 
 * HEREDOC syntax was a good idea at the start but is clearly getting out of hand 
 * 
 * filter menu needs to be ported over to a widget.
 * 
 * are they really widgets or 'components'?
 * 
 * */


function save_cancel_buttons($ref, $makesave = true) {
		$save = $makesave ? '<input type="submit" name="save" class="ui-btn small" value="Save" />' : '';
		return <<<WGT
<div class="ui-padded-all">
	<input type="hidden" name="refer" value="{$ref}" />
	{$save}
	<a href="{$ref}" class="ui-btn small">Cancel</a>
</div>
WGT;
}

function button($map, $ref = null, $use_container = true) {
	$html = '';
	
	foreach( $map as $button) {
		$html .= '<a href="' . $button['url'] . '"';
		
		if( isset( $button['disabled'] ) ) {
			 $html .= ' data-disabled="disabled"';
		}
		
		$html .= ' title="' . $button['title'] . '" class="ui-btn small">'. $button['title'] . '</a>';
	}
	
	if( $ref ) {
	$html .= '<input type="hidden" name="refer" value="' . $ref . '" />';
	}
	
	if( $use_container ) {
		return '<div class="ui-padded-all">' . $html . '</div>';
	}
	return $html;
}

function small_button($selected, $buttons) {
	$return = '';
	foreach($buttons as $key => $button) {
		$return .= '<a class="ui-btn small" href="' . URL . $button['url'] . '"';
		if( $key == $selected ) {
			$return .= ' data-disabled="disabled"';
		}
		$return .= '>' . $button['title'] . '</a> ';
	}
	return $return;
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
				$cell_style = ( isset( $column['nowrap'] ) && $column['nowrap'] != false ) ? ' class="nowrap"' : '';
				if( $column['name'] != 'actions' ) {
					if( is_array( $row[$column['name']] ) ) {
						$list = array();
						foreach($row[$column['name']] as $part) {
							array_push($list, $part['name']);
						}
						$list = implode(', ', $list);
						$body .= <<<BODY
			<td{$cell_style}>{$list}</td>
BODY;
					} else {
					$body .= <<<BODY
			<td{$cell_style}>{$row[$column['name']]}</td>
BODY;
					}
				}
			}
			
			$body .= <<<BODY
			<td><span>
				<a href="{$url}inventory/view{$type}/{$row['id']}" class="ui-btn" data-icon-only="ui-icon-document" title="View {$type}">View {$type}</a>
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
			<input class="ui-btn xsmall" {$disabled}type="submit" name="page" value="{$val}" />
PAGING;
	}
	$paging .= <<<PAGING
	</div>
PAGING;
	}
	return $table . $paging;
}
?>
