<?php
/*
	header('Access-Control-Allow-Origin: *');
	header('Content-type: application/json');
	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
	header('Access-Control-Request-Headers: Content-Type');
	header('Set-Cookie: cross-site-cookie=name; SameSite=Lax;');
*/
	global $WalkTheWeb;
	try {
		if (!defined('ABSPATH')) exit; // Exit if accessed directly



		$blogid = get_current_blog_id();
		$zfunction = "";
		$zhostid = "";
		$zhosturl = "";
		$zhostinstanceid = "";
		$zwtwkey = "";
		$zwtwsecret = "";
		$serror = 'API Key not found';
		if (!empty($_GET['function']) && isset($_GET['function'])) {
			$zfunction = $_GET['function'];
		}
		if (!empty($_GET['hostid']) && isset($_GET['hostid'])) {
			$zhostid = base64_decode($_GET['hostid']);
		}
		if (!empty($_GET['hosturl']) && isset($_GET['hosturl'])) {
			$zhosturl = base64_decode($_GET['hosturl']);
		}
		if (!empty($_GET['hostinstanceid']) && isset($_GET['hostinstanceid'])) {
			$zhostinstanceid = base64_decode($_GET['hostinstanceid']);
		}
		if (!empty($_GET['wtwkey']) && isset($_GET['wtwkey'])) {
			$zwtwkey = $_GET['wtwkey'];
		}
		if (!empty($_GET['wtwsecret']) && isset($_GET['wtwsecret'])) {
			$zwtwsecret = $_GET['wtwsecret'];
		}

		if(substr($zhosturl, -1) == '/') {
			$zhosturl = substr($zhosturl, 0, -1);
		}

		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');


		global $wpdb;
		switch ($zfunction) {
			case "setapikey":
				$serror = 'API Key cound not be updated';
				$zfoundhostid = '';
				$zfoundhostinstanceid = '';
				$zresults = $wpdb->get_results("
					select * 
					from ".$wpdb->prefix."walktheweb_3dhosts
					where hostid='".$zhostid."'
						and hosturl='".$zhosturl."'
					limit 1;");
				foreach ($zresults as $zrow) {
					$zfoundhostid = $zrow["hostid"];
					$zfoundhostinstanceid = $zrow["hostinstanceid"];
				}
				if ($zfoundhostid == $zhostid && !empty($zhostid) && isset($zhostid) && !empty($zwtwkey) && isset($zwtwkey) && !empty($zwtwsecret) && isset($zwtwsecret) && (empty($zfoundhostinstanceid) || !isset($zfoundhostinstanceid))) {
					$wpdb->query("
						update ".$wpdb->prefix."walktheweb_3dhosts
						set wtwkey='".$zwtwkeynew."',
							wtwsecret='".$zwtwsecretnew."',
							hostinstanceid='".$zhostinstanceid."',
							enabled=1
						where hostid='".$zhostid."'
						limit 1;");
					$serror = '';
				}
				break;
		}
		$response = array(
			'serror'=>$serror
		);
		echo json_encode($response);	
	} catch (Exception $e) {
		$WalkTheWeb->serror("wtw-api-wtwconnection.php = ".$e->getMessage());
	}
?>