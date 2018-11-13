<?php


function arManagement($conn,$id,$state,$message,$header,$gid){
    
    if($state == 0){

        if($message == "1"){
            $sql = "UPDATE open_session SET state = 1 WHERE u_id = '$id' AND status = '1'";
            $conn->query($sql);
            $sql = "INSERT INTO meme_log (u_id,g_id,options,image_id) VALUES ('$id',$gid,'1','0')";
            $conn->query($sql);
            return 'ท่านได้เลือก #ประเทศกูมี เชิญเลือกภาพที่ต้องการร่วมสนุกได้เลย';
        }
        else if($message == "2"){
            $sql = "UPDATE open_session SET state = 1 WHERE u_id = '$id' AND status = '1'";
            $conn->query($sql);
            $sql = "INSERT INTO meme_log (u_id,g_id,options,image_id) VALUES ('$id',$gid,'2','0')";
            $conn->query($sql);
            return 'ท่านได้เลือก #RapThailand4.0 เชิญเลือกภาพที่ต้องการร่วมสนุกได้เลย';
        }
        else if($message == "3"){
            $sql = "UPDATE open_session SET state = 1 WHERE u_id = '$id' AND status = '1'";
            $conn->query($sql);
            $sql = "INSERT INTO meme_log (u_id,g_id,options,image_id) VALUES ('$id',$gid,'3','0')";
            $conn->query($sql);
            return 'ท่านได้เลือก #คำคม 10 ล้อ เชิญเลือกภาพที่ต้องการร่วมสนุกได้เลย';
        }
        else{
            return "อะอ้า คุณพิมพ์เลขผิดกรุณาพิมพ์ใหม่นะครับผม";
        }     
    }
    else if($state == 1){

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
            return "ร่วมสนุกกับทางเราได้ทาง xxxx โดยการแชร์รูปของท่านจากในเพจเพื่อลุ้นรับเสื้อเพจจำนวน 10 รางวัล หมดเขต 31 ธ.ค. นี้";
            //return  memeImage($id,$message,$header,$option);
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
    imagepng($img,"./user.png",9);
    
    $im2 = imagecreatefrompng("./meme/template/test.png");
    imagecopy($img, $im2, (imagesx($img)/2)-(imagesx($im2)/2), (imagesy($img)/2)-(imagesy($im2)/2), 0, 0, imagesx($im2), imagesy($im2));
    imagepng($img,"./user"."_m.png",9);
    imagedestroy($img);
    imagedestroy($im2);
}


