<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Load theme styles and scripts on front-end.
 */
function hocwp_theme_custom_enqueue_scripts() {
	$src = HOCWP_THEME_CUSTOM_URL . '/lib/';
	wp_enqueue_style( 'bootstrap-style', $src . 'bootstrap/css/bootstrap' . HOCWP_THEME_CSS_SUFFIX );
	wp_enqueue_script( 'bootstrap', $src . 'bootstrap/js/bootstrap' . HOCWP_THEME_JS_SUFFIX, array( 'jquery' ), false, true );
	wp_enqueue_script( 'theia-sticky-sidebar', 'https://cdn.jsdelivr.net/npm/theia-sticky-sidebar@1.7.0/dist/theia-sticky-sidebar.min.js', array( 'jquery' ), false, true );
	wp_enqueue_style( 'font-awesome-style', $src . 'font-awesome/css/font-awesome' . HOCWP_THEME_CSS_SUFFIX );

	$src = HOCWP_THEME_CUSTOM_URL . '/js/';
	wp_enqueue_script( 'floating-social-share', $src . 'floating-social-share' . HOCWP_THEME_JS_SUFFIX, array( 'jquery' ), false, true );
	wp_localize_script( 'floating-social-share', 'ajax_var', array(
		'url'     => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce(),
		'loading' => HT_Util()->get_custom_image_url( 'ajax-loader.gif' ),
		'text'    => array(
			'show_me_more'            => __( 'Show Me More', 'hocwp-theme' ),
			'no_more_posts_available' => __( 'No more posts available...', 'hocwp-theme' ),
			'loading'                 => __( 'Loading...', 'hocwp-theme' )
		)
	) );
	wp_enqueue_script( 'superfish-fluidvids', $src . 'superfish-fluidvids' . HOCWP_THEME_JS_SUFFIX, array( 'jquery' ), false, true );
	wp_enqueue_style( 'owl-carousel-style', HOCWP_THEME_CUSTOM_URL . '/css/owl.carousel' . HOCWP_THEME_CSS_SUFFIX );
	wp_enqueue_script( 'owl-carousel', $src . 'owl.carousel' . HOCWP_THEME_JS_SUFFIX, array( 'jquery' ), false, true );
	wp_enqueue_script( 'modernizr', $src . 'modernizr' . HOCWP_THEME_JS_SUFFIX, array( 'jquery' ), false, true );
	wp_enqueue_script( 'post-like', $src . 'post-like' . HOCWP_THEME_JS_SUFFIX, array( 'jquery' ), false, true );
	wp_enqueue_script( 'infinite-scroll', $src . 'infinite-scroll' . HOCWP_THEME_JS_SUFFIX, array( 'jquery' ), false, true );

	if ( ! is_home() ) {
		wp_enqueue_style( 'dashicons' );
	}
}

add_action( 'wp_enqueue_scripts', 'hocwp_theme_custom_enqueue_scripts' );

function hocwp_theme_custom_wp_head_action() {
	echo '<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">';
}

add_action( 'wp_head', 'hocwp_theme_custom_wp_head_action' );

function hocwp_theme_custom_main_menu_args( $args ) {
	$args['container'] = 'nav';

	$class = isset( $args['container_class'] ) ? $args['container_class'] : '';
	$class .= ' fdr-menu';
	$class = trim( $class );

	$args['container_class'] = $class;

	$class = isset( $args['menu_class'] ) ? $args['menu_class'] : '';
	$class .= ' sf-menu sf-js-enabled';
	$class = trim( $class );

	$args['menu_class'] = $class;

	return $args;
}

add_filter( 'hocwp_theme_main_menu_args', 'hocwp_theme_custom_main_menu_args' );

function hocwp_theme_custom_wp_nav_menu_filter( $nav_menu, $args ) {
	if ( 'menu-1' == $args->theme_location ) {
		remove_filter( 'wp_nav_menu', 'hocwp_theme_custom_wp_nav_menu_filter' );
		$menu = wp_nav_menu( array( 'theme_location' => 'top-right', 'echo' => false ) );
		add_filter( 'wp_nav_menu', 'hocwp_theme_custom_wp_nav_menu_filter', 10, 2 );

		if ( ! empty( $menu ) ) {
			$search   = '</ul></' . $args->container . '>';
			$nav_menu = str_replace( $search, '</ul>' . PHP_EOL, $nav_menu );
			$nav_menu .= $menu . PHP_EOL;
			$nav_menu .= '</' . $args->container . '>';
		}

		$nav_menu .= '<a class="monstr-search-trigger monstr-text-replace"></a>' . PHP_EOL;
	}

	return $nav_menu;
}

