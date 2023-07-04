<?php

  session_start();

  $_SESSION = [];    // $_SESSION変数を空
  session_destroy(); // セッションを破棄

  header('Location: ./login.php');
  exit;

?>