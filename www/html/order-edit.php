<?php
include './components/importComponents.php';
include './api/connect_db.php';
include './api/session_check.php';

// 注文IDの取得
$orderId = $_GET['id'];

// 注文データの取得
$stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ?");
$stmt->execute([$orderId]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

// 取得した注文データの表示
if ($order) {
    // 注文データが存在する場合の処理
    // echo "注文ID: " . $order['order_id'] . "<br>";
    // echo "顧客名: " . $order['customer_name'] . "<br>";
    // echo "作成日: " . $order['create_date'] . "<br>";
    // 他のカラムも必要に応じて表示する
} else {
    // 注文データが存在しない場合の処理
    echo "指定された注文は存在しません。";
}

if (isset($_GET['error']) && !empty($_GET['error'])) {
    $error_flag = true;
} else {
    $error_flag = false;
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
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/order-page.css">
    <script src="/js/order-create.js"></script>
</head>

<body>

    <?php
    $header = new HeaderComponent('緑橋書店システム');
    $header->render();
    ?>

    <main>
        <div class="container">
            
            <section id="header-contents">
                <h1>注文書内容</h1>
                <form action="/api/order-edit.php" method="post" class="d-flex">
                    <section class="left d-flex flex-column gap-3">
                        <section class="left-head d-flex gap-3">
                            <section class="form-group d-flex justify-content-center align-items-center">
                                <label for="customer-name" class="form-label w-25">
                                    <span class="label-text">顧客名</span>
                                </label>
                                <input type="text" name="customer-name" id="customer-name" class="form-control" value="<?= $order['customer_name'] ?>" required>
                                <span class="sama">様</span>
                            </section>
                            <section class="form-group d-flex justify-content-center align-items-center">
                                <label for="create-date" class="form-label w-50">
                                    <span class="label-text">作成日</span>
                                </label>
                                <input type="date" name="create-date" id="create-date" value="<?= $order['create_date'] ?>" readonly class="form-control">
                            </section>
                        </section>
                        <section class="left-bottom">
                            <section class="form-group d-flex gap-3">
                                <label for="remarks" class="form-label">
                                    <span class="label-text">備考</span>
                                </label>
                                <textarea name="remarks" id="remarks" class="form-control w-75"><?= $order['remarks'] ?></textarea>
                            </section>
                        </section>
                    </section>
                    <section class="right d-flex flex-column gap-2">
                        <div>
                            <a href="/" id="form-cancel" class="btn btn-secondary py-2 px-5">変更を破棄</a>
                            <input type="submit" id="form-submit" value="更新" class="btn btn-success py-2 px-5">
                        </div>
                        <div>
                            <input type="button" id="order-delete" value="注文取消し" class="btn btn-danger py-2 px-5">
                            <input type="button" id="order-delivery" value="納品" class="btn btn-primary py-2 px-5">
                        </div>
                    </section>
                    <input type="hidden" name="table-data" id="table-data" value='<?= $order['table_data'] ?>'>
                    <input type="hidden" name="total-amount" id="total-amount" value="<?= floor($order['total_amount']) ?>">
                    <input type="hidden" name="order-id" id="order-id" value="<?= $_GET['id'] ?>">
                </form>
            </section>
            <section class="form-group d-flex justify-content-center align-items-center py-4 px-2">
                <?php if($error_flag) : ?>
                    <div class="text-danger">注文登録に失敗しました。同じ顧客名が登録されている可能性があります。</div>
                <?php endif; ?>
            </section>
            
            <section id="table-contents">
                <section class="table-controls">
                    <div class="buttons">
                        <input type="button" value="行追加" id="add-row-button" class="btn btn-success py-2 px-5">
                        <input type="button" value="削除" id="remove-row-button" class="btn btn-danger py-2 px-5">
                    </div>
                    <div class="total-amount-view">
                        <span>合計金額</span>
                        <span><?= floor($order['total_amount']) ?></span>
                        <span>円</span>
                    </div>
                </section>
                <table>
                    <thead>
                        <tr>
                            <th>商品ID</th>
                            <th>書籍名</th>
                            <th>数量</th>
                            <th>単価</th>
                            <th>適用</th>
                            <th>納品</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    </tbody>
                </table>
                <template id="table-row-template">
                    <tr>
                        <td>0</td>
                        <td><input type="text" data-row-num="" data-col="name" class="form-control" placeholder="書籍名"></td>
                        <td><input type="number" data-row-num="" data-col="count" class="form-control" min="1" value="1" placeholder="数量"></td>
                        <td><input type="number" data-row-num="" data-col="unit-price" class="form-control" min="0" value="0" placeholder="単価"></td>
                        <td><input type="text" data-row-num="" data-col="application" class="form-control" placeholder="適用"></td>
                        <td><p data-col="isDelivery">未納品</p></td>
                        <td><input type="checkbox" data-row-num="" data-col="checkbox" class=""></td>
                    </tr>
                </template>
            </section>
        </div>
    </main>
</body>

</html>