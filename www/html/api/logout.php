<?php

// セッションの開始
session_start();

// セッションの破棄
session_destroy();

// ログアウト後のリダイレクト先に適切なページを指定する
header("Location: /login.php");
exit;
