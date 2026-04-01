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
			<?php the_title() ?>
		</h1>
		<div id="main_content_wrap" class="container">
			<div class="content-wrapper">
				<?php the_content() ?>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
