<?php if ( have_rows( 'list_content' ) ) : ?>

	<?php

	while ( have_rows( 'list_content' ) ) :
		the_row();
		$position = get_sub_field( 'position' )?get_sub_field( 'position' ):'right';
		?>
		<div class="preview-page-block single-section">
			<div class="thumb-wrap">
				<?php echo wp_get_attachment_image( get_sub_field( 'img' ), 'full', '', array( 'class' => 'thumb img_thumb' ) ) ?>

			</div>
			<div class="block-text-wrapper <?php echo $position == 'right' ? 'right' : 'left' ?> ">
				<?php if ( get_sub_field( 'title' ) ) : ?>
					<h2 class="the-subtitle">
						<?php the_sub_field( 'title' ); ?>
					</h2>
				<?php endif; ?>
				<?php if ( get_sub_field( 'desc' ) ) : ?>
					<div class="the-excerpt">
						<?php the_sub_field( 'desc' ); ?>
					</div>
				<?php endif; ?>

				<?php
				$button = get_sub_field( 'button' );
				if ( $button['title'] ) : ?>

					<a class="btn text-left" href="<?php echo check_link( $button['link'] ) ?>"
						aria-label="<?php echo $button['title']; ?>">
						<?php echo $button['title']; ?> </a>
				<?php endif; ?>

			</div>
		</div>
	<?php endwhile; ?>

<?php endif; ?>