<?php
require_once __DIR__ . '/cms/db.php';
require_once __DIR__ . '/cms/template_engine.php';

$page_title = 'Cyber Café Sign-up';
$theme      = cms_get_setting('theme', '2004');
$db         = cms_get_db();
$errors     = [];

function field(string $n): string
{
    return trim($_POST[$n] ?? '');
}

$page_html = cms_get_cafe_signup_page($theme);
$tpl       = cms_theme_layout('default.twig', $theme);

if ($theme === '2004' && $page_html) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['form_company_name'])) {
            $_POST['company']   = $_POST['form_company_name'] ?? '';
            $_POST['firstname'] = $_POST['form_company_contact_first'] ?? ($_POST['form_company_contact'] ?? '');
            $_POST['lastname']  = $_POST['form_company_contact_last'] ?? '';
            $_POST['address1']  = $_POST['form_company_add1'] ?? '';
            $_POST['address2']  = $_POST['form_company_add2'] ?? '';
            $_POST['city']      = $_POST['form_company_city'] ?? '';
            $_POST['state']     = $_POST['form_company_state'] ?? '';
            $_POST['country']   = $_POST['form_company_country'] ?? '';
            $_POST['zip']       = $_POST['form_company_zip'] ?? '';
            $_POST['locations'] = $_POST['form_cafe_locations'] ?? '';
            $_POST['seats']     = $_POST['form_cafe_stations'] ?? '';
            $_POST['email']     = $_POST['form_admin_email'] ?? '';
            $_POST['phone']     = $_POST['form_admin_phone'] ?? '';
            $_POST['fax']       = $_POST['form_admin_fax'] ?? '';
        }
        $data = [
            'company'       => field('company'),
            'address1'      => field('address1'),
            'address2'      => field('address2'),
            'city'          => field('city'),
            'state'         => field('state'),
            'zip'           => field('zip'),
            'country'       => field('country'),
            'firstname'     => field('firstname'),
            'lastname'      => field('lastname'),
            'email'         => field('email'),
            'phone'         => field('phone'),
            'fax'           => field('fax'),
            'locations'     => field('locations'),
            'seats'         => field('seats'),
            'prepaid_hours' => field('prepaid_hours'),
            'ship_name'     => field('ship_name'),
            'ship_address1' => field('ship_address1'),
            'ship_address2' => field('ship_address2'),
            'ship_city'     => field('ship_city'),
            'ship_state'    => field('ship_state'),
            'ship_zip'      => field('ship_zip'),
            'ship_country'  => field('ship_country'),
            'directory'     => field('directory'),
            'contact_email' => field('contact_email'),
            'ship_phone'    => field('ship_phone'),
            'wire_transfer' => field('wire_transfer') ? 'yes' : 'no',
        ];
        $cols  = implode(',', array_keys($data));
        $place = rtrim(str_repeat('?,', count($data)), ',');
        $stmt  = $db->prepare("INSERT INTO ccafe_registration(created,$cols) VALUES (NOW(),$place)");
        $stmt->execute(array_values($data));
        cms_render_template($tpl, [
            'page_title' => $page_title,
            'content'    => '<p>Thank you for registering!</p>',
            'show_title' => false,
        ]);
        return;
    }
    cms_render_template($tpl, [
        'page_title' => $page_title,
        'content'    => $page_html,
        'show_title' => false,
    ]);
    return;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'company'       => field('company'),
        'address1'      => field('address1'),
        'address2'      => field('address2'),
        'city'          => field('city'),
        'state'         => field('state'),
        'zip'           => field('zip'),
        'country'       => field('country'),
        'firstname'     => field('firstname'),
        'lastname'      => field('lastname'),
        'email'         => field('email'),
        'phone'         => field('phone'),
        'fax'           => field('fax'),
        'locations'     => field('locations'),
        'seats'         => field('seats'),
        'prepaid_hours' => field('prepaid_hours'),
        'ship_name'     => field('ship_name'),
        'ship_address1' => field('ship_address1'),
        'ship_address2' => field('ship_address2'),
        'ship_city'     => field('ship_city'),
        'ship_state'    => field('ship_state'),
        'ship_zip'      => field('ship_zip'),
        'ship_country'  => field('ship_country'),
        'directory'     => field('directory'),
        'contact_email' => field('contact_email'),
        'ship_phone'    => field('ship_phone'),
        'wire_transfer' => field('wire_transfer') ? 'yes' : 'no',
    ];
    if (!preg_match('/^[0-9\-]+$/', $data['phone'])) {
        $errors[] = 'Phone must be numeric';
    }
    if ($data['fax'] && !preg_match('/^[0-9\-]+$/', $data['fax'])) {
        $errors[] = 'Fax must be numeric';
    }
    if (!preg_match('/^[0-9]+$/', $data['zip'])) {
        $errors[] = 'Invalid zip code';
    }
    if ($data['ship_zip'] && !preg_match('/^[0-9]+$/', $data['ship_zip'])) {
        $errors[] = 'Invalid shipping zip';
    }
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email';
    }
    if ($data['contact_email'] && !filter_var($data['contact_email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid contact email';
    }
    if (!$errors) {
        $cols  = implode(',', array_keys($data));
        $place = rtrim(str_repeat('?,', count($data)), ',');
        $stmt  = $db->prepare("INSERT INTO ccafe_registration(created,$cols) VALUES (NOW(),$place)");
        $stmt->execute(array_values($data));
        $success = true;
    }
}
$content = '<h1>NEW CUSTOMER / CYBER CAF&Eacute; PROGRAM SIGN-UP</h1>'
    . '<h2>GIVE <em>YOUR CUSTOMERS THE GAMES THEY WANT!</em></h2><img src="img/Graphic_Box.jpg" height="6" width="24" alt=""><br><br>'
    . '<div class="narrower">'
    . '<font color="#C4CABE">If you would like to offer Counter-Strike, Half-Life and other Valve games to your customers, please complete the form below.</font>'
    . '<p>&nbsp;</p>';
if (!empty($errors)) {
    $content .= '<ul style="color:red;">';
    foreach ($errors as $e) {
        $content .= '<li>' . htmlspecialchars($e) . '</li>';
    }
    $content .= '</ul>';
}
if (isset($success)) {
    $content .= '<p>Thank you for registering!</p>';
} else {
    $content .= '<form method="post"><table cellspacing="6" width="100%" style="background:#3e4637;">'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Company Name</font></td><td><input name="company" class="inputreq"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Street Address</font></td><td><input name="address1" class="inputreq"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Street Address 2</font></td><td><input name="address2"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">City</font></td><td><input name="city" class="inputreq"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">State</font></td><td><input name="state" class="inputreq"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Zip</font></td><td><input name="zip" class="inputreq"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Country</font></td><td><input name="country" class="inputreq"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Contact First Name</font></td><td><input name="firstname" class="inputreq"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Contact Last Name</font></td><td><input name="lastname" class="inputreq"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Phone</font></td><td><input name="phone" class="inputreq"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Fax</font></td><td><input name="fax"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Email</font></td><td><input name="email" class="inputreq"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Number of Locations</font></td><td><input name="locations"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Seat Subscriptions</font></td><td><input name="seats"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Pre-paid Hours</font></td><td><select name="prepaid_hours"><option value="">--</option><option>100 hours</option><option>500 hours</option><option>1000 hours</option><option>3000 hours</option></select></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Shipping Name</font></td><td><input name="ship_name" class="inputreq"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Shipping Address</font></td><td><input name="ship_address1" class="inputreq"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Shipping Address 2</font></td><td><input name="ship_address2"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Shipping City</font></td><td><input name="ship_city" class="inputreq"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Shipping State</font></td><td><input name="ship_state"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Shipping Zip</font></td><td><input name="ship_zip"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Shipping Country</font></td><td><input name="ship_country" class="inputreq"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">List in Valve Directory</font></td><td><input type="checkbox" name="directory" value="yes"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Contact Email</font></td><td><input name="contact_email"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Contact Phone</font></td><td><input name="ship_phone"></td></tr>'
        . '<tr><td align="right"><font size="2" color="#C4CABE">Pay via Wire Transfer</font></td><td><input type="checkbox" name="wire_transfer" value="1"></td></tr>'
        . '<tr><td></td><td><input type="submit" value="Submit"></td></tr>'
        . '</table></form>';
}
$content .= '</div>';

cms_render_template($tpl, [
    'page_title' => $page_title,
    'content'    => $content,
    'show_title' => false,
]);
