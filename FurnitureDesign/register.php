<?php

  require('db.php');
  foreach ($tb_user as $row) {
    $array_user[] = [
      "name" => $row['name'],
      "id" => $row['id'],
      "password" => $row['password']
    ];
  }
  $array_user_name = array_column($array_user, "name");
  $array_user_id = array_column($array_user, "id");

  $userName = isset($_POST['user_name']) ? $_POST['user_name'] : '';
  $userId = isset($_POST['user_id']) ? $_POST['user_id'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';
  if (empty($userName) || empty($userId) || empty($password)) {
    echo 'お名前とユーザーIDとパスワードを入力してください。<br />';
    echo '<a href="register.html">戻る</a>';
    exit;
  } else {
    if(in_array($userId, $array_user_id)) {
      echo 'ユーザーIDが既に登録されています。<br />';
      echo '<a href="register.html">戻る</a>';
      exit;
    } else {
      // テーブルに登録するINSERT INTO文を変数に格納　VALUESはプレースフォルダーで空の値を入れとく
      $sql = "INSERT INTO user (name, id, password) VALUES (:userName, :userId, :password)";
      //値が空のままSQL文をセット
      $stmt = $db->prepare($sql);
      // 挿入する値を配列に格納
      $params = array(':userName' => $userName, ':userId' => $userId, ':password' => $password);
      //挿入する値が入った変数をexecuteにセットしてSQLを実行
      $stmt->execute($params);
      // HTTPヘッダを送信する関数（クライアントからのリクエスト >> サーバーからのレスポンス）
      // header('Location: 遷移先のURL')
      header('Location: register_done.html');
    }
  }

?>