<?php
/*
 * $bl_slides contain the post object for the printing slide
 * $bl_slide_index the index fot the slide
 * %atts contains the attributes set on the shortcode
 * use this variables to customize your view
 * it also availeble the global variable $bl_sliders_printed to have information
 * about already printed gallery in the page
 * */

global $bl_sliders_printed;

( 0 === $bl_slide_index ) ? $bl_slide_class="active" : $bl_slide_class="";
?>

<div class="item <?php echo $bl_slide_class?>">
    <?php if ( has_post_thumbnail( $bl_slide->ID ) ) { // check if the post has a Post Thumbnail assigned to it.
        echo    get_the_post_thumbnail( $bl_slide->ID );
    }?>
    <div class="carousel-caption">
        <h2><?php echo $bl_slide->post_title; ?></h2>
        <?php echo $bl_slide->post_content; ?>
    </div>
</div>
