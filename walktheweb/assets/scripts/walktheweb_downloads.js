function WalkTheWeb_Downloads() {
	this.admin = null;
	this.serverinstanceid = 'aaaaaaaaaaaaaaaa';
	this.serverip = '0.0.0.0';
	
	dGet = function(value) {
		var obj = null;
		try {
			obj = document.getElementById(value);
		} catch (ex) {
			
		}
		return obj;
	}
	
	this.dGet = function(value) {
		var obj = null;
		try {
			obj = document.getElementById(value);
		} catch (ex) {
			
		}
		return obj;
	}
	
	this.log = function(zmessage,zcolor) {
		try {
			if (zcolor == undefined) {
				zcolor = 'black';
			}
			if (zcolor.toLowerCase() == 'black') {
				console.log('\r\n' + zmessage);
			} else {
				console.log('\r\n%c' + zmessage, 'color:' + zcolor + ';font-weight:bold;');
			}
		} catch (ex) {
			
		}
	}

	this.show = function(zid) {
		try {
			if (document.getElementById(zid) != null) {
				document.getElementById(zid).style.display = 'block';
				document.getElementById(zid).style.visibility = 'visible';
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_downloads.js-show-" + ex.message);
		}
	}

	this.showInline = function(zid) {
		try {
			if (document.getElementById(zid) != null) {
				document.getElementById(zid).style.display = 'inline-block';
				document.getElementById(zid).style.visibility = 'visible';
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_downloads.js-showInline-" + ex.message);
		}
	}

	this.hide = function(zid) {
		try {
			if (document.getElementById(zid) != null) {
				document.getElementById(zid).style.display = 'none';
				document.getElementById(zid).style.visibility = 'hidden';
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_downloads.js-hide-" + ex.message);
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
			walktheweb.serror("walktheweb_downloads.js-getJSON-" + ex.message);
		}
	}
	
	this.postJSON = function(zurl, zrequest, zcallback) {
		/* performs a form POST based JSON call for data */
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
			walktheweb.serror("walktheweb_downloads.js-postJSON=" + ex.message);
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
			walktheweb.serror("walktheweb_downloads.js-encode=" + ex.message);
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
			walktheweb.serror("walktheweb_downloads.js-decode=" + ex.message);
		}
		return String(zvalue);
	}

	this.cleanInvalidCharacters = function(zvalue) {
		/* remove line breaks and other select non text characters from string */
		try {
			if (zvalue != null) {
				zvalue = zvalue.replace(/\\n/g, "\\n")  
				   .replace(/\\'/g, "\\'")
				   .replace(/\\"/g, '\\"')
				   .replace(/\\&/g, "\\&")
				   .replace(/\\r/g, "\\r")
				   .replace(/\\t/g, "\\t")
				   .replace(/\\b/g, "\\b")
				   .replace(/\\f/g, "\\f");
				// remove non-printable and other non-valid JSON chars
				zvalue = zvalue.replace(/[\u0000-\u0019]+/g,""); 
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_downloads.js-cleanInvalidCharacters=" + ex.message);
		}
		return zvalue;
	}

	this.isNumeric = function(n) {
		/* boolean - is a text string a number */
		return !isNaN(parseFloat(n)) && isFinite(n);
	}

	this.clearDDL = function(ddlname) {
		/* clear a drop-down list - remove all values (often used to prepare for reloading) */
		try {
			if (walktheweb_d.dGet(ddlname) != null) {
				var ddl = walktheweb_d.dGet(ddlname);
				for (var i = ddl.options.length - 1 ; i >= 0 ; i--) {
					ddl.remove(i);
				}
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_downloads.js-clearDDL=" + ex.message);
		}
	}

	this.submit = function(bval) {
		try {
			var zhosturl = walktheweb_d.dGet('walktheweb_hosturl').value;
			var zwookeyid = walktheweb_d.dGet('walktheweb_wookeyid').value;
			var zsiteurl = walktheweb_d.dGet('walktheweb_siteurl').value;
			walktheweb_d.dGet('walktheweb_bval').value = bval;
			walktheweb_d.dGet('walktheweb_submit').click();
			var zurl = "";
			walktheweb_d.getJSON(zhosturl + "/connect/wtw-shopping-connect.php?siteurl=" + btoa(zsiteurl) + "&wookeyid=" + btoa(zwookeyid), function(zresults) {
				if (zresults != null) {
					zresults = JSON.parse(zresults);
					
					
					
					
				}
			});
		} catch (ex) {
			walktheweb.serror("walktheweb_downloads.js-submit-" + ex.message);
		}
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

	this.search = function(zsearch, zwebtype, zlist, zversionid) {
		/* keyword search to find a thing to download to your instance */
		try {
			if (zlist == undefined) {
				zlist = 'latest';
			}
			if (zversionid == undefined) {
				zversionid = '';
			}
			zsearch = walktheweb_d.encode(zsearch);
			walktheweb_d.getJSON("https://3dnet.walktheweb.com/connect/sharesearch.php?search=" + zsearch + "&buildingtype=2&webtype=" + zwebtype + "&list=" + zlist + "&versionid=" + zversionid, 
				function(zresponse) {
					if (zsearch == '' && zversionid != '') {
						walktheweb_d.dGet('walktheweb_tsearch').value = zversionid;
					}
					walktheweb_d.searchReply(JSON.parse(zresponse), zwebtype, zlist, zversionid);
				}
			);
		} catch (ex) {
			walktheweb.serror("walktheweb_downloads.js-search=" + ex.message);
		}
	}

	this.searchReply = function(zresponse, zwebtype, zlist, zversionid) {
		/* receives search results and parses for screen display */
		try {
			var zformat = 2;
			var ztempsearchresults = '';
			if (Number(document.getElementById('walktheweb_tcols').value) > 0) {
				zformat = Number(document.getElementById('walktheweb_tcols').value);
			}
			walktheweb_d.dGet('walktheweb_searchresults').innerHTML = "";
			for (var i=0; i < zresponse.length; i++) {
				var zdownloads = 0;
				var zbuttonstyle = '';
				var zwebid = zresponse[i].serverthingid;
				var zcreatedate  = walktheweb_d.formatDate(zresponse[i].createdate);
				var zupdatedate  = walktheweb_d.formatDate(zresponse[i].updatedate);
				if (walktheweb_d.isNumeric(zresponse[i].downloads)) {
					zdownloads = zresponse[i].downloads;
				}
				switch (zwebtype) {
					case 'community':
						zwebid = zresponse[i].servercommunityid;
						break;
					case 'building':
						zwebid = zresponse[i].serverbuildingid;
						break;
					case 'thing':
						zwebid = zresponse[i].serverthingid;
						break;
					case 'avatar':
						zwebid = zresponse[i].serveravatarid;
						break;
				}
				if (zformat > 1) {
					var zcols = '';
					switch (zformat) {
						case 2:
							zcols = 'walktheweb_largecol';
							break;
						case 3:
							zcols = 'walktheweb_medcol';
							break;
						case 4:
							zcols = 'walktheweb_mincol';
							break;
					}
					ztempsearchresults += "<div class='" + zcols + "'>";
					zbuttonstyle = "style='margin:2px 2px 5px 5px;'";
				}
				if (zwebtype != 'plugin') {
					ztempsearchresults += "<input type='button' id='walktheweb_bthtempselect" + i + "' class='walktheweb_searchresultbutton' value='Download' onclick=\"walktheweb_d.downloadQueue('" + zwebid + "','" + zwebtype + "','" + zresponse[i].templatename + "','" + zresponse[i].description + "','" + zresponse[i].displayname + "','" + zupdatedate + "','" + zresponse[i].imageurl + "');\" " + zbuttonstyle + " />";
				} else {
					ztempsearchresults += "<input type='button' id='walktheweb_bthtempselect" + i + "' class='walktheweb_searchresultbutton' value='Download' onclick=\"walktheweb_d.downloadFile('" + zresponse[i].downloadurl + "');\" " + zbuttonstyle + " />";
				}
				ztempsearchresults += "<div class='walktheweb_textdescription'>";
				if (zformat > 2) {
					ztempsearchresults += "<div style='clear:both;'></div>";
				}
				ztempsearchresults += "<h3 class=\"walktheweb_black\">" + zresponse[i].templatename
				if (zwebtype == 'plugin') {
					ztempsearchresults += "<br />[" + zresponse[i].pluginname + "]";
				}
				ztempsearchresults += "</h3><br />";
				ztempsearchresults += "<div style='white-space:normal;font-weight:normal;color:#000000;'>" + zresponse[i].description + "</div><br />";
				
				if (zresponse[i].version == '1.0.0') {
					ztempsearchresults += "<div style='white-space:normal;font-weight:normal;color:#000000;'>Created By: <b>" + zresponse[i].createdisplayname + "</b> (<b>" + zupdatedate + "</b>)</div><br />";
				} else {
					ztempsearchresults += "<div style='white-space:normal;font-weight:normal;color:#000000;'>Created By: <b>" + zresponse[i].createdisplayname + "</b> (<b>" + zcreatedate + "</b>)</div><br />";
					ztempsearchresults += "<div style='white-space:normal;font-weight:normal;color:#000000;'>Updated By: <b>" + zresponse[i].displayname + "</b> (<b>" + zupdatedate + "</b>)</div><br />";
				}
				ztempsearchresults += "<div style='white-space:normal;font-weight:normal;color:#000000;'>Version: <b>[" + zresponse[i].version + "]</b> " + zresponse[i].versiondesc + ".";
				
				if (zresponse[i].version != '1.0.0' && zversionid != zresponse[i].versionid && zresponse[i].versionorder == zresponse[i].versionmax) {
					ztempsearchresults += "<div class='walktheweb_simplelink' onclick=\"walktheweb_d.search('','" + zwebtype + "','version','" + zresponse[i].versionid + "');\"><span style='color:green;font-weight:bold;'>*Latest Version</span> - Show Previous Versions</div>";
				} else if (zversionid == zresponse[i].versionid && zresponse[i].versionorder != zresponse[i].versionmax) {
					ztempsearchresults += "<div class='walktheweb_simplelink' onclick=\"walktheweb_d.search('','" + zwebtype + "','version','" + zresponse[i].versionid + "');\">Newer Version Available</div>";
				} else {
					ztempsearchresults += "<div style='color:green;font-weight:bold;'>*This is the Latest Version</div>";
				}
				ztempsearchresults += "</div><br />";

				if (zwebtype != 'plugin') {
					ztempsearchresults += "<div style='white-space:normal;font-weight:normal;color:#000000;'>Downloaded: <b>" +	zdownloads + "</b> times.</div><br />";
				} else {
					ztempsearchresults += "<a href='" + zresponse[i].githuburl + "' target='_blank'>" + zresponse[i].githuburl + "</a><br />";
				}
				ztempsearchresults += "</div>";
				if (zresponse[i].imageurl != "") {
					ztempsearchresults += "<div style=\"clear:both;\"></div><img id='walktheweb_search" + zwebid + "' src='" + zresponse[i].imageurl + "' onmouseover=\"this.style.border='1px solid yellow';\" onmouseout=\"this.style.border='1px solid gray';\" onclick=\"walktheweb_d.downloadQueue('" + zwebid + "','" + zwebtype + "','" + zresponse[i].templatename + "','" + zresponse[i].description + "','" + zresponse[i].displayname + "','" + zupdatedate + "','" + zresponse[i].imageurl + "');\" style=\"margin:2%;border:1px solid gray;cursor:pointer;width:96%;height:auto;\" alt='" + zresponse[i].templatename + "' title='" + zresponse[i].templatename + "' />";
				}
				if (zformat > 1) {
					ztempsearchresults += "</div>";
				} else {
					ztempsearchresults += "<br /><hr style=\"width:96%;\" />";
				}
			}
			walktheweb_d.dGet('walktheweb_searchresults').innerHTML = ztempsearchresults;
		} catch (ex) {
			walktheweb.serror("walktheweb_downloads.js-searchReply=" + ex.message);
		}
	}
	
	this.downloadFile = function(zdownloadurl) {
		try {
			var zlink = document.createElement("a");
			zlink.href = zdownloadurl;
			document.body.appendChild(zlink);
			zlink.click();
			zlink.remove();
		} catch (ex) {
			walktheweb.serror("walktheweb_downloads.js-downloadFile=" + ex.message);
		}
	}
	
	this.downloadQueue = function(zcopywebid, zwebtype, ztitle, zdesc, zauthor, zcreatedate, zimage) {
		try {
			walktheweb_d.show('walktheweb_previewdiv');
			walktheweb_d.dGet('walktheweb_twebid').value = zcopywebid;
			walktheweb_d.dGet('walktheweb_twebtype').value = zwebtype;
			walktheweb_d.dGet('walktheweb_title').innerHTML = ztitle;
			walktheweb_d.dGet('walktheweb_desc').innerHTML = zdesc;
			walktheweb_d.dGet('walktheweb_author').innerHTML = '<b>Created By:</b> ' + zauthor;
			walktheweb_d.dGet('walktheweb_date').innerHTML = '<b>Create Date:</b> ' + zcreatedate;
			if (zimage != '') {
				walktheweb_d.dGet('walktheweb_preview').src = zimage;
				walktheweb_d.show('walktheweb_preview');
			} else {
				walktheweb_d.hide('walktheweb_preview');
			}
			walktheweb_d.show('walktheweb_confirm');
			walktheweb_d.dGet('walktheweb_twebsite').focus();
		} catch (ex) {
			walktheweb.serror("walktheweb_downloads.js-downloadQueue=" + ex.message);
		}
	}

	this.downloadWeb = function() {
		try {
			walktheweb_d.hide('walktheweb_previewdiv');
			walktheweb_d.dGet('walktheweb_success').innerHTML = '';
			var zwebid = walktheweb_d.dGet('walktheweb_twebid').value;
			var zwebtype = walktheweb_d.dGet('walktheweb_twebtype').value;
			var zhosturl = walktheweb_d.dGet('walktheweb_twebsite').value;
			if (zhosturl.length > 9) {
				if (zhosturl.substr((zhosturl.length-1),1) == '/') {
					zhosturl = zhosturl.substr(0,(zhosturl.length-1));
				}
				var zrequest = {
					'webid': zwebid,
					'webtype': zwebtype,
					'function':'downloadqueue'
				};
				walktheweb_d.postJSON(zhosturl + "/connect/wordpress.php", zrequest, 
					function(zresponse) {
						zresponse = JSON.parse(zresponse);
						if (zresponse.serror != '') {
							walktheweb_d.show('walktheweb_previewdiv');
							walktheweb_d.dGet('walktheweb_success').innerHTML = "<span style='color:red;'>" + zresponse.serror + "</span>";
						} else {
							walktheweb_d.dGet('walktheweb_success').innerHTML = 'Download Sent Successfully';
						}
						window.setTimeout(function(){
							walktheweb_d.dGet('walktheweb_success').innerHTML = '';
							walktheweb_d.hide('walktheweb_confirm');
						},5000);
					}
				);
			} else {
				walktheweb_d.dGet('walktheweb_success').innerHTML = "<span style='color:red;'>Please enter your WalkTheWeb Server URL</span>";
				window.setTimeout(function(){
					walktheweb_d.dGet('walktheweb_success').innerHTML = '';
				},5000);
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_downloads.js-downloadWeb=" + ex.message);
		}
	}

	this.updateCols = function(zobj, zcols) {
		try {
			document.getElementById('walktheweb_tcols').value = zcols;
			document.getElementById('walktheweb_col1').className = 'walktheweb_tinyimg';
			document.getElementById('walktheweb_col2').className = 'walktheweb_tinyimg';
			document.getElementById('walktheweb_col3').className = 'walktheweb_tinyimg';
			document.getElementById('walktheweb_col4').className = 'walktheweb_tinyimg';
			document.getElementById('walktheweb_col1').src = document.getElementById('walktheweb_col1').src.replace('set.png','.png');
			document.getElementById('walktheweb_col2').src = document.getElementById('walktheweb_col2').src.replace('set.png','.png');
			document.getElementById('walktheweb_col3').src = document.getElementById('walktheweb_col3').src.replace('set.png','.png');
			document.getElementById('walktheweb_col4').src = document.getElementById('walktheweb_col4').src.replace('set.png','.png');
			document.getElementById(zobj.id).className = 'walktheweb_tinyimgselected';
			zobj.src = zobj.src.replace(zobj.id.replace('walktheweb_','') + '.png', zobj.id.replace('walktheweb_','') + 'set.png');
			if (document.getElementById('walktheweb_tsearch') != null) {
				walktheweb_d.search(document.getElementById('walktheweb_tsearch').value, document.getElementById('walktheweb_twebtype').value);
			}
		} catch (ex) {
			walktheweb.serror("walktheweb_downloads.js-updateCols=" + ex.message);
		}
	}	
	
}

var walktheweb_d = new WalkTheWeb_Downloads();