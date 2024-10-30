<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function BPSD_ValidCPF($cpf){
  // determina um valor inicial para o digito $d1 e $d2
  // pra manter o respeito ;)
	$d1 = 0;
	$d2 = 0;
  // remove tudo que não seja número
  $cpf = preg_replace("/[^0-9]/", "", $cpf);
  // lista de cpf inválidos que serão ignorados
  $ignore_list = array(
    '00000000000',
    '01234567890',
	'12345678909',
    '11111111111',
    '22222222222',
    '33333333333',
    '44444444444',
    '44444444555',
    '66666666666',
    '77777777777',
    '88888888888',
    '99999999999'
  );
  // se o tamanho da string for dirente de 11 ou estiver
  // na lista de cpf ignorados já retorna false
  if(strlen($cpf) != 11 || in_array($cpf, $ignore_list)){
      return false;
  } else {
    // inicia o processo para achar o primeiro
    // número verificador usando os primeiros 9 dígitos
    for($i = 0; $i < 9; $i++){
      // inicialmente $d1 vale zero e é somando.
      // O loop passa por todos os 9 dígitos iniciais
      $d1 += $cpf[$i] * (10 - $i);
    }
    // acha o resto da divisão da soma acima por 11
    $r1 = $d1 % 11;
    // se $r1 maior que 1 retorna 11 menos $r1 se não
    // retona o valor zero para $d1
    $d1 = ($r1 > 1) ? (11 - $r1) : 0;
    // inicia o processo para achar o segundo
    // número verificador usando os primeiros 9 dígitos
    for($i = 0; $i < 9; $i++) {
      // inicialmente $d2 vale zero e é somando.
      // O loop passa por todos os 9 dígitos iniciais
      $d2 += $cpf[$i] * (11 - $i);
    }
    // $r2 será o resto da soma do cpf mais $d1 vezes 2
    // dividido por 11
    $r2 = ($d2 + ($d1 * 2)) % 11;
    // se $r2 mair que 1 retorna 11 menos $r2 se não
    // retorna o valor zeroa para $d2
    $d2 = ($r2 > 1) ? (11 - $r2) : 0;
    // retona true se os dois últimos dígitos do cpf
    // forem igual a concatenação de $d1 e $d2 e se não
    // deve retornar false.
    //return (substr($cpf, -2) == $d1 . $d2) ? true : false;
	return (substr($cpf, -2) == $d1 . $d2) ? 1 : 0;
	
  }
}



function BPSD_ValidCPFStepTwo($cpf_cliente){
	if(BPSD_ValidCPF($cpf_cliente)=='0'){
	echo '<a href="javascript:history.back()"><br>'.esc_html( __('Back and correct the CPF', 'compra-direta-pag-seguro-boleto')).'</a>';
	exit;
	}

}



function BPSD_FormataValorPagSeguro($string) {
$string = str_replace(",", "", $string);
$varstring1 = substr($string,0,-2);
$varstring2 = substr($string,-2);
$string = $varstring1.".".$varstring2;
return $string ;
}


function BPSD_ConvertUtf8ToIso($string) {
$string  = mb_convert_encoding($string, "UTF-8", "ISO-8859-1");
return $string ;
}

function BPSD_ConvertIsoToUtf8($string) {
$string  = mb_convert_encoding($string, "ISO-8859-1", "UTF-8");
return $string ;
}


