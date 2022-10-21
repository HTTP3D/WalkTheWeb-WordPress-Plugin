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
	<h2><img src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/menuwtw.png" class="walktheweb_logo" \><?php _e( 'About', 'walktheweb' ); ?> <span style="color:blue">WalkTheWeb<sup>®</sup></span></h2><hr />
	<form id="walktheweb_form" method="post" action="admin.php?page=walktheweb_about">
		<iframe width="560" height="315" src="https://www.youtube.com/embed/hasgXlRelQI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		
		<div style='clear:both;'></div>
		<hr />
		<h3>Tutorials and Resources</h3>
		To create your own 3D Websites from scratch or options to create 3D Cities without WordPress,<br />
		www.walktheweb.com: <a href="https://www.walktheweb.com" target="_blank">https://www.walktheweb.com</a><br /><br />

		www.walktheweb.com Tutorials: <a href="https://www.walktheweb.com/knowledgebase_category/tutorials/" target="_blank">https://www.walktheweb.com/knowledgebase_category/tutorials/</a><br /><br />

		Download WalkTheWeb and host your own 3D Websites,<br />
		GitHub: <a href="https://github.com/HTTP3D/WalkTheWeb" target="_blank">https://github.com/HTTP3D/WalkTheWeb</a><br /><br />

		For support in downloading and hosting your own 3D Websites,<br />
		www.walktheweb.org: <a href="https://www.walktheweb.org/" target="_blank">https://www.walktheweb.org/</a><br /><br />

		For Video Tutorials and WalkTheWeb Walk-throughs,<br />
		YouTube: <a href="https://www.youtube.com/c/WalkTheWeb3d" target="_blank">https://www.youtube.com/c/WalkTheWeb3d</a><br /><br />
		
		<hr />
		<h3>Contact</h3>
		<b>HTTP3D Inc. - (DBA) WalkTheWeb</b><br />
		PO BOX 6547<br />
		San Diego, CA 92166<br /><br />

		Contact or ask Aaron questions on Discord: <a href="https://discord.gg/MW7MG2t" target="_blank">https://discord.gg/MW7MG2t</a><br /><br />
		
		Privacy Policy:<a href="https://www.walktheweb.com/privacy-policy/" target="_blank">https://www.walktheweb.com/privacy-policy/</a><br />
		End Users License Agreement: <a href="https://www.walktheweb.com/useragreement/" target="_blank">https://www.walktheweb.com/useragreement/</a><br />
		Refund Policy: <a href="https://www.walktheweb.com/refund-policy/" target="_blank">https://www.walktheweb.com/refund-policy/</a><br /><br /> 

		<hr />
		<h3>Social Media</h3>
		YouTube: <a href="https://www.youtube.com/c/WalkTheWeb3d" target="_blank">https://www.youtube.com/c/WalkTheWeb3d</a><br />
		Facebook: <a href="https://www.facebook.com/walktheweb/" target="_blank">https://www.facebook.com/walktheweb/</a><br />
		Twitter: <a href="https://twitter.com/WalkTheWeb" target="_blank">https://twitter.com/WalkTheWeb</a><br />
		LinkedIn: <a href="https://www.linkedin.com/in/walktheweb/" target="_blank">https://www.linkedin.com/in/walktheweb/</a><br />
		Instagram: <a href="https://www.instagram.com/walktheweb3d/" target="_blank">https://www.instagram.com/walktheweb3d/</a><br />
		Pinterest: <a href="https://www.pinterest.com/walktheweb/" target="_blank">https://www.pinterest.com/walktheweb/</a><br />
		TikTok: <a href="https://www.tiktok.com/@walktheweb" target="_blank">https://www.tiktok.com/@walktheweb</a><br />

		<input type="submit" id="walktheweb_submit" name="walktheweb_submit" value="Submit" class="walktheweb_hide" />
		<input type="hidden" id="walktheweb_bval" name="walktheweb_bval" value="" />
		<input type="hidden" id="walktheweb_nonce" name="walktheweb_nonce" value="<?php echo $nonce; ?>" />
	</form>
	</div>
<?php
	} catch (Exception $e) {
		$WalkTheWeb->serror("wtw-pages-walktheweb_3dhosts.php = ".$e->getMessage());
	}
?>
