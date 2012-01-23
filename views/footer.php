   </div>
    <div class="footer ui-corner-bottom ui-padded-all ui-widget-header">
        &copy; 2011 DryerMaster Inc.
    </div>
</div>
<script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/js/default.js"></script>
<?php
	if( isset( $this->js ) ) {
		foreach( $this->js as $js ) {
			echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
		}
	}
	if( isset( $this->message ) ) { 
		if( isset( $this->message['text'] ) ) {
			echo '<script type="text/javascript">Notify("' . $this->message['text'] . '"';
			if( isset( $this->message['delay'] ) ) {
				echo ', ' . $this->message['delay'];
			}
			echo ');</script>';
		}
	}
?>
</body>
</html>
