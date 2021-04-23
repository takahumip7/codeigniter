<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
    echo 'ログインされていません。' . "<br>";
    echo '<a href="../staff_login/staff_login.html">ログイン画面へ</a>';
    exit();
} else {
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
    $staff_id = $post['id'];
    $staff_name = $post['name'];
    $staff_pass = $post['pass'];
    $staff_pass2 = $post['pass2'];

    if ($staff_name == '') {
        echo 'スタッフ名が入力されていません。' . "\n";
    } else {
        echo 'スタッフ名:' . $staff_name . "\n";
    }
    if ($staff_pass == '') {
        echo 'パスワードが入力されていません。' . "\n";
    }
    if ($staff_pass != $staff_pass2) {
        echo 'パスワードが一致しません。' . "\n";
    }
    if ($staff_name == '' || $staff_pass == '' || $staff_pass != $staff_pass2) {
        echo '<form><input type="button" onclick="history.back()" value="戻る"></form>' . "\n";
    } else {
        echo '<form method="post" action="staff_edit_done.php">';
        echo '<div class=”element_wrap”>';
        echo '<input type="hidden" name="id" value="' . $staff_id . '"></div>';
        echo '<div class=”element_wrap”>';
        echo '<input type="hidden" name="name" value="' . $staff_name . '"></div>';
        echo '<div class=”element_wrap”>';
        echo '<input type="hidden" name="pass" value="' . $staff_pass . '"></div>';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '<input type="submit" value="OK"></form>';
    }

    ?>
</body>

</html>