function BPSD_ValidFieldTelefoneCliente($tel){
 //verificando se é celular
 $array_pre_numero = array ("9","8","7");
 // retirando espaços
 $tel = trim($tel);
 // seria melhor cirar uma white list.
 // tratando manualmente
 $tel = str_replace("-", "", $tel);
 $tel = str_replace("(", "", $tel);
 $tel = str_replace(")", "", $tel);
 $tel = str_replace("_", "", $tel);
 $tel = str_replace(" ", "", $tel);
//---------------------
 $tamanho = strlen($tel);
 // maior
 if($tamanho  > '10'){
  // não faz nada
  $telefone = $tel;
 }
 
 
 //igual
 if($tamanho == '10'){
  $verificando_celular = substr($tel, 2, 1);
  if(in_array($verificando_celular, $array_pre_numero)){
  $telefone.= substr($tel, 0, 2);
  $telefone.= "9"; // nono digito
  $telefone.= substr($tel, 2);
  }
  else{
   $telefone = $tel;
  }
 }

 //menor
 if($tamanho < '10'){
  // não faz nada
  $telefone = $tel;
 }
 return $telefone;
}
function BPSD_ValidFieldNomeCliente($nome){
	if(strlen($nome) < 10 OR strlen($nome) > 50 ){
	echo esc_html(__('Please enter the Name! 10 to 50 alphabetic characters.', 'compra-direta-pag-seguro-boleto')).'</a>';
	echo '<a href="javascript:history.back()"><br>'.esc_html( __('Back and correct Name', 'compra-direta-pag-seguro-boleto')).'</a>';
	exit;
	}
}

function BPSD_ValidFieldEmailCliente($email_cliente){
	if(!filter_var($email_cliente, FILTER_VALIDATE_EMAIL)){
	echo '<a href="javascript:history.back()"><br>'.esc_html( __('Back and correct Email', 'compra-direta-pag-seguro-boleto')).'</a>';
	exit;
	}
	if(strlen($email_cliente) < 10 OR strlen($email_cliente) > 60 ){
	echo '<a href="javascript:history.back()"><br>'.esc_html( __('Back and correct Email', 'compra-direta-pag-seguro-boleto')).'</a>';
	exit;
	}
}


function BPSD_ValidFieldTelefoneClienteStepTwo($telefone){
	$telefone = str_replace(" ", "", $telefone);
	if(strlen($telefone) <> 14 ){
	echo '<a href="javascript:history.back()"><br>'.esc_html( __('Back and correct Cell Phone - Example (22)44445-4444', 'compra-direta-pag-seguro-boleto')).'</a>';
	exit;
	}
}

function BPSD_ValidFieldLogradouroCliente($logradouro){
	if(strlen($logradouro) < 4 OR strlen($logradouro) > 120 ){
	echo '<a href="javascript:history.back()"><br>'.esc_html( __('Back and correct Adress. Minimum 10 and Maximum 140 char.', 'compra-direta-pag-seguro-boleto')).'</a>';
	exit;
	}
$logradouro = ucwords($logradouro);
$logradouro = substr($logradouro, 0, 120);
}

function BPSD_ValidFieldLogradouroNumeroCliente($numero){
	if(strlen($numero) < 1 OR strlen($numero) > 20 ){
	echo '<a href="javascript:history.back()"><br>'.esc_html( __('Back and correct Adress Number. Minimum 1 and Maximum 20 char.', 'compra-direta-pag-seguro-boleto')).'</a>';
	exit;

	}
$numero = ucwords($numero);
$numero = substr($numero, 0, 20);
}


function BPSD_ValidFieldLogradouroCompCliente($complemento){
	if(strlen($complemento) > 20 ){
	echo '<a href="javascript:history.back()"><br>'.esc_html( __('Back and correct Adress Complement. Maximum 20 char.', 'compra-direta-pag-seguro-boleto')).'</a>';
	exit;
	}
$complemento = ucwords($complemento);
$complemento = substr($complemento, 0, 20);
}

function BPSD_ValidFieldLogradouroBairroCliente($bairro){
	if(strlen($bairro) < 5 OR strlen($bairro) > 60 ){
	echo '<a href="javascript:history.back()"><br>'.esc_html( __('Back and correct Neighborhood! 5 to 60 alphanumeric characters.', 'compra-direta-pag-seguro-boleto')).'</a>';
	exit;
	}
$bairro = ucwords($bairro);
$bairro = substr($bairro, 0, 60);
}


