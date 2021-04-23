<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login']) == false) {
    echo 'ようこそゲスト様' . "<br>";
    echo '<a href="../member_login.html">会員ログイン</a><br>';
} else {

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

        if (isset($_SESSION['cart']) == true) {
            $cart = $_SESSION['cart'];
            $kazu = $_SESSION['kazu'];
            $max = count($cart);
        } else {
            $max = 0;
        }

        if ($max == 0) {
            echo 'カートに商品が入っておりません。<br>';
            echo '<a href="shop_list.php">商品一覧へ戻る</a>';
            exit;
        }


        // 接続するデータベースの情報
        $dsn = 'mysql:dbname=shop; host=localhost';
        $user = 'root';
        $password = 'root';

        // データベースに接続開始
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach ($cart as $key => $value) {

            //既に登録済み
            $sql = 'SELECT * FROM mst_product WHERE ID=?';
            $stmt = $pdo->prepare($sql);
            $data[0] = $value;
            $stmt->execute($data);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $pro_name[] = $result['NAME'] ?? '';
            $pro_price[] = $result['PRICE'] ?? '';

            if (($result['GAZOU'] ?? '') == '') {
                $pro_gazou[] = '';
            } else {
                $pro_gazou[] = "<img src=\"../yasai/$result[GAZOU]\">";
            }
        }
        $pdo = null;
    } catch (Exception $e) {
        echo "ただいま障害により大変ご迷惑をおかけしております。";
        exit();
    }


    ?>

    カートの中身<br>
    <form method="post" action="kazu_change.php">
        <table border="1">
            <tr>
                <td>商品</td>
                <td>商品画像</td>
                <td>価格</td>
                <td>数量</td>
                <td>小計</td>
                <td>削除</td>
            </tr>

            <?php for ($i = 0; $i < $max; $i++) : ?>
                <tr>
                    <td><?= $pro_name[$i]; ?></td>
                    <td><?= $pro_gazou[$i]; ?></td>
                    <td><?= $pro_price[$i]; ?></td>
                    <td><input type="text" name="kazu<?= $i; ?>" value="<?= $kazu[$i]; ?>"></td>
                    <td><?= $pro_price[$i] * $kazu[$i]; ?>円</td>
                    <td><input type="checkbox" name="sakujo<?= $i; ?>"></td>
                </tr>
                <input type="hidden" name="pro_name<?= $i; ?>" value="<?= $pro_name[$i]; ?>">
            <?php endfor; ?>
        </table>
        <input type="hidden" name="max" value="<?= $max; ?>">
        <input type="submit" value="数量変更">
        <input type="button" onclick="history.back()" value="戻る">
    </form>
    <a href="shop_form.html">ご購入手続へ進む</a>
</body>

</html>