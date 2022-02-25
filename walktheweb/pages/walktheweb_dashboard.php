<?php
	global $WalkTheWeb;
	global $wpdb;
	try {
		$z3dhosts = $WalkTheWeb->functions->getHosts();
		$zcount = 0;
		
		echo "<script>walktheweb.imagepath = \"".esc_url(site_url())."/wp-content/plugins/walktheweb/assets/images/\";</script>";
		
		if ($_SERVER['REQUEST_METHOD']=='POST') {
?>
			
	<div class="wrap">
		<h2><span style="color:blue">WalkTheWeb<sup>®</sup></span> <?php _e( 'Dashboard', 'walktheweb' ); ?></h2><hr />			
		<div id="walktheweb_newwebsitedev" class="walktheweb_dashboardpage">
			<h2 class="walktheweb_dashboardheading"><?php _e('Your New 3D Shopping Website', 'walktheweb' ); ?></h2>
			<div class="walktheweb_bold"><?php _e('Welcome to', 'walktheweb' ); ?> WalkTheWeb 3D Internet!<br /><br /></div><div style="clear:both;"></div>
			<a id="walktheweb_visitwebsite" href="<?php echo $walktheweb_data["websiteurl"]; ?>" class="walktheweb_createbutton" target="_blank"><?php _e('Visit your New 3D Shopping Website!', 'walktheweb' ); ?></a>
			<div style="clear:both;"></div>
			<div style="text-align:center;max-width:500px;margin: 10px auto 10px auto;">
				
				<div class="walktheweb_loginlabel"><?php _e('Hosted At', 'walktheweb' ); ?></div><div><?php echo $walktheweb_data["hostname"]; ?></div><div style="clear:both;"></div>

				<div class="walktheweb_loginlabel"><?php _e('Store Name', 'walktheweb' ); ?></div><div><?php echo $walktheweb_data["storename"]; ?></div><div style="clear:both;"></div>

				<div class="walktheweb_loginlabel"><?php _e('3D Communty', 'walktheweb' ); ?></div><div><?php echo $walktheweb_data["communityname"]."<br /><a href='".$walktheweb_data["hostname"]."/".$walktheweb_data["webname"]."' target='_blank'>".$walktheweb_data["hostname"]."/".$walktheweb_data["webname"]."</a>"; ?></div><div style="clear:both;"></div><br />

				<div class="walktheweb_loginlabel"><?php _e('3D Building', 'walktheweb' ); ?></div><div><?php echo $walktheweb_data["buildingname"]."<br /><a href='".$walktheweb_data["hostname"]."/buildings/".$walktheweb_data["webname"]."' target='_blank'>".$walktheweb_data["hostname"]."/buildings/".$walktheweb_data["webname"]."</a>"; ?></div><div style="clear:both;"></div><br />

				<div class="walktheweb_loginbutton" onclick="walktheweb.openDashboard();"><div style="margin-top:10px;"><?php _e('Back to Dashboard', 'walktheweb' ); ?></div></div>
				<div style="clear:both;"></div>
				
			</div>
		</div>
	</div>	
<?php
		} else {
			echo "<script>var walktheweb_wookeys = ".json_encode($walktheweb_wookeys).";</script>";?>
	<div class="wrap">
	<h2><span style="color:blue">WalkTheWeb<sup>®</sup></span> <?php _e( 'Dashboard', 'walktheweb' ); ?></h2><hr />
<?php 		if (esc_attr($walktheweb_wooactive) == '0') { ?>
		<div id="walktheweb_requireswoocommerce" class="walktheweb_woocommercerequired">
			<div><?php _e( 'This plugin will allow you to create 3D Game Websites, but 3D Shopping Websites require you to install and activate the plugin for', 'walktheweb' ); ?> <a href="<?php echo esc_url(site_url()); ?>/wp-admin/plugin-install.php?s=woocommerce&tab=search&type=term">WooCommerce</a>.<br /></div>
		</div>
<?php		} ?>
		<div id="walktheweb_dashboard">
			<div id="walktheweb_dashboardboxhome" class="walktheweb_dashboardboxhome">
				<div class="walktheweb_createbutton" onclick="walktheweb.startWizard(1, 'woocommerce');" style="float:left;margin-left:30px;"><?php _e('Create a', 'walktheweb' ); ?><br /><strong><?php _e('3D Shopping Website', 'walktheweb' ); ?></strong></div>
				<div style="clear:both;"></div>
				<div id="walktheweb_dashboardboxtext" class="walktheweb_dashboardboxtext"></div>
			</div>
		</div>
		<div id="walktheweb_wizard" style="display:none;visibility:hidden;">
			<div id="walktheweb_wizardstep1">
				<?php _e('Step 1', 'walktheweb' ); ?><br />
				<?php _e('3D Store', 'walktheweb' ); ?>
			</div><div class="walktheweb_wizardstepdivider"><br />&#8594;</div>
			<div id="walktheweb_wizardstep2">
				<?php _e('Step 2', 'walktheweb' ); ?><br />
				<?php _e('3D Scene', 'walktheweb' ); ?>
			</div><div class="walktheweb_wizardstepdivider"><br />&#8594;</div>
			<div id="walktheweb_wizardstep3">
				<?php _e('Step 3', 'walktheweb' ); ?><br />
				<?php _e('3D Hosting', 'walktheweb' ); ?>
			</div><div class="walktheweb_wizardstepdivider"><br />&#8594;</div>
			<div id="walktheweb_wizardstep4">
				<?php _e('Step 4', 'walktheweb' ); ?><br />
				<?php _e('Permissions', 'walktheweb' ); ?>
			</div><div class="walktheweb_wizardstepdivider"><br />&#8594;</div>
			<div id="walktheweb_wizardstep5">
				<?php _e('Step 5', 'walktheweb' ); ?><br />
				<?php _e('Create it!', 'walktheweb' ); ?>
			</div>
			<div style="clear:both;"></div>
			<div id="walktheweb_wizard1" class="walktheweb_dashboardpage" style="display:none;visibility:hidden;">
				<div id="walktheweb_step1_0" class="walktheweb_navbuttonback" onclick="" style="visibility:hidden;">&#8592; <?php _e('Back', 'walktheweb' ); ?></div>
				<div id="walktheweb_step1_2" class="walktheweb_navbuttonnext" onclick="walktheweb.startWizard(2,'');" style="visibility:hidden;"><?php _e('Next', 'walktheweb' ); ?> &#8594;</div>
				<h2 class="walktheweb_dashboardheading"><?php _e('Step 1', 'walktheweb' ); ?> - <?php _e('Select a 3D Store Building', 'walktheweb' ); ?></h2>
				<div class="walktheweb_searchlabel"><?php _e('Search:', 'walktheweb' ); ?></div> <input id='walktheweb_tbuildingsearch' name='walktheweb_tbuildingsearch' type='text' value='' size='20' maxlength='255' class="walktheweb_textbox" autocomplete="" /> 
				<input name='walktheweb_bbuildingsearch' type='button' value='Search' onclick="walktheweb.buildingSearch();" class="walktheweb_searchbutton" /><div style='min-height:20px;clear:both;'></div><hr />
				<div id="walktheweb_buildtempsearchresults"></div>
				<div style="clear:both;"></div><br /><br />
				<div id="walktheweb_step1_0b" class="walktheweb_navbuttonback" onclick="" style="visibility:hidden;">&#8592; <?php _e('Back', 'walktheweb' ); ?></div>
				<div id="walktheweb_step1_2b" class="walktheweb_navbuttonnext" onclick="walktheweb.startWizard(2,'');" style="visibility:hidden;"><?php _e('Next', 'walktheweb' ); ?> &#8594;</div>
				<div style="clear:both;"></div>
			</div>
			<div id="walktheweb_wizard2" class="walktheweb_dashboardpage" style="display:none;visibility:hidden;">
				<div id="walktheweb_step2_1" class="walktheweb_navbuttonback" onclick="walktheweb.startWizard(1,'woocommerce');">&#8592; <?php _e('Back', 'walktheweb' ); ?></div>
				<div id="walktheweb_step2_3" class="walktheweb_navbuttonnext" onclick="walktheweb.startWizard(3,'');" style="visibility:hidden;"><?php _e('Next', 'walktheweb' ); ?> &#8594;</div>
				<h2 class="walktheweb_dashboardheading"><?php _e('Step 2', 'walktheweb' ); ?> - <?php _e('Select a 3D Community Scene', 'walktheweb' ); ?></h2>
				<div class="walktheweb_searchlabel"><?php _e('Search:', 'walktheweb' ); ?></div> <input id='walktheweb_tcommunitysearch' name='walktheweb_tcommunitysearch' type='text' value='' size='20' maxlength='255' class="walktheweb_textbox" autocomplete="" /> 
				<input name='walktheweb_bcommunitysearch' type='button' value='Search' onclick="walktheweb.communitySearch();" class="walktheweb_searchbutton" /><div style='min-height:20px;clear:both;'></div><hr />
				<div id="walktheweb_communitytempsearchresults"></div>
				<div style="clear:both;"></div><br /><br />
				<div id="walktheweb_step2_1b" class="walktheweb_navbuttonback" onclick="walktheweb.startWizard(1,'woocommerce');">&#8592; <?php _e('Back', 'walktheweb' ); ?></div>
				<div id="walktheweb_step2_3b" class="walktheweb_navbuttonnext" onclick="walktheweb.startWizard(3,'');" style="visibility:hidden;"><?php _e('Next', 'walktheweb' ); ?> &#8594;</div>
				<div style="clear:both;"></div>
			</div>
			<div id="walktheweb_wizard3" class="walktheweb_dashboardpage" style="display:none;visibility:hidden;">
				<div id="walktheweb_step3_2" class="walktheweb_navbuttonback" onclick="walktheweb.saveWebsiteSettings();walktheweb.startWizard(2,'woocommerce');">&#8592; <?php _e('Back', 'walktheweb' ); ?></div>
				<div id="walktheweb_step3_4" class="walktheweb_navbuttonnext" onclick="walktheweb.saveWebsiteSettings();walktheweb.startWizard(4,'');" style="visibility:hidden;"><?php _e('Next', 'walktheweb' ); ?> &#8594;</div>
				<h2 class="walktheweb_dashboardheading"><?php _e('Step 3', 'walktheweb' ); ?> - <?php _e('Select a 3D Hosting Service', 'walktheweb' ); ?></h2>

				<div id="walktheweb_sitediv" class="walktheweb_host" style="display:none;visibility:hidden;">
					<h2 class="walktheweb_dashboardheading"><?php _e('3D Website Settings', 'walktheweb' ); ?></h2>
					<div style="text-align:center;">
						<div class="walktheweb_bold">
							<?php _e('Select Your 3D Website URL Path', 'walktheweb' ); ?><br /><br />
						</div><div style="clear:both;"></div>
					</div>
					<div style="text-align:left;">
						<div class="walktheweb_loginlabel"><?php _e('3D Website URL', 'walktheweb' ); ?></div>
						<div style="display:inline;margin:0px 0px 20px 0px;"><?php _e('3D Websites use names under the 3D Host. You can change the name and select the <b>Check Availability</b> button.', 'walktheweb' ); ?><br /><div style="color:green;"><?php _e('Outline in Green means available.', 'walktheweb' ); ?></div></div>
						<div style="clear:both;"></div>
						<div style="text-align:center;">
							<div><div id="walktheweb_hosturl" class="walktheweb_hosturl">https://3d.walktheweb.com/</div><input type="text" id="walktheweb_webname" name="walktheweb_webname" class="walktheweb_textbox" maxlength="255" value="<?php echo $walktheweb_domainroot; ?>" onkeyup="walktheweb.resetWebname();" /></div><div style="clear:both;"></div>
							<div id="walktheweb_availability_error" style="color:red;font-weight:bold;margin-left:auto;margin-right:auto;"></div>
							<div id="walktheweb_availability" class="walktheweb_loginbutton" onclick="walktheweb.checkWebname();" style="margin-left:auto;margin-right:auto;"><img src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/menuwtw.png" alt="WalkTheWeb" title="WalkTheWeb" class="walktheweb_loginlogo"/><div style="margin-top:10px;"><?php _e('Check Availability', 'walktheweb' ); ?></div></div>

							<div style="clear:both;"></div>
						</div>
						<div class="walktheweb_loginlabel"><?php _e('3D Store Name', 'walktheweb' ); ?></div><div style="display:inline;margin:0px 0px 20px 0px;"><input type="text" id="walktheweb_tstorename" class="walktheweb_textbox" maxlength="255" value="<?php echo $walktheweb_storename; ?>" style="width:350px;"/><br /><?php _e('The 3D Store Name will be displayed on the 3D Store Building where applicable.', 'walktheweb' ); ?></div><div style="clear:both;"></div><br /><br />
						
						<div id="walktheweb_savewebsite" class="walktheweb_loginbutton" onclick="walktheweb.saveWebsiteSettings();walktheweb.startWizard(4,'');" style="margin-left:auto;margin-right:auto;"><img src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/menuwtw.png" alt="WalkTheWeb" title="WalkTheWeb" class="walktheweb_loginlogo"/><div style="margin-top:10px;"><?php _e('Save and Continue', 'walktheweb' ); ?></div></div>
					</div>
				</div>

				<div style="clear:both;"></div><br /><br />

				<div id="walktheweb_hostingbox" class="walktheweb_hostingbox" style="width:96%;">
					<div id="walktheweb_host-">
						<input type='button' id="walktheweb_hosting" class='walktheweb_searchresultbutton' value='Select' onclick="walktheweb.selectWalkTheWebHosting('https://3d.walktheweb.com','');" />
						<div><h4><span style="color:blue">WalkTheWeb<sup>®</sup></span> <?php _e('Free 3D Website Hosting.', 'walktheweb' ); ?></h4> <?php _e('Includes all of the essentials required to operate and manage a 3D Website. You will have opportunities to purchase additional services that can further enhance your 3D Website Experience.', 'walktheweb' ); ?></div>
					</div>
<?php		foreach ($z3dhosts as $z3dhost) { ?>
					<div id="walktheweb_host-<?php echo str_replace("...","",$z3dhost["wtwkeytext"]); ?>" class="walktheweb_rowtop">
						<input type='button' id="walktheweb_hosting-<?php echo str_replace("...","",$z3dhost["wtwkeytext"]); ?>" class='walktheweb_searchresultbutton' value='Select' onclick="walktheweb.selectWalkTheWebHosting('<?php echo $z3dhost["hosturl"]; ?>', '<?php echo str_replace("...","",$z3dhost["wtwkeytext"]); ?>');" />
						<div class="walktheweb_col2"><h4><span style="color:blue"><?php _e('3D Host at:', 'walktheweb' ); ?></span> <?php echo $z3dhost["hosturl"]; ?></h4> <?php _e('Self hosted WalkTheWeb 3D Internet Server', 'walktheweb' ); ?></div>
						<div class="walktheweb_col4">
							<input type="button" id="walktheweb_apicheck-<?php echo str_replace("...","",$z3dhost["wtwkeytext"]); ?>" value="Checking" />
							<input type="hidden" id="walktheweb_hosturl-<?php echo str_replace("...","",$z3dhost["wtwkeytext"]); ?>" value="<?php echo $z3dhost["hosturl"]; ?>" />
							<input type="password" id="walktheweb_wtwkey-<?php echo str_replace("...","",$z3dhost["wtwkeytext"]); ?>" value="<?php echo $z3dhost["wtwkey"]; ?>" class="walktheweb_hide" />
							<input type="password" id="walktheweb_wtwsecret-<?php echo str_replace("...","",$z3dhost["wtwkeytext"]); ?>" value="<?php echo $z3dhost["wtwsecret"]; ?>" class="walktheweb_hide" />
						</div>
					</div>
<?php			$zcount += 1;
			} ?>
				</div>


				<div id="walktheweb_step3_2b" class="walktheweb_navbuttonback" onclick="walktheweb.saveWebsiteSettings();walktheweb.startWizard(2,'');">&#8592; <?php _e('Back', 'walktheweb' ); ?></div>
				<div id="walktheweb_step3_4b" class="walktheweb_navbuttonnext" onclick="walktheweb.saveWebsiteSettings();walktheweb.startWizard(4,'');" style="visibility:hidden;"><?php _e('Next', 'walktheweb' ); ?> &#8594;</div>
				<div style="clear:both;"></div>
			</div>
			<div id="walktheweb_wizard4" class="walktheweb_dashboardpage" style="display:none;visibility:hidden;">
				<div id="walktheweb_step4_3" class="walktheweb_navbuttonback" onclick="walktheweb.startWizard(3,'');">&#8592; <?php _e('Back', 'walktheweb' ); ?></div>
				<div id="walktheweb_step4_5" class="walktheweb_navbuttonnext" onclick="walktheweb.startWizard(5,'');" style="visibility:hidden;"><?php _e('Next', 'walktheweb' ); ?> &#8594;</div>
				<h2 class="walktheweb_dashboardheading"><?php _e('Step 4', 'walktheweb' ); ?> - <?php _e('Permissions', 'walktheweb' ); ?></h2>

				<div id="walktheweb_hostlogindiv" class="walktheweb_login" style="display:none;visibility:hidden;">
					<h2 class="walktheweb_dashboardheading"><?php _e('3D Host Login', 'walktheweb' ); ?></h2>
					<div style="text-align:center;">
						<div class="walktheweb_bold">
							<?php _e('This is your WalkTheWeb Hosted 3D Website Login.', 'walktheweb' ); ?><br /><br />
						</div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel"><?php _e('Email', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_thostemail" autocomplete="email" class="walktheweb_textbox" maxlength="255" /></div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel"><?php _e('Password', 'walktheweb' ); ?></div><div><input type="password" id="walktheweb_thostpassword" autocomplete="current-password" class="walktheweb_textbox" maxlength="255" /></div><div style="clear:both;"></div>
						<div id="walktheweb_hostloginerrortext" class="walktheweb_errortext">&nbsp;</div><br />
						<div class="walktheweb_loginbutton" onclick="walktheweb.hostLogin();" style="margin-left:auto;margin-right:auto;"><img src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/menuwtw.png" alt="WalkTheWeb" title="WalkTheWeb" class="walktheweb_loginlogo"/><div style="margin-top:10px;"><?php _e('Login', 'walktheweb' ); ?></div></div>
					</div>
				</div>
				<div id="walktheweb_logindiv" class="walktheweb_login" style="display:none;visibility:hidden;">
					<h2 class="walktheweb_dashboardheading"><span style="color:blue">WalkTheWeb<sup>®</sup></span> <?php _e('Login', 'walktheweb' ); ?></h2>
					<div style="text-align:center;">
						<div class="walktheweb_bold">
							<?php _e('This is your 3D Shopping Website Login.', 'walktheweb' ); ?><br /><?php _e('Login or click Create Login', 'walktheweb' ); ?><br /><br />
						</div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel"><?php _e('Email', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_temail" autocomplete="email" class="walktheweb_textbox" maxlength="255" /></div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel"><?php _e('Password', 'walktheweb' ); ?></div><div><input type="password" id="walktheweb_tpassword" autocomplete="current-password" class="walktheweb_textbox" maxlength="255" /></div><div style="clear:both;"></div>
						<div id="walktheweb_loginerrortext" class="walktheweb_errortext">&nbsp;</div><br />
						<div class="walktheweb_loginbutton" onclick="walktheweb.login();" style="margin-left:auto;margin-right:auto;"><img src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/menuwtw.png" alt="WalkTheWeb" title="WalkTheWeb" class="walktheweb_loginlogo"/><div style="margin-top:10px;"><?php _e('Login', 'walktheweb' ); ?></div></div>
						<div class="walktheweb_logincancel" onclick="walktheweb.createLogin();" style="margin-left:auto;margin-right:auto;"><?php _e('Create Login', 'walktheweb' ); ?></div>
						<div class="walktheweb_logincancel" onclick="walktheweb.showRecoverPassword();" style="width:220px;"><?php _e('Forgot Password?', 'walktheweb' ); ?></div>
					</div>
				</div>
				<div id="walktheweb_registerdiv" class="walktheweb_login" style="display:none;visibility:hidden;">
					<h2 class="walktheweb_dashboardheading"><span style="color:blue">WalkTheWeb<sup>®</sup></span> <?php _e('Create Login', 'walktheweb' ); ?></h2>
					<div style="text-align:center;">
						<div class="walktheweb_bold">
							<?php _e('This is your 3D Shopping Website Login.', 'walktheweb' ); ?><br /><br />
						</div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel"><?php _e('Email', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_tnewemail" autocomplete="email" class="walktheweb_textbox" maxlength="256" /></div><div style="clear:both;"></div>
	
						<div class="walktheweb_loginlabelwidth">&nbsp;</div>
						<div id="walktheweb_passwordstrengthdiv"><input type="text" id="walktheweb_tpasswordstrength" class="walktheweb_textbox" style="visibility:hidden;padding:5px;border-radius:10px;" autocomplete="" /></div><div style="clear:both;"></div>
	
						<div class="walktheweb_loginlabel"><?php _e('Password', 'walktheweb' ); ?></div><div><input type="password" id="walktheweb_tnewpassword" autocomplete="new-password" class="walktheweb_textbox" maxlength="256" onkeyup="walktheweb.checkPassword(this,'walktheweb_tpasswordstrength');walktheweb.checkPasswordConfirm('walktheweb_tnewpassword', 'walktheweb_tnewpassword2', 'walktheweb_registererrortext');" onfocus="walktheweb.registerPasswordFocus();" onblur="walktheweb.registerPasswordBlur();" /></div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel"><?php _e('Confirm Password', 'walktheweb' ); ?></div><div><input type="password" id="walktheweb_tnewpassword2" autocomplete="new-password" class="walktheweb_textbox" maxlength="256" onkeyup="walktheweb.checkPasswordConfirm('walktheweb_tnewpassword', 'walktheweb_tnewpassword2', 'walktheweb_registererrortext');" /></div><div style="clear:both;"></div>
						
						<hr /><a id="walktheweb_optionalprofile" onclick="walktheweb.toggleOptionalProfile()" class="walktheweb_lightlink">--- <?php _e('Click for Optional Profile', 'walktheweb' ); ?> ---</a><hr />
						<div id="walktheweb_optionalprofilediv" style="display:none;visibility:hidden;">
							<div class="walktheweb_loginlabel"><?php _e('Display Name', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_tnewdisplayname" autocomplete="nickname" class="walktheweb_textbox" maxlength="64" /></div><div style="clear:both;"></div>
							<div class="walktheweb_loginlabel"><?php _e('First Name', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_tnewfirstname" autocomplete="given-name" class="walktheweb_textbox" maxlength="64" /></div><div style="clear:both;"></div>
							<div class="walktheweb_loginlabel"><?php _e('Last Name', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_tnewlastname" autocomplete="family-name" class="walktheweb_textbox" maxlength="64" /></div><div style="clear:both;"></div>
							<div class="walktheweb_loginlabel"><?php _e('Gender', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_tnewgender" autocomplete="sex" class="walktheweb_textbox" maxlength="64" /></div><div style="clear:both;"></div>
							<div class="walktheweb_loginlabel"><?php _e('Date of Birth', 'walktheweb' ); ?> (mm/dd/yyyy)</div><div><input type="text" id="walktheweb_tnewdob" autocomplete="bday" class="walktheweb_textbox" maxlength="64" /></div><div style="clear:both;"></div>
						</div>
						<div id="walktheweb_registererrortext" class="walktheweb_errortext">&nbsp;</div><br />
						<div class="walktheweb_loginbutton" onclick="walktheweb.createAccount();" style="margin-left:auto;margin-right:auto;"><img src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/menuwtw.png" alt="WalkTheWeb" title="WalkTheWeb" class="walktheweb_loginlogo"/><div style="margin-top:10px;"><?php _e('Create Login', 'walktheweb' ); ?></div></div>
						<div class="walktheweb_logincancel" onclick="walktheweb.showLogin();" style="margin-left:auto;margin-right:auto;"><?php _e('Cancel', 'walktheweb' ); ?></div>

					</div>
				</div>
				<div id="walktheweb_resetpassworddiv" class="walktheweb_login" style="display:none;visibility:hidden;">
					<h2 class="walktheweb_dashboardheading"><span style="color:blue">WalkTheWeb<sup>®</sup></span> <?php _e('Reset Password', 'walktheweb' ); ?></h2>
					<div style="text-align:center;">
						<div class="walktheweb_bold">
							<?php _e('This is your 3D Shopping Website Login.', 'walktheweb' ); ?><br /><br />
						</div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel"><?php _e('Email', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_temailrecover" class="walktheweb_textbox" value="" autocomplete="email" /></div><div style="clear:both;"></div>
						<div id="walktheweb_reseterrortext" class="walktheweb_errortext">&nbsp;</div><br />
						<div class="walktheweb_loginbutton" onclick="walktheweb.passwordReset();" style="margin-left:auto;margin-right:auto;"><img src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/menuwtw.png" alt="WalkTheWeb" title="WalkTheWeb" class="walktheweb_loginlogo"/><div style="margin-top:10px;"><?php _e('Reset My Password', 'walktheweb' ); ?></div></div>						
						<div class="walktheweb_logincancel" onclick="walktheweb.showLogin();" style="margin-left:auto;margin-right:auto;"><?php _e('Cancel', 'walktheweb' ); ?></div>
					</div>
				</div>
				<div id="walktheweb_loggedindiv" class="walktheweb_login" style="display:none;visibility:hidden;">
					<h2 class="walktheweb_dashboardheading"><span style="color:blue">WalkTheWeb<sup>®</sup></span> <?php _e('Logged In Account', 'walktheweb' ); ?></h2>
					<div style="text-align:center;">
						<div class="walktheweb_bold">
							<?php _e('This is your 3D Shopping Website Login.', 'walktheweb' ); ?><br /><br />
						</div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel"><?php _e('Email', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_temailloggedin" class="walktheweb_textbox" value="" /></div><div style="clear:both;"></div>
						<div class="walktheweb_loginbutton" onclick="walktheweb.logout();" style="margin-left:auto;margin-right:auto;"><img src="<?php echo WTW_PLUGIN_URL; ?>/assets/images/menuwtw.png" alt="WalkTheWeb" title="WalkTheWeb" class="walktheweb_loginlogo"/><div style="margin-top:10px;"><?php _e('Log Out', 'walktheweb' ); ?></div></div>
					</div>
				</div>

				<div id="walktheweb_woocommercediv" class="walktheweb_login" style="display:block;visibility:visible;">
					<h2 class="walktheweb_dashboardheading">WooCommerce <?php _e('Settings', 'walktheweb' ); ?></h2>
					<div style="text-align:center;">
						<div class="walktheweb_bold">
							<?php _e('Allow this site to share Product Information.', 'walktheweb' ); ?><br /><br />
						</div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel">WooCommerce <?php _e('Key', 'walktheweb' ); ?></div>
						<div id="walktheweb_selectedkeydiv" style="display:none;visibility:hidden;"><input type="text" id="walktheweb_tselectedkey" class="walktheweb_textbox" maxlength="255" />
							<div style="clear:both;"></div>
							<div class="walktheweb_editbutton" onclick="walktheweb.changeWooKey();"><?php _e('Edit', 'walktheweb' ); ?></div><div style="clear:both;"></div>
						</div>
						<div id="walktheweb_changekeydiv" style="display:inline;visibility:visible;">
							<div style="text-align:left;margin:0px 0px 5px 200px;">WooCommerce <?php _e('REST API Key allows your 3D Shopping Website to read product information. It only requires <b>READ</b> access.', 'walktheweb' ); ?></div>
							<div style="clear:both;"></div>
							<div class="walktheweb_loginbutton" onclick="walktheweb.addNewWooKey();"><div style="margin-top:10px;"><?php _e('Add a New Key Automatically', 'walktheweb' ); ?></div></div>
							<div style="clear:both;"></div>


<?php					if (count($walktheweb_wookeys) > 0) { ?>
							<div class="walktheweb_loginbutton" onclick="walktheweb.toggle('walktheweb_selectexistingkeydiv');"><div style="margin-top:10px;"><?php _e('Select an Existing Key', 'walktheweb' ); ?></div></div>
							<div style="clear:both;"></div>
							<div id="walktheweb_selectexistingkeydiv" style='display:none;visibility:hidden;'>
								<div style="text-align:left;margin:5px 5px 5px 10px;"><strong><?php _e('Select an Existing Key:', 'walktheweb' ); ?></strong> <select id="walktheweb_listwookeys" name="walktheweb_listwookeys">
									<option value='-1'>...</option>
<?php 								foreach ($walktheweb_wookeys as $walktheweb_key) {
										echo "<option value='".$walktheweb_key["keyid"]."'>".$walktheweb_key["description"]." (".$walktheweb_key["permissions"]." ...".$walktheweb_key["truncatedkey"].")</option>";
									} ?>
								</select></div>
								<div style="clear:both;"></div>
								<div class="walktheweb_loginlabel"><?php _e('Confirm Key', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_tconfirmkey" class="walktheweb_textbox" maxlength="255" onkeydown="walktheweb.addWooKey();" onblur="walktheweb.addWooKey();" /></div><div style="clear:both;"></div><?php _e('Enter the Key or use <b>Add a New Key Automatically</b> above.', 'walktheweb' ); ?><div style="clear:both;"></div>
								
							</div><br />
<?php					} ?>
							<a href="<?php echo $walktheweb_storeurl; ?>/wp-admin/admin.php?page=wc-settings&tab=advanced&section=keys" target="_blank"><?php _e('OR Manually Edit the WooCommerce Keys', 'walktheweb' ); ?></a>
						</div>
						<div style="clear:both;"></div>
					</div>
				</div>

				<div style="clear:both;"></div><br />

				<div id="walktheweb_advancedpathsdiv" class="walktheweb_login" style="display:none;visibility:hidden;">
					<h2 class="walktheweb_dashboardheading"><?php _e('WooCommerce Store Paths', 'walktheweb' ); ?></h2>
					<div style="text-align:center;">
						<div class="walktheweb_bold">
							<?php _e('Update the WooCommerce paths as necessary.', 'walktheweb' ); ?><br /><br />
						</div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel"><?php _e('Store URL', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_storeurltext" class="walktheweb_textbox" value="<?php echo esc_url($walktheweb_storeurl); ?>" disabled="true" /></div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel"><?php _e('Cart URL', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_storecarturl" name="walktheweb_storecarturl" class="walktheweb_textbox" value="<?php echo esc_url($walktheweb_carturl); ?>" /></div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel"><?php _e('Product Base URL', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_storeproducturl" name="walktheweb_storeproducturl" class="walktheweb_textbox" value="<?php echo esc_url($walktheweb_producturl); ?>" /></div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel">WooCommerce <?php _e('API URL', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_storewooapiurl" name="walktheweb_storewooapiurl" class="walktheweb_textbox" value="<?php echo esc_url($walktheweb_apiurl); ?>" /></div><div style="clear:both;"></div>
					</div>
				</div>

				<div id="walktheweb_advancedoptionsdiv" class="walktheweb_login" style="display:none;visibility:hidden;">
					<h2 class="walktheweb_dashboardheading"><?php _e('Advanced Options', 'walktheweb' ); ?></h2>
					<div style="text-align:left;">
						<?php _e('<b>Most cases keep all items below checked.</b> These settings are for advanced users that may have other plugins managing the same resources.', 'walktheweb' ); ?><br /><br />
						<div class="walktheweb_loginlabel"><?php _e('WooCommerce API', 'walktheweb' ); ?></div><input type="checkbox" id="walktheweb_tenablewoo" checked="true" style="float:left;display:inline-block;margin-top:3px;" onchange="walktheweb.checkWooAPI();" /><div style="display:inline;text-align:left;margin:0px 0px 5px 0px;"> <div>The <?php _e('WooCommerce API must be enabled (checked) to display product information in your 3D Shopping Website. This global setting affects all of  your 3D Shopping Websites and other uses outside of WalkTheWeb.', 'walktheweb' ); ?></div></div><div style="clear:both;"></div><hr />

						<div class="walktheweb_loginlabel"><?php _e('Allow iFrame', 'walktheweb' ); ?></div><input type="checkbox" id="walktheweb_tallowiframe" checked="true" style="float:left;display:inline-block;margin-top:3px;" onchange="walktheweb.checkIFrames();" /><div style="display:inline;text-align:left;margin:0px 0px 5px 0px;"><?php _e('Allow your WooCommerce Store to display within an iFrame Window on your 3D Shopping Website (Immersive 3D). Otherwise, it will open in a separate browser tab. Each 3D Website is set independently.', 'walktheweb' ); ?></div><div style="clear:both;"></div><hr />
						
						<div class="walktheweb_loginlabel"><?php _e('HTTP Header', 'walktheweb' ); ?></div><input type="checkbox" id="walktheweb_tallowheader" checked="true" style="float:left;display:inline-block;margin-top:3px;" onclick="walktheweb.checkHeaders();" /><div style="display:inline;text-align:left;margin:0px 0px 5px 0px;"><?php _e('You must allow your 3D Shopping Website to read Product information and product images. This checkbox will automatically add the required HTTP headers. If you use a different program to manage headers, uncheck and manually add these HTTP header settings:', 'walktheweb' ); ?><br /><br />
						<strong><?php _e('HTTP Header Name:', 'walktheweb' ); ?></strong> X-Content-Security-Policy<br />
						<strong>Value:</strong> frame-ancestors 'self' https://3d.walktheweb.com https://3dnet.walktheweb.com https://3dnet.walktheweb.network https://3d.<?php echo $walktheweb_domain; ?><?php 
						
						$zresults = $wpdb->get_results("
							select distinct hosturl 
							from ".WTW_PREFIX."3dhosts
							where deleted=0
							group by hosturl;");
						foreach ($zresults as $zrow) {
							if (isset($zrow->hosturl) && !empty($zrow->hosturl)) {
								$zhost = $zrow->hosturl;
								if ($zhost != "https://3d.".$walktheweb_domain) {
									echo " ".$zrow->hosturl;
								}
							}
						}
						?><br /><br />
						
						<span class="walktheweb_smalllightfont">
						<h4>Note:</h4>
						<b>https://3d.walktheweb.com</b> <?php _e('is for WalkTheWeb Free Hosting 3D Websites.', 'walktheweb' ); ?><br /><br />
						<b>https://3dnet.walktheweb.com</b> <?php _e('is for WalkTheWeb Global Login and Free 3D Downloads (3D Community Scenes, 3D Buildings and 3D Things) shown in the create process.', 'walktheweb' ); ?><br /><br />
						<b>https://3dnet.walktheweb.network</b> <?php _e('is for WalkTheWeb 3D Internet (with subscription Options for Multiplayer and Chat).', 'walktheweb' ); ?><br /><br />
						<b>https://3d.<?php echo $walktheweb_domain; ?></b> <?php _e('is needed if you choose to upgrade to use your own domain name for your 3D Shopping Website on WalkTheWeb Hosting!', 'walktheweb' ); ?><br /><br />
						All other sites were automatically entered from your 3D Hosts list<br /><br /></span>
						</div>
					</div>
				</div>


				<div style="clear:both;"></div><br /><br />
				<div id="walktheweb_step4_3b" class="walktheweb_navbuttonback" onclick="walktheweb.startWizard(3,'');">&#8592; <?php _e('Back', 'walktheweb' ); ?></div>
				<div id="walktheweb_step4_5b" class="walktheweb_navbuttonnext" onclick="walktheweb.startWizard(5,'');" style="visibility:hidden;"><?php _e('Next', 'walktheweb' ); ?> &#8594;</div>
				<div style="clear:both;"></div>
			</div>
			<div id="walktheweb_wizard5" class="walktheweb_dashboardpage" style="display:none;visibility:hidden;">
				<div id="walktheweb_step5_4" class="walktheweb_navbuttonback" onclick="walktheweb.startWizard(4,'');">&#8592; <?php _e('Back', 'walktheweb' ); ?></div>
				<div id="walktheweb_step5_6" class="walktheweb_navbuttonnext" style="visibility:hidden;"><?php _e('Next', 'walktheweb' ); ?> &#8594;</div>
				<h2 class="walktheweb_dashboardheading"><?php _e('Step 5', 'walktheweb' ); ?> - <?php _e('Create My 3D Shopping Website', 'walktheweb' ); ?></h2>

				<div id="walktheweb_reviewdev">
					<div style="text-align:center;">
						<div class="walktheweb_bold">
							<?php _e('Review your 3D Shopping Website settings below, then click Create It!', 'walktheweb' ); ?><br /><br />
						</div><div style="clear:both;"></div>
					</div>
					<div class="walktheweb_createbutton" onclick="walktheweb.createIt();"><?php _e('Create It!', 'walktheweb' ); ?></div>
					<div style="clear:both;"></div>
					<div style="float:left;">
						<div class="walktheweb_hostingbox" style="width:300px;">
							<h2 id="walktheweb_selectedbuildingname" class="walktheweb_dashboardheading"></h2>
							<img id="walktheweb_selectedbuildingimage" class="walktheweb_selectedimage" />
							<div class="walktheweb_editbutton" onclick="walktheweb.startWizard(1,'woocommerce');"><?php _e('Edit', 'walktheweb' ); ?></div><div style="clear:both;"></div>
						</div><br />
						<div class="walktheweb_hostingbox" style="width:300px;">
							<h2 id="walktheweb_selectedcommunityname" class="walktheweb_dashboardheading"></h2>
							<img id="walktheweb_selectedcommunityimage" class="walktheweb_selectedimage" />
							<div class="walktheweb_editbutton" onclick="walktheweb.startWizard(2,'');"><?php _e('Edit', 'walktheweb' ); ?></div><div style="clear:both;"></div>
						</div>
					</div>
					<div class="walktheweb_hostingbox" style="width:600px;text-align:center;float:left;">
						<h2 class="walktheweb_dashboardheading"><span style="color:blue">WalkTheWeb<sup>®</sup></span> <?php _e('Settings', 'walktheweb' ); ?></h2>
						<div class="walktheweb_loginlabel"><?php _e('3D Hosting', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_thosting" name="walktheweb_thosting" class="walktheweb_textboxwider" /></div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel"><?php _e('3D Website URL', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_wtwurl" name="walktheweb_wtwurl" class="walktheweb_textboxwider" /></div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel"><?php _e('Store Name', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_wtwstorename" name="walktheweb_wtwstorename" class="walktheweb_textboxwider" /></div><div style="clear:both;"></div>
						<div class="walktheweb_editbutton" onclick="walktheweb.startWizard(3,'');"><?php _e('Edit', 'walktheweb' ); ?></div><div style="clear:both;"></div><hr />
						<div class="walktheweb_loginlabel">WalkTheWeb <?php _e('Login', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_wtwemail"  name="walktheweb_wtwemail" class="walktheweb_textboxwider" /></div><div style="clear:both;"></div>
						<div class="walktheweb_loginlabel">WooCommerce <?php _e('Key', 'walktheweb' ); ?></div><div><input type="text" id="walktheweb_twoocommercekey" value="<?php echo "...".substr($walktheweb_wookey, -7); ?>" class="walktheweb_textboxwider" /></div><div style="clear:both;"></div>
						<div class="walktheweb_editbutton" onclick="walktheweb.startWizard(4,'');"><?php _e('Edit', 'walktheweb' ); ?></div><div style="clear:both;"></div>
					</div>
					<div style="clear:both;"></div><br /><br />
					<div id="walktheweb_step5_4b" class="walktheweb_navbuttonback" onclick="walktheweb.startWizard(4,'');">&#8592; <?php _e('Back', 'walktheweb' ); ?></div>
					<div id="walktheweb_step5_6b" class="walktheweb_navbuttonnext" style="visibility:hidden;"><?php _e('Next', 'walktheweb' ); ?> &#8594;</div>
					<div style="clear:both;"></div>
				
				</div>
				
				<div id="walktheweb_creatingdev" style="display:none;visibility:hidden;">
					<h2 class="walktheweb_dashboardheading"><?php _e('Creating...', 'walktheweb' ); ?></h2>
					<div class="walktheweb_progressdiv" onclick="walktheweb.startWaiting();">
						<div id="walktheweb_progress0" class="walktheweb_progressball" style="margin-top:150px;"><div class="walktheweb_progresstext" style="color:#ffff66;">W</div></div>
						<div id="walktheweb_progress1" class="walktheweb_progressball" style="margin-top:150px;"><div class="walktheweb_progresstext">a</div></div>
						<div id="walktheweb_progress2" class="walktheweb_progressball" style="margin-top:150px;"><div class="walktheweb_progresstext">l</div></div>
						<div id="walktheweb_progress3" class="walktheweb_progressball" style="margin-top:150px;"><div class="walktheweb_progresstext">k</div></div>
						<div id="walktheweb_progress4" class="walktheweb_progressball" style="margin-top:150px;"><div class="walktheweb_progresstext" style="color:#ffff66;">T</div></div>
						<div id="walktheweb_progress5" class="walktheweb_progressball" style="margin-top:150px;"><div class="walktheweb_progresstext">h</div></div>
						<div id="walktheweb_progress6" class="walktheweb_progressball" style="margin-top:150px;"><div class="walktheweb_progresstext">e</div></div>
						<div id="walktheweb_progress7" class="walktheweb_progressball" style="margin-top:150px;"><div class="walktheweb_progresstext" style="color:#ffff66;">W</div></div>
						<div id="walktheweb_progress8" class="walktheweb_progressball" style="margin-top:150px;"><div class="walktheweb_progresstext">e</div></div>
						<div id="walktheweb_progress9" class="walktheweb_progressball" style="margin-top:150px;"><div class="walktheweb_progresstext">b</div></div>
					</div>
				</div>

				<div id="walktheweb_newhostedwebsitedev" style="display:none;visibility:hidden;">
					<h2 class="walktheweb_dashboardheading"><?php _e('Your New 3D Shopping Website', 'walktheweb' ); ?></h2>
					<div style="text-align:center;">
						<div class="walktheweb_bold">
							<?php _e('Welcome to', 'walktheweb' ); ?> WalkTheWeb 3D Internet!<br /><br />
						</div><div style="clear:both;"></div>
						<a id="walktheweb_visitwebsite" class="walktheweb_createbutton" target="_blank"><?php _e('Visit your New 3D Shopping Website!', 'walktheweb' ); ?></a><br /><br />
						Loading...
						<div style="clear:both;"></div>
						
					</div>
				</div>
			</div>
		</div>
		<input type="submit" id="walktheweb_submit" name="walktheweb_submit" onclick="document.getElementById('walktheweb_bval').value = 'walktheweb_createwebsite';" value="Submit" class="walktheweb_hidden" />
		<input type="hidden" id="walktheweb_buildingid" name="walktheweb_buildingid" value="" />
		<input type="hidden" id="walktheweb_buildingname" name="walktheweb_buildingname" value="" />
		<input type="hidden" id="walktheweb_communityid" name="walktheweb_communityid" value="" />
		<input type="hidden" id="walktheweb_communityname" name="walktheweb_communityname" value="" />
		<input type="hidden" id="walktheweb_usertoken" name="walktheweb_usertoken" value="" />
		<input type="hidden" id="walktheweb_wtwusertoken" name="walktheweb_wtwusertoken" value="" />
		<input type="hidden" id="walktheweb_wpuserid" name="walktheweb_wpuserid" value="<?php echo $user->ID; ?>" />
		<input type="hidden" id="walktheweb_userid" name="walktheweb_userid" value="" />
		<input type="hidden" id="walktheweb_wookeyapienabled" name="walktheweb_wookeyapienabled" value="yes" />
		<input type="hidden" id="walktheweb_wookeyid" name="walktheweb_wookeyid" value="" />
		<input type="hidden" id="walktheweb_wookey" name="walktheweb_wookey" value="<?php echo $walktheweb_wookey; ?>" />
		<input type="hidden" id="walktheweb_woosecret" name="walktheweb_woosecret" value="<?php echo $walktheweb_woosecret; ?>" />
		<input type="hidden" id="walktheweb_iframes" name="walktheweb_iframes" value="1" />
		<input type="hidden" id="walktheweb_headers" name="walktheweb_headers" value="1" />
		<input type="hidden" id="walktheweb_wtwkeytext" name="walktheweb_wtwkeytext" value="" />
		<input type="hidden" id="walktheweb_bval" name="walktheweb_bval" value="" />
		<input type="hidden" id="walktheweb_nonce" name="walktheweb_nonce" value="<?php echo $nonce; ?>" />
		<input type="hidden" id="walktheweb_wpinstanceid" name="walktheweb_wpinstanceid" value="<?php echo esc_attr($walktheweb_wpinstanceid); ?>" />
		<input type="hidden" id="walktheweb_domainurl" name="walktheweb_domainurl" value="" />
		<input type="hidden" id="walktheweb_websiteurl" name="walktheweb_websiteurl" value="" />
		<input type="hidden" id="walktheweb_serverip" name="walktheweb_serverip" value="<?php echo esc_attr($walktheweb_serverip); ?>" />
		<input type="hidden" id="walktheweb_storeurl" name="walktheweb_storeurl" value="<?php echo esc_url($walktheweb_storeurl); ?>" />
		<input type="hidden" id="walktheweb_woocommerceisactive" name="walktheweb_woocommerceisactive" value="<?php echo esc_attr($walktheweb_wooactive); ?>" />
	</div>
<?php	} 
	
	$zcreatesite = '';
	if (isset($_GET["createsite"])) {
		$zcreatesite = $_GET["createsite"];
	}
	if ($zcreatesite == '1') {
		echo "<script>walktheweb.startWizard(1, 'woocommerce');</script>";
	} else {
		echo "<script>walktheweb.adRotate();</script>";
	}

	} catch (Exception $e) {
		$WalkTheWeb->serror("wtw-pages-walktheweb_dashboard.php = ".$e->getMessage());
	}
?>
