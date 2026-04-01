<div class="single-child">
	<a class="single-image thumb" href="<?php echo the_permalink() ?>">
		<img src="<?php kmar_post_thumbnail_full() ?>" alt="<?php the_title() ?>" class="img-16-9">
	</a>
	<div class="single-child-content">
		<a href="<?php echo esc_url( get_permalink() ); ?>" tabindex="-1">
			<h2 class="title-section"><?php the_title(); ?></h2>
		</a>
		<div class="description">
			<?php echo excerpt( 30 ) ?>
		</div>
		<div class="buttons_container vertical inline_separated">
			<a class="view-more tracking_view_more" href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
				<?php _e( 'View more ', 'kmar' ); ?>
			</a>
		</div>
	</div>
</div>