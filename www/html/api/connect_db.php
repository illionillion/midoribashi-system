<?php
$host = 'localhost'; // データベースのホスト名
$dbname = 'midoribashi_db'; // データベース名
$username = 'root'; // ユーザー名
$password = ''; // パスワード

// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     // GETリクエストの場合の処理（直接アクセスされた場合）

//     // 別のページにリダイレクト
//     header("Location: /");
//     exit;
// }

try {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    // PDOオブジェクトを作成し、データベースに接続する
    $pdo = new PDO($dsn, $username, $password, $options);

    // 接続成功時の処理
    // echo "データベースに接続しました。";
} catch (PDOException $e) {
    // 接続失敗時の処理
    die("データベース接続エラー: " . $e->getMessage());
}
