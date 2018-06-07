<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$title       = HT_Util()->get_theme_option( 'slider_title', '', 'home' );
$description = HT_Util()->get_theme_option( 'slider_description', '', 'home' );

$args = array(
	'meta_key'       => 'featured',
	'meta_value'     => 1,
	'posts_per_page' => 3,
	'post_type'      => 'post',
	'post_status'    => 'publish'
);

$query = new WP_Query( $args );

if ( empty( $title ) && empty( $description ) && ! $query->have_posts() ) {
	return;
}
?>
<div class="page-fullwidth">
	<?php
	if ( ! empty( $title ) || ! empty( $description ) ) {
		?>
		<div id="page-header" class="text-center">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2">
						<?php
						if ( ! empty( $title ) ) {
							?>
							<h1 class="page-title"><?php echo wp_strip_all_tags( $title ); ?></h1>
							<?php
						}

						if ( ! empty( $description ) ) {
							?>
							<div class="page-subtitle">
								<?php echo wpautop( $description ); ?>
							</div>
							<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	if ( $query->have_posts() ) {
		?>
		<div id="featured-content">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<div id="featured-slide">
							<?php
							while ( $query->have_posts() ) {
								$query->the_post();
								?>
								<article <?php post_class(); ?>>
									<div class="entry-image slideshow">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'medium' ); ?>
										</a>
									</div>
									<div class="entry-header">
										<h2 class="entry-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h2>
									</div>
									<div class="entry-footer">
										<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
										   class="readmore"><?php the_author(); ?></a>
									</div>
								</article>
								<?php
							}

							wp_reset_postdata();
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- .featured-content -->
		<?php
	}
	?>
</div>