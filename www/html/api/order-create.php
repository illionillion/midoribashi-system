<?php

include './connect_db.php';

session_start();

// POSTデータを受け取る
$customerName = $_POST['customer-name'];
$remarks = $_POST['remarks'];
$tableData = $_POST['table-data'];
$employeeId = $_SESSION['employee_id'];
$totalAmount = $_POST['total-amount'];

// INSERT文の実行
try {
    $stmt = $pdo->prepare("INSERT INTO orders (customer_name, remarks, table_data, employee_id, total_amount) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$customerName, $remarks, $tableData, $employeeId, $totalAmount]);

    // 成功した場合の処理（例: メッセージを表示）
    //   echo "注文書を正常に作成しました。";
    header("Location: /");
    exit;
} catch (PDOException $e) {
    // エラーが発生した場合の処理
    die("注文書の作成に失敗しました: " . $e->getMessage());
    header("Location: /order-create.php");
    exit;
}
