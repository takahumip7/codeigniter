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

        $staff_id = $_GET['id'];

        // 接続するデータベースの情報
        $dsn = 'mysql:dbname=shop; host=localhost';
        $user = 'root';
        $password = 'root';

        // データベースに接続開始
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //既に登録済み
        $sql = 'SELECT * FROM mst_staff WHERE ID=?';
        $stmt = $pdo->prepare($sql);
        $data[]=$staff_id;
        $stmt->execute($data);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $staff_name=$result['NAME'];

        $pdo = null;

    } catch (Exception $e) {
        echo "ただいま障害により大変ご迷惑をおかけしております。";
        exit();
    }

    ?>

    スタッフ修正<br>
    スタッフID<br>
    <?php echo $staff_id;?><br>
    <form method="post" action="staff_edit_check.php">
    <input type="hidden" name="id" value="<?php echo $staff_id; ?>">
    スタッフ名<br>
    <input type="text" name="name" style="width: 200px" value="<?php echo $staff_name; ?>"><br>
    パスワードを入力してください。<br>
    <input type="password" name="pass" style="width: 100px"><br>
    パスワードをもう1度入力していください。<br>
    <input type="password" name="pass2" style="width: 100px"><br>
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
    </form>

</body>

</html>