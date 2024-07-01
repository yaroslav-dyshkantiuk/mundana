<?php get_header(); ?>

<!--------------------------------------
Main
--------------------------------------->
<div class="container mt-5 mb-5">
	<div class="row">
		<div class="col-md-8">

			<?php if(!is_paged()): ?>

			<?php get_template_part('template-parts/featured_category_post'); ?>
			
			<?php endif; ?>

			<h5 class="font-weight-bold spanborder"><span><?php _e('Latest', 'mundana'); ?></span></h5>

			<?php 
                if ( have_posts() ) : while ( have_posts() ) : the_post();
                    get_template_part('template-parts/content');
                    endwhile;
                    the_posts_pagination(array(
                        'type' => 'list',
                    ));
                else:
                    _e('No entries', 'mundana');
                endif;
            ?>

		</div>
		<?php get_sidebar(); ?>
	</div>
</div>

<!-- End Main -->

<?php
get_footer();
