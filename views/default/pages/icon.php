<?php
/**
 * Page icon
 *
 * Uses a separate icon view due to dependency on annotation
 *
 * ColdTrick 2017-02-14: limit iconsize to 20px
 *
 * @package ElggPages
 *
 * @uses $vars['entity']
 * @uses $vars['annotation']
 */

$annotation = $vars['annotation'];
$entity = get_entity($annotation->entity_guid);

// Get size
if (!in_array($vars['size'], array('small', 'medium', 'large', 'tiny', 'master', 'topbar'))) {
	$vars['size'] = "medium";
}

$width = 20;
$height = 20;
?>

<a href="<?php echo $annotation->getURL(); ?>">
	<img alt="<?php echo $entity->title; ?>" src="<?php echo $entity->getIconURL($vars['size']); ?>" style="max-width:<?php echo $width; ?>px; max-height:<?php echo $height; ?>px;" />
</a>
