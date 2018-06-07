<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Add meta boxes to post types.
 */
function hocwp_theme_custom_post_meta() {
	$meta = new HOCWP_Theme_Meta_Post();
	$meta->add_post_type( 'post' );

	$meta->form_table = true;

	$args  = array(
		'options' => array(
			'license1' => __( 'Free for Personal Use', 'hocwp-theme' ),
			'license2' => __( 'Free for Commercial Use', 'hocwp-theme' )
		),
		'type'    => 'checkbox'
	);
	$field = hocwp_theme_create_meta_field( 'license', __( 'Licenses', 'hocwp-theme' ), 'input', $args, 'boolean' );
	$meta->add_field( $field );
}

add_action( 'load-post.php', 'hocwp_theme_custom_post_meta' );
add_action( 'load-post-new.php', 'hocwp_theme_custom_post_meta' );

/**
 * Add custom meta fields for term.
 */
function hocwp_theme_custom_term_meta() {

}

add_action( 'load-edit-tags.php', 'hocwp_theme_custom_term_meta' );

function hocwp_theme_custom_post_submitbox_misc_actions_action( $post ) {
	$type  = get_post_type_object( $post->post_type );
	$value = get_post_meta( $post->ID, 'exclusive', true );
	?>
	<div class="misc-pub-section misc-pub-exclusive">
		<input type="checkbox" id="exclusive" name="exclusive" value="1" <?php checked( 1, $value ); ?>>
		<label
			for="exclusive"><?php printf( __( 'Make this %s as exclusive?', 'hocwp-theme' ), $type->labels->singular_name ); ?></label>
	</div>
	<?php
	$value = get_post_meta( $post->ID, 'handpicked', true );
	?>
	<div class="misc-pub-section misc-pub-handpicked">
		<input type="checkbox" id="handpicked" name="handpicked" value="1" <?php checked( 1, $value ); ?>>
		<label
			for="handpicked"><?php printf( __( 'Hand-picked %s?', 'hocwp-theme' ), $type->labels->singular_name ); ?></label>
	</div>
	<?php
}

add_action( 'post_submitbox_misc_actions', 'hocwp_theme_custom_post_submitbox_misc_actions_action' );

function hocwp_theme_custom_save_post_action( $post_id ) {
	if ( isset( $_POST['exclusive'] ) ) {
		update_post_meta( $post_id, 'exclusive', 1 );
	} else {
		update_post_meta( $post_id, 'exclusive', 0 );
	}

	if ( isset( $_POST['handpicked'] ) ) {
		update_post_meta( $post_id, 'handpicked', 1 );
	} else {
		update_post_meta( $post_id, 'handpicked', 0 );
	}
}

add_action( 'save_post', 'hocwp_theme_custom_save_post_action' );