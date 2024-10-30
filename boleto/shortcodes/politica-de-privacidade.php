<?php
include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'CompraDiretaPagSeguroBoleto_ShortCodeLoader.php');

 

class CompraDiretaPagSeguroBoletoPoliticaDePrivacidade extends CompraDiretaPagSeguroBoleto_ShortCodeLoader {

    /**

     * @param  $atts shortcode inputs

     * @return string shortcode content

     */

    public function handleShortcode($atts) {

		$content = "";	

		include( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/pages/politica-de-privacidade.php' );

		return $content;

    }

}

?>