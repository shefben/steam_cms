function showBranch(branch){
   var objBranch = document.getElementById(branch); 
   var sClosed = "[+] " + branch; 
   var sOpen = "[-] " + branch; 
   var objTwig = document.getElementById(branch + "-link"); 
   if(objBranch.style.display=="block") 
       { 
       objBranch.style.display="none"; 
       objTwig.innerHTML = sClosed; 
       } 
   else 
       { 
       objBranch.style.display="block"; 
       objTwig.innerHTML = sOpen; 
       } 
}

function togglePost(id)
{
    var button = document.getElementById('button_'+id).innerHTML;
    if (button == '[-]')
    {
        document.getElementById('button_'+id).innerHTML = '[+]';
        document.getElementById('content_'+id).style.display = 'none';
    }
    else
    {
        document.getElementById('button_'+id).innerHTML = '[-]';
        document.getElementById('content_'+id).style.display = '';
    }
}
