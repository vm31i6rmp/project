const API_KEY = '81847dba-3fa4-da82-70f8-79abf7f0209f:fx' ;
const API_URL = 'https://api-free.deepl.com/v2/translate';

function deeplTranslate() {
  let deeplInput = document.getElementById("deepl-input").value;
  let isJapanese = false;
  let sourceLang = "";

  // 言語判定: charCodeAt(i) の戻り値が256以上 => 英語ではない => 日本語と判定
  for(var i=0; i < deeplInput.length; i++) {
    if(deeplInput.charCodeAt(i) >= 256) {
    isJapanese = true;
    break;
    }
  }
  switch (isJapanese){
    case true:
      sourceLang='&source_lang=JA&target_lang=EN';
    break;
    case false:
      sourceLang='&source_lang=EN&target_lang=JA';
    break;
    default:
      alert("言語の判別に失敗しました");
  }

  let content = encodeURI('auth_key=' + API_KEY + '&text=' + deeplInput + sourceLang);
  let url = API_URL + '?' + content;

  fetch(url).then(function(response) {
    if(response.ok) {
      return response.json();
    } else {
      throw new Error("Could not reach the API: " + response.statusText);
    }
  }).then(function(data) {
    // document.getElementById("deepl-output").value = data["translations"][0]["text"];
    document.getElementById("deepl-output").innerHTML = data["translations"][0]["text"];
  }).catch(function(error) {
    alert("翻訳失敗");
  });
};

const btn = document.getElementById("btn");
btn.addEventListener("click", () => deeplTranslate());
