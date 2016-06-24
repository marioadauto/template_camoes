<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_tags
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.core');
JHtml::_('formbehavior.chosen', 'select');

// Get the user object.
$user = JFactory::getUser();

// Check if user is allowed to add/edit based on tags permissions.
// Do we really have to make it so people can see unpublished tags???
$canEdit = $user->authorise('core.edit', 'com_tags');
$canCreate = $user->authorise('core.create', 'com_tags');
$canEditState = $user->authorise('core.edit.state', 'com_tags');
$items = $this->items;
$n = count($this->items);
$readMoreTag = "Ler mais";

?>


<div class="row">
    <?php if ($this->items == false || $n == 0) : ?>
    <p>
        <?php echo JText::_('COM_TAGS_NO_ITEMS'); ?>
    </p>
    <?php else : ?>


    <?php foreach ($items as $i => $item) : ?>
    <div class="col-xs-12">
        <h2>
            <a href="<?php echo JRoute::_(TagsHelperRoute::getItemRoute($item->content_item_id, $item->core_alias, $item->core_catid, $item->core_language, $item->type_alias, $item->router)); ?>">
                <?php echo $this->escape($item->core_title); ?>
            </a>
        </h2>
    </div>
    <?php
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('introtext')->from('#__content')->where('id=' . (int)$item->content_item_id);
        $db->setQuery($query);
        //displaying the intro image
        $images  = json_decode($item->core_images);
        $hasImage = !empty($images->image_fulltext);
        if($hasImage) {
            echo '<div class="col-xs-12 col-sm-3">';
            echo '<div class="tag-article-image" style="background-image: url('.$images->image_fulltext.');">';
            echo '</div></div>';
        }
        //displaying the intro text
        echo '<div class="col-xs-12 '.($hasImage ? "col-sm-9" : "").'">';
        $introtext = $db->loadResult();
        echo JHtml::_('string.truncate',  $introtext, 400);
        echo '<div><a href="'. JRoute::_(TagsHelperRoute::getItemRoute($item->content_item_id, $item->core_alias, $item->core_catid, $item->core_language, $item->type_alias, $item->router)).'">';
        echo $readMoreTag;
        echo'</a></div>';
        echo '</div>';
    ?>

    <?php endforeach; ?>


    <?php endif; ?>
</div>
