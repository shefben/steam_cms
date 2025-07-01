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
function addWeaponActions()
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
		if(tempClassName.indexOf(" csMarket_listItem ") != -1 || tempParentClassName.indexOf(" csMarket_listItem ") != -1)
		{
			addEvent(pageDivs[x], "mouseover", listItem_hilite, false);
			addEvent(pageDivs[x], "mouseout", listItem_lolite, false);
			addEvent(pageDivs[x], "click", listItem_toggle, false);
		}
	}
}
function listItem_hilite(e)
{
	var el = window.event ? window.event.srcElement : e ? e.target : null;
	if(!el)
	{
		return;
	}
	el = getGoodElement(el,"div","csMarket_listItem",0);
	if(el)
	{
		el.style.backgroundColor = "#000000";
	}
}
function listItem_lolite(e)
{
	var el = window.event ? window.event.srcElement : e ? e.target : null;
	if(!el)
	{
		return;
	}
	el = getGoodElement(el,"div","csMarket_listItem",0);
	if(el)
	{
		el.style.backgroundColor = "#353535";
	}
}
function listItem_toggle(e)
{
	var el = window.event ? window.event.srcElement : e ? e.target : null;
	if(!el)
	{
		return;
	}
	el = getGoodElement(el,"div","csMarket_listItem",0);
	if(el)
	{
		weaponid = el.id.slice(6);
		detail_el = document.getElementById("weapon"+weaponid+"_details");
		if(detail_el.style.display != "block")
		{
			detail_el.style.display = "block";
			this_so = eval("so"+weaponid);
			this_so.write("weaponDetailStats"+weaponid);
		}
		else
		{
			detail_el.style.display = "none";
		}
		if(e && e.stopPropagation)
		{
			e.stopPropagation();
		}
		if(window.event)
		{
			window.event.cancelBubble = true;
		}
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
	if(el.nodeName.toLowerCase() != "body" && el.className.indexOf(cn) == -1)
	{
		return getGoodElement(el,nn,cn,1);
	}
	else if(el.className.indexOf(cn) != -1)
	{
		return el;
	}
	return false;
}
addEvent(window, "load", addWeaponActions, false);
var isIE = !window.opera && navigator.userAgent.indexOf('MSIE') != -1;
