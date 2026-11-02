<?php
	require get_template_directory() . '/templates/blocks/accordion/block.php';
	require get_template_directory() . '/templates/blocks/blocs/block.php';
	require get_template_directory() . '/templates/blocks/blocspicture/block.php';
	require get_template_directory() . '/templates/blocks/cta/block.php';
	require get_template_directory() . '/templates/blocks/form/block.php';
	require get_template_directory() . '/templates/blocks/gallery/block.php';
	require get_template_directory() . '/templates/blocks/galleryslider/block.php';
	require get_template_directory() . '/templates/blocks/herosimple/block.php';
	require get_template_directory() . '/templates/blocks/herovideo/block.php';
	require get_template_directory() . '/templates/blocks/instagram/block.php';
	require get_template_directory() . '/templates/blocks/picturefull/block.php';
	require get_template_directory() . '/templates/blocks/testimonials/block.php';
	require get_template_directory() . '/templates/blocks/text/block.php';
	require get_template_directory() . '/templates/blocks/textpicture/block.php';

	function allow_only_custom_blocks( $allowed_blocks, $editor_context ) {
		return array(
			'acf/accordion',
			'acf/blocs',
			'acf/blocspicture',
			'acf/cta',
			'acf/form',
			'acf/gallery',
			'acf/galleryslider',
			'acf/herosimple',
			'acf/herovideo',
			'acf/instagram',
			'acf/picturefull',
			'acf/testimonials',
			'acf/text',
			'acf/textpicture',
		);
	}
	add_filter( 'allowed_block_types_all', 'allow_only_custom_blocks', 10, 2 );

	/* ************************* */
	/* ADD NEW CATEGORIES INTO ACF BLOCK REGISTER */
	/* ************************* */
	function add_custom_block_categories($categories) {
		return array_merge(
			$categories,
			array(
				array(
					'slug'  => 'hero',
					'title' => __('En-tête'),
					'icon'  => null,
				),
				array(
					'slug'  => 'text',
					'title' => __('Texte'),
					'icon'  => null,
				),
				array(
					'slug'  => 'galerie',
					'title' => __('Galerie'),
					'icon'  => null,
				),
			)
		);
	}
	add_filter('block_categories_all', 'add_custom_block_categories');