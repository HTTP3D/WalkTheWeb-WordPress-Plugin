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
						
						/* enable woo api if it is not already */
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
}

?>