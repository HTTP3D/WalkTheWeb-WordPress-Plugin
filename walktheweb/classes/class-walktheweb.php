<?php
/**
 * WalkTheWeb
 * @package  WalkTheWeb
 */
 if (!defined('ABSPATH')) exit; // Exit if accessed directly
 
 /**
 * Main WalkTheWeb Class.
 * @class WalkTheWeb
 */
final class WalkTheWeb {
	
	public $version = '2.0.0';
	public $dbversion = '2.0.0';
	public $jsversion = '2.0.0';
	public $cssversion = '2.0.0';
	public $blogid = ''; 
	public $storeurl = '';

	protected static $_instance = null;
	
	/**
	 * Main WalkTheWeb Instance.
	 * Ensures only one instance of WalkTheWeb is loaded or can be loaded.
	 * @return WalkTheWeb - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function __construct() {
		try {
			$this->blogid = get_current_blog_id();
			$this->define_constants();
			$this->load_classes();
			$this->init_hooks();
			$this->init_options();
		} catch (Exception $e) {
			echo "<script>console.log('wtw-classes-class-walktheweb.php-construct".$e->getMessage()."');</script>";
		}
	}
	
	/**
	 * Define constant if not already set.
	 * @param string      $name  Constant name.
	 * @param string|bool $value Constant value.
	 */
	private function define( $name, $value ) {
		if (!defined( $name )) {
			define( $name, $value );
		}
	}
	
	/**
	 * Define WTW Constants.
	 */
	private function define_constants() {
		global $wpdb;
		$this->define('WTW_ABSPATH', dirname( WTW_PLUGIN_FILE ).'/' );
		$this->define('WTW_PLUGIN_BASENAME', plugin_basename(WTW_PLUGIN_FILE) );
		$this->define('WTW_VERSION', $this->version );
		$this->define('WTW_PLUGIN_URL', WP_PLUGIN_URL.'/walktheweb');
		$this->define('WTW_PREFIX', $wpdb->prefix."walktheweb_");
	}
	
	public function serror($zmessage) {
		global $wpdb;
		try {
		$wpdb->query("
			insert into ".WTW_PREFIX."errorlog 
				(message,
				logdate)
				values
				('".addslashes($zmessage)."',
				now());");
		} catch (Exception $e) {
			echo "<script>console.log('wtw-classes-class-walktheweb.php-load_classes".$e->getMessage()."\r\n".addslashes($zmessage)."');</script>";
		}
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
			$WalkTheWeb->serror("wtw-classes-class-walktheweb.php-getRandomString = ".$e->getMessage());
		}
		return $zrandomstring;
	}


	/**
	 * Load WTW Classes.
	 */
	private function load_classes() {
		try {
			/**
			 * Forms
			 */
			require_once WTW_ABSPATH.'classes/class-wtw-forms.php';

			/**
			 * Functions
			 */
			require_once WTW_ABSPATH.'classes/class-wtw-functions.php';
		} catch (Exception $e) {
			$this->serror("wtw-classes-class-walktheweb.php-load_classes = ".$e->getMessage());
		}
	}
	
	/**
	 * action and filter hooks.
	 */
	private function init_hooks() {
		add_action('send_headers', array( $this, 'walktheweb_header_content_security'));
		add_action('admin_notices', array( $this, 'walktheweb_admin_notice'));
		add_action('wp_enqueue_scripts', array( $this, 'load_dashicons_front_end'));
		add_action('admin_enqueue_scripts', array( $this, 'walktheweb_scripts'));
		add_action('init', array( $this, 'wtw_init'));
		add_action('init', array( $this, 'walktheweb_init_internal'));
		add_filter('query_vars', array( $this, 'walktheweb_query_vars'));
		add_filter('query_vars', array( $this, 'walktheweb_image_query_vars'));
		add_filter('query_vars', array( $this, 'walktheweb_storeinfo_query_vars'));
		add_filter('query_vars', array( $this, 'walktheweb_confirmapi_query_vars'));
		add_filter('query_vars', array( $this, 'walktheweb_wtwconnection_query_vars'));
		add_action('parse_request', array( $this, 'walktheweb_parse_request'));
	}

