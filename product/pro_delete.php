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

        $pro_id = $_GET['id'];

        // 接続するデータベースの情報
        $dsn = 'mysql:dbname=shop; host=localhost';
        $user = 'root';
        $password = 'root';

        // データベースに接続開始
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //既に登録済み
        $sql = 'SELECT * FROM mst_product WHERE ID=?';
        $stmt = $pdo->prepare($sql);
        $data[]=$pro_id;
        $stmt->execute($data);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $pro_name=$result['NAME'];
        $pro_gazou_name=$result['GAZOU'];

        $pdo = null;

        if ($pro_gazou_name=='') {
            $disp_gazou='';
        }else {
            $disp_gazou='<img src="./gazou/'.$pro_gazou_name.'">';
        }

    } catch (Exception $e) {
        echo "ただいま障害により大変ご迷惑をおかけしております。";
        exit();
    }

    ?>

    商品削除<br>
    商品ID<br>
    <?php echo $pro_id;?><br>
    商品名<br>
    <?php echo $pro_name;?><br>
    <?php echo $disp_gazou;?><br>
    この商品を削除して宜しいですか？<br>
    <form method="post" action="pro_delete_done.php">
    <input type="hidden" name="id" value="<?php echo $pro_id; ?>">
    <input type="hidden" name="gazou_name" value="<?php echo $pro_gazou_name; ?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
    </form>

</body>

</html>