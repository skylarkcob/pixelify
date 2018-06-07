<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="menu-container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="logo">
					<?php do_action( 'hocwp_theme_site_branding' ); ?>
				</div>
				<?php do_action( 'hocwp_theme_main_menu' ); ?>
			</div>
		</div>
		<div id="search" class="monstr-main-search">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<form role="search" method="get" class="search-form"
						      action="<?php echo esc_url( home_url() ); ?>">
							<input type="search" class="search-field"
							       placeholder="<?php _e( 'Search...', 'hocwp-theme' ); ?>" value="" name="s"
							       title="<?php _e( 'Search', 'hocwp-theme' ); ?>">

							<div class="monstr-select">
								<span><?php _ex( 'in', 'search in', 'hocwp-theme' ); ?></span>
								<?php
								$cat = HT()->get_method_value( 'cat', 'get' );

								$args = array(
									'hide_empty'      => false,
									'show_option_all' => __( 'All Categories', 'hocwp-theme' ),
									'selected'        => $cat
								);

								wp_dropdown_categories( $args );

								$text = __( 'All Categories', 'hocwp-theme' );

								if ( HT()->is_positive_number( $cat ) ) {
									$category = get_category( $cat );

									if ( $category instanceof WP_Term ) {
										$text = $category->name;
									}
								}
								?>
								<span class="selected-value"><?php echo $text; ?></span>
							</div>
						</form>
						<a class="close monstr-text-replace"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>