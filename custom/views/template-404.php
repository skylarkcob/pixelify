<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<section class="error-404 not-found row">
						<div class="page-content col-sm-6">
							<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a
								search?', 'hocwp-theme' ); ?></p>

							<form role="search" method="get" class="search-form form"
							      action="<?php echo esc_url( home_url() ); ?>">
								<div class="input-group">
									<input type="search" name="s" value=""
									       placeholder="<?php _e( 'Enter Keyword', 'hocwp-theme' ); ?>" required="">
									  <span class="input-group-btn">
									    <button type="submit" class="btn btn-secondary"><i class="fa fa-search"></i>
									    </button>
									  </span>
								</div>
							</form>
						</div>
						<!-- .page-content -->
					</section>
					<!-- .error-404 -->
				</main>
				<!-- #main -->
			</div>
			<!-- #primary -->
		</div>
	</div>
</div>