<?php





function posttoFacebook($imgId){

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
    //$loginUrl = $helper->getLoginUrl('http://localhost/AngelingBot/fb_connector/postImage.php',$permissions);
    $loginUrl = $helper->getLoginUrl('https://young-atoll-65673.herokuapp.com/fb_connector/postImage.php/',$permissions);
    //echo  htmlspecialchars($loginUrl);
    $_SESSION['imgId'] = $imgId;
    header("Location:".$loginUrl);
}

function is_url_exist($url){
    $ch = curl_init($url);    
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($code == 200){
       $status = true;
    }else{
      $status = false;
    }
    curl_close($ch);
   return $status;
}