var stripe = Stripe("pk_test_51NNq80JQOTKAi40aVxXahFeU6UkDA0dNq111Ht2Kdq0wsodrrxTgdj4aqw6JsPDKx9NayixCUqiaoXGF2UUVqDTl00EkXzT9sI");
var elements = stripe.elements();

// 注文情報。サーバではこのJSONを受け取って処理を行う。
// var order = {
//   items : [
//       {
//           name : "scrab",
//           amount : 2000,
//           quantity : 2
//       },
//       {
//           name : "soap",
//           amount : 1500,
//           quantity : 1
//       }
//   ],
//   currency : "jpy",
//   paymentMethodId : null
// }
// カードエレメントのスタイル
var style = {
  base: {
    color: "#32325d",
  }
}
var card = elements.create("card", { style: style });
card.mount("#card-element");

card.on('change', ({error}) => {
  const displayError = document.getElementById('card-errors');
  // エラーがあればcard-errorsのdivにエラーメッセージを生成
  if (error) {
    displayError.textContent = error.message;
  } else {
    displayError.textContent = '';
  }
});

const submitButton = document.getElementById("payment-form-submit");
submitButton.addEventListener("click", function(event) {
  stripe
  .createPaymentMethod("card", card) // <== ここでPromiseが返ってくるので、thenで処理を続ける
  .then(function(result){
    if(result.error) {
      // エラー時の処理
      onError();
    } else {
      // 成功した時の処理。サーバサイドに注文情報を送信する
      // 支払メソッドIDをリクエストデータに詰める
      order.paymentMethodId = result.paymentMethod.id;
      // サーバサイドへ決済情報を渡して結果をハンドリングする
      // サーバは http://localhost:3000/v1/order/payment にPOSTでリクエストを受け付けている
      fetch("http://localhost:3000/v1/order/payment", {method: "POST", headers: {"Content-Type": "application/json"},body: JSON.stringify(order)})
      .then(function(result){
        return result.json();  // <== HTTPレスポンスからボディをJSONを取り出して次のメソッドに引き渡す
      })
      .then(function(response){
        // 正常終了。
        onComplete(response);
      });
    }
  })
  .catch(function(){
    // エラー時の処理
    onError();
  });
});

// ボタンの要素を取得
let returnButtonNormal = document.getElementById("return-button-normal");
let returnButtonError = document.getElementById("return-button-error");
let returnButtonNotYet = document.getElementById("return-button-not-yet");
let returnButtonDefault = document.getElementById("return-button-default");

returnButtonNormal.addEventListener("click", reset);
returnButtonError.addEventListener("click", reset);
returnButtonNotYet.addEventListener("click", reset);
returnButtonDefault.addEventListener("click", reset);

function reset(event) {
  hideError();
  hideMessage();
  hideNotYetMessage();
  displayButton();
  card.mount("#card-element");
}

function onComplete(response){
  shutdown();
  // スピナー終了
  hideSpinner();
  if(response.error) {
    onError();
  } else if (response.paymentIntentStatus === "succeeded") {
    // 確定ボタンを消して完了メッセージを表示
    displayMessage();
  } else {
    displayNotYetMessage();
  }
}

function onError() {
  shutdown();
  if(!document.querySelector(".spinner-border").classList.contains("collapse")) {
    hideSpinner();
  }
  // エラーメッセージを表示
  displayError();
}

function shutdown() {
  card.unmount();
  hideButton();
}

function hideSpinner() {
  document.querySelector(".spinner-border").classList.add("collapse")
}
function displaySpinner() {
  document.querySelector(".spinner-border").classList.remove("collapse");
}
// エラーメッセージ
function hideError() {
  document.querySelector(".contents-payment-error").classList.add("collapse");
}
function displayError() {
  document.querySelector(".contents-payment-error").classList.remove("collapse");
}
// 成功メッセージ
function displayMessage() {
  document.querySelector(".contents-payment-result").classList.remove("collapse");
}
function hideMessage() {
  document.querySelector(".contents-payment-result").classList.add("collapse");
}
function displayNotYetMessage() {
  document.querySelector(".contents-payment-not-yet").classList.remove("collapse");
}
function hideNotYetMessage() {
  document.querySelector(".contents-payment-not-yet").classList.add("collapse");
}
// 注文確定ボタン
function hideButton() {
  document.querySelector("#payment-form-submit").classList.add("collapse");
}
function displayButton() {
  document.querySelector("#payment-form-submit").classList.remove("collapse");
}