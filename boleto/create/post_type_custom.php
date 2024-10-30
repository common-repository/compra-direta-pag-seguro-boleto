<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function CDPS_codex_boleto_init() {
    $labels = array(
        'name'                  => _x( 'Boletos', 'Post type general name', 'compra-direta-pag-seguro-boleto' ),
        'singular_name'         => _x( 'Boleto', 'Post type singular name', 'compra-direta-pag-seguro-boleto' ),
        'menu_name'             => _x( 'Boletos', 'Admin Menu text', 'compra-direta-pag-seguro-boleto' ),
        'name_admin_bar'        => _x( 'Boleto', 'Add New on Toolbar', 'compra-direta-pag-seguro-boleto' ),
        'add_new'               => __( 'Add New', 'compra-direta-pag-seguro-boleto' ),
        'add_new_item'          => __( 'Add New Boleto', 'compra-direta-pag-seguro-boleto' ),
        'new_item'              => __( 'New Boleto', 'compra-direta-pag-seguro-boleto' ),
        'edit_item'             => __( 'Edit Boleto', 'compra-direta-pag-seguro-boleto' ),
        'view_item'             => __( 'View Boleto', 'compra-direta-pag-seguro-boleto' ),
        'all_items'             => __( 'All Boletos', 'compra-direta-pag-seguro-boleto' ),
        'search_items'          => __( 'Search Boletos', 'compra-direta-pag-seguro-boleto' ),
        'parent_item_colon'     => __( 'Parent Boletos:', 'compra-direta-pag-seguro-boleto' ),
        'not_found'             => __( 'No boletos found.', 'compra-direta-pag-seguro-boleto' ),
        'not_found_in_trash'    => __( 'No boletos found in Trash.', 'compra-direta-pag-seguro-boleto' ),
        'featured_image'        => _x( 'Boleto Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'compra-direta-pag-seguro-boleto' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'compra-direta-pag-seguro-boleto' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'compra-direta-pag-seguro-boleto' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'compra-direta-pag-seguro-boleto' ),
        'archives'              => _x( 'Boleto archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'compra-direta-pag-seguro-boleto' ),
        'insert_into_item'      => _x( 'Insert into boleto', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'compra-direta-pag-seguro-boleto' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this boleto', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'compra-direta-pag-seguro-boleto' ),
        'filter_items_list'     => _x( 'Filter boletos list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'compra-direta-pag-seguro-boleto' ),
        'items_list_navigation' => _x( 'Boletos list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'compra-direta-pag-seguro-boleto' ),
        'items_list'            => _x( 'Boletos list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'compra-direta-pag-seguro-boleto' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'boleto' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    );
 
    register_post_type( 'boleto', $args );
}
 
add_action( 'init', 'CDPS_codex_boleto_init' );
?>