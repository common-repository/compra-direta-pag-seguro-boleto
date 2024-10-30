<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    //'ID'                    => 0,    //(int) User ID. If supplied, the user will be updated.
$userdata = array( 
    'user_pass'             => $cpf_cliente,   //(string) The plain-text user password.
    'user_login'            => $cpf_cliente,   //(string) The user's login username.
    'user_nicename'         => '',   //(string) The URL-friendly user name.
    'user_url'              => '',   //(string) The user URL.
    'user_email'            => $email_cliente,   //(string) The user email address.
    'display_name'          => '',   //(string) The user's display name. Default is the user's username.
    'nickname'              => '',   //(string) The user's nickname. Default is the user's username.
    'first_name'            => $nome,   //(string) The user's first name. For new users, will be used to build the first part of the user's display name if $display_name is not specified.
    'last_name'             => '',   //(string) The user's last name. For new users, will be used to build the second part of the user's display name if $display_name is not specified.
    'description'           => '',   //(string) The user's biographical description.
    'rich_editing'          => '',   //(string|bool) Whether to enable the rich-editor for the user. False if not empty.
    'syntax_highlighting'   => '',   //(string|bool) Whether to enable the rich code editor for the user. False if not empty.
    'comment_shortcuts'     => '',   //(string|bool) Whether to enable comment moderation keyboard shortcuts for the user. Default false.
    'admin_color'           => '',   //(string) Admin color scheme for the user. Default 'fresh'.
    'use_ssl'               => '',   //(bool) Whether the user should always access the admin over https. Default false.
    'user_registered'       => '',   //(string) Date the user registered. Format is 'Y-m-d H:i:s'.
    'show_admin_bar_front'  => '',   //(string|bool) Whether to display the Admin Bar for the user on the site's front end. Default true.
    'role'                  => 'subscriber',   //(string) User's role.
    'locale'                => '',   //(string) User's locale. Default empty.
 
);


$user_id = wp_insert_user( $userdata ) ;
 
// On success.
if ( ! is_wp_error( $user_id ) ) {
    echo esc_html( __( 'User created: ', 'compra-direta-pag-seguro-boleto')). $user_id;
}
?> 