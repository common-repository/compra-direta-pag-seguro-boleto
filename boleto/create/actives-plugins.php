<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 
// check for plugin using plugin name

if ( is_plugin_active( 'meta-box/meta-box.php' ) ) {
    //plugin is activated
	//echo "Plugin is activated.";
} 
else
{
	echo "<pre>Meta Box Plugin is not activated!";
	$url_install_meta_box = admin_url( $path = 'plugin-install.php?tab=plugin-information&plugin=meta-box&TB_iframe=true&width=600&height=550', 'admin' );
	
	echo '<br><a href="'.$url_install_meta_box .'" target="_blank">Install Meta Box Plugin</a></pre>';
	die();
}
?> 