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
  $item = 1;
  $i = $item - 1;

  $array = $_SESSION['like'];
  $array = array_filter(
    $array, function($element) {
      return $element['product_like'] == 1;
    }
  );

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
    <!-- z-indexは同じ階層にのみ有効 -->
    <!-- .hamと.navと.maskを同じ階層にする -->
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
            if(array_count_values(array_column($array, 'product_like'))[1] > 0) {
              echo '<sapn>' . array_count_values(array_column($array, 'product_like'))[1] . '</span>';
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
      <section class="item">
        <?php
        echo "<h1 class='section-title'>".$product[$i]["product_name"]."</h1>";
        ?>
        <div id="item">
          <div class="item-img">
            <?php
            echo "<img src='".$product[$i]["img"]."'>"
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