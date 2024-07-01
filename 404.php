<?php get_header(); ?>

    <!--------------------------------------
	MAIN
	--------------------------------------->

    <div class="container pt-4 pb-4">
        <div class="row justify-content-center">

            <div class="col-md-12 col-lg-10">
                <article class="article-post">
                    <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'mundana' ); ?></h1>
                </article>

            </div>
        </div>
    </div>

<?php get_template_part( 'template-parts/featured_posts' ) ?>

    <!-- End Main -->

<?php get_footer(); ?>
