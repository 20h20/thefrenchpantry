<?php
	function bones_ahoy() {
		require_once( 'library/inc/custom-cleanup.php' );
		require_once( 'library/inc/custom-admin.php' );
		require_once( 'library/inc/custom-dashboard.php' );
		require_once( 'library/inc/styles-import.php' );
		require_once( 'library/inc/acf.php' );
	}
	add_action( 'after_setup_theme', 'bones_ahoy' );

	/* ************************* */
	// Pic size
	/* ************************* */
	add_image_size('xsmall', 320, 320, false);
	add_image_size('small', 768, 768, false);
	add_image_size('medium', 1200, 1200, false);
	add_image_size('xlarge', 1920, 1920, false);


	/* ************************* */
	// Add `loading="lazy"` attribute to images output by the_post_thumbnail().
	/* ************************* */
	add_filter( 'post_thumbnail_html', 'wpdd_modify_post_thumbnail_html', 10, 5 );
	
	function wpdd_modify_post_thumbnail_html( $html, $post_id, $post_thumbnail_id, $size, $attr ) {
		return str_replace( '<img', '<img loading="lazy"', $html );
	}

	/* ************************* */
	// Removing autoP from CF7
	/* ************************* */
	add_filter('wpcf7_autop_or_not', '__return_false');


	/* ************************* */
	/* AJOUT OPTIONS AU DASHBOARD */
	/* ************************* */
	if( function_exists('acf_add_options_page') ) {
		acf_add_options_page();
	}


	/* ************************* */
	// Add Color choices
	/* ************************* */
	function my_mce4_options($init) {
		$custom_colours = '
		"EDBE5A", "Jaune",
		"003058", "Bleu",
		';
		$init['textcolor_map'] = '['.$custom_colours.']';
		$init['textcolor_rows'] = 1;
		return $init;
	}
	add_filter('tiny_mce_before_init', 'my_mce4_options');


	/* ************************* */
	// Register menu
	/* ************************* */
	function register_my_menu() {
		register_nav_menu('primary-menu',__( 'Menu Principal' ));
		register_nav_menu('footer-nav',__( 'Footer Navigation' ));
	}
	add_action( 'init', 'register_my_menu' );


	/* ************************* */
	// Add a custom tool bar
	/* ************************* */
	function custom_acf_wysiwyg_toolbar($toolbars) {
		$toolbars['Custom'] = [];
		$toolbars['Custom'][1] = ['bold', 'formatselect'];
		return $toolbars;
	}
	add_filter('acf/fields/wysiwyg/toolbars', 'custom_acf_wysiwyg_toolbar');


	/* ************************* */
	/* Add styles to wysiwyg editor */
	/* ************************* */
	function add_style_select_button($buttons) {
		array_unshift($buttons, 'styleselect');
		return $buttons;
	}
	add_filter('mce_buttons_2', 'add_style_select_button');
	function my_mce_before_init_insert_formats( $init_array ) {
		$style_formats = array(
			array(
				'title' => 'Bouton Jaune',
				'block' => 'a',
				'classes' => 'cbo-button button--yellow',
				'wrapper' => true,
				'attributes' => array(
					'href' => '#'
				)
			),
		);
		$init_array['style_formats'] = json_encode( $style_formats );
		return $init_array;
	}
	add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );


	/* ************************* */
	/* CUSTOM LOGIN */
	/* ************************* */
	function childtheme_custom_login() {
		echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/library/css/style.min.css" />';
	}
   add_action('login_head', 'childtheme_custom_login');


   /* ************************* */
	/* ANCRES DES BLOCS ACF
	/* Applique l'ancre saisie en BO (Bloc > Avancé > Ancre HTML) comme id
	/* sur la première balise du bloc, sans modifier chaque template.
	/* ************************* */
	function cbo_apply_block_anchor( $block_content, $block ) {
		if ( empty( $block['attrs']['anchor'] ) || strpos( (string) $block['blockName'], 'acf/' ) !== 0 ) {
			return $block_content;
		}

		$tags = new WP_HTML_Tag_Processor( $block_content );
		if ( $tags->next_tag() ) {
			$tags->set_attribute( 'id', $block['attrs']['anchor'] );
			return $tags->get_updated_html();
		}

		return $block_content;
	}
	add_filter( 'render_block', 'cbo_apply_block_anchor', 10, 2 );

   
?>