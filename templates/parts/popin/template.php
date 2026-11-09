<?php

$active		= get_field( 'popin_active', 'option' );
if ( ! $active ) {
	return;
}

$picture	= get_field( 'popin_image', 'option' );
$content	= get_field( 'popin_text', 'option' );

?>

<dialog class="cbo-popin" id="cbo-popin">
	<div class="popin-inner">
		<button type="button" class="popin-close" data-popin-close aria-label="Close">
			<i class="icon icon--cross" aria-hidden="true"></i>
		</button>

		<div class="popin-picture cbo-picture-cover">
			<img
				decoding="async"
				src="<?php echo esc_url( $picture['sizes']['small'] ); ?>"
				srcset="<?php echo esc_url( $picture['sizes']['small'] ); ?> 320w, <?php echo esc_url( $picture['sizes']['large'] ); ?> 768w"
				alt="<?php echo esc_attr( $picture['alt'] ); ?>" sizes="100vw"
				loading="lazy"
				width="500" height="500"
			>
		</div>

		<div class="popin-content">
			<div class="popin-text cbo-cms">
				<?php echo wp_kses_post( $content ); ?>
			</div>
		</div>
	</div>
</dialog>