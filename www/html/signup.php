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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>

    <main>
        <div class="container">
            <div class="login-form">
                <h2>従業員登録画面</h2>
                <form action="./api/register.php" method="POST">
                    <div class="form-group">
                        <label for="employee-id">従業員ID</label>
                        <input type="text" minlength="6" pattern="^[a-zA-Z0-9]+$" id="employee-id" name="employee-id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="employee-name">従業員名</label>
                        <input type="text" minlength="2" id="employee-name" name="employee-name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="employee-tel">電話番号</label>
                        <input type="tel" pattern="\d{2,4}-?\d{2,4}-?\d{3,4}" id="employee-tel" name="employee-tel" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="employee-email">メール</label>
                        <input type="email" id="employee-email" name="employee-email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="employee-password">パスワード</label>
                        <input type="password" minlength="6" maxlength="12" id="employee-password" name="employee-password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="employee-authority">権限</label>
                        <select id="employee-authority" name="employee-authority" class="form-control" required>
                            <option value="0">管理者</option>
                            <option value="1">一般</option>
                        </select>
                    </div>
                    <input type="submit" value="登録">
                </form>
            </div>
        </div>
    </main>
</body>

</html>