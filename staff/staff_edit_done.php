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
    <?php

    try {

        require_once('../common/common.php');

        $post = sanitize($_POST);
        $staff_id = $post['id'];
        $staff_name = $post['name'];
        $staff_pass = $post['pass'];

        $staff_name = htmlspecialchars($staff_name, ENT_QUOTES, 'UTF-8');
        $staff_pass = htmlspecialchars($staff_pass, ENT_QUOTES, 'UTF-8');

        //パスワードの暗号化
        $hash_pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

        // 接続するデータベースの情報
        $dsn = 'mysql:dbname=shop; host=localhost';
        $user = 'root';
        $password = 'root';

        // データベースに接続開始
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //既に登録済み
        $sql = 'UPDATE mst_staff SET NAME=?,PASSWORD=? WHERE ID=?';
        $stmt = $pdo->prepare($sql);
        $data[] = $staff_name;
        $data[] = $staff_pass;
        $data[] = $staff_id;
        $stmt->execute($data);

        $pdo = null;

    } catch (Exception $e) {
        echo "ただいま障害により大変ご迷惑をおかけしております。";
        exit;
    }

    ?>

    修正しました。<br>
    <a href="staff_list.php">戻る</a>

</body>

</html>