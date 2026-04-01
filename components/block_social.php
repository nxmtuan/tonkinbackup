<section class="text-center py-5">
	<div class="container-reviews">
		<?php if ( get_sub_field( 'main_title' ) ) : ?>
			<h2 class="font-weight-normal text-uppercase the-title pb-0 mb-3">
				<?php the_sub_field( 'main_title' ); ?>
			</h2>
		<?php endif; ?>
		<?php if ( get_sub_field( 'sub_title' ) ) : ?>
			<div class="mb-4">
				<?php the_sub_field( 'sub_title' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( have_rows( 'list_social' ) ) : ?>
			<div class="d-flex justify-content-center mb-4 home-social-networks flex-row">
				<?php while ( have_rows( 'list_social' ) ) :
					the_row();
					$social = get_sub_field( 'social' );
					?>
					<a href="<?php echo check_link( get_sub_field( 'link_social' ) ) ?>" target="_blank"
						rel="nofollow">
						<?php echo svg( $social ) ?>
					</a>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>


		<div class="d-none d-lg-block mb-4 position-relative">

			<?php if ( have_rows( 'list_reviews' ) ) : ?>
				<div class="swiper swiper-reviews">
					<div class="swiper-wrapper align-items-center">
						<?php
						$count = 0;
						$cycle = 5;
						$item_in_cycle = 0;

						while ( have_rows( 'list_reviews' ) ) :
							the_row();
							$count++;
							$item_in_cycle = ( $count - 1 ) % $cycle; // Xác định vị trí trong chu kỳ
							$title = get_sub_field( 'title' );
							$type_social = get_sub_field( 'type_social' );
							$modal_id = 'modal-' . $count;

							// Mở <div class="swiper-slide"> cho item đầu tiên và item thứ 4,5
							if ( $item_in_cycle == 0 || $item_in_cycle == 3 || $item_in_cycle == 4 )
							{
								echo '<div class="swiper-slide">';
							}

							// Nếu là item thứ 2 trong chu kỳ thì mở <div> bọc chung với item thứ 3
							if ( $item_in_cycle == 1 )
							{
								echo '<div class="swiper-slide">';
							}
							?>

							<a class="embed-responsive embed-responsive-1by1 d-block my-3 my-md-4 position-relative home-review"
								data-toggle="modal" href="#<?php echo $modal_id; ?>">
								<?php echo wp_get_attachment_image( get_sub_field( 'img' ), 'full', '', array( 'class' => 'w-100 h-100 position-absolute img-cover image' ) ) ?>
								<i class="icon">
									<?php echo svg( $type_social ) ?>
								</i>
								<div
									class="text-center text-white overflow-hidden d-flex align-items-center justify-content-center p-3 position-absolute desc">
									<div>
										<div class="text-break"><?php echo esc_html( $title ); ?></div>
									</div>
								</div>
							</a>

							<?php
							// Nếu là item thứ 3 trong chu kỳ thì đóng div (nằm chung với item thứ 2)
							if ( $item_in_cycle == 2 )
							{
								echo '</div>';
							}

							// Nếu là item đầu tiên hoặc item thứ 4,5 trong chu kỳ thì đóng div
							if ( $item_in_cycle == 0 || $item_in_cycle == 3 || $item_in_cycle == 4 )
							{
								echo '</div>';
							}

						endwhile;
						?>
					</div>
				</div>
			<?php endif; ?>





			<div class="swiper-button-prev">
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
					xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					viewBox="0 0 283.46 283.46" style="enable-background:new 0 0 283.46 283.46;"
					xml:space="preserve">
					<path
						d="M71.85,283.46c0.89-1.8,3.21-7.01,5.97-11.96c21.61-38.77,60.99-78.92,83.14-117.38c5.08-8.81,5.23-15.49,0.13-24.35C138.94,91.31,99.56,53.71,77.94,14.94C75.19,10,72.89,4.81,70.72,0.43c47.78,47.79,95.67,95.67,142.02,142.02C165.97,189.26,117.86,237.41,71.85,283.46z">
					</path>
				</svg>
			</div>
			<div class="swiper-button-next">
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
					xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					viewBox="0 0 283.46 283.46" style="enable-background:new 0 0 283.46 283.46;"
					xml:space="preserve">
					<path
						d="M71.85,283.46c0.89-1.8,3.21-7.01,5.97-11.96c21.61-38.77,60.99-78.92,83.14-117.38c5.08-8.81,5.23-15.49,0.13-24.35C138.94,91.31,99.56,53.71,77.94,14.94C75.19,10,72.89,4.81,70.72,0.43c47.78,47.79,95.67,95.67,142.02,142.02C165.97,189.26,117.86,237.41,71.85,283.46z">
					</path>
				</svg>
			</div>
		</div>
		<?php if ( have_rows( 'list_reviews' ) ) : ?>
			<div class="swiper swiper-reviews d-lg-none pb-5 my-5">
				<div class="swiper-wrapper">
					<?php
					$i = 0;

					while ( have_rows( 'list_reviews' ) ) :
						the_row();
						$i++;
						$type_social = get_sub_field( 'type_social' );
						?>
						<div class="swiper-slide">
							<a class="embed-responsive embed-responsive-1by1 d-block position-relative home-review"
								data-toggle="modal" href="#modal-<?php echo $i ?>">
								<?php echo wp_get_attachment_image( get_sub_field( 'img' ), 'full', '', array( 'class' => 'w-100 h-100 position-absolute img-cover image' ) ) ?>

								<i class="icon">
									<?php echo svg( $type_social ) ?>
								</i>

								<div
									class="text-center text-white overflow-hidden d-flex align-items-center justify-content-center p-3 position-absolute desc">
									<div>

										<?php if ( get_sub_field( 'title' ) ) : ?>
											<div class="text-break"><?php the_sub_field( 'title' ); ?></div>
										<?php endif; ?>
									</div>
								</div>
							</a>
						</div>
					<?php endwhile; ?>
				</div>
				<div class="swiper-pagination swiper-pagination-secondary" style="bottom: 0;"></div>
			</div>
		<?php endif; ?>


		<?php
		$button = get_sub_field( 'btn_all' );
		if ( $button['title'] ) : ?>
			<div class="text-center">
				<a class="d-inline-block btn-all text-uppercase"
					href="<?php echo $button['link']; ?>"><?php echo $button['title']; ?></a>
			</div>
		<?php endif; ?>

	</div>
</section>

<?php if ( have_rows( 'list_reviews' ) ) : ?>

	<?php
    $i=0;
    while ( have_rows( 'list_reviews' ) ) :
		the_row(); 
        $i++;
        $type_social = get_sub_field( 'type_social' );
        ?>
		<div class="modal modal-review" id="modal-<?php echo $i  ?>" tabindex="-1">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<header
						class="d-flex justify-content-center align-items-center py-3 px-4 position-relative">
						<i class="mr-2 icon">
                        <?php echo svg( $type_social ) ?>
                        </i>

						<a href="<?php echo check_link(get_sub_field('link')) ?>" target="_blank" rel="nofollow">
							<span class="font-family-secondary h4 text-uppercase d-block mb-0">
                               <?php  the_sub_field('title') ?>
                            </span>
							<span class="d-block"></span>
						</a>
						<button class="modal-close" type="button" data-dismiss="modal">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
								<path
									d="M193.94 256L296.5 153.44l21.15-21.15c3.12-3.12 3.12-8.19 0-11.31l-22.63-22.63c-3.12-3.12-8.19-3.12-11.31 0L160 222.06 36.29 98.34c-3.12-3.12-8.19-3.12-11.31 0L2.34 120.97c-3.12 3.12-3.12 8.19 0 11.31L126.06 256 2.34 379.71c-3.12 3.12-3.12 8.19 0 11.31l22.63 22.63c3.12 3.12 8.19 3.12 11.31 0L160 289.94 262.56 392.5l21.15 21.15c3.12 3.12 8.19 3.12 11.31 0l22.63-22.63c3.12-3.12 3.12-8.19 0-11.31L193.94 256z">
								</path>
							</svg>
						</button>
					</header>
					<div class="text-center position-relative">
                         <?php echo wp_get_attachment_image(get_sub_field('img'), 'full') ?>
						


					</div>
					<div class="h6 text-break text-center lh-body mb-0 p-4">
						<p><span style="font-weight: 400;"> 
                            <?php  the_sub_field('title') ?></span></p>
					</div>
				</div>
			</div>
			<a class="modal-prev" href="javascript:void(0);">
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
					xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 283.46 283.46"
					style="enable-background:new 0 0 283.46 283.46;" xml:space="preserve">
					<path
						d="M71.85,283.46c0.89-1.8,3.21-7.01,5.97-11.96c21.61-38.77,60.99-78.92,83.14-117.38c5.08-8.81,5.23-15.49,0.13-24.35C138.94,91.31,99.56,53.71,77.94,14.94C75.19,10,72.89,4.81,70.72,0.43c47.78,47.79,95.67,95.67,142.02,142.02C165.97,189.26,117.86,237.41,71.85,283.46z">
					</path>
				</svg>
			</a>
			<a class="modal-next" href="javascript:void(0);">
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
					xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 283.46 283.46"
					style="enable-background:new 0 0 283.46 283.46;" xml:space="preserve">
					<path
						d="M71.85,283.46c0.89-1.8,3.21-7.01,5.97-11.96c21.61-38.77,60.99-78.92,83.14-117.38c5.08-8.81,5.23-15.49,0.13-24.35C138.94,91.31,99.56,53.71,77.94,14.94C75.19,10,72.89,4.81,70.72,0.43c47.78,47.79,95.67,95.67,142.02,142.02C165.97,189.26,117.86,237.41,71.85,283.46z">
					</path>
				</svg>
			</a>
		</div>
	<?php endwhile; ?>

<?php endif; ?>