<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="content-wrapper container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) {
				the_post();
				?>
				<article id="post-16" class="post-16 page type-page status-publish hentry">
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article>
				<?php
			}
			?>
		</main>
	</div>
</div>