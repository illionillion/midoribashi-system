<?php

// データベースの接続
include './connect_db.php';

// フォームからのデータを受け取る
$employeeId = $_POST['employee-id'];
$password = $_POST['employee-password'];

// ログイン認証
try {
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE employee_id = ? AND password = ?");
    $stmt->execute([$employeeId, $password]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // 認証成功
        // セッションの開始や認証情報の保存などの処理を行う
        // 例えば、セッションを使った認証情報の保存
        session_start();
        $_SESSION['employee_id'] = $row['employee_id'];
        $_SESSION['employee_name'] = $row['employee_name'];

        // ログイン後のページにリダイレクト
        header("Location: /");
        exit;
    } else {
        // 認証失敗
        // ログインページにリダイレクト
        header("Location: /login.php?error=1");
        exit;
    }
} catch (PDOException $e) {
    // エラーが発生した場合の処理
    die("ログインに失敗しました: " . $e->getMessage());
}
