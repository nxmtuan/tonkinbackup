<?php if ( have_rows( 'list_image' ) ) : ?>
	<section id="slideshow_wrapper">
		<div class="slideshow">
			<?php while ( have_rows( 'list_image' ) ) :
				the_row(); ?>
				<div class="slide">
					<div class="slide_image"
						style="background-image: url(<?php the_sub_field( 'img' ) ?>);">
					</div>
				</div>
			<?php endwhile; ?>
		</div>
		<?php while ( have_rows( 'list_image' ) ) :
			the_row(); ?>
			<?php if ( get_sub_field( 'caption' ) ) : ?>
				<div class="caption_wrapper">
					<div class="caption">
						<?php the_sub_field( 'caption' ); ?>
					</div>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>

	</section>
<?php else :
	if ( have_rows( 'cdc_list_image', 'option' ) ) : ?>
		<section id="slideshow_wrapper">
			<div class="slideshow">
				<?php while ( have_rows( 'cdc_list_image', 'option' ) ) :
					the_row(); ?>
					<div class="slide">
						<div class="slide_image"
							style="background-image: url(<?php the_sub_field( 'img' ) ?>);">
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</section>
		<?php
	endif;
	?>

	<?php
endif; ?>