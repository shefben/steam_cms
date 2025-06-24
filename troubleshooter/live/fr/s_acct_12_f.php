<html>
<head>
	<title>Steam - Module de dépannage</title>
	<link href="stylesheet.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" src="scripts.js"></script>
</head>

<body leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">

<table class="content_area">
<tr valign="top">
	<td class="content" valign="top">
	<h1>J'ai tout essayé, mais je ne parviens toujours pas à me connecter à mon compte.</h1>
	<hr>
    
	<p>Si vous avez encore besoin d'aide, complétez et envoyez ce formulaire. Notre personnel doit répondre aux questions et traiter les cas particuliers dans le cadre de notre stratégie d'assistance.</p>

	
    
	
<p><strong><em><span class="maize">Steam ne fournit de l'assistance qu'en anglais et espagnol.</span></em></strong></p>
<form action="process_form.php" method="post" name="tsform">
<input type="hidden" name="f_page" value="s_acct_12_f">
<input type="hidden" name="f_language" value="French">
<table width="90%" cellspacing="2" cellpadding="0" align="center">

<tr>
<td nowrap><p><strong>Votre adresse e-mail :</strong>&nbsp;</p></td>
<td width="100%"><input type="text" name="f_2" class="form_100p"></td>
</tr>
 
<tr>
<td nowrap><p><strong>Votre compte Steam :</strong>&nbsp;</p></td>
<td width="100%"><input type="text" name="f_1" class="form_100p"></td>
</tr>
 
<tr>
<td nowrap><p><strong>Votre clé CD :</strong>&nbsp;</p></td>
<td width="100%"><input type="text" name="f_5" class="form_100p"></td>
</tr>
 
<tr>
<td width="100%" colspan="2"><p><br><strong>Décrivez le problème rencontré :</strong>&nbsp;</p></td>
</tr>
<tr>
<td width="100%" colspan="2">

<textarea cols="10" rows="7" name="f_4" class="form_100p"></textarea>
<script>
displaylimit("document.tsform.f_4",500)
</script>

</td>
</tr>
 
</table>

<script>
function CDKeyCheck()
{
cdkey = document.tsform.f_5.value;
if (cdkey == '') 
{
document.tsform.f_5.style.backgroundColor = '#800000';
return false;
}
else
{
return true;
}
}

</script>

<p align=right><input type="submit" value="submit" class="form_generic" onClick="if (CDKeyCheck()) return true; else return false;"></p>
</form>


	</td>
</tr>
<tr valign="bottom">
	<td class="bottom">
	<hr>
	
					<table width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td nowrap valign="top"><p><a href="javascript:history.go(-1);" class="boldlink"><img src="/img/back_arrow.gif" width="12" height="11" border="0"> précédent</a></p></td>
						<td nowrap valign="top"><p>&nbsp;|&nbsp;</p></td>
						<td width="100%" valign="top"><p><a href="s_main.php" class="boldlink">Retour à la page Steam - Module de dépannage</a></p></td>
					</tr>
					</table>
					
    
	</td>
</tr>
</table>

</body>

</html>
