<?php include './components/importComponents.php' ?>

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
                <h1 class="heading">注文一覧</h1>
                <div class="search-box">
                    <input type="search" class="search-input" placeholder="Search...">
                    <input type="submit" value="検索" class="btn btn-primary" />
                </div>
                <!-- <button class="create-button">Create</button> -->
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
                    <tr>
                        <td>Data 1</td>
                        <td>Data 2</td>
                        <td>Data 3</td>
                        <td>Data 4</td>
                    </tr>
                    <tr>
                        <td>Data 5</td>
                        <td>Data 6</td>
                        <td>Data 7</td>
                        <td>Data 8</td>
                    </tr>
                    <tr>
                        <td>Data 9</td>
                        <td>Data 10</td>
                        <td>Data 11</td>
                        <td>Data 12</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>