<?php
include 'database.php';

// Create connection
$conn = sql();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
/*
$sql = "CREATE TABLE `log` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `u_id` VARCHAR(45) NOT NULL,
    `g_id` VARCHAR(45) NOT NULL,
    `type` VARCHAR(45) NOT NULL,
    `message` VARCHAR(45) NOT NULL,
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


$sql = "SELECT * FROM open_session";
$result =  $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]." status:".$row["status"]." start_time:".$row["start_time"]." end_time:".$row["end_time"]. "<br>";
    }
} else {
    echo "0 results\n\n";
}


$sql = "SELECT * FROM log";
$result =  $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]." uid: ".$row["u_id"]." gid: ".$row["g_id"]." type: ".$row["type"]." message: ".$row["message"]. "<br>";
    }
} else {
    echo "0 results";
}


//echo "Result :: ".scandir('/app');



/*
$sql = "DELETE FROM open_session WHERE action IN ('Report')";
if ($conn->query($sql) === TRUE) {
    $result =  "Delete complete!!";
} else {
    $result = "Error: ".$conn->error;
}
echo $result;



$sql = "DELETE FROM log WHERE type IN ('message')";
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
$accessToken = 'o7QzwyoiRRAbnd0Ylquyd9BgFSP88lcRdo3Oy9HBBEP1Wq2C5oTKiiLC8LkCo2wNVYSLUvqxsmuY5RBVn3xjyFxm913dEQW6xPI1j6lvABZiV21xlLx8ifPyMrma2VJYu37dzVa/Xyp5oIysTAJ6wwdB04t89/1O/w1cDnyilFU=';
$imgId = "8813850836867";
$jsonHeader = "Content-Type: application/json";
$accessHeader = "Authorization: Bearer {$accessToken}";

$strUrl = "https://api.line.me/v2/bot/message/$imgId/content";
//$ch = "curl -v -X "." GET ".$strUrl." -o ".$imgId.".png "." -H '"."$accessHeader'";
$ch = "curl -v -X "." GET ".$strUrl." -H '"."$accessHeader'";
exec($ch,$output,$result);
echo "<pre>"; 
 print_r($output); 
echo "/<pre>"; 
*/



$conn->close();