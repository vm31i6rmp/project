<?php
  // dsn = data source name
  $dsn = 'mysql:host=mysql1.php.xdomain.ne.jp; dbname=xd195459_furnituredesign; charset=utf8';
  $user = 'xd195459_haku';
  $password = 'test0000';

  try {
    $db = new PDO($dsn, $user, $password); // PDO = PHP Data Object
    // echo '接続成功', '<br>';
    $tb_product = $db->query('SELECT * FROM product ORDER BY ID');
    $tb_user = $db->query('SELECT * FROM user');
    // foreach ($tb_user as $row) {
    //   $array_user[] = [
    //     "name" => $row['name'],
    //     "id" => $row['id'],
    //     "password" => $row['password']
    //   ];
    // }
    // foreach ($tb_product as $row) {
    //   $array_product[] = [
    //     "ID" => $row['ID'],
    //     "name" => $row['name'],
    //     "price" => $row['price'],
    //     "img" => $row['img'],
    //     "des" => $row['des'],
    //     "size" => $row['size'],
    //     "color" => $row['color']
    //   ];
    // }
    // $array_product_name = array_column($array_product, "name");
  } catch (PDOException $e) {
    // 接続できなかったらエラー表示
    echo 'DB接続エラー: ' . $e->getMessage();
  }
?>