<?php

function reportManagement($id,$message,$type){
    $conn = sql();

    if($message == "###"){
        $dateNow = date("Y-m-d H:i:s");
        $sql = "UPDATE open_session SET end_time = '$dateNow' ,status = '0' WHERE u_id = '$id' AND status = '1'";
        $conn->query($sql);
        return "เราจะดำเนินการจัดการปัญหาของท่านให้เร็วที่สุด ขอบคุณสำหรับการแจ้งปัญหา";
    }else{

        if($type == "text"){
            return "text type ได้รับการบรรจุ";
        }
        else if($type == "image"){
            return "image type ได้รับการบรรจุ";
        }
        else if($type == "video"){
            return "video type ได้รับการบรรจุ";
        }

    }
}