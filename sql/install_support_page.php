<?php

$content2003v2 = <<<HTML
<div class="narrower">

<h3>FREQUENTLY ASKED QUESTIONS</h3>
If you're using Steam and running into trouble, you may find a solution in our list of <a href="index.php?area=faq">Frequently Asked Questions</a>.<br><br>

<h3>MESSAGE BOARD</h3>
For issues not covered in the FAQ, <a href="index.php?area=forums">the online forums</a> on this website are another resource worth investigating.<br><br>
<!--
<a href="index.php?area=faq&section=billing&support=yes" style="text-decoration: none;"><h3>BILLING SUPPORT</h3></a>
For any issues related to credit cards or billing, please visit the Steam Billing Support page.
<br><br>
-->

<h3>SUBSCRIBER AGREEMENT, BILLING, AND ONLINE CONDUCT</h3>
When you install Steam, you agree to be bound by the <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement</a>. The billing policies for Steam can be found here [coming soon]. Also, please refer to the <a href="index.php?area=online_conduct">online conduct rules</a> for Steam and the Steam network.<br><br>

<h3>CYBER CAFÉS</h3>
If you operate a gaming venue, Valve's Official <a href="index.php?area=cybercafes">Cyber Café Program</a> lets you offer Steam games to your customers.<br><br>

<h3>CONTACT INFORMATION</h3>
If your issue is not addressed in any of the above pages, use these email addresses to get in touch with the Steam team directly. (We'll do our best to answer your questions in a timely manner.)<br>
<br>
<strong>For technical inquiries:</strong><br>
<a href="mailto:support@steampowered.com">support@steampowered.com</a><br>
<br>
<strong>For business inquiries:</strong><br>
<a href="mailto:biz@steampowered.com">biz@steampowered.com</a><br>
<br>
<strong>For feature suggestions:</strong><br>
<a href="mailto:ideas@steampowered.com">ideas@steampowered.com</a><br>
<br>

</div>
HTML;

$insertArray[] = [
    1,
    '2003v2',
    $content2003v2,
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
];

$content2004 = <<<HTML
<div class="narrower">

<script>
function popup(src,scroll,x,y,target)
{
	open(src,target,"scrollbars="+scroll+",width="+x+",height="+y+",menubar=0,resizable=yes")
}
</script>


<h3>STEAM TROUBLESHOOTER</h3>
The <a href="javascript:popup('troubleshooter.php','yes',550,550,'')">troubleshooter</a> is the fastest way to get help with Steam-related issues.  It can provide immediate answers to the most common Steam problems, and can also help you contact Steam support when you need help with a more complicated issue.
<br><br>

<!-- <h3>CD KEYS AND STEAM ACCOUNT QUESTIONS</h3>
If you are having problems related to your CD keys or Steam accounts, the <a href="index.php?area=cd_account_faq">CD Keys and Steam Accounts Frequently Asked Questions</a> may provide a solution.  Once you've read through the FAQ, you can submit a request for help if necessary using the <a href="index.php?area=cd_account_form">CD Key & Account Contact Form</a>.<br><br>

<ul>
<li> <a href="index.php?area=cd_account_form">CD Key & Steam Account Form</a>
<li> <a href="index.php?area=cheat_form">Valve Anti-Cheat Contact Form</a>
</ul><br>
-->

<h3>OTHER FREQUENTLY ASKED QUESTIONS</h3>
If you're using Steam and running into trouble, you may find a solution in our more general list of <a href="index.php?area=faq">Frequently Asked Questions</a>.<br><br>

<h3>MESSAGE BOARD</h3>
For issues not covered in the FAQ, <a href="index.php?area=forums">the online forums</a> on this website are another resource worth investigating.<br><br>
<!--
<a href="index.php?area=faq&section=billing&support=yes" style="text-decoration: none;"><h3>BILLING SUPPORT</h3></a>
For any issues related to credit cards or billing, please visit the Steam Billing Support page.
<br><br>
-->

<h3>SUBSCRIBER AGREEMENT, BILLING, AND ONLINE CONDUCT</h3>
When you install Steam, you agree to be bound by the <a href="index.php?area=subscriber_agreement">Steam Subscriber Agreement</a>. The billing policies for Steam can be found here [coming soon]. Also, please refer to the <a href="index.php?area=online_conduct">online conduct rules</a> for Steam and the Steam network.<br><br>

<h3>CYBER CAFÉS</h3>
If you operate a gaming venue, Valve's Official <a href="index.php?area=cybercafes">Cyber Café Program</a> lets you offer Steam games to your customers.<br><br>

<h3>CONTACT INFORMATION</h3>
If your issue is not addressed in any of the above pages, use these email addresses to get in touch with the Steam team directly. (We'll do our best to answer your questions in a timely manner.)<br>
<br>
<strong>For support inquiries:</strong><br>
<a href="javascript:popup('troubleshooter.php','yes',550,550,'')">Steam Troubleshooter</a><br>
<br>
<strong>For business inquiries:</strong><br>
<a href="mailto:biz@steampowered.com">biz@steampowered.com</a><br>
<br>
<strong>For feature suggestions:</strong><br>
<a href="forums/forumdisplay.php?s=&amp;forumid=15">Suggestions / Ideas forum</a><br>
<br>

</div>
HTML;

$insertArray[] = [
    1,
    '2004',
    $content2004,
    date('Y-m-d H:i:s'),       // created
    date('Y-m-d H:i:s')        // updated
];


$supportPages = $insertArray;

$pdo->beginTransaction();

$pageStmt = $pdo->prepare(
    'INSERT INTO support_pages(version, years, content, created, updated) VALUES (?,?,?,?,?)'
);

$faqStmt = $pdo->prepare(
    'INSERT INTO support_page_faqs(support_id, faqid1, faqid2, ord) VALUES (?,?,?,?)'
);

foreach ($supportPages as $sp) {
    // $sp = [version, years, content, created, updated]
    $pageStmt->execute([$sp[0], $sp[1], $sp[2], $sp[3], $sp[4]]);
    $id = $pdo->lastInsertId();

    // Seed FAQs (same set for each page per your example)
    $faqs = [
        [1050915714, '91503900'],
        [1050915726, '98098300'],
        [1050915754, '69234600'],
        [1063758432, '02298800'],
        [1050915738, '02222500'],
    ];
    $ord = 1;
    foreach ($faqs as $f) {
        $faqStmt->execute([$id, $f[0], $f[1], $ord++]);
    }
}

$pdo->commit();
?>