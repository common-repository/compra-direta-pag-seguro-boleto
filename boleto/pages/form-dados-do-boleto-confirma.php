<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
include( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR. 'boleto/create/actives-plugins.php' );
include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/pages/functions.php');
global $wpdb;
include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/pages/formata.php');
if ( 

    ! isset( $_POST['nonce_compra_direta_pag_seguro_boleto_form'] ) 

    || ! wp_verify_nonce( $_POST['nonce_compra_direta_pag_seguro_boleto_form'], 'nonce_compra_direta_pag_seguro_boleto' ) 

) {

	echo '<a href="javascript:history.back()">'.esc_html( __('Sorry, your session has expired. Please go back and try again.', 'compra-direta-pag-seguro-boleto')).'</a>';
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
	$meta_referencia_post = sanitize_text_field($_POST['referencia_post']); 
	
$meta_anuidade_1x="";
$meta_anuidade_2x="";
$meta_anuidade_3x="";
$meta_anuidade_4x="";
$meta_anuidade_5x="";
$meta_anuidade_6x="";
$meta_anuidade_7x="";
$meta_anuidade_8x="";
$meta_anuidade_9x="";
$meta_anuidade_10x="";
$meta_anuidade_11x="";
$meta_anuidade_12x="";

	$meta_anuidade_1x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_1x' AND post_id = '$id_post' " );
	$meta_anuidade_1x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_1x' AND post_id = '$id_post' " );
	$meta_anuidade_2x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_2x' AND post_id = '$id_post' " );
	$meta_anuidade_3x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_3x' AND post_id = '$id_post' " );
	$meta_anuidade_4x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_4x' AND post_id = '$id_post' " );
	$meta_anuidade_5x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_5x' AND post_id = '$id_post' " );
	$meta_anuidade_6x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_6x' AND post_id = '$id_post' " );
	$meta_anuidade_7x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_7x' AND post_id = '$id_post' " );
	$meta_anuidade_8x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_8x' AND post_id = '$id_post' " );
	$meta_anuidade_9x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_9x' AND post_id = '$id_post' " );
	$meta_anuidade_10x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_10x' AND post_id = '$id_post' " );
	$meta_anuidade_11x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_11x' AND post_id = '$id_post' " );
	$meta_anuidade_12x=$wpdb->get_var( " SELECT meta_value FROM $wpdb->postmeta WHERE meta_key = 'cdps-anuidade_12x' AND post_id = '$id_post' " );
	?>

	<p><?php echo esc_html( __('Check the data provided and click continue.', 'compra-direta-pag-seguro-boleto')); ?></p>
	<hr>
	<?php
	$nome  = sanitize_text_field($_POST['nome']);	
	BPSD_ValidFieldNomeCliente($nome);
	$email_cliente  = sanitize_email($_POST['email']);
	BPSD_ValidFieldEmailCliente($email_cliente);
	$telefone  = sanitize_text_field($_POST['telefone']);
	BPSD_ValidFieldTelefoneCliente($telefone);
	BPSD_ValidFieldTelefoneClienteStepTwo($telefone);
	$cpf_cliente  = sanitize_text_field($_POST['cpf']);	
	BPSD_ValidCPFStepTwo($cpf_cliente);
	
	if(isset($_POST['valor'])){
	$valor = sanitize_text_field($_POST['valor']);
	}	
	BPSD_ValidFieldValor($valor);
	
	$parcelas = sanitize_text_field($_POST['parcelas']);
	BPSD_ValidFieldParcelas($parcelas);

	if(isset($_POST['vencimento'])){
	$vencimento = sanitize_text_field($_POST['vencimento']);
	}
	BPSD_ValidFieldVencimento($vencimento);
	
	if(isset($_POST['cep'])){
	$cep  = sanitize_text_field($_POST['cep']);	
	BPSD_ValidFieldLogradouroCepCliente($cep);
	}


$post_id = $wpdb->get_var( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '[pagamento-boleto-cdps]'" );
?>

<form name="form1" action="<?php echo get_page_link($post_id); ?>" method="post" >
<?php wp_nonce_field( 'nonce_compra_direta_pag_seguro_boleto', 'nonce_compra_direta_pag_seguro_boleto_form' ); ?>

<input name="id_post" type="hidden" id="id_post" value="<?php echo esc_attr($id_post); ?>">
<input name="title_post" type="hidden" id="title_post" value="<?php echo esc_attr($title_post); ?>">
  <input name="referencia_post" type="hidden" id="referencia_post" value="<?php echo esc_attr($meta_referencia_post); ?>">

<h1><?php echo $title_post ;?></h1>

<p><?php echo esc_html( __('Fill out the form below to register your', 'compra-direta-pag-seguro-boleto')); ?>&nbsp;<?php echo esc_html( __(get_option( 'CompraDiretaPagSeguroBoleto_Plugin_HTextInput' )), 'compra-direta-pag-seguro-boleto'); ?></p>

 <p><h3><?php echo esc_html( __(get_option( 'CompraDiretaPagSeguroBoleto_Plugin_HTextInput' )), 'compra-direta-pag-seguro-boleto'); ?></h3></p>

  <p>

    <?php echo esc_html( __('Amount: ', 'compra-direta-pag-seguro-boleto')); ?><br>
<input name="valor" type="text" id="valor" value="<?php echo esc_attr($valor); ?>" required readonly="true">

  </p>


<p><?php echo esc_html( __('Day for payment of the ', 'compra-direta-pag-seguro-boleto')); ?>  <?php echo esc_html( __(get_option( 'CompraDiretaPagSeguroBoleto_Plugin_HTextInput') , 'compra-direta-pag-seguro-boleto'));?>. <?php echo esc_html( __('Maximum 30 days.', 'compra-direta-pag-seguro-boleto')); ?>"<?php echo esc_html( __('Example:', 'compra-direta-pag-seguro-boleto')).' '.date("d-m-Y", strtotime("+30 days", time())); ?></p>



  <p>
 <?php echo esc_html( __('Due Date: ', 'compra-direta-pag-seguro-boleto')); ?><br>
    <input name="vencimento"  onkeypress="mascaracdpsb(this, mdata);" type="text" id="vencimento" value="<?php echo date("d-m-Y", strtotime($vencimento)); ?>"  readonly="true">

  </p>

<hr>  

   <p><h3><?php echo esc_html( __(get_option( 'CompraDiretaPagSeguroBoleto_Plugin_ITextInput' ), 'compra-direta-pag-seguro-boleto')); ?></h3></p>
   

  <p><?php echo esc_html( __('To generate a payment booklet, report the number of installments', 'compra-direta-pag-seguro-boleto')); ?></p>
  <p><?php echo esc_html( __('The first maturity will be in 30 days and the rest will mature every 30 days.', 'compra-direta-pag-seguro-boleto')); ?></p>
 
  
   <?php if($meta_anuidade_1x<>"" OR $meta_anuidade_1x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="1" <?php if ($parcelas==1) { ?> checked  
  <?php }
  else { ?>
  unchecked 
  <?php } ?> >
  <?php echo esc_html( __('1 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_1x);  ?>    
 <?php }  ?>
 
 
    <?php if($meta_anuidade_2x<>"" OR $meta_anuidade_2x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="2" <?php if ($parcelas==2) { ?> checked  
  <?php }
  else { ?>
  unchecked 
  <?php } ?> >
  <?php echo esc_html( __('2 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_2x);  ?>    
 <?php }  ?>
 
  
  
   <?php if($meta_anuidade_3x<>"" OR $meta_anuidade_3x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="3" <?php if ($parcelas==3) { ?> checked  
  <?php }
  else { ?>
  unchecked 
  <?php } ?> >
  <?php echo esc_html( __('3 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_3x);  ?>   
  <?php }  ?> 
  
  
     <?php if($meta_anuidade_4x<>"" OR $meta_anuidade_4x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="4" <?php if ($parcelas==4) { ?> checked  
  <?php }
  else { ?>
  unchecked 
  <?php } ?> >
  <?php echo esc_html( __('4 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_4x);  ?>   
  <?php }  ?> 
  
  
  
       <?php if($meta_anuidade_5x<>"" OR $meta_anuidade_5x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="5" <?php if ($parcelas==5) { ?> checked  
  <?php }
  else { ?>
  unchecked 
  <?php } ?> >
  <?php echo esc_html( __('5 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_5x);  ?>   
  <?php }  ?> 
  
  
   <?php if($meta_anuidade_6x<>"" OR $meta_anuidade_6x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="6" <?php if ($parcelas==6) { ?> checked  
  <?php }
  else { ?>
  unchecked 
  <?php } ?> >
  <?php echo esc_html( __('6 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_6x);  ?>
   <?php }  ?> 
   
   
   
      <?php if($meta_anuidade_7x<>"" OR $meta_anuidade_7x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="7" <?php if ($parcelas==7) { ?> checked  
  <?php }
  else { ?>
  unchecked 
  <?php } ?> >
  <?php echo esc_html( __('7 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_7x);  ?>
   <?php }  ?> 
   

      <?php if($meta_anuidade_8x<>"" OR $meta_anuidade_8x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="8" <?php if ($parcelas==8) { ?> checked  
  <?php }
  else { ?>
  unchecked 
  <?php } ?> >
  <?php echo esc_html( __('8 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_8x);  ?>
   <?php }  ?>    
   
   
       <?php if($meta_anuidade_9x<>"" OR $meta_anuidade_9x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="9" <?php if ($parcelas==9) { ?> checked  
  <?php }
  else { ?>
  unchecked 
  <?php } ?> >
  <?php echo esc_html( __('9 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_9x);  ?>
   <?php }  ?>  
  
  
   <?php if($meta_anuidade_10x<>"" OR $meta_anuidade_10x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="10" <?php if ($parcelas==10) { ?> checked  
  <?php }
  else { ?>
  unchecked 
  <?php } ?> >
  <?php echo esc_html( __('10 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_10x);  ?>
 <?php }  ?> 
 
 
    <?php if($meta_anuidade_11x<>"" OR $meta_anuidade_11x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="11" <?php if ($parcelas==11) { ?> checked  
  <?php }
  else { ?>
  unchecked 
  <?php } ?> >
  <?php echo esc_html( __('11 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_11x);  ?>
 <?php }  ?> 
 
 
     <?php if($meta_anuidade_12x<>"" OR $meta_anuidade_12x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="12" <?php if ($parcelas==12) { ?> checked  
  <?php }
  else { ?>
  unchecked 
  <?php } ?> >
  <?php echo esc_html( __('12 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_12x);  ?>
 <?php }  ?> 
 
 

<hr>
<p><h3><?php esc_html( __('YOUR PERSONAL DATA','compra-direta-pag-seguro-boleto')); ?></h3></p>
  <p><?php esc_html( __('Name','compra-direta-pag-seguro-boleto')); ?></p>

  <p>

    <input name="nome" type="text" id="nome" value="<?php echo esc_attr($nome); ?>"  readonly="true">

  </p>

  <p><?php echo esc_html( __('Email', 'compra-direta-pag-seguro-boleto')); ?></p>

  <p>

    <input name="email" type="text" id="email" value="<?php echo esc_attr($email_cliente); ?>"  readonly="true">

  </p>

  

 <?php include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/pages/consulta-cep.php');?>

  


  <p><?php echo esc_html( __('Cell phone', 'compra-direta-pag-seguro-boleto')); ?></p>

  <p> 

    <input name="telefone" type="text" id="telefone" onkeypress="mascaracdpsb(this, mtel);" maxlength="15" value="<?php echo esc_attr($telefone); ?>"  readonly="true">

  </p>

  <p><?php echo esc_html( __('CPF', 'compra-direta-pag-seguro-boleto')); ?></p>

  <p>

    <input name="cpf" type="text" id="cpf"  onkeypress="mascaracdpsb(this, mcpf);" maxlength="11" value="<?php echo esc_attr($cpf_cliente); ?>"  readonly="true">

  </p>



  <p><br>

  <?php

  $value1 = sanitize_text_field($_POST['value1']); 

  $value2 = sanitize_text_field($_POST['value2']); 

  $value3 = sanitize_text_field($_POST['value3']);

  ?> 

    <input name="value1" type="hidden" id="value1" value="<?php echo esc_attr($value1); ?>" size="5" maxlength="1" required readonly="true" >

    

    <input name="value2" type="hidden" id="value2" value="<?php echo esc_attr($value2); ?>" size="5" maxlength="1" required readonly="true" > 

	

	<input name="value3" type="hidden" id="value3" size="5" maxlength="2" value="<?php echo esc_attr($value3); ?>" required  readonly="true">

  </p>

  
    <p>
    <input name="privacy_policy" type="checkbox" value="SIM"  checked disabled>&nbsp;<?php echo esc_html( __('I declare that I have read and agree with the privacy policy of this website.', 'compra-direta-pag-seguro-boleto')); ?>
  </p>
  
<?php
$post_id = $wpdb->get_var( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '[politica-de-privacidade-cdps]'" );
?>

<p>
<a href="<?php echo get_page_link($post_id); ?>" target="_blank"><?php echo esc_html( __('Privacy policy.', 'compra-direta-pag-seguro-boleto')); ?></a>
</p>


  <p>

    <input type="submit" name="Submit" value="<?php echo esc_html( __('Continue', 'compra-direta-pag-seguro-boleto')); ?>"></p> 

	

  <p>

  	<input type="button" name="Button" onClick="javascript:history.back()" value="<?php echo esc_html( __('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Back&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', 'compra-direta-pag-seguro-boleto')); ?>">

  </p>

  

</form>