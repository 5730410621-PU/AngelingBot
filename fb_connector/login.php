<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$app_id = "376046416466558";
$app_secret = "805d5c9ac219134179f81ac510566a79";
$graph_version = "v3.2";

$fb = new Facebook\Facebook([
    'app_id' => $app_id, // Replace {app-id} with your app id
    'app_secret' => $app_secret,
    'default_graph_version' => $graph_version,
    ]);
  
  $helper = $fb->getRedirectLoginHelper();
  
  $permissions = ['pages_show_list','publish_pages','manage_pages']; // Optional permissions
  $loginUrl = $helper->getLoginUrl('http://localhost/php_facebook/fb-callback.php',$permissions);
  
  echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';