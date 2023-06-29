<?php
  require "component.php";
  session_start();
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
</head>
<body>
  <!-- ここからは header です -->
  <header>
    <div class="hp-title">
      <a href="index.php">
        <img src="./img/logo.svg" alt="Furniture Design">
      </a>
    </div>
    <nav class="menu">
      <ul class="menu-list">
        <li class="menu-item">
        <a href="like.php">
            お気に入り
            <?php
            if(array_count_values(array_column($array_like, 'product_like'))[1] > 0) {
              echo '<sapn>' . array_count_values(array_column($array_like, 'product_like'))[1] . '</span>';
            }
            ?>
          </a>
        </li>
        <li class="menu-item">
          <a href="cart.php">
            カート
            <?php
            if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) {
              echo '<sapn>' . count($_SESSION["cart"]) . '</span>';
            }
            ?>
          </a>
        </li>
        <?php
        if($isUser == 1) {
        ?>
        <li class="menu-item" id="menu-item-user">
          <a href=""><?php echo $userName ?> 様</a>
          <ul class="user-info-list">
            <li class="user-info-item">
              <a href="">登録情報</a>
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
          <a href="login.html">ログイン</a>
        </li>
        <?php
        }
        ?>
        <li class="menu-item">
          <a href="register.html">新規会員登録</a>
        </li>
      </ul>
    </nav>
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
  </header>
  <!-- ここからは main です -->
  <main>
    <div class="wrapper">
      <div class="cart-ttl">ショッピングカート</div>
      <div id="cart" class="container">
        <div class="cart">
          <?php
          $gokei = 0;
          foreach($array_cart as $key => $value) {
            // 商品名のカラムのみを検索
            $array_product_name = array_column($product, "product_name");
            if(in_array($value['product_name'], $array_product_name)) {
              // echo "array_columnで検索対象のindexを取得";
              $index = array_search($value['product_name'], $array_product_name);
              // echo $index;
              $price = $product[$index]["price"];
              $img = $product[$index]["img"];
            }
            echo "<div class='item'>";
            echo "<div class='item-img'><img src=".$img."></div>";
            echo "<div>".$value['product_name']."</div>";
            echo "<div>単価：".number_format($price)."円（税込）</div>";
            echo "<div>数量：".$value['num']."</div>";
            ?>
            <form action="cart.php" method="post">
              <input type="hidden" name="product_name" value="<?= $value['product_name'] ?>">
              <button type="submit">削除する</button>
            </form>
          <?php
            echo "</div>";
            //商品を削除するボタン
            $gokei += $value['num'] * $price;
        }
        ?>
        </div>
        <div class="sum-container">
          <div>合計金額（税込）</div>
          <?php
          echo "<div class='sum-price'>".number_format($gokei)."円</div>";
          ?>
          <div class="next-buy"><a href="products1.php">&gt;&gt; 買い物を続ける</a></div>
          <div class="pay"><a href="https://buy.stripe.com/test_eVag0F0ytfLc5uo8wx">購入する</a></div>
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
</body>
</html>