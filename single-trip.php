<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package kmar
 */

get_header();
?>
<main id="page">
	<?php if ( have_rows( 'list_trip_banner' ) ) : ?>
		<div id="slideshow_wrapper">
			<div class="slideshow">
				<?php while ( have_rows( 'list_trip_banner' ) ) :
					the_row(); ?>
					<div class="slide">

						<div class="slide_image"
							style="background-image: url('<?php the_sub_field( 'img' ); ?>');">
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	<?php endif; ?>
	<?php get_template_part( 'components/breadcrumb' ) ?>
	<section class="main-content ">
		<div class="container-small">
			<h1 class="the-title">
				<?php the_title() ?>
			</h1>
			<div id="main_content_wrap" class="container">
				<div class="content-wrapper text-center">
					<?php the_content() ?>
				</div>
			</div>
		</div>
	</section>

	<div class="container_flexible_itinerary_resume">
		<div class="container">

			<div class="container_title">
				<?php if ( have_rows( 'itinerary_stations' ) ) : ?>
					<h3 class="the-subtitle">
						<?php
						$stations = [];
						while ( have_rows( 'itinerary_stations' ) ) :
							the_row();
							$stations[] = get_sub_field( 'name' );
						endwhile;
						echo implode( ' - ', $stations );
						?>
					</h3>
				<?php endif; ?>



				<div class="container_itinerary_resume startingfrom_price">

					<?php if ( get_field( 'next_departure' ) ) : ?>

						<div class="item">
							<span class="label">
								<?php _e( 'Next departure ', 'kmar' ) ?>
							</span>
							<span class="first_departure"><?php the_field( 'next_departure' ); ?></span>
						</div>
					<?php endif; ?>

					<?php if ( get_field( 'time_itinerary' ) ) : ?>

						<div class="item remove_if_empty">
							<span class="label">
								<?php _e( 'Starting from', 'kmar' ) ?> </span>
							<span class="offer-price"><?php the_field( 'time_itinerary' ); ?></span>

						</div>
					<?php endif; ?>

					<div class="item ">
						<div class="be_phone">
							<span class="icon">
								<?php echo svg( 'phone', '26', '26' ) ?>
							</span>
							<div class="container_phone_infos">
								<?php if ( get_field( 'trip_contact_title', 'option' ) ) : ?>
									<?php the_field( 'trip_contact_title', 'option' ); ?>
								<?php endif; ?>

								<?php
								$button = get_field( 'trip_contact_phone', 'option' );
								if ( $button['title'] ) : ?>
									<a href="tel:<?php echo $button['link']; ?>" class="phone">
										<?php echo $button['title']; ?>
									</a>
								<?php endif; ?>

							</div>
						</div>
					</div>

					<div class="item ">
						<div class="buttons_container vertical"> <a
								class="button blue_button train_bookable open_calendar"
								href="javascript:;" data-toggle="modal" data-target="#tripModal">
								<?php _e( 'Book now', 'kmar' ) ?>
							</a> </div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="preview-details-section lazy"
		style="background-image: url('<?php kmar_post_thumbnail_full() ?>');">
		<div class="preview-details-wrap">
			<div class="preview-details-content">
				<h2 class="title-section italic_title">
					<?php _e( 'Your itinerary', 'kmar' ) ?>
				</h2>
				<div class="service-details">


					<?php if ( get_field( 'type_itinerary' ) ) : ?>
						<div class="item-wrap">
							<div class="item itinerary-type">
								<span class="icon">
									<?php echo svg( 'round', '30', '30' ) ?>
								</span>
								<span class="label">
									<?php the_field( 'type_itinerary' ); ?>
								</span>

							</div>
						</div>
					<?php endif; ?>

					<?php if ( get_field( 'time_itinerary' ) ) : ?>
						<div class="item-wrap">
							<div class="item">
								<span class="icon">
									<?php echo svg( 'transport', '28', '28' ) ?>
								</span>
								<span class="label"><?php the_field( 'time_itinerary' ); ?></span>

							</div>
						</div>
					<?php endif; ?>


				</div>

				<div class="item-wrap startingfrom_price">
					<?php if ( get_field( 'next_departure' ) ) : ?>

						<div class="item ">
							<span class="label">
								<?php _e( 'Next departure', 'kmar' ) ?>
							</span>
							<span class="first_departure"><?php the_field( 'next_departure' ); ?></span>
						</div>
					<?php endif; ?>

					<?php if ( get_field( 'price_itinerary' ) ) : ?>
						<div class="item ">
							<span class="label">
								<?php _e( 'Starting from', 'kmar' ) ?>
							</span>
							<span class="offer-price"><?php the_field( 'price_itinerary' ); ?>
								<span class="offer-unit"><?php _e( 'per passenger', 'gnws' ) ?></span>
							</span>
						</div>
					<?php endif; ?>
				</div>
				<div class="details-contacts-section">
					<div class="container_booking_info">
						<div class="buttons_container vertical inline_separated"> <a
								class="button blue_button" href="javascript:;" data-toggle="modal"
								data-target="#tripModal">
								<?php _e( 'Book now', 'kmar' ) ?>
							</a>
							<div class="be_phone">
								<span class="icon">
									<?php echo svg( 'phone', '26', '26' ) ?>
								</span>
								<div class="container_phone_infos">


									<?php
									$button = get_field( 'trip_contact_phone', 'option' );
									if ( $button['title'] ) : ?>
										<a href="tel:<?php echo $button['link']; ?>" class="phone">
											<?php echo $button['title']; ?>
										</a>
									<?php endif; ?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php if ( get_field( 'itinerary_content_short_desc' ) ) : ?>
		<div class="single-section ">
			<div class="container-large ws-sgct">
				<?php the_field( 'itinerary_content_short_desc' ); ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="images-section-wrap single-section ">
		<div class="container-large">
			<?php
			$i = 0;
			if ( have_rows( 'itinerary_content_grid' ) ) : ?>
				<?php while ( have_rows( 'itinerary_content_grid' ) ) :
					the_row();
					$i++;
					?>
					<div
						class="images-section-container layout_square <?php echo $i % 2 == 0 ? 'flex-lg-row-reverse' : '' ?> ">
						<div class="single-image half paragraph">
							<div class="single-paragraph-content">
								<?php if ( get_sub_field( 'title' ) ) : ?>
									<h2 class="the-subtitle">
										<?php the_sub_field( 'title' ); ?>
									</h2>
								<?php endif; ?>
								<?php if ( get_sub_field( 'content' ) ) : ?>
									<div class="description">
										<?php the_sub_field( 'content' ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="single-image half ">
							<div class="thumb"
								style="background-image: url('<?php the_sub_field( 'img' ); ?>');">

							</div>
						</div>

					</div>
				<?php endwhile; ?>
			<?php endif; ?>

		</div>
	</div>


	<div class="experiences-highlight highlight-section section">
		<div class="container-large">
			<?php if ( get_field( 'itinerary_title_experient' ) ) : ?>
				<h2 class="the-title"><?php the_field( 'itinerary_title_experient' ); ?></h2>
			<?php endif; ?>



			<?php if ( have_rows( 'itinerary_content_experient' ) ) : ?>
				<div class="highlight-section-wrapper">
					<div class="highlight-content-wrap">
						<?php while ( have_rows( 'itinerary_content_experient' ) ) :
							the_row(); ?>

							<div class="highlight-margin-carousel">
								<div class="highlight-content-carousel">
									<div class="thumb-wrap">
										<div class="thumb lazy"
											style="background-image: url('<?php the_sub_field( 'img' ); ?>');">
										</div>
									</div>

									<div class="description-content">
										<?php if ( get_sub_field( 'title' ) ) : ?>
											<h2 class="the-subtitle"><?php the_sub_field( 'title' ); ?></h2>
										<?php endif; ?>
										<?php if ( get_sub_field( 'content' ) ) : ?>
											<div class="description">
												<?php the_sub_field( 'content' ); ?>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>


	<?php
	$current_id = get_the_ID(); // Lấy ID bài viết hiện tại
	
	$args = array(
		'post_type' => get_post_type(), // Lấy cùng post type
		'posts_per_page' => 3, // Hiển thị 3 bài viết mới nhất
		'post__not_in' => array( $current_id ), // Loại trừ bài viết hiện tại
		'orderby' => 'date', // Sắp xếp theo ngày đăng mới nhất
		'order' => 'DESC',
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) :   // Kiểm tra nếu có bài viết liên quan mới hiển thị
		?>
		<div class="pages-section section">
			<div class="container-large">
				<h2 class="the-title">
					<?php _e( 'Discover other intineraries ', 'kmar' ); ?>
				</h2>
				<div class="pages-wrapper">
					<?php while ( $query->have_posts() ) :
						$query->the_post(); ?>
						<div class="single-page">
							<a href="<?php echo the_permalink() ?>">
								<img src="<?php kmar_post_thumbnail_full() ?>" alt="<?php the_title() ?>"
									class="img-16-9">
							</a>
							<a class="title_offer_link" tabindex="-1" href="<?php the_permalink(); ?>">
								<h3 class="title-offer"><?php the_title(); ?></h3>
							</a>
							<div class="description text-truncate-3">
								<?php the_content() ?>
							</div>
							<div class="button">
								<a class="view-more" href="<?php the_permalink(); ?>">
									<?php _e( 'View more ', 'kmar' ); ?>
								</a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
		<?php
		wp_reset_postdata();
	endif;
	?>

</main>

<?php
get_footer();
