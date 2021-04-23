<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login'])==false) {
    echo 'ようこそゲスト様'."<br>";
    echo '<a href="../member_login.html">会員ログイン</a><br>';
}else{

    echo $_SESSION['member_name'] . "様<br>";
    echo '<a href="member_logout.php">ログアウト</a><br>';
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

        $pro_id = $_GET['proid'];

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
        $pro_price=$result['PRICE'];
        $pro_gazou_name=$result['GAZOU'];

        $pdo = null;

        if ($pro_gazou_name=='') {
            $disp_gazou='';
        }else {
            $disp_gazou="<img src=\"../yasai/$pro_gazou_name\">";
        }
        echo '<a href="shop_cartin.php?proid=',$pro_id.'">カートにいれる</a><br>';

    } catch (Exception $e) {
        echo "ただいま障害により大変ご迷惑をおかけしております。";
        exit();
    }

    ?>

    商品情報参照<br>
    商品ID<br>
    <?php echo $pro_id;?><br>
    商品名<br>
    <?php echo $pro_name ?><br>
    価格<br>
    <?php echo $pro_price ?><br>
    <?php echo $disp_gazou ?><br>
    <form>
    <input type="button" onclick="history.back()" value="戻る">
    </form>

</body>

</html>