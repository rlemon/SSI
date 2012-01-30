<div class="breadcrumbs_container" id="breadcrumbs_container">
	<span class="breadcrumbs_divider">&raquo;</span>
	<?php if( isset( $breadcrumbs ) ): ?>
		
		<?php for( $i = 0, $l = count($breadcrumbs); $i < $l; $i++ ): ?>
			
			<?php if( $i != ( $l - 1 ) ): ?>
				<a class="breadcrumb" href="<?php echo site_url($breadcrumbs[$i]['path']); ?>"><?php echo $breadcrumbs[$i]['title']; ?></a><span class="breadcrumbs_divider">&raquo;</span>
			<?php else: ?>
				<span class="breadcrumb"><?php echo $breadcrumbs[$i]['title']; ?></span>
			<?php endif; ?>
			
		<?php endfor; ?>
		
	<?php endif; ?>
</div>
