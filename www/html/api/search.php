<?php
include_once './connect_db.php';
include_once './session_check.php';

// $search_text = 'OCS';

switch ($category) {
    case 'orders':
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE id LIKE CONCAT('%', :search_text, '%') OR customer_name LIKE CONCAT('%', :search_text, '%') OR employee_id LIKE CONCAT('%', :search_text, '%')");
        break;
    case 'employees':
        $stmt = $pdo->prepare("SELECT * FROM employees WHERE id LIKE CONCAT('%', :search_text, '%') OR customer_name LIKE CONCAT('%', :search_text, '%') OR employee_id LIKE CONCAT('%', :search_text, '%')");
        break;

    default:
        break;
}

$stmt->bindParam(':search_text', $search_text);
$stmt->execute();

$search_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// // 結果の処理
// foreach ($search_result as $row) {
//     // 行のデータを使用して必要な処理を行う
// }