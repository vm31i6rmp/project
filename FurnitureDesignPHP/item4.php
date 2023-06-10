<?php
  require "component.php";
  session_start();
  $item = 4;
  $i = $item - 1;
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
      <div class="shopping-cart-now"><a href="cart.php">買い物カート</a>は、
        <?php
          if(isset($_SESSION["cart"]) && count($_SESSION["cart"])>0) {
            echo count($_SESSION["cart"]);
            echo "商品が入っています。";
          } else {
            echo "空です。";
          }
        ?>
      </div>
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
                <button class="btn-cart" type="submit">
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
  <script src="main.js"></script>
</body>
</html>