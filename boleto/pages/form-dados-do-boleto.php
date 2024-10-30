<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $wpdb;
include( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR. 'boleto/create/actives-plugins.php' );
include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/pages/formata.php');

$post = get_post();
$title_post = apply_filters('the_title', $post->post_title); 

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

$meta_pagamento_inicial=get_post_meta(get_the_ID(),'cdps-pagamento_inicial',true);
$meta_anuidade_1x=get_post_meta(get_the_ID(),'cdps-anuidade_1x',true);
$meta_anuidade_2x=get_post_meta(get_the_ID(),'cdps-anuidade_2x',true);
$meta_anuidade_3x=get_post_meta(get_the_ID(),'cdps-anuidade_3x',true);
$meta_anuidade_4x=get_post_meta(get_the_ID(),'cdps-anuidade_4x',true);
$meta_anuidade_5x=get_post_meta(get_the_ID(),'cdps-anuidade_5x',true);
$meta_anuidade_6x=get_post_meta(get_the_ID(),'cdps-anuidade_6x',true);
$meta_anuidade_7x=get_post_meta(get_the_ID(),'cdps-anuidade_7x',true);
$meta_anuidade_8x=get_post_meta(get_the_ID(),'cdps-anuidade_8x',true);
$meta_anuidade_9x=get_post_meta(get_the_ID(),'cdps-anuidade_9x',true);
$meta_anuidade_10x=get_post_meta(get_the_ID(),'cdps-anuidade_10x',true);
$meta_anuidade_11x=get_post_meta(get_the_ID(),'cdps-anuidade_11x',true);
$meta_anuidade_12x=get_post_meta(get_the_ID(),'cdps-anuidade_12x',true);
$meta_referencia_post=get_post_meta(get_the_ID(),'cdps-referencia_post',true);

