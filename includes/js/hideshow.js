// Create variable is_input to see if there is a ? in the url
var is_input = document.URL.indexOf('?');
var state = 'block'; 

// Check the position of the ? in the url
if (is_input != -1) { 
	// Create variable from ? in the url to the end of the string
	addr_str = document.URL.substring(is_input+1, document.URL.length);
	if (document.all) { //IS IE 4 or 5 (or 6 beta) 
		eval( "document.all." + addr_str + ".style.display = state"); 
	} 
	if (document.layers) { //IS NETSCAPE 4 or below 
		document.layers[addr_str].display = state; 
	} 
	if (document.getElementById &&!document.all) { 
		hza = document.getElementById(addr_str); 
		hza.style.display = state; 
	} 
}
<!--
/*
function showhide(layer_ref) { 
	if (state == 'block') { 
		state = 'none'; 
	} 
	else { 
		state = 'block'; 
	} 
	if (document.all) { //IS IE 4 or 5 (or 6 beta) 
		eval( "document.all." + layer_ref + ".style.display = state"); 
	} 
	if (document.layers) { //IS NETSCAPE 4 or below 
		document.layers[layer_ref].display = state; 
	} 
	if (document.getElementById &&!document.all) { 
		hza = document.getElementById(layer_ref); 
	hza.style.display = state; 
	} 
}
*/
//-->