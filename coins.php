<?php
include('vt.php');
$coins = file_get_contents('orderbookabbr.txt');

$patlat = explode("\n", $coins);

for($i=0; $i<count($patlat);$i++){
  $data = [
      'kripto_adi'    =>   $patlat[$i]
  ];
  
  //echo '<pre>'.print_r($data,1).'</pre>';
  //$db->table('kriptolar')->insert($data);
}