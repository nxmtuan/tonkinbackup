<div class="single-child">
	<a href="<?php echo the_permalink() ?>">
		<div class="thumb">
			<img src="<?php kmar_post_thumbnail_full() ?>" alt="<?php the_title() ?>" class="img-16-9">
		</div>
	</a>
	<div class="single-child-content">
		<h2 class="title-section">
			<a href="<?php echo the_permalink() ?>">
				<?php the_title() ?>
			</a>
		</h2>

		<?php if ( have_rows( 'itinerary_stations' ) ) : ?>
			<div class="itinerary_stations">
				<?php
				$count = count( get_field( 'itinerary_stations' ) );
				$i = 0;

				while ( have_rows( 'itinerary_stations' ) ) :
					the_row();
					$i++;
					$extra_class = ( $i < $count ) ? 'width_star' : '';
					?>
					<span
						class="single_station <?php echo $extra_class; ?>"><?php the_sub_field( 'name' ); ?></span>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>



		<div class="categories_wrapper">

			<?php if ( get_field( 'type_itinerary' ) ) : ?>
				<div class="item_wrap">
					<span class="icon">
						<?php echo svg( 'round', '30', '30' ) ?>
					</span>
					<span class="label">
						<?php the_field( 'type_itinerary' ); ?>
					</span>
				</div>
			<?php endif; ?>

			<?php if ( get_field( 'time_itinerary' ) ) : ?>
				<div class="item_wrap">
					<span class="icon">
						<?php echo svg( 'transport', '28', '28' ) ?>
					</span>
					<span class="label"><?php the_field( 'time_itinerary' ); ?></span>
				</div>
			<?php endif; ?>
			<?php if ( get_field( 'direction_itinerary' ) ) : ?>
				<div class="item_wrap">
					<span class="icon">
						<?php echo svg( 'direction', '30', '30' ) ?>
					</span>
					<span class="label"> <?php the_field( 'direction_itinerary' ); ?>
					</span>
				</div>
			<?php endif; ?>
		</div>

		<div class="description text-truncate-3">
			<?php the_content() ?>
		</div>

		<div class="buttons_container vertical inline_separated">
			<a class="btn tracking_view_more text-left" href="<?php echo the_permalink() ?>">
				<?php _e( 'View more ', 'kmar' ) ?>
			</a>
			<a class="button only_border train_bookable" href="javascript:;" data-toggle="modal"
				data-target="#tripModal">
				<?php _e( 'Book now', 'kmar' ) ?>
			</a>
		</div>
	</div>
</div>