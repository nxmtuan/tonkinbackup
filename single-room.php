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
	<?php if ( have_rows( 'banner_img' ) ) : ?>
		<div id="slideshow_wrapper">
			<div class="slideshow">
				<?php while ( have_rows( 'banner_img' ) ) :
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


	<?php get_template_part('components/breadcrumb')  ?>

	<section>
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
		<div class="preview-details-section lazy" style="background-image: url('<?php kmar_post_thumbnail_full() ?>');">
			<div class="preview-details-wrap">
				<div class="preview-details-content">
                    <?php if( get_field('title_desc') ): ?>
                        <h2 class="title-section"><?php the_field('title_desc'); ?></h2>
                    <?php endif; ?>
					
					<div class="service-details">
                    <?php if (get_field('acreage')) : ?>
                                        <div class="item-wrap">
                                            <div class="item surface">
                                                <span class="icon">
													 <?php echo svg('acreage', '26','26') ?>
												</span>
                                                <span class="label">
                                                    <?php the_field('acreage'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (get_field('bedroom')) : ?>
                                        <div class="item-wrap">
                                            <div class="item bed-type">
                                                <span class="icon">
												<?php echo svg('bedroom', '28','28') ?>
												</span>
                                                <span class="label">
                                                    <?php the_field('bedroom'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (get_field('bathroom')) : ?>
                                        <div class="item-wrap">
                                            <div class="item view-type">
                                                <span class="icon">
												<?php echo svg('bathroom', '26','26') ?>
												</span>
                                                <span class="label">
                                                    <?php the_field('bathroom'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
					</div>
					<div class="container_booking_info">
						<div class="buttons_container vertical inline_separated">
                        <?php
                                    $book_btn = get_field('header_btn_book', 'option');
                                    if (!empty($book_btn['title'])) : ?>
                                        <a class="button blue_button"
                                            href="<?php echo esc_url($book_btn['link']); ?>">
                                            <?php _e('Start Booking', 'gnws') ?>
                                        </a>
                                    <?php endif; ?>


							<div class="be_phone">
								<span class="icon">
                                     <?php echo svg('phone', '30','30') ?>
                                </span>
								<div class="container_phone_infos">
									<?php if( get_field('room_title_contact','option') ): ?>
                                        <?php the_field('room_title_contact','option'); ?>
                                    <?php endif; ?>
                                    <?php
                                      $button = get_field( 'room_phone_contact','option' );
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
	</section>
	<div class="highlight-section section">
		<div class="container-large">
			<div class="highlight-content-wrap">
				<div class="highlight-content">
					<div class="thumb-wrap">
                        <?php if( get_field('img_detail') ): ?>
                            <div class="thumb lazy"style="background-image: url('<?php the_field('img_detail'); ?>');">
                            </div>
                        <?php endif; ?>
					</div>
					<div class="description-content">
                        <?php if( get_field('title_detail') ): ?>
                            
                            <h2 class="title-section">
                            <?php the_field('title_detail'); ?></h2>
                        <?php endif; ?>
                        <?php if( get_field('content_detail') ): ?>
                            
                            <div class="description">
                            <?php the_field('content_detail'); ?> </div>
                        <?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>


    <?php if( get_field('gallery_image_title') ): ?>
        <section>
            <div class="container-small">
                <h2 class="the-title pb-0">
                    <?php the_field('gallery_image_title'); ?>
                </h2>
            </div>
        </section>

    <?php endif; ?>
    <?php
    $gallery_images = get_field('gallery_image_detail');
    if ($gallery_images) : ?>
        <section class="photo-gallery-wrapper section">
            <div class="container-large">
                <div class="photo-gallery-container">
                    <?php foreach ($gallery_images as $image_id) : 
                        $image_url = wp_get_attachment_image_url($image_id, 'full'); 
                        $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true); 
                    ?>
                        <div class="single-image-wrap all-items">
                            <a href="<?php echo esc_url($image_url); ?>" data-fancybox="photogallery" data-caption="<?php echo esc_attr($image_alt); ?>" >
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
    </section>
<?php endif; ?>




    <?php
        $current_id = get_the_ID(); // Lấy ID bài viết hiện tại

        $args = array(
            'post_type'      => get_post_type(), // Lấy cùng post type
            'posts_per_page' => 3, // Hiển thị 3 bài viết mới nhất
            'post__not_in'   => array($current_id), // Loại trừ bài viết hiện tại
            'orderby'        => 'date', // Sắp xếp theo ngày đăng mới nhất
            'order'          => 'DESC',
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) : // Kiểm tra nếu có bài viết liên quan mới hiển thị
        ?>
            <div class="pages-section section">
                <div class="container-large">
                    <h2 class="the-title">
                        <?php _e('Discover other cabin ', 'kmar'); ?>
                    </h2>
                    <div class="pages-wrapper">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="single-page">
                            <a href="<?php echo the_permalink() ?>">
										<img src="<?php kmar_post_thumbnail_full() ?>" alt="<?php the_title() ?>" class="img-16-9">
                                    </a>
                                <a class="title_offer_link" tabindex="-1" href="<?php the_permalink(); ?>">
                                    <h3 class="title-offer"><?php the_title(); ?></h3>
                                </a>
                                <?php if (get_field('short_desc')) : ?>
                                    <div class="description">
                                        <?php the_field('short_desc'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="button">
                                    <a class="view-more" href="<?php the_permalink(); ?>">
                                        <?php _e('View more ', 'kmar'); ?>
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
