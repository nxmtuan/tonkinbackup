<?php if( get_sub_field('title') ): ?>
        <section>
            <div class="container-small">
                <h2 class="the-title pb-0">
                    <?php the_sub_field('title'); ?>
                </h2>
            </div>
        </section>

    <?php endif; ?>
    <?php
    $gallery_images = get_sub_field('gallery');
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