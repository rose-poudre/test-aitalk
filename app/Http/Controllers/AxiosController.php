<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\Models\Message;
class AxiosController extends Controller
{
    public function talk($query)
    {
        $url = 'https://api.a3rt.recruit.co.jp/talk/v1/smalltalk';
        $palam=array(
            'query' => $query,
            'apikey' => 'DZZNx6Z5eBHH7qFixKooNc4XRLIZ4Q4V',
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
        return $rec['results'][0]['reply'];
    }
    
    public function emotion($reply)
    {
        $encode_text = urlencode($reply);
        // $url ="http://ap.mextractr.net/ma9/emotion_analyzer?apikey=A01B9C7259FDEFFD5FD68A3F27CD46B9B6C10A68&out=json&text={$encode_text}";
        $url ="http://ap.mextractr.net/ma9/emotion_analyzer?apikey=1BE72E0692560CDA251D0FE934D162FBFA23D1A9&out=json&text={$encode_text}";
        
        
        
        // curlの処理を始める合図
        $curl = curl_init($url);
        
        // リクエストのオプションをセットしていく
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET'); // メソッド指定
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 証明書の検証を行わない
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // レスポンスを文字列で受け取る
        
        //API実行
        $result = curl_exec($curl);
        curl_close($curl);
        $rec = json_decode($result,true);
        return $rec;
    }
}