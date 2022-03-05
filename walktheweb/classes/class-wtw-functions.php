<?php
/**
 * WTW_Functions
 * @package  WTW_Functions
 */
 if (!defined('ABSPATH')) exit; // Exit if accessed directly
 
 /**
 * @class WTW_Functions.
 * @package WTW3DStore/Classes
 * @category Class
 * @author   adishno
 */
class WTW_Functions {
	/**
	 * The single instance of the class.
	 *
	 * @var WTW_Functions|null
	 */
	protected static $_instance = null;
	
	/**
	 * WTW_Functions Instance.
	 * Ensures only one instance of WTW_Functions is loaded or can be loaded.
	 * @return WTW_Functions - instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function __construct() {

	}		
	
	public function getRandomString($zlength,$zstringtype) {
		global $WalkTheWeb;
		$zrandomstring = '';
		try {
			$zcharacters = '';
			switch ($zstringtype) {
				case 2:
					$zcharacters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					break;
				case 3:
					$zcharacters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#%^&*()_+=-';
					break;
				default:
					$zcharacters = '0123456789abcdefghijklmnopqrstuvwxyz';
					break;
			}
			for ($i = 0; $i < $zlength; $i++) {
				$zrandomstring .= $zcharacters[rand(0, strlen($zcharacters) - 1)];
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-functions.php-getRandomString = ".$e->getMessage());
		}
		return $zrandomstring;
	}

	public function saveNewWebsite() {
		global $WalkTheWeb;
		$zresponse = array(
			'websiteurl'=>'',
			'storename'=>'',
			'hostname'=>'',
			'webname'=>'',
			'communityid'=>'',
			'communityname'=>'',
			'buildingid'=>'',
			'buildingname'=>''
		);
		try {
			if ($_SERVER['REQUEST_METHOD']=='POST') {
				$nonce = sanitize_key($_POST["walktheweb_nonce"]);
				if(isset($_GET['nonce']) && !empty($_GET['nonce'])) {
					$noncecheck = $_GET['nonce'];
				}
				if ($nonce == $noncecheck && !empty($noncecheck)) {
					$blogid = get_current_blog_id();
					$user = wp_get_current_user();
					$zuserid = $user->ID;

					/* get values from form */
					$zbval = sanitize_key($_POST["walktheweb_bval"]);
					$zusertoken = base64_encode(sanitize_key($_POST["walktheweb_usertoken"]));
					$zwtwuserid = base64_encode(sanitize_key($_POST["walktheweb_userid"]));
					$zwtwusertoken = base64_encode(sanitize_key($_POST["walktheweb_wtwusertoken"]));
					$zwtwemail = sanitize_text_field($_POST['walktheweb_wtwemail']);
					$zwookeyid = sanitize_key($_POST["walktheweb_wookeyid"]);
					$zhostname = sanitize_text_field($_POST['walktheweb_thosting']);
					$zstorename = sanitize_text_field($_POST['walktheweb_wtwstorename']);
					$zdomainurl = esc_url_raw($_POST["walktheweb_domainurl"]); 
					$zwebsiteurl = esc_url_raw($_POST["walktheweb_websiteurl"]);
					$zwebname = sanitize_key($_POST["walktheweb_webname"]);
					$zbuildingid = sanitize_key($_POST["walktheweb_buildingid"]);
					$zbuildingname = sanitize_text_field($_POST['walktheweb_buildingname']);
					$zcommunityid = sanitize_key($_POST["walktheweb_communityid"]);
					$zcommunityname = sanitize_text_field($_POST['walktheweb_communityname']);
					$zstoreurl = esc_url_raw($_POST["walktheweb_storeurl"]);
					$zstorecarturl = esc_url_raw($_POST["walktheweb_storecarturl"]);
					$zstoreproducturl = esc_url_raw($_POST["walktheweb_storeproducturl"]);
					$zstorewooapiurl = esc_url_raw($_POST["walktheweb_storewooapiurl"]);
					$zenablewooapi = sanitize_key($_POST["walktheweb_wookeyapienabled"]);
					$ziframes = sanitize_key($_POST["walktheweb_iframes"]);
					$zallowheaders = sanitize_key($_POST["walktheweb_headers"]);

					$zwookey = sanitize_key($_POST["walktheweb_wookey"]);
					$zwoosecret = sanitize_key($_POST["walktheweb_woosecret"]);

