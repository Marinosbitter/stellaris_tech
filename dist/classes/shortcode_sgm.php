<?php
add_shortcode( 'sgm', 'sgm_shortcode_function' );
function sgm_shortcode_function( $atts ) {
    $atts = shortcode_atts( array(
        //        'foo' => 'no foo',
        //        'baz' => 'default baz'
    ), $atts, 'sgm' );

    ob_start();
    require_once(SGMPATH . 'templates/shortcode_sgm.php');
    $returnHTML = ob_get_contents();
    ob_end_clean();

    return $returnHTML;
}