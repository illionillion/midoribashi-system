<?php include './components/importComponents.php' ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/header.css">
</head>

<body>
    <?php
    // $header = new HeaderComponent('緑橋書店システム');
    // $header->render();
    ?>


    <main>
        <div class="container">
            <div class="login-form">
                <h2>ログイン画面</h2>
                <form action="/" method="POST">
                    <div class="form-group">
                        <label for="login-id">ログインID</label>
                        <input type="text" id="login-id" name="login-id" required>
                    </div>
                    <div class="form-group">
                        <label for="password">パスワード</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <p><a href="./signup.php">従業員情報を登録する</a></p>
                    <input type="submit" value="ログイン">
                </form>
            </div>
        </div>
    </main>
</body>

</html>