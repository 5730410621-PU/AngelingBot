<?php

use Facebook\FacebookRequest;
if(!session_id()) {
    session_start();
}
require_once './../vendor/autoload.php'; // change path as needed

$app_id = "1767634593363076";
$app_secret = "ed42bcfb4276db485a3192fdc73838c3";
$graph_version = "v3.2";

$fb = new Facebook\Facebook([
    'app_id' => $app_id, // Replace {app-id} with your app id
    'app_secret' => $app_secret,
    'default_graph_version' => $graph_version,
]);
  
$helper = $fb->getRedirectLoginHelper();

try {
$accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
echo 'Graph returned an error: ' . $e->getMessage();
exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
echo 'Facebook SDK returned an error: ' . $e->getMessage();
exit;
}

if (!isset($accessToken)) {

    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
    }

    // Logged in
    echo '<h3>Access Token</h3>';
    var_dump($accessToken->getValue());


//////// --- Get page Accesstoken and Id --- /////////////////

    $response = $fb->get("/me/accounts",$accessToken);
    $pages = $response->getGraphEdge()->asArray();
    $pageId = $pages[0]["id"];
    $pageAccessToken = $pages[0]["access_token"];
    echo $pageId;
    echo $pageAccessToken;
    //var_dump($pages);

//////////// ---- Post on Feeds page ---- /////////////////

    $imgId = $_SESSION['imgId'];

    try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->post(
      "/$pageId/photos",
      array (
        'url' => "https://young-atoll-65673.herokuapp.com/meme/updateImage/$imgId"."_m.png",
        'published' => 'true'
      ),
      $pageAccessToken
    );
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    $graphNode = $response->getGraphNode();
