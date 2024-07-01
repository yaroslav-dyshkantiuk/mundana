<?php

add_action( 'admin_menu', 'mundana_add_admin_page' );

function mundana_add_admin_page() {
	$hook_suffix = add_menu_page( __( 'WFM Theme Options', 'mundana' ), __( 'WFMTheme', 'mundana' ), 'manage_options', 'mundana-options', 'mundana_create_page', get_template_directory_uri() . '/assets/img/moon.png' );

	add_action( "admin_print_scripts-{$hook_suffix}", 'mundana_admin_scripts' );
	add_action( 'admin_init', 'mundana_custom_settings' );
}

function mundana_custom_settings() {
	// Register settings
	register_setting( 'mundana_general_group', 'main_post' );
	register_setting( 'mundana_general_group', 'main_post_cnt', function ( $input ) {
		$input = abs( (int) $input );

		return ( $input < 5 ) ? $input : 4;
	} );
	register_setting( 'mundana_general_group', 'author_avatar' );
	register_setting( 'mundana_general_group', 'main_facebook' );
	register_setting( 'mundana_general_group', 'main_twitter' );

	// Register sections
	add_settings_section( 'mundana_general_section', __( 'Home page settings', 'mundana' ), '', 'mundana-options' );
	add_settings_section( 'mundana_general_section2', __( 'Social network', 'mundana' ), '', 'mundana-options' );

	// Add fields
	add_settings_field( 'main_post', __( 'Home article', 'mundana' ), 'mundana_general_main_post', 'mundana-options', 'mundana_general_section' );

	add_settings_field( 'main_post_cnt', __( 'Number of featured posts', 'mundana' ), 'mundana_general_main_post_cnt', 'mundana-options', 'mundana_general_section', array( 'label_for' => 'main_post_cnt' ) );

	add_settings_field( 'author_avatar', __( 'Author avatar', 'mundana' ), 'mundana_general_author_avatar', 'mundana-options', 'mundana_general_section' );

	add_settings_field( 'main_facebook', __( 'Facebook', 'mundana' ), 'mundana_general_main_facebook', 'mundana-options', 'mundana_general_section2' );

	add_settings_field( 'main_twitter', __( 'Twitter', 'mundana' ), 'mundana_general_main_twitter', 'mundana-options', 'mundana_general_section2' );
}

function mundana_general_main_facebook() {
	$main_facebook = esc_attr( get_option( 'main_facebook' ) );
	echo '<input type="text" name="main_facebook" value="' . $main_facebook . '" class="regular-text" id="main_facebook">';
}

function mundana_general_main_twitter() {
	$main_twitter = esc_attr( get_option( 'main_twitter' ) );
	echo '<input type="text" name="main_twitter" value="' . $main_twitter . '" class="regular-text" id="main_twitter">';
}

function mundana_general_author_avatar() {
	$image_id = get_option( 'author_avatar' );

	if( $image = wp_get_attachment_image_src( $image_id ) ) {

		echo '<a href="#" class="mundana-upl"><img src="' . $image[0] . '" /></a>
	      <a href="#" class="mundana-rmv">Remove image</a>
	      <input type="hidden" name="author_avatar" value="' . $image_id . '">';

	} else {

		echo '<a href="#" class="mundana-upl">Upload image</a>
	      <a href="#" class="mundana-rmv" style="display:none">Remove image</a>
	      <input type="hidden" name="author_avatar" value="">';

	}
}

function mundana_general_main_post_cnt() {
	$main_post_cnt = abs( (int)get_option( 'main_post_cnt' ) );
    echo '<input type="number" min="0" max="4" name="main_post_cnt" class="regular-text" id="main_post_cnt" value="' . $main_post_cnt . '">';
}

function mundana_general_main_post() {
	$main_post_id = esc_attr( get_option( 'main_post' ) );

	if ( $main_post_id ) {
		$main_post = get_post( $main_post_id );
	}
	$main_post_title = ! empty( $main_post ) ? $main_post->post_title : '';

	echo '<input type="text" id="main_post" class="regular-text">';

	echo '<p class="description" id="main_post_title">';
	if ( $main_post_title ) {
		echo '<strong>' . __( 'Post selected: ', 'mundana' ) . '</strong>' . $main_post_title . ' <button class="button delete-main-post"><span class="dashicons dashicons-trash"></span></button>';
	}
	echo '</p>';

	echo '<input type="hidden" id="main_post_id" name="main_post" value="' . $main_post_id . '">';
}

function mundana_create_page() {
	require get_template_directory() . '/inc/templates/mundana-options.php';
}

function mundana_admin_scripts() {
	wp_enqueue_style( 'mundana-jquery-ui-style', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.1/themes/base/jquery-ui.css' );
	wp_enqueue_style( 'mundana-main-style', get_template_directory_uri() . '/assets/css/admin-main.css' );

	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}

	wp_register_script( 'mundana-main-js', get_template_directory_uri() . '/assets/js/admin-main.js', array(
		'jquery',
		'jquery-ui-autocomplete'
	), false, true );
	wp_localize_script( 'mundana-main-js', 'mundanaObject', array(
		'nonce'         => wp_create_nonce( 'mundana-nonce' ),
		'post_selected' => __( 'Post selected: ', 'mundana' )
	) );
	wp_enqueue_script( 'mundana-main-js' );
}

/**
 * AJAX functions
 */
add_action( 'wp_ajax_main_post_action', function () {
	check_ajax_referer( 'mundana-nonce' );

	$main_post_s = $_GET['term'];

	$main_posts = get_posts( array(
		's'              => $main_post_s,
		'posts_per_page' => 10,
	) );

	$result = [];
	if ( $main_posts ) {
		foreach ( $main_posts as $main_post ) {
			$res['label'] = $main_post->post_title;
			$res['id'] = $main_post->ID;
			$result[] = $res;
		}
	}

	echo json_encode( $result );
	wp_die();

} );
