<?php
  require "component.php";
  session_start();

  if(isset($_SESSION["like"])) {
    $array = $_SESSION["like"];
    // 商品の追加
    // 商品名とお気に入りがPOSTされた時
    if(isset($_POST["product_name"]) && isset($_POST["product_like"])) {
      $array_product_name = array_column($array, "product_name");
      // 既にお気に入りリストに入っているのと、同じ商品がカゴに入った時
      if(in_array($_POST["product_name"], $array_product_name)) {
        $index = array_search($_POST["product_name"], $array_product_name);
        $array[$index]["product_like"] = $_POST["product_like"];
      //異なる商品がお気に入りリストに入った時
      } else {
        $array[] = [
          "product_name" => $_POST["product_name"],
          "product_like" => $_POST["product_like"]
        ];
      }
    }
  // 買い物カゴに初めて商品を入れる時
  } else {
    $array[] = [
      "product_name" => $_POST["product_name"],
      "product_like" => $_POST["product_like"]
    ];
  }
  // product_like = 1 の元素のみ配列に保存
  $array = array_filter(
    $array, function($element) {
      return $element['product_like'] == 1;
    }
  );
  // 配列をセッションに格納
  $_SESSION["like"] = $array;

  // foreach($array as $row) {
  //   echo $row['product_name'] . $row['product_like'] . '<br>';
  // }
  // $_SESSION["like"] = [];

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
            if(isset($_SESSION["like"]) && count($_SESSION["like"]) > 0) {
              echo '<sapn>' . count($_SESSION["like"]) . '</span>';
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
      <section class="product">
        <!-- <div class="section-title">Products</div> -->
        <ul class="product-list">
        <?php
        for($i=0; $i<8; $i++) {
          $j = $i + 1;
        ?>
          <li class="product-item">
          <?php
            echo "<a href='item".$j.".php'>";
              echo "<img src='".$product[$i]["img"]."'>";
              echo "<div class='product-name'>".$product[$i]["product_name"]."</div>";
              echo "<div class='product-price'>".number_format($product[$i]["price"])."円（税込）</div>";
            ?>
            </a>
            <div class="form-container">
              <?php
              $array_product_name = array_column($array, "product_name");
              if(in_array($product[$i]["product_name"], $array_product_name)) {
                $index = array_search($product[$i]["product_name"], $array_product_name);
                if($array[$index]["product_like"] == 1) {?>
                  <form class="form-like" action="index.php" method="post">
                    <input type="hidden" name="product_name" value="<?= $product[$i]["product_name"] ?>">
                    <input type="hidden" name="product_like" value=0>
                    <button class="btn-unlike" type="submit">
                      <div class="btn-like-img">
                        <img src="img/heart-white.png">
                      </div>
                    </button>
                  </form>
                <?php
                } else {
                ?>
                  <form class="form-like" action="index.php" method="post">
                    <input type="hidden" name="product_name" value="<?= $product[$i]["product_name"] ?>">
                    <input type="hidden" name="product_like" value=1>
                    <button class="btn-like" type="submit">
                      <div class="btn-like-img">
                        <img src="img/heart-white.png">
                      </div>
                    </button>
                  </form>
                <?php
                }
              } else {
              ?>
                <form class="form-like" action="index.php" method="post">
                  <input type="hidden" name="product_name" value="<?= $product[$i]["product_name"] ?>">
                  <input type="hidden" name="product_like" value=1>
                  <button class="btn-like" type="submit">
                    <div class="btn-like-img">
                      <img src="img/heart-white.png">
                    </div>
                  </button>
                </form>
              <?php
              }
              ?>
              <form class="form-cart" action="cart.php" method="post">
                <input type="hidden" name="product_name" value="<?= $product[$i]["product_name"] ?>">
                <div class="num-container">
                  <!-- <select class="select-num" name="num">
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                  </select> -->
                  <input type="hidden" name="num" value="1">
                  <button class="btn-cart" type="submit">
                    <div class="btn-cart-img">
                      <img src="img/cart-white.png">
                    </div>
                    <div>カートに入れる</div>
                  </button>
                </div>
              </form>
            </div>
          </li>
        <?php
        }
        ?>
        </ul>
      </section>
      <div class="view-more">
        <a href="products1.php">View More</a>
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