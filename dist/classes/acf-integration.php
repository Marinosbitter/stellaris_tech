<?php
class SGMACFIntegration{
    public function __construct(){
        // Define path and URL to the ACF plugin.
        define( 'MY_ACF_PATH', SGMPATH . 'frameworks/advanced-custom-fields-pro/' );
        define( 'MY_ACF_URL', SGMURL . 'frameworks/advanced-custom-fields-pro/' );
        
        // Include the ACF plugin.
        include_once( MY_ACF_PATH . 'acf.php' );
        
        // Customize the url setting to fix incorrect asset URLs.
        add_filter('acf/settings/url', array($this, 'SGMACF_settings_url'));
        
        // (Optional) Hide the ACF admin menu item.
        add_filter('acf/settings/show_admin', array($this, 'my_acf_settings_show_admin'));
        
        // Add Local JSON save points
        add_filter('acf/settings/save_json', array($this, 'SGMACF_json_save_point'));
        add_filter('acf/settings/load_json', array($this, 'SGMACF_json_load_point'));
        
        // Add admin menus
        require_once( SGMPATH . 'acf-menus.php');
    }
    public function SGMACF_settings_url( $url ) {
        return MY_ACF_URL;
    }
    public function my_acf_settings_show_admin( $show_admin ) {
        return true;
    }
    public function SGMACF_json_save_point( $path ) {
        $path = SGMPATH . 'frameworks/acf-json';
        return $path;
    }
    public function SGMACF_json_load_point( $paths ) {
        unset($paths[0]);
        $paths[] = SGMPATH . 'frameworks/acf-json';
        return $paths;
    }
}
$SGMACFIntegration = new SGMACFIntegration();