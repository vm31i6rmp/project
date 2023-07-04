<?php
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
  // 買い物カゴが空ではない時
  if(isset($_SESSION["cart"])) {
    $array_cart = $_SESSION["cart"];
    // 商品の追加
    // 商品名と数量がPOSTされた時
    if(isset($_POST["product_name"]) && isset($_POST["num"])) {
      $array_cart_product_name = array_column($array_cart, "product_name");
      // 既に買い物カゴに入っているのと、同じ商品がカゴに入った時
      if(in_array($_POST["product_name"], $array_cart_product_name)) {
        $index = array_search($_POST["product_name"], $array_cart_product_name);
        $array_cart[$index]["num"] += $_POST["num"];
      //異なる商品がカゴに入った時
      } else {
        $array_cart[] = [
          "product_name" => $_POST["product_name"],
          "num" => $_POST["num"]
        ];
      }
    }
    // 商品の削除
    // 商品名だけがPOSTされた時
    if(isset($_POST["product_name"]) && !isset($_POST["num"])) {
      $array_cart_product_name = array_column($array_cart, "product_name");
      // 商品を削除する
      if(in_array($_POST["product_name"], $array_cart_product_name)) {
        $index = array_search($_POST["product_name"], $array_cart_product_name);
        unset($array_cart[$index]);
        $array_cart = array_values($array_cart);
      }
    }
  // 買い物カゴに初めて商品を入れる時
  } else {
    if(isset($_POST["product_name"]) && isset($_POST["num"])) {
      $array_cart[] = [
        "product_name" => $_POST["product_name"],
        "num" => $_POST["num"]
      ];
    } else {
      $array_cart[] = [
        "product_name" => null,
        "num" => '0'
      ];
    }
  }
  // 配列をセッションに格納
  // $_SESSION["cart"] = $array_cart;
  $array_cart = array_filter(
    $array_cart, function($element) {
      return $element['num'] > 0 ;
    }
  );
  $_SESSION['cart'] = $array_cart;

  $array_like = $_SESSION['like'];
  // $array_like = array_filter(
  //   $array_like, function($element) {
  //     return $element['product_like'] == 1;
  //   }
  // );
  // $_SESSION['like'] = $array_like;

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
      <div id="cart" class="container">
        <div class="cart-ttl">ショッピングカート</div>
        <div class="cart-container">
          <div class="cart">
            <?php
            $gokei = 0;
            foreach($array_cart as $key => $value) {
              // 商品名のカラムのみを検索
              $array_product_name = array_column($product, "product_name");
              if(in_array($value['product_name'], $array_product_name)) {
                $index = array_search($value['product_name'], $array_product_name);
                $price = $product[$index]["price"];
                $img = $product[$index]["img"];
                $des = $product[$index]["des"];
                $id = $product[$index]["ID"];
              }
              ?>
              <div class='item'>
                <?php echo "<div class='item-img'><img src=".$img."></div>"; ?>
                <div class="item-cnt">
                  <?php echo "<div class='item-cnt-ttl'>".$value['product_name']."</div>"; ?>
                  <?php echo "<div class='item-cnt-price'>".number_format($price)."円<span style='font-size: 1rem;'>（税込）</sapn></div>"; ?>
                  <?php echo "<div class='item-cnt-num'>数量：".$value['num']."</div>"; ?>
                  <div class="btn-container">
                    <a class="btn-buy" href="item<?php echo $id ?>.php">商品ページ</a>
                    <form action="cart.php" method="post">
                      <input type="hidden" name="product_name" value="<?= $value['product_name'] ?>">
                      <button type="submit">
                        <div class="delete-img"><img src="img/trash.png" alt=""></div>
                      </button>
                    </form>
                  </div>
                </div>
            </div>
            <?php
            $gokei += $value['num'] * $price;
            }
            ?>
          </div>
          <div class="sum-container">
            <?php
            if(count($array_cart) > 0) {
            ?>
              <div class="price-container-sp">
                <div>
                  <div>合計金額（税込）</div>
                  <?php echo "<div class='sum-price'>".number_format($gokei)."円</div>"; ?>
                </div>
                <form action="payment.php" method="post">
                  <input type="hidden" name="price" value="<?php echo $gokei ?>">
                  <button type="submit" class="pay">ご購入手続き</button>
                </form>
              </div>
              <div class="next-buy"><a href="products1.php">&gt;&gt; 買い物を続ける</a></div>
            <?php
            }
            ?>
          </div>
        </div>
        <?php
        if(count($array_cart) == 0) {
        ?>
          <div class="empty-txt">
            <div class="empty-txt-1">カートには商品が入っていません。</div>
            <div class="empty-txt-2">ぜひお買い物をお楽しみください。<br class="pc">ご利用をお待ちしております。</div>
            <div class="next-buy"><a href="products1.php">&gt;&gt; 商品ページ</a></div>
          </div>
        <?php
        }
        ?>
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