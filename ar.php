<?php


function arManagement($conn,$id,$state,$message){
    
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