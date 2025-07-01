
function changeCSS2(sLink, sSelect)  {
    document.getElementById(sLink).href = document.getElementById(sSelect).value
}



function log_out() {
	ht = document.getElementsByTagName("html");
	ht[0].style.filter = "progid:DXImageTransform.Microsoft.BasicImage(grayscale=1)";
	if (confirm(dplang['confirm_logout'])) {
		return true;
	} else {
		ht[0].style.filter = "";
		return false;
	}
}



function openWindow(url,w,h,windowname,postop,posleft) {
	if (!w) {
		w = '600';
	}
	if (!h) {
		h = '400';
	}
	if (!windowname) {
		windowname = 'window';
	}

	var opt = 'width='+w+',height='+h+',resizeable=yes,scrollbars=yes,menubar=no,toolbar=no,location=no,status=yes';

	if (postop) {
		opt += ',top=' + postop;
	}

	if (posleft) {
		opt += ',left=' + posleft;
	}


	var popupWin=window.open(url,windowname,opt);

	if (popupWin) {
		popupWin.focus();
		return true;
	} else {
		return false;
	}
}

function jprompt(message,url) {
	input_box=confirm(message);
	if (input_box==true) {
		window.location=url;
	}
}

function submitform(formname,valuename,thevalue) {
	document.forms[formname].elements[valuename].value = thevalue;
	document.forms[formname].submit();
}


if (window.addLoadEvent)
{
	//return true;
}
else
{
	// Simon Willison's addLoadEvent handler
	function addLoadEvent(func)
	{
	  var oldonload = window.onload;
	  if (typeof window.onload != 'function') {
		window.onload = func;
	  } else {
		window.onload = function() {
		  oldonload();
		  func();
		}
	  }
	}
}

addLoadEvent(function () {
	if (!document.getElementsByTagName) return false;

	// Hack
	/*
	var tmp;
	// do form fields focus for IE
	var fieldsInput = document.getElementsByTagName('input');
	for (i=0; i < fieldsInput.length; i++)
	{
		if ((fieldsInput[i].type == 'text' || fieldsInput[i].type == 'password'))
		{
			fieldsInput[i].onfocus = function () {
				this.className += " focus";
			}
			fieldsInput[i].onblur = function () {
				//this.className = this.className.replace(new RegExp(" focus\\b"), "");
				tmp = this.className.split(' ');
				this.className = tmp[0];
			}
		}
	}
	var fieldsTextarea = document.getElementsByTagName('textarea');
	for (var j=0; j < fieldsTextarea.length; j++)
	{
		fieldsTextarea[j].onfocus = function () {
			this.className += " focus";
		}
		fieldsTextarea[j].onblur = function () {
			//this.className = this.className.replace(new RegExp(" focus\\b"), "");
			tmp = this.className.split(' ');
			this.className = "";
		}
	}
	*/
	
	// do front-nav hover for IE
	if (!document.getElementById) return false;
	if (!document.getElementById("frontnav")) return false;
	var frontnav = document.getElementById("frontnav");
	var lis = frontnav.getElementsByTagName("li");
	for (var i=0; i < lis.length; i++)
	{
		lis[i].onmouseover = function()
		{
			this.className = "hover";
		}
		lis[i].onmouseout = function()
		{
			this.className = "";
		}
	}
	return true;
});

function oc(id) {
	var e=document.getElementById(id).style;
	if (e.display=='') {
		e.display='none';
	} else {
		e.display='';
	}
}

function visno(id) {
	e=document.getElementById(id).style;
	e.display='none';
}

function visyes(id) {
	e=document.getElementById(id).style;
	e.display='';
}



/* Style sheet switcher and font size resizer, including cookie functionality */
var sheets = document.getElementsByTagName('link');

var current, currentsize, reset;
var fromcookie = false;

