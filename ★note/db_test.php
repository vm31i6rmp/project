<?php
  $dsn = 'mysql:host=mysql1.php.xdomain.ne.jp; dbname=xd195459_db; charset=utf8';
  $user = 'xd195459_haku';
  $password = 'test0000';

  try {
    $db = new PDO($dsn, $user, $password); // PDO = PHP Data Object
    echo '接続成功', '<br>';
    $entry = $db->query('SELECT * FROM tb_test ORDER BY ID DESC');
    foreach ($entry as $row) {
      echo $row['Name'] . 'さんの数学点数は' . $row['Math'] . '点です。<br>';
    }
  } catch (PDOException $e) {
    // 接続できなかったらエラー表示
    echo 'DB接続エラー: ' . $e->getMessage();
  }
?>