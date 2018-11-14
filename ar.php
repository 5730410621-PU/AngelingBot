<?php

require_once './vendor/autoload.php'; // change path as needed
if(!session_id()) {
    session_start();
}
function arManagement($id,$state,$message,$header,$gid,$type){
    $conn = sql();

    if($state == 0){
        if($message == "1"){
            $sql = "UPDATE open_session SET state = 1 WHERE u_id = '$id' AND status = '1'";
            $conn->query($sql);
            $sql = "INSERT INTO meme_log (u_id,g_id,options,image_id) VALUES ('$id',$gid,'1','0')";
            $conn->query($sql);
            $conn->close();
            return 'ท่านได้เลือก #ประเทศกูมี เชิญเลือกภาพที่ต้องการร่วมสนุกได้เลย';
        }
        else if($message == "2"){
            $sql = "UPDATE open_session SET state = 1 WHERE u_id = '$id' AND status = '1'";
            $conn->query($sql);
            $sql = "INSERT INTO meme_log (u_id,g_id,options,image_id) VALUES ('$id',$gid,'2','0')";
            $conn->query($sql);
            $conn->close();
            return 'ท่านได้เลือก #ลุงป้อม4.0 เชิญเลือกภาพที่ต้องการร่วมสนุกได้เลย';
        }
        else if($message == "3"){
            $sql = "UPDATE open_session SET state = 1 WHERE u_id = '$id' AND status = '1'";
            $conn->query($sql);
            $sql = "INSERT INTO meme_log (u_id,g_id,options,image_id) VALUES ('$id',$gid,'3','0')";
            $conn->query($sql);
            $conn->close();
            return 'ท่านได้เลือก #พรรคเพื่อเธอ เชิญเลือกภาพที่ต้องการร่วมสนุกได้เลย';
        }
        else{
            $conn->close();
            return "อะอ้า คุณพิมพ์เลขผิดกรุณาพิมพ์ใหม่นะครับผม";
        }     
    }
    else if($state == 1){

        if($type == "image"){
            $sql = "SELECT * FROM meme_log WHERE image_id='0' ORDER BY time DESC limit 1";
            $imgId0 = $conn->query($sql);
            $row = $imgId0->fetch_assoc();
            $option =$row["options"];

            if($option != null){
                $sql = "UPDATE meme_log SET image_id = '$message' WHERE u_id = '$id' AND image_id = '0'";
                $conn->query($sql);
                memeImage($id,$message,$header,$option);
                $dateNow = date("Y-m-d H:i:s");
                $sql = "UPDATE open_session SET end_time = '$dateNow' ,status = '0' WHERE u_id = '$id' AND status = '1'";
                $conn->query($sql);
                $conn->close();

                $imgPath= " ./meme/updateImage/$message"."_m.png"; 

                $check = "";
                while (!file_exists($imgPath)) { 
                    $check =$check."x";
                    sleep(1);
                }
                //posttoFacebook($message);
                return $check;
                //return "ทำการใส่แท็กให้ท่านเรียบร้อย ร่วมสนุกกับทางเราได้ทาง xxxx โดยการแชร์รูปของท่านจากในเพจเพื่อลุ้นรับเสื้อเพจจำนวน 10 รางวัล หมดเขต 31 ธ.ค. นี้";
                //return  memeImage($id,$message,$header,$option);
            }
        }
        else{
            $conn->close();
            return "กรุณาใส่รูปภาพครับ";
        }
  
    }     
}


function memeImage($id,$imgId,$header,$option){

    $strUrl = "https://api.line.me/v2/bot/message/$imgId/content";
    $ch = "curl -v -X "." GET ".$strUrl." -H '"."$header'";
    //$ch = "curl -v -X "." GET ".$strUrl." -o http://sheltered-refuge-45467.herokuapp.com/meme/userImg/".$imgId.".png "." -H '"."$header'";
    //$ch = "curl -v -X "." GET ".$strUrl." -o meme/userImg/".$imgId.".png "." -H '$header'";
    $ch = curl_init();
    $c_options =  array(
        CURLOPT_URL => $strUrl,
        CURLOPT_HTTPHEADER => array($header, 'Content-type: image/png'),
        CURLOPT_ENCODING => "",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPGET => true,
        CURLOPT_CONNECTTIMEOUT => 60,
        CURLOPT_TIMEOUT => 60
    );
    curl_setopt_array($ch, $c_options);
    $response = curl_exec($ch);
    $img = imagecreatefromstring($response);

    $src_path = "./meme/userImg/$imgId.png";
    imagepng($img,$src_path,9);
    $bgWidth = imagesx($img);
    $bgHeight = imagesy($img);
    
    if($option == '1'){
        $tem_path = "./meme/template/line1.png";
    }else if($option == '2'){
        $tem_path = "./meme/template/line2.png";
    }else if($option == '3'){
        $tem_path = "./meme/template/line3.png";      
    }

    $im2 = imagecreatefrompng($tem_path);
    $overWidth = imagesx($im2);
    $overHeight = imagesy($im2);

    $newWidth = $bgWidth;
    $ratio = $newWidth/$overWidth;
    $newHeight = round($overHeight*$ratio);
    $overImage = imagecreatetruecolor($newWidth, $newHeight);
    imagealphablending( $overImage, false );
    imagesavealpha( $overImage, true );
    imagecopyresampled($overImage,$im2, 0, 0, 0, 0, $newWidth, $newHeight, $overWidth, $overHeight);
    imagecopy($img,$overImage,$bgWidth-$newWidth,$bgHeight-$newHeight,0,0,$newWidth,$newHeight);

    $des_path = "./meme/updateImage/$imgId"."_m.png";
    imagepng($img,$des_path,9);
    imagedestroy($img);
    imagedestroy($im2);
    imagedestroy($overImage);

    $conn = sql();
    $sql = "UPDATE meme_log SET src_path = '$src_path',des_path = '$des_path' WHERE u_id = '$id' AND $src_path = ''";
    $conn->query($sql);
    $conn->close();
}

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
   // echo  htmlspecialchars($loginUrl);
    $_SESSION['imgId'] = $imgId;
    header("Location:".$loginUrl);
}
