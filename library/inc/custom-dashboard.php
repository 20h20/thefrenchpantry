<?php
	// Ordre des widgets dans le dashboard
	add_action('wp_dashboard_setup', 'set_dashboard_widget_order', 100);
	function set_dashboard_widget_order() {
		global $wp_meta_boxes;
		$wp_meta_boxes['dashboard']['normal']['core'] = array(
			'welcome_dashboard'      => array('id' => 'welcome_dashboard', 'title' => 'Bienvenue', 'callback' => 'display_welcome_message', 'args' => array()),
		);
	}


	// Verrouillage du layout du dashboard
	add_action('admin_head-index.php', 'lock_dashboard_layout');
	function lock_dashboard_layout() {
		if (current_user_can('edit_dashboard')) {
			echo '<style>
				#dashboard-widgets .postbox-container { min-height: 0 !important; }
				.postbox .handlediv, .postbox h2.hndle { cursor: default !important; }
				.postbox .hndle { pointer-events: none; }
				.postbox .handle-actions, #screen-options-link, #screen-options-wrap { display: none !important; }
			</style>';
		}
	}


	// Widget Bienvenue
	function display_welcome_message() {
		$current_user = wp_get_current_user();
		$first_name = $current_user->user_firstname;
		if (empty($first_name)) {
			$first_name = esc_html($current_user->display_name);
		}
		echo "
		<div class='inside-content'>
			<strong>Bonjour $first_name, content de vous revoir 👋</strong>
			<p>Bienvenue sur le back-office de votre site internet.</p>
		</div>
		<a class='cbo-button' href='https://trello.com/b/Jonsxgsq/metecno-sound' target='_blank'>Suivi de vos tickets</a>";
	}


	// Widgets autorisés sur le dashboard : ceux du mu-plugin "Tableau de bord" (project-hub-widget.php)
	function cbo_dashboard_allowed_widgets() {
		if (function_exists('project_hub_dashboard_widgets')) {
			return array_keys(project_hub_dashboard_widgets());
		}
		return array('welcome_dashboard');
	}

	// Suppression de tous les autres widgets.
	add_action('wp_dashboard_setup', 'cbo_remove_foreign_dashboard_widgets', PHP_INT_MAX);
	function cbo_remove_foreign_dashboard_widgets() {
		global $wp_meta_boxes;
		if (empty($wp_meta_boxes['dashboard'])) {
			return;
		}

		$allowed = cbo_dashboard_allowed_widgets();
		foreach ($wp_meta_boxes['dashboard'] as $context => $priorities) {
			foreach ((array) $priorities as $priority => $boxes) {
				foreach ((array) $boxes as $id => $box) {
					if (!in_array($id, $allowed, true)) {
						unset($wp_meta_boxes['dashboard'][$context][$priority][$id]);
					}
				}
			}
		}
	}


	// Notices des plugins (Instagram Feed, Brevo, demandes d'avis...) masquées sur le dashboard uniquement.
	// Elles restent visibles sur les autres pages de l'admin.
	add_action('load-index.php', 'cbo_hide_dashboard_notices');
	function cbo_hide_dashboard_notices() {
		remove_all_actions('admin_notices');
		remove_all_actions('all_admin_notices');
		remove_action('welcome_panel', 'wp_welcome_panel');
	}
?>