<?php
/**
 * Plugin Name:       Stellaris game mechanics
 * Plugin URI:        https://code.marinosbitter.nl/plugins/stellaris-game-mechanics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Marinosbitter
 * Author URI:        https://marinosbitter.nl/
 * Text Domain:       stellaris-game-mechanics
 * Domain Path:       /languages
 */
add_shortcode( 'stellaris-game-mechanics', 'sgm_shortcode_function' );
function sgm_shortcode_function( $atts ) {
    $atts = shortcode_atts( array(
        //        'foo' => 'no foo',
        //        'baz' => 'default baz'
    ), $atts, 'stellaris-game-mechanics' );

    $returnHTML = "Horizon event";

    return $returnHTML;
}

class SGM {
    public function __construct(){        
        define( 'SGMPATH', plugin_dir_path( __FILE__ ) . "/dist/" );
        define( 'SGMURL', plugin_dir_url( __FILE__ ) . "/dist/" );

        $this->setup_automatic_updater();
        foreach (glob(plugin_dir_path( __FILE__ ) . 'dist/classes/*.php') as $filename)
        {
            require_once($filename);
        }
    }
    private function setup_automatic_updater(){
        require plugin_dir_path( __FILE__ ) . 'dist/frameworks/plugin-update-checker/plugin-update-checker.php';
        $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
            'https://github.com/Marinosbitter/stellaris_tech/',
            __FILE__,
            'stellaris-game-mechanics'
        );

        //Optional: Set the branch that contains the stable release.
        $myUpdateChecker->setBranch('master');
    }
}
$sgm = new SGM();