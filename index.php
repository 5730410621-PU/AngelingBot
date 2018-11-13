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
} else {
    echo "0 result"."<br>";
}

 

$sql = "SELECT * FROM meme_log";
$result =  $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br>"."id: " . $row["id"]." uid: ".$row["u_id"]." gid: ".$row["g_id"]." option: ".$row["options"]." Image_id: ".$row["image_id"];
    }
} else {
    echo "0 result";
}



//echo "Result :: ".scandir('/app');


/*
$sql = "DELETE FROM open_session WHERE status IN ('1')";
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


$accessToken = 'uUE/X13a2XpVT0CAFsl+x3PTTxcFwHvYsrF2Mg8Vt5LAwEI8/v6To55m+cDqoj8iKTYQ9QHndnGYHRuB3ZXwGSwsAmoKcNzS1nWx1vGZ3vPp3KNwi0eWuxSz4AfkuH0fP2wUt5pwgfZsCKZRJp52CgdB04t89/1O/w1cDnyilFU=';
$imgId = "8856260297307";
$header = "Authorization: Bearer {$accessToken}";
/*
$strUrl = "https://api.line.me/v2/bot/message/$imgId/content";
//$ch = "curl -v -X "." GET ".$strUrl." -o ".$imgId.".png "." -H '"."$accessHeader'";
//$ch = "curl -v -X "." GET ".$strUrl." -H '"."$accessHeader'";
//$ch = "curl -v -X "." GET ".$strUrl." -o http://sheltered-refuge-45467.herokuapp.com/meme/userImg/".$imgId.".png "." -H '"."$header'";
//exec($ch,$output,$result);

$ch = "curl -v -X "." GET "."https://api.line.me/v2/bot/message/8851169895483/content"." -o meme/userImg/"."8851169895483".".png "." -H '"."Authorization: Bearer uUE/X13a2XpVT0CAFsl+x3PTTxcFwHvYsrF2Mg8Vt5LAwEI8/v6To55m+cDqoj8iKTYQ9QHndnGYHRuB3ZXwGSwsAmoKcNzS1nWx1vGZ3vPp3KNwi0eWuxSz4AfkuH0fP2wUt5pwgfZsCKZRJp52CgdB04t89/1O/w1cDnyilFU='";
exec($ch,$output,$result);
echo $result;

*/

/*
$overlayImage='./meme/template/test.png'; 
$backgroundImage="./meme/userImg/unusedImage.jpg";

$im = imagecreatefromjpeg($backgroundImage);
$im2 = imagecreatefrompng($overlayImage);

imagecopy($im, $im2, (imagesx($im)/2)-(imagesx($im2)/2), (imagesy($im)/2)-(imagesy($im2)/2), 0, 0, imagesx($im2), imagesy($im2));

imagepng($im,"./meme/updateImage/test1234"."_m.png",9);
imagedestroy($im);
imagedestroy($im2);
*/

/*
$strUrl = "https://api.line.me/v2/bot/message/$imgId/content";

$ch = curl_init();
$options =  array(

    CURLOPT_URL => $strUrl,
    CURLOPT_HTTPHEADER => array($header, 'Content-type: image/png'),
    CURLOPT_ENCODING => "",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPGET => true,
    CURLOPT_CONNECTTIMEOUT => 60,
    CURLOPT_TIMEOUT => 60

);
curl_setopt_array($ch, $options);
$response = curl_exec($ch);
$img = imagecreatefromstring($response);

echo "<br>\n";
imagepng($img,"./user".".png",9);
$bgWidth = imagesx($img);
$bgHeight = imagesy($img);

$im2 = imagecreatefrompng("./meme/template/banner.png");
$overWidth = imagesx($im2);
$overHeight = imagesy($im2);

if($overWidth > $bgWidth){
    $newWidth = $bgWidth;
    $ratio = $newWidth/$overWidth;
    $newHeight = round($overHeight*$ratio);
    $overImage = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($overImage,$im2, 0, 0, 0, 0, $newWidth, $newHeight, $overWidth, $overHeight);
    imagecopy($img,$overImage,($bgWidth-$newWidth)/2,$bgHeight-$newHeight,0,0,$newWidth,$newHeight);
}
else{
    imagecopy($img,$im2,($bgWidth-$overWidth)/2,$bgHeight-$overHeight,0,0,$overWidth,$overHeight);
}
imagepng($img,"./user"."_m.png",9);

*/




/*
$im2 = imagecreatefrompng("./meme/template/test.png");
imagecopy($img, $im2, (imagesx($img)/2)-(imagesx($im2)/2), (imagesy($img)/2)-(imagesy($im2)/2), 0, 0, imagesx($im2), imagesy($im2));
imagepng($img,"./user"."_m.png",9);
imagedestroy($img);
imagedestroy($im2);
*/

$conn->close();