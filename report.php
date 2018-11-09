<?php
function reportManagement($conn,$id,$message,$type,$gid){

    if($message == "###"){
        $dateNow = date("Y-m-d H:i:s");
        $sql = "UPDATE open_session SET end_time = '$dateNow' ,status = '0' WHERE u_id = '$id' AND status = '1'";
        $conn->query($sql);
        return "เราจะดำเนินการจัดการปัญหาของท่านให้เร็วที่สุด ขอบคุณสำหรับการแจ้งปัญหา";
    }else{

        if($type == "text"){
            $sql = "INSERT INTO log (u_id,g_id,type,message) VALUES ('$id','$gid','$type','$message')";
            $conn->query($sql); 
        }
        else if($type == "image"){
            $path = "/storage/video/$imgId.jpg";
            $sql = "INSERT INTO log (u_id,g_id,type,message) VALUES ('$id','$gid','$type','$path')";
            $conn->query($sql);
        }
        else if($type == "video"){
            $path = "/storage/video/$imgId.mp4";
            $sql = "INSERT INTO log (u_id,g_id,type,message) VALUES ('$id','$gid','$type','$path')";
            $conn->query($sql);
        }

    }
}