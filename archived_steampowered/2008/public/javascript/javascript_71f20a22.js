function popup( url, x, y, s, r ) 
{
	day = new Date();
	id = day.getTime();
	window.open(url, id, 'scrollbars=' + s + 'resizable=' + r + ',width=' + x + ',height=' + y);
}

function popup_id( url, x, y, id, s, r ) 
{
	day = new Date();
	window.open(url, id, 'scrollbars=' + s + 'resizable=' + r + ',width=' + x + ',height=' + y);
}

function HiLiteRow( id, color )
{
	document.getElementById(id).bgColor = color;
}

function clearSelect( select_id )
{
	var selected = document.getElementById( select_id );
	selected.selectedIndex = -1;
}

// Function to add a package to a cart, assumes form setup on the page
function addToCart( subid )
{
	try
	{
		document.forms['add_to_cart_'+subid].submit();
	}
	catch( e )
	{
			}
}

function addAllDlcToCart()
{
	try
	{
		document.forms['add_all_dlc_to_cart'].submit();
	}
	catch( e )
	{
	}
}

function removeFromCart( gid )
{
	try
	{
		document.getElementById('line_item_to_remove_gid').value = gid;
		document.forms['remove_line_item'].submit();
	} 
	catch( e )
	{
			}
}
