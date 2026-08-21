<?php
$title = get_sub_field( 'title' );
$desc  = get_sub_field( 'desc' );
?>
<section class="main-content">
	<div class="container-small">
		<?php if ( $title ) : ?>
			<h2 class="the-title">
				<?php echo $title; ?>
			</h2>
		<?php endif; ?>

		<?php if ( $desc ) : ?>
			<div id="main_content_wrap" class="container">
				<div class="content-wrapper text-center">
					<?php echo $desc; ?>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>
