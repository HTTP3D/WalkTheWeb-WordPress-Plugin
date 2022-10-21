<?php
	global $WalkTheWeb;
	try {
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$noncecheck = sanitize_key($_POST["walktheweb_nonce"]);
			if ($nonce == $noncecheck && !empty($noncecheck)) {

			}
		}
		$z3dhosts = $WalkTheWeb->functions->getHosts();
		$zcount = 0;
?>
	<div class="wrap">
		<h2><img src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/menuwtw.png" class="walktheweb_logo" \><?php _e( '3D Hosting', 'walktheweb' ); ?> 
			<div class="walktheweb_button" onclick="window.location.href='admin.php?page=walktheweb_add3dhost';"><?php _e( 'Add 3D Host', 'walktheweb' ); ?></div></h2><hr />
		<?php _e( '3D Hosts are Web Servers running <span style="color:blue">WalkTheWeb<sup>®</sup></span> 3D Internet - FREE Open-Source Metaverse Software - Installs in just seconds and works on any server that is capable of running WordPress. (PHP, JavaScript, and MySQL).', 'walktheweb' ); ?> <br /><br />
		<a href='https://github.com/http3d/walktheweb' target='_blank'>Download <b>WalkTheWeb Metaverse</b> here</a>.<br /><br />
		<a href="https://www.youtube.com/c/WalkTheWeb3d" target="_blank">Watch <b>WalkTheWeb Metaverse</b> Videos on YouTube</a>.
		<hr />
		<form id="walktheweb_form" method="post" action="admin.php?page=walktheweb_3dhosts">
			<div class="walktheweb_headerrow">
				<div class="walktheweb_col3"><strong><?php _e( '3D Host URL', 'walktheweb' ); ?></strong></div>
				<div class="walktheweb_col4"><strong><?php _e( 'WalkTheWeb Key', 'walktheweb' ); ?></strong></div>
				<div class="walktheweb_col6right"><strong><?php _e( 'Create Date', 'walktheweb' ); ?></strong></div>
				<div class="walktheweb_col6right">&nbsp;</div>
			</div>
<?php		foreach ($z3dhosts as $z3dhost) { ?>
				<div class="walktheweb_row">
					<div class="walktheweb_col3"><a href="<?php echo $z3dhost["hosturl"]; ?>" target="_blank"><?php echo $z3dhost["hosturl"]; ?></a></div>
					<div class="walktheweb_col4"><?php echo $z3dhost["wtwkeytext"]; ?></div>
					<div class="walktheweb_col6right"><?php echo $z3dhost["createdate"]; ?></div>
					<div class="walktheweb_col6right">
						<input type="button" id="walktheweb_apicheck-<?php echo str_replace("...","",$z3dhost["wtwkeytext"]); ?>" value="Checking" />
						<input type="hidden" id="walktheweb_hosturl-<?php echo str_replace("...","",$z3dhost["wtwkeytext"]); ?>" value="<?php echo $z3dhost["hosturl"]; ?>" />
						<input type="password" id="walktheweb_wtwkey-<?php echo str_replace("...","",$z3dhost["wtwkeytext"]); ?>" value="<?php echo $z3dhost["wtwkey"]; ?>" class="walktheweb_hide" />
						<input type="password" id="walktheweb_wtwsecret-<?php echo str_replace("...","",$z3dhost["wtwkeytext"]); ?>" value="<?php echo $z3dhost["wtwsecret"]; ?>" class="walktheweb_hide" />
					</div>
				</div>
<?php			$zcount += 1;
			} ?>
			<input type="submit" id="walktheweb_submit" name="walktheweb_submit" value="Submit" class="walktheweb_hide" />
			<input type="hidden" id="walktheweb_bval" name="walktheweb_bval" value="" />
			<input type="hidden" id="walktheweb_nonce" name="walktheweb_nonce" value="<?php echo $nonce; ?>" />
			<br /><br />
			<div id="walktheweb_noteapproval" class="walktheweb_hide"><?php _e( 'Waiting on Approval - Go to the 3D Host WalkTheWeb server, Logon as Admin, and in the Admin Menu under Settings select API Keys Access. Click Approved next to the App URL for this WordPress website.', 'walktheweb' ); ?></div>
		</form>
	</div>
<?php	if ($zcount > 0) {
			echo "<script>walktheweb.checkHosts();</script>";
		}
	} catch (Exception $e) {
		$WalkTheWeb->serror("wtw-pages-walktheweb_3dhosts.php = ".$e->getMessage());
	}
?>
