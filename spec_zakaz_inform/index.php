<?php

$tgbotKey = '6847960586:AAGfv7CpK7c86dI9EhlfbrmfW0DRR_Rv2lE';
$update = file_get_contents('php://input');
$data = json_decode($update, true);

$chatId = '413750305';
$message = $data['message'];

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
if ($data['key']=='Xk4B8wT6Zr') {
	sendTelegram(
		'sendMessage', 
		array(
			'chat_id' => $chatId,
			'text' => $data['message'],
			'parse_mode' => 'HTML'
		)
	);  
}

echo $update;
?>