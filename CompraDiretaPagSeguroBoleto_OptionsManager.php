<?php
/*
    "WordPress Plugin Template" Copyright (C) 2018 Michael Simpson  (email : michael.d.simpson@gmail.com)
    This file is part of WordPress Plugin Template for WordPress.
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
class CompraDiretaPagSeguroBoleto_OptionsManager {

    public function getOptionNamePrefix() {

        return get_class($this) . '_';

    }



    /**

     * Define your options meta data here as an array, where each element in the array

     * @return array of key=>display-name and/or key=>array(display-name, choice1, choice2, ...)

     * key: an option name for the key (this name will be given a prefix when stored in

     * the database to ensure it does not conflict with other plugin options)

     * value: can be one of two things:

     *   (1) string display name for displaying the name of the option to the user on a web page

     *   (2) array where the first element is a display name (as above) and the rest of

     *       the elements are choices of values that the user can select

     * e.g.

     * array(

     *   'item' => 'Item:',             // key => display-name

     *   'rating' => array(             // key => array ( display-name, choice1, choice2, ...)

     *       'CanDoOperationX' => array('Can do Operation X', 'Administrator', 'Editor', 'Author', 'Contributor', 'Subscriber'),

     *       'Rating:', 'Excellent', 'Good', 'Fair', 'Poor')

     */

    public function getOptionMetaData() {

        return array();

    }

    /**

     * @return array of string name of options

     */

    public function getOptionNames() {

        return array_keys($this->getOptionMetaData());

    }

    /**

     * Override this method to initialize options to default values and save to the database with add_option

     * @return void

     */

    protected function initOptions() {

    }

    /**

     * Cleanup: remove all options from the DB

     * @return void

     */

    protected function deleteSavedOptions() {

        $optionMetaData = $this->getOptionMetaData();

        if (is_array($optionMetaData)) {

            foreach ($optionMetaData as $aOptionKey => $aOptionMeta) {

                $prefixedOptionName = $this->prefix($aOptionKey); // how it is stored in DB

                delete_option($prefixedOptionName);

            }

        }

    }

    /**

     * @return string display name of the plugin to show as a name/title in HTML.

     * Just returns the class name. Override this method to return something more readable

     */

    public function getPluginDisplayName() {

        return get_class($this);

    }

    /**

     * Get the prefixed version input $name suitable for storing in WP options

     * Idempotent: if $optionName is already prefixed, it is not prefixed again, it is returned without change

     * @param  $name string option name to prefix. Defined in settings.php and set as keys of $this->optionMetaData

     * @return string

     */

    public function prefix($name) {

        $optionNamePrefix = $this->getOptionNamePrefix();

        if (strpos($name, $optionNamePrefix) === 0) { // 0 but not false

            return $name; // already prefixed

        }

        return $optionNamePrefix . $name;

    }

    /**

     * Remove the prefix from the input $name.

     * Idempotent: If no prefix found, just returns what was input.

     * @param  $name string

     * @return string $optionName without the prefix.

     */

    public function &unPrefix($name) {

        $optionNamePrefix = $this->getOptionNamePrefix();

        if (strpos($name, $optionNamePrefix) === 0) {

            return substr($name, strlen($optionNamePrefix));

        }

        return $name;

    }

    /**

     * A wrapper function delegating to WP get_option() but it prefixes the input $optionName

     * to enforce "scoping" the options in the WP options table thereby avoiding name conflicts

     * @param $optionName string defined in settings.php and set as keys of $this->optionMetaData

     * @param $default string default value to return if the option is not set

     * @return string the value from delegated call to get_option(), or optional default value

     * if option is not set.

     */

    public function getOption($optionName, $default = null) {

        $prefixedOptionName = $this->prefix($optionName); // how it is stored in DB

        $retVal = get_option($prefixedOptionName);

        if (!$retVal && $default) {

            $retVal = $default;

        }

        return $retVal;

    }

    /**

     * A wrapper function delegating to WP delete_option() but it prefixes the input $optionName

     * to enforce "scoping" the options in the WP options table thereby avoiding name conflicts

     * @param  $optionName string defined in settings.php and set as keys of $this->optionMetaData

     * @return bool from delegated call to delete_option()

     */

    public function deleteOption($optionName) {

        $prefixedOptionName = $this->prefix($optionName); // how it is stored in DB

        return delete_option($prefixedOptionName);

    }

    /**

     * A wrapper function delegating to WP add_option() but it prefixes the input $optionName

     * to enforce "scoping" the options in the WP options table thereby avoiding name conflicts

     * @param  $optionName string defined in settings.php and set as keys of $this->optionMetaData

     * @param  $value mixed the new value

     * @return null from delegated call to delete_option()

     */

    public function addOption($optionName, $value) {

        $prefixedOptionName = $this->prefix($optionName); // how it is stored in DB

        return add_option($prefixedOptionName, $value);

    }

    /**

     * A wrapper function delegating to WP add_option() but it prefixes the input $optionName

     * to enforce "scoping" the options in the WP options table thereby avoiding name conflicts

     * @param  $optionName string defined in settings.php and set as keys of $this->optionMetaData

     * @param  $value mixed the new value

     * @return null from delegated call to delete_option()

     */

    public function updateOption($optionName, $value) {

        $prefixedOptionName = $this->prefix($optionName); // how it is stored in DB

        return update_option($prefixedOptionName, $value);

    }

    /**

     * A Role Option is an option defined in getOptionMetaData() as a choice of WP standard roles, e.g.

     * 'CanDoOperationX' => array('Can do Operation X', 'Administrator', 'Editor', 'Author', 'Contributor', 'Subscriber')

     * The idea is use an option to indicate what role level a user must minimally have in order to do some operation.

     * So if a Role Option 'CanDoOperationX' is set to 'Editor' then users which role 'Editor' or above should be

     * able to do Operation X.

     * Also see: canUserDoRoleOption()

     * @param  $optionName

     * @return string role name

     */

    public function getRoleOption($optionName) {

        $roleAllowed = $this->getOption($optionName);

        if (!$roleAllowed || $roleAllowed == '') {

            $roleAllowed = 'Administrator';

        }

        return $roleAllowed;

    }

    /**

     * Given a WP role name, return a WP capability which only that role and roles above it have

     * http://codex.wordpress.org/Roles_and_Capabilities

     * @param  $roleName

     * @return string a WP capability or '' if unknown input role

     */

    protected function roleToCapability($roleName) {

        switch ($roleName) {

            case 'Super Admin':

                return 'manage_options';

            case 'Administrator':

                return 'manage_options';

            case 'Editor':

                return 'publish_pages';

            case 'Author':

                return 'publish_posts';

            case 'Contributor':

                return 'edit_posts';

            case 'Subscriber':

                return 'read';

            case 'Anyone':

                return 'read';

        }

        return '';

    }

    /**

     * @param $roleName string a standard WP role name like 'Administrator'

     * @return bool

     */

    public function isUserRoleEqualOrBetterThan($roleName) {

        if ('Anyone' == $roleName) {

            return true;

        }

        $capability = $this->roleToCapability($roleName);

        return current_user_can($capability);

    }

    /**

     * @param  $optionName string name of a Role option (see comments in getRoleOption())

     * @return bool indicates if the user has adequate permissions

     */

    public function canUserDoRoleOption($optionName) {

        $roleAllowed = $this->getRoleOption($optionName);

        if ('Anyone' == $roleAllowed) {

            return true;

        }

        return $this->isUserRoleEqualOrBetterThan($roleAllowed);

    }

    /**

     * see: http://codex.wordpress.org/Creating_Options_Pages

     * @return void

     */

    public function createSettingsMenu() {

        $pluginName = $this->getPluginDisplayName();

        //create new top-level menu

        add_menu_page($pluginName . ' Plugin Settings',

                      $pluginName,

                      'administrator',

                      get_class($this),

                      array(&$this, 'settingsPage')

        /*,plugins_url('/images/icon.png', __FILE__)*/); // if you call 'plugins_url; be sure to "require_once" it

        //call register settings function

        add_action('admin_init', array(&$this, 'registerSettings'));

    }

    public function registerSettings() {

        $settingsGroup = get_class($this) . '-settings-group';

        $optionMetaData = $this->getOptionMetaData();

        foreach ($optionMetaData as $aOptionKey => $aOptionMeta) {

            register_setting($settingsGroup, $aOptionMeta);

        }

    }

    /**

     * Creates HTML for the Administration page to set options for this plugin.

     * Override this method to create a customized page.

     * @return void

     */

    public function settingsPage() {

        if (!current_user_can('manage_options')) {

            wp_die(__('You do not have sufficient permissions to access this page.', 'compra-direta-pag-seguro-boleto'));

        }

        $optionMetaData = $this->getOptionMetaData();

        // Save Posted Options

        if ($optionMetaData != null) {

            foreach ($optionMetaData as $aOptionKey => $aOptionMeta) {

                if (isset($_POST[$aOptionKey])) {

                    $this->updateOption($aOptionKey, sanitize_text_field($_POST[$aOptionKey]));

                }

            }

        }

        // HTML for the page

        $settingsGroup = get_class($this) . '-settings-group';

        ?>

        <div class="wrap">

            <h2><?php __('System Settings', 'compra-direta-pag-seguro-boleto'); ?></h2>

            

  <table cellspacing="1" cellpadding="2">

    <tbody>

      <tr> 

        <td> 

          <?php __('System', 'compra-direta-pag-seguro-boleto'); ?>

        </td>

        <td><?php echo php_uname(); ?></td>

      </tr>

      <tr> 

        <td> 

          <?php __('PHP Version', 'compra-direta-pag-seguro-boleto'); ?>

        </td>

        <td><?php echo phpversion(); ?> 

          <?php

                if (version_compare('5.2', phpversion()) > 0) {

                    echo '&nbsp;&nbsp;&nbsp;<span style="background-color: #ffcc00;">';

                    __('(WARNING: This plugin may not work properly with versions earlier than PHP 5.2)', 'compra-direta-pag-seguro-boleto');

                    echo '</span>';

                }

                ?>

        </td>

      </tr>

      <tr> 

        <td> 

          <?php __('MySQL Version', 'compra-direta-pag-seguro-boleto'); ?>

        </td>

        <td><?php echo $this->getMySqlVersion() ?> 

          <?php

                    echo '&nbsp;&nbsp;&nbsp;<span style="background-color: #ffcc00;">';

                    if (version_compare('5.0', $this->getMySqlVersion()) > 0) {

                        __('(WARNING: This plugin may not work properly with versions earlier than MySQL 5.0)', 'compra-direta-pag-seguro-boleto');

                    }

                    echo '</span>';

                    ?>

        </td>

      </tr>

    </tbody>

  </table>

            

  <h1><?php echo $this->getPluginDisplayName(); ?> </h1>
  
  <h2><?php echo __('Settings', 'compra-direta-pag-seguro-boleto'); ?></h2>

  <p><strong> <a href="https://loja.pagseguro.uol.com.br/?cm=VB6mlRwV" target="_blank"> 

   <?php echo __('If you don`t have a Pag Seguro account, click here and create one right now. If you create an account through this link and / or purchase a Mini, I will receive a commission from Pag Seguro. Thanks.', 'compra-direta-pag-seguro-boleto'); ?> 
   
   </a></strong></p>

            <form method="post" action="">

            <?php settings_fields($settingsGroup); ?>

                <style type="text/css">

                    table.plugin-options-table {width: 100%; padding: 0;}

                    table.plugin-options-table tr:nth-child(even) {background: #f9f9f9}

                    table.plugin-options-table tr:nth-child(odd) {background: #FFF}

                    table.plugin-options-table tr:first-child {width: 35%;}

                    table.plugin-options-table td {vertical-align: middle;}

                    table.plugin-options-table td+td {width: auto}

                    table.plugin-options-table td > p {margin-top: 0; margin-bottom: 0;}

                </style>

                <table class="plugin-options-table"><tbody>

                <?php

                if ($optionMetaData != null) {

                    foreach ($optionMetaData as $aOptionKey => $aOptionMeta) {

                        $displayText = is_array($aOptionMeta) ? $aOptionMeta[0] : $aOptionMeta;

                        ?>

                            <tr valign="top">

                                <th scope="row"><p><label for="<?php echo $aOptionKey ?>"><?php echo $displayText ?></label></p></th>

                                <td>

                                <?php $this->createFormControl($aOptionKey, $aOptionMeta, $this->getOption($aOptionKey)); ?>

                                </td>

                            </tr>

                        <?php

                    }

                }

                ?>

                </tbody></table>

                <p class="submit">

                    <input type="submit" class="button-primary"

                           value="<?php _e('Save Changes','compra-direta-pag-seguro-boleto') ?>"/>

                </p>

            </form>

								<form action="" method="post">

								 <input type="hidden" name="reset_pages_bpsd" value="yes">

								

								  <table cellspacing="1" cellpadding="2">

    <tbody>

      <tr> 

        <td> 

		<p><?php _e('<h3>Reset Pages: If the new version did not work then click the Reset Pages button.</h3>','compra-direta-pag-seguro-boleto') ?></p>

		<?php _e('The pages containing the Data Form, Confirmation Form and Ticket Generation Page will be re-created. You`ll need to change the menus on your site so your customers can find them.','compra-direta-pag-seguro-boleto') ?>

                                

                                 <p class="submit">

                    <input type="submit" class="button-primary"

                           value="<?php _e('Reset Pages','compra-direta-pag-seguro-boleto') ?>"/>

                </p>

				

				</td>

      </tr>

	  

  </table>

  

            </form>

			

<?php if(isset($_POST['reset_pages_bpsd'])){

	include( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/reset/all-pages.php');

	include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/create/form-dados-do-boleto.php');

	include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/create/form-dados-do-boleto-confirma.php');	

	include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/create/pagamento-boleto.php');

	include_once( COMPRA_DIRETA_PAG_SEGURO_BOLETO_DIR .'boleto/create/politica-de-privacidade.php');

}

?>

  <table cellspacing="1" cellpadding="2">

    <tbody>

      <tr> 

        <td> <h3><?php echo __('Instructions','compra-direta-pag-seguro-boleto'); ?></h3>

		<?php 


echo __('This system does not work in sandbox ', 'compra-direta-pag-seguro-boleto').'<br>';

echo __('Go to the Wordpress Admin Panel; Plugins; Compra Direta Pag Seguro Boleto and change preferences.', 'compra-direta-pag-seguro-boleto').'<br>';

echo __('Needing a little help? I can help.', 'compra-direta-pag-seguro-boleto').'<br><br>';



echo '<a href="'.get_admin_url().'plugins.php?page=CompraDiretaPagSeguroBoleto_PluginSettings">';

echo esc_html( __( 'SETTINGS', 'compra-direta-pag-seguro-boleto' )).' </a><br><br>';
//echo __('SETTINGS', 'compra-direta-pag-seguro-boleto').' </a><br><br>';

echo esc_html( __('Make a donation over $ 3 and receive full support.', 'compra-direta-pag-seguro-boleto')).'<br>';

echo '<a href="https://entregador.click/wordpress-works/form-dados-do-boleto/">';

echo esc_html( __('Click here to help!', 'compra-direta-pag-seguro-boleto')).' </a><br><br>';

echo esc_html( __('Generates the Compra Direta Pag Seguro Boleto without typing the password. Documents in sequential order.', 'compra-direta-pag-seguro-boleto')).'<br><br><br>';

?>

          <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">

            <input type="hidden" name="cmd" value="_s-xclick">

            <input type="hidden" name="hosted_button_id" value="TZUHM63VZKJTL">

            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">

            <img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1"> 

          </form>


		  <h4><?php echo esc_html( __('Thank you very much for your donation.','compra-direta-pag-seguro-boleto')); ?></h4>


		  </td>

      </tr>

      <tr>

        <td><strong><h3><?php echo esc_html( __('Shortcode','compra-direta-pag-seguro-boleto')); ?></h3></strong></td>

      </tr>

      <tr> 

        <td>

		<?php echo esc_html( __('We`ve created three new pages for you. Check the list "Pages" and, if you 

          wish, leave it available to your customers. If you need to display the 

          form on other pages use this shortcodes.','compra-direta-pag-seguro-boleto')); ?>

		

</td>

      </tr>

      <tr> 

        <td>[form-dados-do-boleto-cdps] <?php echo esc_html( __('Copy and paste this shortcode on all product pages. Edit a page by adding the requested values.','compra-direta-pag-seguro-boleto')); ?> </td>

      </tr>

 

	        <tr> 

        <td>		<?php echo esc_html( __('My Email Address: clodoaldoevangelista@gmail.com','compra-direta-pag-seguro-boleto')); ?></td>

      </tr>

	  

  </table>		

			

        </div>

        <?php

    }

    /**

     * Helper-function outputs the correct form element (input tag, select tag) for the given item

     * @param  $aOptionKey string name of the option (un-prefixed)

     * @param  $aOptionMeta mixed meta-data for $aOptionKey (either a string display-name or an array(display-name, option1, option2, ...)

     * @param  $savedOptionValue string current value for $aOptionKey

     * @return void

     */

    protected function createFormControl($aOptionKey, $aOptionMeta, $savedOptionValue) {

        if (is_array($aOptionMeta) && count($aOptionMeta) >= 2) { // Drop-down list

            $choices = array_slice($aOptionMeta, 1);

            ?>

            <p><select name="<?php echo $aOptionKey ?>" id="<?php echo $aOptionKey ?>">

            <?php

                            foreach ($choices as $aChoice) {

                $selected = ($aChoice == $savedOptionValue) ? 'selected' : '';

                ?>

                    <option value="<?php echo $aChoice ?>" <?php echo $selected ?>><?php echo $this->getOptionValueI18nString($aChoice) ?></option>

                <?php

            }

            ?>

            </select></p>

            <?php

        }

        else { // Simple input field

            ?>

            <p><input type="text" name="<?php echo $aOptionKey ?>" id="<?php echo $aOptionKey ?>"

                      value="<?php echo esc_attr($savedOptionValue) ?>" size="50"/></p>

            <?php

        }

    }

    /**

     * Override this method and follow its format.

     * The purpose of this method is to provide i18n display strings for the values of options.

     * For example, you may create a options with values 'true' or 'false'.

     * In the options page, this will show as a drop down list with these choices.

     * But when the the language is not English, you would like to display different strings

     * for 'true' and 'false' while still keeping the value of that option that is actually saved in

     * the DB as 'true' or 'false'.

     * To do this, follow the convention of defining option values in getOptionMetaData() as canonical names

     * (what you want them to literally be, like 'true') and then add each one to the switch statement in this

     * function, returning the "__()" i18n name of that string.

     * @param  $optionValue string

     * @return string __($optionValue) if it is listed in this method, otherwise just returns $optionValue

     */

    protected function getOptionValueI18nString($optionValue) {

        switch ($optionValue) {

            case 'true':

                return __('true', 'compra-direta-pag-seguro-boleto');

            case 'false':

                return __('false', 'compra-direta-pag-seguro-boleto');

            case 'Administrator':

                return __('Administrator', 'compra-direta-pag-seguro-boleto');

            case 'Editor':

                return __('Editor', 'compra-direta-pag-seguro-boleto');

            case 'Author':

                return __('Author', 'compra-direta-pag-seguro-boleto');

            case 'Contributor':

                return __('Contributor', 'compra-direta-pag-seguro-boleto');

            case 'Subscriber':

                return __('Subscriber', 'compra-direta-pag-seguro-boleto');

            case 'Anyone':

                return __('Anyone', 'compra-direta-pag-seguro-boleto');

        }

        return $optionValue;

    }

    /**

     * Query MySQL DB for its version

     * @return string|false

     */

    protected function getMySqlVersion() {

        global $wpdb;

        $rows = $wpdb->get_results('select version() as mysqlversion');

        if (!empty($rows)) {

             return $rows[0]->mysqlversion;

        }

        return false;

    }

    /**

     * If you want to generate an email address like "no-reply@your-site.com" then

     * you can use this to get the domain name part.

     * E.g.  'no-reply@' . $this->getEmailDomain();

     * This code was stolen from the wp_mail function, where it generates a default

     * from "wordpress@your-site.com"

     * @return string domain name

     */

    public function getEmailDomain() {

        // Get the site domain and get rid of www.

        $sitename = strtolower($_SERVER['SERVER_NAME']);

        if (substr($sitename, 0, 4) == 'www.') {

            $sitename = substr($sitename, 4);

        }

        return $sitename;

    }

}