$post_id = $wpdb->get_var( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '[form-dados-do-boleto-confirma-cdps]'" );
?>
<form name="form1" action="<?php echo esc_html(get_page_link($post_id)); ?>" method="post" >
<?php wp_nonce_field( 'nonce_compra_direta_pag_seguro_boleto', 'nonce_compra_direta_pag_seguro_boleto_form' ); ?>
 <input name="id_post" type="hidden" id="id_post" value="<?php echo $post->ID; ?>">
  <input name="title_post" type="hidden" id="title_post" value="<?php echo esc_attr($title_post); ?>">
  <input name="referencia_post" type="hidden" id="referencia_post" value="<?php echo esc_attr($meta_referencia_post); ?>">


	<p><?php echo esc_html( __('Check the data provided and click continue.', 'compra-direta-pag-seguro-boleto')); ?></p>
	<hr>
	
<h1><?php echo $title_post ;?></h1>
<p><?php echo _e('Fill out the form below to register your', 'compra-direta-pag-seguro-boleto'); ?>&nbsp;<?php echo esc_html( __(get_option( 'CompraDiretaPagSeguroBoleto_Plugin_HTextInput' ), 'compra-direta-pag-seguro-boleto')); ?></p>

 <p><h3><?php echo _e(get_option( 'CompraDiretaPagSeguroBoleto_Plugin_HTextInput' ), 'compra-direta-pag-seguro-boleto'); ?></h3></p>
 



  <p>

    <?php echo esc_html( __('Amount: ', 'compra-direta-pag-seguro-boleto')); ?><br>
<input name="valor"  onkeypress="mascaracdpsb(this, mvalor);" type="text" id="valor" value="<?php echo esc_attr($meta_pagamento_inicial); ?>" readonly="true" required>

  </p>
  


<p><?php echo esc_html( __('Day for payment of the ', 'compra-direta-pag-seguro-boleto')); ?>  <?php echo esc_html( __(get_option( 'CompraDiretaPagSeguroBoleto_Plugin_HTextInput') , 'compra-direta-pag-seguro-boleto'));?>. <?php echo esc_html( __('Maximum 30 days.', 'compra-direta-pag-seguro-boleto')); ?>"<?php echo esc_html( __('Example:', 'compra-direta-pag-seguro-boleto')).' '.date("d-m-Y", strtotime("+30 days", time())); ?></p>


  <p>
 <?php echo esc_html( __('Due Date: ', 'compra-direta-pag-seguro-boleto')); ?><br>
   <input name="vencimento"  onkeypress="mascaracdpsb(this, mdata);" type="text" id="vencimento" value="<?php echo date("d-m-Y", strtotime("+3 days", time())); ?>" maxlength="10" required>

  </p>

<hr>  

    

  </p>

   <p><h3><?php echo esc_html( __(get_option( 'CompraDiretaPagSeguroBoleto_Plugin_ITextInput' ), 'compra-direta-pag-seguro-boleto')); ?></h3></p>
   

  <p><?php echo esc_html( __('To generate a payment booklet, report the number of installments', 'compra-direta-pag-seguro-boleto')); ?></p>
  <p><?php echo esc_html( __('The first maturity will be in 30 days and the rest will mature every 30 days.', 'compra-direta-pag-seguro-boleto')); ?></p>

 
 <?php if($meta_anuidade_1x<>"" OR $meta_anuidade_1x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="1" checked >
  <?php echo esc_html( __('1 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_1x);  ?>    
  </p>
 <?php }  ?> 
 
 
 
  <?php if($meta_anuidade_2x<>"" OR $meta_anuidade_2x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="2" checked >
  <?php echo esc_html( __('2 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_2x);  ?>    
  </p>
 <?php }  ?> 
 
 
   <?php if($meta_anuidade_3x<>"" OR $meta_anuidade_3x>0){  ?>
    <p><input name="parcelas" type="radio"  id="parcelas" value="3" >
  <?php echo esc_html( __('3 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_3x);  ?>    
  </p>
   <?php }  ?> 
  
     <?php if($meta_anuidade_4x<>"" OR $meta_anuidade_4x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="4" checked >
  <?php echo esc_html( __('4 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_4x);  ?>    
  </p>
 <?php }  ?> 
 
 
    <?php if($meta_anuidade_5x<>"" OR $meta_anuidade_5x>0){  ?>
  <p><input name="parcelas" type="radio"  id="parcelas" value="5" checked >
  <?php echo esc_html( __('5 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_5x);  ?>    
  </p>
 <?php }  ?> 
 
  <?php if($meta_anuidade_6x<>"" OR $meta_anuidade_6x>0){  ?> 
      <p><input name="parcelas" type="radio"  id="parcelas" value="6" >
  <?php echo esc_html( __('6 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_6x);  ?>    
  </p>
  
  
  
    <?php }  ?> 
  <?php if($meta_anuidade_7x<>"" OR $meta_anuidade_7x>0){  ?> 
      <p><input name="parcelas" type="radio"  id="parcelas" value="7" >
  <?php echo esc_html( __('7 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_7x);  ?>    
  </p>
  
      <?php }  ?> 
  <?php if($meta_anuidade_8x<>"" OR $meta_anuidade_8x>0){  ?> 
      <p><input name="parcelas" type="radio"  id="parcelas" value="8" >
  <?php echo esc_html( __('8 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_8x);  ?>    
  </p>
  
  
        <?php }  ?> 
  <?php if($meta_anuidade_9x<>"" OR $meta_anuidade_9x>0){  ?> 
      <p><input name="parcelas" type="radio"  id="parcelas" value="9" >
  <?php echo esc_html( __('9 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_9x);  ?>    
  </p>


        <?php }  ?> 
  <?php if($meta_anuidade_10x<>"" OR $meta_anuidade_10x>0){  ?> 
      <p><input name="parcelas" type="radio"  id="parcelas" value="10" >
  <?php echo esc_html( __('10 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_10x);  ?>    
  </p>
  
  <?php }  ?> 
  <?php if($meta_anuidade_11x<>"" OR $meta_anuidade_11x>0){  ?>   
        <p><input name="parcelas" type="radio"  id="parcelas" value="11" >
  <?php echo esc_html( __('11 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_11x);  ?>    
  </p>
   <?php }  ?>  
   
   
  <?php if($meta_anuidade_12x<>"" OR $meta_anuidade_12x>0){  ?>   
        <p><input name="parcelas" type="radio"  id="parcelas" value="12" >
  <?php echo esc_html( __('12 x ', 'compra-direta-pag-seguro-boleto')) ?> <?php echo esc_attr($meta_anuidade_12x);  ?>    
  </p>
   <?php }  ?>  
   

 <hr>
<p><h3><?php echo esc_html( __('YOUR PERSONAL DATA','compra-direta-pag-seguro-boleto')); ?></h3></p> 

  <p><?php echo esc_html( __('Name','compra-direta-pag-seguro-boleto')); ?></p>

  <p>

    <input name="nome" type="text" id="nome" required>

  </p>

  <p><?php echo esc_html( __('Email', 'compra-direta-pag-seguro-boleto')); ?></p>

  <p>

    <input name="email" type="text" id="email" required>

  </p>

  <p><?php echo esc_html( __('Zip Code', 'compra-direta-pag-seguro-boleto')); ?></p>

  <p> 

    <input name="cep" type="text" id="cep"  onkeypress="mascaracdpsb(this, mcep);" maxlength="8" required>

  </p>

  <p><?php echo esc_html( __('Cell phone', 'compra-direta-pag-seguro-boleto')); ?></p>

  <p> 

    <input name="telefone" type="text" id="telefone" onkeypress="mascaracdpsb(this, mtel);" maxlength="15" required>

  </p>

  <p><?php echo esc_html( __('CPF', 'compra-direta-pag-seguro-boleto')); ?></p>

  <p>

    <input name="cpf" type="text" id="cpf"  onkeypress="mascaracdpsb(this, mcpf);" maxlength="11" required>

  </p>
 
  

  <p><br>
    <?php

  $value1 = rand(1,5); 

  $value2 = rand(1,5); 

    ?>
    <?php echo esc_html( __('What is the result of the sum of the two values ​​below? ', 'compra-direta-pag-seguro-boleto')) ?>
    <br>
    <input name="value1" type="text" id="value1" value="<?php echo esc_attr($value1); ?>" size="5" maxlength="1" readonly="true" >
    + 
    <input name="value2" type="text" id="value2" value="<?php echo esc_attr($value2); ?>" size="5" maxlength="1" readonly="true" >
    = 
    <input name="value3" type="text" id="value3" value="" size="5" maxlength="2" required >
  </p>
  <p>
    <input type="checkbox" name="privacy_policy" value="checkbox" required>&nbsp;<?php echo esc_html( __('I declare that I have read and agree with the privacy policy of this website.', 'compra-direta-pag-seguro-boleto')); ?>
  </p>
  
<?php
$post_id = $wpdb->get_var( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '[politica-de-privacidade-cdps]'" );
?>

<p>
<a href="<?php echo get_page_link($post_id); ?>" target="_blank"><?php echo esc_attr(__('Privacy policy.', 'compra-direta-pag-seguro-boleto')); ?></a>
</p>

  <p>
		 <input type="submit" name="Submit" value="<?php echo esc_attr(__('Continue', 'compra-direta-pag-seguro-boleto')); ?>">
  </p>
</form>