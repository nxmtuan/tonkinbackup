<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kmar
 */

get_header();
?>
<?php get_template_part( 'components/page_banner' ) ?>
<?php get_template_part( 'components/breadcrumb' ) ?>
<section class="main-content ">
	<div class="container">
		<h1 class="the-title">
			<?php echo get_the_archive_title() ?>
		</h1>
		<?php if ( get_the_archive_description() ) : ?>
			<div id="main_content_wrap" class="container">
				<div class="content-wrapper text-center">
					<?php the_archive_description() ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>


<?php if ( have_posts() ) : ?>
	<div id="rooms" class="children section">
		<div class="container-large">
			<div class="children-wrap ajax-wrap">
				<?php while ( have_posts() ) :
					the_post();
					?>
					<div class="single-child-wrap ">
						<?php get_template_part( 'template-parts/content', get_post_type() ) ?>
					</div>
				<?php endwhile;
				?>
			</div>
		</div>
	</div>
	<?php
	kmar_pagination();
endif;
wp_reset_postdata(); ?>
<?php
get_footer();
