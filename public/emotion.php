<?php
$text = $_GET['text'];
$encode_text = urlencode($text);
$url ="http://ap.mextractr.net/ma9/emotion_analyzer?apikey={$_ENV['EMOTION_API_KEY']}&out=json&text={$encode_text}";

// curlの処理を始める合図
$curl = curl_init($url);

// リクエストのオプションをセットしていく
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET'); // メソッド指定
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列で受け取る

//API実行
$result = curl_exec($curl);

curl_close($curl);
var_dump($result);
$rec = json_decode($result,true);
echo $rec;

?>
