<?php

require_once('../common/common.php');
$seireki=$_POST['seireki'];

$wareki=gengo($seireki);
echo $wareki;

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>遊び</title>
</head>

<body>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>
</body>

</html>