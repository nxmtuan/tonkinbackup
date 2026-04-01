<section class="main-content ">
	<div class="container-small">
		<?php if ( get_field( 'trip_intro_title', 'option' ) ) : ?>
			<h2 class="the-title">
				<?php the_field( 'trip_intro_title', 'option' ); ?>
			</h2>
		<?php endif; ?>

		<?php if ( get_field( 'trip_intro_content', 'option' ) ) : ?>
			<div id="main_content_wrap" class="container">
				<div class="content-wrapper text-center">
					<?php the_field( 'trip_intro_content', 'option' ); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
<?php
$terms = get_terms( array(
	'taxonomy' => 'cat_trip',
	'hide_empty' => false,
) );

if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>
	<section class="filter_wrapper">
		<div class="container-large">
			<div class="filter-wrap">
				<div class="decoration-line"></div>
				<div class="filter_container">
					<a tracking-name="All" class="active" href="javascript:;"
						data-category=".all-items">
						<?php _e( 'All', 'kmar' ) ?>
					</a>
					<?php foreach ( $terms as $term ) : ?>
						<a class="" href="javascript:;"
							tracking-name="<?php echo esc_attr( $term->slug ); ?>"
							aria-label="Filter by <?php echo esc_attr( $term->name ); ?>"
							data-category=".filter_<?php echo esc_attr( $term->term_id ); ?>">
							<?php echo esc_html( $term->name ); ?>
						</a>
					<?php endforeach; ?>
				</div>
				<div class="decoration-line"></div>
			</div>
			<div class="filter-wrap-mobile">
				<select>
					<option tracking-name="All" value=".all-items">All</option>
					<?php foreach ( $terms as $term ) : ?>
						<option tracking-name="<?php echo esc_attr( $term->slug ); ?>"
							value=".filter_<?php echo esc_attr( $term->term_id ); ?>">
							<?php echo esc_html( $term->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</section>
<?php endif; ?>


<?php
$paged = isset( $_POST['paged'] ) ? intval( $_POST['paged'] ) : 1;
$posts_per_page = 6;
$args = array(
	'post_type' => 'trip',
	'paged' => $paged,
	'posts_per_page' => $posts_per_page,
	'post_status' => 'publish',
);
$query = new WP_Query( $args );
$total_pages = $query->max_num_pages;
if ( $query->have_posts() ) : ?>
	<div id="itineraries" class="children section">
		<div class="container-large">
			<div class="children-wrap ajax-wrap">
				<?php while ( $query->have_posts() ) :
					$query->the_post();
					$terms = get_the_terms( get_the_ID(), 'cat_trip' );
					$categories_class = 'all-items default';
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) )
					{
						foreach ( $terms as $term )
						{
							$categories_class .= ' filter_' . esc_attr( $term->term_id );
						}
					}
					?>
					<div class="single-child-wrap <?php echo $categories_class; ?>">

						<?php get_template_part('template-parts/content',get_post_type())  ?>

					</div>
				<?php endwhile;
				wp_reset_postdata(); ?>
			</div>

			<?php if ( $total_pages > 1 ) : ?>
				<nav aria-label="Page navigation">
					<ul class="pagination-cus border-pagination" data-post-type="trip">
						<li class="page-item prev <?php echo ( $paged <= 1 ) ? 'disabled' : ''; ?>">
							<a class="" href="#"
								data-paged="<?php echo ( $paged > 1 ) ? $paged - 1 : 1; ?>">&laquo;</a>
						</li>
						<?php for ( $i = 1; $i <= $total_pages; $i++ ) : ?>
							<li class="page-item ">
								<a class="<?php echo ( $i == $paged ) ? 'active' : ''; ?>" href="#"
									data-paged="<?php echo $i; ?>"><?php echo $i; ?></a>
							</li>
						<?php endfor; ?>
						<li
							class="page-item next <?php echo ( $paged >= $total_pages ) ? 'disabled' : ''; ?>">
							<a class="" href="#"
								data-paged="<?php echo ( $paged < $total_pages ) ? $paged + 1 : $total_pages; ?>">
								&raquo;</a>
						</li>
					</ul>
				</nav>
			<?php endif; ?>

		</div>
	</div>
<?php endif; ?>