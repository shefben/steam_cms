
var g_strNavContext;

function EnableSearchSuggestions( elemTerm, navcontext )
{
	elemTerm = $(elemTerm);
	new Form.Element.DelayedObserver( elemTerm, 0.4, SearchTimeout );
	elemTerm.observe( 'keydown', SearchSuggestOnKeyDown.bindAsEventListener( null, elemTerm ) );
	elemTerm.observe( 'click', SearchSuggestClearDefaultSearchText.bind( null, elemTerm ) );
	elemTerm.observe( 'blur', SearchSuggestSetDefaultSearchText.bind( null, elemTerm ) );
	g_strNavContext = navcontext;
}
function SearchTimeout( elem, value )
{
	if ( value )
	{
		new Ajax.Updater( 'search_suggestion_contents', 'http://store.steampowered.com/search/suggest', 
				{ 
					parameters: { term: value, f: 'games', navcontext: g_strNavContext },
					onComplete: function() {
						$('search_suggestion_contents').select('a.match').each( function (e) { e.observe( 'mouseover', SearchSuggestOnMouseOver.bindAsEventListener( null, e ) ); } ); 
						ShowSuggestionsAsNecessary(); 
					} 
				} );
	}
	else
	{
		$('search_suggestion_contents').update( '' );
		ShowSuggestionsAsNecessary();
	}
}

function ShowSuggestionsAsNecessary( bForceHide )
{
	var elem = $('searchterm_options');
	if ( $('search_suggestion_contents').childElements().length > 0 && !bForceHide )
	{
		ShowWithFade( elem );
	} 
	else 
	{
		HideWithFade( elem );
	}
}
function SearchSuggestOnKeyDown( event, elem )
{
	if ( event.keyCode == Event.KEY_ESC )
	{
		ShowSuggestionsAsNecessary( true );
	}
	else if ( event.keyCode == Event.KEY_RETURN
			|| event.keyCode == Event.KEY_UP
			|| event.keyCode == Event.KEY_DOWN )
	{
		var elemSuggestionCtn = $('searchterm_options' );
		if ( !elemSuggestionCtn.visible() || elemSuggestionCtn.hiding )
			return;

		var elemSuggestions = $('search_suggestion_contents');
		var elemCurSuggestion = elemSuggestions.down('.focus');
		var elemNewSuggestion = null;
		
		if ( event.keyCode == Event.KEY_RETURN )
		{
			if ( elemCurSuggestion )
			{
				window.location = elemCurSuggestion.href;
				event.stop();
			}
		}
		else
		{
			if ( event.keyCode == Event.KEY_UP )
			{
				if ( elemCurSuggestion )
					elemNewSuggestion = elemCurSuggestion.previous();
				if ( !elemNewSuggestion )
					elemNewSuggestion = elemSuggestions.down('a.match:last-child');
			}
			else if ( event.keyCode == Event.KEY_DOWN )
			{
				if ( elemCurSuggestion )
					elemNewSuggestion = elemCurSuggestion.next();
				if ( !elemNewSuggestion )
					elemNewSuggestion = elemSuggestions.down('a.match');
			}

			if ( elemNewSuggestion  )
			{
				if ( elemCurSuggestion )
					elemCurSuggestion.removeClassName( 'focus' );
				elemNewSuggestion.addClassName( 'focus' );
			}

			//client webkit will move cursor on up/down
			event.stop();
		}

	} 
}
function SearchSuggestOnMouseOver( event, elem )
{
	elem.siblings().invoke( 'removeClassName', 'focus');
	elem.addClassName( 'focus' );
}

function SearchSuggestClearDefaultSearchText( elem )
{
	ShowSuggestionsAsNecessary();
	var text = elem.value;
	if ( text == 'search the store' )
	{
		elem.value = '';
		$(elem).removeClassName( 'default' );
	}
}
function SearchSuggestSetDefaultSearchText( elem )
{
	ShowSuggestionsAsNecessary( true );
	var text = elem.value;
	if ( text == '' )
	{
		elem.value = 'search the store';
		$(elem).addClassName( 'default' );
	}
}
function SearchSuggestCheckTerm( theform )
{
	if ( theform.term.value == 'search the store' )
	{
		theform.term.value = '';
	}
	return true;
}

