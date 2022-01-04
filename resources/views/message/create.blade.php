<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Voice</title>
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

  

<h1>賢治AI</h1>
  <div class="container">
    <ul class="messages">
      <li class="left-side">
        <div class="pic">
          <img src="../img/hitoo.png">
        </div>
        <div id="result-div" class="text"></div>
      </li>
      <li class="right-side">
        <div class="pic">
          <img src="../img/賢治.jpeg">
        </div>
        <div id="result-div2" class="text"></div>
      </li>
    </ul>
  </div>
  <div>
  <button id="start-btn"class="material-icons">keyboard_voice</button>
  </div>
  <div>
    <input type="text" id="text_emotion">
    <button id="emotion">感情解析</button>
  </div>


</x-app-layout>





  
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
//データ受け取り//
  // axios
  // .get("index.php")
  // .then(function (response) {
  //   // リクエスト成功時の処理（responseに結果が入っている）
  //   console.log(response);
  // })
  // .catch(function (error) {
  //   // リクエスト失敗時の処理（errorにエラー内容が入っている）
  //   console.log(error);
  // })
  // .finally(function () {
  //   // 成功失敗に関わらず必ず実行
  //   console.log("done!");
  // });

//データに対してtextの色を変える//※本当は徐々に色を変えたい
// "joysad":3.0 ~0(中立)~ -3.0,
// "likedislike":3.0 ~0(中立)~ -3.0,
// "angerfear":3.0 ~0(中立)~ -3.0,


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

      axios
        .get(`talk.php?transcript=${finalTranscript}`)
        .then(function (response) {
          const reply = response.data;
          axios
            .get(`index.php?text=${response.data}`)
            .then(function (response) {
              // リクエスト成功時の処理（responseに結果が入っている）
              console.log(response.data);

              // リクエスト成功時の処理（responseに結果が入っている）
              resultDiv2.innerHTML = reply;
              // 発言を作成
              const uttr = new SpeechSynthesisUtterance(resultDiv2.innerHTML);
              // 発言を再生 (発言キュー発言に追加)
              speechSynthesis.speak(uttr);
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
      const joysad = -1;

      if(joysad === 0)  {
        $("#result-div2")
        .css({'color':'green','font-family':'HiraginoSans-W0','font-weight': '900'});
      }else if (joysad > 0 && joysad <= 3) {
        $("#result-div2").css({'color':'red','font-size':'20px','font-family':'Hiragino Maru Gothic ProN','font-weight': '900'});
      }else if (joysad < 0 && joysad >= -3) {
        $("#result-div2").css({'color':'blue','font-size':'20px','font-family':'Hiragino Mincho ProN'});
      };
    }
  }

  startBtn.onclick = () => {
    recognition.start();
  }

  </script>
</html>