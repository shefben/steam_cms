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
	var container = document.getElementById( 'global_area_tabs_ctn' ); 
	if ( container == null )
	{
		container = document.getElementById( 'global_area_tabs_ctn_pkg' );
	}
	if ( container == null )
	{
		return;
	}
	
	allDivs = container.getElementsByTagName( 'div' );
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



function GotFlashPopup()
{
	var win = window.open( 'http://store.steampowered.com/gotflash','gotflash','width=536,height=546,resize=yes,scrollbars=yes');
	win.focus();
}

//
// Page-able tabs
//
var tabStart = { };
var tabMax = { };
var tabTransition = { };
function PageTab( tab, delta, max, params )
{
	if ( tabTransition[tab] )
		return;
	
	if ( !tabStart[tab] )
		tabStart[tab] = 0;
	if ( !tabMax[tab] )
		tabMax[tab] = 0;
	
	if ( tabStart[tab] + delta >= max )
		return;
	
	tabStart[tab] += delta;
	tabTransition[tab] = true;
	if ( tabStart[tab] > tabMax[tab] )
	{
		if ( !params )
			params = {};
		params.tab = tab;
		params.start = tabStart[tab];
		params.count = delta;
		new Ajax.Updater( 
				'tab_' + tab + '_items', 
				'http://store.steampowered.com/search/tab', 
				{ parameters: params, method: 'get', insertion: 'bottom', onComplete: TabCompletionClosure( tab, delta, max ) } );
		tabMax[tab] = tabStart[tab];
	}
	else 
	{
		RollTab( tab, delta );
		TabUpdateCounts( tab, delta, max );
	}
	
}

function TabCompletionClosure( tab, delta, max )
{
	var tab_closure = tab;
	var delta_closure = delta;
	var max_closure = max;
	return function() { 
		RollTab( tab_closure, delta_closure );
		TabUpdateCounts( tab_closure, delta_closure, max_closure ); 
	};
	
}

function RollTab( tab, delta )
{
	new Effect.Move( $('tab_' + tab + '_items'), {y: -RowHeightForTab( tab ) * delta, afterFinish: TabScrollFinishClosure( tab, delta ) } );
	Effect.ScrollTo( $('tab_' + tab + '_items').up('.tabarea' ), { afterFinish: TabScrollFinishClosure( tab, delta ) } );
}

function TabScrollFinishClosure( tab, delta )
{
	var tab_closure = tab;
	var delta_closure = delta;
	return function() { 
		tabTransition[tab_closure] = false; 
	};
}

function TabUpdateCounts( tab, delta, max )
{
	if ( $('tab_' + tab + '_count_start') )
	{
		$('tab_' + tab + '_count_start').update( tabStart[tab] + 1 );
		$('tab_' + tab + '_count_end').update( Math.min( tabStart[tab] + Math.abs(delta), max ) );
	}
	else
	{
		$('tab_' + tab + '_count').update( (tabStart[tab] + 1) + '-' + Math.min( tabStart[tab] + Math.abs(delta), max ) );
	}
	if ( tabStart[tab] > 0 )
		$('tab_' + tab + '_prev').style.visibility='visible';
	else
		$('tab_' + tab + '_prev').style.visibility='hidden';
	
	if ( tabStart[tab] + delta >= max )
		$('tab_' + tab + '_next').style.visibility='hidden';
	else
		$('tab_' + tab + '_next').style.visibility='visible';
}

function RowHeightForTab( tab )
{
	var tabRow = $('tab_' + tab + '_items' ).down( '.tab_row' );
	return tabRow.getHeight();
}

function TabSelect( elem, target )
{
	$(elem).siblings().invoke( 'removeClassName', 'active')
	$(elem).addClassName( 'active' );
	
	var tab_content = $(target);
	tab_content.siblings().invoke( 'hide' );
	tab_content.show();
}

function ScrollSmallCaps( name, delta, pageSize, totalCount, params )
{	
	var targetid = 'sm_cap_' + name + '_scroll';
	var elem = $( targetid );
	if ( elem.effect )
		return;
	
	if ( !elem.curPos ) 
	{
		elem.curPos = 0;
	}
	if ( !elem.maxLoaded )
	{
		elem.maxLoaded = 0;
	}
	
	elem.curPos += delta;
	
	if ( elem.curPos > elem.maxLoaded )
	{
		elem.effect = true;
		elem.maxLoaded++;
		elem.style.width = ( ( elem.maxLoaded + 2 ) * 614 ) + 'px';
		
		if ( !params )
			params = {};
		params.name = name;
		params.start = elem.curPos * pageSize + pageSize; // we are always loading one page ahead
		params.count = pageSize;
		new Ajax.Updater( 
				targetid, 
				'http://store.steampowered.com/search/smallcapscroll', 
				{ parameters: params, method: 'get', insertion: 'bottom', onComplete: UpdateSmallCapControl.bind( window, targetid, delta, pageSize, totalCount ) } );
	}
	else
	{
		UpdateSmallCapControl( targetid, delta, pageSize, totalCount );
	}

}