function BPSD_ValidFieldLogradouroCepCliente($cep){
	$cep = str_replace(" ", "",$cep);
	$cep = str_replace("-", "",$cep);
	
	if(strlen($cep) <> 8 ){
	echo '<a href="javascript:history.back()"><br>'.esc_html( __('Back and correct Zip Code - Example 011151-000', 'compra-direta-pag-seguro-boleto')).'</a>';
	exit;
	}
}



function valid_field_cidade_bpsd($cidade){
$cidade = ucwords($cidade);
$cidade = substr($cidade, 0, 60);
}


function BPSD_ValidFieldLogradouroUfCliente($uf){
$uf = str_replace(" ", "",$uf);
$uf = strtoupper($uf);
$uf = substr($uf, 0, 2);
}

function BPSD_ValidFieldValor($valor){
	if($valor < 11 AND $valor <> 0){
	echo '<a href="javascript:history.back()"><br>'.esc_html( __('Back and correct the value. Minimum value 11,00', 'compra-direta-pag-seguro-boleto')).'</a>';
	exit;
	}
}	
	

function BPSD_ValidFieldParcelas($parcelas){
	if($parcelas < 1 OR $parcelas > 12){
	echo '<a href="javascript:history.back()"><br>'.esc_html( __('Back and correct the number of installments; minimum 1 and maximum 12', 'compra-direta-pag-seguro-boleto')).'</a>';
	exit;
	}
}	

function BPSD_ValidFieldVencimento($vencimento){
$amanha = date('Y-m-d', strtotime("+30 day")); //  + 3 day
$vencimento = date('Y-m-d', strtotime($vencimento));

if( $vencimento > $amanha) { 

	echo '<a href="javascript:history.back()"><br>'.esc_html( __('Back and correct due date (dd-mm-yyyy). Maximum 30 days.', 'compra-direta-pag-seguro-boleto')).'<br></a>';

	exit;
}
}


function BPSD_ValidFieldsSome($value1,$value2,$value3,$value4){
  if($value3<>$value4){

	echo '<a href="javascript:history.back()"><br>'.esc_html( __('The sum was wrong! Please go back and try again.', 'compra-direta-pag-seguro-boleto')).'</a><br>';

	echo $value1 .' + '. $value2 .' = ' .$value3 .'???';

	exit;

}	

	

}	

