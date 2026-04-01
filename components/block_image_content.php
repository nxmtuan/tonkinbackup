<?php
$style = get_sub_field( 'select_style' ) ? get_sub_field( 'select_style' ) : 'big';
if ( $style == 'big' ) : ?>
	<div class="two-images-section-wrap single-section ">
		<div class="container-large">
			<div class="two-images-section layout_square  hasAlmostOneParagraph">
				<div class="single-image half paragraph">
					<div class="single-paragraph-content">
						<?php if ( get_sub_field( 'title' ) ) : ?>
							<h2 class="the-subtitle"><?php the_sub_field( 'title' ); ?></h2>
						<?php endif; ?>
						<?php if ( get_sub_field( 'desc' ) ) : ?>
							<div class="description">
								<?php the_sub_field( 'desc' ); ?>
							</div>
						<?php endif; ?>
						<?php
						$button = get_sub_field( 'button' );
						if ( $button['title'] ) : ?>

							<div class="buttons">
								<a class="btn text-left" href="<?php echo check_link( $button['link'] ) ?>"
									aria-label="<?php echo $button['title']; ?>">
									<?php echo $button['title']; ?> </a>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="single-image half right-image-wrap">
					<div class="thumb lazy"
						style="background-image:url(<?php echo get_sub_field( 'img' ) ?>)">
					</div>
				</div>
			</div>
		</div>
	</div>
<?php elseif ( $style == 'small' ) : ?>
	<div class="two-images-section-wrap single-section ">
		<div class="container-large">
			<div class="two-images-section layout_vertical reverse hasAlmostOneParagraph">
				<div class="single-image half left-image-wrap">
					<div class="thumb lazy"
						style="background-image:url(<?php echo get_sub_field( 'img' ) ?>)">
						>
					</div>
				</div>
				<div class="single-image half paragraph">
					<div class="single-paragraph-content">
						<?php if ( get_sub_field( 'title' ) ) : ?>
							<h2 class="the-subtitle"><?php the_sub_field( 'title' ); ?></h2>
						<?php endif; ?>
						<?php if ( get_sub_field( 'desc' ) ) : ?>
							<div class="description">
								<?php the_sub_field( 'desc' ); ?>
							</div>
						<?php endif; ?>

						<?php
						$button = get_sub_field( 'button' );
						if ( $button['title'] ) : ?>

							<div class="buttons">
								<a class="btn text-left" href="<?php echo check_link( $button['link'] ) ?>"
									aria-label="<?php echo $button['title']; ?>">
									<?php echo $button['title']; ?> </a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php else : ?>
	<div class="images-section-wrap single-section ">
		<div class="container-large">
			<div class="images-section-container layout_square  hasAlmostOneParagraph">
				<div class="single-image half paragraph">
					<div class="single-paragraph-content">
					<?php if ( get_sub_field( 'title' ) ) : ?>
							<h2 class="the-subtitle"><?php the_sub_field( 'title' ); ?></h2>
						<?php endif; ?>
						<?php if ( get_sub_field( 'desc' ) ) : ?>
							<div class="description">
								<?php the_sub_field( 'desc' ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="single-image half ">
					<div class="thumb lazy"
						style="background-image:url(<?php echo get_sub_field( 'img' ) ?>)">
					</div>
				</div>
				<div class="single-image last-item ">
					<div class="thumb lazy"
						style="background-image:url(<?php echo get_sub_field( 'img_big' ) ?>)">
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>