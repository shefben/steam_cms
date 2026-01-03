function popup( url, x, y, s, r ) 
{
	day = new Date();
	id = day.getTime();
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
