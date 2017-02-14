<?php
/**
 * ICTU LAA modifications
 */

require_once(dirname(__FILE__) . '/lib/hooks.php');

// register default Elgg event
elgg_register_event_handler('init', 'system', 'ictu_laa_init');

/**
 * Called during system init
 *
 * @return void
 */
function ictu_laa_init() {
	
	// register plugin hooks
	elgg_register_plugin_hook_handler('format', 'friendly:time', 'ictu_laa_friendly_time');
	elgg_register_plugin_hook_handler('register', 'menu:entity', 'ictu_laa_entity_menu_icons');
}
