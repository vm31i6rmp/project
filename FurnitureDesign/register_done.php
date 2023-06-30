<?php
  session_start();
?>

<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture Design</title>
    <link rel="stylesheet" href="./css/reset.css">
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
          <div class="register-done-txt">登録が完了しました。</div>
          <div class="register-done-info">
            <div>お名前：<?php echo $_SESSION['register_done_user_name'];?></div>
            <div>ユーザーID：<?php echo $_SESSION['register_done_user_id'];?></div>
          </div>
          <div class="btn-hp"><a href="index.php">トップページ</a></div>
          <div class="btn-login"><a href="login.html">ログイン</a></div>
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
  </body>
</html>