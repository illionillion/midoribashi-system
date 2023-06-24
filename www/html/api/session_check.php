<?php

// セッションの開始
// session_start();
if(!isset($_SESSION)){ session_start(); }

// セッションにemployee_idが存在するかチェック
if (!isset($_SESSION['employee_id'])) {
    // セッションがない場合はlogin.phpへリダイレクト
    header("Location: /login.php");
    exit;
}

// セッションがある場合は何も処理しない