					/* remove ending slash */
					$zdomainurl = rtrim($zdomainurl, '/');
					global $wpdb;
					global $pagenow;
					if ($zbval == "walktheweb_createwebsite") {

						/* create new WooCommerce REST API Key */
						$zkeyname = str_replace("http://","",str_replace("https://","",strtolower($zwebsiteurl)));
						$zkeyid = $this->addWoocommerceKey($zkeyname, $zwookey, $zwoosecret);
						$zwebsiteid = $this->getRandomString(16,1);
						
						$sqlinsert = "insert into ".WTW_PREFIX."3dwebsites 
							(websiteid,
							 userid,
							 usertoken,
							 wtwuserid,
							 wtwusertoken,
							 wtwemail,
							 wookeyid,
							 hostingname,
							 storename,
							 domainurl,
							 websiteurl,
							 webname,
							 buildingid,
							 buildingname,
							 communityid,
							 communityname,
							 storeurl,
							 storecarturl,
							 storeproducturl,
							 storewooapiurl,
							 iframes,
							 createdate,
							 createwpid,
							 updatedate,
							 updatewpid)
							values
							('".$zwebsiteid."',
							 ".$zuserid.",
							 '".$zusertoken."',
							 '".$zwtwuserid."',
							 '".$zwtwusertoken."',
							 '".$zwtwemail."',
							 ".$zkeyid.",
							 '".$zhostname."',
							 '".$zstorename."',
							 '".$zdomainurl."',
							 '".$zwebsiteurl."',
							 '".$zwebname."',
							 '".$zbuildingid."',
							 '".$zbuildingname."',
							 '".$zcommunityid."',
							 '".$zcommunityname."',
							 '".$zstoreurl."',
							 '".$zstorecarturl."',
							 '".$zstoreproducturl."',
							 '".$zstorewooapiurl."',
							 ".$ziframes.",
							 now(),
							 ".$zuserid.",
							 now(),
							 ".$zuserid.");";
						$wpdb->query($sqlinsert);
						
						$zresponse = array(
							'websiteurl'=>esc_url($zwebsiteurl),
							'storename'=>esc_attr($zstorename),
							'hostname'=>esc_attr($zhostname),
							'webname'=>esc_attr($zwebname),
							'communityid'=>esc_attr($zcommunityid),
							'communityname'=>esc_attr($zcommunityname),
							'buildingid'=>esc_attr($zbuildingid),
							'buildingname'=>esc_attr($zbuildingname)
						);
						
						/* enable woo api */
						if ($zenablewooapi != 'no') {
							$zenablewooapi == 'yes';
						}
						if (is_multisite()) {
							if (get_blog_option($blogid, 'woocommerce_api_enabled') !== false) {
								update_blog_option($blogid, 'woocommerce_api_enabled', $zenablewooapi);
							} else {
								add_blog_option($blogid, 'woocommerce_api_enabled', $zenablewooapi);
							}
						} else {
							if (get_option('woocommerce_api_enabled') !== false) {
								update_option('woocommerce_api_enabled', $zenablewooapi);
							} else {
								add_option('woocommerce_api_enabled', $zenablewooapi, null, 'yes');
							}
						}
						
						/* enable headers */
						if (!isset($zallowheaders)) {
							$zallowheaders = '1';
						}
						if (is_multisite()) {
							if (get_blog_option($blogid, 'walktheweb_enablehttpheaders') !== false) {
								update_blog_option($blogid, 'walktheweb_enablehttpheaders', $zallowheaders);
							} else {
								add_blog_option($blogid, 'walktheweb_enablehttpheaders', $zallowheaders);
							}
						} else {
							if (get_option('walktheweb_enablehttpheaders') !== false) {
								update_option('walktheweb_enablehttpheaders', $zallowheaders);
							} else {
								add_option('walktheweb_enablehttpheaders', $zallowheaders, null, '1');
							}
						}
						
					}
				}
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-functions.php-saveNewWebsite = ".$e->getMessage());
		}
		return $zresponse;
	}

	protected function addWoocommerceKey($zkeyname, $zwookey, $zwoosecret) {
		global $WalkTheWeb;
		$zkeyid = -1;
		try {
			global $wpdb;

			if ( ! current_user_can( 'manage_woocommerce' ) ) {
				wp_die( -1 );
			}
			$table_prefix = $wpdb->prefix ? $wpdb->prefix : 'wp_';
			$user = wp_get_current_user();
			$zuserid = $user->ID;

			$i = 1;
			
			$zbasekeyname = $zkeyname;
			
			// check if zkeyname already exists
			$result = $wpdb->get_results ( " SELECT * 
				FROM  ".$table_prefix."woocommerce_api_keys
					WHERE description = '".$zkeyname."'" );
					
			if (isset($result) && !empty($result)) {
				// find zkeyname that does not exist
				while (isset($result) && !empty($result)) {
					$zkeyname = $zbasekeyname.'-'.$i;
					$result = $wpdb->get_results ( " SELECT * 
						FROM  ".$table_prefix."woocommerce_api_keys
							WHERE description = '".$zkeyname."'" );
					$i += 1;
				}
			}
			
			// setup new woo REST API key values - read only used for 3d store
			$keydata = array(
				'user_id'         => $zuserid,
				'description'     => $zkeyname,
				'permissions'     => 'read',
				'consumer_key'    => wc_api_hash($zwookey),
				'consumer_secret' => $zwoosecret,
				'truncated_key'   => substr($zwookey, -7 ),
			);

			// insert new woo REST api key
			if (!isset($result) || empty($result)) {
				$wpdb->insert(
					$wpdb->prefix . 'woocommerce_api_keys',
					$keydata,
					array(
						'%d',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
					)
				);
				$zkeyid = $wpdb->insert_id;
			}
			if (is_multisite()) {
				if (get_blog_option($blogid, 'walktheweb_wookeyname') !== false) {
					update_blog_option($blogid, 'walktheweb_wookeyname', $zkeyname);
				} else {
					add_blog_option($blogid, 'walktheweb_wookeyname', $zkeyname);
				}
			} else {
				if (get_option('walktheweb_wookeyname') !== false) {
					update_option('walktheweb_wookeyname', $zkeyname);
				} else {
					add_option('walktheweb_wookeyname', $zkeyname, null, 'no');
				}
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-functions.php-addWoocommerceKey = ".$e->getMessage());
		}
		return $zkeyid;
	}

	public function saveHost($zhosturl, $zhostid, $zwtwkey, $zwtwsecret) {
		global $WalkTheWeb;
		global $wpdb;
		try {
			if (current_user_can('manage_options')) {
				$user = wp_get_current_user();
				$zfoundhostid = "";
				$zresults = $wpdb->get_results("
					select hostid 
					from ".WTW_PREFIX."3dhosts
					where hosturl='".$zhosturl."'
					limit 1;");
				foreach ($zresults as $zrow) {
					$zfoundhostid = $zrow->hostid;
				}
				if ((empty($zfoundhostid) || !isset($zfoundhostid)) && !empty($zhostid)) {
					$wpdb->query("
						insert into ".WTW_PREFIX."3dhosts
							(hostid,
							 hosturl,
							 enabled,
							 wtwkey,
							 wtwsecret,
							 createdate,
							 createwpid,
							 updatedate,
							 updatewpid)
							values
							('".$zhostid."',
							 '".$zhosturl."',
							 '0',
							 '".$zwtwkey."',
							 '".$zwtwsecret."',
							 now(),
							 ".$user->get("ID").",
							 now(),
							 ".$user->get("ID").");");
				}
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-functions.php-saveHost = ".$e->getMessage());
		}
	}

	public function getHosts() {
		global $WalkTheWeb;
		global $wpdb;
		$z3dhosts = array();
		try {
			if (current_user_can('manage_options')) {
				$i = 0;
				$user = wp_get_current_user();
				$zresults = $wpdb->get_results("
					select * 
					from ".WTW_PREFIX."3dhosts
					where deleted=0;");
				foreach ($zresults as $zrow) {
					$zkey = $zrow->wtwkey;
					if (!empty($zkey) && isset($zkey)) {
						$zkey = base64_decode($zkey);
						$zkey = "...".substr($zkey, -7);
					}
					$zcreatedate = "";
					$zupdatedate = "";
					if (isset($zrow->createdate) && !empty($zrow->createdate)) {
						$zcreatedate = strtotime($zrow->createdate);
						$zcreatedate = date("m/d/Y", $zcreatedate);
					}
					if (isset($zrow->updatedate) && !empty($zrow->updatedate)) {
						$zupdatedate = strtotime($zrow->updatedate);
						$zupdatedate = date("m/d/Y", $zupdatedate);
					}
					$z3dhosts[$i] = array(
						'hostid'=> $zrow->hostid,
						'hostinstanceid'=> $zrow->hostinstanceid,
						'hosturl'=> $zrow->hosturl,
						'wtwkeytext'=> $zkey,
						'wtwkey'=> $zrow->wtwkey,
						'wtwsecret'=> $zrow->wtwsecret,
						'enabled'=> $zrow->enabled,
						'createdate'=> $zcreatedate,
						'createwpid'=> $zrow->createwpid,
						'updatedate'=> $zupdatedate,
						'updatewpid'=> $zrow->updatewpid
					);
					$i += 1;
				}
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-functions.php-getHosts = ".$e->getMessage());
		}
		return $z3dhosts;
	}

	public function getCommunities() {
		global $WalkTheWeb;
		global $wpdb;
		$z3dcommunities = array();
		try {
			if (current_user_can('manage_options')) {
				$table_prefix = $wpdb->prefix ? $wpdb->prefix : 'wp_';
				$i = 0;
				$user = wp_get_current_user();
				$zbval = sanitize_key($_POST["walktheweb_bval"]);
				$walktheweb_storeurl = get_site_url();
				if ($zbval == 'syncwebsites') {
					/* call WalkTheWeb Server(s) to sync 3D Websites list */
					$zresults = $wpdb->get_results("
						select h1.* FROM ".WTW_PREFIX."3dhosts h1
						where h1.deleted=0;");
					foreach ($zresults as $zrow) {
						$zhosturl = $zrow->hosturl;
						$zwtwkey = $zrow->wtwkey;
						$zwtwsecret = $zrow->wtwsecret;
						
						$zpostdata = stream_context_create(array('http' =>
							array(
								'method'  => 'POST',
								'header'  => 'Content-Type: application/x-www-form-urlencoded',
								'content' => http_build_query(
									array(
										'storeurl' => base64_encode($walktheweb_storeurl),
										'wtwkey' => $zwtwkey,
										'wtwsecret' => $zwtwsecret,
										'function' => 'syncwebsites'
									)
								)
							)
						));
							
						$zresults2 = file_get_contents($zhosturl.'/connect/authenticate.php', false, $zpostdata);			
						if (!empty($zresults2) && isset($zresults2)) {
							$zresults2 = json_decode($zresults2);
						}
						
						
						
						
						
						
						
					}
				}
				
				$zresults = $wpdb->get_results("
					select w1.*, k1.consumer_key FROM ".WTW_PREFIX."3dwebsites w1
						left join ".$table_prefix."woocommerce_api_keys k1
							on w1.wookeyid=k1.key_id
					where w1.deleted=0;");
				foreach ($zresults as $zrow) {
					$zkey = $zrow->consumer_key;
					if (!empty($zkey) && isset($zkey)) {
						$zkey = "...".substr($zkey, -7);
					}
					$zcreatedate = "";
					if (isset($zrow->createdate) && !empty($zrow->createdate)) {
						$zcreatedate = strtotime($zrow->createdate);
						$zcreatedate = date("m/d/Y", $zcreatedate);
					}
					$z3dcommunities[$i] = array(
						'websiteid'=> $zrow->websiteid,
						'userid'=> $zrow->userid,
						'wookeyid'=> $zrow->wookeyid,
						'wookeytext'=> $zkey,
						'hostingname'=> $zrow->hostingname,
						'storename'=> $zrow->storename,
						'domainurl'=> $zrow->domainurl,
						'websiteurl'=> $zrow->websiteurl,
						'webname'=> $zrow->webname,
						'buildingid'=> $zrow->buildingid,
						'buildingname'=> $zrow->buildingname,
						'communityid'=> $zrow->communityid,
						'communityname'=> $zrow->communityname,
						'storeurl'=> $zrow->storeurl,
						'storecarturl'=> $zrow->storecarturl,
						'storeproducturl'=> $zrow->storeproducturl,
						'storewooapiurl'=> $zrow->storewooapiurl,
						'iframes'=> $zrow->iframes,
						'createdate'=> $zcreatedate
					);
					$i += 1;
				}
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-functions.php-getCommunities = ".$e->getMessage());
		}
		return $z3dcommunities;
	}
	
	
/*

	public function getDDLWooKeyDescriptions() {
		global $WalkTheWeb;
		global $wpdb;
		$zoptions = "<option value=''>---Please Select---</option>";
		try {
			$zresults = $wpdb->get_results("
				SELECT key_id, description, truncated_key 
				FROM ".$wpdb->prefix."woocommerce_api_keys;");
			foreach ($zresults as $zrow) {
				$zoptions .= "<option value='".$zrow->key_id."'>".$zrow->description." (".$zrow->truncated_key.")</option>";
			}
		} catch (Exception $e) {
			echo "<script>console.log('wtw-classes-class-wtw-functions.php-getDDLWooKeyDescriptions".$e->getMessage()."');</script>";
		}
		return $zoptions;
	}
	
	public function saveHost($zhosturl, $zhostid) {
		global $WalkTheWeb;
		global $wpdb;
		try {
			if (current_user_can('manage_options')) {
				$user = wp_get_current_user();
				$zhostid = "";
				$zresults = $wpdb->get_results("
					select hostid 
					from ".WTW_PREFIX."3dhosts
					limit 1;");
				foreach ($zresults as $zrow) {
					$zhostid = $zrow->hostid;
				}
				if (empty($zhostid) || !isset($zhostid)) {
					$zhostid = $this->getRandomString(16,1);
					$wpdb->query("
						insert into ".WTW_PREFIX."3dhosts
							(hostid,
							 hosturl,
							 enabled,
							 createdate,
							 createwpid)
							values
							('".$zhostid."',
							 '".$zhosturl."',
							 '0',
							 now(),
							 ".$user->get("ID").");");
				}
				
				$zsiteurl = get_site_url();
//$data = array("user" => "$username", "pass" => "$password", "msisdn" => "$msisdn");
//$data_string = json_encode($data);

$ch = curl_init($zhosturl.'/connect/wtw-shopping-woocommerce.php?woostoreurl='.$zsiteurl.'&wookey='.$zwookey.'&woosecret='.$zwoosecret);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

//execute post
$result = curl_exec($ch);


//close connection
curl_close($ch);

echo "<script>console.log('test');</script>";
echo "<script>console.log('".$zhosturl.'/connect/wtw-shopping-woocommerce.php?woostoreurl='.$zsiteurl.'&wookey='.$zwookey.'&woosecret='.$zwoosecret."');</script>";
				
				
			}
		} catch (Exception $e) {
			echo "<script>console.log('wtw-classes-class-wtw-functions.php-saveHost".$e->getMessage()."');</script>";
		}
	}
	
	
*/	
	
	/**
	 * gets options for form loading.
	 */
/*	public function get_options_values() {
		global $WalkTheWeb;
		try {
			delete_expired_transients();
			$woocommerceisactive = '0';
			$blogid = get_current_blog_id();
			$wwwstoreurl = get_bloginfo('wpurl');
			$user = wp_get_current_user();
			$enablewooapi = 'no';
			$enablehttpheaders = '1';
			$posttab = '1';
			$showstep = '1';
			$storesblob = '';
			$buildingsblob = '';
			$communitiesblob = '';
			$woohelpblob = '';
			$wtwhelpblob = '';
			$siteurlpart = '';
			$buildingid = '';
			$communityid = '';
			$review = '0';
			$showwizard = '0';
			$domain = $_SERVER['HTTP_HOST'];
			try {
				$host_names = explode(".", $domain);
				if (count($host_names) > 2) {
					$domain = $host_names[count($host_names)-2].".".$host_names[count($host_names)-1];
				} else {
					$domain = $host_names[0].".".$host_names[1];
				}
			} catch (Exception $e) {
				//echo $e->getMessage();
			}	
			if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
				$woocommerceisactive = '1';
			}
			if(isset($_GET['tab']) && !empty($_GET['tab'])) {
				$showstep = $_GET['tab'];
			}
			if (get_option('woocommerce_api_enabled') != false) {
				$enablewooapi = get_option('woocommerce_api_enabled');
			}
			if (get_transient('walktheweb_buildingid') != false) {
				$buildingid = get_transient('walktheweb_buildingid');
			}
			if (get_transient('walktheweb_communityid') != false) {
				$communityid = get_transient('walktheweb_communityid');
			}
			if (get_transient('walktheweb_review') != false) {
				$review = get_transient('walktheweb_review');
			}
			if (get_transient('walktheweb_showwizard') != false) {
				$showwizard = get_transient('walktheweb_showwizard');
			}
			if (get_transient('walktheweb_3dstoresblob') != false) {
				$storesblob = get_transient('walktheweb_3dstoresblob');
			}
			if (get_transient('walktheweb_3dbuildingsblob') != false) {
				$buildingsblob = get_transient('walktheweb_3dbuildingsblob');
			}
			if (get_transient('walktheweb_3dcommunitiesblob') != false) {
				$communitiesblob = get_transient('walktheweb_3dcommunitiesblob');
			}
			if (get_transient('walktheweb_woohelpblob') != false) {
				$woohelpblob = get_transient('walktheweb_woohelpblob');
			}
			if (get_transient('walktheweb_wtwhelpblob') != false) {
				$wtwhelpblob = get_transient('walktheweb_wtwhelpblob');
			}
			if ($review != '1') {
				$review = '0';
			}
			if(!isset($showwizard) || empty($showwizard)) {
				$showwizard = '0';
			} else {
				if ($showwizard != '1') {
					$showwizard = '0';
				}
			}
			if ($showwizard == '0' && ($showstep == '3' || $showstep == '4' || $showstep == '5')) {
				$showstep = '1';
			}
			if ($showwizard == '1') {
				if ($enablewooapi == 'no') {
					if (get_option('woocommerce_api_enabled') !== false) {
						update_option('woocommerce_api_enabled', 'yes');
					} else {
						add_option('woocommerce_api_enabled', 'yes', null, 'no');
					}
				}
				$enablewooapi = 'yes';
			}
			$data = array();
			
			if (is_multisite()) {
				$storename = esc_attr(base64_decode(get_blog_option($blogid, 'walktheweb_storename', '')));
				$storenamebackup = $storename;
				$wtwlogin = get_blog_option($blogid, 'walktheweb_wtwlogin', '');
				if (!isset($storename) || empty($storename)) {
					$storename = esc_attr(get_bloginfo('name'));
				} 
				$siteurlpart = get_blog_option($blogid, 'walktheweb_siteurlpart', esc_attr($user->user_login));
				$data = array(
					'woocommerceisactive'			=> $woocommerceisactive,
					'blogid'						=> $blogid,
					'user'	 						=> $user,
					'nonce' 						=> wp_create_nonce('walktheweb_update_'.$blogid),
					'wtwuserid' 					=> get_blog_option($blogid, 'walktheweb_wtwuserid', ''),
					'wtwuserid2' 					=> get_blog_option($blogid, 'walktheweb_wtwuserid2', ''),
					'wtwlogin' 						=> esc_attr($wtwlogin),
					'wtwapikey' 					=> esc_attr(base64_decode(get_blog_option($blogid, 'walktheweb_wtwapikey', ''))),
					'wtwapisecret' 					=> get_blog_option($blogid, 'walktheweb_wtwapisecret', ''),
					'wtw3duserid' 					=> get_blog_option($blogid, 'walktheweb_wtw3duserid', ''),
					'storename' 					=> $storename,
					'storenamebackup'				=> $storenamebackup,
					'wwwstoreurl' 					=> get_blog_option($blogid, 'walktheweb_wwwstoreurl', esc_url($wwwstoreurl)),
					'wwwstorecarturl' 				=> get_blog_option($blogid, 'walktheweb_wwwstorecarturl', esc_url($wwwstoreurl."/cart/")),
					'wwwstoreproducturl' 			=> get_blog_option($blogid, 'walktheweb_wwwstoreproducturl', esc_url($wwwstoreurl."/product/")),
					'wwwstorewoocommerceapiurl' 	=> get_blog_option($blogid, 'walktheweb_wwwstorewoocommerceapiurl', esc_url($wwwstoreurl."/wp-json/wc/v2/")),
					'wpuserid' 						=> get_blog_option($blogid, 'walktheweb_wpuserid', esc_attr($user->ID)),
					'wplogin' 						=> get_blog_option($blogid, 'walktheweb_wplogin', esc_attr($user->user_login)),
					'wpemail' 						=> get_blog_option($blogid, 'walktheweb_wpemail', esc_attr($user->user_email)),
					'wpdisplayname' 				=> esc_attr(base64_decode(get_blog_option($blogid, 'walktheweb_wpdisplayname', base64_encode($user->display_name)))),
					'buildingid' 					=> $buildingid,
					'buildingname' 					=> esc_attr(base64_decode(get_blog_option($blogid, 'walktheweb_buildingname', base64_encode($user->user_login)))),
					'buildingsnapshotid' 			=> get_blog_option($blogid, 'walktheweb_buildingsnapshotid', ''),
					'communityid' 					=> $communityid,
					'communityname' 				=> esc_attr(base64_decode(get_blog_option($blogid, 'walktheweb_communityname', base64_encode($user->user_login)))),
					'communitysnapshotid' 			=> get_blog_option($blogid, 'walktheweb_communitysnapshotid', ''),
					'woocommercekeys'				=> '',
					'woocommercenewkey'				=> '0',
					'woocommercekeyname'			=> esc_attr(get_blog_option($blogid, 'walktheweb_woocommercekeyname', '')),
					'woocommercekey' 				=> esc_attr(base64_decode(get_blog_option($blogid, 'walktheweb_woocommercekey', ''))),
					'woocommercesecret' 			=> get_blog_option($blogid, 'walktheweb_woocommercesecret', ''),
					'siteurlpart' 					=> $siteurlpart,
					'siteurl' 						=> get_blog_option($blogid, 'walktheweb_siteurl', esc_url('https://3d.walktheweb.com')),
					'review' 						=> $review,
					'showstep' 						=> esc_attr($showstep),
					'showwizard' 					=> $showwizard,
					'enablewooapi'					=> $enablewooapi,
					'useiframes' 					=> get_blog_option($blogid, 'walktheweb_useiframes', '1'),
					'enablehttpheaders'				=> get_blog_option($blogid, 'walktheweb_enablehttpheaders', '1'),
					'mybuildingid' 					=> '',
					'mycommunityid' 				=> '',
					'wwwstoreip' 					=> '',
					'domain'						=> esc_attr($domain),
					'storesblob' 					=> $storesblob,
					'buildingsblob' 				=> $buildingsblob,
					'communitiesblob' 				=> $communitiesblob,
					'woohelpblob' 					=> $woohelpblob,
					'wtwhelpblob' 					=> $wtwhelpblob,
					'posttab'						=> $posttab,
					'error'							=> ''
				);
			} else {
				$storename = esc_attr(base64_decode(get_option('walktheweb_storename', '')));
				$storenamebackup = $storename;
				$wtwlogin = get_option('walktheweb_wtwlogin', '');
				if (!isset($storename) || empty($storename)) {
					$storename = esc_attr(get_bloginfo('name'));
				} 
				$siteurlpart = get_option('walktheweb_siteurlpart', esc_attr($user->user_login));
				$data = array(
					'woocommerceisactive'			=> $woocommerceisactive,
					'blogid'						=> $blogid,
					'user'	 						=> $user,
					'nonce' 						=> wp_create_nonce('walktheweb_update_'.$blogid),
					'wtwuserid' 					=> get_option('walktheweb_wtwuserid', ''),
					'wtwuserid2' 					=> get_option('walktheweb_wtwuserid2', ''),
					'wtwlogin' 						=> esc_attr($wtwlogin),
					'wtwapikey' 					=> esc_attr(base64_decode(get_option('walktheweb_wtwapikey', ''))),
					'wtwapisecret' 					=> get_option('walktheweb_wtwapisecret', ''),
					'wtw3duserid' 					=> get_option('walktheweb_wtw3duserid', ''),
					'storename' 					=> $storename,
					'storenamebackup'				=> $storenamebackup,
					'wwwstoreurl' 					=> get_option('walktheweb_wwwstoreurl', esc_url($wwwstoreurl)),
					'wwwstorecarturl' 				=> get_option('walktheweb_wwwstorecarturl', esc_url($wwwstoreurl."/cart/")),
					'wwwstoreproducturl' 			=> get_option('walktheweb_wwwstoreproducturl', esc_url($wwwstoreurl."/product/")),
					'wwwstorewoocommerceapiurl' 	=> get_option('walktheweb_wwwstorewoocommerceapiurl', esc_url($wwwstoreurl."/wp-json/wc/v2/")),
					'wpuserid' 						=> get_option('walktheweb_wpuserid', esc_attr($user->ID)),
					'wplogin' 						=> get_option('walktheweb_wplogin', esc_attr($user->user_login)),
					'wpemail' 						=> get_option('walktheweb_wpemail', esc_attr($user->user_email)),
					'wpdisplayname' 				=> esc_attr(base64_decode(get_option('walktheweb_wpdisplayname', base64_encode($user->display_name)))),
					'buildingid' 					=> $buildingid,
					'buildingname' 					=> esc_attr(base64_decode(get_option('walktheweb_buildingname', base64_encode($user->user_login)))),
					'buildingsnapshotid' 			=> get_option('walktheweb_buildingsnapshotid', ''),
					'communityid' 					=> $communityid,
					'communityname' 				=> esc_attr(base64_decode(get_option('walktheweb_communityname', base64_encode($user->user_login)))),
					'communitysnapshotid' 			=> get_option('walktheweb_communitysnapshotid', ''),
					'woocommercekeys'				=> '',
					'woocommercenewkey'				=> '0',
					'woocommercekeyname'			=> esc_attr(get_option('walktheweb_woocommercekeyname', '')),
					'woocommercekey' 				=> esc_attr(base64_decode(get_option('walktheweb_woocommercekey', ''))),
					'woocommercesecret' 			=> get_option('walktheweb_woocommercesecret', ''),
					'siteurlpart' 					=> $siteurlpart,
					'siteurl' 						=> get_option('walktheweb_siteurl', esc_url('https://3d.walktheweb.com')),
					'review' 						=> $review,
					'showstep' 						=> esc_attr($showstep),
					'showwizard' 					=> $showwizard,
					'enablewooapi'					=> $enablewooapi,
					'useiframes' 					=> get_option('walktheweb_useiframes', '1'),
					'enablehttpheaders'				=> get_option('walktheweb_enablehttpheaders', '1'),
					'mybuildingid' 					=> '',
					'mycommunityid' 				=> '',
					'wwwstoreip' 					=> '',
					'domain'						=> esc_attr($domain),
					'storesblob' 					=> $storesblob,
					'buildingsblob' 				=> $buildingsblob,
					'communitiesblob' 				=> $communitiesblob,
					'woohelpblob' 					=> $woohelpblob,
					'wtwhelpblob' 					=> $wtwhelpblob,
					'posttab'						=> $posttab,
					'error'							=> ''
				);
			}
			// check if key was revoked
			if ($showstep == '6') {
				$data = $this->check_woocommerce_key($data);
			} elseif ($showstep == '2') {
				$data = $this->get_woocommerce_keys($data);
			}
			if ($showstep == '1' || $showstep == '2' || $showstep == '8') {
				$data['showwizard'] = '0';
			}
			// set new values if WooCommerce REST api key does not exist
			if(!isset($data['woocommercekeyname']) || empty($data['woocommercekeyname']) || !isset($data['woocommercekey']) || empty($data['woocommercekey']) || !isset($data['woocommercesecret']) || empty($data['woocommercesecret'])) {
				$data['woocommercekeyname'] = 'walktheweb-'.$siteurlpart;
				$data['woocommercekey'] = 'ck_' . wc_rand_hash();
				$data['woocommercesecret'] = 'cs_' . wc_rand_hash();
				$data['woocommercenewkey'] = '1';
			}
		} catch (Exception $e) {
			$logger = wc_get_logger(); 
			$logger->error('error=class-woowtw-functions.php-get_options_values='.$e->getMessage(), array( 'source' => 'woocommerce-3d-store' ) );
		}
		return $data;
	}
*/	
	/**
	 * update options for form saving.
	 */
/*	public function update_options_values($data) {
		global $WalkTheWeb;
		try {
			if ($_SERVER['REQUEST_METHOD']=='POST') {
				$noncecheck = '';
				$blogid = get_current_blog_id();
				if(isset($_GET['nonce']) && !empty($_GET['nonce'])) {
					$noncecheck = $_GET['nonce'];
				}
				if ($_POST['walktheweb_nonce'] == $noncecheck && !empty($noncecheck)) {
					wp_cache_delete ('alloptions', 'options');
					$posttab = sanitize_text_field($_POST['walktheweb_posttab']);
					$siteurl = esc_url_raw($_POST["walktheweb_siteurl"]);
					$wtw3duserid = sanitize_user($_POST["walktheweb_wtw3duserid"], true);
					$wtwlogin = sanitize_user($_POST["walktheweb_wtwlogin"], true);
					$wtwapikey = base64_encode(sanitize_key($_POST["walktheweb_wtwapikey"]));
					$wtwapisecret = sanitize_key($_POST["walktheweb_wtwapisecret"]);
					$wpuserid = sanitize_user($_POST["walktheweb_wpuserid"]);
					$wwwstoreurl = esc_url_raw($_POST["walktheweb_wwwstoreurl"]);
					$wwwstoreip = $_SERVER['REMOTE_ADDR'];
					$wplogin = sanitize_user($_POST["walktheweb_wplogin"], true);
					$wpemail = sanitize_email($_POST["walktheweb_wpemail"]);
					$wpdisplayname = base64_encode(sanitize_text_field($_POST["walktheweb_wpdisplayname"]));
					$showstep = sanitize_key($_POST["walktheweb_showstep"]);
					$showwizard = sanitize_key($_POST["walktheweb_showwizard"]);
					$useiframes = sanitize_key($_POST["walktheweb_useiframes"]);
					$enablehttpheaders = sanitize_key($_POST["walktheweb_enablehttpheaders"]);
					if(!isset($showwizard) || empty($showwizard)) {
						$showwizard = '0';
					} else {
						if ($showwizard != '1') {
							$showwizard = '0';
						}
					}
					if (is_multisite()) {
						if (get_blog_option($blogid, 'walktheweb_siteurl') !== false) {
							update_blog_option($blogid, 'walktheweb_siteurl', $siteurl);
						} else {
							add_blog_option($blogid, 'walktheweb_siteurl', $siteurl, null, 'no');
						}
						if (get_blog_option($blogid, 'walktheweb_wtw3duserid') !== false) {
							update_blog_option($blogid, 'walktheweb_wtw3duserid', $wtw3duserid);
						} else {
							add_blog_option($blogid, 'walktheweb_wtw3duserid', $wtw3duserid, null, 'no');
						}
						if (get_blog_option($blogid, 'walktheweb_wtwlogin') !== false) {
							update_blog_option($blogid, 'walktheweb_wtwlogin', $wtwlogin);
						} else {
							add_blog_option($blogid, 'walktheweb_wtwlogin', $wtwlogin, null, 'no');
						}
						if (get_blog_option($blogid, 'walktheweb_wtwapikey') !== false) {
							update_blog_option($blogid, 'walktheweb_wtwapikey', $wtwapikey);
						} else {
							add_blog_option($blogid, 'walktheweb_wtwapikey', $wtwapikey, null, 'no');
						}
						if (get_blog_option($blogid, 'walktheweb_wtwapisecret') !== false) {
							update_blog_option($blogid, 'walktheweb_wtwapisecret', $wtwapisecret);
						} else {
							add_blog_option($blogid, 'walktheweb_wtwapisecret', $wtwapisecret, null, 'no');
						}
						if (get_blog_option($blogid, 'walktheweb_wpuserid') !== false) {
							update_blog_option($blogid, 'walktheweb_wpuserid', $wpuserid);
						} else {
							add_blog_option($blogid, 'walktheweb_wpuserid', $wpuserid, null, 'no');
						}
						if (get_blog_option($blogid, 'walktheweb_wwwstoreurl') !== false) {
							update_blog_option($blogid, 'walktheweb_wwwstoreurl', $wwwstoreurl);
						} else {
							add_blog_option($blogid, 'walktheweb_wwwstoreurl', $wwwstoreurl, null, 'no');
						}
						if (get_blog_option($blogid, 'walktheweb_wplogin') !== false) {
							update_blog_option($blogid, 'walktheweb_wplogin', $wplogin);
						} else {
							add_blog_option($blogid, 'walktheweb_wplogin', $wplogin, null, 'no');
						}
						if (get_blog_option($blogid, 'walktheweb_wpemail') !== false) {
							update_blog_option($blogid, 'walktheweb_wpemail', $wpemail);
						} else {
							add_blog_option($blogid, 'walktheweb_wpemail', $wpemail, null, 'no');
						}
						if (get_blog_option($blogid, 'walktheweb_wpdisplayname') !== false) {
							update_blog_option($blogid, 'walktheweb_wpdisplayname', $wpdisplayname);
						} else {
							add_blog_option($blogid, 'walktheweb_wpdisplayname', $wpdisplayname, null, 'no');
						}
						if (get_blog_option($blogid, 'walktheweb_useiframes') !== false) {
							update_blog_option($blogid, 'walktheweb_useiframes', $useiframes);
						} else {
							add_blog_option($blogid, 'walktheweb_useiframes', $useiframes, null, 'no');
						}
						if (get_blog_option($blogid, 'walktheweb_enablehttpheaders') !== false) {
							update_blog_option($blogid, 'walktheweb_enablehttpheaders', $enablehttpheaders);
						} else {
							add_blog_option($blogid, 'walktheweb_enablehttpheaders', $enablehttpheaders, null, 'no');
						}
					} else {
						if (get_option('walktheweb_siteurl') !== false) {
							update_option('walktheweb_siteurl', $siteurl);
						} else {
							add_option('walktheweb_siteurl', $siteurl, null, 'no');
						}
						if (get_option('walktheweb_wtw3duserid') !== false) {
							update_option('walktheweb_wtw3duserid', $wtw3duserid);
						} else {
							add_option('walktheweb_wtw3duserid', $wtw3duserid, null, 'no');
						}
						if (get_option('walktheweb_wtwlogin') !== false) {
							update_option('walktheweb_wtwlogin', $wtwlogin);
						} else {
							add_option('walktheweb_wtwlogin', $wtwlogin, null, 'no');
						}
						if (get_option('walktheweb_wtwapikey') !== false) {
							update_option('walktheweb_wtwapikey', $wtwapikey);
						} else {
							add_option('walktheweb_wtwapikey', $wtwapikey, null, 'no');
						}
						if (get_option('walktheweb_wtwapisecret') !== false) {
							update_option('walktheweb_wtwapisecret', $wtwapisecret);
						} else {
							add_option('walktheweb_wtwapisecret', $wtwapisecret, null, 'no');
						}
						if (get_option('walktheweb_wpuserid') !== false) {
							update_option('walktheweb_wpuserid', $wpuserid);
						} else {
							add_option('walktheweb_wpuserid', $wpuserid, null, 'no');
						}
						if (get_option('walktheweb_wwwstoreurl') !== false) {
							update_option('walktheweb_wwwstoreurl', $wwwstoreurl);
						} else {
							add_option('walktheweb_wwwstoreurl', $wwwstoreurl, null, 'no');
						}
						if (get_option('walktheweb_wplogin') !== false) {
							update_option('walktheweb_wplogin', $wplogin);
						} else {
							add_option('walktheweb_wplogin', $wplogin, null, 'no');
						}
						if (get_option('walktheweb_wpemail') !== false) {
							update_option('walktheweb_wpemail', $wpemail);
						} else {
							add_option('walktheweb_wpemail', $wpemail, null, 'no');
						}
						if (get_option('walktheweb_wpdisplayname') !== false) {
							update_option('walktheweb_wpdisplayname', $wpdisplayname);
						} else {
							add_option('walktheweb_wpdisplayname', $wpdisplayname, null, 'no');
						}
						if (get_option('walktheweb_useiframes') !== false) {
							update_option('walktheweb_useiframes', $useiframes);
						} else {
							add_option('walktheweb_useiframes', $useiframes, null, 'no');
						}
						if (get_option('walktheweb_enablehttpheaders') !== false) {
							update_option('walktheweb_enablehttpheaders', $enablehttpheaders);
						} else {
							add_option('walktheweb_enablehttpheaders', $enablehttpheaders, null, 'no');
						}
					}
					set_transient('walktheweb_showstep', $showstep, 300);
					set_transient('walktheweb_showwizard', $showwizard, 300);
*/
					/**
					 * save options based on form tab.
					 */
/*					switch ($posttab) {
						case '1':
							$data = $this->update_options_my_3d_stores($data, $blogid);
							break;
						case '2':
							$data = $this->update_options_edit_3d_store($data, $blogid);
							break;
						case '3':
							$data = $this->update_options_3d_building_store($data, $blogid);
							break;
						case '4':
							$data = $this->update_options_3d_community($data, $blogid);
							break;
						case '5':
							$data = $this->update_options_3d_store_settings($data, $blogid);
							break;
						case '6':
							$data = $this->update_options_permissions($data, $blogid);
							break;
						case '7':
							$data = $this->update_options_review_and_create($data, $blogid);
							break;
						case '8':
							$data = $this->update_options_help($data, $blogid);
							break;
					}
					$data['siteurl'] = esc_url($siteurl);
					$data['wtw3duserid'] = esc_attr($wtw3duserid);
					$data['wtwlogin'] = esc_attr($wtwlogin);
					$data['wtwapikey'] = esc_attr(base64_decode($wtwapikey));
					$data['wtwapisecret'] = esc_attr($wtwapisecret);
					$data['wpuserid'] = esc_attr($wpuserid);
					$data['wwwstoreurl'] = esc_url($wwwstoreurl);
					$data['wwwstoreip'] = esc_attr($wwwstoreip);
					$data['wplogin'] = esc_attr($wplogin);
					$data['wpemail'] = esc_attr($wpemail);
					$data['wpdisplayname'] = esc_attr(base64_decode($wpdisplayname));
					$data['showstep'] = esc_attr($showstep);
					$data['posttab'] = esc_attr($showstep);
					$data['showwizard'] = esc_attr($showwizard);
					$data['useiframes'] = esc_attr($useiframes);				
					$data['enablehttpheaders'] = esc_attr($enablehttpheaders);				
				}
			} else {
				$data['posttab'] = $data['showstep'];
			}
		} catch (Exception $e) {
			$logger = wc_get_logger(); 
			$logger->error('error=class-woowtw-functions.php-update_options_values='.$e->getMessage(), array( 'source' => 'woocommerce-3d-store' ) );
		}
		return $data;
	}	
*/	
	/**
	 * updates options for my 3d stores tab. Also clears the wizard step values.
	 */
/*	protected function update_options_my_3d_stores($data, $blogid) {
		global $WalkTheWeb;
		try {
			$buildingid = sanitize_key($_POST["walktheweb_buildingid"]);
			$buildingname = base64_encode(sanitize_text_field($_POST["walktheweb_buildingname"]));
			$buildingsnapshotid = sanitize_key($_POST["walktheweb_buildingsnapshotid"]);
			$communityid = sanitize_key($_POST["walktheweb_communityid"]);
			$communityname = base64_encode(sanitize_text_field($_POST["walktheweb_communityname"]));
			$communitysnapshotid = sanitize_key($_POST["walktheweb_communitysnapshotid"]);
			$storesblob = sanitize_text_field($_POST["walktheweb_3dstoresblob"]);
			if (is_multisite()) {
				if (get_blog_option($blogid, 'walktheweb_buildingname') !== false) {
					update_blog_option($blogid, 'walktheweb_buildingname', $buildingname);
				} else {
					add_blog_option($blogid, 'walktheweb_buildingname', $buildingname, null, 'no');
				}
				if (get_blog_option($blogid, 'walktheweb_buildingsnapshotid') !== false) {
					update_blog_option($blogid, 'walktheweb_buildingsnapshotid', $buildingsnapshotid);
				} else {
					add_blog_option($blogid, 'walktheweb_buildingsnapshotid', $buildingsnapshotid, null, 'no');
				}
				if (get_blog_option($blogid, 'walktheweb_communityname') !== false) {
					update_blog_option($blogid, 'walktheweb_communityname', $communityname);
				} else {
					add_blog_option($blogid, 'walktheweb_communityname', $communityname, null, 'no');
				}
				if (get_blog_option($blogid, 'walktheweb_communitysnapshotid') !== false) {
					update_blog_option($blogid, 'walktheweb_communitysnapshotid', $communitysnapshotid);
				} else {
					add_blog_option($blogid, 'walktheweb_communitysnapshotid', $communitysnapshotid, null, 'no');
				}
			} else {
				if (get_option('walktheweb_buildingname') !== false) {
					update_option('walktheweb_buildingname', $buildingname);
				} else {
					add_option('walktheweb_buildingname', $buildingname, null, 'no');
				}
				if (get_option('walktheweb_buildingsnapshotid') !== false) {
					update_option('walktheweb_buildingsnapshotid', $buildingsnapshotid);
				} else {
					add_option('walktheweb_buildingsnapshotid', $buildingsnapshotid, null, 'no');
				}
				if (get_option('walktheweb_communityname') !== false) {
					update_option('walktheweb_communityname', $communityname);
				} else {
					add_option('walktheweb_communityname', $communityname, null, 'no');
				}
				if (get_option('walktheweb_communitysnapshotid') !== false) {
					update_option('walktheweb_communitysnapshotid', $communitysnapshotid);
				} else {
					add_option('walktheweb_communitysnapshotid', $communitysnapshotid, null, 'no');
				}
			}
			set_transient('walktheweb_buildingid', $buildingid, 300);
			set_transient('walktheweb_communityid', $communityid, 300);
			set_transient('walktheweb_review', '0', 300);
			$data['review'] = '0';
			if (get_transient('walktheweb_3dstoresblob') == false) {
				set_transient('walktheweb_3dstoresblob', $storesblob, 300);
			}
			$data['buildingid'] = esc_attr($buildingid);
			$data['buildingname'] = esc_attr(base64_decode($buildingname));
			$data['buildingsnapshotid'] = esc_attr($buildingsnapshotid);		
			$data['communityid'] = esc_attr($communityid);
			$data['communityname'] = esc_attr(base64_decode($communityname));
			$data['communitysnapshotid'] = esc_attr($communitysnapshotid);
			$data['storesblob'] = esc_attr($storesblob);
		} catch (Exception $e) {
			$logger = wc_get_logger(); 
			$logger->error('error=class-woowtw-functions.php-update_options_my_3d_stores='.$e->getMessage(), array( 'source' => 'woocommerce-3d-store' ) );
		}
		return $data;
	}
*/
	/**
	 * updates options for edit 3d store tab. The data form this tab is stored on walktheweb.com and retrieved/updated with JSON calls.
	 */
/*	protected function update_options_edit_3d_store($data, $blogid) {
		global $WalkTheWeb;
		try {
			set_transient('walktheweb_review', '0', 300);
			$data['review'] = '0';
		} catch (Exception $e) {
			$logger = wc_get_logger(); 
			$logger->error('error=class-woowtw-functions.php-update_options_edit_3d_store='.$e->getMessage(), array( 'source' => 'woocommerce-3d-store' ) );
		}
		return $data;
	}
*/
	/**
	 * updates options for 3d building store tab.
	 */
/*	protected function update_options_3d_building_store($data, $blogid) {
		global $WalkTheWeb;
		try {
			$buildingid = sanitize_key($_POST["walktheweb_buildingid"]);
			$buildingname = base64_encode(sanitize_text_field($_POST["walktheweb_buildingname"]));
			$buildingsnapshotid = sanitize_key($_POST["walktheweb_buildingsnapshotid"]);
			$buildingsblob = sanitize_text_field($_POST["walktheweb_3dbuildingsblob"]);
			if (is_multisite()) {
				if (get_blog_option($blogid, 'walktheweb_buildingname') !== false) {
					update_blog_option($blogid, 'walktheweb_buildingname', $buildingname);
				} else {
					add_blog_option($blogid, 'walktheweb_buildingname', $buildingname, null, 'no');
				}
				if (get_blog_option($blogid, 'walktheweb_buildingsnapshotid') !== false) {
					update_blog_option($blogid, 'walktheweb_buildingsnapshotid', $buildingsnapshotid);
				} else {
					add_blog_option($blogid, 'walktheweb_buildingsnapshotid', $buildingsnapshotid, null, 'no');
				}
			} else {
				if (get_option('walktheweb_buildingname') !== false) {
					update_option('walktheweb_buildingname', $buildingname);
				} else {
					add_option('walktheweb_buildingname', $buildingname, null, 'no');
				}
				if (get_option('walktheweb_buildingsnapshotid') !== false) {
					update_option('walktheweb_buildingsnapshotid', $buildingsnapshotid);
				} else {
					add_option('walktheweb_buildingsnapshotid', $buildingsnapshotid, null, 'no');
				}
			}
			set_transient('walktheweb_buildingid', $buildingid, 300);
			if (get_transient('walktheweb_3dbuildingsblob') == false) {
				set_transient('walktheweb_3dbuildingsblob', $buildingsblob, 300);
			}
			$data['buildingid'] = esc_attr($buildingid);
			$data['buildingname'] = esc_attr(base64_decode($buildingname));
			$data['buildingsnapshotid'] = esc_attr($buildingsnapshotid);		
			$data['buildingsblob'] = esc_attr($buildingsblob);				
		} catch (Exception $e) {
			$logger = wc_get_logger(); 
			$logger->error('error=class-woowtw-functions.php-update_options_3d_building_store='.$e->getMessage(), array( 'source' => 'woocommerce-3d-store' ) );
		}
		return $data;
	}
*/
	/**
	 * updates options for 3d community tab.
	 */
/*	protected function update_options_3d_community($data, $blogid) {
		global $WalkTheWeb;
		try {
			$communityid = sanitize_key($_POST["walktheweb_communityid"]);
			$communityname = base64_encode(sanitize_text_field($_POST["walktheweb_communityname"]));
			$communitysnapshotid = sanitize_key($_POST["walktheweb_communitysnapshotid"]);
			$communitiesblob = sanitize_text_field($_POST["walktheweb_3dcommunitiesblob"]);
			if (is_multisite()) {
				if (get_blog_option($blogid, 'walktheweb_communityname') !== false) {
					update_blog_option($blogid, 'walktheweb_communityname', $communityname);
				} else {
					add_blog_option($blogid, 'walktheweb_communityname', $communityname, null, 'no');
				}
				if (get_blog_option($blogid, 'walktheweb_communitysnapshotid') !== false) {
					update_blog_option($blogid, 'walktheweb_communitysnapshotid', $communitysnapshotid);
				} else {
					add_blog_option($blogid, 'walktheweb_communitysnapshotid', $communitysnapshotid, null, 'no');
				}
			} else {
				if (get_option('walktheweb_communityname') !== false) {
					update_option('walktheweb_communityname', $communityname);
				} else {
					add_option('walktheweb_communityname', $communityname, null, 'no');
				}
				if (get_option('walktheweb_communitysnapshotid') !== false) {
					update_option('walktheweb_communitysnapshotid', $communitysnapshotid);
				} else {
					add_option('walktheweb_communitysnapshotid', $communitysnapshotid, null, 'no');
				}
			}
			set_transient('walktheweb_communityid', $communityid, 300);
			if (get_transient('walktheweb_3dcommunitiesblob') == false) {
				set_transient('walktheweb_3dcommunitiesblob', $communitiesblob, 300);
			}
			$data['communityid'] = esc_attr($communityid);
			$data['communityname'] = esc_attr(base64_decode($communityname));
			$data['communitysnapshotid'] = esc_attr($communitysnapshotid);
			$data['communitiesblob'] = esc_attr($communitiesblob);				
		} catch (Exception $e) {
			$logger = wc_get_logger(); 
			$logger->error('error=class-woowtw-functions.php-update_options_3d_community='.$e->getMessage(), array( 'source' => 'woocommerce-3d-store' ) );
		}
		return $data;
	}
*/
	/**
	 * updates options for 3d store settings tab.
	 */
/*	protected function update_options_3d_store_settings($data, $blogid) {
		global $WalkTheWeb;
		try {
			$storename = base64_encode(sanitize_text_field($_POST["walktheweb_storename"]));
			$siteurlpart = sanitize_user($_POST["walktheweb_siteurlpart"], true);
			if (!isset($storename) || empty($storename)) {
				$storename = base64_encode(get_bloginfo('name'));
			} 
			if (is_multisite()) {
				if (get_blog_option($blogid, 'walktheweb_storename') !== false) {
					update_blog_option($blogid, 'walktheweb_storename', $storename);
				} else {
					add_blog_option($blogid, 'walktheweb_storename', $storename, null, 'no');
				}
				if (get_blog_option($blogid, 'walktheweb_siteurlpart') !== false) {
					update_blog_option($blogid, 'walktheweb_siteurlpart', $siteurlpart);
				} else {
					add_blog_option($blogid, 'walktheweb_siteurlpart', $siteurlpart, null, 'no');
				}
			} else {
				if (get_option('walktheweb_storename') !== false) {
					update_option('walktheweb_storename', $storename);
				} else {
					add_option('walktheweb_storename', $storename, null, 'no');
				}
				if (get_option('walktheweb_siteurlpart') !== false) {
					update_option('walktheweb_siteurlpart', $siteurlpart);
				} else {
					add_option('walktheweb_siteurlpart', $siteurlpart, null, 'no');
				}
			}
			$data['storename'] = esc_attr(base64_decode($storename));
			$data['storenamebackup'] = esc_attr(base64_decode($storename));
			$data['siteurlpart'] = esc_attr($siteurlpart);		
		} catch (Exception $e) {
			$logger = wc_get_logger(); 
			$logger->error('error=class-woowtw-functions.php-update_options_3d_store_settings='.$e->getMessage(), array( 'source' => 'woocommerce-3d-store' ) );
		}
		return $data;
	}
*/
	/**
	 * updates options for permissions tab.
	 */
/*	protected function update_options_permissions($data, $blogid) {
		global $WalkTheWeb;
		try {
			$wtwuserid = sanitize_user($_POST["walktheweb_wtwuserid"], true);
			$wtwuserid2 = sanitize_user($_POST["walktheweb_wtwuserid2"], true);
			$wwwstorecarturl = esc_url_raw($_POST["walktheweb_wwwstorecarturl"]);
			$wwwstoreproducturl = esc_url_raw($_POST["walktheweb_wwwstoreproducturl"]);
			$wwwstorewoocommerceapiurl = esc_url_raw($_POST["walktheweb_wwwstorewoocommerceapiurl"]);
			$woocommercekeyname = sanitize_key($_POST["walktheweb_woocommercekeyname"]);
			$woocommercekey = base64_encode(sanitize_key($_POST["walktheweb_woocommercekey"]));
			$woocommercesecret = sanitize_key($_POST["walktheweb_woocommercesecret"]);
			$enablewooapi = sanitize_key($_POST["walktheweb_enablewooapi"]);
			if (is_multisite()) {
				if (get_blog_option($blogid, 'walktheweb_wtwuserid') !== false) {
					update_blog_option($blogid, 'walktheweb_wtwuserid', $wtwuserid);
				} else {
					add_blog_option($blogid, 'walktheweb_wtwuserid', $wtwuserid, null, 'no');
				}
				if (get_blog_option($blogid, 'walktheweb_wtwuserid2') !== false) {
					update_blog_option($blogid, 'walktheweb_wtwuserid2', $wtwuserid2);
				} else {
					add_blog_option($blogid, 'walktheweb_wtwuserid2', $wtwuserid2, null, 'no');
				}
				if (get_blog_option($blogid, 'walktheweb_wwwstorecarturl') !== false) {
					update_blog_option($blogid, 'walktheweb_wwwstorecarturl', $wwwstorecarturl);
				} else {
					add_blog_option($blogid, 'walktheweb_wwwstorecarturl', $wwwstorecarturl, null, 'no');
				}
				if (get_blog_option($blogid, 'walktheweb_wwwstoreproducturl') !== false) {
					update_blog_option($blogid, 'walktheweb_wwwstoreproducturl', $wwwstoreproducturl);
				} else {
					add_blog_option($blogid, 'walktheweb_wwwstoreproducturl', $wwwstoreproducturl, null, 'no');
				}
				if (get_blog_option($blogid, 'walktheweb_wwwstorewoocommerceapiurl') !== false) {
					update_blog_option($blogid, 'walktheweb_wwwstorewoocommerceapiurl', $wwwstorewoocommerceapiurl);
				} else {
					add_blog_option($blogid, 'walktheweb_wwwstorewoocommerceapiurl', $wwwstorewoocommerceapiurl, null, 'no');
				}
				if (get_blog_option($blogid, 'walktheweb_woocommercekeyname') !== false) {
					update_blog_option($blogid, 'walktheweb_woocommercekeyname', $woocommercekeyname);
				} else {
					add_blog_option($blogid, 'walktheweb_woocommercekeyname', $woocommercekeyname, null, 'no');
				}
				if (get_blog_option($blogid, 'walktheweb_woocommercekey') !== false) {
					update_blog_option($blogid, 'walktheweb_woocommercekey', $woocommercekey);
				} else {
					add_blog_option($blogid, 'walktheweb_woocommercekey', $woocommercekey, null, 'no');
				}
				if (get_blog_option($blogid, 'walktheweb_woocommercesecret') !== false) {
					update_blog_option($blogid, 'walktheweb_woocommercesecret', $woocommercesecret);
				} else {
					add_blog_option($blogid, 'walktheweb_woocommercesecret', $woocommercesecret, null, 'no');
				}
				if (get_blog_option($blogid, 'woocommerce_api_enabled') !== false) {
					update_blog_option($blogid, 'woocommerce_api_enabled', $enablewooapi);
				} else {
					add_blog_option($blogid, 'woocommerce_api_enabled', $enablewooapi, null, 'no');
				}
			} else {
				if (get_option('walktheweb_wtwuserid') !== false) {
					update_option('walktheweb_wtwuserid', $wtwuserid);
				} else {
					add_option('walktheweb_wtwuserid', $wtwuserid, null, 'no');
				}
				if (get_option('walktheweb_wtwuserid2') !== false) {
					update_option('walktheweb_wtwuserid2', $wtwuserid2);
				} else {
					add_option('walktheweb_wtwuserid2', $wtwuserid2, null, 'no');
				}
				if (get_option('walktheweb_wwwstorecarturl') !== false) {
					update_option('walktheweb_wwwstorecarturl', $wwwstorecarturl);
				} else {
					add_option('walktheweb_wwwstorecarturl', $wwwstorecarturl, null, 'no');
				}
				if (get_option('walktheweb_wwwstoreproducturl') !== false) {
					update_option('walktheweb_wwwstoreproducturl', $wwwstoreproducturl);
				} else {
					add_option('walktheweb_wwwstoreproducturl', $wwwstoreproducturl, null, 'no');
				}
				if (get_option('walktheweb_wwwstorewoocommerceapiurl') !== false) {
					update_option('walktheweb_wwwstorewoocommerceapiurl', $wwwstorewoocommerceapiurl);
				} else {
					add_option('walktheweb_wwwstorewoocommerceapiurl', $wwwstorewoocommerceapiurl, null, 'no');
				}
				if (get_option('walktheweb_woocommercekeyname') !== false) {
					update_option('walktheweb_woocommercekeyname', $woocommercekeyname);
				} else {
					add_option('walktheweb_woocommercekeyname', $woocommercekeyname, null, 'no');
				}
				if (get_option('walktheweb_woocommercekey') !== false) {
					update_option('walktheweb_woocommercekey', $woocommercekey);
				} else {
					add_option('walktheweb_woocommercekey', $woocommercekey, null, 'no');
				}
				if (get_option('walktheweb_woocommercesecret') !== false) {
					update_option('walktheweb_woocommercesecret', $woocommercesecret);
				} else {
					add_option('walktheweb_woocommercesecret', $woocommercesecret, null, 'no');
				}
				if (get_option('woocommerce_api_enabled') !== false) {
					update_option('woocommerce_api_enabled', $enablewooapi);
				} else {
					add_option('woocommerce_api_enabled', $enablewooapi, null, 'no');
				}
			}
			$data['wtwuserid'] = esc_attr($wtwuserid);
			$data['wtwuserid2'] = esc_attr($wtwuserid2);
			$data['wwwstorecarturl'] = esc_url($wwwstorecarturl);
			$data['wwwstoreproducturl'] = esc_url($wwwstoreproducturl);
			$data['wwwstorewoocommerceapiurl'] = esc_url($wwwstorewoocommerceapiurl);
			$data['woocommercekey'] = esc_attr(base64_decode($woocommercekey));
			$data['woocommercesecret'] = esc_attr($woocommercesecret);
			$data['enablewooapi'] = esc_attr($enablewooapi);

			// check if the REST api key needs to be created
			if ($data['woocommercenewkey'] == '1') {
				$data = $this->add_woocommerce_key($data);
			}
		} catch (Exception $e) {
			$logger = wc_get_logger(); 
			$logger->error('error=class-woowtw-functions.php-update_options_permissions='.$e->getMessage(), array( 'source' => 'woocommerce-3d-store' ) );
		}
		return $data;
	}
*/
	/**
	 * updates options for review and create tab.
	 */
/*	protected function update_options_review_and_create($data, $blogid) {
		global $WalkTheWeb;
		try {
			if ($data['showstep'] == '3' || $data['showstep'] == '4' || $data['showstep'] == '5' || $data['showstep'] == '6' || $data['showstep'] == '7') {
				$review = '1';
				set_transient('walktheweb_review', $review, 300);
				$data['review'] = esc_attr($review);
			} else {
				set_transient('walktheweb_buildingid', '', 300);
				set_transient('walktheweb_communityid', '', 300);
				set_transient('walktheweb_review', '', 300);
				$data['buildingid'] = '';
				$data['communityid'] = '';
				$data['review'] = '';
			}
		} catch (Exception $e) {
			$logger = wc_get_logger(); 
			$logger->error('error=class-woowtw-functions.php-update_options_review_and_create='.$e->getMessage(), array( 'source' => 'woocommerce-3d-store' ) );
		}
		return $data;
	}
*/
	/**
	 * updates options for help tab, cached list for refresh.
	 */
/*	protected function update_options_help($data, $blogid) {
		global $WalkTheWeb;
		try {
			$woohelpblob = sanitize_text_field($_POST["walktheweb_woohelpblob"]);
			$wtwhelpblob = sanitize_text_field($_POST["walktheweb_wtwhelpblob"]);
			set_transient('walktheweb_review', '0', 300);
			if (get_transient('walktheweb_woohelpblob') == false) {
				set_transient('walktheweb_woohelpblob', $woohelpblob, 300);
			}
			if (get_transient('walktheweb_wtwhelpblob') == false) {
				set_transient('walktheweb_wtwhelpblob', $wtwhelpblob, 300);
			}
			$data['woohelpblob'] = esc_attr($woohelpblob);
			$data['wtwhelpblob'] = esc_attr($wtwhelpblob);
			$data['review'] = '0';
		} catch (Exception $e) {
			$logger = wc_get_logger(); 
			$logger->error('error=class-woowtw-functions.php-update_options_help='.$e->getMessage(), array( 'source' => 'woocommerce-3d-store' ) );
		}
		return $data;
	}
	
	protected function add_woocommerce_key($data) {
		global $WalkTheWeb;
		try {
			global $wpdb;

			if ( ! current_user_can( 'manage_woocommerce' ) ) {
				wp_die( -1 );
			}
			$table_prefix = $wpdb->prefix ? $wpdb->prefix : 'wp_';
			
			$i = 1;
			$woocommercekeyname = $data['woocommercekeyname'];
			
			// check if woocommercekeyname already exists
			$result = $wpdb->get_results ( " SELECT * 
				FROM  ".$table_prefix."woocommerce_api_keys
					WHERE description = '".$woocommercekeyname."'" );
					
			if (isset($result) && !empty($result)) {
				// find woocommercekeyname that does not exist
				while (isset($result) && !empty($result)) {
					$woocommercekeyname = $data['woocommercekeyname'].'-'.$i;
					$result = $wpdb->get_results ( " SELECT * 
						FROM  ".$table_prefix."woocommerce_api_keys
							WHERE description = '".$woocommercekeyname."'" );
					$i += 1;
				}
			}
			
			// setup new woo REST API key values - read only used for 3d store
			$keydata = array(
				'user_id'         => $data['wpuserid'],
				'description'     => $woocommercekeyname,
				'permissions'     => 'read',
				'consumer_key'    => wc_api_hash($data['woocommercekey']),
				'consumer_secret' => $data['woocommercesecret'],
				'truncated_key'   => substr($data['woocommercekey'], -7 ),
			);

			// insert new woo REST api key
			if (!isset($result) || empty($result)) {
				$wpdb->insert(
					$wpdb->prefix . 'woocommerce_api_keys',
					$keydata,
					array(
						'%d',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
					)
				);		
			}
			$data['woocommercekeyname'] = $woocommercekeyname;
			$data['woocommercenewkey'] = '0';
			if (is_multisite()) {
				if (get_blog_option($blogid, 'walktheweb_woocommercekeyname') !== false) {
					update_blog_option($blogid, 'walktheweb_woocommercekeyname', $woocommercekeyname);
				} else {
					add_blog_option($blogid, 'walktheweb_woocommercekeyname', $woocommercekeyname, null, 'no');
				}
			} else {
				if (get_option('walktheweb_woocommercekeyname') !== false) {
					update_option('walktheweb_woocommercekeyname', $woocommercekeyname);
				} else {
					add_option('walktheweb_woocommercekeyname', $woocommercekeyname, null, 'no');
				}
			}
		} catch (Exception $e) {
			$logger = wc_get_logger(); 
			$logger->error('error=class-woowtw-functions.php-add_woocommerce_key='.$e->getMessage(), array( 'source' => 'woocommerce-3d-store' ) );
		}
		return $data;
	}
	
	protected function check_woocommerce_key($data) {
		global $WalkTheWeb;
		try {
			global $wpdb;

			if ( ! current_user_can( 'manage_woocommerce' ) ) {
				wp_die( -1 );
			}
			$table_prefix = $wpdb->prefix ? $wpdb->prefix : 'wp_';
			
			$i = 1;
			$woocommercekey = $data['woocommercekey'];
			$woocommercesecret = $data['woocommercesecret'];
			
			// check if woocommercekeyname exists
			$result = $wpdb->get_results ( " SELECT * 
				FROM  ".$table_prefix."woocommerce_api_keys
					WHERE consumer_key = '".wc_api_hash($woocommercekey)."'
						and consumer_secret = '".$woocommercesecret."'" );
			if (isset($result) && !empty($result)) {
				// found key, read description as key name
				foreach ( $result as $key ) {
				   $data['woocommercekeyname'] = $key->description;
				}
				if (is_multisite()) {
					if (get_blog_option($blogid, 'walktheweb_woocommercekeyname') !== false) {
						update_blog_option($blogid, 'walktheweb_woocommercekeyname', $data['woocommercekeyname']);
					} else {
						add_blog_option($blogid, 'walktheweb_woocommercekeyname', $data['woocommercekeyname'], null, 'no');
					}
				} else {
					if (get_option('walktheweb_woocommercekeyname') !== false) {
						update_option('walktheweb_woocommercekeyname', $data['woocommercekeyname']);
					} else {
						add_option('walktheweb_woocommercekeyname', $data['woocommercekeyname'], null, 'no');
					}
				}
			} else if (!isset($result) || empty($result)) {
				// clear options, key does not exist
				$data['woocommercekeyname'] = '';
				$data['woocommercekey'] = '';
				$data['woocommercesecret'] = '';
				$data['woocommercenewkey'] = '0';
				if (is_multisite()) {
					if (get_blog_option($blogid, 'walktheweb_woocommercekeyname') !== false) {
						update_blog_option($blogid, 'walktheweb_woocommercekeyname', '');
					}
					if (get_blog_option($blogid, 'walktheweb_woocommercekey') !== false) {
						update_blog_option($blogid, 'walktheweb_woocommercekey', '');
					}
					if (get_blog_option($blogid, 'walktheweb_woocommercesecret') !== false) {
						update_blog_option($blogid, 'walktheweb_woocommercesecret', '');
					}
				} else {
					if (get_option('walktheweb_woocommercekeyname') !== false) {
						update_option('walktheweb_woocommercekeyname', '');
					}
					if (get_option('walktheweb_woocommercekey') !== false) {
						update_option('walktheweb_woocommercekey', '');
					}
					if (get_option('walktheweb_woocommercesecret') !== false) {
						update_option('walktheweb_woocommercesecret', '');
					}
				}
			}
		} catch (Exception $e) {
			$logger = wc_get_logger(); 
			$logger->error('error=class-woowtw-functions.php-check_woocommerce_key='.$e->getMessage(), array( 'source' => 'woocommerce-3d-store' ) );
		}
		return $data;
	}
	
	protected function get_woocommerce_keys($data) {
		global $WalkTheWeb;
		try {
			global $wpdb;

			if ( ! current_user_can( 'manage_woocommerce' ) ) {
				wp_die( -1 );
			}
			$table_prefix = $wpdb->prefix ? $wpdb->prefix : 'wp_';
			
			$i = 0;
			$keys = array();
			// get woocommercekeynames
			$result = $wpdb->get_results ( " SELECT * 
				FROM  ".$table_prefix."woocommerce_api_keys " );
			if (isset($result) && !empty($result)) {
				// pull key info with hash to compare with JSON
				foreach ( $result as $key ) {
					$keys[$i] = array(
						'keyname' => $key->description, 
						'hashkey' => $key->consumer_key, 
						'secret' => $key->consumer_secret
					);
				   $i += 1;
				}
			}
			$data['woocommercekeys'] = json_encode($keys);
		} catch (Exception $e) {
			$logger = wc_get_logger(); 
			$logger->error('error=class-woowtw-functions.php-get_woocommerce_keys='.$e->getMessage(), array( 'source' => 'woocommerce-3d-store' ) );
		}
		return $data;
	}
*/	
}

?>