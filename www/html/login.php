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

    <main>
        <div class="container">
            <div class="login-form">
                <h2>ログイン画面</h2>
                <form action="/api/auth.php" method="POST">
                    <div class="form-group">
                        <label for="employee-id">ログインID</label>
                        <input type="text" id="employee-id" name="employee-id" required>
                    </div>
                    <div class="form-group">
                        <label for="employee-password">パスワード</label>
                        <input type="password" id="employee-password" name="employee-password" required>
                    </div>
                    <input type="submit" value="ログイン">
                </form>
            </div>
        </div>
    </main>
</body>

</html>