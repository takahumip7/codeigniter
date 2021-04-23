<?php

session_start();
session_regenerate_id(true);
if (isset($_SESSION['login'])==false) {
    echo 'ログインされておりません。<br>';
    echo '<a href="../staff_login_staff_login.html">ログイン画面へ</a>';
    exit;
}

if (isset($_POST['disp'])==true) {
    if (isset($_POST['staffid'])==false) {
        header('Location:staff_ng.php');
        exit;
    }
    header('Location:staff_disp.php?id=' . $_POST['staffid']);
    exit;
}

if (isset($_POST['add'])==true) {
    header('Location:staff_add.php');
    exit;
}


if (isset($_POST['edit'])==true) {
    if (isset($_POST['staffid'])==false) {
        header('Location:staff_ng.php');
        exit;
    }
    header('Location:staff_edit.php?id=' . $_POST['staffid']);
    exit;
}
if (isset($_POST['delete'])==true) {
    if (isset($_POST['staffid'])==false) {
        header('Location:staff_ng.php');
        exit;
    }
    header('Location:staff_delete.php?id=' . $_POST['staffid']);
    exit;
}
