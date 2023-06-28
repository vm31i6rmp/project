<?php

  require('db.php');
  session_start();
  foreach ($tb_user as $row) {
    $array_user[] = [
      "name" => $row['name'],
      "id" => $row['id'],
      "password" => $row['password']
    ];
  }
  $array_user_name = array_column($array_user, "name");
  $array_user_id = array_column($array_user, "id");

  // 条件式 ? 式1 : 式2 => TRUEであれば式1、FALSEであれば式2
  $userId = isset($_POST['user_id']) ? $_POST['user_id'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  if (empty($userId) || empty($password)) {
    echo 'ユーザーIDとパスワードを入力してください。<br />';
    echo '<a href="login.html">戻る</a>';
    exit; // exit('メッセージ') でメッセージを出力してプログラムを終了
  } else {
    if(in_array($userId, $array_user_id)) {
      $index = array_search($userId, $array_user_id);
      if($array_user[$index]['password'] == $password) {
        $_SESSION['user_name'] = $array_user[$index]['name'];
        header('Location: index.php');
      } else {
        echo 'パスワードが間違っています。<br />';
        echo '<a href="login.html">戻る</a>';
        exit;
      }
    } else {
      echo 'ユーザーIDが存在しません。<br />';
      echo '<a href="login.html">戻る</a>';
      exit;
    }
  }

?>