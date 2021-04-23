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

        $pro_id = $_GET['proid'];

        if (isset($_SESSION['cart']) == true) {
            $cart = $_SESSION['cart'];
            $kazu = $_SESSION['kazu'];
            if (in_array($pro_id, $cart) == true) {
                echo 'その商品は既にカートに入っております。<br>';
                echo '<a href="shop_list.php">商品一覧に戻る</a>';
                exit;
            }
        }

        $cart[] = $pro_id;
        $kazu[] = 1;
        $_SESSION['cart'] = $cart;
        $_SESSION['kazu'] = $kazu;
    } catch (Exception $e) {
        echo "ただいま障害により大変ご迷惑をおかけしております。";
        exit();
    }

    ?>

    カートに追加しました。<br>
    <a href="shop_list.php">商品一覧に戻る</a>

</body>

</html>