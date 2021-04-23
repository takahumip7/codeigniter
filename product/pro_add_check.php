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
    require_once('../common/common.php');

    $post = sanitize($_POST);
    $pro_name = $post['name'];
    $pro_price = $post['price'];
    $pro_gazou = $_FILES['gazou'];

    if ($pro_name == '') {
        echo '商品名が入力されていません。' . "<br>";
    } else {
        echo '商品名:' . $pro_name . "<br>";
    }

    if (!preg_match('/\d/',$pro_price)) {
        echo '価格をきちんと入力してください。' . "<br>";
    }else{
        echo '価格' . $pro_price . '円' . "<br>";
    }

    if ($pro_gazou['size']>0) {
        if ($pro_gazou['size']>1000000) {
            echo '画像が大きすぎます。';
        }else{
            move_uploaded_file($pro_gazou['tmp_name'],'./gazou/'.$pro_gazou['name']);
            echo '<img src="./gazou/'.$pro_gazou['name'].'">' . "<br>";
        }
    }

    if ($pro_name == '' || !preg_match('/\d/' , $pro_price ||$pro_gazou['size']>1000000)) {
        echo '<form><input type="button" onclick="history.back()" value="戻る"></form>' . "<br>";
    } else {
        echo '上記の商品を追加します。<br>';
        echo '<form method="post" action="pro_add_done.php">';
        echo '<div class=”element_wrap”>';
        echo '<input type="hidden" name="name" value="'.$pro_name.'"></div>';
        echo '<div class=”element_wrap”>';
        echo '<input type="hidden" name="price" value="'.$pro_price.'"></div>';
        echo '<div class=”element_wrap”>';
        echo '<input type="hidden" name="gazou_name" value="'.$pro_gazou['name'].'"></div>';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '<input type="submit" value="OK"></form>';
    }

    ?>
</body>

</html>