function get_error_message( $code ) {

if($code<>'0'){ $message = __( 'An error has occurred while processing your payment, please review your data and try again. Or contact us for assistance.', 'compra-direta-pag-seguro-boleto' ).'<br><br>'; }

if($code=='11013'){ $message .=  __( 'Please enter with a valid phone number with DDD. Example: (11) 44445-4444.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='11014'){ $message .=  __( 'Please enter with a valid phone number with DDD. Example: (11) 44445-4444.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53018'){ $message .=  __( 'Please enter with a valid phone number with DDD. Example: (11) 44445-4444.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53019'){ $message .=  __( 'Please enter with a valid phone number with DDD. Example: (11) 44445-4444.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53020'){ $message .=  __( 'Please enter with a valid phone number with DDD. Example: (11) 44445-4444.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53021'){ $message .=  __( 'Please enter with a valid phone number with DDD. Example: (11) 44445-4444.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='11017'){ $message .=  __( 'Please enter with a valid zip code number.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53022'){ $message .=  __( 'Please enter with a valid zip code number.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53023'){ $message .=  __( 'Please enter with a valid zip code number.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53053'){ $message .=  __( 'Please enter with a valid zip code number.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53054'){ $message .=  __( 'Please enter with a valid zip code number.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='11164'){ $message .=  __( 'Please enter with a valid CPF number.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53110'){ $message .=  __( 'No', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53111'){ $message .=  __( 'Please select a bank to make payment by bank transfer.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53045'){ $message .=  __( 'Credit card holder CPF is required.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53047'){ $message .=  __( 'Credit card holder birthdate is required.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53042'){ $message .=  __( 'Credit card holder name is required.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53049'){ $message .=  __( 'Credit card holder phone is required.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53051'){ $message .=  __( 'Credit card holder phone is required.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='11020'){ $message .=  __( 'The address complement is too long, it cannot be more than 40 characters.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53028'){ $message .=  __( 'The address complement is too long, it cannot be more than 40 characters.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53029'){ $message .=  __( '<strong>Neighborhood</strong> is a required field.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53046'){ $message .=  __( 'Credit card holder CPF invalid.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53122'){ $message .=  __( 'Invalid email domain. You must use an email @sandbox.pagseguro.com.br while you are using the PagSeguro Sandbox.', 'compra-direta-pag-seguro-boleto' ).'<br>'; }

if($code=='53081'){

$message .=  __( 'The customer email can not be the same as the PagSeguro account owner.', 'compra-direta-pag-seguro-boleto' ).'<br>';

}
echo $message;
}





function BPSD_ConvertXmlToArray($xml, $options = array()) {
    $defaults = array(
        'namespaceSeparator' => ':', // você pode querer que isso seja algo diferente de um cólon
        'attributePrefix' => '@',    // para distinguir entre os nós e os atributos com o mesmo nome
        'alwaysArray' => array(),    // array de tags que devem sempre ser array
        'autoArray' => true,         // só criar arrays para as tags que aparecem mais de uma vez
        'textContent' => '$',        // chave utilizada para o conteúdo do texto de elementos
        'autoText' => true,          // pular chave "textContent" se o nó não tem atributos ou nós filho
        'keySearch' => false,        // pesquisa opcional e substituir na tag e nomes de atributos
        'keyReplace' => false        // substituir valores por valores acima de busca
    );
    $options = array_merge($defaults, $options);
    $namespaces = $xml->getDocNamespaces();
    $namespaces[''] = null; // adiciona namespace base(vazio) 

    // Obtém os atributos de todos os namespaces
    $attributesArray = array();
    foreach ($namespaces as $prefix => $namespace) {
        foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
            // Substituir caracteres no nome do atributo
            if ($options['keySearch']) $attributeName =
                    str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
            $attributeKey = $options['attributePrefix']
                    . ($prefix ? $prefix . $options['namespaceSeparator'] : '')
                    . $attributeName;
            $attributesArray[$attributeKey] = (string)$attribute;
        }
    }

    // Obtém nós filhos de todos os namespaces
    $tagsArray = array();
    foreach ($namespaces as $prefix => $namespace) {
        foreach ($xml->children($namespace) as $childXml) {
            // Recursividade em nós filho
            $childArray = BPSD_ConvertXmlToArray($childXml, $options);
            list($childTagName, $childProperties) = each($childArray);

            // Substituir caracteres no nome da tag
            if ($options['keySearch']) $childTagName =
                    str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
            // Adiciona um prefixo namespace, se houver
            if ($prefix) $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;

            if (!isset($tagsArray[$childTagName])) {
                // Só entra com esta chave
                // Testa se as tags deste tipo deve ser sempre matrizes, não importa a contagem de elementos
                $tagsArray[$childTagName] =
                        in_array($childTagName, $options['alwaysArray']) || !$options['autoArray']
                        ? array($childProperties) : $childProperties;
            } elseif (
                is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName])
                === range(0, count($tagsArray[$childTagName]) - 1)
            ) {
                $tagsArray[$childTagName][] = $childProperties;
            } else {
                $tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
            }
        }
    }

    // Obtém o texto do nó
    $textContentArray = array();
    $plainText = trim((string)$xml);
    if ($plainText !== '') $textContentArray[$options['textContent']] = $plainText;

    $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '')
            ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;

    // Retorna o nó como array
    return array(
        $xml->getName() => $propertiesArray
    );
}
?>