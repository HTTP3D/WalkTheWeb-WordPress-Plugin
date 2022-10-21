<?php
	global $WalkTheWeb;
	try {
		$zhosturl = "https://3d.";
		$zwtwkey = base64_encode("ck_".$WalkTheWeb->getRandomString(40,1));
		$zwtwsecret = base64_encode("cs_".$WalkTheWeb->getRandomString(40,1));
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$noncecheck = sanitize_key($_POST["walktheweb_nonce"]);
			if ($nonce == $noncecheck && !empty($noncecheck)) {
				$bval = sanitize_key($_POST["walktheweb_bval"]);
				switch ($bval) {
					case "walktheweb_save":
						$zhosturl = $_POST["walktheweb_hosturl"];
						$zhostid = $_POST["walktheweb_hostid"];
						$zwtwkey = $_POST["walktheweb_wtwkey"];
						$zwtwsecret = $_POST["walktheweb_wtwsecret"];
						$WalkTheWeb->functions->saveHost($zhosturl, $zhostid, $zwtwkey, $zwtwsecret);
						global $pagenow;
						wp_redirect(admin_url('/admin.php?page=walktheweb_3dhosts'), 301);
						exit();
						break;
				}
			}
		}
?>
	<div class="wrap">
	<h2><img src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/menuwtw.png" class="walktheweb_logo" \><?php _e( 'Add 3D Host', 'walktheweb' ); ?></h2><hr />
	<?php _e( '3D Hosts are Web Servers running <span style="color:blue">WalkTheWeb<sup>®</sup></span> 3D Internet - FREE Open-Source 3D CMS Hosting Software - <a href="https://github.com/http3d/walktheweb" target="_blank">Download Here</a>.', 'walktheweb' ); ?><hr />
	<form id="walktheweb_form" method="post" action="admin.php?page=walktheweb_add3dhost">
		<h2>Send Connection Request to 3D Host</h2>
		<div class="walktheweb_label">3D Host URL</div>
		<div class="walktheweb_value"><input type="text" id="walktheweb_hosturl" name="walktheweb_hosturl" class="walktheweb_inputbig" maxlength="255" style="min-width:400px;" autocomplete="false" value="<?php echo $zhosturl; ?>" /></div>
		<div class="walktheweb_clear"></div>
		<div id="walktheweb_addhosterror" class="walktheweb_errortext"></div>
		<div class="walktheweb_value">
		<input type="button" id="walktheweb_save" name="walktheweb_save" value="Send Connection Request to 3D Host" onclick="walktheweb.hostRequest();"  class="walktheweb_submit"/><br /><br />
		<input type="button" id="walktheweb_cancel" name="walktheweb_cancel" value="Cancel" onclick="window.location.href='admin.php?page=walktheweb_3dhosts';" style="cursor:pointer;" />
		</div>
		<div class="walktheweb_clear"></div>
		<div class="walktheweb_notebox">To be a 3D Host for this WordPress plugin, the 3D Host must be secure (use https - SSL Certificate) and start with https://3d.<br />Example: https://3d.yourdomain.com<br /><br />You must also have Admin access on the 3D Host you are adding.<br /><br />3D Host is running <a href='https://github.com/http3d/walktheweb' target='_blank'>WalkTheWeb 3D Internet Open-Source software.</a></div><br />
		<div class="walktheweb_clear"></div>
		<input type="hidden" id="walktheweb_wpinstanceid" name="walktheweb_wpinstanceid" value="<?php echo esc_attr($walktheweb_wpinstanceid); ?>" />
		<input type="submit" id="walktheweb_submit" name="walktheweb_submit" value="Submit" class="walktheweb_hide" />
		<input type="hidden" id="walktheweb_hostid" name="walktheweb_hostid" value="<?php echo $zhostid; ?>" />
		<input type="hidden" id="walktheweb_wtwkey" name="walktheweb_wtwkey" value="<?php echo $zwtwkey; ?>" />
		<input type="hidden" id="walktheweb_wtwsecret" name="walktheweb_wtwsecret" value="<?php echo $zwtwsecret; ?>" />
		<input type="hidden" id="walktheweb_bval" name="walktheweb_bval" value="" />
		<input type="hidden" id="walktheweb_siteurl" name="walktheweb_siteurl" value="<?php echo $zsiteurl; ?>" />
		<input type="hidden" id="walktheweb_nonce" name="walktheweb_nonce" value="<?php echo $nonce; ?>" />
	</form>
	</div>
<?php
	} catch (Exception $e) {
		$WalkTheWeb->serror("wtw-pages-walktheweb_add3dhost.php = ".$e->getMessage());
	}
?>
