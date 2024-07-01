<?php get_header(); ?>

<!--------------------------------------
Main
--------------------------------------->
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8">

            <h5 class="font-weight-bold spanborder"><span><?php _e( 'Search by query: ', 'mundana' ); ?></span> <?php echo get_search_query() ?></h5>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content' ) ?>

			<?php endwhile; ?>

				<?php the_posts_pagination( array(
					'type' => 'list',
				) ); ?>

			<?php else: ?>
                <p><?php _e( 'No entries.', 'mundana' ); ?></p>
			<?php endif; ?>

        </div>

		<?php get_sidebar(); ?>

    </div>
</div>

<!-- End Main -->

<?php get_footer(); ?>
