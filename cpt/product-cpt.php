<?php 
function create_post_type_products() {  

    $single_name = 'Product';
    $plural_name = 'Products';

    register_post_type('product',
        array(
            'label' => $plural_name,
            'description' => $plural_name,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'capability_type' => 'post',
            'hierarchical' => true,
            'taxonomies' => array('products_categories'),
            'has_archive' => true,
            'rewrite' => array(
                'with_front' => false,
                'slug' => 'product'
            ),
            'query_var' => true,
            'exclude_from_search' => false,
            'menu_position' => 0,
            'supports' => array(
                'title',
                'editor',
                'excerpt'
            ),
            'labels' => array (
                'name' => $plural_name,
                'singular_name' => $single_name,
                'menu_name' => $plural_name,
                'add_new' => 'Add '.$single_name,
                'add_new_item' => 'Add New '.$single_name,
                'edit' => 'Edit',
                'edit_item' => 'Edit '.$single_name,
                'new_item' => 'New '.$single_name,
                'view' => 'View '.$single_name,
                'view_item' => 'View '.$single_name,
                'search_items' => 'Search '.$plural_name,
                'not_found' => 'No '.$plural_name.' Found',
                'not_found_in_trash' => 'No '.$plural_name.' Found in Trash'
            )
        )
    );
}

add_action( 'init', 'create_post_type_products' );