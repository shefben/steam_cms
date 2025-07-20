<?php $page_title = 'Support'; include 'cms/header.php'; ?>
<!-- support -->

<div class="content" id="container">
<?php
$active_theme = cms_get_setting('theme', '2004');
if ($active_theme === '2003_v1' && cms_get_setting('support2003_show', '1') === '1') {
    echo cms_get_setting('support2003_html', '<div class="notification"><b>:: REQUIRED UPDATE AVAILABLE</b></div>');
}
?>
<h1>SUPPORT</H1>
<h2>QUESTIONS, <em>ANSWERS, BUG FIXES, ETC</em></h2><img src="/img/Graphic_box.jpg" height="6" width="24" alt=""><br>

<div class="boxTop">5 Top Support Questions</div><br clear="all">
<div class="box">
				
				<a href="faq6.php"><strong>Do I have to be connected to the Internet when I play Steam games?</strong></a><br>
				<span style="font-size: 10px;">March 11, 2004, 12:22 pm</span><br><br>

				<a href="faq5.php"><strong>How can I have a LAN party or similar event using Steam?</strong></a><br>
				<span style="font-size: 10px;">September 29, 2003, 4:18 pm</span><br><br>
				
				<a href="faq8.php"><strong>I'm getting a "This game is currently unavailable" message. What gives?</strong></a><br>
				<span style="font-size: 10px;">September 29, 2003, 4:16 pm</span><br><br>
				
				<a href="faq9.php"><strong>Why is there non-Steam information in my Steam cache files? Is Steam Spyware?</strong></a><br>
				<span style="font-size: 10px;">September 16, 2003, 5:27 pm</span><br><br>
				
				<a href="faq7.php"><strong>Does Steam collect or share my personal information?</strong></a><br>
				<span style="font-size: 10px;">July 9, 2003, 8:22 pm</span><br><br>
				
</div>

<div class="narrower">

<script>
function popup(src,scroll,x,y,target)
{
	open(src,target,"scrollbars="+scroll+",width="+x+",height="+y+",menubar=0,resizable=yes")
}
</script>


<h3>STEAM TROUBLESHOOTER</h3>
The <a href="javascript:popup('/troubleshooter/live/index.php','yes',550,550,'')">troubleshooter</a> is the fastest way to get help with Steam-related issues.  It can provide immediate answers to the most common Steam problems, and can also help you contact Steam support when you need help with a more complicated issue.
<br><br>

<!-- <h3>CD KEYS AND STEAM ACCOUNT QUESTIONS</h3>
If you are having problems related to your CD keys or Steam accounts, the <a href="index.php?area=cd_account_faq">CD Keys and Steam Accounts Frequently Asked Questions</a> may provide a solution.  Once you've read through the FAQ, you can submit a request for help if necessary using the <a href="index.php?area=cd_account_form">CD Key & Account Contact Form</a>.<br><br>

<ul>
<li> <a href="index.php?area=cd_account_form">CD Key & Steam Account Form</a>
<li> <a href="index.php?area=cheat_form">Valve Anti-Cheat Contact Form</a>
</ul><br>
-->

<h3>OTHER FREQUENTLY ASKED QUESTIONS</h3>
If you're using Steam and running into trouble, you may find a solution in our more general list of <a href="faq.php">Frequently Asked Questions</a>.<br><br>

<h3>MESSAGE BOARD</h3>
For issues not covered in the FAQ, <a href="forums.php">the online forums</a> on this website are another resource worth investigating.<br><br>
<!--
<a href="index.php?area=faq&section=billing&support=yes" style="text-decoration: none;"><h3>BILLING SUPPORT</h3></a>
For any issues related to credit cards or billing, please visit the Steam Billing Support page.
<br><br>
-->

<h3>SUBSCRIBER AGREEMENT, BILLING, AND ONLINE CONDUCT</h3>
When you install Steam, you agree to be bound by the <a href="subscriber_agreement.php">Steam Subscriber Agreement</a>. The billing policies for Steam can be found here [coming soon]. Also, please refer to the <a href="online_conduct.php">online conduct rules</a> for Steam and the Steam network.<br><br>

<h3>CYBER CAF&Eacute;S</h3>
If you operate a gaming venue, Valve's Official <a href="cybercafes.php">Cyber Caf&eacute; Program</a> lets you offer Steam games to your customers.<br><br>

<h3>CONTACT INFORMATION</h3>
If your issue is not addressed in any of the above pages, use these email addresses to get in touch with the Steam team directly. (We'll do our best to answer your questions in a timely manner.)<br>
<br>
<strong>For support inquiries:</strong><br>
<a href="javascript:popup('/troubleshooter/live/index.php','yes',550,550,'')">Steam Troubleshooter</a><br>
<br>
<strong>For business inquiries:</strong><br>
<a href="mailto:biz@steampowered.com">biz@steampowered.com</a><br>
<br>
<strong>For feature suggestions:</strong><br>
<a href="/forums/forumdisplay.php?s=&forumid=15">Suggestions / Ideas forum</a><br>
<br>

</div>
</div>
<?php include 'cms/footer.php'; ?>
