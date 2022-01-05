<?php
// 自動で読み込み
require './vendor/autoload.php';
// .envを使用する
Dotenv\Dotenv::createImmutable(__DIR__)->load();

$transcript = $_GET['transcript'];
// $encode_transcript = urlencode($transcript);
$url = "https://api.a3rt.recruit.co.jp/talk/v1/smalltalk";

$palam=array(
    'query' => $transcript,
    'apikey' => $_ENV["CHAT_API_KEY"],
);

$ch = curl_init();
$headr = array();
$headr[] = 'Content-Type: application/json;';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($palam));

//API実行
$result = curl_exec($ch);

curl_close($ch);

$rec = json_decode($result,true);
echo $rec['results'][0]['reply'];