<?php
// Register Custom Taxonomy
function custom_taxonomy_tech_category() {

    $labels = array(
        'name'                       => _x( 'Tech Categories', 'Taxonomy General Name', 'sgm' ),
        'singular_name'              => _x( 'Tech Category', 'Taxonomy Singular Name', 'sgm' ),
        //		'menu_name'                  => __( 'Taxonomy', 'sgm' ),
        //		'all_items'                  => __( 'All Items', 'sgm' ),
        //		'parent_item'                => __( 'Parent Item', 'sgm' ),
        //		'parent_item_colon'          => __( 'Parent Item:', 'sgm' ),
        //		'new_item_name'              => __( 'New Item Name', 'sgm' ),
        //		'add_new_item'               => __( 'Add New Item', 'sgm' ),
        //		'edit_item'                  => __( 'Edit Item', 'sgm' ),
        //		'update_item'                => __( 'Update Item', 'sgm' ),
        //		'view_item'                  => __( 'View Item', 'sgm' ),
        //		'separate_items_with_commas' => __( 'Separate items with commas', 'sgm' ),
        //		'add_or_remove_items'        => __( 'Add or remove items', 'sgm' ),
        //		'choose_from_most_used'      => __( 'Choose from the most used', 'sgm' ),
        //		'popular_items'              => __( 'Popular Items', 'sgm' ),
        //		'search_items'               => __( 'Search Items', 'sgm' ),
        //		'not_found'                  => __( 'Not Found', 'sgm' ),
        //		'no_terms'                   => __( 'No items', 'sgm' ),
        //		'items_list'                 => __( 'Items list', 'sgm' ),
        //		'items_list_navigation'      => __( 'Items list navigation', 'sgm' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'tech_category', array( 'sgm_tech' ), $args );

}
add_action( 'init', 'custom_taxonomy_tech_category', 0 );