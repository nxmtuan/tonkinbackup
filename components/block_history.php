<?php if( have_rows('list_timeline') ): ?>
    <section class="timeline-section section">
    <?php while( have_rows('list_timeline') ): the_row();?>
    <div class="single-event" tabindex="0" role="tabpanel">
		<div class="container">
            <?php if( get_sub_field('title') ): ?>
                <h2>
                <?php the_sub_field('title'); ?>
                </h2>
            <?php endif; ?>
			<div class="single-event-wrapper has_cover_image">
				<div class="custom-bg"></div>
				<div class="single-event-wrap">
					<div class="single-event-content">
						<div class="cover-image">
							 <?php echo wp_get_attachment_image(get_sub_field('img'), 'large') ?>
						</div>
                        <?php if( get_sub_field('content') ): ?>
                            <div class="description">
                            <?php the_sub_field('content'); ?> </div>
                        <?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php endwhile; ?>
    </section>
<?php endif; ?>
