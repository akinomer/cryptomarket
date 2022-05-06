<?php

include('vt.php');

$images = $db->customQuery('SELECT crypto_img FROM currencies ORDER BY id ASC')->getAll();

foreach ($images as $key => $value) {
    $imgUrl = $value->crypto_img;
    echo $imgUrl."\n";
    $imgBaseName = basename(explode('?',$value->crypto_img)[0]);
    //exec('curl '.$imgUrl.' --output '.$imgBaseName);
}

?>