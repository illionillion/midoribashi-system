<?php

include './connect_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GETリクエストの場合の処理（直接アクセスされた場合）

    // 別のページにリダイレクト
    header("Location: /");
    exit;
}

$orderId = $_POST['order-id'];

// 削除処理の実行
try {
    $stmt = $pdo->prepare("DELETE FROM orders WHERE order_id = ?");
    $stmt->execute([$orderId]);

    // 削除が成功した場合の処理（例: メッセージを表示）
    // echo "注文が削除されました。";
    header("Location: /");

} catch (PDOException $e) {
    // エラーが発生した場合の処理
    die("注文の削除に失敗しました: " . $e->getMessage());
}
