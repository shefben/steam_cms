function addEvent(el, ev, fn, useCapture)
{
	if(el.addEventListener)
	{
		el.addEventListener(ev, fn, useCapture);
	}
	else if(el.attachEvent)
	{
		var ret = el.attachEvent("on"+ev, fn);
		return ret;
	}
	else
	{
		el["on"+ev] = fn;
	}
}
function fixFloatHeight(floatDiv, fixedDiv, type, topDiv)
{
	floatDivEl = document.getElementById(floatDiv);
	fixedDivEl = document.getElementById(fixedDiv);
	if(floatDivEl && fixedDivEl)
	{
		floatHeight = floatDivEl.offsetHeight;
		fixedHeight = fixedDivEl.offsetHeight;
		if(type == 1)
		{
			if(topDiv)
			{
				floatHeight += document.getElementById(topDiv).offsetHeight;
			}
			if(floatHeight > fixedHeight)
			{
				fixedDivEl.style.height = floatHeight+'px';
			}
		}
		else
		{
			if(fixedHeight > floatHeight)
			{
				floatDivEl.style.height = fixedHeight+'px';
			}
		}
	}
}

function setCheck(checkDiv, checkField)
{
	realField = eval('document.loginForm.'+checkField);
	curVal = realField.value;
	if(curVal == 0)
	{
		document.getElementById(checkDiv).style.color = '#909090';
		realField.value = 1;
	}
	else
	{
		document.getElementById(checkDiv).style.color = '#000000';
		realField.value = 0;
	}
}

function createQuery(pushUrl, returnFn)
{
	uid = Math.round(Math.random()*100000);
	rUid = "requester"+uid;
	eval(rUid+" = new xHttpQuery();");
	eval(rUid+".pushUrl = pushUrl;");
	eval(rUid+".returnFn = returnFn;");
	eval(rUid+".selfRef = \""+rUid+"\";");
	eval(rUid+".doRequest();");
}

var updateInProgress = false;
function xHttpQuery()
{
	this.pushUrl = '';
	this.selfRef = '';
	this.returnFn = false;
	this.doRequest = function()
	{
		if(updateInProgress == true)
		{
			setTimeout(this.selfRef+".doRequest()", 200);
			return;
		}
//		alert(this.pushUrl);
		updateInProgress = true;
		if(window.XMLHttpRequest)
		{
			req = new XMLHttpRequest();
			req.onreadystatechange = this.returnFn;
			req.open("GET", this.pushUrl, true);
			req.send(null);
		}
		else if(window.ActiveXObject)
		{
			req = new ActiveXObject("Microsoft.XMLHTTP");
			if(req)
			{
				req.onreadystatechange = this.returnFn;
				req.open("POST", this.pushUrl, true);
				req.send();
			}
		}
	}
}

function winDim(wh, vs)
{
	if(window.innerWidth) // most browsers - ff, safari, etc
	{
		return (wh == 'w' ? (vs == 'v' ? window.innerWidth : window.pageXOffset) : (vs == 'v' ? window.innerHeight : window.pageYOffset));
	}
	else if(document.documentElement && document.documentElement.clientWidth) // ie strict
	{
		return (wh == 'w' ? (vs == 'v' ? document.documentElement.clientWidth : document.documentElement.scrollLeft) : (vs == 'v' ? document.documentElement.clientHeight : document.documentElement.scrollTop));
	}
	else // ie normal
	{
		return (wh == 'w' ? (vs == 'v' ? document.body.clientWidth : document.body.scrollLeft) : (vs == 'v' ? document.body.clientHeight : document.body.scrollTop));
	}
}

