<?php
  require "db.php";
  session_start();
  foreach ($tb_user as $row) {
    $array_user[] = [
      "name" => $row['name'],
      "id" => $row['id'],
      "password" => $row['password']
    ];
  }

  if(isset($_SESSION["like"])) {
    $array_like = $_SESSION["like"];
  }

  // 配列をセッションに格納
  $_SESSION["like"] = $array_like;

  $isUser = 0;
  if(isset($_SESSION['user_name'])) {
    $userName = $_SESSION['user_name'];
    $isUser = 1;
  }
  $array_user_name = array_column($array_user, 'name');
  $index = array_search($userName, $array_user_name);
  $userId = $array_user[$index]['id'];
?>

<!DOCTYPE html>
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
      <!-- z-indexは同じ階層にのみ有効のため .hamと.navと.maskは同じ階層にする -->
      <div class="hp-title">
        <a href="index.php">
          <img src="./img/logo.svg" alt="Furniture Design">
        </a>
      </div>
      <!-- PCメニュー -->
      <nav class="menu pc">
        <ul class="menu-list">
          <li class="menu-item">
            <a href="like.php">
              お気に入り
              <div class="menu-item-like-img">
                <img src="img/heart.png" alt="LIKE">
                <?php
                if(array_count_values(array_column($array_like, 'product_like'))[1] > 0) {
                  echo '<sapn class="menu-item-num">' . array_count_values(array_column($array_like, 'product_like'))[1] . '</span>';
                }
                ?>
              </div>
            </a>
          </li>
          <li class="menu-item">
            <a href="cart.php">
              カート
              <div class="menu-item-cart-img">
                <img src="img/cart.png" alt="CART">
                <?php
                if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) {
                  echo '<sapn class="menu-item-num">' . count($_SESSION["cart"]) . '</span>';
                }
                ?>
              </div>
            </a>
          </li>
          <?php
          if($isUser == 1) {
          ?>
          <li class="menu-item" id="menu-item-user">
            <a class="menu-item-user" href="mypage.php"><?php echo $userName ?> 様</a>
            <ul class="user-info-list">
              <li class="user-info-item">
                <a href="mypage.php">登録情報</a>
              </li>
              <li class="user-info-item">
                <a href="logout.php">ログアウト</a>
              </li>
            </ul>
          </li>
          <?php
          } else {
          ?>
          <li class="menu-item">
            <a class="menu-item-login" href="login.php">ログイン</a>
          </li>
          <?php
          }
          ?>
          <li class="menu-item">
            <a class="menu-item-register" href="register.php">新規会員登録</a>
          </li>
        </ul>
      </nav>
      <!-- ハンバーグメニュー -->
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
    <!-- SPメニュー -->
    <nav class="menu sp">
      <ul class="menu-list">
        <li class="menu-item">
          <a href="like.php" style="margin-top: 5px;">
            <div class="menu-item-like-img">
              <img src="img/heart.png" alt="LIKE">
              <?php
              if(array_count_values(array_column($array_like, 'product_like'))[1] > 0) {
                echo '<sapn class="menu-item-num">' . array_count_values(array_column($array_like, 'product_like'))[1] . '</span>';
              }
              ?>
            </div>
          </a>
        </li>
        <li class="menu-item" style="margin-left: -40px;">
          <a href="cart.php" style="margin-top: 5px;">
            <div class="menu-item-cart-img">
              <img src="img/cart.png" alt="CART">
              <?php
              if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) {
                echo '<sapn class="menu-item-num">' . count($_SESSION["cart"]) . '</span>';
              }
              ?>
            </div>
          </a>
        </li>
        <?php
        if($isUser == 1) {
        ?>
        <li class="menu-item" style="margin-right: -50px;">
          <a class="menu-item-user" href="mypage.php"><?php echo $userName ?> 様</a>
        </li>
        <?php
        } else {
        ?>
        <li class="menu-item" style="margin-right: -50px;">
          <a class="menu-item-login" href="login.php">ログイン</a>
        </li>
        <?php
        }
        ?>
        <li class="menu-item">
          <a class="menu-item-register" href="register.php">新規会員登録</a>
        </li>
      </ul>
    </nav>
  </header>
  <!-- ここからは main です -->
  <main>
    <div class="wrapper">
      <div class="container-mypage">
        <div class="mypage-ttl">会員情報</div>
        <div class="mypage-info-container">
          <div class="mypage-info">お名前：<?php echo $userName; ?></div>
          <div class="mypage-info">ユーザーID：<?php echo $userId; ?></div>
        </div>
        <div class="btn-container">
          <div class="btn-container-like"><a href="like.php">お気に入り商品</a></div>
          <div class="btn-container-cart"><a href="cart.php">買物カート</a></div>
        </div>
        <div class="btn-logout"><a href="logout.php">ログアウト</a></div>
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