<?php
include_once('CompraDiretaPagSeguroBoleto_LifeCycle.php');
ini_set("display_errors", 1);
class CompraDiretaPagSeguroBoleto_Plugin extends CompraDiretaPagSeguroBoleto_LifeCycle {
    /**
     * See: http://plugin.michael-simpson.com/?page_id=31
     * @return array of option meta data.
     */
    public function getOptionMetaData() {
        //  http://plugin.michael-simpson.com/?page_id=31
        return array(
            //'_version' => array('Installed Version'), // Leave this one commented-out. Uncomment to test upgrades.
            'ATextInput' => array( __('Your email acount Pag Seguro', 'compra-direta-pag-seguro-boleto')),
			'BTextInput' => array( __('Your Token Pag Seguro', 'compra-direta-pag-seguro-boleto')),
			'CTextInput' => array( __('Name company / Your Name', 'compra-direta-pag-seguro-boleto')),
			'DTextInput' => array( __('Environment', 'compra-direta-pag-seguro-boleto'), 'production', 'sandbox'),
			'GTextInput' => array( __('Fill in address automatically? Disable if the post office fails ...', 'compra-direta-pag-seguro-boleto'), 'yes', 'no'),
			'ETextInput' => array( __('Costs for the customer? If yes, the client will pay R$ 1.00', 'compra-direta-pag-seguro-boleto'), 'yes', 'no'),
			'HTextInput' => array( __('Initial charge type: example membership, registration, initial payment, registration fee, etc.', 'compra-direta-pag-seguro-boleto')),
			'ITextInput' => array( __('Installments refer to: monthly fees, maintenance, subscription, school fees, annuity,etc.', 'compra-direta-pag-seguro-boleto')),
        );
    }
//    protected function getOptionValueI18nString($optionValue) {
//        $i18nValue = parent::getOptionValueI18nString($optionValue);
//        return $i18nValue;
//    }
    protected function initOptions() {
        $options = $this->getOptionMetaData();
        if (!empty($options)) {
            foreach ($options as $key => $arr) {
               if (is_array($arr) && count($arr > 1)) {
                    $this->addOption($key, $arr[1]);
                }
            }
        }
    }

    public function getPluginDisplayName() {
        return 'Compra Direta Pag Seguro Boleto';
    }
    protected function getMainPluginFileName() {
        return 'compra-direta-pag-seguro-boleto.php';
    }

    /**

     * See: http://plugin.michael-simpson.com/?page_id=101
     * Called by install() to create any database tables if needed.
     * Best Practice:
     * (1) Prefix all table names with $wpdb->prefix
     * (2) make table names lower case only
     * @return void
     */

    protected function installDatabaseTablesAnPagesCompraDiretaPagSeguroBoleto() {
        //        global $wpdb;
        //        $tableName = $this->prefixTableName('mytable');
        //        $wpdb->query("CREATE TABLE IF NOT EXISTS `$tableName` (
        //            `id` INTEGER NOT NULL");
		

	include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/create/form-dados-do-boleto.php');
	include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/create/form-dados-do-boleto-confirma.php');	
	include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/create/pagamento-boleto.php');
	include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/create/politica-de-privacidade.php');
	}

    /**

     * See: http://plugin.michael-simpson.com/?page_id=101
     * Drop plugin-created tables on uninstall.
     * @return void
     */
    protected function unInstallDatabaseTablesAnPagesCompraDiretaPagSeguroBoleto() {

        //        global $wpdb;
        //        $tableName = $this->prefixTableName('mytable');
        //        $wpdb->query("DROP TABLE IF EXISTS `$tableName`");
    }

    /**
     * Perform actions when upgrading from version X to version Y
     * See: http://plugin.michael-simpson.com/?page_id=35
     * @return void
     */

public function upgrade() {
	$upgradeOk = true;
    $savedVersion = $this->getVersionSaved();
    if ($this->isVersionLessThan($savedVersion, '2.0')) {
        if ($this->isVersionLessThan($savedVersion, '1.8')) {
            if ($this->isVersionLessThan($savedVersion, '1.5')) {
                // perform version 1.5 upgrade action
				function compra_direta_pag_seguro_boleto_atualiza_fun() {
				}
            }

            // perform version 1.8 upgrade action

        }

        // perform version 2.0 upgrade action

     }


  add_action( 'init', 'compra_direta_pag_seguro_boleto_atualiza_fun' );

     // Post-upgrade, set the current version in the options

    $codeVersion = $this->getVersion();

    if ($upgradeOk && $savedVersion != $codeVersion) {

        $this->saveInstalledVersion();

    }


    }

    public function addActionsAndFilters() {
        // Add options administration page
        // http://plugin.michael-simpson.com/?page_id=47
        add_action('admin_menu', array(&$this, 'addSettingsSubMenuPage'));
		include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/create/post_type_custom.php');
		include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/create/post_type_custom_metabox.php');
        // Example adding a script & style just for the options administration page
        // http://plugin.michael-simpson.com/?page_id=47

        //        if (strpos($_SERVER['REQUEST_URI'], $this->getSettingsSlug()) !== false) {

        //            wp_enqueue_script('my-script', plugins_url('/js/my-script.js', __FILE__));

        //            wp_enqueue_style('my-style', plugins_url('/css/my-style.css', __FILE__));

        //        }


        // Add Actions & Filters

        // http://plugin.michael-simpson.com/?page_id=37


        // Adding scripts & styles to all pages

        // Examples:

        //        wp_enqueue_script('jquery');

        //        wp_enqueue_style('my-style', plugins_url('/css/my-style.css', __FILE__));

        //        wp_enqueue_script('my-script', plugins_url('/js/my-script.js', __FILE__));


        // Register short codes

        // http://plugin.michael-simpson.com/?page_id=39


		include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/shortcodes/form-dados-do-boleto.php');

		$sc = new CompraDiretaPagSeguroBoletoFormDadosDoBoleto();

		$sc->register('form-dados-do-boleto-cdps');


		include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/shortcodes/form-dados-do-boleto-confirma.php');

		$sc = new CompraDiretaPagSeguroBoletoFormDadosDoBoletoConfirma();

		$sc->register('form-dados-do-boleto-confirma-cdps');
		
		
		
		include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/shortcodes/pagamento-boleto.php');

		$sc = new CompraDiretaPagSeguroBoletoPagamentoBoleto();

		$sc->register('pagamento-boleto-cdps');
		
		
		
		include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/shortcodes/politica-de-privacidade.php');

		$sc = new CompraDiretaPagSeguroBoletoPoliticaDePrivacidade();

		$sc->register('politica-de-privacidade-cdps');
		

        // Register AJAX hooks

        // http://plugin.michael-simpson.com/?page_id=41

    }
}