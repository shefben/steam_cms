<?php $page_title = 'Cyber Caf&eacute; Program Change Form'; include 'cms/header.php'; ?>

	<!-- cyber cafe signup -->

	<div class="content" id="container">
	<h1>CYBER CAF&Eacute; CHANGE FORM</H1>
	<h2>FOR EXISTING <em>CUSTOMERS</em></h2>
	<br>
	<div class="narrower" style="width: 75%;">

	Please Note: This form is for making updates to your existing caf&eacute;s already registered in the Valve Cyber Caf&eacute; Program. If you are a new customer, please visit the <a href="cafe_signup.php">Cyber Caf&eacute; Program Sign-up</a> webpage.<br>
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

	<form style="background:black;padding:6px;width:100%;" action="index.php" method="post">
	<input type="hidden" name="area" value="cybercafe_changeform">
	<table cellspacing="6" width="100%" style="background:#4C5844;">
	<tr>
		<td valign="middle" align="right" width="50%"><p class="bright"><strong>Cafe ID Number: </strong></p></td>
		<td width="50%" height="56">
		
			<input type="text" name="form_cafe_id" value="" class="textfield2" maxlength="32">
			<sup></sup>
		
		</td>
	</tr>
	<tr>
		<td colspan="2">

			<p class="bright">
			<input type="checkbox" name="form_update_parent_info" value="checked" >
			<strong>I would like to update my parent company name and/or address:</strong></p>
		
		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">New Company Name </td>
		<td valign="middle" width="50%">
		
			<input type="text" name="form_new_company_name" value="" class="textfield2" maxlength="32">
			<sup></sup>
			
		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">New Street Address </td>
		<td valign="middle" width="50%">
		
			<input type="text" name="form_new_street_address" value="" class="textfield2" maxlength="32">
			<sup></sup>
			
		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">New City </td>
		<td valign="middle" width="50%">
		
			<input type="text" name="form_new_city" value="" class="textfield2" maxlength="32">
			<sup></sup>
			
		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">New Province/State </td>
		<td valign="middle" width="50%">
		
			<input type="text" name="form_new_province_state" value="" class="textfield2" maxlength="64">
			<sup></sup>
		
		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">New Country </td>
		<td valign="middle" width="50%">
		
			<input type="text" name="form_new_country" value="" class="textfield2" maxlength="64">
			<sup></sup>
		
		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">New Zip/Postal Code </td>
		<td valign="middle" width="50%">
		
			<input type="text" name="form_new_postcode" value="" class="textfield2" maxlength="32">
			<sup></sup>
		
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td colspan="2">
		
			<p class="bright">
			<input type="checkbox" name="form_update_billing_tech" value="checked" >
			<strong>I would like to update my billing and/or technical contact information:</strong></p>

		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">New Billing Contact First Name </td>
		<td valign="middle" width="50%">
		
			<input type="text" name="form_bill_fname" value="" class="textfield2" maxlength="32">
			<sup></sup>
		
		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">New Billing Contact Last Name </td>
		<td valign="middle" width="50%">
		
			<input type="text" name="form_bill_lname" value="" class="textfield2" maxlength="32">
			<sup></sup>
		
		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">New Billing Contact Email Address</td>
		<td valign="middle" width="50%">
		
			<input type="text" name="form_bill_email" value="" class="textfield2" maxlength="32">

		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" height="28" width="50%">New Billing Contact Phone Number </td>
		<td valign="middle" height="28" width="50%">
		
			<input type="text" name="form_bill_phone" value="" class="textfield2" maxlength="24">
			<sup></sup>
		
		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">New Billing Contact Fax Number </td>
		<td valign="middle" width="50%">
		
			<input type="text" name="form_bill_fax" value="" class="textfield2" maxlength="24">
			<sup></sup>
		
		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%"><br>New Technical Contact First Name </td>
		<td valign="bottom" width="50%">
		
			<input type="text" name="form_tech_fname" value="" class="textfield2" maxlength="32">
			<sup></sup>
		
		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">New Technical Contact Last Name </td>
		<td valign="middle" width="50%">
		
			<input type="text" name="form_tech_lname" value="" class="textfield2" maxlength="32">
			<sup></sup>
		
		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">New Technical Contact Email Address</td>
		<td valign="middle" width="50%">
		
			<input type="text" name="form_tech_email" value="" class="textfield2" maxlength="32">

		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" height="28" width="50%">New Technical Contact Phone Number </td>
		<td valign="middle" height="28" width="50%">
		
			<input type="text" name="form_tech_phone" value="" class="textfield2" maxlength="24">
			<sup></sup>
		
		</td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">New Technical Contact Fax Number </td>
		<td valign="middle" width="50%">
		
			<input type="text" name="form_tech_fax" value="" class="textfield2" maxlength="24">
			<sup></sup>
		
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td colspan="2">
		
			<p class="bright">
			<input type="checkbox" name="form_change_exist_seats" value="checked" >
			<strong>I would like to change the number of seats at my existing cafe:</strong></p>

		</td>
	</tr>
	<tr>
		<td valign="middle" align="right">Current # of Seats:</td>
		<td>
			
			<input type="text" name="form_current_seats" value="" class="textfield2" maxlength="5" style="width:32px;">

		</td>
	</tr>
	<tr>
		<td valign="middle" align="right">New # of Seats:</td>
		<td>
		
			<input type="text" name="form_new_seats" value="" class="textfield2" maxlength="5" style="width:32px;">
		
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td colspan="2">

			<p class="bright">
			<input type="checkbox" name="form_add_cafe_locations" value="checked" >
			<strong>I would like to add more cafe locations:</strong></p>
			
		</td>
	</tr>
	<tr>
		<td valign="middle" align="right">Current # of Locations:</td>
		<td>
		
			<input type="text" name="form_current_locations" value="" class="textfield2" maxlength="5" style="width:32px;">

		</td>
	</tr>
	<tr>
		<td valign="middle" align="right">New # of Locations:</td>
		<td><input type="text" name="form_new_locations" value="" class="textfield2" maxlength="5" style="width:32px;"></td>
	</tr>
	<tr>
		<td width="50%"></td>
		<td width="50%"><br><p class="bright"><strong>New Cafe Location</strong></p></td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">Name</td>
		<td valign="middle" width="50%"><input type="text" name="cafe2_name" value="" class="textfield2" maxlength="32"></td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">Street Address</td>
		<td valign="middle" width="50%"><input type="text" name="cafe2_street" value="" class="textfield2" maxlength="32"></td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">City</td>
		<td valign="middle" width="50%"><input type="text" name="cafe2_city" value="" class="textfield2" maxlength="32"></td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">Province/State</td>
		<td valign="middle" width="50%"><input type="text" name="cafe2_state" value="" class="textfield2" maxlength="32"></td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">Country</td>
		<td valign="middle" width="50%"><input type="text" name="cafe2_country" value="" class="textfield2" maxlength="32"></td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">Zip/Postal Code</td>
		<td valign="middle" width="50%"><input type="text" name="cafe2_postcode" value="" class="textfield2" maxlength="12"></td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">Number of Computer Seats</td>
		<td valign="middle" width="50%"><input type="text" name="cafe2_stations" value="" class="textfield2" maxlength="12"></td>
	</tr>
	<tr>
		<td width="50%"></td>
		<td width="50%"><br><p class="bright"><strong>2nd New Cafe Location</strong></p></td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">Name</td>
		<td valign="middle" width="50%"><input type="text" name="cafe3_name" value="" class="textfield2" maxlength="32"></td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">Street Address</td>
		<td valign="middle" width="50%"><input type="text" name="cafe3_street" value="" class="textfield2" maxlength="32"></td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">City</td>
		<td valign="middle" width="50%"><input type="text" name="cafe3_city" value="" class="textfield2" maxlength="32"></td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">Province/State</td>
		<td valign="middle" width="50%"><input type="text" name="cafe3_state" value="" class="textfield2" maxlength="32"></td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">Country</td>
		<td valign="middle" width="50%"><input type="text" name="cafe3_country" value="" class="textfield2" maxlength="32"></td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">Zip/Postal Code</td>
		<td valign="middle" width="50%"><input type="text" name="cafe3_postcode" value="" class="textfield2" maxlength="12"></td>
	</tr>
	<tr>
		<td valign="middle" align="right" width="50%">Number of Computer Seats</td>
		<td valign="middle" width="50%"><input type="text" name="cafe3_stations" value="" class="textfield2" maxlength="12"></td>
	</tr>
	<tr>
		<td width="50%"></td>
		<td width="50%"><p><br><input type="submit" name="perform" value="Submit" class="submitter3"></p></td>
	</tr>
	<tr>
		<td width="50%">&nbsp;</td>
		<td width="50%"></td>
	</tr>
	</table>
	</form><br>

	<h3 style="text-transform:uppercase;">Next Steps</h3>

	You will receive a confirmation when your updates have been made to your account.<br>
	<br>
	<a href="cybercafes.php">Return to main Cyber Caf&eacute; page</a>

	</div>
	</div>
<?php include 'cms/footer.php'; ?>
