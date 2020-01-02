<?php
// Register Custom Post Type
function custom_post_type_sgm_tech() {

    $labels = array(
        'name'                  => _x( 'Technologies', 'Post Type General Name', 'stellaris_mechanics' ),
        'singular_name'         => _x( 'Technology', 'Post Type Singular Name', 'stellaris_mechanics' ),
        //		'menu_name'             => __( 'Post Types', 'stellaris_mechanics' ),
        //		'name_admin_bar'        => __( 'Post Type', 'stellaris_mechanics' ),
        //		'archives'              => __( 'Item Archives', 'stellaris_mechanics' ),
        //		'attributes'            => __( 'Item Attributes', 'stellaris_mechanics' ),
        //		'parent_item_colon'     => __( 'Parent Item:', 'stellaris_mechanics' ),
        //		'all_items'             => __( 'All Items', 'stellaris_mechanics' ),
        //		'add_new_item'          => __( 'Add New Item', 'stellaris_mechanics' ),
        //		'add_new'               => __( 'Add New', 'stellaris_mechanics' ),
        //		'new_item'              => __( 'New Item', 'stellaris_mechanics' ),
        //		'edit_item'             => __( 'Edit Item', 'stellaris_mechanics' ),
        //		'update_item'           => __( 'Update Item', 'stellaris_mechanics' ),
        //		'view_item'             => __( 'View Item', 'stellaris_mechanics' ),
        //		'view_items'            => __( 'View Items', 'stellaris_mechanics' ),
        //		'search_items'          => __( 'Search Item', 'stellaris_mechanics' ),
        //		'not_found'             => __( 'Not found', 'stellaris_mechanics' ),
        //		'not_found_in_trash'    => __( 'Not found in Trash', 'stellaris_mechanics' ),
        //		'featured_image'        => __( 'Featured Image', 'stellaris_mechanics' ),
        //		'set_featured_image'    => __( 'Set featured image', 'stellaris_mechanics' ),
        //		'remove_featured_image' => __( 'Remove featured image', 'stellaris_mechanics' ),
        //		'use_featured_image'    => __( 'Use as featured image', 'stellaris_mechanics' ),
        //		'insert_into_item'      => __( 'Insert into item', 'stellaris_mechanics' ),
        //		'uploaded_to_this_item' => __( 'Uploaded to this item', 'stellaris_mechanics' ),
        //		'items_list'            => __( 'Items list', 'stellaris_mechanics' ),
        //		'items_list_navigation' => __( 'Items list navigation', 'stellaris_mechanics' ),
        //		'filter_items_list'     => __( 'Filter items list', 'stellaris_mechanics' ),
    );
    $args = array(
        'label'                 => __( 'Technology', 'stellaris_mechanics' ),
        'description'           => __( 'Technologies from the game Stellaris', 'stellaris_mechanics' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'sgm_tech', $args );

}
add_action( 'init', 'custom_post_type_sgm_tech', 0 );