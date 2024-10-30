<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$meta_key = '[form-dados-do-boleto-cdps]';
global $wpdb;

$post_id = $wpdb->get_var( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '[form-dados-do-boleto-cdps]'" );
if ($post_id) {

wp_delete_post( $post_id, true );

echo __('First page reset successfully.', 'compra-direta-pag-seguro-boleto').'<br>';

}
$meta_key = '[form-dados-do-boleto-confirma-cdps]';

$post_id = $wpdb->get_var( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '[form-dados-do-boleto-confirma-cdps]'" );
if ($post_id) {

wp_delete_post( $post_id, true );

echo __('Second page successfully redefined.', 'compra-direta-pag-seguro-boleto').'<br>';

}


$meta_key = '[pagamento-boleto-cdps]';

$post_id = $wpdb->get_var( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '[pagamento-boleto-cdps]'" );
if ($post_id) {

wp_delete_post( $post_id, true );

echo __('Third page successfully redefined.', 'compra-direta-pag-seguro-boleto').'<br>';

}


$meta_key = '[politica-de-privacidade-cdps]';

$post_id = $wpdb->get_var( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '[politica-de-privacidade-cdps]'" );
if ($post_id) {

wp_delete_post( $post_id, true );

echo __('Fourth page successfully redefined.', 'compra-direta-pag-seguro-boleto').'<br>';

}