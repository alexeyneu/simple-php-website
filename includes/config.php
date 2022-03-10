<?php

require 'vendor/autoload.php';
class Trx
{
	protected $request_point;
	protected $host;
	protected $http_api_port;	

	function __construct($host, $http_api_port)
	{
			$this->request_point = "http://$host:$http_api_port/";
	}
	function wallet_getaccount($address_a)
	{
			$curl = curl_init("{$this->request_point}wallet/getaccount");
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER,
			        array("Content-type: application/json"));
			curl_setopt($curl, CURLOPT_POST, true);
			$content = "{\"address\": \"$address_a\",\"visible\": true}";
			curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
			$json_response = curl_exec($curl);
			curl_close($curl);
			$response = json_decode($json_response, true);
			return $response; 
// {"address": "TM1zzNDZD2DPASbKcgdVoTYhfmYgtfwx9R","balance": 2000005001,"create_time": 1586426514000,"account_resource": {},"owner_permission": {"permission_name": "owner","threshold": 1,"keys": [{"address": "TM1zzNDZD2DPASbKcgdVoTYhfmYgtfwx9R","weight": 1}]},"active_permission": [{"type": "Active","id": 2,"permission_name": "active","threshold": 1,"operations": "7fff1fc0033e0b00000000000000000000000000000000000000000000000000","keys": [{"address": "TM1zzNDZD2DPASbKcgdVoTYhfmYgtfwx9R","weight": 1}]}],"assetV2": [{"key": "1000026","value": 44863819274}],"free_asset_net_usageV2": [{"key": "1000026","value": 0}]}
	}
	function wallet_createaddress($pwd_a)
	{
			$curl = curl_init("{$this->request_point}wallet/createaddress");
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER,
			        array("Content-type: application/json"));
			curl_setopt($curl, CURLOPT_POST, true);
			$content = "{\"value\": \"$pwd_a\"}";
			curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
			$json_response = curl_exec($curl);
			curl_close($curl);
			$response = json_decode($json_response, true);
			return $response;
// in : "3230313271756265696a696e67"
// out :  {"base58checkAddress":"TPjMMiLkN8XSLPWkGLr89hqxTE69jPHWmp","value":"4196f2e9afe3fd5820fd555837ab7db7c8290eebc7"}
	}
	function wallet_generateaddress()
	{
			$curl = curl_init("{$this->request_point}wallet/generateaddress");
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER,
			        array("Content-type: application/json"));
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
			$json_response = curl_exec($curl);
			curl_close($curl);
			$response = json_decode($json_response, true);
			return $response;
// {"privateKey":"f41edc046d381382229b690824ab3cf44cf0e4849cfe239f3d60232733686428","address":"TYGcF5axgZL5wqFUQPm1irwymshSZPUYjV","hexAddress":"41f49d3d64df329062a8e55399114cf816fc3df160"}
	}
	function wallet_createtransaction($owner_address_a, $to_address_a, $amount_a)
	{
			$curl = curl_init("{$this->request_point}wallet/createtransaction");
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER,
			        array("Content-type: application/json"));
			curl_setopt($curl, CURLOPT_POST, true);
			$content = "{\"owner_address\": \"$owner_address_a\", \"to_address\": \"$to_address_a\", \"amount\": $amount_a, \"visible\": true}";
			curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
			$json_response = curl_exec($curl);
			curl_close($curl);
			$response = json_decode($json_response, true);
			return $response;
// {"visible":true,"txID":"1902a6f7716c4d6450c4dd2b3ec0aec99caa4a6c92259fe14507776f774b6614","raw_data":{"contract":[{"parameter":{"value":{"amount":1000000,"owner_address":"TRGhNNfnmgLegT4zHNjEqDSADjgmnHvubJ","to_address":"TJCnKsPa7y5okkXvQAidZBzqx3QyQ6sxMW"},"type_url":"type.googleapis.com/protocol.TransferContract"},"type":"TransferContract"}],"ref_block_bytes":"2862","ref_block_hash":"49e92fc962d0b26d","expiration":1645088901000,"timestamp":1645343920402},"raw_data_hex":"0a022862220849e92fc962d0b26d40888fc2b7f02f5a67080112630a2d747970652e676f6f676c65617069732e636f6d2f70726f746f636f6c2e5472616e73666572436f6e747261637412320a1541a7d8a35b260395c14aa456297662092ba3b76fc01215415a523b449890854c8fc460ab602df9f31fe4293f18c0843d7092a28fb1f12f"}
	}
	function wallet_gettransactioninfobyid($tx_hash_a)
	{
			$curl = curl_init("{$this->request_point}wallet/gettransactioninfobyid");
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER,
			        array("Content-type: application/json"));
			curl_setopt($curl, CURLOPT_POST, true);
			$content = "{\"value\": \"$tx_hash_a\"}";
			curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
			$json_response = curl_exec($curl);
			curl_close($curl);
			$response = json_decode($json_response, true);
			return $response;
// in : 309b6fa3d01353e46f57dd8a8f27611f98e392b50d035cef213f2c55225a8bd2
// out : {"id": "f14d9ebec9c4d76619e3c216740fa7fbd70a4ad8862952612ea1c74e8d272204","fee": 345000,"blockNumber": 23168829,"blockTimeStamp": 1642779300000,"contractResult": ["0000000000000000000000000000000000000000000000000000000000000001"],"contract_address": "41ea51342dabbb928ae1e576bd39eff8aaf070a8c6","receipt": {"origin_energy_usage": 28410,"energy_usage_total": 28410,"net_fee": 345000,"result": "SUCCESS"},"log": [{"address": "ea51342dabbb928ae1e576bd39eff8aaf070a8c6","topics": ["ddf252ad1be2c89b69c2b068fc378daa952ba7f163c4a11628f55a4df523b3ef","000000000000000000000000329d54a820a41d2f0f0def0ef092f3b08f547e22","00000000000000000000000063abf300ea4792887340a0c70df2b9a1d7721a52"],"data": "0000000000000000000000000000000000000000000000000000000ba43b7400"}],"packingFee": 345000}
	}
}
use kornrunner\Keccak;
/**
 * Used to store website configuration information.
 *
 * @var string or null
 */
function config($key = '')
{

    $pubKey = 'BurnItAll0000000000000000000000000000000000000000000000000000000';
    $address = '0x' . substr(\kornrunner\Keccak::hash($pubKey, 256),24, 40);
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
    $url = "http://localhost:8090/wallet/gettransactioninfobyid";
	$content = '{"value": "f14d9ebec9c4d76619e3c216740fa7fbd70a4ad8862952612ea1c74e8d272204"}';

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


	$b = new Trx("localhost", "8090");
	$x = $b->wallet_getaccount("TM1zzNDZD2DPASbKcgdVoTYhfmYgtfwx9R");
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
