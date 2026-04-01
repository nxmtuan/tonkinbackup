<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kmar
 */

?>

<?php the_field( 'script_body', 'option' ); ?>
<?php wp_footer(); ?>

<footer id="footer" role="contentinfo">
	<?php if ( get_field( 'footer_logo', 'option' ) ) : ?>
		<div id="footer_social">
			<div class="container-large">
				<div id="footer_logo" class="footer_logo" role="banner">
					<a class="logo" href="<?php echo get_home_url() ?>" title="Back to homepage"
						aria-label="Back to homepage">
						<?php echo wp_get_attachment_image( get_field( 'footer_logo', 'option' ), 'full', '', array( 'class' => 'lazy' ) ) ?>
					</a>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php if ( have_rows( 'footer_list_menu', 'option' ) ) : ?>
		<div class="footer_menu">
			<div class="container-large">
				<div class="footer-middle-menu">
					<?php while ( have_rows( 'footer_list_menu', 'option' ) ) :
						the_row(); ?>
						<div class="footer-middle-box">
							<?php if ( have_rows( 'list_menu' ) ) : ?>
								<ul class="menu">
									<?php while ( have_rows( 'list_menu' ) ) :
										the_row(); ?>
										<li>
											<a href="<?php echo check_link( get_sub_field( 'link' ) ) ?>">
												<?php the_sub_field( 'title' ); ?>
											</a>
										</li>
									<?php endwhile; ?>
								</ul>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>



	<?php if ( get_field( 'footer_logo_member', 'option' ) ) : ?>

		<div class="accor-brands">
			<div class="container-large">
				<div class="footer-all-logo-wrapper">
					<div class="separator"></div>
					<div id="footer-all-logo" class="footer-all-logo" role="banner">
						<div class="logo">
							<?php echo wp_get_attachment_image( get_field( 'footer_logo_member', 'option' ), 'full' ) ?>
						</div>
					</div>
					<div class="separator"></div>
				</div>

			</div>
		</div>
	<?php endif; ?>
	<?php if ( get_field( 'copyright', 'option' ) ) : ?>

		<div id="footer_copyright">
			<div class="container-large">
				<div id="copyright">
					<span><?php the_field( 'copyright', 'option' ); ?></span>
				</div>
			</div>
		</div>
	<?php endif; ?>
</footer>
<a class="back-to-top" href="javascript:void(0);" aria-label="Back to top">
	<span class="icon thumb "
		style="background-image:url(<?php echo get_stylesheet_directory_uri() ?>/assets/svg/arrowhead-up.webp)"></span>
	<span class="label">
		<?php _e( 'Back to top', 'kmar' ) ?>
	</span>
</a>

<div class="modal fade" id="tripModal" tabindex="-1" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php
				$form_id = 319;
				$form = wpforms()->form->get( $form_id );

				if ( $form )
				{
					$form_title = $form->post_title; 
				} 
				?>

				<h5 class="the-title text-center py-0"><?php echo esc_html( $form_title ); ?></h5>
			<div class="modal-body">
				<?php echo do_shortcode( '[wpforms id="319"]' ) ?>
			</div>

		</div>
	</div>
</div>

<?php if ( get_field( 'script_js', 'option' ) )
{ ?>
	<script>
		<?php the_field( 'script_js', 'option' ); ?>
	</script>
<?php } ?>
<?php
if ( get_field( 'script_footer', 'option' ) )
{
	the_field( 'script_footer', 'option' );
}
?>
</body>

</html>