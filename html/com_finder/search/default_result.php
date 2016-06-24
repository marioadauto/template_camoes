<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_finder
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Get the mime type class.
$mime = !empty($this->result->mime) ? 'mime-' . $this->result->mime : null;

$show_description = $this->params->get('show_description', 1);

if ($show_description)
{
	// Calculate number of characters to display around the result
	$term_length = JString::strlen($this->query->input);
	$desc_length = $this->params->get('description_length', 255);
	$pad_length = $term_length < $desc_length ? floor(($desc_length - $term_length) / 2) : 0;

	// Find the position of the search term
	$pos = JString::strpos(JString::strtolower($this->result->description), JString::strtolower($this->query->input));

	// Find a potential start point
	$start = ($pos && $pos > $pad_length) ? $pos - $pad_length : 0;

	// Find a space between $start and $pos, start right after it.
	$space = JString::strpos($this->result->description, ' ', $start > 0 ? $start - 1 : 0);
	$start = ($space && $space < $pos) ? $space + 1 : $start;

	$description = JHtml::_('string.truncate', JString::substr($this->result->description, $start), $desc_length, true);
}

$route = $this->result->route;

// Get the route with highlighting information.
if (!empty($this->query->highlight)
	&& empty($this->result->mime)
	&& $this->params->get('highlight_terms', 1)
	&& JPluginHelper::isEnabled('system', 'highlight'))
{
	$route .= '&highlight=' . base64_encode(json_encode($this->query->highlight));
}
$image=json_decode($this->result->image);
$aimage=$image->image_fulltext;
$hasImage = isset($aimage) && !empty($aimage);
?>

<div class="finder-result">
   
    <div class="row">
        <?php if ($hasImage) : ?>
        <div class="col-xs-12 col-sm-4 col-lg-3">
            <div class="search-article-image" style="background-image: url(/<?php echo htmlspecialchars($aimage); ?>"></div>
        </div>
        <?php endif; ?>
        <div class="col-xs-12 <?php echo ($hasImage) ? "col-sm-8 col-lg-9" : "" ?>">
            <h3 class="result-title <?php echo $mime; ?>">
                <a href="<?php echo JRoute::_($route); ?>">
                    <?php echo $this->result->title; ?>
                </a>
            </h3>

            <?php echo $this->result->image_fulltext; ?>
            <?php if ($show_description) : ?>
            <p class="result-text<?php echo $this->pageclass_sfx; ?>">
                <?php echo $description; ?>
            </p>
            <?php endif; ?>
            <?php if ($this->params->get('show_url', 1)) : ?>
            <div class="small result-url<?php echo $this->pageclass_sfx; ?>">
                <?php echo $this->baseUrl, JRoute::_($this->result->route); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
