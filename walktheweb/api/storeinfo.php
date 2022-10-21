<?php
	if (!defined('ABSPATH')) exit; // Exit if accessed directly
	global $WalkTheWeb;
	try {
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		$blogid = get_current_blog_id();
		$storename = esc_attr(get_bloginfo('name'));
		$siteurlpart = "";
		$siteurl = esc_url('https://3d.walktheweb.com');

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