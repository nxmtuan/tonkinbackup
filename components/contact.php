<section>
	<div class="container-large">
		<?php if ( get_sub_field( 'main_title' ) ) : ?>
			<h2 class="the-title mb-lg-5"><?php the_sub_field( 'main_title' ); ?></h2>
		<?php endif; ?>
		<div class="row mb-5 align-items-center">
			<div class="col-lg-6">
				<?php if ( get_sub_field( 'sub_title' ) ) : ?>
					<p class="sub-title"><?php the_sub_field( 'sub_title' ); ?></p>
				<?php endif; ?>

				<div class="form__contact">
					<?php echo do_shortcode( '[wpforms id="414"]' ) ?>
				</div>

			</div>
			<div class="col-lg-5 offset-lg-1">

				<?php if ( have_rows( 'list_contact' ) ) : ?>
					<div class="contact_info">
						<?php while ( have_rows( 'list_contact' ) ) :
							the_row();
							$icon = get_sub_field( 'icon' );
							if ( $icon == 'tel' )
							{
								$class = 'tel:';
							} elseif ( $icon == 'mail' )
							{
								$class = 'mailto:';
							} else
							{
								$class = '';
							}
							?>
							<div class="contact_info-item">
								<div class="icon">
									<?php echo svg( $icon, '20', '20' ) ?>
								</div>

								<div class="title">
									<?php the_sub_field( 'title' ) ?>
								</div>
								<div class="contact-btn">
									<?php
									$button = get_sub_field( 'contact_btn' );
									if ( $button['title_btn'] ) : ?>
										<a href="<?= $class ?><?php echo $button['link_btn']; ?>">
											<?php echo $button['title_btn']; ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>