<?php

$tsuki=$_POST['tsuki'];

$yasai[]='ブロッコリー';
$yasai[]='カリフラワー';
$yasai[]='レタス';
$yasai[]='三つ葉';
$yasai[]='アスパラガス';
$yasai[]='セロリ';
$yasai[]='なす';
$yasai[]='ピーマン';
$yasai[]='オクラ';
$yasai[]='サツマイモ';
$yasai[]='大根';
$yasai[]='ほうれん草';

echo "$tsuki" . '月は' . "$yasai[$tsuki]" . 'が旬です。';

?>