<?php

include 'config.php' ;

function openSession($id,$action){
    $conn = sql();
    
    $sql = "SELECT * FROM open_session WHERE u_id = '$id' AND status = '1' ";
    $isOpened = $conn->query($sql);
    if($isOpened ->num_rows == 0){ 
        $status = '1';
        $state = 0;
        $sql = "INSERT INTO open_session (u_id,action,status,state) VALUES ('$id','$action','$status','$state')";
        if ($conn->query($sql) === TRUE) {
            $result =  "";
        } else {
            $result = "Error: ".$conn->error;
        }
    }
    $conn->close();
    return $result;
}

function routing($id,$message,$type){
    $conn = sql();
    $sql = "SELECT * FROM open_session WHERE u_id = '$id' AND status = '1' ";
    $linkId = $conn->query($sql);
    $row = $linkId->fetch_assoc();
    $gid =$row["id"];
    $action = $row["action"];
    $state = $row["state"];
    
    if($action == "Ar/Vr"){
        return arManagement($id,$state,$message);
    }
    /*
    else if($action != NULL){
        return "คุณอยู่ในสถานะ:"." $action"." ตำแหน่งปัจจุบันของคุณคือ :"." $state";
    }
    */
    else
    return "กรุณากดเมนูข้างล่างก่อนครับ";
}

function arManagement($id,$state,$message){
    $conn = sql();
    if($state == 0){
        $sql = "UPDATE open_session SET state = 1 WHERE u_id = '$id' AND status = '1'";
        $conn->query($sql);
        return "กรุณาเพิ่ม tag ที่ต้องการได้เลย\n1. #ประเทศกูมี\n2. #RapThailand4.0\n3. #คุกกี้เสี่ยงทาย\n4. #คุกกี้เสี่ยงคุก";
    }
    else if($state == 1){
        $sql = "UPDATE open_session SET state = 2 WHERE u_id = '$id' AND status = '1'";
        $conn->query($sql);
        return "อดใจรอ ระบบกำลังประมวลผล...";
    }
    else if($state == 2){
        $dateNow = date("Y-m-d H:i:s");
        $sql = "UPDATE open_session SET end_time = '$dateNow' ,status = '0' WHERE u_id = '$id' AND status = '1'";
        $conn->query($sql);
        return "ทำการแชร์เรียบร้อย";
    }

}

function closeSession($id){
    $conn = sql();
    $sql = "SELECT * FROM open_session WHERE u_id = '$id' AND status = '1' ";
    $isOpened = $conn->query($sql);
    if($isOpened ->num_rows != 0){
        $dateNow = date("Y-m-d H:i:s");
        $sql = "UPDATE open_session SET end_time = '$dateNow' ,status = '0' WHERE u_id = '$id' AND status = '1'";
        $conn->query($sql);
    }
    $conn->close();
}
/*
function routingImgVideo($id,$accessHeader,$imgVideoId,$typeMessage){
    $conn = sql();
    $sql = "SELECT * FROM open_session WHERE u_id = '$id' AND status = '1' ";
    $linkId = $conn->query($sql);
    $row = $linkId->fetch_assoc();
    $gid =$row["id"];
    $action = $row["action"];

    if($action == "Report"){
        storeImageVideoData($id,$accessHeader,$imgVideoId,$typeMessage);
    }
    else if ($action == "Ar/Vr"){
        return "Thank";
    }
}



function storeMessageData($id,$type,$message){
    $conn = sql();
    $sql = "SELECT * FROM open_session WHERE u_id = '$id' AND status = '1' ";
    $linkId = $conn->query($sql);
    $row = $linkId->fetch_assoc();
    $gid =$row["id"];
    
    if($gid != null){      
        $sql = "INSERT INTO log (u_id,g_id,type,message) VALUES ('$id','$gid','$type','$message')";
        $conn->query($sql);
    }
}

function storeImageVideoData($id,$header,$imgId,$typeMessage){
     
    $conn = sql();
    $sql = "SELECT * FROM open_session WHERE u_id = '$id' AND status = '1' ";
    $linkId = $conn->query($sql);
    $row = $linkId->fetch_assoc();
    $gid =$row["id"];

    if($gid != null){

        
        //$strUrl = "https://api.line.me/v2/bot/message/$imgId/content";
        //$ch = "curl -v -X "." GET ".$strUrl." -H '"."$header'"; //get Binary File
        //$ch = "curl -v -X "." GET ".$strUrl." -o ".$imgId.".png "." -H '"."$accessHeader'"; //png File
        //exec($ch,$output,$errorCode);
        
        if($typeMessage == "video"){
            $path = "/storage/video/$imgId.mp4";
        }
        else{
            $path = "/storage/video/$imgId.png";
        }
        $sql = "INSERT INTO log (u_id,g_id,type,message) VALUES ('$id','$gid','$typeMessage','$path')";
        $conn->query($sql);
    }
    
}

*/