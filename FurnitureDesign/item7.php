<?php
  $item = 7;
  $i = $item - 1;

  require "db.php";
  session_start();
  foreach ($tb_product as $row) {
    $product[] = [
      "ID" => $row['ID'],
      "product_name" => $row['name'],
      "price" => $row['price'],
      "img" => $row['img'],
      "des" => $row['des'],
      "size" => $row['size'],
      "color" => $row['color']
    ];
  }

  if(isset($_SESSION["like"])) {
    $array_like = $_SESSION["like"];
    // 商品の追加
    // 商品名とお気に入りがPOSTされた時
    if(isset($_POST["product_name"]) && isset($_POST["product_like"])) {
      $array_like_product_name = array_column($array_like, "product_name");
      // 既にお気に入りリストに入っているのと、同じ商品がカゴに入った時
      if(in_array($_POST["product_name"], $array_like_product_name)) {
        $index = array_search($_POST["product_name"], $array_like_product_name);
        $array_like[$index]["product_like"] = $_POST["product_like"];
      //異なる商品がお気に入りリストに入った時
      } else {
        $array_like[] = [
          "product_name" => $_POST["product_name"],
          "product_like" => $_POST["product_like"]
        ];
      }
    }
  } else {
    if(isset($_POST["product_name"]) && isset($_POST["product_like"])) {
      $array_like[] = [
        "product_name" => $_POST["product_name"],
        "product_like" => $_POST["product_like"]
      ];
    } else {
      $array_like[] = [
        "product_name" => null,
        "product_like" => '0'
      ];
    }
  }

  $_SESSION["like"] = $array_like;
  $isUser = 0;
  if(isset($_SESSION['user_name'])) {
    $userName = $_SESSION['user_name'];
    $isUser = 1;
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Furniture Design</title>
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
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
      <section class="item">
        <?php
        echo "<h1 class='section-title'>".$product[$i]["product_name"]."</h1>";
        ?>
        <div id="item">
          <div class="item-img">
            <?php
            echo "<img src='".$product[$i]["img"]."'>";
            ?>
          </div>
          <div class="item-cnt">
            <?php
            echo "<div class='item-cnt-text'>".$product[$i]["des"]."</div>";
            echo "<div class='item-cnt-price'>".number_format($product[$i]["price"])." 円（税込）</div>";
            ?>
            <dl class="item-cnt-info">
              <dt class="item-cnt-info-ttl">SIZE：</dt>
              <?php
              echo "<dd class='item-cnt-info-cnt'>".$product[$i]["size"]."</dd>"
              ?>
              <dt class="item-cnt-info-ttl">COLOR：</dt>
              <?php
              echo "<dd class='item-cnt-info-cnt'>".$product[$i]["color"]."</dd>"
              ?>
            </dl>
            <div class="form-container-column">
              <!-- お気に入りボタン -->
              <?php
              $array_like_product_name = array_column($array_like, "product_name");
              if(in_array($product[$i]["product_name"], $array_like_product_name)) {
                $index = array_search($product[$i]["product_name"], $array_like_product_name);
                if($array_like[$index]["product_like"] == '1') {
              ?>
                <form class="form-like" action="item<?php echo $item ?>.php" method="post">
                  <input type="hidden" name="product_name" value="<?= $product[$i]["product_name"] ?>">
                  <input type="hidden" name="product_like" value=0>
                  <button class="btn-unlike" type="submit">
                    <div class="btn-like-img">
                      <img src="img/heart-white.png">
                    </div>
                    <div>お気に入り解除</div>
                  </button>
                </form>
              <?php
              } else if($array_like[$index]["product_like"] == '0') {
              ?>
                <form class="form-like" action="item<?php echo $item ?>.php" method="post">
                  <input type="hidden" name="product_name" value="<?= $product[$i]["product_name"] ?>">
                  <input type="hidden" name="product_like" value=1>
                  <button class="btn-like" type="submit">
                    <div class="btn-like-img">
                      <img src="img/heart-white.png">
                    </div>
                    <div>お気に入り追加</div>
                  </button>
                </form>
              <?php
              }
              } else {
              ?>
                <form class="form-like" action="item<?php echo $item ?>.php" method="post">
                  <input type="hidden" name="product_name" value="<?= $product[$i]["product_name"] ?>">
                  <input type="hidden" name="product_like" value=1>
                  <button class="btn-like" type="submit">
                    <div class="btn-like-img">
                      <img src="img/heart-white.png">
                    </div>
                    <div>お気に入り追加</div>
                  </button>
                </form>
              <?php
              }
              ?>
              <!-- カート入れるボタン -->
              <form action="cart.php" method="post">
                <input type="hidden" name="product_name" value="<?= $product[$i]["product_name"] ?>">
                <div class="num-container">
                  <select class="select-num" name="num">
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                  </select>
                  <button class="btn-cart btn-cart-page" type="submit">
                    <div class="btn-cart-img">
                      <img src="img/cart-white.png">
                    </div>
                    <div>カートに入れる</div>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
      <div class="view-more">
        <a href="products1.php">Back To Products</a>
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