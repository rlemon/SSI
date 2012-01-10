<?php
$save_cancel_buttons = <<<WGT
<div class="ui-padded-all">
	<input type="hidden" name="ref_url" value="{$_SERVER['HTTP_REFERER']}" />
	<input type="submit" name="save" class="ui-btn small" value="Save" />
	<input type="submit" name="cancel" class="ui-btn small" value="Cancel" />
</div>
WGT;
?>
