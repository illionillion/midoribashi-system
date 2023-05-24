<?php include './components/importComponents.php' ?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>従業員登録画面</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/header.css">
</head>

<body>

    <main>
        <div class="container">
            <div class="login-form">
                <h2>従業員登録画面</h2>
                <form action="./api/register.php" method="POST">
                    <div class="form-group">
                        <label for="employee-id">従業員ID</label>
                        <input type="text" minlength="6" pattern="^[a-zA-Z0-9]+$" id="employee-id" name="employee-id" required>
                    </div>
                    <div class="form-group">
                        <label for="employee-name">従業員名</label>
                        <input type="text" minlength="2" id="employee-name" name="employee-name" required>
                    </div>
                    <div class="form-group">
                        <label for="employee-tel">電話番号</label>
                        <input type="tel" pattern="\d{2,4}-?\d{2,4}-?\d{3,4}" id="employee-tel" name="employee-tel" required>
                    </div>
                    <div class="form-group">
                        <label for="employee-email">メール</label>
                        <input type="email" id="employee-email" name="employee-email" required>
                    </div>
                    <div class="form-group">
                        <label for="employee-password">パスワード</label>
                        <input type="password" minlength="6" maxlength="12" id="employee-password" name="employee-password" required>
                    </div>
                    <p><a href="./login.php">登録済みの場合はこちら</a></p>
                    <input type="submit" value="登録">
                </form>
            </div>
        </div>
    </main>
</body>

</html>