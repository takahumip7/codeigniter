<?php

session_start();
session_regenerate_id(true);
if (isset($_SESSION['login'])==false) {
    echo 'ログインされておりません。<br>';
    echo '<a href="../staff_login_staff_login.html">ログイン画面へ</a>';
    exit;
}

if (isset($_POST['disp'])==true) {
    if (isset($_POST['proid'])==false) {
        header('Location:pro_ng.php');
        exit;
    }
    header('Location:pro_disp.php?id=' . $_POST['proid']);
    exit;
}

if (isset($_POST['add'])==true) {
    header('Location:pro_add.php');
    exit;
}


if (isset($_POST['edit'])==true) {
    if (isset($_POST['proid'])==false) {
        header('Location:pro_ng.php');
        exit;
    }
    header('Location:pro_edit.php?id=' . $_POST['proid']);
    exit;
}
if (isset($_POST['delete'])==true) {
    if (isset($_POST['proid'])==false) {
        header('Location:pro_ng.php');
        exit;
    }
    header('Location:pro_delete.php?id=' . $_POST['proid']);
    exit;
}
