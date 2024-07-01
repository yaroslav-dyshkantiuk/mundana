<div class="wrap mundana-options">

	<h1><?php echo __( 'Theme Options Page', 'mundana' ) ?></h1>

    <?php settings_errors(); ?>

    <form action="options.php" method="post">

        <?php settings_fields( 'mundana_general_group' ); ?>

        <?php do_settings_sections( 'mundana-options' ); ?>

        <?php submit_button(); ?>

    </form>

</div>
