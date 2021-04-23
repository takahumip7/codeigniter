<?php

try {
    require_once('../common/common.php');

    $post = sanitize($_POST);
    $staff_id=$post['id'];
    $staff_pass=$post['pass'];

    //接続するデータベース
    $dsn='mysql:dbname=shop;host=localhost';
    $user='root';
    $password='root';

    // データベースに接続開始
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //既に登録済み
    $sql = 'SELECT * FROM mst_staff WHERE ID=? AND PASSWORD=?';
    $stmt = $pdo->prepare($sql);
    $data[] = $staff_id;
    $data[] = $staff_pass;
    $stmt->execute($data);

    $pdo=null;

    $result=$stmt->fetch(PDO::FETCH_ASSOC);

    if ($result==false) {
        echo 'スタッフIDかパスワードが間違ってます。<br>';
        echo '<a href="staff_login.html">戻る</a>';
    }else {

        session_start();
        $_SESSION['login']=1;
        $_SESSION['staff_id']=$staff_id;
        $_SESSION['staff_name']=$result['NAME'];

        header('Location:staff_top.php');
        exit;
    }

} catch (Exception $e) {

    echo 'ただいま障害により大変ご迷惑をおかけしております。';
    exit;
}
