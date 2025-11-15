
var g_bLoading = false;
var g_bMorePosts = true;
var LOAD_OFFSET_PX = 400; 
function PullNewsPost( gid ) {
	var content = $('postcontent_' + gid);
	var header = $('posthead_' + gid);
	if ( content.visible() )
	{
		content.hide();
		header.style.borderBottom = '';
	}
	else
	{
		content.show();
		header.style.borderBottom = 'none';
		if ( content.empty() )
		{
			new Ajax.Updater( 
					content,
					'http://store.steampowered.com//news/post/' + gid, 
					{ method: 'get' } );
		}
	}
}

function LoadMoreNews()
{
	var linkElem = $('more_posts_url'); 
	if ( !g_bLoading && linkElem )
	{
		var url = linkElem.href;
		linkElem.remove();

		g_bLoading = true;
		new Ajax.Updater(
				$('news'),
				url,
				{ method: 'get', insertion: Insertion.Bottom, onSuccess: function() { g_bLoading = false; }, onComplete: OnScrollNews } );
	}
	else if ( !g_bLoading && $('more_posts') )
	{
				$('more_posts').remove();
		g_bMorePosts = false;
	}
}

function OnScrollNews()
{
	if ( !g_bLoading && g_bMorePosts && $('more_posts') )
	{
		var iViewBottom = document.viewport.getHeight() + document.viewport.getScrollOffsets()[1];
		var iLoaderTop = $('more_posts').offsetTop;
		if ( iViewBottom > iLoaderTop - LOAD_OFFSET_PX )
		{
			LoadMoreNews();
		}
	}
}
Event.observe( window, 'scroll', OnScrollNews );
Event.observe( window, 'resize', OnScrollNews );
Event.observe( window, 'load', OnScrollNews );

