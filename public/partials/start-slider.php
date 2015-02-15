<?php
/*
 * $bl_slides contain the array of slide to be showed
 * %atts contains the attributes set on the shortcode
 * use this variables to customize your view
 * it also availeble the global variable $bl_sliders_printed to have information
 * about already printed gallery in the page
 * */

global $bl_sliders_printed;
?>

<div id="carousel-<?php echo count($bl_sliders_printed); ?>" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?foreach($bl_slides as $bl_slide_index => $bl_slide): ?>
            <?php ( 0 === $bl_slide_index ) ? $bl_slide_class="active" : $bl_slide_class=""; ?>
            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $bl_slide_index?>" class="<?php echo $bl_slide_class?>"></li>
        <?endforeach; ?>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
