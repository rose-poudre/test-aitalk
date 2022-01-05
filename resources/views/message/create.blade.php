<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AI TALK</title>
  <link rel="stylesheet" href="../css/main.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('') }}
    </h2>
  </x-slot>

  

<h1>AI TALK</h1>
  <div class="container">
    <ul class="messages">
      <li class="left-side">
        <div class="pic">
          <img src="../img/ttora.jpg">
        </div>
        <div id="result-div2" class="text"></div>
      </li>
      <li class="right-side">
        <div id="result-div" class="text"></div>
      </li>
    </ul>
  </div>
  <div>
  <button id="start-btn"class="material-icons">keyboard_voice</button>
  </div>
  <div id="randomImg"></div>


</x-app-layout>





  
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  //音声認識と音声合成//
  const startBtn = document.querySelector('#start-btn');
  const resultDiv = document.querySelector('#result-div');
  const resultDiv2 = document.querySelector('#result-div2');

  SpeechRecognition = webkitSpeechRecognition || SpeechRecognition;
  let recognition = new SpeechRecognition();

  recognition.lang = 'ja-JP';

  let finalTranscript = ''; // 確定した(黒の)認識結果

  recognition.onresult = (event) => {
    for (let i = event.resultIndex; i < event.results.length; i++) {
      let transcript = event.results[i][0].transcript;
      if (event.results[i].isFinal) {
        finalTranscript = transcript;
      }
      resultDiv.innerHTML = finalTranscript;
      axios.get('/talk/' + finalTranscript)
        .then(function (response) {
          const reply = response.data;
          axios.get('/emotion/' + reply)
            .then(function (response) {
              // リクエスト成功時の処理（responseに結果が入っている）
              //console.log(response.data);
              const joysad = Number(response.data.joysad);
              const likedislike = Number(response.data.likedislike);
              const angerfear = Number(response.data.angerfear);
              const total = joysad + likedislike + angerfear;
              
              switch (total) {
              case 9:
              $("#result-div2").css( {'font-family': 'HiraginoSans-W0', 'font-weight': 'bold', 'font-size' : '23px' , 'color' : 'rgb(255,0,0)' }); //式が値1に当てはまる場合に実行される
                break;
              //   case 値2:
                case 8:
              $("#result-div2").css( {'font-family': 'HiraginoSans-W0', 'font-weight': 'bold', 'font-size' : '22px' , 'color' : 'rgb(241,28,26)' }); //式が値2に当てはまる場合に実行される
                break;
                case 7:
              $("#result-div2").css( {'font-family': 'HiraginoSans-W0', 'font-weight': 'bold', 'font-size' : '21px' , 'color' : 'rgb(228,57,40)' }); //式が値1に当てはまる場合に実行される
                break;
                case 6:
              $("#result-div2").css( {'font-family': 'HiraginoSans-W0', 'font-weight': 'bold',  'font-size' : '20px' , 'color' : 'rgb(214,85,54)' }); //式が値1に当てはまる場合に実行される
                break; 
                case 5:
              $("#result-div2").css( {'font-family': 'HiraginoSans-W0', 'font-weight': 'bold', 'font-size' : '19px' , 'color' : 'rgb(201,113,67)' }); //式が値1に当てはまる場合に実行される
                break; 
                case 4:
              $("#result-div2").css( {'font-family': 'HiraginoSans-W0', 'font-weight': 'bold', 'font-size' : '18px' , 'color' : 'rgb(188,141,80)' }); //式が値1に当てはまる場合に実行される
                break; 
                case 3:
              $("#result-div2").css( {'font-family': 'ヒラギノ丸ゴ ProN','font-size' : '17px' , 'color' : 'rgb(174,170,94)' }); //式が値1に当てはまる場合に実行される
                break; 
                case 2:
              $("#result-div2").css( {'font-family': 'ヒラギノ丸ゴ ProN', 'font-size' : '16px' , 'color' : 'rgb(161,198,107)' }); //式が値1に当てはまる場合に実行される
                break; 
                case 1:
              $("#result-div2").css( {'font-family': 'ヒラギノ丸ゴ ProN', 'font-size' : '15px' , 'color' : 'rgb(147,227,120)' }); //式が値1に当てはまる場合に実行される
                break;
                case 0:
              $("#result-div2").css( {'font-family': 'ヒラギノ丸ゴ ProN', 'font-size' : '14px' , 'color' : 'rgb(134,255,134)' }); //式が値1に当てはまる場合に実行される
                break;
                case -1:
              $("#result-div2").css( {'font-family': 'ヒラギノ丸ゴ ProN', 'font-size' : '15px' , 'color' : 'rgb(120,227,147)' }); //式が値1に当てはまる場合に実行される
                break;   
                case -2:
              $("#result-div2").css( {'font-family': 'ヒラギノ丸ゴ ProN', 'font-size' : '16px' , 'color' : 'rgb(107,198,161)' }); //式が値1に当てはまる場合に実行される
                break;   
                case -3:
              $("#result-div2").css( {'font-family': 'ヒラギノ丸ゴ ProN', 'font-size' : '17px' , 'color' : 'rgb(94,170,174)' }); //式が値1に当てはまる場合に実行される
                break;   
                case -4:
              $("#result-div2").css( {'font-family': 'Hiragino Mincho ProN', 'font-size' : '18px' , 'color' : 'rgb(80,141,188)' }); //式が値1に当てはまる場合に実行される
                break;   
                case -5:
              $("#result-div2").css( {'font-family': 'Hiragino Mincho ProN', 'font-size' : '19px' , 'color' : 'rgb(67,113,201)' }); //式が値1に当てはまる場合に実行される
                break;   
                case -6:
              $("#result-div2").css( {'font-family': 'Hiragino Mincho ProN', 'font-size' : '20px' , 'color' : 'rgb(54,85,214)' }); //式が値1に当てはまる場合に実行される
                break;   
                case -7:
              $("#result-div2").css( {'font-family': 'Hiragino Mincho ProN', 'font-size' : '21px' , 'color' : 'rgb(40,57,228)' }); //式が値1に当てはまる場合に実行される
                break;
                case -8:
              $("#result-div2").css( {'font-family': 'Hiragino Mincho ProN', 'font-size' : '22px' , 'color' : 'rgb(26,28,241)' }); //式が値1に当てはまる場合に実行される
                break;
                case -9:
              $("#result-div2").css( {'font-family': 'Hiragino Mincho ProN', 'font-size' : '23px' , 'color' : 'rgb(0,0,255)' }); //式が値1に当てはまる場合に実行される
                break;
              }
              
              
              const data = {
                  message: finalTranscript,
                  reply: reply,
                  joysad: joysad,
                  likedislike: likedislike,
                  angerfear: angerfear,
              };
              axios.post('/insert', data)
                .then(function(response) {
                   // リクエスト成功時の処理（responseに結果が入っている）
                  resultDiv2.innerHTML = reply;
                  // 発言を作成
                  const uttr = new SpeechSynthesisUtterance(resultDiv2.innerHTML);
                  // 発言を再生 (発言キュー発言に追加)
                  speechSynthesis.speak(uttr); 
                });
            })
            .catch(function (error) {
              // リクエスト失敗時の処理（errorにエラー内容が入っている）
              console.log(error);
            })
            .finally(function () {
              // 成功失敗に関わらず必ず実行
              console.log("done!");
            });
        })
        .catch(function (error) {
          // リクエスト失敗時の処理（errorにエラー内容が入っている）
          console.log(error);
        })
        .finally(function () {
          // 成功失敗に関わらず必ず実行
          console.log("done!");
        });

    }
  }

  startBtn.onclick = () => {
    recognition.start();
  }

  </script>
</html>