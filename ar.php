<?php


function arManagement($conn,$id,$state,$message,$header){
    
    if($state == 0){

        //storeUserImage($id,$message,$header);
        $sql = "UPDATE open_session SET state = 1 WHERE u_id = '$id' AND status = '1'";
        $conn->query($sql);
        //return "กรุณาเลือกแท็กที่ต้องการใส่โดยพิมพ์เลขด้านหน้าแท็กครับ\n1 #ประเทศกูมี\n2 #RapThailand4.0\n3 #คุกกี้เสี่ยงทาย\n4 #คุกกี้เสี่ยงคุก";
        return storeUserImage($id,$message,$header);
        
    }
    else if($state == 1){
        if($message == "1"){
            $sql = "UPDATE open_session SET state = 2 WHERE u_id = '$id' AND status = '1'";
            $conn->query($sql);
            return "ท่านได้เลือก #ประเทศกูมี อดใจรอซักครู่นึง";
        }
        else if($message == "2"){
            $sql = "UPDATE open_session SET state = 2 WHERE u_id = '$id' AND status = '1'";
            $conn->query($sql);
            return "ท่านได้เลือก #RapThailand4.0 อดใจรอซักครู่นึง";
        }
        else if($message == "3"){
            $sql = "UPDATE open_session SET state = 2 WHERE u_id = '$id' AND status = '1'";
            $conn->query($sql);
            return "ท่านได้เลือก #คุกกี้เสี่ยงทาย อดใจรอซักครู่นึง";
        }
        else if($message == "4"){
            $sql = "UPDATE open_session SET state = 2 WHERE u_id = '$id' AND status = '1'";
            $conn->query($sql);
            return "ท่านได้เลือก #คุกกี้เสี่ยงคุก อดใจรอซักครู่นึง";
        }
        else{
            return "อะอ้า คุณพิมพ์เลขผิดกรุณาพิมพ์ใหม่นะครับผม";
        }
    }
    else if($state == 2){
        $dateNow = date("Y-m-d H:i:s");
        $sql = "UPDATE open_session SET end_time = '$dateNow' ,status = '0' WHERE u_id = '$id' AND status = '1'";
        
        if($message == "1"){
            $conn->query($sql);
            return "ทำการแชร์เรียบร้อย ขอบคุณที่ใช้บริการครับ";
        }
        else if($message ="2"){
            $conn->query($sql);
            return "ขอบคุณที่ใช้บริการครับ";
        }
        else {
            return "หมายเลขที่ท่านพิมพ์ไม่ถูกต้อง กรุณาพิมพ์ใหม่อีกครั้งครับ";
        }
        
    }
}

function storeUserImage($id,$imgId,$header){

    $strUrl = "https://api.line.me/v2/bot/message/$imgId/content";
    //$ch = "curl -v -X "." GET ".$strUrl." -H '"."$header'";
    //$ch = "curl -v -X "." GET ".$strUrl." -o http://sheltered-refuge-45467.herokuapp.com/meme/userImg/".$imgId.".png "." -H '"."$header'";
    $ch = "curl -v -X "." GET ".$strUrl." -o meme/userImg/".$imgId.".png "." -H '$header'";
    //$ch = "curl -v -X "." GET "."https://api.line.me/v2/bot/message/8851795270041/content"." -o meme/userImg/"."8851795270041".".png "." -H '"."Authorization: Bearer uUE/X13a2XpVT0CAFsl+x3PTTxcFwHvYsrF2Mg8Vt5LAwEI8/v6To55m+cDqoj8iKTYQ9QHndnGYHRuB3ZXwGSwsAmoKcNzS1nWx1vGZ3vPp3KNwi0eWuxSz4AfkuH0fP2wUt5pwgfZsCKZRJp52CgdB04t89/1O/w1cDnyilFU='";
    exec($ch,$output,$code);
    modify($imgId);
    return $imgId;
    
}

function modify($imgId){
    $overlayImage='./meme/template/test.png'; 
    $backgroundImage="./meme/userImg/$imgId.png";
    
    $im = imagecreatefrompng($backgroundImage);
    $im2 = imagecreatefrompng($overlayImage);
    
    imagecopy($im, $im2, (imagesx($im)/2)-(imagesx($im2)/2), (imagesy($im)/2)-(imagesy($im2)/2), 0, 0, imagesx($im2), imagesy($im2));
    
    imagepng($im,"./meme/updateImage/$imgId".".png",9);
    imagedestroy($im);
    imagedestroy($im2);
}
