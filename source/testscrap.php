<?php

$url =
    "http://aptel.pl/Default.B2B.aspx?target=%2fProduktySzczegoly.aspx%3fid_artykulu%3d61RDgzbJCyoD2U-9NkTJjQ";

$ch = curl_init();
/*
// needed to disable SSL checks for this site
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,0);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,0);

// enable cookie handling (they aren't saved after cURL is closed)
curl_setopt($ch,CURLOPT_COOKIEFILE, '');

// debugging
curl_setopt($ch,CURLOPT_VERBOSE, 1);
curl_setopt($ch,CURLOPT_STDERR, fopen('php://output', 'w'));

// helpful options
curl_setopt($ch,CURLOPT_AUTOREFERER, true);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);

// set first URL
curl_setopt($ch,CURLOPT_URL, $url);

// execute first request to establish cookies & referer    
$data = curl_exec($ch);

// TODO: extract hidden form fields/values from form 
$fields_string = '...';

// now make second request
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

$result = curl_exec($ch);
//var_dump($result);

            $curl = curl_init();


curl_setopt($curl, CURLOPT_USERAGENT,'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/32.0.1700.107 Chrome/32.0.1700.107 Safari/537.36');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $curl, CURLOPT_HEADER, 0);
curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $curl );
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $url
            ));

            $response = curl_exec($curl);


*/

$url = "http://hurtownia.aptel.pl/Default.B2B.aspx";
$ckfile = tempnam("/tmp", "CURLCOOKIE");
$useragent = $_SERVER["HTTP_USER_AGENT"];

$username = "8471627932";
$password = "Wp504909339";

curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_COOKIEFILE => $ckfile,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_USERAGENT => $useragent,
]);

// Getting the login form
$html = curl_exec($ch);
if ($html !== false) {
    $eventValidation = $eventValidation[1];

    $postfields = http_build_query([
        "__VIEWSTATE_KEY" =>
            "VIEWSTATE_lp0zhrzi21bv5rljo54pwbfz_/Default.B2B.aspx_638013836115793093",
        "__EVENTTARGET" => "",
        "__EVENTARGUMENT" => "",
        "__VIEWSTATE" => [
            "ctl00_MiSlidingLoginPanel1_login" => $username,
            "ctl00_MiSlidingLoginPanel1_haslo" => $password,
            "ctl00$MainContent$btZalogujNowyLayout2$Button" => "zaloguj się",
        ],
    ]);
    curl_setopt_array($ch, [
        CURLOPT_REFERER => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postfields,
    ]);
    // Submitting the login form
    $html = curl_exec($ch);
    echo $html;
} else {
    // Error getting the login page
}
curl_close($ch);
