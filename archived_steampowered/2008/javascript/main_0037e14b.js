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
function setupTabHover()
{
	if ( vIE() != 6 )
	{
		return;
	}
	allDivs = document.getElementById( 'global_area_tabs_ctn' ).getElementsByTagName( 'div' );
	for( x = 0; x < allDivs.length; x++ )
	{
		div = allDivs[x];
		thisClass = ' ' + div.className + ' ';
		if ( thisClass.indexOf( ' global_area_tabs_item ' ) != -1 )
		{
			addEvent( div, 'mouseover', tabItemHighlight, false );
			addEvent( div, 'mouseout', tabItemLolight, false );
		}
	}
}
var currentHigh = false;
var waitEl = false;
function tabItemHighlight()
{
	var srcEl = window.event ? window.event.srcElement : null;
	if(!srcEl)
	{
		return;
	}
	div = getGoodElement( srcEl, 'div', 'global_area_tabs_item', 0 );
	if(!div)
	{
		return;
	}
	div.className = 'global_area_tabs_item tabHighlight';
	currentHigh = div;
}
function tabItemLolight( )
{
	var srcEl = window.event ? window.event.srcElement : null;
	if(!srcEl)
	{
		return;
	}
	div = getGoodElement( srcEl, 'div', 'global_area_tabs_item', 0 );
	if(!div)
	{
		return;
	}
	div.className = 'global_area_tabs_item';
}
function vIE()
{
	return (navigator.appName=='Microsoft Internet Explorer') ? parseFloat( ( new RegExp( "MSIE ([0-9]{1,}[.0-9]{0,})" ) ).exec( navigator.userAgent )[1] ) : -1;
}


addEvent(window, "load", setupTabHover, false);
