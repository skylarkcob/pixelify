<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="container">
	<div class="row">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<?php hocwp_theme_load_custom_module( 'archive-filter' ); ?>
				<div class="search-post loop-posts">
					<?php
					if ( have_posts() ) {
						?>
						<div class="row">
							<?php
							while ( have_posts() ) {
								the_post();
								?>
								<div class="search-post-item post-item grid col-sm-4">
									<?php hocwp_theme_load_custom_loop( 'post-pixel' ); ?>
								</div>
								<?php
							}
							?>
							<div class="search-pagination ajax-pagination col-sm-12">
								<?php HT_Frontend()->pagination(); ?>
							</div>
						</div>
						<?php
					} else {
						hocwp_theme_load_content_none();
					}
					?>
				</div>
			</main>
			<!-- #main -->
		</div>
		<!-- #primary -->
	</div>
</div>
