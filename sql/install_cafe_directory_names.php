<?php
/**
 * Installs preprocessed cafe directory country and state names into database
 * Data has been extracted from archived_steampowered HTML files
 * This allows distributing the CMS without the archived_steampowered folder
 */

// Create table if not exists
try {
    $pdo->query('SELECT 1 FROM cafe_directory_names LIMIT 1');
} catch (PDOException $e) {
    if ($e->getCode() === '42S02') {
        $pdo->exec('CREATE TABLE cafe_directory_names (
            id INT AUTO_INCREMENT PRIMARY KEY,
            country_code CHAR(2) NOT NULL,
            state_code VARCHAR(20) DEFAULT NULL,
            name VARCHAR(100) NOT NULL,
            type ENUM("country", "state") NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY unique_location (country_code, state_code, type)
        )');
    }
}

$stmt = $pdo->prepare('INSERT IGNORE INTO cafe_directory_names (country_code, state_code, name, type) VALUES (?, ?, ?, ?)');

// Preprocessed country names from cafe_directory.html (2004)
$countries = [
    'AR' => 'Argentina',
    'AU' => 'Australia',
    'BN' => 'Brunei Darussalam',
    'BO' => 'Bolivia',
    'BR' => 'Brazil',
    'CA' => 'Canada',
    'CO' => 'Colombia',
    'DE' => 'Germany',
    'DK' => 'Denmark',
    'EE' => 'Estonia',
    'ES' => 'Spain',
    'FR' => 'France',
    'GR' => 'Greece',
    'HU' => 'Hungary',
    'IE' => 'Ireland',
    'JP' => 'Japan',
    'KR' => 'Korea, Republic Of',
    'MN' => 'Mongolia',
    'MY' => 'Malaysia',
    'NG' => 'Nigeria',
    'NL' => 'Netherlands',
    'NO' => 'Norway',
    'NZ' => 'New Zealand',
    'PH' => 'Philippines',
    'PT' => 'Portugal',
    'SE' => 'Sweden',
    'SK' => 'Slovakia',
    'UK' => 'United Kingdom',
    'US' => 'United States',
    'ZA' => 'South Africa',
];

foreach ($countries as $code => $name) {
    $stmt->execute([$code, null, $name, 'country']);
}

// Preprocessed state/province names from country-specific files
$states = [
    // United States
    'US' => [
        'AK' => 'Alaska',
        'AL' => 'Alabama',
        'AZ' => 'Arizona',
        'CA' => 'California',
        'CO' => 'Colorado',
        'CT' => 'Connecticut',
        'FL' => 'Florida',
        'GA' => 'Georgia',
        'HI' => 'Hawaii',
        'ID' => 'Idaho',
        'IL' => 'Illinois',
        'IN' => 'Indiana',
        'KS' => 'Kansas',
        'KY' => 'Kentucky',
        'LA' => 'Louisiana',
        'MA' => 'Massachusetts',
        'MD' => 'Maryland',
        'ME' => 'Maine',
        'MI' => 'Michigan',
        'MN' => 'Minnesota',
        'MO' => 'Missouri',
        'MS' => 'Mississippi',
        'MT' => 'Montana',
        'NC' => 'North Carolina',
        'NE' => 'Nebraska',
        'NH' => 'New Hampshire',
        'NJ' => 'New Jersey',
        'NV' => 'Nevada',
        'NY' => 'New York',
        'OR' => 'Oregon',
        'PA' => 'Pennsylvania',
        'SD' => 'South Dakota',
        'TN' => 'Tennessee',
        'TX' => 'Texas',
        'UT' => 'Utah',
        'VA' => 'Virginia',
        'VT' => 'Vermont',
        'WA' => 'Washington',
        'WI' => 'Wisconsin',
        'WY' => 'Wyoming',
    ],
    // Canada
    'CA' => [
        'AB' => 'Alberta',
        'BC' => 'British Columbia',
        'MB' => 'Manitoba',
        'ON' => 'Ontario',
        'QC' => 'Quebec',
        'YT' => 'Yukon',
    ],
    // Malaysia
    'MY' => [
        'Sarawak' => 'Sarawak',
        'Temerloh' => 'Temerloh',
    ],
];

foreach ($states as $countryCode => $stateList) {
    foreach ($stateList as $stateCode => $stateName) {
        $stmt->execute([$countryCode, $stateCode, $stateName, 'state']);
    }
}
