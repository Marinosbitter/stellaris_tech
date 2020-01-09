<?php
add_shortcode( 'sgm', 'sgm_shortcode_function' );
function sgm_shortcode_function( $atts ) {
    $atts = shortcode_atts( array(
        //        'foo' => 'no foo',
        //        'baz' => 'default baz'
    ), $atts, 'sgm' );

    require_once(SGMPATH . 'templates/shortcode_sgm.php');
    $returnHTML = $output;

    return $returnHTML;
}