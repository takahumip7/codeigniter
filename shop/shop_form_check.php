<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>
</head>

<body>

    <?php

    require_once('../common/common.php');

    $post = sanitize($_POST);

    $onamae = $post['onamae'];
    $email = $post['email'];
    $postal = $post['postal'];
    $address = $post['address'];
    $tel = $post['tel'];

    $okflg = true;

    if ($onamae == '') {
        echo 'お名前が入力されていません。<br>';
        $okflg = false;
    } else {
        echo 'お名前:' . $onamae . '<br>';
    }
    if (preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $email) == 0) {
        echo 'メールアドレスを正確に入力してください。<br>';
        $okflg = false;
    } else {
        echo 'メールアドレス:' . $email . '<br>';
    }
    if (preg_match('/^[0-9]{3}-[0-9]{4}$/', $postal) == 0) {
        echo '郵便番号は半角数字で入力してください。<br>';
        $okflg = false;
    } else {
        echo '郵便番号:' . $postal . '<br>';
    }
    if ($address == '') {
        echo '住所が入力されておりません。<br>';
        $okflg = false;
    } else {
        echo '住所:' . $address . '<br>';
    }
    if (preg_match('/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/', $tel) == 0) {
        echo '電話番号を正確に入力してください。<br>';
        $okflg = false;
    } else {
        echo '電話番号:' . $tel . '<br>';
    }
    if ($okflg == true) {

        echo '<form method="post" action="shop_form_done.php">';
        echo '<input type="hidden" name="onamae" value="' . $onamae . '">';
        echo '<input type="hidden" name="email" value="' . $email . '">';
        echo '<input type="hidden" name="postal" value="' . $postal . '">';
        echo '<input type="hidden" name="address" value="' . $address . '">';
        echo '<input type="hidden" name="tel" value="' . $tel . '">';
        echo '<input type="button" onclick="history.back()" value="戻る">';
        echo '<input type="submit" value="OK">';
        echo '</form>';
    } else {
        echo '<form><input type="button" onclick="history.back()" value="戻る"></form>';
    }

    ?>
</body>

</html>