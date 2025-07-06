// JavaScript Document
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

addEvent(window, 'load', doCorners, false);
var ie56 = false;
var ie7 = false;
if(navigator.appVersion.indexOf('MSIE') != -1)
{
	var rgVer = navigator.appVersion.split('MSIE');
	var version = parseFloat(rgVer[1]);
	if(version < 7)
	{
		ie56 = true;
	}
	else
	{
		ie7 = true;
	}
}

function doCorners()
{
	divs = document.getElementsByTagName('div');
	for(i=0;i<divs.length;i++)
	{
		for(x=0;x<cornerTypes.length;x++)
		{
			searchClass = ' '+cornerTypes[x]['divClass']+' ';
			thisClass = ' '+divs[i].className+' ';
			if(thisClass.indexOf(searchClass) != -1)
			{
				thisCType = cornerTypes[x];
				overlayDiv = document.createElement('div');
				overlayDiv.style.position = 'absolute';
				overlayDiv.style.width = thisCType['width'] + 'px';
				overlayDiv.style.height = thisCType['height'] + 'px';
				overlayDiv.style.top = '0px';
				overlayDiv.style.left = '0px';
				if(ie56)
				{
					thisHtml = '<img src="img/corners/spacer.png" width="'+thisCType['width']+'" height="'+thisCType['height']+'" border="0" style="filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''+thisCType['cornerImageIe']+'\',sizingMethod=\'scale\');" />';
				}
				else if(ie7)
				{
					thisHtml = '<img src="'+thisCType['cornerImageIe']+'" width="'+thisCType['width']+'" height="'+thisCType['height']+'" border="0" />';
				}
				else
				{
					thisHtml = '<img src="'+thisCType['cornerImage']+'" width="'+thisCType['width']+'" height="'+thisCType['height']+'" border="0" />';
				}
				overlayDiv.innerHTML = thisHtml;
				divs[i].appendChild(overlayDiv);
			}
		}
	}
}

var cornerTypes = new Array();
cornerTypes[0] = new Array();
cornerTypes[0]['divClass'] = 'capsuleImage';
cornerTypes[0]['width'] = 280;
cornerTypes[0]['height'] = 105;
cornerTypes[0]['cornerImage'] = 'img/corners/smallcap_corners.png';
cornerTypes[0]['cornerImageIe'] = 'img/corners/smallcap_corners_ie.png';
cornerTypes[1] = new Array();
cornerTypes[1]['divClass'] = 'capsuleLargeImage';
cornerTypes[1]['width'] = 572;
cornerTypes[1]['height'] = 221;
cornerTypes[1]['cornerImage'] = 'img/corners/largecap_corners.png';
cornerTypes[1]['cornerImageIe'] = 'img/corners/largecap_corners_ie.png';