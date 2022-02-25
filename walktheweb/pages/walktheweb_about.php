<?php
	global $WalkTheWeb;
	try {
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$noncecheck = sanitize_key($_POST["walktheweb_nonce"]);
			if ($nonce == $noncecheck && !empty($noncecheck)) {

			}
		}
?>
	<div class="wrap">
	<h2><?php _e( 'About', 'walktheweb' ); ?> <span style="color:blue">WalkTheWeb<sup>®</sup></span></h2><hr />
	<form id="walktheweb_form" method="post" action="admin.php?page=walktheweb_about">
		
		
		<input type="submit" id="walktheweb_submit" name="walktheweb_submit" value="Submit" />
		<input type="hidden" id="walktheweb_bval" name="walktheweb_bval" value="" />
		<input type="hidden" id="walktheweb_nonce" name="walktheweb_nonce" value="<?php echo $nonce; ?>" />
	</form>
	</div>
<?php
	} catch (Exception $e) {
		$WalkTheWeb->serror("wtw-pages-walktheweb_3dhosts.php = ".$e->getMessage());
	}
?>
