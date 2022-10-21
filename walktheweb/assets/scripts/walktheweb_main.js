function WalkTheWeb() {
	this.activead = 0;
	this.adtimer = null;
	this.imagepath = '';
	this.imagearray = [
		{
			'imagefile':'demo1.png',
			'imagetext':'WalkTheWeb 3D Internet - Open-Source Metaverse',
			'textcolor':'yellow',
			'timer':10000
		},
		{
			'imagefile':'demo3.png',
			'imagetext':'All Sales are completely SECURE on your original Shopping Cart website.',
			'textcolor':'yellow',
			'timer':8000
		},
		{
			'imagefile':'demo4.png',
			'imagetext':'Products are read LIVE and displayed in 3D Game Scenes with no additional maintenance!',
			'textcolor':'yellow',
			'timer':10000
		},
		{
			'imagefile':'demo2.png',
			'imagetext':'Products are automatically shown in 3D Displays with title, image, price, Read More link, and ability to Add to Cart',
			'textcolor':'yellow',
			'timer':10000
		},
		{
			'imagefile':'demo6.png',
			'imagetext':'You can also use additional 3D Buttons like Read More, View Cart, Add to Cart, etc...',
			'textcolor':'yellow',
			'timer':8000
		},
		{
			'imagefile':'demo5.png',
			'imagetext':'Add to Cart will open your original Website in an iframe with the shopper all ready to buy!',
			'textcolor':'yellow',
			'timer':10000
		},
		{
			'imagefile':'demo7.png',
			'imagetext':'Read More will open your original Website in an iframe with the product information page.',
			'textcolor':'yellow',
			'timer':8000
		},
		{
			'imagefile':'demo8.png',
			'imagetext':'Interactive Categories Panel allows you to select and view products within that category (Updates the Product Displays).',
			'textcolor':'yellow',
			'timer':10000
		},
		{
			'imagefile':'demo9.png',
			'imagetext':'3D Text Search allows you to find additional products (Updates the Product Displays).',
			'textcolor':'yellow',
			'timer':10000
		},
		{
			'imagefile':'demo10.png',
			'imagetext':'In under 5 minutes you can have a fully customizable 3D Scene and 3D Store to share!',
			'textcolor':'yellow',
			'timer':7000
		},
		{
			'imagefile':'demo11.png',
			'imagetext':'We offer custom 3D Model design to make your 3D Store and Products look awesome!',
			'textcolor':'yellow',
			'timer':9000
		},
		{
			'imagefile':'demo12.png',
			'imagetext':'3D Scenes can host multiple 3D Stores and Games to gain more traffic.',
			'textcolor':'yellow',
			'timer':6000
		},
		{
			'imagefile':'demo13.png',
			'imagetext':'AI Avatars and 3D Models can be added to enhance the animated 3D Scenes.',
			'textcolor':'yellow',
			'timer':7000
		},
		{
			'imagefile':'demo14.png',
			'imagetext':'Numerous camera views allow various degrees of 3D viewing and device support.',
			'textcolor':'yellow',
			'timer':8000
		},
		{
			'imagefile':'demo15.png',
			'imagetext':'As a Metaverse, 3D Virtual Reality (VR) is supported but not required.',
			'textcolor':'yellow',
			'timer':8000
		},
		{
			'imagefile':'demo16.png',
			'imagetext':'Download your favorite 3D Models and Do It Yourself (DIY) add them to your 3D Website at no cost!',
			'textcolor':'yellow',
			'timer':10000
		},
		{
			'imagefile':'demo17.png',
			'imagetext':'This is just the beginning of WalkTheWeb 3D Internet - Open-Source Metaverse',
			'textcolor':'yellow',
			'timer':10000
		}
	];
	
	this.dGet = function(value) {
		var obj = null;
		try {
			obj = document.getElementById(value);
		} catch (ex) {
			
		}
		return obj;
	}
	
	this.serror = function(message) {
		try {
			console.log(message);
		} catch (ex) {
			
		}
	}

	this.getJSON = function(url, callback) {
		try {
			var Httpreq = new XMLHttpRequest();
			Httpreq.overrideMimeType("application/json");
			Httpreq.open('GET', url, true);
			Httpreq.onreadystatechange = function () {
				if (Httpreq.readyState == 4 && Httpreq.status == "200") {
					callback(Httpreq.responseText);
				}
			};
			Httpreq.send(null);  
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-getJSON-" + ex.message);
		}
	}

	this.postJSON = function(zurl, zrequest, zcallback) {
		try {
			var form1 = document.createElement('form');
			var Httpreq = new XMLHttpRequest();
			var zformdata = new FormData(form1);
			for(var zkey in zrequest) {
				zformdata.append(zkey, zrequest[zkey]);
			}
			zformdata.append('action', 'POST');
			Httpreq.open('POST', zurl);
			Httpreq.onreadystatechange = function () {
				if (Httpreq.readyState == 4 && Httpreq.status == "200") {
					zcallback(Httpreq.responseText);
				}
			};
			Httpreq.send(zformdata);  
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-postJSON=" + ex.message);
		}
	}



	this.submit = function(bval) {
		try {
			var zhosturl = walktheweb.dGet('walktheweb_hosturl').value;
			var zwookeyid = walktheweb.dGet('walktheweb_wookeyid').value;
			var zsiteurl = walktheweb.dGet('walktheweb_siteurl').value;
			walktheweb.dGet('walktheweb_bval').value = bval;
			walktheweb.dGet('walktheweb_submit').click();
			var zurl = "";
			walktheweb.getJSON(zhosturl + "/connect/wtw-shopping-connect.php?siteurl=" + btoa(zsiteurl) + "&wookeyid=" + btoa(zwookeyid), function(zresults) {
				if (zresults != null) {
					zresults = JSON.parse(zresults);
					
					
					
					
				}
			});
			
			
			
			
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-submit-" + ex.message);
		}
	}

	this.encode = function(zvalue) {
		/* simplified version of escape text */
		try {
			if (zvalue != null) {
				while (zvalue.indexOf('"') > -1) {
					zvalue = zvalue.replace(/"/g, '&quot;');
				}
				while (zvalue.indexOf("'") > -1) {
					zvalue = zvalue.replace(/'/g, '&#039;');
				}
				while (zvalue.indexOf("'") > -1) {
					zvalue = zvalue.replace(/'/g, '&#39;');
				}
				while (zvalue.indexOf("<") > -1) {
					zvalue = zvalue.replace(/</g, '&lt;');
				}
				while (zvalue.indexOf(">") > -1) {
					zvalue = zvalue.replace(/>/g, '&gt;');
				}
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-encode=" + ex.message);
		}
		return String(zvalue);
	}

	this.decode = function(zvalue) {
		/* decifer simplified version of escape text */
		try {
			if (zvalue != null) {
				while (zvalue.indexOf('&amp;') > -1) {
					zvalue = zvalue.replace('&amp;', "&");
				}
				while (zvalue.indexOf('&quot;') > -1) {
					zvalue = zvalue.replace('&quot;', '"');
				}
				while (zvalue.indexOf("&#039;") > -1) {
					zvalue = zvalue.replace('&#039;', "'");
				}
				while (zvalue.indexOf("&#39;") > -1) {
					zvalue = zvalue.replace('&#39;', "'");
				}
				while (zvalue.indexOf("&lt;") > -1) {
					zvalue = zvalue.replace('&lt;', "<");
				}
				while (zvalue.indexOf("&gt;") > -1) {
					zvalue = zvalue.replace('&gt;', ">");
				}
				while (zvalue.indexOf("\\") > -1) {
					zvalue = zvalue.replace('\\', "");
				}
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-decode=" + ex.message);
		}
		return String(zvalue);
	}

	this.formatDate = function(date) {
		/* format date as month/day/year */
		if (date != "") {
			var d = new Date(date),
				month = '' + (d.getMonth() + 1),
				day = '' + d.getDate(),
				year = d.getFullYear();

			if (month.length < 2) month = '0' + month;
			if (day.length < 2) day = '0' + day;
			return [month,day,year].join('/');
		} else {
			return "";
		}
	}

	this.isNumeric = function(n) {
		/* boolean - is a text string a number */
		return !isNaN(parseFloat(n)) && isFinite(n);
	}
	
	this.show = function(zelement) {
		try {
			if (walktheweb.dGet(zelement) != null) {
				walktheweb.dGet(zelement).style.display = 'block';
				walktheweb.dGet(zelement).style.visibility = 'visible';
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-show=" + ex.message);
		}
	}

	this.showInline = function(zelement) {
		try {
			if (walktheweb.dGet(zelement) != null) {
				walktheweb.dGet(zelement).style.display = 'inline';
				walktheweb.dGet(zelement).style.visibility = 'visible';
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-show=" + ex.message);
		}
	}

	this.showInlineBlock = function(zelement) {
		try {
			if (walktheweb.dGet(zelement) != null) {
				walktheweb.dGet(zelement).style.display = 'inline-block';
				walktheweb.dGet(zelement).style.visibility = 'visible';
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-show=" + ex.message);
		}
	}

	this.hide = function(zelement) {
		try {
			if (walktheweb.dGet(zelement) != null) {
				walktheweb.dGet(zelement).style.display = 'none';
				walktheweb.dGet(zelement).style.visibility = 'hidden';
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-hide=" + ex.message);
		}
	}
	
	this.toggle = function(zelement) {
		try {
			if (walktheweb.dGet(zelement) != null) {
				if (walktheweb.dGet(zelement).style.display == 'none') {
					walktheweb.show(zelement);
				} else {
					walktheweb.hide(zelement);
				}
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-toggle=" + ex.message);
		}
	}

	this.getRandomString = function(zlength) {
		/* gets a random alpha numeric string - often used as ID fields */
		var zresult = '';
		try {
			var zchars = '0123456789abcdefghijklmnopqrstuvwxyz';
			for (var i = zlength; i > 0; --i) {
				zresult += zchars[Math.floor(Math.random() * zchars.length)];
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-randomString=" + ex.message);
		}
		return zresult;
	}

	this.startWizard = function(zstep,zparameter) {
		try {
			walktheweb.hide('walktheweb_dashboard');
			walktheweb.show('walktheweb_wizard');
			walktheweb.dGet('walktheweb_bval').value = 'walktheweb_createwebsite';
			for (var i=1;i<6;i++) {
				if (i == zstep) {
					walktheweb.show('walktheweb_wizard' + i);
					walktheweb.dGet('walktheweb_wizardstep' + i).className = 'walktheweb_dashboardstep_active';
					walktheweb.dGet('walktheweb_wizardstep' + i).onclick = function() {};
				} else if (i < zstep || (i == 2 && walktheweb.dGet('walktheweb_buildingid').value != '') || (i == 3 && walktheweb.dGet('walktheweb_communityid').value != '') || (i == 3 && walktheweb.dGet('walktheweb_availability').style.display == 'none') || (i == 4 && walktheweb.dGet('walktheweb_usertoken').value != '' && walktheweb.dGet('walktheweb_wookey').value != '')) {
					walktheweb.hide('walktheweb_wizard' + i);
					walktheweb.dGet('walktheweb_wizardstep' + i).className = 'walktheweb_dashboardstep_past';
					switch (i) {
						case 1:
							walktheweb.dGet('walktheweb_wizardstep1').onclick = function() {
								walktheweb.startWizard(1,'woocommerce');
							};
							break;
						case 2:
							walktheweb.dGet('walktheweb_wizardstep2').onclick = function() {
								walktheweb.startWizard(2,'');
							};
							break;
						case 3:
							walktheweb.dGet('walktheweb_wizardstep3').onclick = function() {
								walktheweb.startWizard(3,'');
							};
							break;
						case 4:
							walktheweb.dGet('walktheweb_wizardstep4').onclick = function() {
								walktheweb.startWizard(4,'');
							};
							break;
						case 5:
							walktheweb.dGet('walktheweb_wizardstep5').onclick = function() {
								walktheweb.startWizard(5,'');
							};
							break;
					}
				} else {
					walktheweb.hide('walktheweb_wizard' + i);
					walktheweb.dGet('walktheweb_wizardstep' + i).className = 'walktheweb_dashboardstep_next';
					walktheweb.dGet('walktheweb_wizardstep' + i).onclick = function() {};
				}
			}
			switch (zstep) {
				case 1:
					walktheweb.buildingSearch(zparameter);
					break;
				case 2:
					walktheweb.communitySearch('');
					break;
				case 3:
					walktheweb.checkHosts();
					break;
				case 4:
					if (walktheweb.dGet('walktheweb_wookey').value == '') {
						walktheweb.hideLogin();
					} else {
						walktheweb.hide('walktheweb_advancedpathsdiv');
						walktheweb.hide('walktheweb_advancedoptionsdiv');
						walktheweb.addNewWooKey();
					}
					break;
				case 5:
					walktheweb.hide('walktheweb_newhostedwebsitedev');
					walktheweb.hide('walktheweb_creatingdev');
					walktheweb.show('walktheweb_reviewdev');
					break;
			}
			window.scrollTo(0,0);
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-startWizard=" + ex.message);
		}
	}
	
	this.buildingSearch = function(zsearch) {
		/* keyword search to find a building to download to your instance */
		try {
			if (zsearch == undefined) {
				zsearch = walktheweb.dGet('walktheweb_tbuildingsearch').value;
			}
			zsearch = walktheweb.encode(zsearch);
			walktheweb.getJSON("https://3dnet.walktheweb.com/connect/sharesearch.php?search=" + zsearch + "&webtype=building", 
				function(zresponse) {
					walktheweb.buildingSearchReply(JSON.parse(zresponse));
				}
			);
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-buildingSearch=" + ex.message);
		}
	}	
	
	this.buildingSearchReply = function(zresponse) {
		/* receives search results and parses for screen display */
		try {
			var ztempsearchresults = '';
			walktheweb.dGet('walktheweb_buildtempsearchresults').innerHTML = "";
			for (var i=0; i < zresponse.length; i++) {
				var zdownloads = 0;
				var zbuildingid = zresponse[i].serverbuildingid;
				var zupdatedate  = walktheweb.formatDate(zresponse[i].updatedate);
				if (walktheweb.isNumeric(zresponse[i].downloads)) {
					zdownloads = zresponse[i].downloads;
				}
				ztempsearchresults += "<div class=\"walktheweb_simplebox\"><input type='button' id='wtw_btempselect" + i + "' class='walktheweb_searchresultbutton' value='Select' onclick=\"walktheweb.selectBuilding('" + zbuildingid + "','" + zresponse[i].templatename + "','" + zresponse[i].imageurl + "');return (false);\" />";
				ztempsearchresults += "<h3 class=\"walktheweb_black\">" + zresponse[i].templatename + "</h3><br />";
				ztempsearchresults += "<div style='white-space:normal;font-weight:normal;color:#000000;'>" + zresponse[i].description + "</div><br />";
				ztempsearchresults += "<div style='white-space:normal;font-weight:normal;color:#000000;'>Created By: <b>" + zresponse[i].displayname + "</b> (<b>" + zupdatedate + "</b>)</div><br />";
				ztempsearchresults += "<div style='white-space:normal;font-weight:normal;color:#000000;'>Downloaded: <b>" + zdownloads + "</b> times.</div><br />";
				if (zresponse[i].imageurl != "") {
					ztempsearchresults += "<img id='wtw_search" + zbuildingid + "' src='" + zresponse[i].imageurl + "' onmouseover=\"this.style.border='1px solid yellow';\" onmouseout=\"this.style.border='1px solid gray';\" onclick=\"walktheweb.selectBuilding('" + zbuildingid + "','" + zresponse[i].templatename + "','" + zresponse[i].imageurl + "');return (false);\" style=\"margin:2%;border:1px solid gray;cursor:pointer;width:96%;height:auto;\" alt='" + zresponse[i].templatename + "' title='" + zresponse[i].templatename + "' />";
				}
				ztempsearchresults += "<br /></div><hr style=\"width:96%;\" />";
			}
			walktheweb.dGet('walktheweb_buildtempsearchresults').innerHTML = ztempsearchresults;
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-buildingSearchReply=" + ex.message);
		}
	}

	this.selectBuilding = function(zwebid, ztemplatename, zimageurl) {
		try {
			walktheweb.dGet('walktheweb_buildingid').value = zwebid;
			walktheweb.dGet('walktheweb_selectedbuildingname').innerHTML = ztemplatename;
			walktheweb.dGet('walktheweb_buildingname').value = ztemplatename;
			walktheweb.dGet('walktheweb_selectedbuildingimage').src = zimageurl;
			walktheweb.startWizard(2,'');
			walktheweb.dGet('walktheweb_step1_2').style.visibility = 'visible';
			walktheweb.dGet('walktheweb_step1_2b').style.visibility = 'visible';
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-selectBuilding=" + ex.message);
		}
	}

	this.communitySearch = function(zsearch) {
		/* keyword search to find a community to download to your instance */
		try {
			if (zsearch == undefined) {
				zsearch = walktheweb.dGet('walktheweb_tcommunitysearch').value;
			}
			zsearch = walktheweb.encode(zsearch);
			walktheweb.getJSON("https://3dnet.walktheweb.com/connect/sharesearch.php?search=" + zsearch + "&webtype=community", 
				function(zresponse) {
					walktheweb.communitySearchReply(JSON.parse(zresponse));
				}
			);
		} catch (ex) {
			walktheweb.error("walktheweb_main.js-communitySearch=" + ex.message);
		}
	}

	this.communitySearchReply = function(zresponse) {
		/* receives search results and parses for screen display */
		try {
			var ztempsearchresults = '';
			walktheweb.dGet('walktheweb_communitytempsearchresults').innerHTML = "";
			for (var i=0; i < zresponse.length; i++) {
				var zdownloads = 0;
				var zcommunityid = zresponse[i].servercommunityid;
				var zupdatedate  = walktheweb.formatDate(zresponse[i].updatedate);
				if (walktheweb.isNumeric(zresponse[i].downloads)) {
					zdownloads = zresponse[i].downloads;
				}
				ztempsearchresults += "<div class=\"walktheweb_simplebox\"><input type='button' id='wtw_bcommtempselect" + i + "' class='walktheweb_searchresultbutton' value='Select' onclick=\"walktheweb.selectCommunity('" + zcommunityid + "','" + zresponse[i].templatename + "','" + zresponse[i].imageurl + "');\" />";
				ztempsearchresults += "<h3 class=\"walktheweb_black\">" + zresponse[i].templatename + "</h3><br />";
				ztempsearchresults += "<div style='white-space:normal;font-weight:normal;color:#000000;'>" + zresponse[i].description + "</div><br />";
				ztempsearchresults += "<div style='white-space:normal;font-weight:normal;color:#000000;'>Created By: <b>" + zresponse[i].displayname + "</b> (<b>" + zupdatedate + "</b>)</div><br />";
				ztempsearchresults += "<div style='white-space:normal;font-weight:normal;color:#000000;'>Downloaded: <b>" + zdownloads + "</b> times.</div><br />";
				if (zresponse[i].imageurl != "") {
					ztempsearchresults += "<div style=\"clear:both;\"></div><img id='wtw_search" + zcommunityid + "' src='" + zresponse[i].imageurl + "' onmouseover=\"this.style.border='1px solid yellow';\" onmouseout=\"this.style.border='1px solid gray';\" onclick=\"walktheweb.selectCommunity('" + zcommunityid + "','" + zresponse[i].templatename + "','" + zresponse[i].imageurl + "');\" style=\"margin:2%;border:1px solid gray;cursor:pointer;width:96%;height:auto;\" alt='" + zresponse[i].templatename + "' title='" + zresponse[i].templatename + "' />";
				}
				ztempsearchresults += "<br /></div><hr style=\"width:96%;\" />";
			}
			walktheweb.dGet('walktheweb_communitytempsearchresults').innerHTML = ztempsearchresults;
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-communitySearchReply=" + ex.message);
		}
	}

	this.selectCommunity = function(zwebid, ztemplatename, zimageurl) {
		try {
			walktheweb.dGet('walktheweb_communityid').value = zwebid;
			walktheweb.dGet('walktheweb_selectedcommunityname').innerHTML = ztemplatename;
			walktheweb.dGet('walktheweb_communityname').value = ztemplatename;
			walktheweb.dGet('walktheweb_selectedcommunityimage').src = zimageurl;
			walktheweb.startWizard(3,'');
			walktheweb.dGet('walktheweb_step2_3').style.visibility = 'visible';
			walktheweb.dGet('walktheweb_step2_3b').style.visibility = 'visible';
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-selectCommunity=" + ex.message);
		}
	}

	this.selectWalkTheWebHosting = function(zhost, zwtwkeytext) {
		try {
			walktheweb.hide('walktheweb_registerdiv');
			walktheweb.hide('walktheweb_resetpassworddiv');
			walktheweb.hide('walktheweb_loggedindiv');
			walktheweb.show('walktheweb_sitediv');
			walktheweb.dGet('walktheweb_availability').style.visibility = 'visible';
//			walktheweb.dGet('walktheweb_hostingbox').style.width = '50%';
			walktheweb.dGet('walktheweb_wtwkeytext').value = zwtwkeytext;
			walktheweb.dGet('walktheweb_thosting').disabled = false;
			if (zhost.toLowerCase().indexOf('https://3d') > -1) {
				walktheweb.dGet('walktheweb_hosturl').innerHTML = zhost + "/";
				walktheweb.dGet('walktheweb_wtwkeytext').value = zwtwkeytext;
				walktheweb.dGet('walktheweb_thosting').value = zhost;
			} else {
				walktheweb.dGet('walktheweb_hosturl').innerHTML = 'https://3d.walktheweb.com/';
				walktheweb.dGet('walktheweb_wtwkeytext').value = '';
				walktheweb.dGet('walktheweb_thosting').value = 'https://3d.walktheweb.com';
			}
			walktheweb.dGet('walktheweb_thosting').disabled = true;
			
			var zhosts = document.getElementById('walktheweb_hostingbox').childNodes;
			for (var i = 0;i < zhosts.length;i++) {
				if (zhosts[i] != null) {
					if (zhosts[i].id != undefined) {
						if (zhosts[i].id.indexOf('walktheweb_host-') > -1) {
							if (zhosts[i].id == 'walktheweb_host-' + zwtwkeytext) {
								//walktheweb.hide('walktheweb_hosting-' + zwtwkeytext);
								walktheweb.dGet(zhosts[i].id).className = 'walktheweb_hostingboxselected';
							} else {
								walktheweb.dGet(zhosts[i].id).className = 'walktheweb_hostingbox';
							}
						}
					}
				}
			}

			walktheweb.checkWebname();
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-selectWalkTheWebHosting=" + ex.message);
		}
	}
	
	this.checkWebname = function() {
		try {
			walktheweb.dGet('walktheweb_availability_error').innerHTML = '';
			let zhost = walktheweb.dGet('walktheweb_hosturl').innerHTML;
			let zwebname = walktheweb.dGet('walktheweb_webname').value;
			walktheweb.getJSON(zhost + "connect/webnamecheck.php?webname=" + btoa(zwebname),
				function(zresponse) {
					zresponse = JSON.parse(zresponse);
					if (zresponse.available == '1') {
						walktheweb.dGet('walktheweb_availability_error').innerHTML = '';
						walktheweb.dGet('walktheweb_webname').value = zresponse.webname;
						walktheweb.dGet('walktheweb_webname').style.border = '3px solid green';
						walktheweb.dGet('walktheweb_availability').style.visibility = 'hidden';
						walktheweb.show('walktheweb_savewebsite');
						walktheweb.dGet('walktheweb_step3_4').style.visibility = 'visible';
						walktheweb.dGet('walktheweb_step3_4b').style.visibility = 'visible';
					} else {
						walktheweb.dGet('walktheweb_availability_error').innerHTML = zresponse.serror;
						walktheweb.dGet('walktheweb_webname').style.border = '3px solid red';
						walktheweb.dGet('walktheweb_availability').style.visibility = 'visible';
						walktheweb.hide('walktheweb_savewebsite');
						walktheweb.dGet('walktheweb_step3_4').style.visibility = 'hidden';
						walktheweb.dGet('walktheweb_step3_4b').style.visibility = 'hidden';
					}
				}
			);
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-checkWebname=" + ex.message);
		}
	}

	this.resetWebname = function() {
		try {
			walktheweb.dGet('walktheweb_webname').style.border = '1px solid #afafaf';
			walktheweb.dGet('walktheweb_availability').style.visibility = 'visible';
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-resetWebname=" + ex.message);
		}
	}

	this.saveWebsiteSettings = function() {
		try {
			walktheweb.dGet('walktheweb_wtwurl').disabled = false;
			walktheweb.dGet('walktheweb_wtwurl').value = walktheweb.dGet('walktheweb_hosturl').innerHTML + walktheweb.dGet('walktheweb_webname').value;
			walktheweb.dGet('walktheweb_wtwurl').disabled = true;
			walktheweb.dGet('walktheweb_domainurl').value = walktheweb.dGet('walktheweb_hosturl').innerHTML;
			walktheweb.dGet('walktheweb_websiteurl').value = walktheweb.dGet('walktheweb_hosturl').innerHTML + walktheweb.dGet('walktheweb_webname').value;
			walktheweb.dGet('walktheweb_wtwstorename').disabled = false;
			walktheweb.dGet('walktheweb_wtwstorename').value = walktheweb.dGet('walktheweb_tstorename').value;
			walktheweb.dGet('walktheweb_wtwstorename').disabled = true;
			if (walktheweb.dGet('walktheweb_availability').style.display == 'none') {
				walktheweb.dGet('walktheweb_step3_4').style.visibility = 'visible';
				walktheweb.dGet('walktheweb_step3_4b').style.visibility = 'visible';
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-saveWebsiteSettings=" + ex.message);
		}
	}

	this.checkWooAPI = function() {
		try {
			if (walktheweb.dGet('walktheweb_tenablewoo').checked) {
				walktheweb.dGet('walktheweb_wookeyapienabled').value = 'yes';
			} else {
				walktheweb.dGet('walktheweb_wookeyapienabled').value = 'no';
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-checkWooAPI=" + ex.message);
		}
	}

	this.checkIFrames = function() {
		try {
			if (walktheweb.dGet('walktheweb_tallowiframe').checked) {
				walktheweb.dGet('walktheweb_iframes').value = '1';
			} else {
				walktheweb.dGet('walktheweb_iframes').value = '0';
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-checkIFrames=" + ex.message);
		}
	}

	this.checkHeaders = function() {
		try {
			if (walktheweb.dGet('walktheweb_tallowheader').checked) {
				walktheweb.dGet('walktheweb_headers').value = '1';
			} else {
				walktheweb.dGet('walktheweb_headers').value = '0';
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-checkHeaders=" + ex.message);
		}
	}

	this.openDashboard = function() {
		try {
			window.location.href = 'admin.php?page=walktheweb_dashboard';
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-openDashboard=" + ex.message);
		}
	}

	this.selectWooKey = function(zselect) {
		try {
			var zvalue = zselect.options[zselect.selectedIndex].value;
			var ztext = zselect.options[zselect.selectedIndex].text;
			if (zvalue != '-1' && walktheweb.dGet('walktheweb_tconfirmkey').value != '') {
				walktheweb.dGet('walktheweb_tselectedkey').disabled = false;
				walktheweb.dGet('walktheweb_tselectedkey').value = ztext;
				walktheweb.dGet('walktheweb_tselectedkey').disabled = true;
				walktheweb.dGet('walktheweb_twoocommercekey').disabled = false;
				walktheweb.dGet('walktheweb_twoocommercekey').value = ztext;
				walktheweb.dGet('walktheweb_twoocommercekey').disabled = true;
				walktheweb.hide('walktheweb_changekeydiv');
				walktheweb.showInline('walktheweb_selectedkeydiv');
				for (var i=0;i<walktheweb_wookeys.length;i++) {
					if (walktheweb_wookeys[i] != null) {
						if (walktheweb_wookeys[i].keyid != undefined) {
							if (walktheweb_wookeys[i].keyid == zvalue) {
								walktheweb.dGet('walktheweb_wookey').value = walktheweb.dGet('walktheweb_tconfirmkey').value;
								walktheweb.dGet('walktheweb_woosecret').value = walktheweb_wookeys[i].consumersecret;
								walktheweb.dGet('walktheweb_wookeyid').value = zvalue;
							}	
						}
					}
				}
				if (walktheweb.dGet('walktheweb_usertoken').value != '' && walktheweb.dGet('walktheweb_wookey').value != '') {
					walktheweb.dGet('walktheweb_step4_5').style.visibility = 'visible';
					walktheweb.dGet('walktheweb_step4_5b').style.visibility = 'visible';
				}
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-selectWooKey=" + ex.message);
		}
	}

	this.addNewWooKey = function() {
		try {
			var zkey = "ck_" + walktheweb.getRandomString(40);
			var zsecret = "cs_" + walktheweb.getRandomString(40);
			walktheweb.dGet('walktheweb_wookey').value = zkey;
			walktheweb.dGet('walktheweb_woosecret').value = zsecret;
			walktheweb.dGet('walktheweb_wookeyid').value = '-1';
			walktheweb.addWooKey();
			walktheweb.dGet('walktheweb_tselectedkey').disabled = false;
			walktheweb.dGet('walktheweb_tselectedkey').value = 'Add New Key';
			walktheweb.dGet('walktheweb_tselectedkey').disabled = true;
			walktheweb.dGet('walktheweb_twoocommercekey').disabled = false;
			walktheweb.dGet('walktheweb_twoocommercekey').value = '...' + zkey.substr((zkey.length-8),7);
			walktheweb.dGet('walktheweb_twoocommercekey').disabled = true;
			walktheweb.hide('walktheweb_changekeydiv');
			walktheweb.showInline('walktheweb_selectedkeydiv');
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-addNewWooKey=" + ex.message);
		}
	}

	this.addWooKey = function() {
		try {
			if (walktheweb.dGet('walktheweb_usertoken').value != '') {
				walktheweb.show('walktheweb_advancedpathsdiv');
				walktheweb.show('walktheweb_advancedoptionsdiv');
				walktheweb.showLoggedin();
			} else {
				walktheweb.hide('walktheweb_advancedpathsdiv');
				walktheweb.hide('walktheweb_advancedoptionsdiv');
				if (walktheweb.dGet('walktheweb_wtwkeytext').value == '') {
					walktheweb.showLogin();
				} else {
					walktheweb.showHostLogin();
				}
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-addWooKey=" + ex.message);
		}
	}


	this.changeWooKey = function() {
		try {
			walktheweb.hide('walktheweb_selectedkeydiv');
			walktheweb.showInline('walktheweb_changekeydiv');
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-changeWooKey=" + ex.message);
		}
	}

	this.logout = function() {
		try {
			walktheweb.dGet('walktheweb_userid').value = '';
			walktheweb.dGet('walktheweb_temailloggedin').disabled = false;
			walktheweb.dGet('walktheweb_temailloggedin').value = '';
			walktheweb.dGet('walktheweb_temailloggedin').disabled = true;			
			walktheweb.showLogin();
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-logout=" + ex.message);
		}
	}

	this.showHostLogin = function() {
		try {
			walktheweb.hide('walktheweb_logindiv');
			walktheweb.hide('walktheweb_registerdiv');
			walktheweb.hide('walktheweb_resetpassworddiv');
			walktheweb.hide('walktheweb_loggedindiv');
			walktheweb.show('walktheweb_hostlogindiv');
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-showHostLogin=" + ex.message);
		}
	}

	this.showLogin = function() {
		try {
			walktheweb.hide('walktheweb_hostlogindiv');
			walktheweb.hide('walktheweb_registerdiv');
			walktheweb.hide('walktheweb_resetpassworddiv');
			walktheweb.hide('walktheweb_loggedindiv');
			walktheweb.show('walktheweb_logindiv');
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-showLogin=" + ex.message);
		}
	}

	this.createLogin = function() {
		try {
			walktheweb.hide('walktheweb_hostlogindiv');
			walktheweb.hide('walktheweb_logindiv');
			walktheweb.hide('walktheweb_resetpassworddiv');
			walktheweb.hide('walktheweb_loggedindiv');
			walktheweb.show('walktheweb_registerdiv');
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-createLogin=" + ex.message);
		}
	}

	this.showRecoverPassword = function() {
		try {
			walktheweb.hide('walktheweb_hostlogindiv');
			walktheweb.hide('walktheweb_logindiv');
			walktheweb.hide('walktheweb_registerdiv');
			walktheweb.hide('walktheweb_loggedindiv');
			walktheweb.show('walktheweb_resetpassworddiv');
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-showRecoverPassword=" + ex.message);
		}
	}

	this.showLoggedin = function() {
		try {
			walktheweb.hide('walktheweb_hostlogindiv');
			walktheweb.hide('walktheweb_logindiv');
			walktheweb.hide('walktheweb_registerdiv');
			walktheweb.hide('walktheweb_resetpassworddiv');
			walktheweb.show('walktheweb_loggedindiv');
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-showLoggedin=" + ex.message);
		}
	}

	this.hideLogin = function() {
		try {
			walktheweb.hide('walktheweb_hostlogindiv');
			walktheweb.hide('walktheweb_logindiv');
			walktheweb.hide('walktheweb_registerdiv');
			walktheweb.hide('walktheweb_resetpassworddiv');
			walktheweb.hide('walktheweb_loggedindiv');
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-hideLogin=" + ex.message);
		}
	}

	this.toggleOptionalProfile = function() {
		try {
			if (walktheweb.dGet('walktheweb_optionalprofilediv').style.display == 'none') {
				walktheweb.show('walktheweb_optionalprofilediv');
			} else {
				walktheweb.hide('walktheweb_optionalprofilediv');
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-toggleOptionalProfile=" + ex.message);
		}
	}

	this.registerPasswordFocus = function() {
		try {
			walktheweb.dGet('walktheweb_passwordstrengthdiv').style.visibility = 'visible';
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-registerPasswordFocus=" + ex.message);
		}
	}

	this.registerPasswordBlur = function() {
		try {
			walktheweb.dGet('walktheweb_passwordstrengthdiv').style.visibility = 'hidden';
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-registerPasswordBlur=" + ex.message);
		}
	}

	this.scorePassword = function(zpassword) {
		var score = 0;
		try {
			if (zpassword != undefined) {
				/* points for every unique letter until 5 repetitions */
				var letters = new Object();
				for (var i=0; i<zpassword.length; i++) {
					letters[zpassword[i]] = (letters[zpassword[i]] || 0) + 1;
					score += 5.0 / letters[zpassword[i]];
				}
				/* bonus points for complexity */
				var variations = {
					digits: /\d/.test(zpassword),
					lower: /[a-z]/.test(zpassword),
					upper: /[A-Z]/.test(zpassword),
					nonWords: /\W/.test(zpassword),
				}
				variationCount = 0;
				for (var check in variations) {
					variationCount += (variations[check] == true) ? 1 : 0;
				}
				score += (variationCount - 1) * 10;
				score = parseInt(score);
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-scorePassword=" + ex.message);
		}
		return score;
	}

	this.checkPasswordStrength = function(zpassword) {
		score = 0;
		zvalue = "Poor Password";
		zcolor = "#F87777";
		try {
			var score = walktheweb.scorePassword(zpassword);
			if (score > 80) {
				zvalue = "Strong Password";
				zcolor = "#77F893";
			} else if (score > 60) {
				zvalue = "Good Password";
				zcolor = "#DEF877";
			} else if (score >= 30) {
				zvalue = "Weak Password";
				zcolor = "#F8DB77";
			} else {
				zvalue = "Poor Password";
				zcolor = "#F87777";
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-checkPasswordStrength=" + ex.message);
		}
		return {
			'score': score,
			'value': zvalue,
			'color': zcolor };
	}

	this.checkPassword = function(zpasswordtextbox, metername) {
		try {
			var check = walktheweb.checkPasswordStrength(zpasswordtextbox.value);
			if (zpasswordtextbox.value.length > 0) {
				walktheweb.dGet(metername).style.visibility = 'visible';
			} else {
				walktheweb.dGet(metername).style.visibility = 'hidden';
			}
			if (walktheweb.dGet(metername) != null) {
				walktheweb.dGet(metername).value = check.value;
				walktheweb.dGet(metername).style.textAlign = 'center';
				walktheweb.dGet(metername).style.backgroundColor = check.color;
				if (check.score > 80) {
					walktheweb.dGet(metername).style.borderColor = 'green';
				} else {
					walktheweb.dGet(metername).style.borderColor = 'gray';
				}
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-checkPassword=" + ex.message);
		}
	}

	this.checkPasswordConfirm = function(zpassword, zpassword2, zerrortext) {
		try {
			if (walktheweb.dGet(zpassword) != null && walktheweb.dGet(zpassword2) != null && walktheweb.dGet(zerrortext) != null) {
				walktheweb.dGet(zerrortext).innerHTML = "";
				if (walktheweb.dGet(zpassword).value != walktheweb.dGet(zpassword2).value) {
					walktheweb.dGet(zerrortext).innerHTML = "Passwords do not match.";
				}
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-checkPasswordConfirm=" + ex.message);
		}
	}

	this.hostLogin = function() {
		try {
			walktheweb.dGet('walktheweb_hostloginerrortext').innerHTML = "";
			let zemail = walktheweb.dGet('walktheweb_thostemail').value;
			let zpassword = walktheweb.dGet('walktheweb_thostpassword').value;
			let zwpinstanceid = walktheweb.dGet('walktheweb_wpinstanceid').value;
			let zstoreurl = walktheweb.dGet('walktheweb_storeurl').value;
			let zserverip = walktheweb.dGet('walktheweb_serverip').value;
			var zrequest = {
				'useremail':btoa(zemail),
				'password':btoa(zpassword),
				'wpinstanceid':btoa(zwpinstanceid),
				'websiteurl':btoa(zstoreurl),
				'serverip':btoa(zserverip),
				'function':'login'
			};

			walktheweb.postJSON(walktheweb.dGet('walktheweb_hosturl').innerHTML + "connect/userauthenticate.php", zrequest, 
				function(zresponse) {
					zresponse = JSON.parse(zresponse);
					var zuserid = '';
					var zusertoken = '';
					var zwtwusertoken = '';
					if (zresponse.userid != undefined) {
						zuserid = zresponse.userid;
					}
					if (zresponse.wordpresstoken != undefined) {
						zusertoken = atob(zresponse.wordpresstoken);
					}
					if (zresponse.wtwusertoken != undefined) {
						zwtwusertoken = atob(zresponse.wtwusertoken);
					}
					if (zusertoken.length > 100) {
						walktheweb.hide('walktheweb_hostlogindiv');
						walktheweb.hide('walktheweb_logindiv');
						walktheweb.hide('walktheweb_registerdiv');
						walktheweb.hide('walktheweb_resetpassworddiv');
						walktheweb.dGet('walktheweb_usertoken').value = zusertoken;
						walktheweb.dGet('walktheweb_wtwusertoken').value = zwtwusertoken;
						walktheweb.dGet('walktheweb_userid').value = zuserid;
						walktheweb.dGet('walktheweb_temailloggedin').disabled = false;
						walktheweb.dGet('walktheweb_temailloggedin').value = zemail;
						walktheweb.dGet('walktheweb_temailloggedin').disabled = true;
						walktheweb.dGet('walktheweb_wtwemail').disabled = false;
						walktheweb.dGet('walktheweb_wtwemail').value = zemail;
						walktheweb.dGet('walktheweb_wtwemail').disabled = true;
						walktheweb.show('walktheweb_loggedindiv');
						if (walktheweb.dGet('walktheweb_usertoken').value != '' && walktheweb.dGet('walktheweb_wookey').value != '') {
							walktheweb.dGet('walktheweb_step4_5').style.visibility = 'visible';
							walktheweb.dGet('walktheweb_step4_5b').style.visibility = 'visible';
						}
						walktheweb.show('walktheweb_advancedpathsdiv');
						walktheweb.show('walktheweb_advancedoptionsdiv');
					} else {
						walktheweb.dGet('walktheweb_hostloginerrortext').innerHTML = zresponse.serror;
					}
				}
			);
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-hostLogin=" + ex.message);
		}
	}	
	
	this.login = function() {
		try {
			walktheweb.dGet('walktheweb_loginerrortext').innerHTML = "";
			let zemail = walktheweb.dGet('walktheweb_temail').value;
			let zpassword = walktheweb.dGet('walktheweb_tpassword').value;
			let zwpinstanceid = walktheweb.dGet('walktheweb_wpinstanceid').value;
			let zstoreurl = walktheweb.dGet('walktheweb_storeurl').value;
			let zserverip = walktheweb.dGet('walktheweb_serverip').value;
			var zrequest = {
				'useremail':btoa(zemail),
				'password':btoa(zpassword),
				'wpinstanceid':btoa(zwpinstanceid),
				'websiteurl':btoa(zstoreurl),
				'serverip':btoa(zserverip),
				'function':'login'
			};
			walktheweb.postJSON("https://3dnet.walktheweb.com/connect/authenticate.php", zrequest, 
				function(zresponse) {
					zresponse = JSON.parse(zresponse);
					var zuserid = '';
					var zusertoken = '';
					var zwtwusertoken = '';
					if (zresponse.userid != undefined) {
						zuserid = zresponse.userid;
					}
					if (zresponse.usertoken != undefined) {
						zusertoken = zresponse.usertoken;
					}
					if (zresponse.wtwusertoken != undefined) {
						zwtwusertoken = zresponse.wtwusertoken;
					}
					if (zusertoken.length > 100) {
						walktheweb.hide('walktheweb_hostlogindiv');
						walktheweb.hide('walktheweb_logindiv');
						walktheweb.hide('walktheweb_registerdiv');
						walktheweb.hide('walktheweb_resetpassworddiv');
						walktheweb.dGet('walktheweb_usertoken').value = zusertoken;
						walktheweb.dGet('walktheweb_wtwusertoken').value = zwtwusertoken;
						walktheweb.dGet('walktheweb_userid').value = zuserid;
						walktheweb.dGet('walktheweb_temailloggedin').disabled = false;
						walktheweb.dGet('walktheweb_temailloggedin').value = zemail;
						walktheweb.dGet('walktheweb_temailloggedin').disabled = true;
						walktheweb.dGet('walktheweb_wtwemail').disabled = false;
						walktheweb.dGet('walktheweb_wtwemail').value = zemail;
						walktheweb.dGet('walktheweb_wtwemail').disabled = true;
						walktheweb.show('walktheweb_loggedindiv');
						if (walktheweb.dGet('walktheweb_usertoken').value != '' && walktheweb.dGet('walktheweb_wookey').value != '') {
							walktheweb.dGet('walktheweb_step4_5').style.visibility = 'visible';
							walktheweb.dGet('walktheweb_step4_5b').style.visibility = 'visible';
						}
						walktheweb.show('walktheweb_advancedpathsdiv');
						walktheweb.show('walktheweb_advancedoptionsdiv');
					} else {
						walktheweb.dGet('walktheweb_loginerrortext').innerHTML = zresponse.serror;
					}
				}
			);
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-login=" + ex.message);
		}
	}	
	
	this.createAccount = function() {
		try {
			walktheweb.dGet('walktheweb_registererrortext').innerHTML = '';
			
			let zwpinstanceid = walktheweb.dGet('walktheweb_wpinstanceid').value;
			let zstoreurl = walktheweb.dGet('walktheweb_storeurl').value;
			let zserverip = walktheweb.dGet('walktheweb_serverip').value;
			let zemail = walktheweb.dGet('walktheweb_tnewemail').value;
			let zpassword = walktheweb.dGet('walktheweb_tnewpassword').value;
			let zpassword2 = walktheweb.dGet('walktheweb_tnewpassword2').value;
			let zdisplayname = walktheweb.dGet('walktheweb_tnewdisplayname').value;
			let zfirstname = walktheweb.dGet('walktheweb_tnewfirstname').value;
			let zlastname = walktheweb.dGet('walktheweb_tnewlastname').value;
			let zgender = walktheweb.dGet('walktheweb_tnewgender').value;
			let zdob = walktheweb.dGet('walktheweb_tnewdob').value;

			var zrequest = {
				'useremail':btoa(zemail),
				'password':btoa(zpassword),
				'password2':btoa(zpassword2),
				'displayname':btoa(zdisplayname),
				'firstname':btoa(zfirstname),
				'lastname':btoa(zlastname),
				'gender':btoa(zgender),
				'dob':btoa(zdob),
				'wpinstanceid':btoa(zwpinstanceid),
				'websiteurl':btoa(zstoreurl),
				'serverip':btoa(zserverip),
				'function':'register'
			};
			walktheweb.postJSON("https://3dnet.walktheweb.com/connect/authenticate.php", zrequest,
				function(zresponse) {
					zresponse = JSON.parse(zresponse);
					var zuserid = '';
					var zusertoken = '';
					var zwtwusertoken = '';
					if (zresponse.userid != undefined) {
						zuserid = zresponse.userid;
					}
					if (zresponse.usertoken != undefined) {
						zusertoken = zresponse.usertoken;
					}
					if (zresponse.wtwusertoken != undefined) {
						zwtwusertoken = zresponse.wtwusertoken;
					}
					if (zusertoken.length > 100) {
						walktheweb.hide('walktheweb_hostlogindiv');
						walktheweb.hide('walktheweb_logindiv');
						walktheweb.hide('walktheweb_registerdiv');
						walktheweb.hide('walktheweb_resetpassworddiv');
						walktheweb.dGet('walktheweb_usertoken').value = zusertoken;
						walktheweb.dGet('walktheweb_wtwusertoken').value = zwtwusertoken;
						walktheweb.dGet('walktheweb_userid').value = zuserid;
						walktheweb.dGet('walktheweb_temailloggedin').disabled = false;
						walktheweb.dGet('walktheweb_temailloggedin').value = zemail;
						walktheweb.dGet('walktheweb_temailloggedin').disabled = true;
						walktheweb.dGet('walktheweb_wtwemail').disabled = false;
						walktheweb.dGet('walktheweb_wtwemail').value = zemail;
						walktheweb.dGet('walktheweb_wtwemail').disabled = true;
						walktheweb.show('walktheweb_loggedindiv');
						if (walktheweb.dGet('walktheweb_usertoken').value != '' && walktheweb.dGet('walktheweb_wookey').value != '') {
							walktheweb.dGet('walktheweb_step4_5').style.visibility = 'visible';
							walktheweb.dGet('walktheweb_step4_5b').style.visibility = 'visible';
						}
						walktheweb.show('walktheweb_advancedpathsdiv');
						walktheweb.show('walktheweb_advancedoptionsdiv');
					} else {
						walktheweb.dGet('walktheweb_registererrortext').innerHTML = zresponse.serror;
					}
				}
			);
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-createAccount=" + ex.message);
		}
	}

	this.createIt = function() {
		try {
			walktheweb.hide('walktheweb_reviewdev');
			walktheweb.hide('walktheweb_newhostedwebsitedev');
			walktheweb.show('walktheweb_creatingdev');
			walktheweb.startWaiting(1);

			walktheweb.dGet('walktheweb_wtwemail').disabled = false;
			walktheweb.dGet('walktheweb_wtwstorename').disabled = false;
			walktheweb.dGet('walktheweb_wtwurl').disabled = false;
			walktheweb.dGet('walktheweb_thosting').disabled = false;

			let zwpinstanceid = walktheweb.dGet('walktheweb_wpinstanceid').value;
			let zwebsiteurl = walktheweb.dGet('walktheweb_websiteurl').value;
			let zbuildingid = walktheweb.dGet('walktheweb_buildingid').value;
			let zcommunityid = walktheweb.dGet('walktheweb_communityid').value;

			let zusertoken = walktheweb.dGet('walktheweb_usertoken').value;
			let zwtwusertoken = walktheweb.dGet('walktheweb_wtwusertoken').value;
			let zwtwemail = walktheweb.dGet('walktheweb_wtwemail').value;
			let zuserid = walktheweb.dGet('walktheweb_userid').value;
	
			let zhostid = -1;
			let zhosturl = walktheweb.dGet('walktheweb_hosturl').innerHTML;
			let zwtwurl = walktheweb.dGet('walktheweb_wtwurl').value;
			let zwebname = walktheweb.dGet('walktheweb_webname').value;
			let zwtwstorename = walktheweb.dGet('walktheweb_wtwstorename').value;

			let zwookey = walktheweb.dGet('walktheweb_wookey').value;
			let zwoosecret = walktheweb.dGet('walktheweb_woosecret').value;
			let zwookeyid = walktheweb.dGet('walktheweb_wookeyid').value;
			let zstoreurl = walktheweb.dGet('walktheweb_storeurl').value;
			let zstorecarturl = walktheweb.dGet('walktheweb_storecarturl').value;
			let zstoreproducturl = walktheweb.dGet('walktheweb_storeproducturl').value;
			let zstoreapiurl = walktheweb.dGet('walktheweb_storewooapiurl').value;
			
			let ziframes = '1';
			if (walktheweb.dGet('walktheweb_tallowiframe').checked == false) {
				ziframes = '0';
			}
			
			var zrequest = {
				'wpinstanceid':btoa(zwpinstanceid),
				'websiteurl':btoa(zwebsiteurl),
				'buildingid':btoa(zbuildingid),
				'communityid':btoa(zcommunityid),
				'usertoken':zusertoken,
				'wtwusertoken':zwtwusertoken,
				'wtwemail':btoa(zwtwemail),
				'userid':btoa(zuserid),
				'hosturl':btoa(zhosturl),
				'wtwurl':btoa(zwtwurl),
				'webname':btoa(zwebname),
				'wtwstorename':btoa(zwtwstorename),
				'wookey':btoa(zwookey),
				'woosecret':btoa(zwoosecret),
				'storeurl':btoa(zstoreurl),
				'storecarturl':btoa(zstorecarturl),
				'storeproducturl':btoa(zstoreproducturl),
				'storeapiurl':btoa(zstoreapiurl),
				'iframes':btoa(ziframes),
				'function':'createcommunityandbuilding'
			};

			walktheweb.postJSON(zhosturl + "connect/wordpress.php", zrequest,
				function(zresponse) {
					zresponse = JSON.parse(zresponse);
					walktheweb.dGet('walktheweb_buildingid').value = zresponse.buildingid;
					walktheweb.dGet('walktheweb_communityid').value = zresponse.communityid;
					walktheweb.dGet('walktheweb_visitwebsite').href = zhosturl + zwebname;
					walktheweb.hide('walktheweb_creatingdev');
					walktheweb.startWaiting(0);
					walktheweb.dGet('walktheweb_bval').value = 'walktheweb_createwebsite';
					walktheweb.dGet('walktheweb_submit').click();
				}
			);
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-createIt=" + ex.message);
		}
	}
	
	this.waitingTimer = null;
	this.waiting = false;
	
	this.startWaiting = function(zon) {
		try {
			if (zon == undefined) {
				zon = 1;
			}
			let zincrement = 2;
			let zball = [];
			zball[0] = {
				'name':'walktheweb_progress0',
				'dir':-zincrement,
				'start':0 };
			zball[1] = {
				'name':'walktheweb_progress1',
				'dir':-zincrement,
				'start':0 };
			zball[2] = {
				'name':'walktheweb_progress2',
				'dir':-zincrement,
				'start':0 };
			zball[3] = {
				'name':'walktheweb_progress3',
				'dir':-zincrement,
				'start':0 };
			zball[4] = {
				'name':'walktheweb_progress4',
				'dir':-zincrement,
				'start':0 };
			zball[5] = {
				'name':'walktheweb_progress5',
				'dir':-zincrement,
				'start':0 };
			zball[6] = {
				'name':'walktheweb_progress6',
				'dir':-zincrement,
				'start':0 };
			zball[7] = {
				'name':'walktheweb_progress7',
				'dir':-zincrement,
				'start':0 };
			zball[8] = {
				'name':'walktheweb_progress8',
				'dir':-zincrement,
				'start':0 };
			zball[9] = {
				'name':'walktheweb_progress9',
				'dir':-zincrement,
				'start':0 };
			
			let zstartcounter = 101;
			let zstart = 0;
			if (walktheweb.waitingTimer == null && zon == 1) {
				walktheweb.waitingTimer = window.setInterval(function() {
					if (zstart < 10) {
						if (zstartcounter > 50) {
							if (zball[zstart] != null) {
								zball[zstart].start = 1;
								zstart += 1;
								zstartcounter = 0;
							}
						} else {
							zstartcounter += 1;
						}
					}
					for (var i=0;i<10;i++) {
						if (zball[i].start == 1) {
							var zheight = Number(document.getElementById(zball[i].name).style.marginTop.replace("px",""));
							var zdir = zball[i].dir;
							if (zheight <= -150 && zdir == -zincrement) {
								zdir = zincrement;
							} else if (zheight >= 150 && zdir == zincrement) {
								zdir = -zincrement;
							}
							zball[i].dir = zdir;
							document.getElementById(zball[i].name).style.marginTop = (zheight + zdir) + "px";
						}
					}
				}, 5);
			} else {
				for (var i=0;i<10;i++) {
					document.getElementById(zball[i].name).style.marginTop = "150px";
				}
				window.clearInterval(walktheweb.waitingTimer);
				walktheweb.waitingTimer = null;
				walktheweb.show('walktheweb_newhostedwebsitedev');
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-startWaiting=" + ex.message);
		}
	}
	
	this.hostRequest = function() {
		try {
			walktheweb.dGet('walktheweb_addhosterror').innerHTML = '';
			let zhosturl = walktheweb.dGet('walktheweb_hosturl').value;
			let zwpinstanceid = walktheweb.dGet('walktheweb_wpinstanceid').value;
			
			var zrequest = {
				'appid':btoa(zwpinstanceid),
				'appname':btoa('WalkTheWeb WordPress Plugin'),
				'hosturl':btoa(zhosturl),
				'wtwkey':walktheweb.dGet('walktheweb_wtwkey').value,
				'wtwsecret':walktheweb.dGet('walktheweb_wtwsecret').value,
				'function':'hostrequest'
			};

			walktheweb.postJSON(zhosturl + "/connect/apikeys.php", zrequest,
				function(zresponse) {
					zresponse = JSON.parse(zresponse);
					if (walktheweb.dGet('walktheweb_addhosterror') != null) {
						if (zresponse.serror != '') {
							walktheweb.dGet('walktheweb_addhosterror').innerHTML = zresponse.serror;
						} else if (zresponse.hostid != '') {
							walktheweb.dGet('walktheweb_bval').value = 'walktheweb_save';
							walktheweb.dGet('walktheweb_hostid').value = zresponse.hostid;
							walktheweb.dGet('walktheweb_submit').click();
						}
					}
				}
			);
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-hostRequest=" + ex.message);
		}
	}

	this.checkHosts = function() {
		try {
			var zcols = document.getElementsByClassName('walktheweb_col4');
			for (var i = 0;i < zcols.length;i++) {
				if (zcols[i] != null) {
					var zobjs = zcols[i].childNodes;
					for (var j=0;j < zobjs.length;j++) {
						if (zobjs[j] != null) {
							if (zobjs[j].id != undefined) {
								if (zobjs[j].id.indexOf('walktheweb_hosturl-') > -1) {
									var zkey = zobjs[j].id.replace('walktheweb_hosturl-','');
									var zhosturl = walktheweb.dGet('walktheweb_hosturl-' + zkey).value;
									var zrequest = {
										'wtwkey':walktheweb.dGet('walktheweb_wtwkey-' + zkey).value,
										'wtwsecret':walktheweb.dGet('walktheweb_wtwsecret-' + zkey).value,
										'hosturl':zhosturl,
										'function':'checkhost'
									};
									walktheweb.postJSON(zhosturl + "/connect/apikeys.php", zrequest,
										function(zresponse) {
											zresponse = JSON.parse(zresponse);
											if (zresponse.wtwkey != undefined) {
												if (zresponse.wtwkey.indexOf("...") > -1) {
													var zwtwkey = zresponse.wtwkey.replace("...","");
													if (walktheweb.dGet('walktheweb_apicheck-' + zwtwkey) != null) {
														walktheweb.dGet('walktheweb_apicheck-' + zwtwkey).value = zresponse.serror;
														switch (zresponse.serror) {
															case "Waiting on Approval":
																walktheweb.dGet('walktheweb_noteapproval').className = "walktheweb_notes";
																break;
														}
													}
												}
											}
										}
									);
								}
							}
						}
					}
				}
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-checkHosts=" + ex.message);
		}
	}

	this.adRotate = function(zstart) {
		try {
			if (zstart == undefined) {
				zstart = 1;
			}
			if (walktheweb.adtimer == null && zstart == 1) {
				var zimageindex = walktheweb.activead;
				if (document.getElementById('walktheweb_dashboardboxhome') != null) {
					document.getElementById('walktheweb_dashboardboxhome').style = "background:url('" + walktheweb.imagepath + walktheweb.imagearray[zimageindex].imagefile + "');background-size: cover, auto; background-position: center center;background-color:#000000;";
				}
				if (document.getElementById('walktheweb_dashboardboxtext') != null) {
					document.getElementById('walktheweb_dashboardboxtext').style.visibility = 'hidden';
					if (walktheweb.imagearray[zimageindex].imagetext != '') {
						if (document.getElementById('walktheweb_dashboardboxtext') != null) {
							document.getElementById('walktheweb_dashboardboxtext').innerHTML = walktheweb.imagearray[zimageindex].imagetext;
							document.getElementById('walktheweb_dashboardboxtext').style.visibility = 'visible';
							document.getElementById('walktheweb_dashboardboxtext').className = 'walktheweb_dashboardboxtext';
						}
					}
				}
				walktheweb.adtimer = setTimeout(function() {
					window.clearTimeout(walktheweb.adtimer);
					walktheweb.adtimer = null;
					walktheweb.activead += 1;
					if (walktheweb.imagearray[walktheweb.activead] == null) {
						walktheweb.activead = 0;
					}
					walktheweb.adRotate(zstart);
				},walktheweb.imagearray[zimageindex].timer);
			} else if (zstart == 0) {
				if (walktheweb.adtimer == null) {
					window.clearTimeout(walktheweb.adtimer);
					walktheweb.adtimer = null;
				}
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_main.js-adRotate=" + ex.message);
		}
	}	
}

var walktheweb = new WalkTheWeb();