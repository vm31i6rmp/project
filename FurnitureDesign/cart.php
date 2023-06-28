<?php
  require "component.php";
  session_start();
  // 買い物カゴが空ではない時
  if(isset($_SESSION["cart"])) {
    $array = $_SESSION["cart"];
    // 商品の追加
    // 商品名と数量がPOSTされた時
    if(isset($_POST["product_name"]) && isset($_POST["num"])) {
      $array_product_name = array_column($array, "product_name");
      // 既に買い物カゴに入っているのと、同じ商品がカゴに入った時
      if(in_array($_POST["product_name"], $array_product_name)) {
        $index = array_search($_POST["product_name"], $array_product_name);
        $array[$index]["num"] += $_POST["num"];
      //異なる商品がカゴに入った時
      } else {
        $array[] = [
          "product_name" => $_POST["product_name"],
          "num" => $_POST["num"]
        ];
      }
    }
    // 商品の削除
    // 商品名だけがPOSTされた時
    if(isset($_POST["product_name"]) && !isset($_POST["num"])) {
      $array_product_name = array_column($array, "product_name");
      // 商品を削除する
      if(in_array($_POST["product_name"], $array_product_name)) {
        $index = array_search($_POST["product_name"], $array_product_name);
        unset($array[$index]);
        $array = array_values($array);
      }
    }
  // 買い物カゴに初めて商品を入れる時
  } else {
    $array[] = [
      "product_name" => $_POST["product_name"],
      "num" => $_POST["num"]
    ];
  }
  // 配列をセッションに格納
  $_SESSION["cart"] = $array;
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
  <div class="cart-ttl">ショッピングカート</div>
  <div id="cart" class="container">
    <div class="cart">
      <?php
      $gokei = 0;
      foreach($array as $key => $value) {
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
</body>
</html>