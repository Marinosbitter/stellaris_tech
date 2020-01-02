<?php
function sgm_enqueue_stylesheets() 
{
    wp_enqueue_style( 'index', SGMURL . '/css/index.css' );
    wp_enqueue_script( 'beforeafter_image', SGMURL . '/js/shortcodes/beforeafter_image.js', array(), false, true);
}

add_action('wp_enqueue_scripts', 'sgm_enqueue_stylesheets');