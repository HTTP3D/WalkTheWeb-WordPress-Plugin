<?php
	if (!defined('ABSPATH')) exit; // Exit if accessed directly
	global $WalkTheWeb;
	try {
		$server_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST']; 
		$key = "";
		$password = "";
		$storeurl = "";
		$nonce = "";
		if(isset($_GET['k']) && !empty($_GET['k'])) {
			$key = base64_decode($_GET['k']);
		}
		if(isset($_GET['p']) && !empty($_GET['p'])) {
			$password = base64_decode($_GET['p']);
		}
		if(isset($_GET['s']) && !empty($_GET['s'])) {
			$storeurl = base64_decode($_GET['s']);
		} else {
			$storeurl = $server_url;
		}
		if(isset($_GET['nonce']) && !empty($_GET['nonce'])) {
			$nonce = $_GET['nonce'];
		}
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		$url = $storeurl."/wp-json/wc/v3/products/categories/?per_page=1&orderby=slug&consumer_key=".$key."&consumer_secret=".$password;
		$result = @file_get_contents($url);
		$result = json_decode($result);
		echo json_encode($result);
	} catch (Exception $e) {
		$WalkTheWeb->serror("wtw-api-confirmapi.php = ".$e->getMessage());
	}
?>