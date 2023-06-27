<?php
// データベースの接続などの設定
include './components/importComponents.php';
include './api/connect_db.php';
include './api/session_check.php';

// 注文テーブルから顧客名を取得
try {
    // $stmt = $pdo->prepare("SELECT DISTINCT customer_name FROM orders");
    // $stmt = $pdo->prepare("SELECT customer_name, SUM(total_amount) AS total_amount_sum FROM orders GROUP BY customer_name");
    $stmt = $pdo->prepare("SELECT customer_name,
     SUM(total_amount) AS total_amount_sum, 
     AVG(DATEDIFF(delivery_date, create_date)) AS average_lead_time,
     table_data
     FROM orders GROUP BY customer_name;
    ");
    $stmt->execute();
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("データの取得に失敗しました: " . $e->getMessage());
}

function get_read_time ($data) {
    $arr = json_decode($data);
    $totalReadTime = 0;
    $orderCount = count($arr);
    $deliveryDateFlag = true; // 全部データがなかったらtrue
    foreach ($arr as $item) {
        $orderDate = new DateTime($item->{"order-date"});
        $deliveryDate = new DateTime($item->{"delivery-date"});
        $readTime = $deliveryDate->diff($orderDate)->format("%a");
        $totalReadTime += $readTime;

        // echo $item->{"delivery-date"};
        // if ($item->{"delivery-date"} !== "") { // 1個でもデータがあればfalse
        //     $deliveryDate = false;
        // }
    }
    
    // if($orderCount < 1 || $deliveryDateFlag) {
    if($orderCount < 1) {
        return ' - ';
    }

    $averageReadTime = $totalReadTime / $orderCount;
    

    return floor($averageReadTime * 100) / 100;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>緑橋書店システム</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/header.css">
</head>

<body>

    <?php
    $header = new HeaderComponent('緑橋書店システム');
    $header->render();
    ?>

    <main>
        <div class="container">

            <div class="search-header">
                <h1>顧客一覧</h1>
                <div class="search-box">
                    <input type="search" class="search-input" placeholder="Search...">
                    <input type="submit" value="検索" class="btn btn-primary" />
                    <a class="create-button btn btn-success" href="#">顧客登録</a>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>顧客ID</th>
                        <th>顧客名</th>
                        <th>郵便番号</th>
                        <th>住所</th>
                        <th>電話番号</th>
                        <th>FAX</th>
                        <th>累計売上額</th>
                        <th>リードタイム</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($customers as $i => $customer) : ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><a href="#?id=<?= -1 ?>"><?= $customer["customer_name"] ?></a></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?= floor($customer["total_amount_sum"]) ?></td>
                            <td><?=
                                get_read_time($customer["table_data"]);
                                // $customer["average_lead_time"] ? floor($customer["average_lead_time"]) : "-" 
                                ?>日</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>