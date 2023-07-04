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

  /* IDかPWが未入力の場合 */
  if (empty($userId) || empty($password)) {
    $_SESSION['login-error'] = 1;
    header('Location: login.php');
  } else {
    if(in_array($userId, $array_user_id)) {
      $index = array_search($userId, $array_user_id);
      /* ログイン成功の場合 */
      if($array_user[$index]['password'] == $password) {
        $_SESSION['user_name'] = $array_user[$index]['name'];
        header('Location: index.php');
      } else {
        /* PWが間違っている場合 */
        $_SESSION['login-error'] = 3;
        header('Location: login.php');
      }
    } else {
      /* IDが存在しない場合 */
      $_SESSION['login-error'] = 2;
      header('Location: login.php');
    }
  }

?>