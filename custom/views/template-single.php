<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'wp_star_rating' ) ) {
	require ABSPATH . 'wp-admin/includes/template.php';
}

while ( have_posts() ) {
	the_post();
	$rating = get_post_meta( get_the_ID(), 'rating', true );
	$rates  = get_post_meta( get_the_ID(), 'rates', true );

	$user_id = get_the_author_meta( 'ID' );

	$rating = floatval( $rating );
	$rating = round( $rating, 1 );
	ob_start();
	?>
	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
	   class="readmore"><?php the_author(); ?></a>
	<?php
	$author = ob_get_clean();

	ob_start();
	the_category( ', ' );
	$links = ob_get_clean();
	?>
	<div class="content-wrapper container">
		<div class="row">
			<div class="col-xs-12 col-md-8">
				<div class="content-area">
					<main id="main" class="site-main" role="main">
						<article <?php post_class(); ?>>
							<h1><?php the_title(); ?></h1>

							<div class="download-single-meta">
								<?php printf( _x( '%s in %s', 'author category', 'hocwp-theme' ), $author, $links ); ?>
							</div>
							<div class="entry-content">
								<?php the_content(); ?>
							</div>
						</article>
					</main>
				</div>
			</div>
			<div class="col-xs-12 col-md-4">
				<div class="primary-sidebar">
					<div class="star-reviews">
						<?php
						$args = array(
							'rating' => $rating,
							'type'   => 'rating',
							'number' => 12345
						);
						wp_star_rating( $args );
						?>
						<div class="rating-number">
							<?php
							if ( ! empty( $rating ) ) {
								echo '<strong>' . $rating . '</strong>';
							}
							?>
							<span>(<?php echo absint( $rates ); ?>)</span>
						</div>
					</div>
					<div class="sidebar-download-button">
						<form id="edd_purchase_971120" class="edd_download_purchase_form">
							<div class="edd_free_downloads_form_class">
								<a class="button blue edd-submit edd-submit edd-free-download edd-free-download-single"
								   href="#edd-free-download-modal"
								   data-download-id="<?php the_ID(); ?>">
									<span><?php _e( 'Download for Free', 'hocwp-theme' ); ?></span>
									<span><?php _e( 'You must credit the author', 'hocwp-theme' ); ?></span>
								</a>
							</div>
						</form>
					</div>
					<div class="sidebar-social-share">


						<p>Credit the author by sharing. Thanks!</p>


						<div class="like-wishlist">

							<div id="likes" class="likes">
								<div>
									<div id="wp-ulike-post-971120" class="wpulike wpulike-robeen ">
										<div class="wp_ulike_general_class wp_ulike_is_liked"><label> <input
													type="checkbox" data-ulike-id="971120"
													data-ulike-nonce="9e07f77163"
													data-ulike-type="likeThis"
													data-ulike-status="2"
													class="wp_ulike_btn wp_ulike_put_image image-unlike">
												<svg class="heart-svg" viewBox="467 392 58 57"
												     xmlns="http://www.w3.org/2000/svg">
													<g class="Group" fill="none" fill-rule="evenodd"
													   transform="translate(467 392)">
														<path
															d="M29.144 20.773c-.063-.13-4.227-8.67-11.44-2.59C7.63 28.795 28.94 43.256 29.143 43.394c.204-.138 21.513-14.6 11.44-25.213-7.214-6.08-11.377 2.46-11.44 2.59z"
															class="heart" fill="#AAB8C2"></path>
														<circle class="main-circ" fill="#E2264D" opacity="0" cx="29.5"
														        cy="29.5" r="1.5"></circle>
														<g class="grp7" opacity="0" transform="translate(7 6)">
															<circle class="oval1" fill="#9CD8C3" cx="2" cy="6"
															        r="2"></circle>
															<circle class="oval2" fill="#8CE8C3" cx="5" cy="2"
															        r="2"></circle>
														</g>
														<g class="grp6" opacity="0" transform="translate(0 28)">
															<circle class="oval1" fill="#CC8EF5" cx="2" cy="7"
															        r="2"></circle>
															<circle class="oval2" fill="#91D2FA" cx="3" cy="2"
															        r="2"></circle>
														</g>
														<g class="grp3" opacity="0" transform="translate(52 28)">
															<circle class="oval2" fill="#9CD8C3" cx="2" cy="7"
															        r="2"></circle>
															<circle class="oval1" fill="#8CE8C3" cx="4" cy="2"
															        r="2"></circle>
														</g>
														<g class="grp2" opacity="0" transform="translate(44 6)"
														   fill="#CC8EF5">
															<circle class="oval2" transform="matrix(-1 0 0 1 10 0)"
															        cx="5" cy="6" r="2"></circle>
															<circle class="oval1" transform="matrix(-1 0 0 1 4 0)"
															        cx="2" cy="2" r="2"></circle>
														</g>
														<g class="grp5" opacity="0" transform="translate(14 50)"
														   fill="#91D2FA">
															<circle class="oval1" transform="matrix(-1 0 0 1 12 0)"
															        cx="6" cy="5" r="2"></circle>
															<circle class="oval2" transform="matrix(-1 0 0 1 4 0)"
															        cx="2" cy="2" r="2"></circle>
														</g>
														<g class="grp4" opacity="0" transform="translate(35 50)"
														   fill="#F48EA7">
															<circle class="oval1" transform="matrix(-1 0 0 1 12 0)"
															        cx="6" cy="5" r="2"></circle>
															<circle class="oval2" transform="matrix(-1 0 0 1 4 0)"
															        cx="2" cy="2" r="2"></circle>
														</g>
														<g class="grp1" opacity="0" transform="translate(24)"
														   fill="#9FC7FA">
															<circle class="oval1" cx="2.5" cy="3" r="2"></circle>
															<circle class="oval2" cx="7.5" cy="2" r="2"></circle>
														</g>
													</g>
												</svg>
												<span class="count-box">10</span> </label>
										</div>
									</div>
									Likes
								</div>
							</div>
							<!--/likes-->


							<div class="collection">


								<a href="#" class="plain  edd-wl-action edd-wl-open-modal glyph-left  edd-has-js"
								   data-action="edd_wl_open_modal" data-download-id="971120" data-variable-price="no"
								   data-price-mode="single"><i class="glyphicon glyphicon-add"></i><span class="label">Collection</span><span
										class="edd-loading" style="margin-left: -9.5px; margin-top: -9.5px;"><i
											class="edd-icon-spinner edd-icon-spin"></i></span></a>

							</div>
							<!--/collection-->


						</div>
						<!--/like-wishlist-->

					</div>
					<div class="sidebar-license-info">

		<span>Free for

				<strong>Commercial Use</strong>


			&nbsp;|&nbsp; </span>
						<a href="/licenses/">License info</a>

					</div>
					<div class="sidebar-author-info">
						<a href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
							<?php echo get_avatar( $user_id ); ?>
						</a>
						<h4>
							<a href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>">
								<?php the_author(); ?>
							</a>
						</h4>

						<div class="follow-button follow" id="follow-button-<?php echo $user_id; ?>"
						     data-author-id="<?php echo $user_id; ?>"><?php _e( 'Follow', 'hocwp-theme' ); ?></div>
						<?php
						$rating = get_user_meta( $user_id, 'rating', true );
						$rates  = get_user_meta( $user_id, 'rates', true );

						$rating = floatval( $rating );
						$rating = round( $rating, 1 );

						$args = array(
							'rating' => $rating,
							'type'   => 'rating',
							'number' => 12345
						);
						wp_star_rating( $args );
						?>
						<div class="rating-number">
							<?php
							if ( ! empty( $rating ) ) {
								echo '<strong>' . $rating . '</strong>';
							}
							?>
							<span>(<?php printf( __( '<strong>%d</strong> Reviews', 'hocwp-theme' ), absint( $rates ) ); ?>)</span>
						</div>
					</div>
					<?php
					$args = array(
						'author'         => get_the_author_meta( 'ID' ),
						'posts_per_page' => 3
					);

					$query = new WP_Query( $args );

					if ( $query->have_posts() ) {
						?>
						<div class="sidebar-more-from-author">
							<h3><?php _e( 'More from this author', 'hocwp-theme' ); ?></h3>
							<a class="see-all-author"
							   href="<?php echo esc_url( get_author_posts_url( $user_id ) ); ?>"><?php printf( __( 'See all (%d)', 'hocwp-theme' ), $query->found_posts ); ?></a>
							<ul class="list-inline list-unstyled">
								<?php
								while ( $query->have_posts() ) {
									$query->the_post();
									?>
									<li>
										<div class="thumbnail-container">
											<a href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail( array( 300, 200, true ) ); ?>
											</a>
										</div>
									</li>
									<?php
								}

								wp_reset_postdata();
								?>
							</ul>

						</div>
						<?php
					}

					if ( has_tag() ) {
						?>
						<div class="sidebar-tags">
							<h3><?php _e( 'Tags', 'hocwp-theme' ); ?></h3>
							<?php the_tags( '', ' ' ); ?>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
	$query = HT_Query()->related_posts();

	if ( $query->have_posts() ) {
		?>
		<div class="related-posts content-area">
			<div class="container">
				<h2 class="text-center"><?php _e( 'You will also love :)', 'hocwp-theme' ); ?></h2>

				<div class="related-post loop-posts">
					<div class="row">
						<?php
						while ( $query->have_posts() ) {
							$query->the_post();
							?>
							<div class="related-post-item post-item grid col-sm-4">
								<?php hocwp_theme_load_custom_loop( 'post-pixel' ); ?>
							</div>
							<?php
						}

						wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}