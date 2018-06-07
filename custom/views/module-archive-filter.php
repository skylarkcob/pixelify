<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$filters = array(
	'recent'         => __( 'Recent', 'hocwp-theme' ),
	'most_popular'   => __( 'Popular', 'hocwp-theme' ),
	'handpicked'     => __( 'Handpicked', 'hocwp-theme' ),
	'most_downloads' => __( 'Most Downloads', 'hocwp-theme' )
);

$filter = HT()->get_method_value( 'filter', 'get', 'recent' );

$license1 = HT()->get_method_value( 'license1', 'get' );
$l1_text  = __( 'Free for Personal Use', 'hocwp-theme' );

$license2 = HT()->get_method_value( 'license2', 'get' );
$l2_text  = __( 'Free for Commercial Use', 'hocwp-theme' );
?>
<form method="GET" id="form-filter" action="<?php echo esc_url( HT_Util()->get_current_url() ); ?>">
	<?php do_action( 'hocwp_theme_print_url_params_as_hidden', array( 'filter', 'license1', 'license2' ) ); ?>
	<div class="filter-switches">
		<div class="switch">
			<input id="license-toggle-1" value="<?php echo esc_attr( $l1_text ); ?>" name="license1"
			       class="license-toggle-round"
			       type="checkbox"<?php checked( 0, strcmp( $license1, $l1_text ) ); ?>>
			<label for="license-toggle-1"></label>
			<span><?php echo esc_attr( $l1_text ); ?></span>
		</div>
		<!--/switch-->
		<div class="switch switch-2">
			<input id="license-toggle-2" value="<?php echo esc_attr( $l2_text ); ?>"
			       name="license2" class="license-toggle-round"
			       type="checkbox"<?php checked( 0, strcmp( $license2, $l2_text ) ); ?>>
			<label for="license-toggle-2"></label>
			<span><?php echo esc_attr( $l2_text ); ?></span>
		</div>
		<!--/switch-->
	</div>
	<!--/filter-switches-->
	<div class="query-filter">
		<?php
		foreach ( $filters as $key => $label ) {
			?>
			<input id="<?php echo esc_attr( $key ); ?>" type="radio" name="filter"
			       value="<?php echo esc_attr( $key ); ?>"<?php checked( $filter, $key ); ?>>
			<label for="<?php echo esc_attr( $key ); ?>"><?php echo $label; ?></label>
			<?php
		}
		?>
	</div>
	<!--/query-filter-->
	<button class="apply-filter"><?php _e( 'Apply filter', 'hocwp-theme' ); ?></button>
</form>