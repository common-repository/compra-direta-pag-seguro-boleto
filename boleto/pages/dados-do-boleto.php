<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( 
    ! isset( $_POST['nonce_compra_direta_pag_seguro_boleto_form'] ) 
    || ! wp_verify_nonce( $_POST['nonce_compra_direta_pag_seguro_boleto_form'], 'nonce_compra_direta_pag_seguro_boleto' ) 
) {
	echo '<a href="javascript:history.back()">'.__('Sorry, your session has expired. Please go back and try again.', 'compra-direta-pag-seguro-boleto').'</a>';

   exit;
} else {
  $value1 = sanitize_text_field($_POST['value1']); 
  $value2 = sanitize_text_field($_POST['value2']);
  $value3 = sanitize_text_field($_POST['value3']); 
  $value4 = $value1 + $value2;
}	
BPSD_ValidFieldsSome($value1,$value2,$value3,$value4);
	
 	$id_post = sanitize_text_field($_POST['id_post']); 
	$title_post = sanitize_text_field($_POST['title_post']); 
	
	
	$parcelas = sanitize_text_field($_POST['parcelas']);
	BPSD_ValidFieldParcelas($parcelas);
	
	if($parcelas==1){
	$meta_anuidade_1x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_1x' AND post_id = '$id_post' " );
	$valor_parcelas = $meta_anuidade_1x;
	}
	
	
	if($parcelas==2){
	$meta_anuidade_2x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_2x' AND post_id = '$id_post' " );
	$valor_parcelas = $meta_anuidade_2x;
	}

	if($parcelas==3){
	$meta_anuidade_3x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_3x' AND post_id = '$id_post' " );
	$valor_parcelas = $meta_anuidade_3x;
	}
	
	
		if($parcelas==4){
	$meta_anuidade_4x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_4x' AND post_id = '$id_post' " );
	$valor_parcelas = $meta_anuidade_4x;
	}
	
	
		if($parcelas==5){
	$meta_anuidade_5x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_5x' AND post_id = '$id_post' " );
	$valor_parcelas = $meta_anuidade_5x;
	}

	if($parcelas==6){
	$meta_anuidade_6x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_6x' AND post_id = '$id_post' " );
	$valor_parcelas = $meta_anuidade_6x;
	}
	
	
		if($parcelas==7){
	$meta_anuidade_7x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_7x' AND post_id = '$id_post' " );
	$valor_parcelas = $meta_anuidade_7x;
	}
	
	
		if($parcelas==8){
	$meta_anuidade_8x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_8x' AND post_id = '$id_post' " );
	$valor_parcelas = $meta_anuidade_8x;
	}
	
	
		if($parcelas==9){
	$meta_anuidade_9x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_9x' AND post_id = '$id_post' " );
	$valor_parcelas = $meta_anuidade_9x;
	}
	

	if($parcelas==10){
	$meta_anuidade_10x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_10x' AND post_id = '$id_post' " );
	$valor_parcelas = $meta_anuidade_10x;
	}
	
	if($parcelas==11){
	$meta_anuidade_11x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_11x' AND post_id = '$id_post' " );
	$valor_parcelas = $meta_anuidade_11x;
	}

	if($parcelas==12){
	$meta_anuidade_12x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_12x' AND post_id = '$id_post' " );
	$valor_parcelas = $meta_anuidade_12x;
	}


	$nome  = sanitize_text_field($_POST['nome']);	

	BPSD_ValidFieldNomeCliente($nome);
	
	$email_cliente  = sanitize_email($_POST['email']);

	BPSD_ValidFieldEmailCliente($email_cliente);

	$telefone  = sanitize_text_field($_POST['telefone']);

	BPSD_ValidFieldTelefoneCliente($telefone);
	BPSD_ValidFieldTelefoneClienteStepTwo($telefone);

	$logradouro  = sanitize_text_field($_POST['logradouro']);

	BPSD_ValidFieldLogradouroCliente($logradouro);

	$numero  = sanitize_text_field($_POST['numero']);

	BPSD_ValidFieldLogradouroNumeroCliente($numero);

	$complemento  = sanitize_text_field($_POST['complemento']);

	BPSD_ValidFieldLogradouroCompCliente($complemento);

	$bairro  = sanitize_text_field($_POST['bairro']);

	BPSD_ValidFieldLogradouroBairroCliente($bairro);

	$cep  = sanitize_text_field($_POST['cep']);
	BPSD_ValidFieldLogradouroCepCliente($cep);

	$cidade  = sanitize_text_field($_POST['cidade']);

	$uf  = sanitize_text_field($_POST['uf']);

	$cpf_cliente  = sanitize_text_field($_POST['cpf']);	

	BPSD_ValidCPFStepTwo($cpf_cliente);
		
	// valor da adesao
	if(isset($_POST['valor'])){
	$valor = sanitize_text_field($_POST['valor']);
	$valor =  BPSD_FormataValorPagSeguro($valor)*1;
	}
	
	
	// valor da parcela
	$valor_parcelas =  BPSD_FormataValorPagSeguro($valor_parcelas)*1;

	if(get_option( 'CompraDiretaPagSeguroBoleto_Plugin_ETextInput' )=="no") {
	$valor =  $valor - 1;
	$valor_parcelas =  $valor_parcelas - 1 ;
	}
	
	$valor_inicial = number_format($valor,2,".",",");
	$valor_parcelas = number_format($valor_parcelas,2,".",",");

	if(isset($_POST['vencimento'])){
	$vencimento = sanitize_text_field($_POST['vencimento']);
	}

	BPSD_ValidFieldVencimento($vencimento);
	$vencimento_inicial =  date("Y-m-d", strtotime($vencimento));
	$vencimento_parcelas = date('Y-m-d', strtotime("+30 day")); //  + 30 day

	$telefone = BPSD_ValidFieldTelefoneCliente($telefone);
	$ddd	= substr($telefone, 0, 2);
	$fone 	= substr($telefone, 2);
?>