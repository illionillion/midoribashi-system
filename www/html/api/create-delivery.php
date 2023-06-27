<?php

include './connect_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // GETリクエストの場合の処理（直接アクセスされた場合）

    // 別のページにリダイレクト
    header("Location: /");
    exit;
}

session_start();

// POSTデータを受け取る
// $customerName = $_POST['customer-name'];
// $remarks = $_POST['remarks'];
$tableData = $_POST['table-data'];
$deliveryData = $_POST['delivery-data'];
$employeeId = $_SESSION['employee_id'];
// $totalAmount = $_POST['total-amount'];
$orderId = $_POST['order-id'];

try {
    $stmt = $pdo->prepare("UPDATE orders SET table_data = ?, employee_id = ?, delivery_date = CURDATE() WHERE order_id = ?");
    $stmt->execute([$tableData, $employeeId, $orderId]);

    // ここで納品テーブルに納品データを保存（いつ、どの顧客の、どの商品が納品されたか）
    

    // 成功した場合の処理（例: メッセージを表示）
    //   echo "注文書を正常に作成しました。";
    header("Location: /order-edit.php?id=".$orderId);
    exit;
} catch (PDOException $e) {
    // エラーが発生した場合の処理
    die("注文書の作成に失敗しました: " . $e->getMessage());
    // header("Location: /order-create.php");
    exit;
}
