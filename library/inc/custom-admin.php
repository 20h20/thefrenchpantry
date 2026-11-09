<?php

	function remove_admin_login_header() {
		remove_action('wp_head', '_admin_bar_bump_cb');
	}
	add_action('get_header', 'remove_admin_login_header');

	// Hooks
	add_filter( 'upload_mimes', 'cbo_mime_types' );
	add_filter( 'wp_check_filetype_and_ext', 'cbo_svg_filetype', 10, 4 );
	add_filter( 'wp_handle_upload_prefilter', 'cbo_svg_upload_check' );


	/* ************************* */
	/* IMPORT SVG
	/* ************************* */
	function cbo_mime_types( $mimes ){
		if ( current_user_can( 'unfiltered_html' ) ) {
			$mimes['svg'] = 'image/svg+xml';
		}
		return $mimes;
	}

	// Valide le type SVG uniquement si l'extension FINALE est .svg (pas de "fichier.svg.php")
	function cbo_svg_filetype( $types, $file, $filename, $mimes ) {
		if ( current_user_can( 'unfiltered_html' ) && 'svg' === strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) ) ) {
			$types['ext']  = 'svg';
			$types['type'] = 'image/svg+xml';
		}
		return $types;
	}

	// Refuse les SVG contenant du code exécutable (scripts, événements JS, liens javascript:, contenu HTML embarqué)
	function cbo_svg_upload_check( $file ) {
		if ( 'svg' !== strtolower( pathinfo( $file['name'], PATHINFO_EXTENSION ) ) ) {
			return $file;
		}

		$content = file_get_contents( $file['tmp_name'] );
		if ( false === $content || preg_match( '/<script|<foreignObject|<iframe|<embed|<object|\son[a-z]+\s*=|javascript:|data:text\/html|<!ENTITY/i', $content ) ) {
			$file['error'] = 'Ce fichier SVG contient du code non autorisé (script). Exportez-le à nouveau sans script ni interaction.';
		}
		return $file;
	}


	// Nettoyage de l'adminbar du back office - Items principaux
	function wps_admin_bar() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_node('comments');
	}
	add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' );


	// Nettoyage du menu du back office - Items principaux
	add_action( 'admin_init', function () {
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'edit.php' );
	});


	// Suppresion des sous-items Personnaliser et Compositions
	function wpc_force_remove_appearance_menus() {
		global $submenu;
		
		// Vérifie que le menu "Apparence" existe
		if (isset($submenu['themes.php'])) {
			foreach ($submenu['themes.php'] as $key => $menu_item) {
				// Supprimer "Personnaliser"
				if (strpos($menu_item[2], 'customize.php') !== false) {
					unset($submenu['themes.php'][$key]);
				}
				// Supprimer "Éditeur de site"
				if (strpos($menu_item[2], 'site-editor.php') !== false) {
					unset($submenu['themes.php'][$key]);
				}
			}
		}
	}
	add_action('admin_menu', 'wpc_force_remove_appearance_menus', 999);


	/* Pied de page administration */
	function remove_footer_admin () {
		echo 'Proudly handcrafted by <a href="https://julien-brochard.fr/" target="_blank" rel="noopener noreferrer"><i class="icon icon--logo-jb" aria-hidden="true"></i> Julien B</a>';
	}
	add_filter('admin_footer_text', 'remove_footer_admin');


	// Suppression des widgets du Dashboard
	function remove_dashboard_meta() {
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Removes the 'incoming links' widget
		remove_meta_box('dashboard_plugins', 'dashboard', 'normal'); //Removes the 'plugins' widget
		remove_meta_box('dashboard_primary', 'dashboard', 'normal'); //Removes the 'WordPress News' widget
		remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); //Removes the secondary widget
		remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Removes the 'Quick Draft' widget
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); //Removes the 'Recent Drafts' widget
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); //Removes the 'Activity' widget
		remove_meta_box('dashboard_site_health', 'dashboard', 'normal'); //Removes the 'Health site' widget 
		remove_meta_box('wordfence_activity_report_widget', 'dashboard', 'normal'); //Removes the 'Wordfence plugin' widget 
		remove_meta_box('wp_mail_smtp_reports_widget_lite', 'dashboard', 'normal'); //Removes the 'WP mail SMTP widget' widget
		remove_meta_box('dashboard_activity', 'dashboard', 'normal');
	}
	add_action('admin_init', 'remove_dashboard_meta'); 
	

	// Redirection de la page des commentaires
	function wpc_redirect_comments_page() {
		global $pagenow;
		
		if ($pagenow === 'edit-comments.php') {
			wp_safe_redirect(admin_url('index.php'));
			exit;
		}
	}
	add_action('admin_init', 'wpc_redirect_comments_page');


	/* ************************* */
	// Désactivation complète des commentaires, pings et trackbacks
	// (les robots postent directement sur wp-comments-post.php, XML-RPC ou l'API REST)
	/* ************************* */
	// Fermeture des commentaires et pings sur tous les contenus
	add_filter('comments_open', '__return_false', 20);
	add_filter('pings_open', '__return_false', 20);

	// Masque les commentaires existants en front
	add_filter('comments_array', '__return_empty_array', 10);

	// Retire le support des commentaires et trackbacks de tous les types de contenu
	add_action('init', function() {
		foreach (get_post_types() as $post_type) {
			if (post_type_supports($post_type, 'comments')) {
				remove_post_type_support($post_type, 'comments');
				remove_post_type_support($post_type, 'trackbacks');
			}
		}
	}, 100);

	// Bloque l'accès direct au script d'envoi de commentaire
	add_action('pre_comment_on_post', function() {
		wp_die('Les commentaires sont désactivés.', '', ['response' => 403]);
	});

	// XML-RPC : désactivation complète (évite le brute-force via system.multicall)
	add_filter('xmlrpc_enabled', '__return_false');
	add_filter('xmlrpc_methods', '__return_empty_array');
	add_filter('wp_headers', function($headers) {
		unset($headers['X-Pingback']);
		return $headers;
	});

	// API REST : suppression des routes de commentaires
	add_filter('rest_endpoints', function($endpoints) {
		unset($endpoints['/wp/v2/comments'], $endpoints['/wp/v2/comments/(?P<id>[\d]+)']);
		return $endpoints;
	});


	/* ************************* */
	// Anti-énumération des identifiants de connexion
	/* ************************* */
	add_filter('rest_endpoints', function($endpoints) {
		if (!is_user_logged_in()) {
			unset($endpoints['/wp/v2/users'], $endpoints['/wp/v2/users/(?P<id>[\d]+)']);
		}
		return $endpoints;
	});

	// ?author=1 et archives auteur (/author/identifiant/) redirigés vers l'accueil
	// Priorité 1 : avant redirect_canonical qui révèlerait l'identifiant dans l'URL
	add_action('template_redirect', function() {
		if (is_author() || isset($_GET['author'])) {
			wp_safe_redirect(home_url('/'), 301);
			exit;
		}
	}, 1);

?>