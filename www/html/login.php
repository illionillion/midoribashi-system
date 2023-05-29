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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>

    <main>
        <div class="container">
            <div class="login-form">
                <h2>ログイン画面</h2>
                <form action="/api/auth.php" method="POST">
                    <div class="form-group">
                        <label for="employee-id">ログインID</label>
                        <input type="text" id="employee-id" name="employee-id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="employee-password">パスワード</label>
                        <input type="password" id="employee-password" name="employee-password" class="form-control" required>
                    </div>
                    <input type="submit" value="ログイン">
                </form>
            </div>
        </div>
    </main>
</body>

</html>