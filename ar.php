<?php


function arManagement($conn,$id,$state,$message){
    
    if($state == 0){

        storeUserImage($id,$message,$header);
        $sql = "UPDATE open_session SET state = 1 WHERE u_id = '$id' AND status = '1'";
        $conn->query($sql);
        return "กรุณาเลือกแท็กที่ต้องการใส่โดยพิมพ์เลขด้านหน้าแท็กครับ\n1 #ประเทศกูมี\n2 #RapThailand4.0\n3 #คุกกี้เสี่ยงทาย\n4 #คุกกี้เสี่ยงคุก";
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
    $ch = "curl -v -X "." GET ".$strUrl." -H '"."$header'";
    exec($ch,$output,$code);
    $path = "/meme/userImg/$imgId.png";
    file_put_contents($path,base64_decode($output));

}