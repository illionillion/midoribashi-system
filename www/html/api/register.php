<?php

// データベースの接続
include './connect_db.php';

// アカウント作成（従業員登録）
// null値や空白文字のチェック
// if (empty($employeeId) || empty($employeeName) || empty($phoneNumber) || empty($email) || empty($password)) {
//     // 必要なフィールドが空である場合の処理
//     header("Location: ../signup.php");
//     exit;
// }

// フォームからのデータを受け取る
$employeeId = $_POST['employee-id'];
$employeeName = $_POST['employee-name'];
$phoneNumber = $_POST['employee-tel'];
$email = $_POST['employee-email'];
$password = $_POST['employee-password'];

// INSERT文の実行
try {
    $stmt = $pdo->prepare("INSERT INTO employees (employee_id, employee_name, phone_number, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$employeeId, $employeeName, $phoneNumber, $email, $password]);

    // 成功した場合の処理（例: メッセージを表示）
    // echo "従業員データを正常に登録しました。";
    header("Location: ../login.php");
    exit;
} catch (PDOException $e) {
    // エラーが発生した場合の処理
    die("従業員データの登録に失敗しました: " . $e->getMessage());
    header("Location: ../signup.php");
    exit;
}
