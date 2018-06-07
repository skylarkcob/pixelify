<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function hocwp_theme_custom_after_setup_theme_action() {
	register_nav_menu( 'top-right', __( 'Top right menu', 'hocwp-theme' ) );
}

add_action( 'after_setup_theme', 'hocwp_theme_custom_after_setup_theme_action', 99 );

function hocwp_theme_custom_widgets_init_action() {
	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'hocwp-theme' ),
		'id'            => 'footer',
		'description'   => __( 'Footer widget area.', 'hocwp-theme' ),
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<span class="widgettitle widget-title"><strong>',
		'after_title'   => "</strong></span>\n",
	) );
}

add_action( 'widgets_init', 'hocwp_theme_custom_widgets_init_action' );

function hocwp_theme_custom_upload_mimes_filter( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter( 'upload_mimes', 'hocwp_theme_custom_upload_mimes_filter' );