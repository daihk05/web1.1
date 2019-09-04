
		<div class="wrap easy-watermark">
			<div id="icon-easy-watermark" class="icon32"><br /></div>
			<h2><?php _e('Easy Watermark', 'easy-watermark'); ?></h2>
			<?php
			if(isset($_GET['_wpnonce'])) :
				if(wp_verify_nonce($_GET['_wpnonce'], 'watermark_all_confirmed') && isset($_GET['watermark_all']) && ($output = $this->watermark_all())) :
				?>
			<div id="message" class="updated below-h2">
				<p><?php _e('Watermark successfully added.', 'easy-watermark'); ?> <a href="<?php echo admin_url('upload.php') ?>"><?php _e('Go to Media Library', 'easy-watermark'); ?></a></p>
			</div>
				<?php
					echo $output;
				else: ?>
			<div id="message" class="updated below-h2">
			<?php if(current_user_can('edit_others_posts')): ?>
				<p><?php _e('You are about to watermark all images in the library. This action can not be undone. Are you sure you want to do this?', 'easy-watermark'); ?></p>
			<?php else : ?>
				<p><?php _e('You are about to watermark all images you have uploaded ever. This action can not be undone. Are you sure you want to do this?', 'easy-watermark'); ?></p>
			<?php endif; ?>
			</div>
			<a class="button-primary" href="<?php echo wp_nonce_url(admin_url('/upload.php?page=easy-watermark&watermark_all=1'), 'watermark_all_confirmed'); ?>"><?php _e('Proceed', 'easy-watermark'); ?></a> <a class="button-secondary" href="<?php echo admin_url('/upload.php?page=easy-watermark'); ?>"><?php _e('Cancel', 'easy-watermark'); ?></a>
				<?php endif;
			else :
			?>
			<br/>
			<?php
				if(current_user_can('edit_others_posts'))
					$link_text = __('Add watermark to all images', 'easy-watermark');
				else
					$link_text = __('Add watermark to all images uploaded by you', 'easy-watermark');
			?>
			<a class="button-primary" href="<?php echo wp_nonce_url(admin_url('/upload.php?page=easy-watermark&watermark_all=1'), 'watermark_all'); ?>"><?php echo $link_text ?></a><p class="description"><?php _e('Be carefull with that option. If some images alredy has watermark, it will be added though.', 'easy-watermark'); ?></p>
			<?php
			endif;
		?>
		</div>
