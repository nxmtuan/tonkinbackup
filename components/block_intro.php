<section>
<div class="container-large">
    <?php if( get_sub_field('main_title') ): ?>
        <h2 class="the-title"><?php the_sub_field('main_title'); ?></h2>
    <?php endif; ?>
           
            <div class="main_content_wrap container">
                <div class="subtitle-wrapper">
                    <?php if( get_sub_field('sub_title') ): ?>
                        <h3 class="the-subtitle"><?php the_sub_field('sub_title'); ?></h3>
                    <?php endif; ?>
                    <div class="decoration-wrap">
                        <span class="decoration"></span>
                    </div>
                </div>
                <?php if( get_sub_field('content') ): ?>
                    
                    <div class="content-wrapper">
                    <?php the_sub_field('content'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
</section>