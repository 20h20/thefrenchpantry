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
?>