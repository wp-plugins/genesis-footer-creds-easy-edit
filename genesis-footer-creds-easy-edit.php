<?php
/*
Plugin Name: Genesis footer creds easy edit
Plugin URI: http://alesiadev.com
Description: Creates a metabox in the Genesis theme settings in order to change the default footer for a custom one.
Version: 1.0
Author: Antonio Perez
Author URI: http://alesiadev.com
License: GPL 2+
Notes: 
*/

//First we register the default value for the creds in the footer

function apc_be_footer_creds_default( $default ) {

	$default['genesis_footer_creds'] = '<p>Custom credits: Plugin desarrollado por <a href="http://alesiadev.com">AlesiaDEV</a></p>';

	return $default;
}
add_filter( 'genesis_theme_settings_defaults', 'apc_be_footer_creds_default' );


//We sanitize in order people cannot include dangerous scripts in the footer metabox

function apc_be_register_footer_creds_filters() {
	genesis_add_option_filter( 'safe_html', GENESIS_SETTINGS_FIELD,
		array(
			'genesis_footer_creds',
		) );
}
add_action( 'genesis_settings_sanitizer_init', 'apc_be_register_footer_creds_filters' );


//We register the metabox

function apc_register_footer_creds_box( $_genesis_theme_settings_pagehook ) {
	add_meta_box('apc_footer_creds_html', 'Footer Credits (HTML)', 'apc_footer_creds_box', $_genesis_theme_settings_pagehook, 'main', 'high');
}
add_action('genesis_theme_settings_metaboxes', 'apc_register_footer_creds_box');

//We create the metabox

function apc_footer_creds_box() {
	?>

	<p>Please enter your custom credits:<br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[genesis_footer_creds]" value="<?php echo esc_attr( genesis_get_option('genesis_footer_creds') ); ?>" size="75" /> </p>

	<?php
}


//Changing the Credits stored in genesis admin options
function apc_change_footer_credits() {

	$creds = genesis_get_option('genesis_footer_creds');
	
	echo $creds;

}
add_filter('genesis_footer_creds_text', 'apc_change_footer_credits');


