<?php

/**

 * @copyright    Copyright (C) 2008 Ian MacLennan. All rights reserved.

 * @copyright    Upgrade to J2.5.  Copyright 2012 HartlessByDesign, LLC.

 * @copyright    Portions Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.

 * @license      GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html

 */





// no direct access

defined('_JEXEC') or die('Restricted access');

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$images          = json_decode($item->images);

$hasExtraContent = (!empty($item->event->beforeDisplayContent)||!empty($item->event->afterDisplayTitle));

?>

<div class='article_anywhere<?php echo $moduleclass_sfx; ?>'>
   
    <?php if ($params->get('show_title')): ?>

    <h2 class='article_anywhere_title'>

        <?php if ($params->get('link_titles') && !empty($item->readmore_link)) : ?>

        <!--<a href="<?php echo $item->readmore_link; ?>">-->
            <?php echo htmlspecialchars($item->title); ?>
        <!--</a>-->

        <?php else : ?>

        <?php echo htmlspecialchars($item->title); ?>

        <?php endif; ?>

    </h2>
    <?php endif; ?>

    <div class="row">
        <div class="col-xs-12 col-sm-12 <?php echo $hasExtraContent ? "col-md-8" : "" ?>">
            <div class="article_anywhere_content">
                <?php  if ($params->get('image') && isset($images->image_fulltext) and !empty($images->image_fulltext)) : ?>

                <?php $imgfloat = (empty($images->float_fulltext)) ? $params->get('float_fulltext') : $images->float_fulltext; ?>

                <div class="img-fulltext-<?php echo htmlspecialchars($imgfloat); ?>">

                    <img
                        <?php if ($images->image_fulltext_caption):

                              echo 'class="caption"'.' title="' .htmlspecialchars($images->image_fulltext_caption) .'"';

                          endif; ?>
                        src="<?php echo htmlspecialchars($images->image_fulltext); ?>" alt="<?php echo htmlspecialchars($images->image_fulltext_alt); ?>" />

                </div>

                <?php endif; ?>

                <?php echo $item->text; ?>

                <?php echo $item->event->afterDisplayContent; ?>
            </div>
        </div>

        <?php if($hasExtraContent) : ?>
        
        <div class="col-xs-12 col-sm-12 col-md-4">

            <?php echo $item->event->afterDisplayTitle; ?>
            

            <?php echo $item->event->beforeDisplayContent; ?>

        </div>
        <?php endif; ?>

    </div>
   
</div>