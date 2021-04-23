<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login'])==false) {
    echo 'ログインされていません。'."<br>";
    echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
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
        echo '<form method="post" action="pro_branch.php">';

        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<input type="radio" name="proid" value="'.$result['ID'].'">' ;
            echo $result['NAME'] . '---' ;
            echo $result['PRICE'] . '円' . "<br>";
        }

        /*while(true){
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

        
            if ($result==false) {
                break;
            }
            echo '<input type="radio" name="staffid" value="'.$result['ID'].'">';
            echo $result['NAME'];
        }*/
        echo '<input type="submit" name="disp" value="参照">';
        echo '<input type="submit" name="add" value="追加">';
        echo '<input type="submit" name="edit" value="修正">';
        echo '<input type="submit" name="delete" value="削除">';


    } catch (Exception $e) {
        echo "ただいま障害により大変ご迷惑をおかけしております。";
        exit();
    }

    ?>
    
    <a href="../staff_login/staff_top.php">トップメニューへ</a><br>


</body>

</html>