<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$logradouro = '';
$numero = '' ;
$bairro = '' ;
$cidade = '' ;
$uf = '';

$preencher_endereco_automatico = get_option( 'CompraDiretaPagSeguroBoleto_Plugin_GTextInput' );
if($preencher_endereco_automatico=="yes"){
	$clientSoap = new SoapClient( "https://apps.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente?wsdl" );
	$params = array ('cep' => $cep);
	$result = $clientSoap->consultaCEP($params);
	foreach($result as $value) {
	$logradouro = $value->end ;
	$numero = $value->complemento2 ;
	$bairro = $value->bairro ;
	$cidade = $value->cidade ;
	$uf = $value->uf;
	}
}

$logradouro = ucwords($logradouro);
if($logradouro==' '){
$logradouro = '';
}

$bairro = ucwords($bairro);
if($bairro==' '){
$bairro = '';
}

if($numero==' '){
$numero = '';
}

$cep= str_replace("_","",$cep);
$cep = str_replace("-","",$cep);
$cep = str_replace(".","",$cep);

//$cidade = BPSD_ConvertUtf8ToIso($cidade);
$cidade = ucwords($cidade);
if($logradouro==""){
$logradouro="NAO INFORMADA";
}

if($numero==""){
$numero="S/N";
}

if($bairro==""){
$bairro="NAO INFORMADO";
}

$uf = strtoupper($uf);
?> 

  <?php 

  	if(strlen($logradouro < 5 OR $logradouro > 130)){

	echo esc_html( __('Please enter the Address valid! 5 to 130 alphanumeric characters', 'compra-direta-pag-seguro-boleto')).'</a>';

	}

	; ?>

	

  <p><?php echo esc_html( __('Address', 'compra-direta-pag-seguro-boleto')); ?></p>

  <p> 

    <input name="logradouro" type="text" id="logradouro" value="<?php echo esc_attr($logradouro); ?>" maxlength="130" required>

  </p>

  

    <?php 

  	if(strlen($numero < 1 OR $numero > 10 )){

	echo esc_html( __('Please enter the Number! 1 to 10 alphanumeric characters.', 'compra-direta-pag-seguro-boleto')).'</a>';

	}

	; ?>

	

  <p><?php echo esc_html( __('Number', 'compra-direta-pag-seguro-boleto')); ?></p>

   <p> 

    <input name="numero" type="text" id="numero" maxlength="5" value="<?php echo esc_attr($numero); ?>" required>

  </p>

  

  

    <p><?php echo esc_html( __('Complement', 'compra-direta-pag-seguro-boleto')); ?></p>

   <p> 

    <input name="complemento" type="text" id="complemento" maxlength="20" value="" >

  </p>

    <?php 

  	if(strlen($bairro < 5 OR $bairro > 60 )){

	echo esc_html( __('Please enter the neighborhood! 5 to 60 alphanumeric characters.', 'compra-direta-pag-seguro-boleto')).'</a>';

	}

	; ?>  

  

      <p><?php echo esc_html( __('Neighborhood', 'compra-direta-pag-seguro-boleto')); ?></p>

   <p> 

    <input name="bairro" type="text" id="bairro" maxlength="60" value="<?php echo esc_attr($bairro); ?>" required>

  </p>

  

        <p><?php echo esc_html( __('Zip Code', 'compra-direta-pag-seguro-boleto')); ?></p>

   <p> 

    <input name="cep" type="text" id="cep" value="<?php echo esc_attr($cep); ?>" maxlength="9" required <?php if($preencher_endereco_automatico=="yes"){ ?> "readonly=true"<?php }?> >

  </p>

  

  

          <p><?php echo esc_html( __('City', 'compra-direta-pag-seguro-boleto')); ?></p>

   <p> 

    <input name="cidade" type="text" id="cidade" maxlength="60" value="<?php echo esc_attr($cidade); ?>" <?php if($preencher_endereco_automatico=="yes"){ ?> "readonly=true"<?php }?> >

  </p>

  

  

            <p><?php echo esc_html( __('State', 'compra-direta-pag-seguro-boleto')); ?></p>

   <p> 

    <input name="uf" type="text" id="uf" maxlength="2" value="<?php echo $uf; ?>" <?php if($preencher_endereco_automatico=="yes"){ ?> "readonly=true"<?php }?> >

  </p>

  

  