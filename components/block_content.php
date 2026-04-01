<div class="images-section-wrap single-section only_one_image">
	<div class="container-large">
		<div class="images-section-container layout_square  hasAlmostOneParagraph">
			<div class="single-image full paragraph">
				<div class="single-paragraph-content">
                    <?php if( get_sub_field('title') ): ?>
                        <h2 class="the-subtitle">
                        <?php the_sub_field('title'); ?> </h2>
                    <?php endif; ?>
                    <?php if( get_sub_field('content') ): ?>
                        <div class="description">
                        <?php the_sub_field('content'); ?>
                        </div>
                    <?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>