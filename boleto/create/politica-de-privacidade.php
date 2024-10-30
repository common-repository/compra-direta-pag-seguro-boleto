<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$meta_key = '[politica-de-privacidade-cdps]';
$post_content = '
Who we are

The address of our website is: 

What personal data we collect and why
comments

When visitors leave comments on the site, we collect the data shown in the comment form, in addition to the visitor`s IP address and browser data, to assist in the detection of spam.

An anonymized string of characters created from your email (also called a hash) can be sent to Gravatar to verify that you use the service. Gravatar`s privacy policy is available here: https://automattic.com/privacy/. After your comment is approved, your profile photo is publicly visible next to your comment.

Media

If you upload images to the site, avoid uploading images that contain embedded location data (EXIF GPS). Visitors can download these images from the website and extract their location data from them.

Contact forms
Cookies

By leaving a comment on the website, you can choose to save your name, email and website in cookies. This is for your comfort, so you won`t have to fill in your details again when you make another comment. These cookies last for a year.

If you have an account and access this website, a temporary cookie will be created to determine whether your browser accepts cookies. It does not contain any personal data and will be discarded when you close your browser.

When you access your account on the website, we also create several cookies to save your account data and your screen display choices. Login cookies are kept for two days and screen option cookies for one year. If you select "Remember me", your access will be maintained for two weeks. If you log out of your account, login cookies will be removed.

If you edit or publish an article, an additional cookie will be saved in your browser. This cookie does not include any personal data and simply indicates the post ID for the article you just edited. It expires after 1 day.

Embedded media from other sites

Articles on this site may include embedded content, such as videos, images, articles, etc. Embedded content from other sites behave in exactly the same way as if the visitor were visiting the other site.

These sites may collect data about you, use cookies, incorporate additional third-party tracking and monitor your interaction with this embedded content, including your interaction with the embedded content if you have an account and are connected to the site.

Reviews
With whom we share your data
How long do we keep your data

If you leave a comment, the comment and its metadata are retained indefinitely. We do this so that it is possible to automatically recognize and approve any subsequent comments rather than retaining them for moderation.

For users who register on our site (if any), we also store the personal information you provide in your user profile. All users can view, edit or delete their personal information at any time (it is just not possible to change their username). Site administrators can also view and edit this information.


What are your rights over your data

If you have an account on this site or if you have left comments, you can request an exported file of the personal data we keep about you, including any data you have provided to us. You can also request that we remove any personal data that we hold about you. This does not include any data that we are required to keep for administrative, legal or security purposes.

Where we send your data

Visitor comments can be marked by an automatic spam detection service.

Your contact information
Additional Information
How we protect your data
What are our data breach procedures
From which third parties do we receive data
What automated decision making or profile analysis do we do with user data
Mandatory disclosure requirements for your professional category

';


$post_meta = '[politica-de-privacidade-cdps]';
$post_title = 'Privacy policy of this site';
$post_name = 'politica-de-privacidade-cdps';
// create page

global $wpdb;

$post_id_p = $wpdb->get_var( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = $meta_key" );
if (!$post_id_p) {

$post_id = wp_insert_post(array (

'post_type' => 'page',

'post_title' =>  $post_title,

'post_name' => $post_name,

'post_content' => $post_content,

'post_status' => 'publish',

'comment_status' => 'closed',   

'ping_status' => 'closed',      

));
if ($post_id) {

add_post_meta($post_id, $post_meta, $post_name);

}

}
?>