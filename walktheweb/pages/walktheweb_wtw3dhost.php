<?php
	global $WalkTheWeb;
	try {
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$noncecheck = sanitize_key($_POST["walktheweb_nonce"]);
			if ($nonce == $noncecheck && !empty($noncecheck)) {
				$bval = sanitize_key($_POST["walktheweb_bval"]);
				switch ($bval) {
					case "walktheweb_save":
						//$WalkTheWeb->functions->saveHost($_POST["walktheweb_hosturl"], $_POST["walktheweb_wookeyid"]);
						break;
					
					
					
				}
			}
		}
		$ddlwookeys = $WalkTheWeb->functions->getDDLWooKeyDescriptions();
?>
	<div class="wrap">
	<h2><img src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/menuwtw.png" class="walktheweb_logo" \><?php _e( 'WalkTheWeb 3D Host', 'walktheweb' ); ?></h2><hr />
	Use the Free 3D Hosting by Creating a <span style="color:blue">WalkTheWeb<sup>®</sup></span> Account (this page) OR you can host your own <span style="color:blue">WalkTheWeb<sup>®</sup></span> 3D Internet - FREE Open-Source 3D CMS Hosting Software - <a href='https://github.com/http3d/walktheweb' target='_blank'>Download Here</a>.<hr />
	<form id="walktheweb_form" method="post" action="admin.php?page=walktheweb_wtw3dhost">
		<div id="walktheweb_wtwusernew" style="display:block;visibility:visible;">
			<h2><span style="color:blue">WalkTheWeb<sup>®</sup></span> <?php _e( 'Create Acount', 'walktheweb' ); ?></h2><hr />
			<div class="walktheweb_label">Email</div>
			<div class="walktheweb_value"><input type="text" id="walktheweb_newemail" name="walktheweb_newemail" class="walktheweb_inputbig" value="" maxlength="255" autocomplete="email" /></div>
			<div class="walktheweb_clear"></div>
			<div class="walktheweb_label">Password</div>
			<div class="walktheweb_value"><input type="text" id="walktheweb_newpassword" name="walktheweb_newpassword" class="walktheweb_inputbig" value="" maxlength="255" autocomplete="new-password" /></div>
			<div class="walktheweb_label">Confirm Password</div>
			<div class="walktheweb_value"><input type="text" id="walktheweb_newpassword2" name="walktheweb_newpassword2" class="walktheweb_inputbig" value="" maxlength="255" autocomplete="new-password" /></div>
		</div>
		<div id="walktheweb_wtwuserlogin" style="display:none;visibility:hidden;">
			<h2><span style="color:blue">WalkTheWeb<sup>®</sup></span> <?php _e( 'Login', 'walktheweb' ); ?></h2><hr />
			<div class="walktheweb_label">Email</div>
			<div class="walktheweb_value"><input type="text" id="walktheweb_email" name="walktheweb_email" class="walktheweb_inputbig" value="" maxlength="255" autocomplete="email" /></div>
			<div class="walktheweb_clear"></div>
			<div class="walktheweb_label">Password</div>
			<div class="walktheweb_value"><input type="text" id="walktheweb_password" name="walktheweb_password" class="walktheweb_inputbig" value="" maxlength="255" autocomplete="new-password" /></div>
		</div>
		<div class="walktheweb_clear"></div>
		<div class="walktheweb_label">WooCommerce Key</div>
		<div class="walktheweb_value"><select id="walktheweb_wookeyid" name="walktheweb_wookeyid"><?php echo $ddlwookeys; ?></select></div>
		<div class="walktheweb_clear"></div>

		<div class="walktheweb_value">
		<input type="button" id="walktheweb_save" name="walktheweb_save" value="Save" onclick="walktheweb.submit('walktheweb_save');"  class="walktheweb_submit"/>
		<input type="button" id="walktheweb_cancel" name="walktheweb_cancel" value="Cancel" onclick="window.location.href='admin.php?page=walktheweb_3dhosts';" style="margin-left:20px;cursor:pointer;" />
		</div>
		<div class="walktheweb_clear"></div>
		<input type="submit" id="walktheweb_submit" name="walktheweb_submit" value="Submit" class="walktheweb_hide" />
		<input type="hidden" id="walktheweb_hostid" name="walktheweb_hostid" value="" />
		<input type="hidden" id="walktheweb_bval" name="walktheweb_bval" value="" />
		<input type="hidden" id="walktheweb_siteurl" name="walktheweb_siteurl" value="<?php echo $zsiteurl; ?>" />
		<input type="hidden" id="walktheweb_nonce" name="walktheweb_nonce" value="<?php echo $nonce; ?>" />
	</form>
	</div>
<?php
	} catch (Exception $e) {
		$WalkTheWeb->serror("wtw-pages-walktheweb_wtw3dhost.php = ".$e->getMessage());
	}
?>