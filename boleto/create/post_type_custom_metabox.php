<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function cdps_metabox( $meta_boxes ) {
	$prefix = 'cdps-';

	$meta_boxes[] = array(
		'id' => 'valores',
		'title' => esc_html__( 'Prices', 'compra-direta-pag-seguro-boleto' ),
		'post_types' => array('post', 'page' ),
		'context' => 'after_title',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'pagamento_inicial',
				'type' => 'text',
				'name' => esc_html__( 'Initital charge', 'compra-direta-pag-seguro-boleto' ),
				'std' => '',
				'attributes' => array(),
			),
			
			array(
				'id' => $prefix . 'anuidade_1x',
				'type' => 'text',
				'name' => esc_html__( '1 installment of', 'compra-direta-pag-seguro-boleto' ),
				'std' => '',
				'attributes' => array(),
			),
				
				array(
				'id' => $prefix . 'anuidade_2x',
				'type' => 'text',
				'name' => esc_html__( '2 installments of', 'compra-direta-pag-seguro-boleto' ),
				'std' => '',
				'attributes' => array(),
			),
			
			
				array(
				'id' => $prefix . 'anuidade_3x',
				'type' => 'text',
				'name' => esc_html__( '3 installments of', 'compra-direta-pag-seguro-boleto' ),
				'std' => '',
				'attributes' => array(),
			),
			
			    array(
				'id' => $prefix . 'anuidade_4x',
				'type' => 'text',
				'name' => esc_html__( '4 installments of', 'compra-direta-pag-seguro-boleto' ),
				'std' => '',
				'attributes' => array(),
			),
			
			
				array(
				'id' => $prefix . 'anuidade_5x',
				'type' => 'text',
				'name' => esc_html__( '5 installments of', 'compra-direta-pag-seguro-boleto' ),
				'std' => '',
				'attributes' => array(),
			),
			
				array(
				'id' => $prefix . 'anuidade_6x',
				'type' => 'text',
				'name' => esc_html__( '6 installments of', 'compra-direta-pag-seguro-boleto' ),
				'std' => '',
				'attributes' => array(),
			),
			
			
				array(
				'id' => $prefix . 'anuidade_7x',
				'type' => 'text',
				'name' => esc_html__( '7 installments of', 'compra-direta-pag-seguro-boleto' ),
				'std' => '',
				'attributes' => array(),
			),
			
			
				array(
				'id' => $prefix . 'anuidade_8x',
				'type' => 'text',
				'name' => esc_html__( '8 installments of', 'compra-direta-pag-seguro-boleto' ),
				'std' => '',
				'attributes' => array(),
			),
			
			
				array(
				'id' => $prefix . 'anuidade_9x',
				'type' => 'text',
				'name' => esc_html__( '9 installments of', 'compra-direta-pag-seguro-boleto' ),
				'std' => '',
				'attributes' => array(),
			),
			
			
			
				array(
				'id' => $prefix . 'anuidade_10x',
				'type' => 'text',
				'name' => esc_html__( '10 installments of', 'compra-direta-pag-seguro-boleto' ),
				'std' => '',
				'attributes' => array(),
			),
			
			
				array(
				'id' => $prefix . 'anuidade_11x',
				'type' => 'text',
				'name' => esc_html__( '11 installments of', 'compra-direta-pag-seguro-boleto' ),
				'std' => '',
				'attributes' => array(),
			),

				array(
				'id' => $prefix . 'anuidade_12x',
				'type' => 'text',
				'name' => esc_html__( '12 installments of', 'compra-direta-pag-seguro-boleto' ),
				'std' => '',
				'attributes' => array(),
			),



				array(
				'id' => $prefix . 'referencia_post',
				'type' => 'text',
				'name' => esc_html__( 'Post reference', 'compra-direta-pag-seguro-boleto' ),
				'std' => '',
				'attributes' => array(),
			),


			
					
		),
	);

	return $meta_boxes;
}



add_filter( 'rwmb_meta_boxes', 'cdps_metabox' );


?>