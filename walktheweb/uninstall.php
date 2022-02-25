<?php
	if (!defined('WP_UNINSTALL_PLUGIN')) {
		die;
	}
	if (!defined('ABSPATH')) exit; // Exit if accessed directly

	$blogid = get_current_blog_id();
	if (is_multisite()) {
		delete_blog_option($blogid, 'walktheweb_wpinstanceid');
		delete_blog_option($blogid, 'walktheweb_wookeyname');
		delete_blog_option($blogid, 'walktheweb_enablehttpheaders');
		delete_blog_option($blogid, 'walktheweb_version');
		
		
/*		
		delete_blog_option($blogid, 'walktheweb_storename');
		delete_blog_option($blogid, 'walktheweb_siteurlpart');
		delete_blog_option($blogid, 'walktheweb_siteurl');
		delete_blog_option($blogid, 'walktheweb_wtwuserid');
		delete_blog_option($blogid, 'walktheweb_wtwuserid2');
		delete_blog_option($blogid, 'walktheweb_wtw3duserid');
		delete_blog_option($blogid, 'walktheweb_wtwlogin');
		delete_blog_option($blogid, 'walktheweb_wtwapikey');
		delete_blog_option($blogid, 'walktheweb_wtwapisecret');
		delete_blog_option($blogid, 'walktheweb_wpuserid');
		delete_blog_option($blogid, 'walktheweb_wwwstoreurl');
		delete_blog_option($blogid, 'walktheweb_wwwstoreip');
		delete_blog_option($blogid, 'walktheweb_wwwstorecarturl');
		delete_blog_option($blogid, 'walktheweb_wwwstoreproducturl');
		delete_blog_option($blogid, 'walktheweb_wwwstorewoocommerceapiurl');
		delete_blog_option($blogid, 'walktheweb_wplogin');
		delete_blog_option($blogid, 'walktheweb_wpemail');
		delete_blog_option($blogid, 'walktheweb_wpdisplayname');
		delete_blog_option($blogid, 'walktheweb_buildingid');
		delete_blog_option($blogid, 'walktheweb_buildingname');
		delete_blog_option($blogid, 'walktheweb_buildingsnapshotid');
		delete_blog_option($blogid, 'walktheweb_communityid');
		delete_blog_option($blogid, 'walktheweb_communityname');
		delete_blog_option($blogid, 'walktheweb_communitysnapshotid');
		delete_blog_option($blogid, 'walktheweb_woocommercekey');
		delete_blog_option($blogid, 'walktheweb_woocommercesecret');
		delete_blog_option($blogid, 'walktheweb_showstep');
		delete_blog_option($blogid, 'walktheweb_showwizard');
		delete_blog_option($blogid, 'walktheweb_mybuildingid');
		delete_blog_option($blogid, 'walktheweb_mycommunityid');
		delete_blog_option($blogid, 'walktheweb_useiframes');
*/
	} else {
		delete_option('walktheweb_wpinstanceid');
		delete_option('walktheweb_wookeyname');
		delete_option('walktheweb_enablehttpheaders');
		delete_option('walktheweb_version');

/*
		delete_option('walktheweb_storename');
		delete_option('walktheweb_siteurlpart');
		delete_option('walktheweb_siteurl');
		delete_option('walktheweb_wtwuserid');
		delete_option('walktheweb_wtwuserid2');
		delete_option('walktheweb_wtw3duserid');
		delete_option('walktheweb_wtwlogin');
		delete_option('walktheweb_wtwapikey');
		delete_option('walktheweb_wtwapisecret');
		delete_option('walktheweb_wpuserid');
		delete_option('walktheweb_wwwstoreurl');
		delete_option('walktheweb_wwwstoreip');
		delete_option('walktheweb_wwwstorecarturl');
		delete_option('walktheweb_wwwstoreproducturl');
		delete_option('walktheweb_wwwstorewoocommerceapiurl');
		delete_option('walktheweb_wplogin');
		delete_option('walktheweb_wpemail');
		delete_option('walktheweb_wpdisplayname');
		delete_option('walktheweb_buildingid');
		delete_option('walktheweb_buildingname');
		delete_option('walktheweb_buildingsnapshotid');
		delete_option('walktheweb_communityid');
		delete_option('walktheweb_communityname');
		delete_option('walktheweb_communitysnapshotid');
		delete_option('walktheweb_woocommercekey');
		delete_option('walktheweb_woocommercesecret');
		delete_option('walktheweb_showstep');
		delete_option('walktheweb_showwizard');
		delete_option('walktheweb_mybuildingid');
		delete_option('walktheweb_mycommunityid');
		delete_option('walktheweb_useiframes');
*/
	}
?>