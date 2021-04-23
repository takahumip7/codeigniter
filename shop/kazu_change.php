<?php
session_start();
session_regenerate_id(true);

require_once('../common/common.php');

$error = [];
$post = sanitize($_POST);


$max = $post['max'];
for ($i = 0; $i < $max; $i++) {
    if (!preg_match("/^[0-9]+$/", $post["kazu$i"])) {
        $error[$_POST["pro_name$i"]][] = $_POST["pro_name$i"] . 'の数量に誤りがあります。' . "<br>";
    } elseif ($post['kazu' . $i] < 0 || $post['kazu' . $i] > 10) {
        $error[$_POST["pro_name$i"]][] = $_POST["pro_name$i"] . '数量は必ず1個以上、10個までです。' . "<br>";
    }
    $kazu[] = $post['kazu' . $i];
}

if (!empty($error)) {
    foreach ($error as $rows) {
        foreach ($rows as $value) {
            echo $value;
        }
    }
    echo '<a href="shop_cartlook.php">カートに戻る</a>';
    exit;
}

$cart = $_SESSION['cart'];
for ($i = $max; 0 <= $i; $i--) {
    if (isset($_POST['sakujo' . $i]) == true) {
        array_splice($cart, $i, 1);
        array_splice($kazu, $i, 1);
    }
}
$_SESSION['cart'] = $cart;
$_SESSION['kazu'] = $kazu;
header('Location:shop_cartlook.php');
exit;