function ScrollStaticSmallCaps( targetid, delta, pageSize, totalCount )
{
	var elem = $( targetid );
	if ( elem.effect )
		return;
	
	if ( !elem.curPos ) 
	{
		elem.curPos = 0;
	}
	
	elem.curPos += delta;
	
	UpdateSmallCapControl( targetid, delta, pageSize, totalCount );
}

function UpdateSmallCapControl( targetid, delta, pageSize, totalCount )
{
	var elem = $( targetid );
	var max = Math.ceil( totalCount / pageSize ) - 1;

	var nextLink = targetid + '_next';
	var prevLink = targetid + '_prev';
	if ( elem.curPos >= max )
		$(nextLink).hide();
	else 
		$(nextLink).show();
	
	if ( elem.curPos <= 0 )
		$(prevLink).hide();
	else
		$(prevLink).show();
	
	var pageStart = elem.curPos * pageSize + 1;
	var pageEnd = pageStart + ( pageSize - 1 );
	$( targetid + '_page_start' ).update( pageStart );
	$( targetid + '_page_end' ).update( Math.min( pageEnd, totalCount ) );
	
	
	elem.effect = new Effect.Move( elem, {x: -614 * delta, afterFinish: function() { elem.effect = false; }, duration: 0.4 } );

}

function ShowWithFade( elem )
{
	var elem = $(elem);

	if ( !elem.visible() || elem.hiding )
	{
		elem.hiding = false;
		if ( elem.effect )
			elem.effect.cancel();
		
		if ( Prototype.Browser.IE )
		{
			elem.addClassName( 'suppress_shadow' );
			elem.effect = new Effect.Appear( elem, { duration: 0.2, afterFinish: function() { elem.removeClassName( 'suppress_shadow' ); } } );
		}
		else
		{
			elem.effect = new Effect.Appear( elem, { duration: 0.2 } );
		}
	}
}

function HideWithFade( elem )
{
	var elem = $(elem);
	
	if ( elem.visible() && !elem.hiding )
	{
		if ( elem.effect && !elem.hiding )
			elem.effect.cancel();
		elem.hiding = true;

		if ( Prototype.Browser.IE )
		{
			elem.addClassName( 'suppress_shadow' );
		}
		elem.effect = new Effect.Fade( elem, { duration: 0.2 } );
	}
}

// register some events to dismiss popup (ie, user clicking elsewhere on the window, escape)
//   cleans up event binds afterwards.  clicks to children of "elemIgnore" will not dismiss popup 
function RegisterPopupDismissal( dismissFunc, elemIgnore, bNoGuard )
{
	var dismissHandler = {
		guard: bNoGuard ? 0 : 1,
		dismiss: function( event ) {
			if ( this.elemIgnore )
			{
				var elem = Event.element( event );
				if ( elem.up( '#' + elemIgnore.id ) )
					return;
			}
			// ignore the first click- assume it's the one starting the popup
			if ( this.guard-- > 0 )
				return;
			this.regFunc();
			this.unregister();
		},
		unregister: function() {
			Event.stopObserving( document, 'click', this.boundHandler );
			Event.stopObserving( document, 'keydown', this.boundHandler );
		}
	};
	dismissHandler.regFunc = dismissFunc;
	dismissHandler.elemIgnore = elemIgnore || null;
	dismissHandler.boundHandler = dismissHandler.dismiss.bindAsEventListener( dismissHandler );
	Event.observe( document, 'click', dismissHandler.boundHandler );
	Event.observe( document, 'keydown', dismissHandler.boundHandler );
	
	return dismissHandler;
	
}

function ShowMenu( elemLink, elemPopup, align, valign )
{
	var elemLink = $(elemLink);
	var elemPopup = $(elemPopup);
	
	AlignMenu( elemLink, elemPopup, align, valign );
	
	ShowWithFade( elemPopup );
	elemLink.addClassName('focus');
	RegisterPopupDismissal( function() { HideWithFade( elemPopup ); elemLink.removeClassName('focus'); }, elemPopup );
}

