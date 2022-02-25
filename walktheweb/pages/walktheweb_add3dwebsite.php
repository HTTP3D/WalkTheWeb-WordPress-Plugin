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
	<h2><?php _e( 'Add 3D Website', 'walktheweb' ); ?></h2>
	<form id="walktheweb_form" method="post" action="admin.php?page=walktheweb_add3dwebsite">
		<div style='width:100%;'>
			<div style='border:1px solid black;background-color:white;width:90%;margin-top:0px;margin-bottom:20px;margin-left:auto;margin-right:auto;text-align:center;'>
<!--				<img src='/content/system/images/wtwlogo.png' /> -->
				<div id="wtw_selectwebform">
					<h3 class="walktheweb_icenter" style='margin-top:10px;'>Select Your 3D Community Scene</h3>
					<h3 style='display:inline;'><b>Keyword Search:</h3> <input id='walktheweb_tcommunitysearch' name='walktheweb_tcommunitysearch' type='text' value='' size='20' maxlength='255' />
					<input name='walktheweb_bcommunitysearch' type='button' value='Search' onclick="walktheweb.communitySearch(walktheweb.dGet('walktheweb_tcommunitysearch').value);" class='walktheweb_search' />
					<div class='walktheweb_iclear' style='min-height:20px;'></div>
					<hr />
					<div id='walktheweb_commsearchresults' style='margin-left:20px;text-align:left;'></div>
				</div>
				<div id="walktheweb_installprogress" class="walktheweb_ihide walktheweb_iprogresssection">
					<hr /><h3 class="walktheweb_icenter" style='margin-top:0px;'>Installing Your 3D Community Scene</h3>
					<div id="walktheweb_progresstext" class="walktheweb_iprogresstext">&nbsp;</div>
					<div class="walktheweb_iprogressdiv"><div id="walktheweb_progressbar" class="walktheweb_iprogressbar"></div></div>
				</div>
			</div><br />
		</div><br />
		<script>
			walktheweb.communitySearch('');
		</script>
		
		<input type="submit" id="walktheweb_submit" name="walktheweb_submit" value="Submit" class="walktheweb_ihide" />
		<input type="hidden" id="walktheweb_bval" name="walktheweb_bval" value="" />
		<input type="hidden" id="walktheweb_nonce" name="walktheweb_nonce" value="<?php echo $nonce; ?>" />
	</form>
	</div>
<?php
	} catch (Exception $e) {
		$WalkTheWeb->serror("wtw-pages-walktheweb_add3dwebsite.php = ".$e->getMessage());
	}
?>