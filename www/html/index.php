<?php 
include './components/importComponents.php';
include './api/connect_db.php';
include './api/session_check.php';

// SELECT文の実行
try {
    $stmt = $pdo->prepare("SELECT order_id, customer_name, create_date, employee_id FROM orders");
    $stmt->execute();
  
    // 結果の取得
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  
  } catch (PDOException $e) {
    // エラーが発生した場合の処理
    die("データの取得に失敗しました: " . $e->getMessage());
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
                <h1>注文一覧</h1>
                <div class="search-box">
                    <input type="search" class="search-input" placeholder="Search...">
                    <input type="submit" value="検索" class="btn btn-primary" />
                    <a class="create-button btn btn-primary" href="/order-create.php">注文書作成</a>
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>注文ID</th>
                        <th>顧客名</th>
                        <th>作成日</th>
                        <th>登録者</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $row) :?>
                        <tr>
                            <td><?= $row["order_id"] ?></td>
                            <td><?= $row["customer_name"] ?></td>
                            <td><?= $row["create_date"] ?></td>
                            <td><?= $row["employee_id"] ?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>