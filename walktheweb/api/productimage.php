<?php
	if (!defined('ABSPATH')) exit; // Exit if accessed directly
	global $WalkTheWeb;
	try {
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');
		$i = 0;
		$response = array();
		$url = "";
		if(isset($_GET['url']) && !empty($_GET['url'])) {
			$url = $_GET['url'];
		}
		if(empty($url) && isset($_GET['walktheweb_image_url']) && !empty($_GET['walktheweb_image_url'])) {
			$url = $_GET['walktheweb_image_url'];
		}
		if (!empty($url)) {
			$type = pathinfo($url, PATHINFO_EXTENSION);
			$data = file_get_contents($url);
			if (empty($data)) {
				$url = str_replace('https://', 'http://', $url);
				$data = file_get_contents($url);
			}
			$pimage = 'data:image/' . $type . ';base64,' . base64_encode($data);
			$response[$i] = array(
				'url' => $url,
				'data' => $pimage);
		}
		echo json_encode($response);
	} catch (Exception $e) {
		$WalkTheWeb->serror("wtw-api-productimage.php = ".$e->getMessage());
	}
?>