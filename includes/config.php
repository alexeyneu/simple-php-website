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

    $config = [
        'name' => $address,
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
