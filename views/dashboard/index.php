<form method="post">
<div class="iblock">
	<div class="ui-padded-bottom ui-heading">
		<?php echo Session::get('username'); ?>'s Dashboard
	</div>
	<div class="ui-padded-bottom">
	<span class="label small">Theme Selection:</span>
	<select class="ui-state-default" name="theme">
		<?php
			for($i = 0, $l = count($this->themes); $i < $l; $i++) {
				$selected = '';
				if( Session::get('ui_theme') == $i ) {
					$selected .= 'selected="selected" ';
				}
				echo '<option ' . $selected . 'value="' . $i . '">' . $this->themes[$i] . '</option>';
			}
		?>
	</select>
	</div>
	<input type="submit" class="ui-btn" value="Save" />
</div>
</form>