function RegisterFlyout( elemLink, elemPopup, align, valign )
{
	Event.observe( elemLink, 'mouseover', function(event) { FlyoutMenu( elemLink, elemPopup, align, valign ); } );
	
	Event.observe( elemLink, 'mouseout', HideFlyoutMenu.bindAsEventListener( null, elemLink, elemPopup ) );
	Event.observe( elemPopup, 'mouseout', HideFlyoutMenu.bindAsEventListener( null, elemLink, elemPopup ) );

}

function FlyoutMenu( elemLink, elemPopup, align, valign )
{
	var elemLink = $(elemLink);
	var elemPopup = $(elemPopup);
	
	if ( !elemPopup.visible() || elemPopup.hiding )
	{
		AlignMenu( elemLink, elemPopup, align, valign );
		ShowWithFade( elemPopup );
		elemLink.addClassName('focus');
	}
	
}

function HideFlyoutMenu( event, elemLink, elemPopup )
{
	var elemLink = $(elemLink);
	var elemPopup = $(elemPopup);
	var reltarget = (event.relatedTarget) ? event.relatedTarget : event.toElement;
	if ( !reltarget || ( $(reltarget).up( '#' + elemLink.id ) || $(reltarget).up( '#' + elemPopup.id )  ) )
		return;

	// start hiding in a little bit, have to let the fade in animation start before we can cancel it
	window.setTimeout( HideWithFade.bind( null, elemPopup ), 33 );
	elemLink.removeClassName('focus');
}

function AlignMenu( elemLink, elemPopup, align, valign )
{
	var align = align ? align : 'left';
	
	if ( !valign )
	{
		//if there's not enough room between our spot and the top of the document, we definitely want to drop down
		if ( document.viewport.getScrollOffsets().top + elemLink.viewportOffset().top < nPopupHeight )
			valign = 'bottom'; 
		else
		{			
			// add a little bit of padding so we don't position it flush to an edge if possible
			var nPopupHeight = elemPopup.getHeight() + 8;
			var nSpaceAbove = elemLink.viewportOffset().top;
			var nSpaceBelow = document.viewport.getHeight() - elemLink.viewportOffset().top;
			//otherwise we only want to drop down if we've got enough space below us (measured based on view area)
			// or if there's not enough space above to pop in either direction and there's more space below
			if ( nSpaceBelow > nPopupHeight || ( nSpaceAbove < nPopupHeight && nSpaceBelow > nSpaceAbove ) )
				valign = 'bottom'; 
			else
				valign = 'top';
			
		}
	}

	if ( align == 'left' )
	{
		elemPopup.style.left = ( elemLink.positionedOffset()[0] - 13 ) + 'px';
	} 
	else if ( align == 'right' )
	{
		elemPopup.style.left = ( elemLink.positionedOffset()[0] + elemLink.getWidth() - elemPopup.getWidth() + 14 ) + 'px';
	}
	
	if ( valign == 'bottom' ) 
	{
		elemPopup.style.top = ( elemLink.positionedOffset()[1] + elemLink.getHeight() - 12 ) + 'px';
	}
	else if ( valign == 'top' )
	{
		elemPopup.style.top = ( elemLink.positionedOffset()[1] - elemPopup.getHeight() + 12 ) + 'px';
	}
}

function GameHover( elem, event, divHover, rgHoverData )
{
	if (!event) var event = window.event;
    elem = $(elem);
	
	var hover = $(divHover);
	if ( hover.hiding && hover.visible() && hover.target == elem )
	{
		ShowWithFade( hover );
	}
	else if ( ( !hover.visible() || hover.target != elem ) && !elem.timer )
	{
		elem.bWantsHover = true;
		var strTargetPrefix = '';
		var strUrlTarget = '';
		if ( rgHoverData['type'] == 'app' )
		{
			strTargetPrefix = 'hover_app_';
			strUrlTarget = 'apphover/';
		}
		else if ( rgHoverData['type'] == 'sub' )
		{
			strTargetPrefix = 'hover_sub_';
			strUrlTarget = 'subhover/';
		}
		else
		{
			return;
		}
			
		var targetId = strTargetPrefix + rgHoverData['id'];
		var elemData = $( targetId );
		var steamId = g_SteamID ? g_SteamID : 0;
		if ( !elemData && !elem.ajaxRequest )
		{
			window.setTimeout( function() { 
				if ( elem.bWantsHover && !elem.ajaxRequest ) {
					elem.ajaxRequest = new Ajax.Updater( hover.down('.content'),
								'http://store.steampowered.com/' + strUrlTarget + rgHoverData['id'],
								{ method: 'get', parameters: { u: ( steamId ? 1 : 0 ) }, insertion: 'bottom', onComplete: function() { ShowGameHover( elem, divHover, targetId ); } } );
				}
			}, 250 );
		}
		elem.timer = window.setTimeout( function() { elem.timer = false; elem.bReadyForHover = true; ShowGameHover( elem, divHover, targetId ); }, 500 );
	}
}

