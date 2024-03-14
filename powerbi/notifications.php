<?php

$tgbotKey = '7163787842:AAFYdx7bwjkSBXG3j_E_h3ygYTZXu4fKwOc';
$update = file_get_contents('php://input');
$data = json_decode($update, true);

$chatId = '-1002063428978';
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

/*sendTelegram(
    'sendMessage', 
    array(
        'chat_id' => $chatId,
        'text' => 'test 
'.$update,
        'parse_mode' => 'HTML'
    )
);  */

echo $update;
?>