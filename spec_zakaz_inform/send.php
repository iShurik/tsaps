<?php

$text = '<b>Появился новый Заказ.</b>
Обучение персонала -> Охрана труда (АТОТ)
Свердловская область

Предложения принимаются до 24.12.2024 17:46 МСК

Более подробная информация по ссылке:
https://tsaps.ru/ts/BVJGqiccM4Vf';

$url = 'http://2205243-cu89621.twc1.net/tg_bots/spec_zakaz_inform/index.php';
$data = ['message' => $text];
$jsonData = json_encode($data);
$headers = ['Content-Type: application/json'];

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonData);
$json_response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ( $status != 200 ) {
    die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}
curl_close($curl);
$response = json_decode($json_response, true);


echo ($json_response);

?>