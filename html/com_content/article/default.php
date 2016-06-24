<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.beez3
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$templateparams = $app->getTemplate(true)->params;
$images = json_decode($this->item->images);
$urls = json_decode($this->item->urls);
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
JHtml::_('behavior.caption');

// Create shortcut to parameters.
$params = $this->item->params;

$hasExtraContent = (!empty($this->item->event->beforeDisplayContent) || !empty($this->item->event->afterDisplayTitle));

?>
<div class="col-xs-12 col-sm-12 col-md-8">

    <article id="artigo-camoes" class="item-page<?php echo $this->pageclass_sfx?>">
        <?php if ($this->params->get('show_page_heading')) : ?>

        <?php if ($this->params->get('show_page_heading') and $params->get('show_title')) :?>
        <hgroup>
            <?php endif; ?>
            <h1>
                <?php echo $this->escape($this->params->get('page_heading')); ?>
            </h1>
            <?php endif; ?>
            <?php
            if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
            {
                echo $this->item->pagination;
            }
            if ($params->get('show_title')) :
            ?>
            <h2>
                <?php echo $this->escape($this->item->title); ?>
            </h2>
            <?php endif; ?>
            <?php if ($this->params->get('show_page_heading') and $params->get('show_title')) :?>
        </hgroup>
        <?php endif; ?>

        <?php if ($params->get('show_parent_category') && $this->item->parent_slug != '1:root') : ?>
        <div class="parent-category-name">
            <?php
                  $title = $this->escape($this->item->parent_title);
                  $url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)).'">'.$title.'</a>';
            ?>
            <?php if ($params->get('link_parent_category') and $this->item->parent_slug) : ?>
            <?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
            <?php else : ?>
            <?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if ($params->get('show_category')) : ?>
        <div class="category-name">
            <?php
                  $title = $this->escape($this->item->category_title);
                  $url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';
            ?>
            <?php if ($params->get('link_category') and $this->item->catslug) : ?>
            <?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
            <?php else : ?>
            <?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if ($params->get('show_create_date')) : ?>
        <div class="create">
            <?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHtml::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2'))); ?>
        </div>
        <?php endif; ?>
        <?php if ($params->get('show_modify_date')) : ?>
        <div class="modified">
            <?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHtml::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
        </div>
        <?php endif; ?>
        <?php if ($params->get('show_publish_date')) : ?>
        <div class="published">
            <?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', JHtml::_('date', $this->item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
        </div>
        <?php endif; ?>


        <?php
        if (isset($urls) AND ((!empty($urls->urls_position) AND ($urls->urls_position == '0')) OR ($params->get('urls_position') == '0' AND empty($urls->urls_position)))
                     OR (empty($urls->urls_position) AND (!$params->get('urls_position')))) :
        ?>

        <?php echo $this->loadTemplate('links'); ?>
        <?php endif; ?>
        <?php  if (isset($images->image_fulltext) and !empty($images->image_fulltext)) : ?>
        <?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>

        <div class="img-fulltext-<?php echo htmlspecialchars($imgfloat); ?>">
            <img <?php if ($images->image_fulltext_caption): echo 'title="' .htmlspecialchars($images->image_fulltext_caption) .'"'; endif; ?>
                class="img-responsive"
                src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>" />
        </div>
        <?php endif; ?>
        <?php
        if (!empty($this->item->pagination) AND $this->item->pagination AND !$this->item->paginationposition AND !$this->item->paginationrelative):
            echo $this->item->pagination;
        endif;
        ?>
        <?php echo $this->item->text; ?>

        <?php
        if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND!$this->item->paginationrelative):
            echo $this->item->pagination;
        ?>
        <?php endif; ?>

        <?php if (isset($urls) AND ((!empty($urls->urls_position) AND ($urls->urls_position == '1')) OR ( $params->get('urls_position') == '1'))) : ?>

        <?php echo $this->loadTemplate('links'); ?>
        <?php endif; ?>
        <?php
        if (!empty($this->item->pagination) AND $this->item->pagination AND $this->item->paginationposition AND $this->item->paginationrelative):
            echo $this->item->pagination;
        ?>
        <?php endif; ?>

        <?php // TAGS ?>
        <?php if ($params->get('show_tags', 1) && !empty($this->item->tags)) : ?>
        <?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
        <?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
        <?php endif; ?>
        <?php echo $this->item->event->afterDisplayContent; ?>

    </article>
</div>

<?php if($hasExtraContent) : ?>


<div class="col-xs-12 col-sm-12 col-md-4 buffer-before">

    <?php
          if (!$params->get('show_intro')) :
              echo $this->item->event->afterDisplayTitle;
          endif;
    ?>

    <?php echo $this->item->event->beforeDisplayContent; ?>


</div>
<?php endif; ?>



