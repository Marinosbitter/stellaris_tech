<?php
function sgm_enqueue_stylesheets() 
{
    wp_enqueue_style( 'index', SGMURL . '/css/index.css' );
    wp_enqueue_script( 'd3js', 'https://d3js.org/d3.v5.min.js', array(), false, false);
}

add_action('wp_enqueue_scripts', 'sgm_enqueue_stylesheets');