<?php

include 'config.php' ;
include 'ar.php';
include 'report.php';

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

function routing($id,$message,$type,$header){
    $conn = sql();
    $sql = "SELECT * FROM open_session WHERE u_id = '$id' AND status = '1' ";
    $linkId = $conn->query($sql);
    $row = $linkId->fetch_assoc();
    $gid =$row["id"];
    $action = $row["action"];
    $state = $row["state"];
    $conn->close();
    
    if($action == "Meme"){  
        return arManagement($id,$state,$message,$header,$gid,$type);
    }
    else if($action == 'Report'){ 
        return reportManagement($id,$message,$type,$gid);
    }  
    else{
        return "กรุณากดเมนูข้างล่างก่อนครับ";
    }
    
}