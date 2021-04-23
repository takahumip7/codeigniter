<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login'])==false) {
    echo 'ようこそゲスト様'."<br>";
    echo '<a href="../member_login.html">会員ログイン</a><br>';
}else{
    echo 'ようこそ';
    echo $_SESSION['member_name'] . "様<br>";
    echo '<a href="../member_logout.php">ログアウト</a><br>';
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
        // 接続するデータベースの情報
        $dsn = 'mysql:dbname=shop; host=localhost';
        $user = 'root';
        $password = 'root';
        // データベースに接続開始
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //既に登録済み
        $sql = 'SELECT * FROM mst_product';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $pdo = null;

        echo "商品一覧". '</br>';

        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<a href="shop_product.php?proid='.$result['ID'].'">' ;
            echo $result['NAME'] . '---' ;
            echo $result['PRICE'] . '円' . "<br>";
        }

        /*while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($result==false){
            break;
            }


            echo '<a href="shop_product.php?proid='.$result['ID'].'">' ;
            echo $result['NAME'] . '---' ;
            echo $result['PRICE'] . '円' . '</a>' ."<br>";
        }*/

        echo "<a href='shop_cartlook.php'>カートを見る</a><br>";

    } catch (Exception $e) {
        echo "ただいま障害により大変ご迷惑をおかけしております。";
        exit();
    }

    ?>

</body>

</html>