<?php
	global $WalkTheWeb;
	try {
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$noncecheck = sanitize_key($_POST["walktheweb_nonce"]);
			if ($nonce == $noncecheck && !empty($noncecheck)) {

			}
		}
		$z3dcommunities = $WalkTheWeb->functions->getCommunities();
?>
	<div class="wrap">
		<h2><?php _e( '3D Websites', 'walktheweb' ); ?> 
			<div class="walktheweb_button" onclick="window.location.href='admin.php?page=walktheweb_dashboard&createsite=1';">Add 3D Website</div></h2><hr />
		<span style="color:blue">WalkTheWeb<sup>®</sup></span> 3D Websites are 3D Community Scenes that can have one or more 3D Stores to make Outdoor Malls!<br /><br />
		Start your own 3D Metaverse in just seconds!<hr />
		<form id="walktheweb_form" method="post" action="admin.php?page=walktheweb_3dwebsites">
			<div class="walktheweb_headerrow">
				<div class="walktheweb_col3"><strong><?php _e( '3D Website URL', 'walktheweb' ); ?></strong></div>
				<div class="walktheweb_col3"><strong><?php _e( '3D Building URL', 'walktheweb' ); ?></strong></div>
				<div class="walktheweb_col6right"><strong><?php _e( 'WooCommerce Key', 'walktheweb' ); ?></strong></div>
				<div class="walktheweb_col6right"><strong><?php _e( 'Create Date', 'walktheweb' ); ?></strong></div>
			</div>
<?php		foreach ($z3dcommunities as $z3dcommunity) { ?>
				<div class="walktheweb_row">
					<div class="walktheweb_col3"><a href="<?php echo $z3dcommunity["websiteurl"]; ?>" target="_blank"><?php echo $z3dcommunity["websiteurl"]; ?></a></div>
					<div class="walktheweb_col3"><a href="<?php echo $z3dcommunity["domainurl"]."/buildings/".$z3dcommunity["webname"]; ?>" target="_blank"><?php echo $z3dcommunity["domainurl"]."/buildings/".$z3dcommunity["webname"]; ?></a></div>
					<div class="walktheweb_col6right"><?php echo $z3dcommunity["wookeytext"]; ?></div>
					<div class="walktheweb_col6right"><?php echo $z3dcommunity["createdate"]; ?></div>
				</div>
<?php		} ?>
			<input type="submit" id="walktheweb_submit" name="walktheweb_submit" value="Submit" class="walktheweb_hide" />
			<input type="hidden" id="walktheweb_bval" name="walktheweb_bval" value="" />
			<input type="hidden" id="walktheweb_nonce" name="walktheweb_nonce" value="<?php echo $nonce; ?>" />
		</form>
	</div>
<?php
	} catch (Exception $e) {
		$WalkTheWeb->serror("wtw-pages-walktheweb_3dwebsites.php = ".$e->getMessage());
	}
?>
