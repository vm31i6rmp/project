// const Stripe = require('stripe');
var stripe = Stripe('pk_test_51NNq80JQOTKAi40aVxXahFeU6UkDA0dNq111Ht2Kdq0wsodrrxTgdj4aqw6JsPDKx9NayixCUqiaoXGF2UUVqDTl00EkXzT9sI');
// var customer = await stripe.customers.retrieve(
//   'cu_1NO1sIJQOTKAi40as1wFuvuC',
//   {
//     apiKey: 'pk_test_51NNq80JQOTKAi40aVxXahFeU6UkDA0dNq111Ht2Kdq0wsodrrxTgdj4aqw6JsPDKx9NayixCUqiaoXGF2UUVqDTl00EkXzT9sI'
//   }
// );


var elements = stripe.elements();

// Element作成時に options から スタイルを調整できます.
var style = {
  base: {
    // ここでStyleの調整をします。
    fontSize: '16px',
    color: "#32325d",
  }
};

// card Element のインスタンスを作成
var card = elements.create('card', {style: style});

// マウント
card.mount('#card-element');

card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

//トークン作成もしくはエラー表示
const form = document.getElementById('payment-form');
form.addEventListener('submit', async (event) => {
  event.preventDefault();

  const {token, error} = await stripe.createToken(card);

  if (error) {
    // Inform the customer that there was an error.
    const errorElement = document.getElementById('card-errors');
    errorElement.textContent = error.message;
  } else {
    // Send the token to your server.
    stripeTokenHandler(token);
  }
});

// トークンやその他の情報をサーバへ送信
function stripeTokenHandler(token) {
  // tokenをフォームへ包含し送信
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);
  // Submit します
  form.submit();
}