function HideGameHover( elem, event, divHover )
{
	if (!event) var event = window.event;
	var reltarget = (event.relatedTarget) ? event.relatedTarget : event.toElement;
	if ( reltarget && ( $(reltarget).up( '#' + elem.id ) /* || $(reltarget).up( '#' + divHover.id ) */ ) )
		return;
	
	if ( elem.timer )
	{
		window.clearTimeout( elem.timer );
		elem.timer = false;
	}
	elem.bWantsHover = false;
	elem.bReadyForHover = false;
	
	if ( Prototype.Browser.IE )
		divHover.hide();
	else
		HideWithFade( divHover );
}

function ShowGameHover( elem, divHover, targetContent )
{
	if ( !$( targetContent ) || !elem.bWantsHover || !elem.bReadyForHover )
		return;

	$( targetContent ).siblings().invoke('hide');
	$( targetContent ).show();

	var hover = $(divHover);
	//if ( true || !hover.target || hover.target != elem )
	{
		// "show" the hover, but not "visible", letting us do some positioning
		hover.style.visibility = 'hidden';
		hover.show();
		
		hover.clonePosition( elem, {setWidth: false, setHeight: false} );
		var hover_box = hover.down( '.hover_box' );
		var hover_arrow = hover.down( '.hover_arrow' );
		
		if ( Prototype.Browser.IE )
		{
						hover.style.paddingTop = '12px';
			hover_box.style.marginTop = '0px';
		}
		
		var nTopAdjustment = 0;
		
						if ( !elem.hasClassName( 'small_cap' ) )
			nTopAdjustment =  elem.getDimensions().height / 2 - 49;

		hover.style.left = ( parseInt( hover.style.left ) + parseInt( elem.getDimensions().width ) - 8 ) + 'px';
		hover.style.top = ( ( parseInt( hover.style.top ) - 13 ) + nTopAdjustment ) + 'px';

		var boxTopViewport = elem.viewportOffset().top + nTopAdjustment;
		if ( boxTopViewport + hover_box.getHeight() + 8 > document.viewport.getHeight() )
		{
			var nViewportAdjustment = ( hover_box.getHeight() + 8 ) - ( document.viewport.getHeight() - boxTopViewport );
						nViewportAdjustment = Math.min( hover_box.getHeight() - 74, nViewportAdjustment );
			hover.style.top = ( parseInt( hover.style.top ) - nViewportAdjustment ) + 'px';
			
			hover_arrow.style.top = ( 48 + nViewportAdjustment ) + 'px';
		}
		else
		{
			hover_arrow.style.top = '';
		}
		
		hover.hide();
		hover.style.visibility = '';
		
		hover.target = elem;
	}
	
	if ( Prototype.Browser.IE )
	{
		hover.show();
	}
	else
		ShowWithFade( hover );
}

function AddToWishlist( appid, steamworksappid, divToHide, divToShowSuccess, divToShowError )
{
	new Ajax.Request( 'http://store.steampowered.com/friends/addtowishlist', {
		method: 'post',
		parameters: {appid: appid, steamworksappid: steamworksappid},
		onSuccess: function( transport ) {
			$(divToHide).hide();
			if ( transport.responseJSON )
				$(divToShowSuccess).show();
			else
				$(divToShowError).show();
		}
	});
}

var g_OnWebPanelShownHandlers = Array();
function SteamOnWebPanelShown()
{
	for ( var i = 0; i < g_OnWebPanelShownHandlers.length; i++ )
	{
		g_OnWebPanelShownHandlers[i]();
	}
}
function RegisterSteamOnWebPanelShownHandler( f )
{
	g_OnWebPanelShownHandlers.push( f );
}

var g_OnWebPanelHiddenHandlers = Array();
function SteamOnWebPanelHidden()
{
	for( var i = 0; i < g_OnWebPanelHiddenHandlers.length; i++ )
	{
		g_OnWebPanelHiddenHandlers[i]();
	}
}
function RegisterSteamOnWebPanelHiddenHandler( f )
{
	g_OnWebPanelHiddenHandlers.push( f );
}

