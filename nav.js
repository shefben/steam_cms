function ImagePopup(img, x, y)
{
	day = new Date();
	id = day.getTime();
	eval("page" + id + " = window.open('/ImagePopup.php?img='+img, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width="+x+",height="+y+"');");

}