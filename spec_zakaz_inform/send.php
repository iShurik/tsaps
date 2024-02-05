<?php

$text = '<b>Появилась новая задача в Витрине.</b>
Проектирование -> Разработка отдельных разделов ПД и РД
Ростовская область

Разработка проектной и рабочей документации системы электроснабжения и электроосвещения административных помещений - 2 работы, разные цеха

Предложения рассматриваются до <b>09.02.2024 18:00 МСК</b>

Найти задачу можно по ссылке:
https://tsaps.ru/administrator/showcase';

$url = 'https://gpt.procpb.ru/tsaps/spec_zakaz_inform/index.php';
$data = ['message' => $text, 'key' => 'Xk4B8wT6Zr'];
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