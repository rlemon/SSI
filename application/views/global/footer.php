</div>
<div class="box_menu_footer clearfix">
	<div class="menu_footer first">
		<h3 class="title_03">DryerMaster Web</h3>
		<ul>
			<li>
				<a href="#">Sitemap</a>
			</li>
			<li>
				<a href="#">FAQ</a>
			</li>
			<li>
				<a href="#">Request account</a>
			</li>
			<li>
				<a href="#">Contact Admin</a>
			</li>
		</ul>
	</div>
	<div class="menu_footer">
		<h3 class="title_03">Resources</h3>
		<ul>
			<li>
				<a href="#">DryerMaster</a>
			</li>
			<li>
				<a href="#">Digi-Key</a>
			</li>
			<li>
				<a href="#">Car-Sans</a>
			</li>
			<li>
				<a href="#">Something-Else-Here</a>
			</li>
		</ul>
	</div>
	<div class="menu_footer">
		<h3 class="title_03">Quick Links</h3>
		<ul>
			<li>
				<a href="#">Purolator</a>
			</li>
			<li>
				<a href="#">Canada Post</a>
			</li>
			<li>
				<a href="#">UPS canada</a>
			</li>
		</ul>
	</div>
	<div class="menu_footer">
		<h3 class="title_03">Locations</h3>
		<ul>
			<li>
				<a href="#">DM Web 2.0</a>
			</li>
			<li>
				<a href="#">DryerMaster.com</a>
			</li>
			<li>
				<a href="#">Maximizer</a>
			</li>
		</ul>
	</div>
	<div class="menu_footer">
		<h3 class="title_03">Contact</h3>
		<ul>
			<li>
				<a href="#">Admin</a>
			</li>
			<li>
				<a href="#">Wolfgang</a>
			</li>
			<li>
				<a href="#">Claude</a>
			</li>
			<li>
				<a href="#">Jane</a>
			</li>
			<li>
				<a href="#">Rob</a>
			</li>
			<li>
				<a href="#">Nikki</a>
			</li>
		</ul>
	</div>
</div>
</div>
<?php if( isset( $scripts ) ): ?>
	<?php foreach( $scripts as $script ): ?>
		<script type="text/javascript" src="<?php echo $script; ?>"></script>
	<?php endforeach; ?>
<?php endif; ?>
<script type="text/javascript" src="<?php echo base_url('application/assets/js/notifications.js'); ?>"></script>
<script type="text/javascript">
	var notifier = new Notifier();
<?php if( isset( $errors ) ): ?>
	<?php foreach( $errors as $title => $message ): ?>
		notifier.error("<?php echo $message; ?>", "<?php echo $title; ?> system error");
	<?php endforeach; ?>
<?php endif; ?>
</script>
</body>
</html>
