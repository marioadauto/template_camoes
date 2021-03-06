<?php
/**
 * @package     Joomla.Cms
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

use Joomla\Registry\Registry;

JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');

?>
<?php
if (!empty($displayData)) : ?>
<div class="tags-container">
    T&oacute;picos neste artigo:
    <ul class="tags inline">
        <?php foreach ($displayData as $i => $tag) : ?>
        <?php if (in_array($tag->access, JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id')))) : ?>
        <?php $tagParams = new Registry($tag->params); ?>
        <li class="tag-<?php echo $tag->tag_id; ?> tag-list<?php echo $i ?>" itemprop="keywords">
            <a href="<?php echo JRoute::_(TagsHelperRoute::getTagRoute($tag->tag_id . '-' . $tag->alias)) ?>">
                <?php echo $this->escape($tag->title); ?>
            </a>
        </li>
        <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>
