<?php
$type = get_sub_field( 'type' );
if ( $type == 'one' ) : ?>
	<div class="images-section-wrap single-section only_one_image">
		<div class="container-large">
			<div class="images-section-container layout_square  ">
				<div class="single-image full ">
					<div class="thumb lazy"
						style="background-image: url('<?php the_sub_field( 'img' ) ?>');">
					</div>
				</div>
			</div>
		</div>
	</div>
<?php elseif ( $type == 'two' ) : ?>
	<div class="two-images-section-wrap single-section">
		<div class="container-large">
			<div class="two-images-section right_tall">
				<div class="left-image-wrap">
					<div class="thumb lazy"
						style="background-image: url('<?php the_sub_field( 'img_small' ) ?>');">
					</div>
				</div>
				<div class="right-image-wrap">
					<div class="thumb lazy"
						style="background-image: url('<?php the_sub_field( 'img_big' ) ?>');">
					</div>
				</div>
			</div>
		</div>
	</div>
<?php else : ?>
	<div class="images-section-wrap single-section ">
		<div class="container-large">
			<div class="images-section-container layout_vertical  ">
				<div class="single-image half-vertical " style="height: 999.968px;">
					<div class="thumb lazy"
						style="background-image: url('<?php the_sub_field( 'img_1' ) ?>');">
					</div>
				</div>
				<div class="single-image half ">
					<div class="thumb lazy"
						style="background-image: url('<?php the_sub_field( 'img_2' ) ?>');">
					</div>
				</div>
				<div class="single-image half ">
					<div class="thumb lazy"
						style="background-image: url('<?php the_sub_field( 'img_3' ) ?>');">
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>