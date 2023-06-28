<?php
// Stripeライブラリをロード
require_once('/stripe-php/init.php');
// Secret API keyをセット
$stripe = new \Stripe\StripeClient('pk_test_51NNq80JQOTKAi40aVxXahFeU6UkDA0dNq111Ht2Kdq0wsodrrxTgdj4aqw6JsPDKx9NayixCUqiaoXGF2UUVqDTl00EkXzT9sI');
$s=\Stripe\Checkout\Session::create([
  'success_url' => 'https://www.hoge.com/success.html',
  'cancel_url' => 'https://www.hoge.com/cancel.html',
  'payment_method_types' => ['card'],
  'line_items' => [[
    'amount' => 500,
    'currency' => 'usd',
    'name' => 'sample商品',
    'description' => 'Stripeのお試し',
    'quantity' => 1,
  ]]
]);
$id=$s['id'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
	<script>
		// publishable API keyをセット
		var stripe = Stripe('pk_test_hogehoge');
		stripe.redirectToCheckout({
		  // 上記で生成したセッションIDをセット
		  sessionId: '<?=$id?>'
		}).then(function (result) {
		  // エラー処理
		  // `result.error.message`を使うと、ブラウザの言語に合わせたエラーメッセージを表示することができる
		});
	</script>
</body>
</html>