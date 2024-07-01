<?php get_header() ?>

<!--------------------------------------
HEADER
--------------------------------------->
<?php if(!is_paged()): ?>
    <?php
    $main_post_id = get_option('main_post');

    if($main_post_id) {
        $post = get_post($main_post_id);
    }
    if($main_post_id && ! empty($post)):
        setup_postdata($post);

    ?>
    <div class="container">
        <div class="jumbotron jumbotron-fluid mb-3 pt-0 pb-0 bg-lightblue position-relative">
            <div class="pl-4 pr-0 h-100 tofront">
                <div class="row justify-content-between">
                    <div class="col-md-6 pt-6 pb-6 align-self-center">
                        <h1 class="secondfont mb-3 font-weight-bold"><?php the_title(); ?></h1>
                        <?php the_content(''); ?>
                        <a href="<?php the_permalink(); ?>" class="btn btn-dark"><?php esc_html_e('Read More', 'mundana'); ?></a>
                    </div>
                    <div class="col-md-6 d-none d-md-block pr-0 mt-3" style="background-size:cover;background-image:url(<?php echo the_post_thumbnail_url('full'); ?>);">	</div>
                </div>
            </div>
        </div>
    </div>
    <?php wp_reset_postdata(); endif; ?>
<!-- End Header -->


<!--------------------------------------
MAIN
--------------------------------------->
    <?php get_template_part('template-parts/featured_posts'); ?>
<?php endif; ?>

<div class="container">
    <div class="row justify-content-between">
        <div class="col-md-8">
            <h5 class="font-weight-bold spanborder"><span><?php _e('All Stories', 'mundana'); ?></span></h5>
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

<?php get_footer() ?>
