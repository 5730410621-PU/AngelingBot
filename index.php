<?php
include 'database.php';


// Create connection
$conn = sql();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
/*
$sql = "CREATE TABLE `meme_log` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `u_id` VARCHAR(45) NOT NULL,
    `g_id` VARCHAR(45) NOT NULL,
    `options` VARCHAR(45) NOT NULL,
    `image_id` VARCHAR(45) NOT NULL,
    `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (`id`),
    UNIQUE INDEX `id_UNIQUE` (`id` ASC) );";

if ($conn->query($sql) === TRUE) {
    echo "Create complete!!";
} else {
    echo "Error: ".$conn->error;
}
*/

$id = 'U838a39141a56615db66e65c954e5a036';
$type = 'message';
$message = 'Hello World';
$action = 'Report';
$status = '1';
$gid = '12345';
//$sql = "INSERT INTO open_session (u_id,action,status) VALUES ('$id','$action','$status')";

/*
$sql = "INSERT INTO open_session (u_id,action,status) VALUES ('$id','$action','$status')";

if ($conn->query($sql) === TRUE) {
    $result =  "open Session complete!!";
} else {
    $result = "Error: ".$conn->error;
}
echo "result ::".$result;
*/

/*
$sql = "INSERT INTO meme_log (u_id,g_id,options,image_id) VALUES ('$id',$gid,'1','0')";
if ($conn->query($sql) === TRUE) {
    $result =  "insert complete!!";
} else {
    $result = "Error: ".$conn->error;
}
echo $result;
*/


$count = 0;
$sql = "SELECT * FROM open_session";
$result =  $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]."uid: " . $row["u_id"]." status:".$row["status"]." start_time:".$row["start_time"]." end_time:".$row["end_time"]." action: ".$row["action"]." state: ".$row["state"]. "<br>";
        $count = $count + 1;
    }
    echo "$count results\n\n";
} 
else {
    echo "0 result"."<br>";
}

 

$sql = "SELECT * FROM meme_log";
$result =  $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br>"."id: " . $row["id"]." uid: ".$row["u_id"]." gid: ".$row["g_id"]." option: ".$row["options"]." Image_id: ".$row["image_id"]." src: ".$row["src_path"]." des: ".$row["des_path"];
    }
} else {
    echo "0 result";
}

/*
$sql = "DELETE FROM open_session WHERE status IN ('0')";
if ($conn->query($sql) === TRUE) {
    $result =  "Delete complete!!";
} else {
    $result = "Error: ".$conn->error;
}
echo $result;


$sql = "DELETE FROM meme_log WHERE options IN ('1')";
if ($conn->query($sql) === TRUE) {
    $result =  "Delete complete!!";
} else {
    $result = "Error: ".$conn->error;
}
echo $result;
*/

/*
$sql = "SELECT * FROM open_session WHERE u_id = '$id' AND status = '1' ";
$linkId = $conn->query($sql);
$row = $linkId->fetch_assoc();
$gid =$row["id"];

if($linkId->num_rows > 0){
    
    // $sql = "INSERT INTO log (u_id,g_id,type,message) VALUES ('$id','$gid','$type','$message')";
    // if ($conn->query($sql) === TRUE) {
    //     $result =  "Insert to log complete!!";
    // } else {
    //     $result = "Error: ".$conn->error;
    // }
}else{
    $result ="Can not insert this time";
}
*/


/*
$sql ="ALTER TABLE meme_log ADD COLUMN des_path VARCHAR(45)";
if ($conn->query($sql) === TRUE) {
    $result =  "insert complete!!";
} else {
    $result = "Error: ".$conn->error;
}
echo $result;
*/


$accessToken = 'uUE/X13a2XpVT0CAFsl+x3PTTxcFwHvYsrF2Mg8Vt5LAwEI8/v6To55m+cDqoj8iKTYQ9QHndnGYHRuB3ZXwGSwsAmoKcNzS1nWx1vGZ3vPp3KNwi0eWuxSz4AfkuH0fP2wUt5pwgfZsCKZRJp52CgdB04t89/1O/w1cDnyilFU=';
$imgId = "8856260297307";
$header = "Authorization: Bearer {$accessToken}";


//posttoFacebook($imgId);

/*
$accessToken = 'uUE/X13a2XpVT0CAFsl+x3PTTxcFwHvYsrF2Mg8Vt5LAwEI8/v6To55m+cDqoj8iKTYQ9QHndnGYHRuB3ZXwGSwsAmoKcNzS1nWx1vGZ3vPp3KNwi0eWuxSz4AfkuH0fP2wUt5pwgfZsCKZRJp52CgdB04t89/1O/w1cDnyilFU=';
$imgId = "8856260297307";
$header = "Authorization: Bearer {$accessToken}";
$gid = "100000000";
$type = "image";
$option = "2";
$state = "1";
//memeImage($id,$imgId,$header,$option);

echo arManagement($id,$state,$imgId,$header,$gid,$type);
*/


$conn->close();