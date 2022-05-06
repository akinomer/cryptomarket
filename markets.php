<?php
include('vt.php');

//coins/id/tickers
//https://api.coingecko.com/api/v3/coins/ethereum/tickers


function getMarketPrice($coinId){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.coingecko.com/api/v3/coins/'.$coinId.'/tickers');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


    $headers = array();
    $headers[] = 'Accept: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    return $result;
    
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
}


$get_coin_id = $db->customQuery('SELECT coin_id FROM coins WHERE name="'.$_GET['coinId'].'" OR symbol="'.$_GET['coinId'].'" OR coin_id="'.$_GET['coinId'].'"')->getRow();
$cisin = getMarketPrice($get_coin_id->coin_id);
//echo $cisin;
$markets = json_decode($cisin,1)['tickers'];
$curr_price = array();
$crypt_name = array();
$curr_target = array();

for($i=0;$i < count($markets);$i++){
    if($markets[$i]['target']=='USD'){// || $markets[$i]['target']=='USDT' || $markets[$i]['target']=='TRY'
        $curr_price[] = $markets[$i]['last'];
        $crypt_name[] = $markets[$i]['market']['name'];
        $curr_target[] = $markets[$i]['target'];
    }
}

if(count($curr_price)!=0){
    //echo '<pre>'.print_r($curr_price,1)."</pre>";
    //echo '<pre>'.print_r($crypt_name,1)."</pre>";
    $max = array_search(max($curr_price), $curr_price);
    //echo '<hr>';
    $min = array_search(min($curr_price), $curr_price);
    echo number_format(trim($curr_price[$max]),2).'|'.$crypt_name[$max].'|'.$curr_target[$max]."|".$get_coin_id->coin_id;  
}else{
    echo count($curr_price);
}





/*$dom = new DomQuery($html);

$links = $dom->xpath('(//table)[1]');

echo $links->getOuterHtml();*/









