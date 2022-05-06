<?php

include('vt.php'); 

if($_GET['tip']=='sorgu'){
    $memberInfo = $db->customQuery('Select balance From members Where id="'.$_GET['memberId'].'"')->getRow();
    echo $memberInfo->balance; 
}

if($_GET['tip']=='addBalance'){
    $db->customQuery('Update members Set balance="'.$_POST['balance'].'" Where id='.$_POST['memberId']);
    echo $_POST['balance'];
}

