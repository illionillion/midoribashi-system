<?php
include './components/importComponents.php';
include './api/connect_db.php';
include './api/session_check.php';

try {
    $stmt = $pdo->prepare("select employee_id, employee_name, phone_number, email, role from employees");
    $stmt->execute();
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("データ取得失敗:" . $e->getMessage());
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
                <h1>従業員一覧</h1>
                <form class="search-box" action="/employees-list.php" method="get">
                    <input type="search" name="search_text" class="search-input" placeholder="Search...">
                    <input type="submit" value="検索" class="btn btn-primary" />
                    <a class="create-button btn btn-success" href="/signup.php">従業員登録</a>
                </form>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>従業員ID</th>
                        <th>従業員名</th>
                        <th>電話番号</th>
                        <th>メールアドレス</th>
                        <th>権限</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $row) :?>
                        <tr>
                            <td><?= $row["employee_id"] ?></td>
                            <td><?= $row["employee_name"] ?></td>
                            <td><?= $row["phone_number"] ?></td>
                            <td><?= $row["email"] ?></td>
                            <td><?= $row["role"] == 0 ? "管理者" : "一般" ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>