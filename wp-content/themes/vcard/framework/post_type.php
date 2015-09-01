<?php
add_action( 'init', 'register_vcard_Portfolio' );
function register_vcard_Portfolio() {
    
    $labels = array( 
        'name' => __( 'Portfolio', 'vcard' ),
        'singular_name' => __( 'Portfolio', 'vcard' ),
        'add_new' => __( 'Add New Portfolio', 'vcard' ),
        'add_new_item' => __( 'Add New Portfolio', 'vcard' ),
        'edit_item' => __( 'Edit Portfolio', 'vcard' ),
        'new_item' => __( 'New Portfolio', 'vcard' ),
        'view_item' => __( 'View Portfolio', 'vcard' ),
        'search_items' => __( 'Search Portfolios', 'vcard' ),
        'not_found' => __( 'No Portfolios found', 'vcard' ),
        'not_found_in_trash' => __( 'No Portfolios found in Trash', 'vcard' ),
        'parent_item_colon' => __( 'Parent Portfolio:', 'vcard' ),
        'menu_name' => __( 'Portfolio', 'vcard' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'List Portfolio',
        'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'post-formats' ),
        'taxonomies' => array( 'Portfolio_category','categories','tags' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => get_stylesheet_directory_uri(). '/images/admin_ico.png', 
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'Portfolio', $args );
}
add_action( 'init', 'create_Categories_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it Skillss for your posts

function create_Categories_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => __( 'Categories', 'vcard' ),
    'singular_name' => __( 'Categories', 'vcard' ),
    'search_items' =>  __( 'Search Categories','vcard' ),
    'all_items' => __( 'All Categories','vcard' ),
    'parent_item' => __( 'Parent Categories','vcard' ),
    'parent_item_colon' => __( 'Parent Categories:','vcard' ),
    'edit_item' => __( 'Edit Categories','vcard' ), 
    'update_item' => __( 'Update Categories','vcard' ),
    'add_new_item' => __( 'Add New Categories','vcard' ),
    'new_item_name' => __( 'New Categories Name','vcard' ),
    'menu_name' => __( 'Categories','vcard' ),
  );     

// Now register the taxonomy

  register_taxonomy('categories',array('Portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'categories' ),
  ));

}
add_action( 'init', 'create_Tags_hierarchical_taxonomy', 0 );

//create a custom taxonomy name it Skillss for your posts

function create_Tags_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => __( 'Tags', 'vcard' ),
    'singular_name' => __( 'Tags', 'vcard' ),
    'search_items' =>  __( 'Search Tags','vcard' ),
    'all_items' => __( 'All Tags','vcard' ),
    'parent_item' => __( 'Parent Tags','vcard' ),
    'parent_item_colon' => __( 'Parent Tags:','vcard' ),
    'edit_item' => __( 'Edit Tags','vcard' ), 
    'update_item' => __( 'Update Tags','vcard' ),
    'add_new_item' => __( 'Add New Tags','vcard' ),
    'new_item_name' => __( 'New Tags Name','vcard' ),
    'menu_name' => __( 'Tags','vcard' ),
  );     

// Now register the taxonomy

  register_taxonomy('tags',array('Portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'tags' ),
  ));

}
?>