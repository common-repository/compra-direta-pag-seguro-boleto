<?php
/*
   Plugin Name: Compra Direta Pag Seguro Boleto
   Plugin URI: http://wordpress.org/extend/plugins/compra-direta-pag-seguro-boleto/
   Version: 1.3
   Author: Clodoaldo Xavier Gomes
   Description: Venda produtos de forma bem fácil. Remeta seu cliente a um boleto do Pag Seguro UOL Direto após a compra de um produto, serviço, assinatura ou adesão. Ative o plugin e acesse <a href="plugins.php?page=CompraDiretaPagSeguroBoleto_PluginSettings">Config</a>&nbsp;|&nbsp;<a href="https://entregador.click/wordpress-works/" target="_blank">Conheça a versão Pro</a>
   License: GPLv3
   Author URI: https://profiles.wordpress.org/clodoaldoevangelista
   Text Domain: compra-direta-pag-seguro-boleto
   Domain Path: /languages
   License: GPLv3
  */

/*
    "WordPress Plugin Template" Copyright (C) 2018 Michael Simpson  (email : michael.d.simpson@gmail.com)
    This following part of this file is part of WordPress Plugin Template for WordPress.
    WordPress Plugin Template is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    WordPress Plugin Template is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Contact Form to Database Extension.
    If not, see http://www.gnu.org/licenses/gpl-3.0.html
*/
$CompraDiretaPagSeguroBoleto_minimalRequiredPhpVersion = '5.0';
define('COMPRA_DIRETA_PAG_SEGURO_BOLETO', plugin_dir_url( __FILE__ ));
define('COMPRA_DIRETA_PAG_SEGURO_BOLETO_URL', plugins_url('',__FILE__));
define('COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR', plugin_dir_path(__FILE__));
define('COMPRA_DIRETA_PAG_SEGURO_BOLETO_LANGUAGE_DIR', 'compra-direta-pag-seguro-boleto/languages');
define('COMPRA_DIRETA_PAG_SEGURO_BOLETO_SITE', site_url());

if ( ! defined( 'COMPRA_DIRETA_PAG_SEGURO_BOLETO_PLUGIN_VERSION' ) ) define( 'COMPRA_DIRETA_PAG_SEGURO_BOLETO_PLUGIN_VERSION', '1.2.3' );

if ( ! defined( 'COMPRA_DIRETA_PAG_SEGURO_BOLETO_PLUGIN_DIR_PATH' ) ) define( 'COMPRA_DIRETA_PAG_SEGURO_BOLETO_PLUGIN_DIR_PATH', plugins_url( '', __FILE__ ) );

if ( ! defined( 'COMPRA_DIRETA_PAG_SEGURO_BOLETO_PLUGIN_BASENAME' ) ) define( 'COMPRA_DIRETA_PAG_SEGURO_BOLETO_PLUGIN_BASENAME', plugin_basename( __FILE__) );

/**

 * Check the PHP version and give a useful error message if the user's version is less than the required version

 * @return boolean true if version check passed. If false, triggers an error which WP will handle, by displaying

 * an error message on the Admin page

 */

function CompraDiretaPagSeguroBoleto_noticePhpVersionWrong() {

    global $CompraDiretaPagSeguroBoleto_minimalRequiredPhpVersion;

    echo '<div class="updated fade">' .

      __('Error: plugin "Compra Direta Pag Seguro Boleto" requires a newer version of PHP to be running.',  'compra-direta-pag-seguro-boleto').

            '<br/>' . __('Minimal version of PHP required: ', 'compra-direta-pag-seguro-boleto') . '<strong>' . $CompraDiretaPagSeguroBoleto_minimalRequiredPhpVersion . '</strong>' .

            '<br/>' . __('Your server\'s PHP version: ', 'compra-direta-pag-seguro-boleto') . '<strong>' . phpversion() . '</strong>' .

         '</div>';

}





function CompraDiretaPagSeguroBoleto_PhpVersionCheck() {

    global $CompraDiretaPagSeguroBoleto_minimalRequiredPhpVersion;

    if (version_compare(phpversion(), $CompraDiretaPagSeguroBoleto_minimalRequiredPhpVersion) < 0) {

        add_action('admin_notices', 'CompraDiretaPagSeguroBoleto_noticePhpVersionWrong');

        return false;

    }

    return true;

}





/**

 * Initialize internationalization (i18n) for this plugin.

 * References:

 *      http://codex.wordpress.org/I18n_for_WordPress_Developers

 *      http://www.wdmac.com/how-to-create-a-po-language-translation#more-631

 * @return void

 */



function CompraDiretaPagSeguroBoleto_i18n_init() {

    $pluginDir = dirname(plugin_basename(__FILE__));

    load_plugin_textdomain('compra-direta-pag-seguro-boleto', false, $pluginDir . '/languages/');

}




/*
function mypo_parse_query_useronly( $wp_query ) {
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) !== false ) {
        if ( !current_user_can( 'level_10' ) ) {
            global $current_user;
            $wp_query->set( 'author', $current_user->id );
        }
    }
}

add_filter('parse_query', 'mypo_parse_query_useronly' );
*/




//////////////////////////////////

// Run initialization

/////////////////////////////////



// Initialize i18n
add_action('plugins_loaded','CompraDiretaPagSeguroBoleto_i18n_init');
// Run the version check.
// If it is successful, continue with initialization for this plugin
if (CompraDiretaPagSeguroBoleto_PhpVersionCheck()) {
    // Only load and run the init function if we know PHP version can parse it
    include_once('compra-direta-pag-seguro-boleto_init.php');
    CompraDiretaPagSeguroBoleto_init(__FILE__);
}