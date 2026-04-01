<div id="slideshow_wrapper">
	<div class="slideshow slider_banner">
		<?php if ( have_rows( 'list_image' ) ) : ?>
			<?php while ( have_rows( 'list_image' ) ) :
				the_row(); ?>
				<div class="slide">
					<div class="slide_image"
						style="background-image:url(<?php echo the_sub_field( 'img' ) ?>)">
						<div class="slide_content">
							<div class="container">
								<?php if ( get_sub_field( 'title' ) ) : ?>
									<h2 class="title">
										<?php the_sub_field( 'title' ); ?>
									</h2>
								<?php endif; ?>
								<?php if ( get_sub_field( 'desc' ) ) : ?>
									<div class="desc">
										<?php the_sub_field( 'desc' ); ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
	<div class="caption_wrapper show_player_icon">
		<a id="play_video" href="javascript:;" title="Play video" aria-label="Play video"></a>
	</div>
	<div class="container_video">
		<a class="stop_video" href="javascript:;" title="Stop video" aria-label="Stop video"></a>
		<a id="volume_video" class="is_muted" href="javascript:;" title="Volume video"
			aria-label="Volume video"></a>
		<?php if ( get_sub_field( 'video_link' ) ) : ?>
			<video id="video_slideshow" preload="auto" playsinline="" muted="" loop="">
				<source src="<?php the_sub_field( 'video_link' ); ?>" type="video/mp4">
				Sorry, your browser doesn't support embedded videos.
			</video>
		<?php endif; ?>
	</div>
</div>
<section class="form_date-search">
	<div class="container">
		<div class="row reserv-panel ">
			<div class="col-12 col-lg-10 offset-lg-1 reserv-in">
				<form class="px-3 py-2 form-check position-relative" action="#">
					<div class="row align-items-center">
						<div class="col-12 col-lg-3">
							<div class="title"><?php _e('Period of stay', 'kmar') ?></div>
						</div>
						<div class="col-12 col-lg-5">
							<div class="d-flex align-items-center">
								<span class="p-2">
									<input id="checkInInput"
										class="form-control text-center sedate checkInInput"
										name="checkInDate" type="text" value="">
								</span>
								<span class="p-2">
									<input id="checkOutInput"
										class="form-control text-center sedate checkOutInput"
										name="checkOutDate" type="text" value="">
								</span>
							</div>
						</div>
						<div class="col-12 col-lg-2">
							<input id="adults" type="number" class="chk-adults" name="adults"
								value="1" max="10"> <?php _e('people', 'kmar') ?>
						</div>
						<div class="col-12 col-lg-2">
							<button type="submit" class="reserv-btn"><?php _e('Search', 'kmar') ?></button>
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</section>