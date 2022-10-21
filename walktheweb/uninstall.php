<?php
	if (!defined('WP_UNINSTALL_PLUGIN')) exit;
	if (!defined('ABSPATH')) exit; // Exit if accessed directly

	global $wpdb;

	/* remove option settings */
	$blogid = get_current_blog_id();
	if (is_multisite()) {
		delete_blog_option($blogid, 'walktheweb_activated');
		delete_blog_option($blogid, 'walktheweb_wpinstanceid');
		delete_blog_option($blogid, 'walktheweb_wookeyname');
		delete_blog_option($blogid, 'walktheweb_enablehttpheaders');
		delete_blog_option($blogid, 'walktheweb_version');
		delete_blog_option($blogid, 'walktheweb_db_version');
	} else {
		delete_option('walktheweb_activated');
		delete_option('walktheweb_wpinstanceid');
		delete_option('walktheweb_wookeyname');
		delete_option('walktheweb_enablehttpheaders');
		delete_option('walktheweb_version');
		delete_option('walktheweb_db_version');
	}
	
	/* remove any WooCommerce Key pairs created for WalkTheWeb 3D Websites */
	$zresults = $wpdb->query("select * from {$wpdb->prefix}walktheweb_3dwebsites;");
	foreach ($zresults as $zrow) {
		$wpdb->query("delete from {$wpdb->prefix}woocommerce_api_keys where key_id=".$zrow["wookeyid"].";");
	}
	
	/* delete WalkTheWeb tables */
	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}walktheweb_3dhosts" );
	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}walktheweb_3dwebsites" );
	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}walktheweb_errorlog" );

?>