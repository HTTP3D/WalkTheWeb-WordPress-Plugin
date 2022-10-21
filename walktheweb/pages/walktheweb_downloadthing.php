<?php
	global $WalkTheWeb;
	try {
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$noncecheck = sanitize_key($_POST["walktheweb_nonce"]);
			if ($nonce == $noncecheck && !empty($noncecheck)) {

			}
		}
?>
	<form id="walktheweb_form2" method="post" action="?nonce=<?php /* echo $znonce; */ ?>">
		<input id='walktheweb_tcols' name='walktheweb_tcols' type='hidden' value='2' />
		<input id='walktheweb_twebid' name='walktheweb_twebid' type='hidden' value='' />
		<input id='walktheweb_twebtype' name='walktheweb_twebtype' type='hidden' value='thing' />
		<div class="wrap walktheweb_div" style="vertical-align:top;">
			<h2 style="float:left;margin-top:0px;"><img src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/menuwtw.png" class="walktheweb_logo" \>WalkTheWeb <?php _e('Downloads', 'walktheweb' ); ?></h2>
			<div class="walktheweb_searchdiv">
				<div class="walktheweb_searchlabel"><?php _e('Search:', 'walktheweb' ); ?></div> <input id='walktheweb_tsearch' name='walktheweb_tsearch' type='text' value='' size='20' maxlength='255' class="walktheweb_textbox" autocomplete="" /> 
				<input name='walktheweb_bsearch' type='button' value='Search' onclick="walktheweb_d.search(document.getElementById('walktheweb_tsearch').value, 'thing');" class="walktheweb_searchbutton" /><div style='min-height:20px;clear:both;'></div>			
			</div>
			<div class="walktheweb_searchdiv">
				<div class="walktheweb_colicons">
					<img id="walktheweb_col1" src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/col1.png" alt="1 Column" title="1 Column" class="walktheweb_tinyimg" onclick="walktheweb_d.updateCols(this, 1);" />
					<img id="walktheweb_col2" src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/col2set.png" alt="2 Columns" title="2 Columns" class="walktheweb_tinyimgselected" onclick="walktheweb_d.updateCols(this, 2);" />
					<img id="walktheweb_col3" src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/col3.png" alt="3 Columns" title="3 Columns" class="walktheweb_tinyimg" onclick="walktheweb_d.updateCols(this, 3);" />
					<img id="walktheweb_col4" src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/col4.png" alt="4 Columns" title="4 Columns" class="walktheweb_tinyimg" onclick="walktheweb_d.updateCols(this, 4);" />
				</div>
			</div>
			<div class="walktheweb_searchdiv">
				<div class="walktheweb_colicons">
					<img id="walktheweb_community1" src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/community.png" alt="3D Communities" title="3D Communities" class="walktheweb_tinyimg" onclick="window.location.href='<?php echo $zsiteurl; ?>/wp-admin/admin.php?page=walktheweb_downloadcommunity';" />
					<img id="walktheweb_building1" src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/building.png" alt="3D Buildings" title="3D Buildings" class="walktheweb_tinyimg" onclick="window.location.href='<?php echo $zsiteurl; ?>/wp-admin/admin.php?page=walktheweb_downloadbuilding';" />
					<img id="walktheweb_thing1" src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/thing2.png" alt="3D Things" title="3D Things" class="walktheweb_tinyimgselected" />
					<img id="walktheweb_avatar1" src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/avatar.png" alt="3D Avatars" title="3D Avatars" class="walktheweb_tinyimg" onclick="window.location.href='<?php echo $zsiteurl; ?>/wp-admin/admin.php?page=walktheweb_downloadavatar';" />
				</div>
			</div>
			<div style="clear:both;">
				<hr />
				<div id="walktheweb_confirm" class="walktheweb_confirm" style="display:none;visibility:hidden;">
					<div id="walktheweb_previewdiv">
						<img id="walktheweb_preview" src="" class="walktheweb_preview" />
						<div>
							<div id="walktheweb_title" style="font-weight:bold;"></div>
							<div id="walktheweb_desc"></div>
							<div id="walktheweb_author"></div>
							<div id="walktheweb_date"></div>
						</div>
						<div style="clear:both;"></div><hr />
						<b><?php _e('Enter your WalkTheWeb Server URL to receive the download', 'walktheweb' ); ?>:</b><br /><br />
						<input id='walktheweb_twebsite' name='walktheweb_twebsite' type='text' value='' size='50' maxlength='255' class="walktheweb_textboxwider" autocomplete="" /><br /><br />
						<input name='walktheweb_bcanceldownload' type='button' value='Cancel' onclick="walktheweb_d.hide('walktheweb_confirm');" class="walktheweb_searchbutton" />
						<input name='walktheweb_bconfirmdownload' type='button' value='Confirm Download' onclick="walktheweb_d.downloadWeb();" class="walktheweb_searchbutton" style="width:auto;" /><div style='min-height:20px;clear:both;'></div>
					</div>
					<div id="walktheweb_success" class="walktheweb_success"></div>
					* <?php _e('All Downloads require Admin or Host Access on your WalkTheWeb Server to complete. Log onto your WalkTheWeb Server and view your Admin Dashboard to complete the Download.', 'walktheweb' ); ?><br /><br /><?php _e('Note that you have Host access on https://3d.walktheweb.com when you create your first 3D Website.', 'walktheweb' ); ?>
				</div>
				<div id="walktheweb_searchresults" class="wtw_top"></div>
				<div style="clear:both;"></div><br /><br />
			</div>
		</div>
	</form>
	<script>
		window.onload = function() {
			walktheweb_d.search('', 'thing');
		}
	</script>
<?php	
	} catch (Exception $e) {
		$WalkTheWeb->serror("wtw-pages-walktheweb_downloadthing.php = ".$e->getMessage());
	}
?>
