<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://ws.pagseguro.uol.com.br/recurring-payment/boletos?email=".$email_loja."&token=".$token_loja,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"{  \r\n   \"periodicity\":\"monthly\",\r\n   \"reference\":\"$meta_referencia_post\",\r\n   \"firstDueDate\":\"$vencimento\",\r\n   \"numberOfPayments\":$parcelas,\r\n   \"amount\":\"$valor\",\r\n   \"description\":\"$instrucoes\",\r\n   \"instructions\":\"$instrucoes\",\r\n   \"customer\":{  \r\n      \"document\":{  \r\n         \"type\":\"CPF\",\r\n         \"value\":\"$cpf_cliente\"\r\n      },\r\n      \"name\":\"$nome\",\r\n      \"email\":\"$email_cliente\",\r\n      \"phone\":{  \r\n         \"areaCode\":\"$ddd\",\r\n         \"number\":\"$fone\"\r\n      },\r\n      \"address\": {\r\n         \"postalCode\": \"$cep\",\r\n         \"street\": \"$logradouro\",\r\n         \"number\": \"$numero\",\r\n         \"district\": \"$bairro\",\r\n         \"city\": \"$cidade\",\r\n         \"state\": \"$uf\"\r\n      }\r\n   }\r\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-type: application/json;charset=ISO-8859-1",
    "Accept: application/json;charset=ISO-8859-1"
  ),
));

$response = curl_exec($curl);

curl_close($curl);


$conta = 0;
$response = json_decode($response, true);
$response = array($response);

foreach($response as $boletos) {
		foreach($boletos as $boleto) {
		}
				foreach($boleto as $values) {
				$conta = $conta + 1;
				$code = $values['code'];
				$barcode = $values['barcode'];
				$paymentLink  = $values['paymentLink'];
				echo '<h3>'. __('Document successfully generated!', 'compra-direta-pag-seguro').'</h3>';
				echo '<a href="'.$paymentLink.'" target="_blank">'. __('Print Document', 'compra-direta-pag-seguro').'</a><br>';
echo '<a href="https://pagseguro.uol.com.br/checkout/imprimeBoleto.jhtml?resizeBooklet=n&code='.$code.'" target="_blank">'.$code.'</a><br>';

			
				echo __('You can also pay with the barcode:', 'compra-direta-pag-seguro');
				echo '<br>'.$barcode.'<br>';
				echo '<hr>';
				}
}
//print_r($response);
?>