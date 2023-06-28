<?php
  require "component.php";
  session_start();
  $array = $_SESSION['like'];
  $array = array_filter(
    $array, function($element) {
      return $element['product_like'] == 1;
    }
  );
  if(isset($_POST["product_name"])) {
    $array_product_name = array_column($array, "product_name");
    // 商品を削除する
    if(in_array($_POST["product_name"], $array_product_name)) {
      $index = array_search($_POST["product_name"], $array_product_name);
      unset($array[$index]);
      $array = array_values($array);
    }
  }
  $_SESSION['like'] = $array;
  // foreach($array as $row) {
  //   echo $row['product_name'] . $row['product_like'] . '<br>';
  // }
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
  <div class="cart-ttl">お気に入りリスト</div>
  <div id="cart" class="container">
    <div class="cart">
      <?php
      foreach($array as $key => $value) {
        // 商品名のカラムのみを検索
        $array_product_name = array_column($product, "product_name");
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="page.js"></script>
</body>
</html>