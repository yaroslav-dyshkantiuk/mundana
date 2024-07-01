<?php get_header(); ?>

<!--------------------------------------
HEADER
--------------------------------------->
<?php the_post(); ?>
<div class="container">
	<div class="jumbotron jumbotron-fluid mb-3 pl-0 pt-0 pb-0 bg-white position-relative">
		<div class="h-100 tofront">
			<div class="row justify-content-between">
				<div class="col-md-6 pb-6 pr-6 align-self-center">
					<p class="text-uppercase font-weight-bold category-link">
						<?php the_category(', '); ?>
					</p>
					<h1 class="display-4 secondfont mb-3 font-weight-bold"><?php the_title(); ?></h1>
					<?php if(has_excerpt()) {
						the_excerpt();
					} ?>
					<div class="d-flex align-items-center">
						<?php echo mundana_get_avatar(); ?>
						<small class="ml-2"><?php the_author(); ?> <span class="text-muted d-block"><?php echo mundana_post_time_diff(); ?><?php echo mundana_read_post($post->ID); ?></span>
						</small>
					</div>
				</div>
				<div class="col-md-6 pr-0">
					<?php the_post_thumbnail('full'); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Header -->
    
<!--------------------------------------
MAIN
--------------------------------------->
<?php
	$main_facebook = esc_url(get_option('main_facebook'));
	$main_twitter = esc_url(get_option('main_twitter'));
	if($main_facebook || $main_twitter) {
		$content_class = 'col-lg-8';
	} else {
		$content_class = 'col-lg-10';
	}
?>
<div class="container pt-4 pb-4">
	<div class="row justify-content-center">
		<?php if($main_facebook || $main_twitter): ?>
			<div class="col-lg-2 pr-4 mb-4 col-md-12">
                <div class="sticky-top text-center">
                    <div class="text-muted">
                        <?php _e( 'Follow us', 'mundana' ) ?>
                    </div>
                    <div class="share d-inline-block">
                        <!-- AddToAny BEGIN -->
                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
	                        <?php if ( $main_facebook ): ?>
                                <a href="<?php echo $main_facebook; ?>" class="mundana-icon mundana-facebook-icon"><i class="fab fa-facebook"></i></a>
	                        <?php endif; ?>

	                        <?php if ( $main_twitter ): ?>
                                <a href="<?php echo $main_twitter; ?>" class="mundana-icon mundana-twitter-icon"><i class="fab fa-twitter-square"></i></a>
	                        <?php endif; ?>
                        </div>
                        <!-- AddToAny END -->
                    </div>
                </div>
            </div>
		<?php endif; ?>
		<div class="col-md-12 <?php echo $content_class; ?>">
			<article class="article-post">
				<?php the_content(); ?>
			</article>
		</div>
	</div>
</div>
  
<?php get_template_part('template-parts/featured_posts'); ?>
<!-- End Main -->

<?php get_footer(); ?>
