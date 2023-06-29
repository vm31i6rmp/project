<?php
  require "component.php";
  session_start();
  $array_like = $_SESSION['like'];
  // $array_like = array_filter(
  //   $array_like, function($element) {
  //     return $element['product_like'] == '1';
  //   }
  // );
  // $_SESSION['like'] = $array_like;

  if(isset($_POST["product_name"])) {
    $array_like_product_name = array_column($array_like, "product_name");
    // 商品を削除する
    if(in_array($_POST["product_name"], $array_like_product_name)) {
      $index = array_search($_POST["product_name"], $array_like_product_name);
      unset($array_like[$index]);
      $array_like = array_values($array_like);
      $_SESSION['like'] = $array_like;
    }
  }

  // if(isset($_SESSION['like'])) {
  //   echo '存在'. '<br>';
  //   var_dump($_SESSION['like']);
  // }
  // foreach($array_like as $row) {
  //   echo  '<br>' . $row['product_name'] . $row['product_like'] . '<br>';
  // }

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
            if(array_count_values(array_column($array_like, 'product_like'))['1'] > 0) {
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
      <div class="cart-ttl">お気に入りリスト</div>
      <div id="cart" class="container">
        <div class="cart">
          <?php
          foreach($array_like as $key => $value) {
            // 商品名のカラムのみを検索
            $array_product_name = array_column($product, "product_name");
            if($value['product_like'] == '0'){
              continue;
            }
            if(in_array($value['product_name'], $array_product_name)) {
              $index = array_search($value['product_name'], $array_product_name);
              $price = $product[$index]["price"];
              $img = $product[$index]["img"];
            }
            echo "<div class='item'>";
            echo "<div class='item-img'><img src=".$img."></div>";
            echo "<div>".$value['product_name']."</div>";
            echo "<div>単価：".number_format($price)."円（税込）</div>";
            ?>
            <form action="like.php" method="post">
              <input type="hidden" name="product_name" value="<?= $value['product_name'] ?>">
              <button type="submit">お気に入りリストから削除</button>
            </form>
          <?php
            echo "</div>";
            //商品を削除するボタン
        }
        ?>
        </div>
        <div class="sum-container">
          <div class="next-buy"><a href="products1.php">&gt;&gt; 買い物を続ける</a></div>
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