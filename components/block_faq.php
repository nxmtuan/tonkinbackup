<section class=" empty_content">
	<div class="container-small">
		<?php if ( get_sub_field( 'main_title' ) ) : ?>
			<h2 class="the-title pb-0"><?php the_sub_field( 'main_title' ); ?></h2>
		<?php endif; ?>


	</div>
</section>
<div id="faq_section" class="margin_standard">
	<div class="container-large">
		<div class="padding_faq accordion_groups">
			<?php if ( have_rows( 'list_faq' ) ) : ?>
                <?php while ( have_rows( 'list_faq' ) ) :
						the_row(); ?>
                        <div class="group_faq do_accordion_here">
						<?php if ( get_sub_field( 'title_big' ) ) : ?>
							<div class="title_group title_to_open">
								<?php the_sub_field( 'title_big' ); ?>
							</div>
						<?php endif; ?>

						<?php if ( have_rows( 'list_question' ) ) : ?>
							<div class="faq_questions">
								<?php while ( have_rows( 'list_question' ) ) :
									the_row(); ?>
									<div class="single_question do_accordion_here">
                                        <?php if( get_sub_field('title_question') ): ?>
                                            <div class="title_question title_to_open"><?php the_sub_field('title_question'); ?></div>
                                        <?php endif; ?>
                                        <?php if( get_sub_field('answer') ): ?>
                                            <div class="answer">
                                            <?php the_sub_field('answer'); ?>
                                            </div>
                                        <?php endif; ?>
									</div>
								<?php endwhile; ?>
							</div>
						<?php endif; ?>


                    </div>
					<?php endwhile; ?>
			<?php endif; ?>


		</div>
	</div>
</div>