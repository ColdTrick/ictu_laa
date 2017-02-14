<?php
/**
 * All hooks are bundled here
 */

/**
 * Change the format of friendly time
 *
 * @param string $hook         the name of the hook
 * @param string $type         the type of the hook
 * @param mixed  $return_value current return value
 * @param array  $params       supplied params
 *
 * @return void|string
 */
function ictu_laa_friendly_time($hook, $type, $return_value, $params) {
	
	$time = (int) elgg_extract('time', $params);
	if (empty($time)) {
		return;
	}
	
	return elgg_echo('date:month:short:' . date('m', $time), [date('j', $time)]) . ' ' . date('Y', $time);
}

/**
 * Change the format of friendly time
 *
 * @param string         $hook         the name of the hook
 * @param string         $type         the type of the hook
 * @param ElggMenuItem[] $return_value current return value
 * @param array          $params       supplied params
 *
 * @return void|ElggMenuItem[]
 */
function ictu_laa_entity_menu_icons($hook, $type, $return_value, $params) {
	
	$entity = elgg_extract('entity', $params);
	if (!($entity instanceof ElggEntity)) {
		return;
	}
	
	foreach ($return_value as $menu_item) {
		
		switch ($menu_item->getName()) {
			case 'edit':
				if (!$menu_item->getTooltip()) {
					$menu_item->setTooltip($menu_item->getText());
				}
				
				$menu_item->setText(elgg_view_icon('pencil'));
				break;
			case 'access':
				
				$site = elgg_get_site_entity();
				$container = $entity->getContainerEntity();
				
				$access_id_string = get_readable_access_level($entity->access_id);
				$access_id_string = htmlspecialchars($access_id_string, ENT_QUOTES, 'UTF-8', false);
				
				$menu_item->setTooltip($access_id_string);
				$menu_item->setHref('#');
				
				switch ($entity->access_id) {
					case ACCESS_PRIVATE:
						$menu_item->setText(elgg_view_icon('minus-circle'));
						break;
					case ACCESS_LOGGED_IN:
						$menu_item->setText(elgg_view_icon('circle-o-notch'));
						break;
					case ACCESS_PUBLIC:
						$menu_item->setText(elgg_view_icon('plus-circle'));
						break;
					case ACCESS_FRIENDS:
						$menu_item->setText(elgg_view_icon('user-circle-o'));
						break;
					default:
						
						if (($site instanceof Subsite) && ($entity->access_id == $site->getACL())) {
							// subsite
							$menu_item->setText(elgg_view_icon('circle-o'));
						}
						
						if (($container instanceof ElggGroup) && ($entity->access_id == $container->group_acl)) {
							// group
							$menu_item->setText(elgg_view_icon('dot-circle-o'));
						}
						break;
				}
				break;
			case 'history':
				
				$menu_item->setTooltip($menu_item->getText());
				$menu_item->setText(elgg_view_icon('clock-o'));
				
				break;
		}
	}
	
	return $return_value;
}
