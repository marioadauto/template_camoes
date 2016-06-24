<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_finder
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if ($this->params->get('show_advanced', 1) || $this->params->get('show_autosuggest', 1))
{
	JHtml::_('jquery.framework');

	$script = "
jQuery(function() {";
	if ($this->params->get('show_advanced', 1))
	{
		/*
         * This segment of code disables select boxes that have no value when the
         * form is submitted so that the URL doesn't get blown up with null values.
         */
		$script .= "
	jQuery('#finder-search').on('submit', function(e){
		e.stopPropagation();
		// Disable select boxes with no value selected.
		jQuery('#advancedSearch').find('select').each(function(index, el) {
			var el = jQuery(el);
			if(!el.val()){
				el.attr('disabled', 'disabled');
			}
		});
	});";
	}
	/*
     * This segment of code sets up the autocompleter.
     */
	if ($this->params->get('show_autosuggest', 1))
	{
		JHtml::_('script', 'media/jui/js/jquery.autocomplete.min.js', false, false, false, false, true);

		$script .= "
	var suggest = jQuery('#q').autocomplete({
		serviceUrl: '" . JRoute::_('index.php?option=com_finder&task=suggestions.suggest&format=json&tmpl=component', false) . "',
		paramName: 'q',
		minChars: 1,
		maxHeight: 400,
		width: 300,
		zIndex: 9999,
		deferRequestBy: 500
	});";
	}

	$script .= "
});";

	JFactory::getDocument()->addScriptDeclaration($script);
}
?>

<form id="finder-search" action="<?php echo JRoute::_($this->query->toUri()); ?>" method="get">
    <?php echo $this->getFields(); ?>

    <?php
	/*
     * DISABLED UNTIL WEIRD VALUES CAN BE TRACKED DOWN.
     */
	if (false && $this->state->get('list.ordering') !== 'relevance_dsc') : ?>
    <input type="hidden" name="o" value="<?php echo $this->escape($this->state->get('list.ordering')); ?>" />
    <?php endif; ?>
    <div class="form-group">
        <div class="input-group">
            <input type="text" name="q" id="q" value="<?php echo $this->escape($this->query->input); ?>" class="form-control" placeholder="<?php echo JText::_('COM_FINDER_SEARCH_TERMS'); ?>" />
            <div class="input-group-btn">
                <button name="Search" type="submit" class="btn btn-default">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <?php if ($this->params->get('show_advanced', 1)) : ?>
    <div>
        
        <div>
            <?php echo JHtml::_('filter.select', $this->query, $this->params); ?>
        </div>
    </div>
    <?php endif; ?>
</form>
