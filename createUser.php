<?php
require __DIR__ . '/vendor/autoload.php';
use ExinOne\MixinSDK\MixinSDK;
$bot_instance = new MixinSDK(require './config.php');

const PIN           = "945689";
const MASTER_ID     = "37222956";//Developer Mixin messenger account ID
const BTC_ASSET_ID  = "c6d0c728-2624-429b-8e0d-d9d19b6592fa";
// const ASSET_ID   = "965e5c6e-434c-3fa9-b780-c50f43cd955c";
const AMOUNT        = "0.001";

//Mixin PHP SDK generate RSA key pair automatically
$tom_cat_info = $bot_instance->Network()->createUser("Tom cat");
//Create User api include all account information
print_r($tom_cat_info);
print($tom_cat_info["pubKey"]);

$newConfig = array();
$newConfig["private_key"] = $tom_cat_info["priKey"];
$newConfig["pin_token"]   = $tom_cat_info["pin_token"];
$newConfig["session_id"]  = $tom_cat_info["session_id"];
$newConfig["client_id"]   = $tom_cat_info["user_id"];
$newConfig["pin"]         = PIN;
//Install the parameter in PHP SDK
$tom_cat = new MixinSDK($newConfig);

//Create a PIN.
$pinInfo = $tom_cat->Pin()->updatePin('',PIN);
print_r($pinInfo);
print_r($trans_info);
//Create Bitcoin deposit address by read Bitcoin asset
$asset_infoNew = $account_instance->Wallet()->readAsset(BTC_ASSET_ID);
print_r("BitCoin wallet address is :".$asset_infoNew["public_key"]);

//Transfer Bitcoin to developer's account, zero fee and confirmed instantly
$trans_info = $bot_instance->Wallet()->transfer(BTC_ASSET_ID,$$tom_cat_info["client_id"],
                                         $bot_instance->getConfig()['default']['pin'],AMOUNT);
print_r($trans_info);

//Read user information by ID
$userInfo = $bot_instance->Network()->readUser(MASTER_ID);
$userInfo["user_id"];

$trans_info2 = $tom_cat->Wallet()->transfer(BTC_ASSET_ID,$userInfo["user_id"],
                                         $account_instance->getConfig()['default']['pin'],AMOUNT);

print_r($trans_info2);
