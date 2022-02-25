<?php
/**
 * WTW_Forms
 * @package  WTW_Forms
 */
 if (!defined('ABSPATH')) exit; // Exit if accessed directly
 
 /**
 * @class WTW_Forms.
 * @package WTW3DStore/Classes
 * @category Class
 * @author   adishno
 */
class WTW_Forms {
	
	/**
	 * The single instance of the class.
	 *
	 * @var WTW_Forms|null
	 */
	protected static $_instance = null;
	
	/**
	 * WTW_Forms Instance.
	 * Ensures only one instance of WTW_Forms is loaded or can be loaded.
	 * @return WTW_Forms - instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
			
		}
		return self::$_instance;
	}
	
	public function __construct() {
		global $WalkTheWeb;
		try {
			$this->init_hooks();
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-forms.php-__construct = ".$e->getMessage());
		}
	}	

	/**
	 * action and filter hooks.
	 */
	private function init_hooks() {
		global $WalkTheWeb;
		try {
			if (current_user_can('manage_options')) {
				add_action('admin_menu', array( $this, 'walktheweb_menu'));
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-forms.php-init_hooks = ".$e->getMessage());
		}
	}
	
	/**
	 * WalkTheWeb Menu item.
	 */
	public function walktheweb_menu() {
		global $WalkTheWeb;
		try {
			if (current_user_can('manage_options')) {
				add_menu_page('WalkTheWeb Metaverse', 'WalkTheWeb<sup>®</sup>', 'manage_options', 'walktheweb_menu', array($this,'walktheweb_dashboard_page'), 'dashicons-admin-site',56);

				add_submenu_page('walktheweb_menu', __('Dashboard', 'walktheweb'), __('Dashboard', 'walktheweb' ), 'manage_options', 'walktheweb_dashboard', array($this,'walktheweb_dashboard_page'), 0);

				add_submenu_page('walktheweb_menu', __('3D Websites', 'walktheweb'), __('3D Websites', 'walktheweb'), 'manage_options', 'walktheweb_3dwebsites', array($this,'walktheweb_3dwebsites_page'), 1);
				add_submenu_page(null, __('Add 3D Website', 'walktheweb'), __('Add 3D Website', 'walktheweb'), 'manage_options', 'walktheweb_add3dwebsite', array($this,'walktheweb_add3dwebsite_page'), 2);

				add_submenu_page('walktheweb_menu', __('3D Hosts', 'walktheweb'), __('3D Hosts', 'walktheweb'), 'manage_options', 'walktheweb_3dhosts', array($this,'walktheweb_3dhosts_page'), 5);
				add_submenu_page(null, __('Add 3D Host', 'walktheweb'), __('Add 3D Host', 'walktheweb'), 'manage_options', 'walktheweb_add3dhost', array($this,'walktheweb_add3dhost_page'), 6);
				add_submenu_page(null, __('WalkTheWeb 3D Host', 'walktheweb'), __('WalkTheWeb 3D Host', 'walktheweb'), 'manage_options', 'walktheweb_wtw3dhost', array($this,'walktheweb_wtw3dhost_page'), 7);

				add_submenu_page('walktheweb_menu', __('Marketplace', 'walktheweb'), __('Marketplace', 'walktheweb'), 'manage_options', 'walktheweb_marketplace', array($this,'walktheweb_marketplace_page'), 9);

				add_submenu_page('walktheweb_menu', __('About', 'walktheweb').' WalkTheWeb', __('About', 'walktheweb').' WalkTheWeb', 'manage_options', 'walktheweb_about', array($this,'walktheweb_about_page'), 10);
				remove_submenu_page('walktheweb_menu','walktheweb_menu');
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-forms.php-walktheweb_menu = ".$e->getMessage());
		}
	}
	
	public function walktheweb_dashboard_page() {
		global $WalkTheWeb;
		try {
			if (!current_user_can('manage_options')) {
				wp_die(__("You do not have access to this page"));
			} else {
				$walktheweb_wooactive = '0';
				if (is_plugin_active('woocommerce/woocommerce.php')) {
					$walktheweb_wooactive = '1';
				}
				$walktheweb_wpinstanceid = $this->getInstanceID();
				$walktheweb_storeurl = get_site_url();
				$walktheweb_parse = parse_url($walktheweb_storeurl);
				$walktheweb_storename = esc_html(get_bloginfo('name'));
				$walktheweb_domainname = $walktheweb_parse['host'];
				$walktheweb_domain = $walktheweb_domainname;
				$walktheweb_serverip = gethostbyname($walktheweb_domainname);
				$walktheweb_domainparts = explode(".",$walktheweb_domainname);
				$walktheweb_domainroot = "yoursite";
				$walktheweb_wookey    = 'ck_e4f9d75c376f6805f7a059e91a4d8636d6f1deba'; //'ck_' . wc_rand_hash();
				$walktheweb_woosecret = 'cs_b230d178ee154aa8985f63b3844c4a36edf8a50c'; //'cs_' . wc_rand_hash();
				
				$walktheweb_carturl = $walktheweb_storeurl."/cart/";
				$walktheweb_producturl = $walktheweb_storeurl."/product/";
				$walktheweb_apiurl = $walktheweb_storeurl."/wp-json/wc/v2/";
				
				if (count($walktheweb_domainparts) > 1) {
					$walktheweb_domainroot = $walktheweb_domainparts[count($walktheweb_domainparts)-2];
					$walktheweb_domain = $walktheweb_domainparts[count($walktheweb_domainparts)-2].".".$walktheweb_domainparts[count($walktheweb_domainparts)-1];
				} else {
					$walktheweb_domainroot = $walktheweb_domainparts[0];
				}
				$walktheweb_wookeys = $this->getWooKeysList();
				$blogid = get_current_blog_id();
				$user = wp_get_current_user();
				$nonce = wp_create_nonce('walktheweb_update_'.$blogid);
				
				$walktheweb_data = wtw()->functions->saveNewWebsite();
?>			<form id="walktheweb_dashboardform" method="post" action="admin.php?page=walktheweb_dashboard&nonce=<?php echo $nonce; ?>">
<?php			require_once(WTW_ABSPATH.'/pages/walktheweb_dashboard.php'); ?>
			</form>
<?php		}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-forms.php-walktheweb_dashboard_page = ".$e->getMessage());
		}
	}

	public function getWooKeysList() {
		global $WalkTheWeb;
		$zkeys = array();
		try {
			global $wpdb;

			if ( ! current_user_can( 'manage_woocommerce' ) ) {
				wp_die( -1 );
			}
			$ztable_prefix = $wpdb->prefix ? $wpdb->prefix : 'wp_';
			
			$i = 0;
			/* get woocommercekeynames */
			$zresult = $wpdb->get_results ( " SELECT * 
				FROM  ".$ztable_prefix."woocommerce_api_keys " );
			if (isset($zresult) && !empty($zresult)) {
				/* pull key info with hash for list of available keys */
				foreach ($zresult as $zrow) {
					$zkeys[$i] = array(
						'keyid' => $zrow->key_id,
						'description' => $zrow->description, 
						'consumerkey' => $zrow->consumer_key, 
						'consumersecret' => $zrow->consumer_secret,
						'truncatedkey' => $zrow->truncated_key,
						'permissions' => $zrow->permissions
					);
				   $i += 1;
				}
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-forms.php-getWooKeysList = ".$e->getMessage());
		}
		return $zkeys;
	}

	public function getInstanceID() {
		global $WalkTheWeb;
		$zinstanceid = '';
		try {
			$zblogid = get_current_blog_id();
			if (is_multisite()) {
				$zinstanceid = get_blog_option($zblogid, 'walktheweb_wpinstanceid', '');
			} else {
				$zinstanceid = get_option('walktheweb_wpinstanceid', '');
			}
			if (empty($zinstanceid) || !isset($zinstanceid)) {
				$zinstanceid = $this->getRandomString(32,1);
			}
			if (is_multisite()) {
				if (get_blog_option($zblogid, 'walktheweb_wpinstanceid') !== false) {
					update_blog_option($zblogid, 'walktheweb_wpinstanceid', $zinstanceid);
				} else {
					add_blog_option($zblogid, 'walktheweb_wpinstanceid', $zinstanceid, null, 'no');
				}
			} else {
				if (get_option('walktheweb_wpinstanceid') !== false) {
					update_option('walktheweb_wpinstanceid', $zinstanceid);
				} else {
					add_option('walktheweb_wpinstanceid', $zinstanceid, null, 'no');
				}
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-forms.php-getInstanceID = ".$e->getMessage());
		}
		return $zinstanceid;
	}

	public function getRandomString($zlength, $zstringtype) {
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
			$WalkTheWeb->serror("wtw-classes-class-wtw-forms.php-getRandomString = ".$e->getMessage());
		}
		return $zrandomstring;
	}
	
	public function walktheweb_3dwebsites_page() {
		global $WalkTheWeb;
		try {
			if (!current_user_can('manage_options')) {
				wp_die(__("You do not have access to this page"));
			} else {
				$walktheweb_wooactive = '0';
				if (is_plugin_active('woocommerce/woocommerce.php')) {
					$walktheweb_wooactive = '1';
				}
				$blogid = get_current_blog_id();
				$user = wp_get_current_user();
				$walktheweb_wpinstanceid = $this->getInstanceID();
				$nonce = wp_create_nonce('walktheweb_update_'.$blogid);
				require_once(WTW_ABSPATH.'/pages/walktheweb_3dwebsites.php');
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-forms.php-walktheweb_3dwebsites_page = ".$e->getMessage());
		}
	}

	public function walktheweb_add3dwebsite_page() {
		global $WalkTheWeb;
		try {
			if (!current_user_can('manage_options')) {
				wp_die(__("You do not have access to this page"));
			} else {
				$walktheweb_wooactive = '0';
				if (is_plugin_active('woocommerce/woocommerce.php')) {
					$walktheweb_wooactive = '1';
				}
				$blogid = get_current_blog_id();
				$user = wp_get_current_user();
				$walktheweb_wpinstanceid = $this->getInstanceID();
				$nonce = wp_create_nonce('walktheweb_update_'.$blogid);
				require_once(WTW_ABSPATH.'/pages/walktheweb_add3dwebsite.php');
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-forms.php-walktheweb_add3dwebsite_page = ".$e->getMessage());
		}
	}

	public function walktheweb_3dhosts_page() {
		global $WalkTheWeb;
		try {
			if (!current_user_can('manage_options')) {
				wp_die(__("You do not have access to this page"));
			} else {
				$walktheweb_wooactive = '0';
				if (is_plugin_active('woocommerce/woocommerce.php')) {
					$walktheweb_wooactive = '1';
				}
				$blogid = get_current_blog_id();
				$user = wp_get_current_user();
				$nonce = wp_create_nonce('walktheweb_update_'.$blogid);
				require_once(WTW_ABSPATH.'/pages/walktheweb_3dhosts.php');
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-forms.php-walktheweb_3dhosts_page = ".$e->getMessage());
		}
	}

	public function walktheweb_add3dhost_page() {
		global $WalkTheWeb;
		try {
			if (!current_user_can('manage_options')) {
				wp_die(__("You do not have access to this page"));
			} else {
				$walktheweb_wooactive = '0';
				if (is_plugin_active('woocommerce/woocommerce.php')) {
					$walktheweb_wooactive = '1';
				}
				$zsiteurl = site_url();
				$blogid = get_current_blog_id();
				$user = wp_get_current_user();
				$walktheweb_wpinstanceid = $this->getInstanceID();
				$nonce = wp_create_nonce('walktheweb_update_'.$blogid);
				require_once(WTW_ABSPATH.'/pages/walktheweb_add3dhost.php');
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-forms.php-walktheweb_add3dhost_page = ".$e->getMessage());
		}
	}

	public function walktheweb_wtw3dhost_page() {
		global $WalkTheWeb;
		try {
			if (!current_user_can('manage_options')) {
				wp_die(__("You do not have access to this page"));
			} else {
				$walktheweb_wooactive = '0';
				if (is_plugin_active('woocommerce/woocommerce.php')) {
					$walktheweb_wooactive = '1';
				}
				$zsiteurl = site_url();
				$blogid = get_current_blog_id();
				$user = wp_get_current_user();
				$walktheweb_wpinstanceid = $this->getInstanceID();
				$nonce = wp_create_nonce('walktheweb_update_'.$blogid);
				require_once(WTW_ABSPATH.'/pages/walktheweb_wtw3dhost.php');
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-forms.php-walktheweb_wtw3dhost_page = ".$e->getMessage());
		}
	}

	public function walktheweb_marketplace_page() {
		global $WalkTheWeb;
		try {
			if (!current_user_can('manage_options')) {
				wp_die(__("You do not have access to this page"));
			} else {
				$walktheweb_wooactive = '0';
				if (is_plugin_active('woocommerce/woocommerce.php')) {
					$walktheweb_wooactive = '1';
				}
				$blogid = get_current_blog_id();
				$user = wp_get_current_user();
				$walktheweb_wpinstanceid = $this->getInstanceID();
				$nonce = wp_create_nonce('walktheweb_update_'.$blogid);
				require_once(WTW_ABSPATH.'/pages/walktheweb_marketplace.php');
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-forms.php-walktheweb_marketplace_page = ".$e->getMessage());
		}
	}

	public function walktheweb_about_page() {
		global $WalkTheWeb;
		try {
			if (!current_user_can('manage_options')) {
				wp_die(__("You do not have access to this page"));
			} else {
				$walktheweb_wooactive = '0';
				if (is_plugin_active('woocommerce/woocommerce.php')) {
					$walktheweb_wooactive = '1';
				}
				$blogid = get_current_blog_id();
				$user = wp_get_current_user();
				$walktheweb_wpinstanceid = $this->getInstanceID();
				$nonce = wp_create_nonce('walktheweb_update_'.$blogid);
				require_once(WTW_ABSPATH.'/pages/walktheweb_about.php');
			}
		} catch (Exception $e) {
			$WalkTheWeb->serror("wtw-classes-class-wtw-forms.php-walktheweb_about_page = ".$e->getMessage());
		}
	}


	
}

?>