<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
include( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR. 'boleto/create/actives-plugins.php' );
include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/pages/functions.php');

global $wpdb;
$email_loja = get_option( 'CompraDiretaPagSeguroBoleto_Plugin_ATextInput' );
$token_loja = get_option( 'CompraDiretaPagSeguroBoleto_Plugin_BTextInput' );
$nome_loja = get_option( 'CompraDiretaPagSeguroBoleto_Plugin_CTextInput' );
$ambiente = get_option( 'CompraDiretaPagSeguroBoleto_Plugin_DTextInput' );

$tipo_pagamento_inicial = get_option( 'CompraDiretaPagSeguroBoleto_Plugin_HTextInput' );
$tipo_pagamento_parcelado = get_option( 'CompraDiretaPagSeguroBoleto_Plugin_ITextInput' );


$code = "";
$body = "";
$success = "";


switch($ambiente){
case 'sandbox':
echo esc_html( __('This system does not work in sandbox ', 'compra-direta-pag-seguro-boleto')).'<br>';
echo esc_html( __('Go to the Wordpress Admin Panel; Plugins; Boleto Pag Seguro Seguro and change preferences.', 'compra-direta-pag-seguro-boleto')).'<br>';
echo esc_html( __('Needing a little help? I can help.', 'compra-direta-pag-seguro-boleto')).'<br><br>';
echo '<a href="'.get_admin_url().'plugins.php?page=CompraDiretaPagSeguroBoleto_PluginSettings">';
echo esc_html( __('SETTINGS', 'compra-direta-pag-seguro-boleto')).' </a><br><br>';
echo esc_html( __('Take a quiz generating a donation for this plugin and get free support.', 'compra-direta-pag-seguro-boleto')).'<br>';
echo esc_url ('<a href="https://entregador.click/wordpress-works/form-dados-do-boleto-cdps/">');
echo esc_html( __('Click here to help!', 'compra-direta-pag-seguro-boleto')).' </a><br><br>';
echo esc_html( __('Generates the Compra Direta Pag Seguro Boleto without typing the password. Documents in sequential order from 1 to 10. Version 0.5+ update settings', 'compra-direta-pag-seguro-boleto')).'<br>';

break;
case 'production':
include( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR  .'boleto/pages/dados-do-boleto.php' );
include( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR  .'boleto/pages/cadastra-usuario.php' );

	
		$contador = 2;
		
		while($contador>0) {				
							
							if($contador>1){
							//instalmments						
							$valor = $valor_parcelas;
							$descricao = $tipo_pagamento_parcelado.'/'.$title_post;
							$vencimento = $vencimento_parcelas;
							$instrucoes = esc_html( __( 'Ref: ', 'compra-direta-pag-seguro-boleto')).'/'.esc_attr($descricao).' - '.esc_attr($nome_loja);
							$instrucoes = strtoupper($instrucoes);
							$instrucoes = substr($instrucoes, 0, 99);
							$meta_referencia_post = sanitize_text_field($_POST['referencia_post']).'-'.time(); 
							include( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR  .'boleto/pages/post_remote_request.php' );	
										
							}
									
							if($contador==1){
							// initial pay
							$valor = $valor_inicial;
							if($valor>0){
								$descricao = $tipo_pagamento_inicial.'/'.$title_post;
								$vencimento = $vencimento_inicial;
								$instrucoes = esc_html( __( 'Ref: ', 'compra-direta-pag-seguro-boleto')).'/'.esc_attr($descricao).' - '.esc_attr($nome_loja);
								$instrucoes = strtoupper($instrucoes);
								$instrucoes = substr($instrucoes, 0, 99);
								$parcelas = 1;
								$meta_referencia_post = sanitize_text_field($_POST['referencia_post']).'-'.time(); 
							include( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR  .'boleto/pages/post_remote_request.php' );							
								}	
							}

				$contador = $contador - 1;
				
		} // end while
		
	
		
		?>
		

		
		
		
		<?php
	
		

break;
}
	
						$body .=  esc_html( __('You will receive an email with transaction data in ', 'compra-direta-pag-seguro-boleto')) .esc_attr($email_cliente).'<br>' ;	
	
		?>
				<script>
window.addEventListener('keydown', function (e) {
    var code = e.which || e.keyCode;
    if (code == 116) e.preventDefault();
    else return true;
    alert("<?php echo esc_html( __('It looks like you already generated this document (s). Check your email to confirm. If I`m wrong you should go back to the form and start over. Excuse me.', 'boleto-pag-seguro-direto'));?>");
});</script>