function toggle_section( section )
{
	section_header = section+'_header';
	section_content = section+'_content';
	section_cookie = section+'_cookie';

	img_src = document.getElementById( section_header ).src;
	if ( img_src.indexOf('ico_arrow_up.gif') != -1 )
	{
		document.getElementById( section_header ).src = 'ico/ico_arrow_dn.gif';
		document.getElementById( section_content ).style.display = 'none';
		createCookie( section_cookie, 'closed', 365 );
	}
	else
	{
		document.getElementById( section_header ).src = 'ico/ico_arrow_up.gif';
		document.getElementById( section_content ).style.display = 'inline';
		createCookie( section_cookie, 'open', 365 );
	}
}

function check_section( section, def )
{
	section_header = section+'_header';
	section_content = section+'_content';
	section_cookie = section+'_cookie';
	value = readCookie( section_cookie );
	if ( value == '' || value == null ) value = def;
	if ( value == 'open' )
	{
		document.getElementById( section_header ).src = 'ico/ico_arrow_up.gif';
		document.getElementById( section_content ).style.display = 'inline';
	}
	else
	{
		document.getElementById( section_header ).src = 'ico/ico_arrow_dn.gif';
		document.getElementById( section_content ).style.display = 'none';
	}

}
