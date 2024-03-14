<?php

$dbhost='gpt-mysql:3306';
$dbuser='gpt';
$dbpass='Elj845KMAE5KwnR6MTH3';
$dbname='gpt';

$con=mysqli_connect($dbhost,$dbuser,$dbpass, $dbname) or die(mysql_error());

$tgbotKey = '6847960586:AAGfv7CpK7c86dI9EhlfbrmfW0DRR_Rv2lE';
$update = file_get_contents('php://input');
$data = json_decode($update, true);

//$data = array("key" => "Xk4B8wT6Zr", "action" => 2, "type" => 1, "obj_id" => 161, "message" => "Новый Заказ");


$chatId = '-1002034413312';
//$message = $data['message'];

$ch = curl_init();

define('TOKEN', $tgbotKey);

function sendTelegram($method, $response)
{
	$ch = curl_init('https://api.telegram.org/bot' .TOKEN. '/' . $method);  
	curl_setopt($ch, CURLOPT_POST, 1);  
	curl_setopt($ch, CURLOPT_POSTFIELDS, $response);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$res = curl_exec($ch);
	curl_close($ch);
 
	return $res;
}

if ($data['key']=='Xk4B8wT6Zr' && $data['action']==1) {
	$res = sendTelegram(
		'sendMessage', 
		array(
			'chat_id' => $chatId,
			'text' => $data['message'],
			'parse_mode' => 'HTML'
		)
	);  
	$res = json_decode($res,true);

	echo $res['result']['message_id'];
	
	mysqli_query($con,'INSERT INTO `notifications` SET `message_id`="'.$res['result']['message_id'].'", `type`="'.$data['type'].'", `obj_id`="'.$data['obj_id'].'"');
	
}

if ($data['key']=='Xk4B8wT6Zr' && $data['action']==2) {
	$res = mysqli_query($con,'SELECT `id`, `message_id` FROM `notifications` WHERE `type`="'.$data['type'].'" AND `obj_id`="'.$data['obj_id'].'"');
	$num = mysqli_num_rows($res);
	if ($num>0) {
		$arr = mysqli_fetch_assoc($res);
		sendTelegram(
			'deleteMessage', 
			array(
				'chat_id' => $chatId,
				'message_id' => $arr['message_id']
			)
		);  
		mysqli_query($con,'DELETE FROM `notifications` WHERE `id`="'.$arr['id'].'"');
		echo 'done';
	} else {
		echo 'ne done';
	}
}

?>