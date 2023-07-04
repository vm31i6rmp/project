<?php
  session_start();
?>

<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture Design</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/login_logout.css">
    <link rel="shortcut icon" href="./img/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Noto+Sans+JP:wght@100;200;300;400&family=Noto+Serif+JP:wght@300;400;500;600;700&family=Zen+Kaku+Gothic+Antique:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  </head>
  <body>
    <!-- ここからは header です -->
    <header class="header">
      <div class="header-inner">
        <div class="hp-title">
          <a href="index.php">
            <img src="./img/logo.svg" alt="Furniture Design">
          </a>
        </div>
        <div class="ham">
          <div class="ham__bar ham__bar-1"></div>
          <div class="ham__bar ham__bar-2"></div>
        </div>
        <nav class="hp-nav">
          <ul class="hp-nav-list">
            <li class="hp-nav-item">
              <a href="products1.php">PRODUCTS</a>
            </li>
            <li class="hp-nav-item">
              <a href="about.html">ABOUT</a>
            </li>
            <li class="hp-nav-item">
              <a href="company.html">COMPANY</a>
            </li>
            <li class="hp-nav-item" id="contact">
              <a href="mailto:xxxxx@xxx.xxx.com?subject=お問い合わせ">CONTACT</a>
            </li>
          </ul>
        </nav>
        <div class="mask"></div>
      </div>
    </header>
    <!-- ここからは main です -->
    <main>
      <div class="wrapper">
        <div class="container">
          <div class="container-sm">
            <div class="payment-form-container">
              <h1 class="payment-ttl">クレジットカード情報の入力</h1>
              <div class="form-group">
                  <p class="price">お支払い：<?php echo number_format($_POST['price']) ?>円（税込）</p>
                </div>
              <div id="card-element"><!-- input要素がここに生成される --></div>
              <div id="card-errors" role="alert"><!-- エラーメッセージがここに表示される --></div>
              <!-- サーバサイドの処理を待機中に表示するスピナー -->
              <div id="payment-form-spinner" class="d-flex justify-content-center">
                  <div class="spinner-border text-info collapse" role="status">
                      <span class="sr-only">Loading...</span>
                  </div>
              </div>
              <button id="payment-form-submit" class="btn btn-outline-info shadow-sm mb-5 rounded btn-lg btn-block"> 注文を確定する </button>
              <!-- 決済処理後メッセージ -->
              <div id="content-payment-message collapse">
                  <div class="contents-payment-error collapse">
                      <p> 無効な決済リクエストです。 </p>
                      <button class="btn btn-outline-warning" id="return-button-error"> やり直す </button>
                  </div>
                  <div class="contents-payment-not-yet collapse">
                      <p> クレジットカード、もしくは暗証番号に誤りがあります。 </p>
                      <button class="btn btn-outline-warning" id="return-button-not-yet"> やり直す </button>
                  </div>
                  <div class="contents-payment-result collapse">
                      <p> お支払いを完了しました。 </p>
                      <button class="btn btn-outline-success" id="return-button-normal"> トップへ戻る </button>
                  </div>
              </div>
              <!-- その他、細かいレイアウトなど -->
              <div class="other-actions-container">
                <button class="btn btn-outline-secondary" id="return-button-default">
                  <a href="cart.php">戻る</a>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- ここからは footer です -->
    <footer>
      <ul class="sns-list">
        <li class="sns-item"><a href="#">INSTAGRAM</a></li>
        <li class="sns-item"><a href="#">TWITTER</a></li>
        <li class="sns-item"><a href="#">FACEBOOK</a></li>
      </ul>
      <div class="copyright">&copy; Furniture Design</div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="payment.js"></script>
  </body>
</html>