<?php
/**
 * Installs preprocessed legacy form pages into database
 * Content has been extracted and preprocessed from archived_steampowered HTML files
 * This allows distributing the CMS without the archived_steampowered folder
 */

// Create table if not exists
try {
    $pdo->query('SELECT 1 FROM legacy_form_pages LIMIT 1');
} catch (PDOException $e) {
    if ($e->getCode() === '42S02') {
        $pdo->exec('CREATE TABLE legacy_form_pages (
            id INT AUTO_INCREMENT PRIMARY KEY,
            form_type VARCHAR(50) NOT NULL,
            version VARCHAR(50) NOT NULL,
            content MEDIUMTEXT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY unique_form_version (form_type, version)
        )');
    }
}

$stmt = $pdo->prepare('INSERT IGNORE INTO legacy_form_pages (form_type, version, content) VALUES (?, ?, ?)');

// Preprocessed Cafe Signup Version 1 (Feb 2004)
$cafeSignupV1 = <<<'HTML'
<!-- cyber cafe signup -->

<div class="content" id="container">
<h1>CYBER CAFE PROGRAM SIGN-UP</h1>
<h2>GIVE <em>YOUR CUSTOMERS THE GAMES THEY WANT!</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">

If you would like to offer Counter-Strike, Half-Life, and other Valve games to your customers, here is where to sign up. It usually takes about 1 business day to get your cafe into our database. (You'll be able to begin the technical setup process right away, though.)<br>
<br>
<h3 style="text-transform:uppercase;">Cyber Cafe Sign-Up Form</h3>
To enter you in the Cyber Cafe Program, we first need some information about your business. Please complete the sign-up form below. As soon as we receive this information we'll contact you -- but in the meantime feel free to <a href="mailto:cafe@valvesoftware.com">get in touch</a> with us if you have any questions.<br>
<br>

<!-- removed margins from textfield -->
<style>
<!--
INPUT.textfield2{
	width:200px;
	background:#3E4637;
	border-style:solid;
	border-width:1px;
	border-top-color:#1C261E;
	border-right-color:#818D7C;
	border-bottom-color:#818D7C;
	border-left-color:#1C261E;
	color:#BFBA50;
	}
INPUT.submitter3{
	height:24px;
	width:200px;
	text-align:center;
	padding-left:8px;
	margin:4px 0px 0px 0px;
	background:#4C5844;
	border-style:solid;
	border-width:1px;
	border-top-color:#818D7C;
	border-right-color:#1C261E;
	border-bottom-color:#1C261E;
	border-left-color:#818D7C;
	color:#C4CABE;
	}

-->
</style>




<form style="background:black;padding:6px;width:430px;" action="index.php" method="post">
<input type="hidden" name="area" value="cafe_signup">
<table cellspacing="6" width="100%" style="background:#4C5844;">
<tbody><tr>
	<td></td><td><p class="bright"><strong>Company information</strong></p></td>
</tr>
<tr>
	<td valign="middle" align="right">Company Name </td>
	<td valign="middle"><input type="text" name="form_company_name" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Contact Name </td>
	<td valign="middle"><input type="text" name="form_company_contact" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Street Address 1 </td>
	<td valign="middle"><input type="text" name="form_company_add1" value="" class="textfield2" maxlength="64"></td>
</tr>
<tr>
	<td valign="middle" align="right">Street Address 2 </td>
	<td valign="middle"><input type="text" name="form_company_add2" value="" class="textfield2" maxlength="64"> <sup>(optional)</sup></td>
</tr>
<tr>
	<td valign="middle" align="right">City </td>
	<td valign="middle"><input type="text" name="form_company_city" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Province/State </td>
	<td valign="middle"><input type="text" name="form_company_state" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Country </td>
	<td valign="middle"><input type="text" name="form_company_country" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Zip/Postal code </td>
	<td valign="middle"><input type="text" name="form_company_zip" value="" class="textfield2" maxlength="24"></td>
</tr>
<tr>
	<td></td><td><br><p class="bright"><strong>Cafe details</strong></p></td>
	</tr>
<tr>
	<td valign="middle" align="right">Locations </td>
	<td valign="middle"><input type="text" name="form_cafe_locations" value="" class="textfield2" maxlength="4"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><sup>* total number of cafe locations</sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Stations to license </td>
	<td valign="middle"><input type="text" name="form_cafe_stations" value="" class="textfield2" maxlength="5"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><sup>* total number of computer stations to license</sup><br>&nbsp;</td>
</tr>
<tr>
	<td></td><td><p class="bright"><strong>Billing contact information</strong></p></td>
</tr>
<tr>
	<td valign="middle" align="right">Email address </td>
	<td valign="middle"><input type="text" name="form_admin_email" value="" class="textfield2" maxlength="64"></td>
</tr>
<tr>
	<td valign="middle" align="right">Phone number </td>
	<td valign="middle"><input type="text" name="form_admin_phone" value="" class="textfield2" maxlength="24"></td>
</tr>
<tr>
	<td></td><td><p class="bright"><br><strong>Technical contact information</strong></p></td>
</tr>
<tr>
	<td valign="middle" align="right">Email address </td>
	<td valign="middle"><input type="text" name="form_tech_email" value="" class="textfield2" maxlength="64"></td>
</tr>
<tr>
	<td valign="middle" align="right">Phone number </td>
	<td valign="middle"><input type="text" name="form_tech_phone" value="" class="textfield2" maxlength="24"></td>
</tr>
<tr>
	<td></td>
	<td><p><br><input type="submit" name="perform" value="Submit" class="submitter3"></p></td>
</tr>
<tr>
	<td>&nbsp;</td><td></td>
</tr>
</tbody></table>
</form><br>


<h3 style="text-transform:uppercase;">Next Steps</h3>

It usually takes about a day for us to contact you after you've submitted the above info. Adding your cafe to our database will require a signed contract, which we will send to you right away.<br>
<br>
After that process has been completed and you've received confirmation that your company has been entered into the program, you can begin setting up Steam on your computers. Here are some <a href="index.php?area=cafe_setup">instructions on how to get your cafe up and running</a> with Steam.<br>
<br>
<a href="index.php?area=cybercafes">Return to main Cyber Cafe page</a>

</div>
</div>
HTML;

$stmt->execute(['cafe_signup', '2004_signup_v1', $cafeSignupV1]);

// Preprocessed Cafe Signup Version 2 (June 2004)
$cafeSignupV2 = <<<'HTML'
<!-- cyber cafe signup -->

<div class="content" id="container">
<h1>CYBER CAFE PROGRAM SIGN-UP</h1>
<h2>GIVE <em>YOUR CUSTOMERS THE GAMES THEY WANT!</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">

If you would like to offer Counter-Strike, Half-Life, and other Valve games to your customers, here is where to sign up. It usually takes about 1 business day to get your cafe into our database. (You'll be able to begin the technical setup process right away, though.)<br>
<br>
<h3 style="text-transform:uppercase;">Cyber Cafe Sign-Up Form</h3>
To enter you in the Cyber Cafe Program, we first need some information about your business. Please complete the sign-up form below. As soon as we receive this information we'll contact you -- but in the meantime feel free to <a href="mailto:cafe@valvesoftware.com">get in touch</a> with us if you have any questions. Also, please see the <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement</a>, which includes terms for licensed cyber cafe operators.<br>
<br>


<!-- removed margins from textfield -->
<style>
<!--
INPUT.textfield2{
	width:200px;
	background:#3E4637;
	border-style:solid;
	border-width:1px;
	border-top-color:#1C261E;
	border-right-color:#818D7C;
	border-bottom-color:#818D7C;
	border-left-color:#1C261E;
	color:#BFBA50;
	}
INPUT.submitter3{
	height:24px;
	width:200px;
	text-align:center;
	padding-left:8px;
	margin:4px 0px 0px 0px;
	background:#4C5844;
	border-style:solid;
	border-width:1px;
	border-top-color:#818D7C;
	border-right-color:#1C261E;
	border-bottom-color:#1C261E;
	border-left-color:#818D7C;
	color:#C4CABE;
	}

-->
</style>




<script language="JavaScript">
function showBranch(branch){
	var objBranch = document.getElementById(branch).style;
	if(objBranch.display=="block")
	{
		objBranch.display="none";
	}
	else
	{
		objBranch.display="block";
	}
}
</script>
<form style="background:black;padding:6px;width:480px;" action="index.php" method="post">
<input type="hidden" name="area" value="cafe_signup">
<div id="more_locations" style="display:none;">
</div><table cellspacing="6" width="100%" style="background:#4C5844;">
<tbody><tr>
	<td></td><td><p class="bright"><strong>Parent Company information</strong></p></td>
</tr>
<tr>
	<td valign="middle" align="right">Company Name </td>
	<td valign="middle"><input type="text" name="form_company_name" value="" class="textfield2" maxlength="32"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Contact First Name </td>
	<td valign="middle"><input type="text" name="form_company_contact_first" value="" class="textfield2" maxlength="32"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Contact Last Name </td>
	<td valign="middle"><input type="text" name="form_company_contact_last" value="" class="textfield2" maxlength="32"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Street Address 1 </td>
	<td valign="middle"><input type="text" name="form_company_add1" value="" class="textfield2" maxlength="64"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Street Address 2 </td>
	<td valign="middle"><input type="text" name="form_company_add2" value="" class="textfield2" maxlength="64"> <sup>(optional)</sup></td>
</tr>
<tr>
	<td valign="middle" align="right">City </td>
	<td valign="middle"><input type="text" name="form_company_city" value="" class="textfield2" maxlength="32"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Province/State </td>
	<td valign="middle"><input type="text" name="form_company_state" value="" class="textfield2" maxlength="32"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Country </td>
	<td valign="middle"><input type="text" name="form_company_country" value="" class="textfield2" maxlength="32"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Zip/Postal code </td>
	<td valign="middle"><input type="text" name="form_company_zip" value="" class="textfield2" maxlength="24"><sup></sup></td>
</tr>
<tr>
	<td></td><td><p class="bright"><strong><br>Billing contact information</strong></p></td>
</tr>
<tr>
	<td valign="middle" align="right">Email address </td>
	<td valign="middle"><input type="text" name="form_admin_email" value="" class="textfield2" maxlength="64"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Phone number </td>
	<td valign="middle"><input type="text" name="form_admin_phone" value="" class="textfield2" maxlength="24"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Fax number </td>
	<td valign="middle"><input type="text" name="form_admin_fax" value="" class="textfield2" maxlength="24"></td>
</tr>
<tr>
	<td></td><td><p class="bright"><br><strong>Technical contact information</strong></p></td>
</tr>
<tr>
	<td valign="middle" align="right">Email address </td>
	<td valign="middle"><input type="text" name="form_tech_email" value="" class="textfield2" maxlength="64"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Phone number </td>
	<td valign="middle"><input type="text" name="form_tech_phone" value="" class="textfield2" maxlength="24"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Fax number </td>
	<td valign="middle"><input type="text" name="form_tech_fax" value="" class="textfield2" maxlength="24"></td>
</tr>
<tr>
	<td></td><td><br><p class="bright"><strong>Cafe details</strong></p></td>
</tr>
<tr>
	<td valign="middle" align="right">Number of Locations </td>
	<td valign="middle"><input type="text" name="form_cafe_locations" value="" class="textfield2" maxlength="4"><sup></sup></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><sup>* total number of cafe locations</sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Stations to license </td>
	<td valign="middle"><input type="text" name="form_cafe_stations" value="" class="textfield2" maxlength="5"><sup></sup></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
	<sup>* total number of computer stations to license</sup><br>
	<sup>* a minimum of 10 stations is reqiured</sup>
	</td>
</tr>
<tr>
	<td></td><td><br><p class="bright"><strong>Location 1</strong></p></td>
</tr>
<tr>
	<td valign="middle" align="right">Cafe Name</td>
	<td valign="middle"><input type="text" name="cafe1_name" value="" class="textfield2" maxlength="32"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Street Address</td>
	<td valign="middle"><input type="text" name="cafe1_street" value="" class="textfield2" maxlength="32"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">City</td>
	<td valign="middle"><input type="text" name="cafe1_city" value="" class="textfield2" maxlength="32"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Province/State</td>
	<td valign="middle"><input type="text" name="cafe1_state" value="" class="textfield2" maxlength="32"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Country</td>
	<td valign="middle"><input type="text" name="cafe1_country" value="" class="textfield2" maxlength="32"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Zip/Postal Code</td>
	<td valign="middle"><input type="text" name="cafe1_postcode" value="" class="textfield2" maxlength="12"><sup></sup></td>
</tr>
<tr>
	<td valign="middle" align="right">Number of computer stations</td>
	<td valign="middle"><input type="text" name="cafe1_stations" value="" class="textfield2" maxlength="12"><sup></sup></td>
</tr>

<tr>
	<td></td><td><br><p class="bright"><strong>Location 2</strong></p></td>
</tr>
<tr>
	<td valign="middle" align="right">Cafe Name</td>
	<td valign="middle"><input type="text" name="cafe2_name" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Street Address</td>
	<td valign="middle"><input type="text" name="cafe2_street" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">City</td>
	<td valign="middle"><input type="text" name="cafe2_city" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Province/State</td>
	<td valign="middle"><input type="text" name="cafe2_state" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Country</td>
	<td valign="middle"><input type="text" name="cafe2_country" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Zip/Postal Code</td>
	<td valign="middle"><input type="text" name="cafe2_postcode" value="" class="textfield2" maxlength="12"></td>
</tr>
<tr>
	<td valign="middle" align="right">Number of computer stations</td>
	<td valign="middle"><input type="text" name="cafe2_stations" value="" class="textfield2" maxlength="12"></td>
</tr>

<tr>
	<td></td><td><br><p class="bright"><strong>Location 3</strong></p></td>
</tr>
<tr>
	<td valign="middle" align="right">Cafe Name</td>
	<td valign="middle"><input type="text" name="cafe3_name" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Street Address</td>
	<td valign="middle"><input type="text" name="cafe3_street" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">City</td>
	<td valign="middle"><input type="text" name="cafe3_city" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Province/State</td>
	<td valign="middle"><input type="text" name="cafe3_state" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Country</td>
	<td valign="middle"><input type="text" name="cafe3_country" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Zip/Postal Code</td>
	<td valign="middle"><input type="text" name="cafe3_postcode" value="" class="textfield2" maxlength="12"></td>
</tr>
<tr>
	<td valign="middle" align="right">Number of computer stations</td>
	<td valign="middle"><input type="text" name="cafe3_stations" value="" class="textfield2" maxlength="12"></td>
</tr>

<tr>
	<td></td><td><br><p class="bright"><strong>Location 4</strong></p></td>
</tr>
<tr>
	<td valign="middle" align="right">Cafe Name</td>
	<td valign="middle"><input type="text" name="cafe4_name" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Street Address</td>
	<td valign="middle"><input type="text" name="cafe4_street" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">City</td>
	<td valign="middle"><input type="text" name="cafe4_city" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Province/State</td>
	<td valign="middle"><input type="text" name="cafe4_state" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Country</td>
	<td valign="middle"><input type="text" name="cafe4_country" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Zip/Postal Code</td>
	<td valign="middle"><input type="text" name="cafe4_postcode" value="" class="textfield2" maxlength="12"></td>
</tr>
<tr>
	<td valign="middle" align="right">Number of computer stations</td>
	<td valign="middle"><input type="text" name="cafe4_stations" value="" class="textfield2" maxlength="12"></td>
</tr>

<tr>
	<td></td><td><br><p class="bright"><strong>Location 5</strong></p></td>
</tr>
<tr>
	<td valign="middle" align="right">Cafe Name</td>
	<td valign="middle"><input type="text" name="cafe5_name" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Street Address</td>
	<td valign="middle"><input type="text" name="cafe5_street" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">City</td>
	<td valign="middle"><input type="text" name="cafe5_city" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Province/State</td>
	<td valign="middle"><input type="text" name="cafe5_state" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Country</td>
	<td valign="middle"><input type="text" name="cafe5_country" value="" class="textfield2" maxlength="32"></td>
</tr>
<tr>
	<td valign="middle" align="right">Zip/Postal Code</td>
	<td valign="middle"><input type="text" name="cafe5_postcode" value="" class="textfield2" maxlength="12"></td>
</tr>
<tr>
	<td valign="middle" align="right">Number of computer stations</td>
	<td valign="middle"><input type="text" name="cafe5_stations" value="" class="textfield2" maxlength="12"></td>
</tr>



<tr>
	<td></td>
	<td><p><br><input type="submit" name="perform" value="Submit" class="submitter3"></p></td>
</tr>
<tr>
	<td>&nbsp;</td><td></td>
</tr>
</tbody></table>
</form><br>


<h3 style="text-transform:uppercase;">Next Steps</h3>

It usually takes about a day for us to contact you after you've submitted the above info. Adding your cafe to our database will require a signed contract, which we will send to you right away.<br>
<br>
After that process has been completed and you've received confirmation that your company has been entered into the program, you can begin setting up Steam on your computers. Here are some <a href="index.php?area=cafe_setup">instructions on how to get your cafe up and running</a> with Steam.<br>
<br>
<a href="index.php?area=cybercafes">Return to main Cyber Cafe page</a>

</div>
</div>
HTML;

$stmt->execute(['cafe_signup', '2004_signup_v2', $cafeSignupV2]);

// Preprocessed Cheat Form Version 1 (Jan 2004)
$cheatFormV1 = <<<'HTML'
<!-- cheater cheater pumpkin eater! -->
<div class="content" id="container">
<h1>BEEN CAUGHT CHEATING?</h1>
<h2>HERE'S <em>WHAT YOU NEED TO KNOW</em></h2><img src="./images/Graphic_box.jpg" height="6" width="24" alt=""><br>
<br>
<div class="narrower">
Valve's anti-cheat system (VAC) automatically detects programs and other methods used to cheat in Valve's games. If you're viewing this page, it's probably because VAC has determined that a cheat was being used on your computer when connecting to a secure (VAC-enabled) game server.<br>
<img hspace="48" src="./images/vac.gif" width="316" height="190" alt="VAC"><br>
<h3 style="text-transform:uppercase;">You've been banned</h3>
If VAC has determined that your account was used to cheat, you will be banned for five years from playing Valve's games on VAC-enabled game servers. <br><br>
<br>

<h3 style="text-transform:uppercase;">Pleading your case</h3>
This page is designed to let you tell your side of the story. We have learned to be somewhat skeptical about anyone saying they've been falsely accused. But luckily, it's easy for us to check through the VAC system logs -- if you used a cheat, then we know where and when you cheated, and what cheat you used.<br><br>
If, after reading the above, you would still like to contact us about your situation, please fill out the following form. Once you've done so, one of two things will happen:<br><br>
<span class="maize"><b>1.</b></span> We'll look up your info, read your plea, and determine that you've been banned for good reason. In this case, you will not hear back from us, and we will take no action to remove the ban on your account.<br><br>
OR<br><br>
<span class="maize"><b>2.</b></span> We'll decide that you actually do have a special case, and deserve some attention. In this case, we will contact you within a few days of receiving your request.<br><br>

<br>

<!-- removed margins from textfield -->
<style>
<!--
INPUT.textfield2{
	margin-top:4px;
	width:200px;
	background:#3E4637;
	border-style:solid;
	border-width:1px;
	border-top-color:#1C261E;
	border-right-color:#818D7C;
	border-bottom-color:#818D7C;
	border-left-color:#1C261E;
	color:#BFBA50;
	}
SELECT.textfield2{
	margin-top:4px;
	width:200px;
	background:#3E4637;
	border-style:solid;
	border-width:1px;
	border-top-color:#1C261E;
	border-right-color:#818D7C;
	border-bottom-color:#818D7C;
	border-left-color:#1C261E;
	color:#BFBA50;
	}
TEXTAREA{
	margin-top:4px;
	background:#3E4637;
	border-style:solid;
	border-width:1px;
	border-top-color:#1C261E;
	border-right-color:#818D7C;
	border-bottom-color:#818D7C;
	border-left-color:#1C261E;
	color:#BFBA50;
	scrollbar-base-color: #4C5844;
	}
INPUT.submitter3{
	height:24px;
	width:200px;
	text-align:center;
	padding-left:8px;
	margin:4px 0px 0px 0px;
	background:#4C5844;
	border-style:solid;
	border-width:1px;
	border-top-color:#818D7C;
	border-right-color:#1C261E;
	border-bottom-color:#1C261E;
	border-left-color:#818D7C;
	color:white;
	}

-->
</style>


<script language="JavaScript" src="pop.js"></script>
<div style="background: #4C5844; border: solid; border-color: black; border-width: 6px;"><form style="margin: 0px; padding: 12px;" action="index.php" method="post">
<input type="hidden" name="area" value="cheat_form">
What is your Steam login (email address)?<br>
<input type="text" name="steamEmail" value="" class="textfield2" maxlength="32"><br><br>

Enter a valid email address, if you don't use the one above<br>
<input type="text" name="validEmail" value="" class="textfield2" maxlength="32"><br><br>

What is your Steam ID? (optional)<br>
<input type="text" name="steamId" value="" class="textfield2" maxlength="32"><br><br>

What is your CD key? (optional)<br>
<input type="text" name="cdKey" value="" class="textfield2" maxlength="32"><br><br>

Which operating system do you use?<br>
<select name="operatingSystem" class="textfield2">
<option value="Windows 95">Windows 95</option>
<option value="Windows 98">Windows 98</option>
<option value="Windows ME">Windows ME</option>
<option value="Windows NT">Windows NT</option>
<option value="Windows 2000">Windows 2000</option>
<option value="Windows XP" selected="">Windows XP</option>
</select>
<br><br>

Plead your case here:<br>
<textarea name="plea" height="3" cols="42" rows="4" maxlength="250"></textarea><br><br>

<input type="submit" name="perform" value="I swear I am telling the truth!" class="submitter3">
</form></div><br>

</div>
</div>
HTML;

$stmt->execute(['cheat_form', '2004_cheat_v1', $cheatFormV1]);

// Preprocessed Cheat Form Version 2 (redirects to troubleshooter)
$cheatFormV2 = <<<'HTML'
<!-- forums -->
<script>
function popup(src,scroll,x,y,target)
{
	open(src,target,"scrollbars="+scroll+",width="+x+",height="+y+",menubar=0,resizable=yes")
}
</script>
<div class="content" id="container">
<h1>CHEAT FORM</h1>
<h2>BEEN <em>CAUGHT CHEATING?</em></h2><img alt="" height="6" src="./images/Graphic_box.jpg" width="24"/><br/>
<div class="narrower">
<br/>

Support for the Valve Anti-Cheat has been moved into the <a href="javascript:popup('/troubleshooter/live/index.php','yes',550,550,'')">Steam troubleshooter</a>.

</div>
</div>
HTML;

$stmt->execute(['cheat_form', '2004_cheat_v2', $cheatFormV2]);

// Preprocessed CD Account Form Version 1
$cdAccountV1 = <<<'HTML'
<div class="content" id="container">
<h1>CD KEYS AND STEAM ACCOUNTS</h1>
<h2>CONTACT <em>FORM</em></h2><img alt="" height="6" src="./images/Graphic_box.jpg" width="24"/><br/>
<br/>
<div class="narrower">
<p>If you are experiencing problems related to a CD keys or Steam accounts, and have not been helped by the <a href="index.php?area=cd_account_faq">CD Keys And Steam Accounts FAQ</a> page, you can submit your problem to Steam support using the form provided below.</p>
<br/>
<!-- removed margins from textfield -->
<style>
	<!--
	INPUT.textfield2{
		margin-top:4px;
		width:220px;
		background:#3E4637;
		border-style:solid;
		border-width:1px;
		border-top-color:#1C261E;
		border-right-color:#818D7C;
		border-bottom-color:#818D7C;
		border-left-color:#1C261E;
		color:#BFBA50;
		}
	SELECT.textfield2{
		margin-top:4px;
		width:220px;
		background:#3E4637;
		border-style:solid;
		border-width:1px;
		border-top-color:#1C261E;
		border-right-color:#818D7C;
		border-bottom-color:#818D7C;
		border-left-color:#1C261E;
		color:#BFBA50;
		}
	TEXTAREA{
		margin-top:4px;
		background:#3E4637;
		border-style:solid;
		border-width:1px;
		border-top-color:#1C261E;
		border-right-color:#818D7C;
		border-bottom-color:#818D7C;
		border-left-color:#1C261E;
		color:#BFBA50;
		scrollbar-base-color: #4C5844;
		}
	INPUT.submitter3{
		height:24px;
		width:200px;
		text-align:center;
		padding-left:8px;
		margin:4px 0px 0px 0px;
		background:#4C5844;
		border-style:solid;
		border-width:1px;
		border-top-color:#818D7C;
		border-right-color:#1C261E;
		border-bottom-color:#1C261E;
		border-left-color:#818D7C;
		color:white;
		}

	-->
	</style>
<script language="JavaScript">
    <!-- Original:  Colin Pc  -->
    <!-- Web Site:  http://www.insighteye.com/ -->

    <!-- This script and many more are available free online at -->
    <!-- The JavaScript Source!! http://javascript.internet.com -->

    <!-- Begin
    function checkCheckBox(f)
    {
        if ( f.readfaq.checked == false )
        {
            alert('Please read the CD Keys And Steam Accounts FAQ before submitting this form.');
            return false;
        }
        else
            return true;
    }
    //  End -->
    </script>
<script language="JavaScript" src="pop.js"></script>
<div style="background: #4C5844; border: solid; border-color: black; border-width: 6px;"><form action="index.php" method="post" onsubmit="return checkCheckBox(this)" style="margin: 0px; padding: 12px;">
<input name="area" type="hidden" value="cd_account_form"/>

	Enter a valid contact email address, where Steam Support can reach you.<br/>
<input class="textfield2" maxlength="32" name="validEmail" type="text" value=""/><br/><br/>

	What is your Steam Account Name?<br/>
<input class="textfield2" maxlength="32" name="steamLogin" type="text" value=""/><br/>
<span style="font-size: 9px;">We don't need your password, or your Friends nickname, only the Account Name that you use to login to Steam.</span>
<br/><br/>

	What is your product CD key? (optional)<br/>
<input class="textfield2" maxlength="32" name="cdKey" type="text" value=""/><br/><br/>

	How did you originally purchase your Steam games?<br/>
<select class="textfield2" name="purchaseWhere" size="1">
<option id="purchaseWhere" value="Retail">At a retail store</option>
<option id="purchaseWhere" value="Steam">Through Steam</option>
<option id="purchaseWhere" value="Both">Both (at a store and through Steam)</option>
</select><br/><br/>

    Does anyone else have access to your Steam account login/password?<br/>
<select class="textfield2" name="accessOthers" size="1">
<option id="accessOthers" value="No">No</option>
<option id="accessOthers" value="Yes">Yes</option>
</select><br/><br/>

    Do you access your Steam account from multiple computers?<br/>
<select class="textfield2" name="accessMultiple" size="1">
<option id="accessMultiple" value="No">No</option>
<option id="accessMultiple" value="Yes">Yes</option>
</select><br/><br/>

	When were you last able to successfully login to Steam?<br/>
<input class="textfield2" maxlength="32" name="steamLastLogin" type="text" value=""/><br/><br/>

	What is your internet IP address?<br/>
<input class="textfield2" maxlength="32" name="steamIP" type="text" value=""/><br/><br/>

	Describe the problem you're having in detail:<br/>
<textarea cols="42" height="10" maxlength="250" name="problem" rows="10"></textarea><br/><br/>
<p><input name="readfaq" type="checkbox" value=""/> I have read the <a href="index.php?area=cd_account_faq" target="_blank">CD Keys And Steam Accounts FAQ</a></p>
<input class="submitter3" name="perform" type="submit" value="submit"/>
</form></div><br/>
</div>
</div>
HTML;

$stmt->execute(['cd_account', '2004_cd_v1', $cdAccountV1]);

// Preprocessed CD Account Form Version 2 (redirects to troubleshooter)
$cdAccountV2 = <<<'HTML'
<!-- forums -->
<script>
function popup(src,scroll,x,y,target)
{
	open(src,target,"scrollbars="+scroll+",width="+x+",height="+y+",menubar=0,resizable=yes")
}
</script>
<div class="content" id="container">
<h1>CD KEYS AND STEAM ACCOUNTS</h1>
<h2>CONTACT <em>FORM</em></h2><img alt="" height="6" src="./images/Graphic_box.jpg" width="24"/><br/>
<div class="narrower">
<br/>

Support for the CD Keys and Steam accounts has been moved into the <a href="javascript:popup('/troubleshooter/live/index.php','yes',550,550,'')">Steam troubleshooter</a>.

</div>
</div>
HTML;

$stmt->execute(['cd_account', '2004_cd_v2', $cdAccountV2]);