function setActiveStyleSheet(title, textsize) {
	var i, j;

	var body = document.body;
	currentsize = textsize != '' ? textsize : 100;
	body.style.fontSize = currentsize + "%";
	reset = fromcookie == true ? reset : currentsize;

	for(i = 0; i < sheets.length; i++) {
		sheets[i].disabled = true;
		if (sheets[i].getAttribute("rel").indexOf("style") != -1) {
			if (!title && !sheets[i].getAttribute("title")) {
				sheets[i].disabled = false;
			}
			if (title && sheets[i].getAttribute("title") == title && sheets[i].getAttribute("rev") && sheets[i].getAttribute("rev")) {
				sheets[i].disabled = false;
			}
			if (title && sheets[i].getAttribute("title") == title && !sheets[i].getAttribute("rev")) {
				sheets[i].disabled = false;

				for (j = 0; j < sheets.length; j++) {
					if (!sheets[j].getAttribute("title")) {
						sheets[j].disabled = false;
					}
				}
			}
		}
	}
	current = title ? title : '';
	fromcookie = false;
}

function styleChanged(current, currentsize) {
	var cookie = getCookie("style");
	cookie != current ?	createCookie("style", current) : '';

	var font = getCookie("fontsize");
	if (currentsize != undefined) {
		font != currentsize ? createCookie("fontsize", currentsize) : '';
	}

	createCookie("reset", reset);
}

function getPreferredStyleSheet() {
	for(var i = 0; i < sheets.length; i++) {
		if (sheets[i].getAttribute("rel").indexOf("style") != -1 && sheets[i].getAttribute("rel").indexOf("alt") == -1 && sheets[i].getAttribute("title")) {
			return sheets[i].getAttribute("title");
		}
	}
	return '';
}

function createCookie(type, value) {
	var date = new Date();
	date.setTime(date.getTime()+(365*24*60*60*1000));
	var expires = "; expires="+date.toGMTString();
    document.cookie = type+"="+ value + expires + "; path=/";
}

function getCookie(type) {
	var info = type + "=";
	var cookies = document.cookie.split(';');

	for(var i = 0; i < cookies.length; i++) {
		var title = cookies[i].replace(/^\s+/, '');

		if (title.indexOf(info) == 0) {
			if (title.substring(info.length, title.length) == "null") {
				return '';
			}
			return title.substring(info.length, title.length);
		}
	}
	return '';
}

window.onunload = function(e) {
	styleChanged(current, currentsize);
}

//addLoadEvent(function() {
var addLoadEvent_function = function() {
	var cookie = getCookie("style");
	var font = getCookie("fontsize");
	var resetcookie = getCookie("reset");
	var title = cookie ? cookie : getPreferredStyleSheet();
	reset = resetcookie ? resetcookie : 100;
	var fontsize = font ? font : 100;
	fromcookie = true;
	setActiveStyleSheet(title, fontsize);
};
addLoadEvent_function();

function splitup(value, separator, part) {
	value = value.split(separator);

	return value[part];
}

function sizetext(action) {
	var newsize;
	var body = document.body;
	var size = (body.style.fontSize != null) ? body.style.fontSize : '';
	var value = size == '' ? "100" : splitup(size, "%", 0);

	switch(action) {
		case "up":
			newsize = parseInt(value) + 10;
			break;
		case "down":
			newsize = parseInt(value) - 10;
			break;
		case "reset":
			newsize = reset;
			break;
	} //increase or decrease according to given action

	var increase = newsize + "%";
	currentsize = newsize;
	body.style.fontSize = increase;
}

var _img_verify_count = 0;
function reload_image_verify(startnum, maxnum) {

	var el_img = document.getElementById('img_verify');
	var el_link = document.getElementById('img_verify_reload');

	if (!startnum) {
		startnum = 0;
	}

	if (!maxnum) {
		maxnum = 99;
	}

	var numcheck = _img_verify_count + startnum;

	if(numcheck >= (maxnum - 1)) {
		el_link.style.display = 'none';
	}

	if(numcheck >= maxnum) {
		return;
	}

	var new_src = el_img.src;
	new_src = new_src.replace(/t=([0-9]+)/, 't=$1' + _img_verify_count + '&new=1');

	el_img.src = new_src;
	_img_verify_count++;
}

function popchat() {
	var win = DeskPRO.openWindow({
		url: 'chat.php?do=form',
		toolbar: 'no',
		location: 'no',
		status: 'no',
		menubar: 'no',
		width: 750,
		height: 520,
		resizable: 'yes',
		scrollbars: 'yes'
	});
	
	if (win) {
		return true;
	} else {
		return false;
	}
}