function getGoodElement(el,nn,cn,next)
{
	if(next == 1)
	{
		el = el.parentNode;
	}
	while(el.nodeName.toLowerCase() != nn && el.nodeName.toLowerCase() != "body")
	{
		el = el.parentNode;
	}
	thisClass = ' '+el.className+' ';
	if(el.nodeName.toLowerCase() != "body" && thisClass.indexOf(' '+cn+' ') == -1)
	{
		return getGoodElement(el,nn,cn,1);
	}
	else if(thisClass.indexOf(' '+cn+' ') != -1)
	{
		return el;
	}
	return false;
}
function addGameActions()
{
	if(!document.getElementsByTagName)
	{
		return;
	}
	var pageDivs = document.getElementsByTagName("div");
	for(var x = 0; x < pageDivs.length; x++)
	{
		tempClassName = " "+pageDivs[x].className+" ";
		tempParentClassName = " "+pageDivs[x].parentNode.className+" ";
		if(tempClassName.indexOf(" gameContainer ") != -1 || tempParentClassName.indexOf(" gameContainer ") != -1)
		{
			addEvent(pageDivs[x], "mouseover", listItem_hilite, false);
			addEvent(pageDivs[x], "mouseout", listItem_lolite, false);
			addEvent(pageDivs[x], "click", listItem_toggle, false);
		}
	}
}

function getPopPos(e, pw, ph, offset)
{
	w = winDim('w','v');
	h = winDim('h','v');
	sl = winDim('w','s');
	st = winDim('h','s');
	// mouse x/y within viewport
	vmX = e.clientX;
	vmY = e.clientY;
	// mouse x/y within document
	smX = vmX + sl;
	smY = vmY + st;
	l = (pw > vmX) ? (smX + offset) : (smX - pw - offset);
	t = (ph > vmY) ? (smY + offset) : (smY - ph - offset);
	popTL = new Array(t, l);
	return popTL;
}

function fade(objId, dir, cur, step, spd)
{
	var obj = document.getElementById(objId);
	if(!obj)
	{
		return false;
	}
	if(dir == 'in')
	{
		if(cur == 0)
		{
			obj.style.opacity = 0;
			obj.style.MozOpacity = 0;
			obj.style.KhtmlOpacity = 0;
			obj.style.filter = "alpha(opacity=0)";
			obj.style.display = 'block';
		}
		cur += step;
	}
	else
	{
		if(cur == 0)
		{
			obj.style.display = 'none';
		}
		cur -= step;
	}
	obj.style.opacity = (cur / 100);
	obj.style.MozOpacity = (cur / 100);
	obj.style.KhtmlOpacity = (cur / 100);
	obj.style.filter = "progid:DXImageTransform.Microsoft.Alpha(opacity="+cur+")";
	
	setTimeout("fade('"+objId+"','"+dir+"',"+cur+","+step+","+spd+")", spd);
}

var keepTooltip = false;
function tooltipCreate(tipEl, e)
{
	ttEl = document.getElementById('tooltip');
	if(ttEl)
	{
		ttEl.parentNode.removeChild(ttEl);
	}
	ttEl = document.createElement('div');
	ttEl.id = 'tooltip';
	ttEl.style.position = 'absolute';
	ttEl.appendChild(tipEl);
	document.getElementsByTagName('body')[0].appendChild(ttEl);
	tipTL = getPopPos(e, ttEl.clientWidth, ttEl.clientHeight, 6);
	ttEl.style.top = tipTL[0] + 'px';
	ttEl.style.left = tipTL[1] + 'px';
}

function tooltipDestroy(go)
{
	if ( go != 1 )
	{
		setTimeout( "tooltipDestroy(1)", 10 );
	}
	else
	{
		ttEl = document.getElementById('tooltip');
		if(ttEl)
		{
			ttEl.parentNode.removeChild(ttEl);
		}
	}
}

function getElement( elementId )
{
	var elem;
	if ( document.getElementById ) // standard compliant method
		elem = document.getElementById( elementId )
	else if ( document.all ) // old msie versions
		elem = document.all[ elementId ]
	else
		elem = false;

	return elem;
}

function setImage( elementId, strImage )
{
	var imageElem = getElement( elementId );
	if ( !imageElem ) 
		return;

	imageElem.src = strImage;
}

function iSwapFullURL( imgID, newImg )
{
	newImgPath = newImg;
	setImage( imgID, newImgPath );
}


function iSwap( imgID, newImg )
{
	newImgPath = "http://steamcommunity.com/public/images/" + newImg;
	setImage( imgID, newImgPath );
}

