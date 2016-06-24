<?php
/**
 * @package    DPCalendar
 * @author     Digital Peak http://www.digital-peak.com
 * @copyright  Copyright (C) 2007 - 2016 Digital Peak. All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
defined('_JEXEC') or die();

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

DPCalendarHelper::loadLibrary(array(
		'jquery' => true,
		'bootstrap' => true,
		'dpcalendar' => true
));

$document = JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'components/com_dpcalendar/views/event/tmpl/default.css');

$params = $this->params;
if ($params->get('event_show_map', '1'))
{
	DPCalendarHelper::loadLibrary(array(
			'maps' => true
	));
	$document->addScript(JURI::base() . 'components/com_dpcalendar/views/event/tmpl/event.js');
}

if (JFactory::getApplication()->input->getCmd('tmpl', '') == 'component')
{
	$document->addStyleSheet(JURI::base() . 'components/com_dpcalendar/views/event/tmpl/none-responsive.css');
}

$event = $this->event;

JPluginHelper::importPlugin('dpcalendar');

// User timezone when available
echo JLayoutHelper::render('user.timezone');
?>
<div id="dpcal-event-container" class="dp-container col-xs-12 buffer-bellow" itemscope
    itemtype="http://schema.org/Event">
        <?php
    echo implode(' ', JDispatcher::getInstance()->trigger('onEventBeforeDisplay', array(
            &$event
    )));
    // Header with buttons and title
    echo $this->loadTemplate('header');
    // Joomla event
    echo $event->displayEvent->afterDisplayTitle;
    ?>
   

            <?php
            // Description
            echo $this->loadTemplate('description');
            // Joomla event
            echo $event->displayEvent->afterDisplayContent;
            ?>
        
            <?php
            // Informations like date calendar
            echo $this->loadTemplate('information');
            // Contains custom fields
            echo $event->displayEvent->beforeDisplayContent;
            ?>
            <?php
            // Locations detail information
            echo $this->loadTemplate('locations');
            ?>

            <?php
            // After event trigger
            echo implode(' ', JDispatcher::getInstance()->trigger('onEventAfterDisplay', array(
                    &$event
            )));
            ?>
            
    <?php
    // Tags
    echo JLayoutHelper::render('joomla.content.tags', $event->tags->itemTags);

    // Booking details when available
    echo $this->loadTemplate('bookings');
    ?>
</div>
