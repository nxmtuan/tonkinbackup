<div class="preview-quote-block single-section ">
	<div class="preview-quote-wrapper">
		<?php if ( get_sub_field( 'quote' ) ) : ?>
			<div class="quote-block-text">
				<?php the_sub_field( 'quote' ); ?>
			</div>
		<?php endif; ?>
		<?php if ( get_sub_field( 'quote_author' ) ) : ?>
			<div class="quote-block-author">
				<?php the_sub_field( 'quote_author' ); ?>
			</div>
		<?php endif; ?>
	</div>
</div>