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

        //storeUserImage($id,$message,$header);
        
        $conn->query($sql);
        return "";
        
    }
    else if($state == 1){
        $dateNow = date("Y-m-d H:i:s");
        $sql = "UPDATE open_session SET end_time = '$dateNow' ,status = '0' WHERE u_id = '$id' AND status = '1'";
        $conn->query($sql);
        return "ขอบคุณที่ร่วมสนุก";
    }     
}

function storeUserImage($id,$imgId,$header){

    $strUrl = "https://api.line.me/v2/bot/message/$imgId/content";
    $ch = "curl -v -X "." GET ".$strUrl." -H '"."$header'";
    //$ch = "curl -v -X "." GET ".$strUrl." -o http://sheltered-refuge-45467.herokuapp.com/meme/userImg/".$imgId.".png "." -H '"."$header'";
    //$ch = "curl -v -X "." GET ".$strUrl." -o meme/userImg/".$imgId.".png "." -H '$header'";
    //$ch = "curl -v -X "." GET "."https://api.line.me/v2/bot/message/8851795270041/content"." -o meme/userImg/"."8851795270041".".png "." -H '"."Authorization: Bearer uUE/X13a2XpVT0CAFsl+x3PTTxcFwHvYsrF2Mg8Vt5LAwEI8/v6To55m+cDqoj8iKTYQ9QHndnGYHRuB3ZXwGSwsAmoKcNzS1nWx1vGZ3vPp3KNwi0eWuxSz4AfkuH0fP2wUt5pwgfZsCKZRJp52CgdB04t89/1O/w1cDnyilFU='";
    exec($ch,$output,$code);
    
    return $code;
    
}

/*
function modify($imgId){
    if($output != null){

        $overlayImage="http://sheltered-refuge-45467.herokuapp.com/meme/userImg/8$imgId.png"; 
        $backgroundImage="./meme/userImg/$imgId.png";
        
        $im = imagecreatefrompng($backgroundImage);
        $im2 = imagecreatefrompng($overlayImage);
        
        imagecopy($im, $im2, (imagesx($im)/2)-(imagesx($im2)/2), (imagesy($im)/2)-(imagesy($im2)/2), 0, 0, imagesx($im2), imagesy($im2));
        imagepng($im,"./meme/updateImage/$imgId".".png",9);
        imagedestroy($im);
        imagedestroy($im2);
    }
 
}
*/
