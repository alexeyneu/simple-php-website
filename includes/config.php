<?php

require 'vendor/autoload.php';

use kornrunner\Keccak;
/**
 * Used to store website configuration information.
 *
 * @var string or null
 */
function config($key = '')
{

    $pubKey = 'BurnItAll0000000000000000000000000000000000000000000000000000000';
    $address = '0x' . substr(\kornrunner\Keccak::hash($pubKey, 256),0, 40);
    $pubKey_b ='BurnItAll0000000000000000000000000000000000000000000000000000000b';

    $pubKey_bitcoin_hashed = hash('sha256', $pubKey_b, !false);
    $pubKey_bitcoin_hashed_ripemd160 = hash('ripemd160', $pubKey_bitcoin_hashed, !false);;
    $pubhash_mdprefx = "\0" . substr($pubKey_bitcoin_hashed_ripemd160, 0, 20);
    $hashtag = hash('sha256', $pubhash_mdprefx, !false);
    $hashtag_f = hash('sha256', $hashtag, !false);
    $bitaddr = "\0" . substr($pubKey_bitcoin_hashed_ripemd160, 0, 20) . substr($hashtag_f, 0, 4);

    $base = new Tuupola\Base58([
        "characters" => Tuupola\Base58::BITCOIN
    ]);
    $wall_burn_b = $base->encode($bitaddr);
    $url = "http://localhost:8090/wallet/getaccount";    
	$content = '{"address": "TM1zzNDZD2DPASbKcgdVoTYhfmYgtfwx9R","visible": true}';

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER,
	        array("Content-type: application/json"));
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

	$json_response = curl_exec($curl);

	curl_close($curl);

	$response = json_decode($json_response, true);
    $config = [
        'name' => $address . ' ' . $wall_burn_b . ' ' . $json_response,
        'site_url' => '',
        'pretty_uri' => false,
        'nav_menu' => [
            '' => 'Home',
            'about-us' => 'About Us',
            'products' => 'Products',
            'contact' => 'Contact',
        ],
        'template_path' => 'template',
        'content_path' => 'content',
        'version' => 'v3.1',
    ];

    return isset($config[$key]) ? $config[$key] : null;
}
