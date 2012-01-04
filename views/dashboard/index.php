<form method="post">

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

<input type="submit" class="ui-btn" value="Save" />

</form>