function setTimezoneCookies()
{
	var now = new Date();
	var expire = new Date();

	// One year expiration, this way we don't need to wait at least one page
	// load to have accurate timezone info each session, but only each time the user
	// comes with cleared cookies
	expire.setTime( now.getTime() + 3600000*24*365 );
	tzOffset = now.getTimezoneOffset() * -1 * 60;
	isDST = 0;
	document.cookie = "timezoneOffset=" + tzOffset + "," + isDST + ";expires="+expire.toGMTString() + ";path=/";
}


// We always want to have the timezone cookie set for PHP to use
setTimezoneCookies();

function toggleAbuse()
{
	abuseDiv = document.getElementById( 'reporter' );
	if ( abuseDiv.style.display != 'block' )
	{
		abuseDiv.style.display = 'block';
	}
	else
	{
		abuseDiv.style.display = 'none';
	}
}

function setupSteamLinks()
{
	anchors = document.getElementsByTagName( 'a' );
	for( x = 0; x < anchors.length; x++ )
	{
		thisA = anchors[x];
		tmpClass = ' ' + thisA.className + ' ';
		if ( tmpClass.indexOf( ' steamLink ' ) != -1 )
		{
			addEvent( thisA, 'mouseover', showSteamTooltip, false );
			addEvent( thisA, 'mouseout', tooltipDestroy, false );
		}
	}
}

function showSteamTooltip(e)
{
	var srcEl = window.event ? window.event.srcElement : e ? e.target : null;
	if(!srcEl)
	{
		return;
	}
	linkA = getGoodElement(srcEl, 'a', 'steamLink', 0);
	if(!linkA)
	{
		return;
	}
	thisTip = document.createElement('div');
	thisTip.className = 'steamTooltip';
	thisTip.style.width = '32px';
	thisTip.style.height = '32px';
	steamImg = document.createElement( 'img' );
	steamImg.src = 'images/skin_1/steamTooltip.jpg';
	steamImg.style.border = 'none';
	steamImg.style.width = '32px';
	steamImg.style.height = '32px';
	thisTip.appendChild(steamImg);

	tooltipCreate(thisTip, e);
}

function setupFriendBlockHoverIE6()
{
	if ( vIE() != 6 )
	{
		return;
	}
	if ( document.getElementById( 'friendBlocks' ) )
	{
		allDivs = document.getElementById( 'friendBlocks' ).getElementsByTagName( 'div' );
		for( x = 0; x < allDivs.length; x++ )
		{
			div = allDivs[x];
			if ( div.className.indexOf( 'friendBlock_' ) != -1 )
			{
				addEvent( div, 'mouseover', friendBlockHighlightIE6, false );
				addEvent( div, 'mouseout', friendBlockLolightIE6, false );
			}
		}
	}
}

var currentHigh = false;
var waitEl = false;
function friendBlockHighlightIE6()
{
	var srcEl = window.event ? window.event.srcElement : null;
	if(!srcEl)
	{
		return;
	}
	var friendClasses = new Array( 'friendBlock_offline', 'friendBlock_online', 'friendBlock_in-game', 'friendBlock_ignored' );
	for ( x = 0; x < friendClasses.length; x++ )
	{
		var thisClass = friendClasses[x];
		div = getGoodElement( srcEl, 'div', thisClass, 0 );
		if ( div )
		{
			break;
		}
	}
	if(!div)
	{
		return;
	}
	div.className = thisClass + ' friendHighlight';
	currentHigh = div;
}

function friendBlockLolightIE6( )
{
	var srcEl = window.event ? window.event.srcElement : null;
	if(!srcEl)
	{
		return;
	}
	var friendClasses = new Array( 'friendBlock_offline', 'friendBlock_online', 'friendBlock_in-game', 'friendBlock_ignored' );
	for ( x = 0; x < friendClasses.length; x++ )
	{
		var thisClass = friendClasses[x];
		div = getGoodElement( srcEl, 'div', thisClass, 0 );
		if ( div )
		{
			break;
		}
	}
	if(!div)
	{
		return;
	}
	div.className = thisClass;
}

function vIE()
{
	return (navigator.appName=='Microsoft Internet Explorer') ? parseFloat( ( new RegExp( "MSIE ([0-9]{1,}[.0-9]{0,})" ) ).exec( navigator.userAgent )[1] ) : -1;
}


addEvent(window, "load", setupSteamLinks, false);

