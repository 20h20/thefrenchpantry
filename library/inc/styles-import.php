<?php
	// Initialisation du tableau global des blocs utilisés
	if (!isset($GLOBALS['cbo_used_blocks'])) {
		$GLOBALS['cbo_used_blocks'] = array();
	}

	// Ajouter l'action pour charger les styles et blocs
	add_action('wp_enqueue_scripts', 'cbo_scripts_and_styles', 20);

	// Enregistrer un bloc utilisé
	function cbo_register_block_usage($block_name) {
		if (!in_array($block_name, $GLOBALS['cbo_used_blocks'])) {
			$GLOBALS['cbo_used_blocks'][] = $block_name;
		}
	}

	/* ****************** */
	/* Load Frontend styles */
	function cbo_scripts_and_styles() {
		global $cbo_used_blocks;

		if (!is_admin()) {
			$css_blocks_path = get_stylesheet_directory() . '/library/css/blocks/';
			$css_blocks_url  = get_stylesheet_directory_uri() . '/library/css/blocks/';
			
			// Charger les styles globaux pour le front-end
			$global_css_file = get_stylesheet_directory() . '/library/css/style.min.css';
			$global_css_version = file_exists($global_css_file) ? filemtime($global_css_file) : wp_get_theme()->get('Version');
			wp_enqueue_style('global-styles', get_stylesheet_directory_uri() . '/library/css/style.min.css', array(), $global_css_version);

			// Utilisateur connecté (barre d'admin affichée) : styles du BO (correctif admin bar)
			if (is_admin_bar_showing()) {
				cbo_enqueue_admin_styles();
			}

			// Script principal : en footer, versionné (cache busting), defer via cbo_add_defer_attribute()
			$js_file = get_template_directory() . '/library/js/scripts.js';
			wp_enqueue_script('bones-scripts', get_template_directory_uri() . '/library/js/scripts.js', array(), file_exists($js_file) ? filemtime($js_file) : null, true);

			// Page 404 : le hero est écrit en dur dans 404.php (pas de contenu à analyser)
			if (is_404()) {
				cbo_register_block_usage('herosimple');
			}

			// Détection automatique des blocs ACF dans le contenu - Permet d'appeler les styles ou non
			if (is_singular() || is_tax()) {
				global $post;
				$content = $post->post_content;

				preg_match_all('/wp:acf\/([a-z0-9-]+)/', $content, $matches);
				if (!empty($matches[1])) {
					foreach ($matches[1] as $block_name) {
						cbo_register_block_usage($block_name);
					}
				}
			}

			// Charger les styles des blocs enregistrés
			if (!empty($cbo_used_blocks)) {
				foreach ($cbo_used_blocks as $block_name) {
					$block_css_file = $css_blocks_path . $block_name . '.min.css';
					if (file_exists($block_css_file)) {
						wp_enqueue_style('block-' . $block_name, $css_blocks_url . $block_name . '.min.css', array(), filemtime($block_css_file));
					}
				}
			}
		}
	}


	/* ****************** */
	/* Load editor styles */
	// Depuis WP 7.0 l'éditeur est toujours dans une iframe : seuls les styles
	// chargés via enqueue_block_assets y sont injectés (admin_print_styles n'y arrive pas).
	function cbo_editor_styles() {
		if (!is_admin()) {
			return;
		}

		$global_css_file = get_template_directory() . '/library/css/style.min.css';
		wp_enqueue_style('cbo-editor-global', get_template_directory_uri() . '/library/css/style.min.css', array(), file_exists($global_css_file) ? filemtime($global_css_file) : null);

		$blocks_css_file = get_template_directory() . '/library/css/editor/gutenberg.min.css';
		wp_enqueue_style('cbo-editor-blocks', get_template_directory_uri() . '/library/css/editor/gutenberg.min.css', array('cbo-editor-global'), file_exists($blocks_css_file) ? filemtime($blocks_css_file) : null);

		// Ajustements des blocs dans l'éditeur (.editor-styles-wrapper)
		cbo_enqueue_admin_styles();
	}
	add_action('enqueue_block_assets', 'cbo_editor_styles');


	/* ****************** */
	/* Load admin styles */
	/* Styles du BO : library/css/admin.min.css (source : src/scss/admin.scss) */
	function cbo_enqueue_admin_styles() {
		$admin_css_file = get_template_directory() . '/library/css/admin.min.css';
		if (file_exists($admin_css_file)) {
			wp_enqueue_style('backoffice', get_template_directory_uri() . '/library/css/admin.min.css', array(), filemtime($admin_css_file));
		}
	}

	// Interface WP (hors iframe de l'éditeur) : uniquement les styles du BO,
	// sans la typographie ni les styles du site.
	function admin_css() {
		cbo_enqueue_admin_styles();
	}
	add_action('admin_print_styles', 'admin_css', 11);
?>
