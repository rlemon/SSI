   </div>
    <div class="footer ui-corner-bottom ui-padded-all">
        &copy; 2011 DryerMaster Inc.
    </div>
</div>
<script type="text/javascript" src="<?php echo URL; ?>public/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/js/default.js"></script>
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
