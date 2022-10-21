<?php
	global $WalkTheWeb;
	try {
		if (!defined('ABSPATH')) exit; // Exit if accessed directly
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		$blogid = get_current_blog_id();
		$zhosturl = "";
		$zwtwkeynew = "";
		$zwtwsecretnew = "";
		$zwookey = "";
		$zwoosecret = "";
		if (!empty($_GET['hosturl']) && isset($_GET['hosturl'])) {
			$zhosturl = $_GET['hosturl'];
		}
		if (!empty($_GET['wtwkey']) && isset($_GET['wtwkey'])) {
			$zwtwkeynew = $_GET['wtwkey'];
		}
		if (!empty($_GET['wtwsecret']) && isset($_GET['wtwsecret'])) {
			$zwtwsecretnew = $_GET['wtwsecret'];
		}
		if (!empty($_GET['wookey']) && isset($_GET['wookey'])) {
			$zwookey = $_GET['wookey'];
		}
		if (!empty($_GET['woosecret']) && isset($_GET['woosecret'])) {
			$zwoosecret = $_GET['woosecret'];
		}
		global $wpdb;
		$hasaccess = false;
		$zresults = $wpdb->get_results("
			select * 
			from ".$wpdb->prefix."woocommerce_api_keys
			where consumer_key='".$zwookey."'
			limit 1;");
		foreach ($zresults as $zrow) {
			if ($zwoosecret == base64_encode($zrow->consumer_secret)) {
				$hasaccess = true;
			}
		}
		if ($hasaccess) {
			$zhostid = "";
			$zwtwkey = "";
			$zwtwsecret = "";
			$zresults = $wpdb->get_results("
				select * 
				from ".$wpdb->prefix."walktheweb_3dhosts
				where hosturl='".$zhosturl."'
				limit 1;");
			foreach ($zresults as $zrow) {
				$zhostid = $zrow->hostid;
				$zwtwkey = $zrow->wtwkey;
				$zwtwsecret = $zrow->wtwsecret;
			}
			if (!empty($zhostid) && isset($zhostid)) {
				if (!empty($zwtwkeynew) && isset($zwtwkeynew) && !empty($zwtwsecretnew) && isset($zwtwsecretnew)) {
					if (empty($zwtwkey) || !isset($zwtwkey)) {
						$wpdb->query("
							update ".$wpdb->prefix."walktheweb_3dhosts
							set wtwkey='".$zwtwkeynew."',
								wtwsecret='".$zwtwsecretnew."'
							where hostid='".$zhostid."'
							limit 1;");
					} else {
						if ($zwtwkey != $zwtwkeynew) {
							$wpdb->query("
								update ".$wpdb->prefix."walktheweb_3dhosts
								set wtwkey='".$zwtwkeynew."',
									wtwsecret='".$zwtwsecretnew."'
								where hostid='".$zhostid."'
								limit 1;");
						}
					}
				}
			}
		}
		
		
		$storename = "My 3D Store";
		$siteurlpart = "";
		$siteurl = "";
		$i = 0;
		$response = array();
		$response[$i] = array(
			'hasaccess' => $hasaccess,
			'storename' => $storename,
			'siteurlpart' => $siteurlpart,
			'siteurl' => $siteurl);
		echo json_encode($response);	
	} catch (Exception $e) {
		$WalkTheWeb->serror("wtw-api-wtwconnection.php = ".$e->getMessage());
	}
?>