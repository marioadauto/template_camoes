<?php
/**
 * @package    DPCalendar
 * @author     Digital Peak http://www.digital-peak.com
 * @copyright  Copyright (C) 2007 - 2016 Digital Peak. All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
defined('_JEXEC') or die();

$event = $this->event;
if (($event->capacity !== null && (int)$event->capacity === 0) || DPCalendarHelper::isFree())
{
	return;
}

$params = $this->params;
if (!$params->get('event_show_bookings', '1'))
{
	return;
}

$tickets = array();
foreach ($event->tickets as $t)
{
	if (JFactory::getUser()->id > 0 && JFactory::getUser()->id == $t->user_id)
	{
		$tickets[] = $t;
	}
}

if ($tickets)
{
	JFactory::getApplication()->enqueueMessage(
			JText::plural('COM_DPCALENDAR_VIEW_EVENT_BOOKED_TEXT',
					count($tickets),
					DPCalendarHelperRoute::getTicketsRoute(null, $event->id, true)
			)
	);
}
?>
<h2 class="dpcal-event-header"><?php echo JText::_('COM_DPCALENDAR_VIEW_EVENT_BOOKING_INFORMATION');?></h2>
<?php
if (DPCalendarHelperBooking::openForBooking($event))
{
?>
	<p class="alert noprint" id="dp-event-book-text">
		<a href="<?php echo DPCalendarHelperRoute::getBookingFormRouteFromEvent($event, JUri::getInstance()->toString())?>">
		<i class="icon-plus"> </i>
		<?php echo JText::_('COM_DPCALENDAR_VIEW_EVENT_TO_BOOK_TEXT')?>
		</a>
	</p>
<?php
}?>
<?php
if ($params->get('event_show_price', '1') && $event->price != '0.00' && $event->price)
{?>
<dl class="dl-horizontal" id="dp-event-capacity">
	<dt class="event-label"><?php echo JText::_('COM_DPCALENDAR_FIELD_PRICE_LABEL');?>: </dt>
	<dd class="event-content" title="<?php echo DPCalendarHelper::getComponentParameter('currency', 'USD');?>"><?php echo $this->escape($event->price . ' ' . DPCalendarHelper::getComponentParameter('currency_symbol', '$'))?></dd>
	<?php echo DPCalendarHelperSchema::offer($event);?>
</dl>
<?php
}

if ($params->get('event_show_capacity', '1') && ($event->capacity === null || $event->capacity > 0))
{?>
<dl class="dl-horizontal" id="dp-event-capacity">
	<dt class="event-label"><?php echo JText::_('COM_DPCALENDAR_FIELD_CAPACITY_LABEL');?>: </dt>
	<dd class="event-content"><?php echo $event->capacity === null ? JText::_('COM_DPCALENDAR_FIELD_CAPACITY_UNLIMITED') : (int)$event->capacity?></dd>
</dl>
<dl class="dl-horizontal" id="dp-event-capacity">
	<dt class="event-label"><?php echo JText::_('COM_DPCALENDAR_FIELD_CAPACITY_USED_LABEL');?>: </dt>
	<dd class="event-content"><?php echo $event->capacity_used?></dd>
</dl>
<?php
}
