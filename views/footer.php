</div>

<div class="footer">
	&copy; 2011 DryerMaster Inc.
</div>
	<script type="text/javascript" src="<?php echo URL; ?>public/js/util.js"></script>
	<?php
		if (isset($this->js)) 
		{
			foreach ($this->js as $js)
			{
				echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
			}
		}
	?>
</body>
</html>
