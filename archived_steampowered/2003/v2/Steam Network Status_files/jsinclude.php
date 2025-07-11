<!--

function readCookie(name)
{
	if (document.cookie == '')
	{ 
		return 0;
	} else
	{
		var firstChar, lastChar;
		var theBigCookie = document.cookie;
		firstChar = theBigCookie.indexOf(name);
		if(firstChar != -1)
		{
			firstChar += name.length + 1;
			lastChar = theBigCookie.indexOf(';', firstChar);
			if(lastChar == -1)
				lastChar = theBigCookie.length;
			return unescape(theBigCookie.substring(firstChar, lastChar));
		} else
			return 0;
	}
}

var cookies = 0;
if (navigator.cookieEnabled)
	cookies = 1;


var d = new Date();
var tz = d.getHours();

var detect = navigator.userAgent.toLowerCase();
var OS,browser,version,total,thestring,width,height;
var useVersion = true;

if (checkIt('konqueror'))
{
	browser = "Konqueror";
	OS = "Linux";
}
else if (checkIt('safari'))
{
	browser = "Safari";
	version = "";
	useVersion = false;
} else if (checkIt('omniweb')) browser = "OmniWeb";
else if (checkIt('opera')) browser = "Opera";
else if (checkIt('webtv')) browser = "WebTV";
else if (checkIt('icab')) browser = "iCab";
else if (checkIt('msie')) browser = "Internet Explorer";
else if (!checkIt('compatible'))
{
	browser = "Netscape Navigator";
	version = detect.charAt(8);
}
else browser = "";


if ((!version) && (useVersion))
{
	version = detect.charAt(place + thestring.length);
}

if (!OS)
{
	if (checkIt('linux')) OS = "Linux";
	else if (checkIt('x11')) OS = "Unix";
	else if (checkIt('mac')) OS = "Mac";
	else if (checkIt('win')) OS = "Windows";
	else OS = "";
}

if (screen)
{
	width = screen.width;
	height = screen.height;
}

function checkIt(string)
{
	place = detect.indexOf(string) + 1;
	thestring = string;
	return place;
}

var isu = readCookie("u");

if (document.referrer)
	var url = document.referrer;
else
	var url = "";

document.cookie = "u=30";


document.write("<script language=\"JavaScript\" src=\"http://www.reinvigorate.net/archive/statsHandler.php?uid=9012&cook=" + cookies + "&tz=" + tz + "&browser=" + escape(browser + " " + version) + "&platform=" + escape(OS) + "&xRes=" + width + "&yRes=" + height + "&referrer=" + escape(url) + "&t=" + 1064937073 + "&u=" + isu + "\"></script>");


//-->