	/**
	 * Admin Notice on Activation.
	 * @since 0.1.0
	 */
	public function walktheweb_admin_notice(){
		try {
			$shownmessage = false;
			if (is_multisite()) {
				if (get_blog_option($this->blogid, 'walktheweb_activated') == "true") {
					$shownmessage = true;
				}
			} else {
				if (get_option('walktheweb_activated') == "true") {
					$shownmessage = true;
				}
			}
			if ($shownmessage == false) { ?>
				<div class="updated notice is-dismissible">
					<p><?php _e('Thank you for using the <strong>WalkTheWeb 3D Internet</strong> plugin!', 'walktheweb'); ?><br />
					<a href="<?php echo $this->storeurl; ?>/wp-admin/admin.php?page=walktheweb_dashboard"><?php _e('Navigate to <strong>WalkTheWeb</strong> in your admin menu or click here to get started.', 'walktheweb'); ?></a>.</p>
				</div>
<?php		}
			if (is_multisite()) {
				update_blog_option($this->blogid, 'walktheweb_activated', "true");
			} else {
				update_option('walktheweb_activated', "true");
			}
		} catch (Exception $e) {
			$this->serror("wtw-classes-class-walktheweb.php-walktheweb_admin_notice = ".$e->getMessage());
		}
	}	

	/**
	 * load admin/options js file.
	 */
	public function walktheweb_scripts($hook) {
		wp_enqueue_script( 'walktheweb_main_js', WTW_PLUGIN_URL.'/assets/scripts/walktheweb_main.js', array('jquery'), $this->jsversion, false);
		wp_enqueue_script( 'walktheweb_downloads_js', WTW_PLUGIN_URL.'/assets/scripts/walktheweb_downloads.js', array('jquery'), $this->jsversion, false);
		wp_enqueue_style('walktheweb_style_css', WTW_PLUGIN_URL.'/assets/styles/walktheweb_styles.css', array(), $this->cssversion, 'all');
	}	
	
