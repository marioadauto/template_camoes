<?php

/**

 * @package     Joomla.Site

 * @subpackage  mod_related_items_joomir

 *

 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.

 * @license     GNU General Public License version 2 or later; see LICENSE.txt

 */



defined('_JEXEC') or die;

?>

<div class="related-articles<?php echo $moduleclass_sfx; ?> col-xs-12">

    <h2>Relacionados</h2>
    <div class="row">
        <?php foreach ($list as $item) :	?>

        <?php $urlimg=json_decode($item->images)->image_fulltext; ?>

        <div class="newsbox col-lg-3 col-md-4 col-sm-6">
            <div class="border-box">
                <a href="<?php echo $item->route; ?>">
                    <div class="article-img" style="background-image:url(<?php echo $urlimg ?>)"></div>
                </a>
                <h3>
                    <a href="<?php echo $item->route; ?>">
                        <?php echo $item->title; ?>
                    </a>
                </h3>
                <p>
                    <?php echo mb_substr(strip_tags($item->introtext),0,110) ?>
                </p>

            </div>
        </div>

        <?php endforeach; ?>
    </div>
</div>