add_filter( 'wp_nav_menu', 'hocwp_theme_custom_wp_nav_menu_filter', 10, 2 );

function hocwp_theme_custom_wp_nav_menu_args_filter( $args ) {
	if ( 'top-right' == $args['theme_location'] ) {
		$args['container']   = false;
		$args['fallback_cb'] = false;

		$class = isset( $args['menu_class'] ) ? $args['menu_class'] : '';
		$class .= ' sf-menu top_right-menu sf-js-enabled';
		$class = trim( $class );

		$args['menu_class'] = $class;
	}

	return $args;
}

add_filter( 'wp_nav_menu_args', 'hocwp_theme_custom_wp_nav_menu_args_filter' );

function hocwp_theme_custom_wp_footer_action() {
	echo '<div class="monstr-cover-layer"></div>' . PHP_EOL;
}

add_action( 'wp_footer', 'hocwp_theme_custom_wp_footer_action' );

function hocwp_theme_custom_site_header_after_action() {
	if ( is_home() ) {
		hocwp_theme_load_custom_module( 'home-slider' );
	} elseif ( is_404() ) {
		?>
		<div class="page-fullwidth">
			<div id="page-header" class="page-header-sub text-left">
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<h1 class="page-title"><?php _e( 'Oops! That page can’t be found.', 'hocwp-theme' ); ?></h1>
						</div>
					</div>
				</div>
			</div>

		</div>
		<?php
	} elseif ( is_page() ) {
		?>
		<div class="page-fullwidth">
			<header class="page-header pv-xs-2 pv-sm-3 pv-lg-4 center-xs">
				<div class="wrapper container">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</div>
			</header>
		</div>
		<?php
	} elseif ( is_search() ) {
		global $wp_query;
		?>
		<div class="header-section">
			<span class="header-background-image"></span>

			<div class="content-wrapper container">
				<div class="heading-meta">
					<h1><?php printf( __( 'Search Results: %s', 'hocwp-theme' ), get_search_query() ); ?></h1>
				</div>
				<!--/heading-meta-->
			</div>
			<!--/content-wrapper-->
		</div>
		<?php
	} elseif ( is_tax() || is_category() || is_tag() ) {
		global $wp_query;

		$term        = get_queried_object();
		$description = $term->description;
		?>
		<div class="header-section">
			<span class="header-background-image"></span>

			<div class="content-wrapper container">
				<div class="heading-meta">
					<h1><?php printf( '%d %s', $wp_query->found_posts, $term->name ); ?></h1>
					<?php
					if ( ! empty( $description ) ) {
						?>
						<div class="header-archive-desc">
							<?php echo wpautop( $description ); ?>
						</div>
						<?php
					}
					?>
				</div>
				<!--/heading-meta-->
			</div>
			<!--/content-wrapper-->
		</div>
		<?php
	} elseif ( is_archive() ) {
		?>
		<div class="header-section">
			<span class="header-background-image"></span>

			<div class="content-wrapper container">
				<div class="heading-meta">
					<h1><?php echo HT_Frontend()->get_archive_title(); ?></h1>
				</div>
				<!--/heading-meta-->
			</div>
			<!--/content-wrapper-->
		</div>
		<?php
	}
}

add_action( 'hocwp_theme_site_header_after', 'hocwp_theme_custom_site_header_after_action' );

function hocwp_theme_custom_wpp_query_fields_filter( $fields, $options ) {
	if ( isset( $options['action'] ) && 'popular' == $options['action'] ) {
		$fields = 'p.ID AS id';
	}

	return $fields;
}

add_filter( 'wpp_query_fields', 'hocwp_theme_custom_wpp_query_fields_filter', 10, 2 );

