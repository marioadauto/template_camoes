<?php
/**
 * @package    DPCalendar
 * @author     Digital Peak http://www.digital-peak.com
 * @copyright  Copyright (C) 2007 - 2016 Digital Peak. All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
defined('_JEXEC') or die();

$event = $this->event;
$params = $this->params;
?>

<h2 class="dp-event-title" itemprop="name">
    <?php
    $title = $this->escape($event->title);
    if (JFactory::$application->input->get('tmpl') == 'component')
    {
        $title = '<a href="' . str_replace('tmpl=component', '', DPCalendarHelperRoute::getEventRoute($event->id, $event->catid)) . '" target="_parent">' . $title . '</a>';
    }
    echo $title;
    ?>
</h2>

