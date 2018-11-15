<?php

use Facebook\FacebookRequest;

require_once './vendor/autoload.php'; // change path as needed
if(!session_id()) {
    session_start();
}
$app_id = "376046416466558";
$app_secret = "805d5c9ac219134179f81ac510566a79";
$graph_version = "v3.2";
$page_accessToken = "EAAFWAyESkn4BANu7cGwqSSJ5GEiM1RsJen5XgUI9IEg6ERU0RszJUK2kOWCHRolsCy8QZAZC2StLXDLnnwil7Rvnl9AHtOna61iAr31DbN0ZBeZBR5zfr2aZCF77SgGN59VWG3L1U2JUSkISszJfsOSiYqSUwF5KizxlmnTYrgZAPEZBMpZCtzb5";
$page_id = "532532210554118";

$fb = new Facebook\Facebook([
    'app_id' => $app_id, 
    'app_secret' => $app_secret,
    'default_graph_version' => $graph_version,
]);

//////////// ---- Post on Feeds page ---- /////////////////


   // $imgId = $_SESSION['imgId'];
    $imgId = "background";
    echo "<br>".$imgId;
    $imgPath= "https://young-atoll-65673.herokuapp.com/meme/updateImage/$imgId"."_m.png";

    try {
    $response = $fb->post(
      "/$page_id/photos",
      array (
        'url' => $imgPath,
        'published' => 'true'
      ),
      $page_accessToken
    );
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    $graphNode = $response->getGraphNode();
    
/*
$linkData = [
    'message' => 'Test post on wall'
   ];

   try {
    $response = $fb->post('/me/feed', $linkData, $page_accessToken);
   } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: '.$e->getMessage();
    exit;
   } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: '.$e->getMessage();
    exit;
   }
   $graphNode = $response->getGraphNode();
    
  */  
