<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Add theme setting fields to General tab.
 *
 * @param $fields
 *
 * @param $options
 *
 * @return array
 */
function hocwp_theme_custom_setting_fields( $fields, $options ) {
	$field    = hocwp_theme_create_setting_field( 'licenses_page', __( 'Licenses Page', 'hocwp-theme' ), 'select_page' );
	$fields[] = $field;

	$field    = hocwp_theme_create_setting_field( 'footer_logo', __( 'Footer Logo', 'hocwp-theme' ), 'media_upload' );
	$fields[] = $field;

	$args     = array();
	$field    = hocwp_theme_create_setting_field( 'footer_text', __( 'Footer Text', 'hocwp-theme' ), 'editor', $args, 'html' );
	$fields[] = $field;

	return $fields;
}

add_filter( 'hocwp_theme_setting_fields', 'hocwp_theme_custom_setting_fields', 99, 2 );

/**
 * Add theme setting fields to Home tab, using for home page.
 *
 * @param $fields
 * @param $options
 *
 * @return array
 */
function hocwp_theme_custom_setting_page_home_fields( $fields, $options ) {
	$field    = hocwp_theme_create_setting_field_for_home( 'slider_title', __( 'Slider Title', 'hocwp-theme' ) );
	$fields[] = $field;

	$args     = array();
	$field    = hocwp_theme_create_setting_field_for_home( 'slider_description', __( 'Slider Description', 'hocwp-theme' ), 'editor', $args, 'html' );
	$fields[] = $field;

	return $fields;
}

add_filter( 'hocwp_theme_setting_page_home_fields', 'hocwp_theme_custom_setting_page_home_fields', 99, 2 );

/**
 * Add theme setting sections to General tab.
 *
 * @param $sections
 *
 * @return array
 */
function hocwp_theme_custom_setting_sections( $sections ) {

	return $sections;
}

add_filter( 'hocwp_theme_setting_sections', 'hocwp_theme_custom_setting_sections' );

/**
 * Add theme setting sections to Home tab.
 *
 * @param $sections
 *
 * @return array
 */
function hocwp_theme_custom_setting_page_home_sections( $sections ) {

	return $sections;
}

add_filter( 'hocwp_theme_setting_page_home_sections', 'hocwp_theme_custom_setting_page_home_sections' );