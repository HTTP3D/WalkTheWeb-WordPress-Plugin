<?php
	if (!defined('ABSPATH')) exit; // Exit if accessed directly
	global $WalkTheWeb;
	try {
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		$blogid = get_current_blog_id();
		$storename = "Store Name";
		$siteurlpart = "";
		$siteurl = "";
		if (is_multisite()) {
			$storename = esc_attr(get_blog_option($blogid, 'walktheweb_storename', esc_attr(get_bloginfo('name'))));
			$siteurlpart = esc_attr(get_blog_option($blogid, 'walktheweb_siteurlpart', ''));
			$siteurl = esc_attr(get_blog_option($blogid, 'walktheweb_siteurl', esc_url('https://3d.walktheweb.com')));
		} else {
			$storename = esc_attr(get_option('walktheweb_storename', esc_attr(get_bloginfo('name'))));
			$siteurlpart = esc_attr(get_option('walktheweb_siteurlpart', ''));
			$siteurl = esc_attr(get_option('walktheweb_siteurl', esc_url('https://3d.walktheweb.com')));
		}

		$i = 0;
		$response = array();
		$response[$i] = array(
			'storename' => $storename,
			'siteurlpart' => $siteurlpart,
			'siteurl' => $siteurl);
		echo json_encode($response);	
	} catch (Exception $e) {
		$WalkTheWeb->serror("wtw-api-storeinfo.php = ".$e->getMessage());
	}
?>