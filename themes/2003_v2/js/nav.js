//
// resize the main content box based on the size of the browser window.
// (sets a max width for the box)
// 
var d = document;
function resizeBox(){
	sObj = d.getElementById("container").style;
	if (d.body.clientWidth < 1000){
		sObj.width = "";
		} else {
		// sObj.background = "blue";
		sObj.width = "700";
	}
}
onload = resizeBox;
onresize = resizeBox;


//
// preload all mouseover images. the order of this array sets the number of the image to call in the html.
//
var base= "/img/"
var nrm = new Array();
var mo = new Array();
var toLoad = new Array('getSteamNow','forums','support','partners','contact','logo_hl','logo_cs','logo_cz','logo_tfc','logo_opfor','logo_dod','logo_r','logo_dmc', 'main', 'status', 'admin');

if (document.images){
	for (i=0;i<toLoad.length;i++){
		nrm[i] = new Image;
		nrm[i].src = base + toLoad[i] + ".gif"
		mo[i] = new Image;
		mo[i].src = base + "MO" +toLoad[i] + ".gif";
	}
}

function over(no){
	if (document.images){
		document.images[toLoad[no]].src = mo[no].src
	}
}

function out(no){
	if (document.images){
		document.images[toLoad[no]].src = nrm[no].src
	}
}

