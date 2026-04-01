<div class="single-child">
		<a class="single-image thumb" href="<?php echo the_permalink()  ?>">
			<img src="<?php kmar_post_thumbnail_full() ?>" alt="<?php the_title() ?>" class="img-16-9">
		</a>
	<div class="single-child-content">
		<a href="<?php echo esc_url( get_permalink() ); ?>" tabindex="-1">
			<h2 class="title-section"><?php the_title(); ?></h2>
		</a>
		<?php if ( get_field( 'short_desc' ) ) : ?>
			<div class="description">
				<?php the_field( 'short_desc' ); ?>
			</div>
		<?php endif; ?>

		<div class="room-details">
			<?php if ( get_field( 'acreage' ) ) : ?>
				<div class="item-wrap">
					<div class="item surface">
						<span class="icon">
							<?php echo svg( 'acreage', '26', '26' ) ?>
						</span>
						<span class="label">
							<?php the_field( 'acreage' ); ?>
						</span>
					</div>
				</div>
			<?php endif; ?>
			<?php if ( get_field( 'bedroom' ) ) : ?>
				<div class="item-wrap">
					<div class="item bed-type">
						<span class="icon">
							<?php echo svg( 'bedroom', '28', '28' ) ?>
						</span>
						<span class="label">
							<?php the_field( 'bedroom' ); ?>
						</span>
					</div>
				</div>
			<?php endif; ?>
			<?php if ( get_field( 'bathroom' ) ) : ?>
				<div class="item-wrap">
					<div class="item view-type">
						<span class="icon">
							<?php echo svg( 'bathroom', '26', '26' ) ?>
						</span>
						<span class="label">
							<?php the_field( 'bathroom' ); ?>
						</span>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<div class="buttons_container vertical inline_separated">
			<a class="view-more tracking_view_more" href="<?php the_permalink(); ?>" aria-label="<?php the_title(); ?>">
				<?php _e( 'View more ', 'kmar' ); ?>
			</a>
			<?php
			$book_btn = get_field( 'header_btn_book', 'option' );
			if ( ! empty( $book_btn['title'] ) ) : ?>
				<a class="button blue_button" href="<?php echo esc_url( $book_btn['link'] ); ?>">
					<?php _e( 'Start Booking', 'gnws' ) ?>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>