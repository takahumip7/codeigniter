<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shop</title>
</head>

<body>

    <?php
    session_start();
    try {

        require_once('../common/common.php');

        $post = sanitize($_POST);

        $onamae = $post['onamae'];
        $email = $post['email'];
        $postal = $post['postal'];
        $address = $post['address'];
        $tel = $post['tel'];

        echo $onamae . '様<br>';
        echo 'ご注文ありがとうございました。<br>';
        echo $email . 'にメールを送りましたのでご確認ください。<br>';
        echo '商品は以下の住所に発送させて頂きます。<br>';
        echo $postal . '<br>';
        echo $address . '<br>';
        echo $tel . '<br>';

        $honbun = '';
        $honbun .= $onamae . "様" . "\n";
        $honbun .= "この度はご注文ありがとうございました。\n";
        $honbun .= "ご注文商品\n";
        $honbun .= "-------------\n";

        $cart = $_SESSION['cart'];
        $kazu = $_SESSION['kazu'];
        $max = count($cart);

        $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
        $user = 'root';
        $password = 'root';
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        for ($i = 0; $i < $max; $i++) {
            $sql = 'SELECT NAME,PRICE FROM mst_product WHERE id=?';
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$cart[$i]]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $name = $result['NAME'];
            $price = $result['PRICE'];
            $kakaku[] = $price;
            $suryo = $kazu[$i];
            $shokei = $price * $suryo;

            $honbun .= $name . '';
            $honbun .= $price . '円 x';
            $honbun .= $suryo . '個=';
            $honbun .= $shokei . "円\n";
        }

        $sql='LOCK TABLES dat_sales WRITE,dat_sales_product WRITE';
        $stmt=$dbh->prepare($sql);
        $stmt->execute();

        $sql = 'INSERT INTO dat_sales(ID_MEMBER,NAME,MAIL,POSTAL,ADDRESS,TEL) VALUES(?,?,?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $data = array();
        $data[] = 0;
        $data[] = $onamae;
        $data[] = $email;
        $data[] = $postal;
        $data[] = $address;
        $data[] = $tel;
        $stmt->execute($data);

        $sql = 'SELECT LAST_INSERT_ID()';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastid = $result['LAST_INSERT_ID()'];

        for ($i = 0; $i < $max; $i++) {
            $sql = 'INSERT INTO dat_sales_product(ID_SALES,ID_PRODUCT,PRICE,QUANTITY) VALUES(?,?,?,?)';
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = $lastid;
            $data[] = $cart[$i];
            $data[] = $kakaku[$i];
            $data[] = $kazu[$i];
            $stmt->execute($data);
        }

        $sql='UNLOCK TABLES';
        $stmt=$dbh->prepare($sql);
        $stmt->execute();

        $dbh = null;

        $honbun .= "送料は無料です。\n";
        $honbun .= "------------\n";
        $honbun .= "代金は以下の口座にお振込ください。\n";
        $honbun .= "ろくまる銀行　野菜支店　普通口座　1234567\n";
        $honbun .= "入金確認が取れ次第、梱包、発送させて頂きます。\n";
        $honbun .= "□□□□□□□□□□□□\n";
        $honbun .= "〜安心野菜のろくまる農園〜\n";
        $honbun .= "○○県六丸郡六丸村123-5\n";
        $honbun .= "電話 090-6060-9999\n";
        $honbun .= "メール info@rokumarunouen.co.jp\n";
        $honbun .= "□□□□□□□□□□□□\n";
        // echo nl2br($honbun);

        $title = 'ご注文ありがとうございます。';
        $header = 'From:info@rokumarunouen.co.jp';
        $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        mb_send_mail($email, $title, $honbun, $header);

        $title = 'お客様からご注文がありました。';
        $header = 'From:' . $email;
        $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        mb_send_mail('info@rokumarunouen.co.jp', $title, $honbun, $header);
    } catch (Exception $e) {
        echo $e->getMessage();
        echo 'ただいま障害により大変ご迷惑をおかけしております。';
    }

    ?>

    <a href="shop_list.php">商品画面へ</a>
</body>

</html>