	/**
	 * allow 3d websites to open shopping cart in iframe.
	 */
	function walktheweb_header_content_security() {
		global $wpdb;
		try {
			$enablehttpheaders = '1';
			$this->storeurl = esc_url(get_bloginfo('wpurl'));
			if (is_multisite()) {
				$enablehttpheaders = get_blog_option($this->blogid, 'walktheweb_enablehttpheaders', '1');
			} else {
				$enablehttpheaders = get_option('walktheweb_enablehttpheaders', '1');	
			}		
			$domain = $_SERVER['HTTP_HOST'];
			try {
				$host_names = explode(".", $domain);
				if (count($host_names) > 2) {
					$domain = $host_names[count($host_names)-2].".".$host_names[count($host_names)-1];
				} else {
					$domain = $host_names[0].".".$host_names[1];
				}
			} catch (Exception $e) {
				// intentionally escaped.
			}
			if ($enablehttpheaders == '1') {
				$zheaders = "X-Content-Security-Policy: frame-ancestors 'self' https://3d.walktheweb.com https://3dnet.walktheweb.com https://3dnet.walktheweb.network https://3d.".$domain;

				$zresults = $wpdb->get_results("
					select distinct hosturl 
					from ".WTW_PREFIX."3dhosts
                    where deleted=0
                    group by hosturl;");
				foreach ($zresults as $zrow) {
					if (isset($zrow->hosturl) && !empty($zrow->hosturl)) {
						$zhost = $zrow->hosturl;
						if ($zhost != "https://3d.".$domain) {
							$zheaders .= " ".$zhost;
						}
					}
				}
				header($zheaders);
			}
		} catch (Exception $e) {
			$this->serror("wtw-classes-class-walktheweb.php-walktheweb_header_content_security = ".$e->getMessage());
		}
	}
	
	/**
	 * Settings and Support links on plugin page.
	 */
	public function walktheweb_add_settings_link($links) {
		if (current_user_can('manage_options')) {
			$settings_link = '<a href="options.php?page=walktheweb_settings&tab=1">'.__('Settings').'</a>';
			$support_link = '<a href="options.php?page=walktheweb_settings&tab=8">'.__('Support').'</a>';
			$links = array_merge( array($settings_link,$support_link), $links);
		} else {
			$support_link = '<a href="https://www.walktheweb.com/knowledgebase_category/3d-stores/">'.__('Support').'</a>';
			$links = array_merge( array($support_link), $links);
		}
		return $links;
	}
	
	/**
	 * init WalkTheWeb when WordPress Initializes.
	 */
	public function wtw_init() {
		try {
			$this->functions = new WTW_Functions();
			$this->forms     = new WTW_Forms();
			add_filter("plugin_action_links_".WTW_PLUGIN_BASENAME, array($this, 'walktheweb_add_settings_link'));
		} catch (Exception $e) {
			$this->serror("wtw-classes-class-walktheweb.php-wtw_init = ".$e->getMessage());
		}
	}
	
	/**
	 * init WalkTheWeb options and version check.
	 */
	private function init_options() {
		try {
			if (is_multisite()) {
				add_blog_option($this->blogid, 'walktheweb_version', $this->version, null, 'no');
				if (get_blog_option($this->blogid, 'walktheweb_version') != $this->version) {
					$this->version_upgrade();
					update_blog_option($this->blogid, 'walktheweb_version', $this->version);
				}
			} else {
				add_option('walktheweb_version', $this->version);
				if (get_option('walktheweb_version') != $this->version) {
					$this->version_upgrade();
					update_option('walktheweb_version', $this->version);
				}
			}
		} catch (Exception $e) {
			$this->serror("wtw-classes-class-walktheweb.php-init_options = ".$e->getMessage());
		}
	}
	
	/**
	 * version upgrade for future versions.
	 */
	private function version_upgrade() {
		try {
			global $wpdb;
			if (is_multisite()) {
				$walktheweb_db_version = get_blog_option($this->blogid, 'walktheweb_db_version');
			} else {
				$walktheweb_db_version = get_option('walktheweb_db_version');
			}
			if ($walktheweb_db_version != $this->dbversion) {
				require_once(ABSPATH.'wp-admin/includes/upgrade.php' );		
				
				$sql = "CREATE TABLE `".WTW_PREFIX."3dhosts` (
						  `hostid` varchar(16) NOT NULL,
						  `hostinstanceid` varchar(16) DEFAULT '',
						  `hosturl` varchar(255) DEFAULT '',
						  `wtwkey` varchar(255) DEFAULT '',
						  `wtwsecret` varchar(255) DEFAULT '',
						  `wtwkeynew` varchar(255) DEFAULT '',
						  `wtwsecretnew` varchar(255) DEFAULT '',
						  `enabled` varchar(1) DEFAULT '0',
						  `createdate` datetime DEFAULT NULL,
						  `createwpid` bigint DEFAULT NULL,
						  `updatedate` datetime DEFAULT NULL,
						  `updatewpid` bigint DEFAULT NULL,
						  `deleteddate` datetime DEFAULT NULL,
						  `deletedwpid` bigint DEFAULT NULL,
						  `deleted` int DEFAULT '0',
						  PRIMARY KEY (`hostid`),
						  UNIQUE KEY `".WTW_PREFIX."hostid_UNIQUE` (`hostid`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
				dbDelta($sql);

				$sql = "CREATE TABLE `".WTW_PREFIX."3dwebsites` (
						  `websiteid` varchar(16) NOT NULL,
						  `userid` int DEFAULT NULL,
						  `usertoken` varchar(2048) DEFAULT '',
						  `wtwuserid` varchar(32) DEFAULT '',
						  `wtwusertoken` varchar(2048) DEFAULT '',
						  `wtwemail` varchar(255) DEFAULT '',
						  `wookeyid` int DEFAULT NULL,
						  `hostingname` varchar(255) DEFAULT '',
						  `storename` varchar(45) DEFAULT NULL,
						  `domainurl` varchar(255) DEFAULT '',
						  `websiteurl` varchar(255) DEFAULT '',
						  `webname` varchar(255) DEFAULT '',
						  `buildingid` varchar(16) DEFAULT '',
						  `buildingname` varchar(255) DEFAULT '',
						  `communityid` varchar(16) DEFAULT '',
						  `communityname` varchar(255) DEFAULT '',
						  `storeurl` varchar(255) DEFAULT '',
						  `storecarturl` varchar(255) DEFAULT '',
						  `storeproducturl` varchar(255) DEFAULT '',
						  `storewooapiurl` varchar(255) DEFAULT '',
						  `iframes` int DEFAULT '1',
						  `createdate` datetime DEFAULT NULL,
						  `createwpid` int DEFAULT NULL,
						  `updatedate` datetime DEFAULT NULL,
						  `updatewpid` int DEFAULT NULL,
						  `deleteddate` datetime DEFAULT NULL,
						  `deletedwpid` bigint DEFAULT NULL,
						  `deleted` int DEFAULT '0',
						  PRIMARY KEY (`websiteid`),
						  UNIQUE KEY `".WTW_PREFIX."websiteid_UNIQUE` (`websiteid`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
				dbDelta($sql);

				$sql = "CREATE TABLE `".WTW_PREFIX."errorlog` (
						  `errorid` int NOT NULL AUTO_INCREMENT,
						  `logdate` datetime DEFAULT NULL,
						  `message` varchar(2048) DEFAULT '',
						  PRIMARY KEY (`errorid`),
						  UNIQUE KEY `".WTW_PREFIX."errorid_UNIQUE` (`errorid`)
						) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
				dbDelta($sql);
				
				if (is_multisite()) {
					update_blog_option($this->blogid, 'walktheweb_db_version', $this->version);
				} else {
					update_option('walktheweb_db_version' , $this->dbversion);
				}
			}
		} catch (Exception $e) {
			$this->serror("wtw-classes-class-walktheweb.php-version_upgrade = ".$e->getMessage());
		}
	}

	/**
	 * WalkTheWeb Menu item icon.
	 */
	public function load_dashicons_front_end() {
		wp_enqueue_style('dashicons');
	}

	/**
	 * Rewrite Rules for API pages.
	 */
	public function walktheweb_init_internal() {
		add_rewrite_rule( 'apikeys.php$', WTW_PLUGIN_URL.'/api/apikeys.php?walktheweb', 'top' );
		add_rewrite_rule( 'image.php$', WTW_PLUGIN_URL.'/api/productimage.php?walktheweb_image_url=1', 'top' );
		add_rewrite_rule( 'storeinfo.php$', WTW_PLUGIN_URL.'/api/storeinfo.php?walktheweb_store_info=1', 'top' );
		add_rewrite_rule( 'confirmapi.php$', WTW_PLUGIN_URL.'/api/confirmapi.php?walktheweb_confirm_api=1', 'top' );
		add_rewrite_rule( 'wtwconnection.php$', WTW_PLUGIN_URL.'/api/wtwconnection.php?walktheweb_wtwconnection=1', 'top' );
	}

	/**
	 * Query Var for image.php API pages.
	 */
	public function walktheweb_image_query_vars($query_vars) {
		$query_vars[] = 'walktheweb_image_url';
		return $query_vars;
	}

	/**
	 * Query Var for storeinfo.php API pages.
	 */
	public function walktheweb_storeinfo_query_vars($query_vars) {
		$query_vars[] = 'walktheweb_store_info';
		return $query_vars;
	}

	/**
	 * Query Var for confirmapi.php API pages.
	 */
	public function walktheweb_confirmapi_query_vars($query_vars) {
		$query_vars[] = 'walktheweb_confirm_api';
		return $query_vars;
	}
	
	/**
	 * Query Var for wtwconnection.php API pages.
	 */
	public function walktheweb_wtwconnection_query_vars($query_vars) {
		$query_vars[] = 'walktheweb_wtwconnection';
		return $query_vars;
	}

	/**
	 * Query Var for walktheweb pages.
	 */
	public function walktheweb_query_vars($query_vars) {
		$query_vars[] = 'walktheweb';
		return $query_vars;
	}

	/**
	 * Parse Request for API pages.
	 */
	public function walktheweb_parse_request() {
		global $wp;
		if (array_key_exists( 'walktheweb', $wp->query_vars ) ) {
			foreach ($wp->query_vars as $query_var) {
				if (file_exists(WTW_ABSPATH.'/api/'.$query_var)) {
					require_once(WTW_ABSPATH.'/api/'.$query_var);
					exit();
				}
			}
		} elseif (array_key_exists( 'walktheweb_image_url', $wp->query_vars ) ) {
			include WTW_ABSPATH.'/api/productimage.php';
			exit();
		} elseif (array_key_exists('walktheweb_store_info', $wp->query_vars ) ) {
			include WTW_ABSPATH.'/api/storeinfo.php';
			exit();
		} elseif (array_key_exists('walktheweb_confirm_api', $wp->query_vars ) ) {
			include WTW_ABSPATH.'/api/confirmapi.php';
			exit();
		} elseif (array_key_exists('walktheweb_wtwconnection', $wp->query_vars ) ) {
			include WTW_ABSPATH.'/api/wtwconnection.php';
			exit();
		}
		return;
	}	
}
?>