<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$footer_logo = HT_Util()->get_theme_option( 'footer_logo' );
$footer_text = HT_Util()->get_theme_option( 'footer_text' );
?>
<div class="content-wrapper container">

	<div class="footer-content">
		<?php
		if ( ! empty( $footer_logo ) ) {
			?>
			<div class="footer-logo">
				<img src="<?php echo wp_get_attachment_url( $footer_logo ); ?>"
				     alt="<?php echo get_bloginfo( 'name' ); ?>">
			</div>
			<!--/footer-logo-->
			<?php
		}

		if ( ! empty( $footer_text ) ) {
			?>
			<div class="footer-info">
				<?php echo wpautop( $footer_text ); ?>
			</div>
			<!--/footer-info-->
			<?php
		}

		dynamic_sidebar( 'footer' );
		?>
	</div>
	<!--/footer-content-->
</div>