function hocwp_theme_custom_wpp_query_where_filter( $where, $options ) {
	if ( isset( $options['get_post_views'] ) ) {
		$post_id = $options['get_post_views'];

		if ( HT()->is_positive_number( $post_id ) ) {
			$where .= ' AND p.ID = ' . $post_id;
		}
	}

	return $where;
}

add_filter( 'wpp_query_where', 'hocwp_theme_custom_wpp_query_where_filter', 10, 2 );

function hocwp_theme_custom_pre_get_posts( $query ) {
	if ( $query instanceof WP_Query ) {
		if ( $query->is_main_query() ) {
			if ( $query->is_search() ) {
				$cat = HT()->get_method_value( 'cat', 'get' );

				if ( HT()->is_positive_number( $cat ) ) {
					$query->set( 'cat', $cat );
				} else {
					$query->set( 'cat', '' );
				}

				$query->set( 'post_type', 'post' );
			}
		}

		$post_type = $query->get( 'post_type' );

		if ( empty( $post_type ) || ( is_string( $post_type ) && 'post' == $post_type ) || ( is_array( $post_type ) && in_array( 'post', $post_type ) ) ) {
			$meta_query = $query->get( 'meta_query' );

			if ( ! is_array( $meta_query ) ) {
				$meta_query = array();
			}

			$item = array();

			$filter = HT()->get_method_value( 'filter', 'get' );

			switch ( $filter ) {
				case 'handpicked':
					$item[] = array(
						'key'   => 'handpicked',
						'value' => 1,
						'type'  => 'numeric'
					);
					break;
				case 'most_popular':
					$item[] = array(
						'key'  => 'views',
						'type' => 'numeric'
					);
					$query->set( 'orderby', 'meta_value_num' );
					break;
				case 'most_downloads':
					$item[] = array(
						'key'  => 'downloads',
						'type' => 'numeric'
					);
					$query->set( 'orderby', 'meta_value_num' );
					break;
			}

			$license1 = HT()->get_method_value( 'license1', 'get' );

			if ( ! empty( $license1 ) ) {
				$item[] = array(
					'key'   => 'license1',
					'value' => 1,
					'type'  => 'numeric'
				);
			}

			$license2 = HT()->get_method_value( 'license2', 'get' );

			if ( ! empty( $license2 ) ) {
				$item[] = array(
					'key'   => 'license2',
					'value' => 1,
					'type'  => 'numeric'
				);
			}

			if ( HT()->array_has_value( $item ) ) {
				$item['relation'] = 'AND';
				$meta_query[]     = $item;

				$query->set( 'meta_query', $meta_query );
			}
		}
	}
}

add_action( 'pre_get_posts', 'hocwp_theme_custom_pre_get_posts' );

function hocwp_theme_custom_paginate_links_filter( $link ) {
	$parts = parse_url( $link );
	parse_str( $parts['query'], $query );

	if ( HT()->array_has_value( $query ) ) {
		$link = strtok( $link, '?' );
		$link = add_query_arg( $query, $link );
	}

	return $link;
}

//add_filter( 'paginate_links', 'hocwp_theme_custom_paginate_links_filter' );

function hocwp_theme_custom_template_redirect_action() {
	global $wp_query;

	if ( ! $wp_query->have_posts() ) {
		$filter = HT()->get_method_value( 'filter', 'get' );

		if ( ! empty( $filter ) || isset( $_GET['license1'] ) || isset( $_GET['license2'] ) ) {
			$url = HT_Util()->get_current_url();
			$url = strtok( $url, '?' );
			wp_redirect( $url );
			exit;
		}
	}
}

add_action( 'template_redirect', 'hocwp_theme_custom_template_redirect_action' );

function hocwp_theme_custom_wp_action() {
	if ( is_single() && class_exists( 'WPP_Query' ) ) {
		$post_id = get_the_ID();
		$tmp     = new WPP_Query( array( 'range' => 'all', 'get_post_views' => $post_id ) );
		$posts   = $tmp->get_posts();

		if ( HT()->array_has_value( $posts ) ) {
			$obj = $posts[0];

			update_post_meta( $post_id, 'views', $obj->pageviews );
		}
	}
}

add_action( 'wp', 'hocwp_theme_custom_wp_action' );