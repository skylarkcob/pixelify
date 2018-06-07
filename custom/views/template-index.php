<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="container">
	<div id="primary" class="homepage content-area">
		<div class="row">
			<div class="col-sm-12">
				<div class="tabs-container">
					<div class="tabs_text">
						<span><?php _e( 'All Freebies', 'hocwp-theme' ); ?></span>
					</div>
					<div class="tabs_links">
						<ul>
							<li>
								<span class="tabs_label"><?php _e( 'Filter by:', 'hocwp-theme' ); ?></span>
							</li>
							<li class="active">
								<a href="#recent_posts"><?php _e( 'Most Recent', 'hocwp-theme' ); ?></a>
							</li>
							<li>
								<a href="#popular_posts"><?php _e( 'Most Popular', 'hocwp-theme' ); ?></a>
							</li>
							<li>
								<a href="#exclusive_posts"><?php _e( 'Exclusive', 'hocwp-theme' ); ?></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<main id="main" class="content site-main">
			<div class="tab_content" id="recent_posts" style="">
				<div class="post-layout post-grid-layout">
					<?php
					if ( have_posts() ) {
						?>
						<div class="recent-post row">
							<?php
							while ( have_posts() ) {
								the_post();
								?>
								<div class="recent-post-item grid col-sm-4">
									<?php hocwp_theme_load_custom_loop( 'post' ); ?>
								</div>
								<?php
							}
							?>
							<div class="clear"></div>
							<div class="recent-pagination ajax-pagination">
								<?php
								HT_Frontend()->pagination( array(
									'next_text' => __( 'Next', 'hocwp-theme' ),
									'prev_text' => __( 'Previous', 'hocwp-theme' )
								) );
								?>
							</div>
						</div>
						<?php
					} else {
						hocwp_theme_load_content_none();
					}
					?>
				</div>
			</div>
			<!-- Recent Post -->
			<div class="tab_content" id="popular_posts" style="display:none">
				<div class="post-layout post-grid-layout">
					<div class="popular-post row loop-posts">
						<?php
						$args = array(
							'post_type'      => 'post',
							'post_status'    => 'publish',
							'meta_key'       => 'views',
							'orderby'        => 'meta_value_num',
							'paged'          => HT_Util()->get_paged(),
							'posts_per_page' => HT_Util()->get_posts_per_page( true )
						);

						$query = new WP_Query( $args );

						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								?>
								<div class="popular-post-item post-item grid col-sm-4">
									<?php hocwp_theme_load_custom_loop( 'post' ); ?>
								</div>
								<?php
							}

							wp_reset_postdata();
							?>
							<div class="clear"></div>
							<div class="popular-pagination ajax-pagination">
								<?php
								HT_Frontend()->pagination( array(
									'next_text' => __( 'Next', 'hocwp-theme' ),
									'prev_text' => __( 'Previous', 'hocwp-theme' ),
									'query'     => $query
								) );
								?>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<!-- Popular Post -->
			<div class="tab_content" id="exclusive_posts" style="display:none">
				<div class="post-layout post-grid-layout">
					<div class="exclusive-post row loop-posts">
						<?php
						$args = array(
							'post_type'      => 'post',
							'post_status'    => 'publish',
							'meta_key'       => 'exclusive',
							'meta_value'     => 1,
							'paged'          => HT_Util()->get_paged(),
							'posts_per_page' => HT_Util()->get_posts_per_page( true )
						);

						$query = new WP_Query( $args );

						if ( $query->have_posts() ) {
							while ( $query->have_posts() ) {
								$query->the_post();
								?>
								<div class="exclusive-post-item post-item grid col-sm-4">
									<?php hocwp_theme_load_custom_loop( 'post' ); ?>
								</div>
								<?php
							}

							wp_reset_postdata();
							?>
							<div class="clear"></div>
							<div class="exclusive-pagination ajax-pagination">
								<?php
								HT_Frontend()->pagination( array(
									'next_text' => __( 'Next', 'hocwp-theme' ),
									'prev_text' => __( 'Previous', 'hocwp-theme' ),
									'query'     => $query
								) );
								?>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<!-- Recent Post -->
		</main>
		<!-- #main -->
	</div>
	<!-- #primary -->
</div>