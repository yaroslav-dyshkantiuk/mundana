<form class="d-flex" method="get" id="searchform" action="<?php echo home_url('/') ?>">
	<input name="s" id="s" class="form-control mr-2" type="search" placeholder="<?php esc_html_e( 'Search', 'mundana' ) ?>" aria-label="Search">
	<button class="btn btn-outline-success" type="submit"><?php esc_html_e( 'Search', 'mundana' ) ?></button>
</form>
