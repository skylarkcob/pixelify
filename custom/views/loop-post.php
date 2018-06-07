<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<article <?php post_class(); ?>>
	<div class="entry-image">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
	</div>
	<div class="entry-body">
		<header class="entry-header">
			<h3 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h3>
		</header>
		<!-- .entry-header -->
		<footer class="entry-footer">
				<span class="cat-links">
				    <?php the_category( ', ' ); ?>
				</span>
		</footer>
		<!-- .entry-footer -->
	</div>
</article>
<!-- #post-## -->