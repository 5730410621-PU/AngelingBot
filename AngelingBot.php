<?php 

include 'Utils.php';
include 'database.php';


$accessToken = 'o7QzwyoiRRAbnd0Ylquyd9BgFSP88lcRdo3Oy9HBBEP1Wq2C5oTKiiLC8LkCo2wNVYSLUvqxsmuY5RBVn3xjyFxm913dEQW6xPI1j6lvABZiV21xlLx8ifPyMrma2VJYu37dzVa/Xyp5oIysTAJ6wwdB04t89/1O/w1cDnyilFU=';

$content = file_get_contents('php://input');
$arrayJson = json_decode($content, true);

$jsonHeader = "Content-Type: application/json";
$imageHeader = "Content-Type: image/jpeg";
$accessHeader = "Authorization: Bearer {$accessToken}";

$arrayHeader = array();
$arrayHeader[] = $jsonHeader;
$arrayHeader[] = $accessHeader;

$imageArrayHeader = array();
$imageArrayHeader[] = $imageHeader;
$imageArrayHeader[] = $accessHeader;

$message = $arrayJson['events'][0]['message']['text'];
$type = $arrayJson['events'][0]['type'];
$typeMessage = $arrayJson['events'][0]['message']['type'];
$id = $arrayJson['events'][0]['source']['userId'];
$replyToken = $arrayJson['events'][0]['replyToken'];

$richMenu = newRichMenu();

if($message == "reply"){
	$arrayPostData['replyToken'] = $replyToken;
	$arrayPostData['messages'][0]['type'] = "text";
	$arrayPostData['messages'][0]['text'] = "This Bot can reply";
	replyMsg($arrayHeader,$arrayPostData);
}

////////////////// Get Rich Menu ////////////////////////

else if($message == "showRichMenu"){

	$RichMenuId = getRichMenu($arrayHeader);
	$arrayPostData['replyToken'] = $replyToken;
	$arrayPostData['messages'][0]['type'] = "text";
	$arrayPostData['messages'][0]['text'] = "RichId :".$RichMenuId;
	ReplyMsg($arrayHeader,$arrayPostData);
}


///////////// Create Rich Menu ////////////////////////

else if($message == "createRichMenu"){
	
	$newRichMenu = null;
	$newRichMenu = json_decode(createRichMenu($arrayHeader,$richMenu),true);

	if($newRichMenu != null){
		$arrayPostData['replyToken'] = $replyToken;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = "Success!! RichMenuId: ".$newRichMenu['richMenuId'];
		ReplyMsg($arrayHeader,$arrayPostData);
	} 
	else{
		$arrayPostData['replyToken'] = $replyToken;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = "Fail to create";
		ReplyMsg($arrayHeader,$arrayPostData);
	}
}

//////////////// Upload Rich Menu Image ///////////////////

else if($message == "uploadImage"){
	
	$richId = getRichMenu($arrayHeader);
	$uploaded = uploadImage($imageArrayHeader,$richId);

	if($uploaded != null){
		$arrayPostData['replyToken'] = $replyToken;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = $uploaded;
		ReplyMsg($arrayHeader,$arrayPostData);
	} 
	else{
		$arrayPostData['replyToken'] = $replyToken;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = "Fail to upload";
		ReplyMsg($arrayHeader,$arrayPostData);
	}
}



/////////////////////Set Rich Menu /////////////////////////////

else if($message == "setRichMenu"){

	$richMenuId = getRichMenu($arrayHeader);
	$setRichMenu = setRichMenu($arrayHeader,$richMenuId);

	$arrayPostData['replyToken'] = $replyToken;
	$arrayPostData['messages'][0]['type'] = "text";
	$arrayPostData['messages'][0]['text'] = "Set Complete ::".$setRichMenu;
	ReplyMsg($arrayHeader,$arrayPostData);
}

/////////////////// Rich Reply Menu ///////////////////////

if($message == "News"){
	$image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
	$arrayPostData['replyToken'] = $replyToken;
	$arrayPostData['messages'][0]['type'] = "image";
	$arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
	$arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
	replyMsg($arrayHeader,$arrayPostData);
}


//////////////////////// Start User Process  /////////////////////////////////

if($type == "postback"){

	$action = substr($arrayJson['events'][0]['postback']['data'],7);
	
	if($action == "Horo"){
		$arrayPostData['replyToken'] = $replyToken;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = "ดวงคุณวันนี้แข็งมาก";
		//print_r (openSession($id,$action));
		replyMsg($arrayHeader,$arrayPostData);
	}
	else if($action == "Poll"){
		$arrayPostData['replyToken'] = $replyToken;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = "Rap Thailand 4.0  กับ ประเทศกูมี";
		//print_r (openSession($id,$action));
		replyMsg($arrayHeader,$arrayPostData);
	}
	else if($action == "Quiz"){
		$arrayPostData['replyToken'] = $replyToken;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = "รู้หรือไม่ ไก่กับไข่อะไรเกิดก่อนกัน";
		//print_r (openSession($id,$action));
		replyMsg($arrayHeader,$arrayPostData);
	}
	else if($action == "News"){
		$arrayPostData['replyToken'] = $replyToken;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = "นายกรัฐมนตรีประกาศลาออกเพื่อมีการจัดเลือกตั้งในวันที่...(คลิ๊ก)";
		//print_r (openSession($id,$action));
		replyMsg($arrayHeader,$arrayPostData);
	}
	else if($action == "Ar/Vr"){
		$arrayPostData['replyToken'] = $replyToken;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = "ทดสอบระบบ Ar และ Vr กันเลย";
		//print_r (openSession($id,$action));
		replyMsg($arrayHeader,$arrayPostData);
	}
	else if($action == "Report"){
		$arrayPostData['replyToken'] = $replyToken;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = openSession($id,$action);
		//print_r (openSession($id,$action));
		replyMsg($arrayHeader,$arrayPostData);
	}


}

else if($type == "message"){

	if($typeMessage == "text" && $message == "###"){
		$arrayPostData['replyToken'] = $replyToken;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = closeSession($id);
		replyMsg($arrayHeader,$arrayPostData);
	}
	
	else if($typeMessage == "text"){
		storeMessageData($id,$type,$message);
	}

	else if($typeMessage == "image" || $typeMessage == "video"){
		$imgVideoId = $arrayJson['events'][0]['message']['id'];
		
		$arrayPostData['replyToken'] = $replyToken;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = storeImageVideoData($id,$accessHeader,$imgVideoId,$typeMessage);
		//$arrayPostData['messages'][0]['text'] = 'test message type';
		replyMsg($arrayHeader,$arrayPostData);
	}
}
//////////////////////// End User Process  /////////////////////////////////