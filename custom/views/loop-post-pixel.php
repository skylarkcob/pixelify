<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'wp_star_rating' ) ) {
	require ABSPATH . 'wp-admin/includes/template.php';
}

$time = current_time( 'timestamp', true );
$date = get_the_time( 'U' );
$new  = ( strtotime( '+1 day', $date ) > $time ) ? true : false;

$rating = get_post_meta( get_the_ID(), 'rating', true );
$rates  = get_post_meta( get_the_ID(), 'rates', true );

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
<article <?php post_class( 'pixel-entry' ); ?>>
	<div class="entry-image">
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
	</div>
	<div class="entry-body">
		<div class="col-left">
			<header class="entry-header">
				<?php
				if ( $new ) {
					?>
					<span class="new-label"><?php _ex( 'New', 'new label', 'hocwp-theme' ); ?></span>
					<?php
				}
				?>
				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h3>
			</header>
			<!-- .entry-header -->
			<footer class="entry-footer">
				<span class="cat-links">
				    <?php printf( _x( '%s in %s', 'author category', 'hocwp-theme' ), $author, $links ); ?>
				</span>
			</footer>
			<!-- .entry-footer -->
		</div>
		<div class="col-right">
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
	</div>
</article>
<!-- #post-## -->