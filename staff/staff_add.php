<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login'])==false) {
    echo 'ログインされていません。'."<br>";
    echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
}else{
    echo $_SESSION['staff_name'] . "さんログイン中<br>";
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ろくまる農園</title>
</head>

<body>
    <h1>スタッフ追加</h1>
    <form method="post" action="staff_add_check.php">
        <div class=”element_wrap”>
            <label>スタッフ名</label>
            <input type="text" name="name" style="width: 200px">
        </div>
        <div class=”element_wrap”>
            <label>パスワード</label>
            <input type="password" name="pass" style="width: 100px">
        </div>
        <div class=”element_wrap”>
            <label>パスワード確認</label>
            <input type="password" name="pass2" style="width: 100px">
        </div>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>
</body>

</html>