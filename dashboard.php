<?php include('vt.php'); 


if($_SESSION['login']!=true){
    header('Location: index.php');
}

if($_GET['search']==true){
    $kriptolar = $db->customQuery('SELECT * FROM kriptolar WHERE kripto_adi LIKE "'.$_GET['q'].'%"')->getAll();
    foreach($kriptolar as $key => $value){
        $data[] = [
            'text'  =>  $value->kripto_adi,
            'value' =>  $value->kripto_adi
        ];
    }
    echo json_encode($data);
    exit;
}


if($_GET['tip']=='emir_ekle'){
    $db->table('emirler')->insert($_POST);
    exit;
}

$memberInfo = $db->customQuery('Select * From members Where email="'.$_SESSION['email'].'"')->getRow();

require_once __DIR__.'/vendor/autoload.php';
use Codenixsv\CoinGeckoApi\CoinGeckoClient;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
        <script src='js/jquery.min.js'></script>
        <script src="js/jsuites.js"></script>
        <link rel="stylesheet" href="css/jsuites.css" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
        <script type="text/javascript" src="https://unpkg.com/lightweight-charts@3.4.0/dist/lightweight-charts.standalone.production.js"></script>
        <script src="https://jsuites.net/v4/jsuites.webcomponents.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/json2html/2.1.0/json2html.min.js"></script>
        <style>
            #emirler tbody td{
                vertical-align: middle;
            }
            .tab-pane{
                height: 300px;
            }
            
            [id^="line_alis_"]:hover {
                background-color: #dbeb77 !important;
            }
            
            [id^="line_satis_"]:hover {
                background-color: #e5abb6 !important;
            }
            .baslik{
                font-size: 13px;
            }
            .alis-govde{
                font-size: 12px;
                cursor: pointer;
            }
            .satis-govde{
                font-size: 12px;
                cursor: pointer;
            }
            .jdropdown{
                width: 100%;
            }
            .aralik{
                margin-top: 15px;
            }
            .alis-title{
                color: #96a825;
            }
            .satis-title{
                color: #e84362;
            }
            .alis-tab{
                color: #96a825;
                width: 100% !important;
            }
            .satis-tab{
                color: #e84362;
                width: 100% !important;
            }
            .group-alis-sag-butonlar{
                background-color: #96a825;
                color: white;
            }
            .group-satis-sag-butonlar{
                background-color: #e84362;
                color: white;
            }
            .alis-emri-td{
                color: #96a825;
            }
            .satis-emri-td{
                color: #e84362;
            }
            .jtabs-headers{
                width: 100%;
            }
            .jtabs .jtabs-headers-container{
                width: 99%;
            }
            
            
            @media only screen and (max-width: 600px) {
                .jtabs .jtabs-headers-container{
                    width: 100%;
                }
                .alis-tab{
                    color: #96a825;
                    width: 100% !important;
                }
                .satis-tab{
                    color: #e84362;
                    width: 100% !important;
                }
                .emirtablosu{
                    margin-top: 15px;
                }
            }
        </style>
        <style>
 
.nav-tabs>li {
    width: 25%;
    text-align: center;
    font-weight: bold;
}
.responsive-tabs {
	margin-top: 20px;
}

.responsive-tabs-container .tab-content {
	padding: 10px 20px;
	border: 1px solid #ddd;
	border-top: none;
}

.responsive-tabs-container[class*="accordion-"] .tab-pane {
	margin-bottom: 15px;
}

.responsive-tabs-container[class*="accordion-"] .accordion-link {
	display: none;
	margin-bottom: 10px;
	padding: 10px 15px;
	background-color: #f5f5f5;
	border-radius: 3px;
	border: 1px solid #ddd;
	color: #333;
}

.responsive-tabs-container[class*="accordion-"] .accordion-link.active {
	border-bottom: medium none;
	border-bottom-left-radius: 0;
	border-bottom-right-radius: 0;
	color: #ea4362;
}

@media (max-width: 767px) {
	.responsive-tabs-container.accordion-xs .nav-tabs {
		display: none;
	}

	.responsive-tabs-container.accordion-xs .accordion-link {
		display: block;
	}

	.responsive-tabs-container .tab-content {
		border: none;
                padding: 0px 0px;
	}

	.responsive-tabs-container[class*="accordion-"] .tab-pane {
		border: 1px solid #ddd;
		border-top: none;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		border-width: medium 1px 1px;
		margin-bottom: 10px;
		margin-top: -10px;
		padding: 10px 10px 0;
	}
}

@media (min-width: 768px) and (max-width: 991px) {
	.responsive-tabs-container.accordion-sm .nav-tabs {
		display: none;
	}

	.responsive-tabs-container.accordion-sm .accordion-link {
		display: block;
	}

	.responsive-tabs-container .tab-content {
		border: none;
                padding: 0px 0px;
	}

	.responsive-tabs-container[class*="accordion-"] .tab-pane {
		border: 1px solid #ddd;
		border-top: none;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
		border-width: medium 1px 1px;
		margin-bottom: 10px;
		margin-top: -10px;
		padding: 10px 10px 0;
	}
}

@media (min-width: 992px) and (max-width: 1199px) {
	.responsive-tabs-container.accordion-md .nav-tabs {
		display: none;
	}

	.responsive-tabs-container.accordion-md .accordion-link {
		display: block;
	}
}

@media (min-width: 1200px) {
	.responsive-tabs-container.accordion-lg .nav-tabs {
		display: none;
	}

	.responsive-tabs-container.accordion-lg .accordion-link {
		display: block;
	}
}
        </style>
    </head>
    <body>
        <?php include("navbar.php");?>
        <div class="container-fluid">
            <!--<div class="row" >
                <div class="col-md-12">
                    <div id="dropdown"></div>
                </div>
            </div>-->
            <div class="row" style="margin-top: 100px;">
                <div class="col-md-12">
                    <div id="orderbook">
                   
                    </div>
                </div>
            </div>
            <div class="row aralik">
                <div class="col-md-6">
                    <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container">
                    <div id="tradingview_d3c1b"></div>
                    <div class="tradingview-widget-copyright"></span></a></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                    function changeParity(parity='BTCTRY'){
                        new TradingView.widget(
                        {
                        "width": "100%",
                        "height": "500px",
                        "symbol": "BINANCE:"+parity,
                        "interval": "D",
                        "timezone": "Europe/Moscow",
                        "theme": "light",
                        "style": "1",
                        "locale": "tr",
                        "toolbar_bg": "#f1f3f6",
                        "enable_publishing": false,
                        "withdateranges": true,
                        "allow_symbol_change": true,
                        "container_id": "tradingview_d3c1b"
                        }
                        );
                    }
                    changeParity();
                    </script>
                    </div>
                    <!-- TradingView Widget END -->
                    <!--<div class="nomics-ticker-widget" data-name="Binance Coin" data-base="BTC" data-quote="TRY"></div><script src="https://widget.nomics.com/embed.js"></script>
                    <div id="chart">
                        
                    </div>
                    <div id="icerik" style="text-align: right;"></div>-->
                </div>
                <div class="col-md-6 emirtablosu" style="text-align: center !important;">
                    <div id='tabs' style='width: 101.5%; text-align: center;'>
                        <div>
                            <div id="alis_tab" class="alis-tab">ALIS</div>
                            <div id="satis_tab" class="satis-tab">SATIS</div>
                        </div>
                        <div>
                            <div>
                                <div class="row">
                                    <div class="col-md-9" id="fonksiyon-alis">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <div class="input-group">
                                                        <input placeholder="Fiyat (TRY)" type="text" class="form-control" id="demand_price">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-default limit_plus" type="button">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left;"><small><b>Kendi miktarinizi belirtebilirsiniz</b></small>
                                                    <input onclick="$(this).val('')" onkeyup="alisHesapla()" placeholder="Miktar (BTC)" type="text" class="form-control" id="demand_toplam">
                                                    <div class="btn-group" style="margin-top: 8px;">
                                                        <button type="button" class="btn btn-default">%25</button>
                                                        <button type="button" class="btn btn-default">%50</button>
                                                        <button type="button" class="btn btn-default">%75</button>
                                                        <button type="button" class="btn btn-default">%100</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="input-group">
                                                        <input placeholder="Toplam (TRY)" type="text" class="form-control" id="demand_miktar">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-default limit_plus" type="button">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="btn-group-vertical group-sag-butonlar" style="margin-top: 8px; width: 100%;">
                                            <button onclick="changeContent(this);" type="button" class="btn btn-default form-control active">Limit</button>
                                            <button onclick="changeContent(this);" type="button" class="btn btn-default form-control">Piyasa</button>
                                            <button onclick="changeContent(this);" type="button" class="btn btn-default form-control">Kosul (Stoploss)</button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <button style="background-color: #96a825; color: white;" id="alis_btn" class="btn btn-light form-control">ALIS EMRI VER</button> 
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-md-9" id="fonksiyon-satis">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <div class="input-group">
                                                        <input placeholder="Fiyat (TRY)" type="text" class="form-control" id="demand_price">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-default limit_plus" type="button">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:left;"><small><b>Kendi miktarinizi belirtebilirsiniz</b></small>
                                                    <div class="input-group">
                                                        <input onclick="$(this).val('')" onkeyup="alisHesapla()" placeholder="Miktar (BTC)" type="text" class="form-control" id="demand_toplam">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-default limit_plus" type="button">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                    <div class="btn-group" style="margin-top: 8px;">
                                                        <button type="button" class="btn btn-default">%25</button>
                                                        <button type="button" class="btn btn-default">%50</button>
                                                        <button type="button" class="btn btn-default">%75</button>
                                                        <button type="button" class="btn btn-default">%100</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input placeholder="Toplam (TRY)" type="text" class="form-control" id="demand_miktar">
                                                </td>
                                            </tr>
                                            
                                        </table>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="btn-group-vertical group-sag-butonlar" style="margin-top: 8px; width: 100%;">
                                            <button onclick="changeContent(this);" type="button" class="btn btn-default form-control active">Limit</button>
                                            <button onclick="changeContent(this);" type="button" class="btn btn-default form-control">Piyasa</button>
                                            <button onclick="changeContent(this);" type="button" class="btn btn-default form-control">Kosul (Stoploss)</button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <button style="background-color: #e84362; color: white;" id="satis_btn" class="btn btn-light form-control">SATIS EMRI VER</button> 
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row aralik">
                
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div id="soket">
                        <table class="table table-striped">
                            <thead>
                            <th colspan="4"><span class="alis-title">BEKLEYEN ALIS EMIRLERI</span></th>
                            </thead>
                            <thead class="baslik">
                                <th>Fiyat (<span class="fiyat">TRY</span>)</th>
                                <th>Miktar (<span class="miktar">BTC</span>)</th>
                                <th>Toplam (<span class="toplam">TRY</span>)</th>
                                <th>Toplam Hacim (<span class="hacim">TRY</span>)</th>
                            </thead>
                            <tbody class="alis-govde">
                                <?php for($i=0;$i<15;$i++){ ?>
                                <tr id="line_alis_<?=$i?>"></tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="soket">
                        <table class="table table-striped">
                            <thead>
                            <th colspan="4"><span class="satis-title">BEKLEYEN SATIS EMIRLERI</span></th>
                            </thead>
                            <thead class="baslik">
                                <th>Fiyat (<span class="fiyat">TRY</span>)</th>
                                <th>Miktar (<span class="miktar">BTC</span>)</th>
                                <th>Toplam (<span class="toplam">TRY</span>)</th>
                                <th>Toplam Hacim (<span class="hacim">TRY</span>)</th>
                            </thead>
                            <tbody class="satis-govde">
                                <?php for($i=0;$i<15;$i++){ ?>
                                <tr id="line_satis_<?=$i?>"></tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs responsive-tabs">
                        <li class="active"><a href="#home1">Acik Emirlerim</a></li>
                        <li><a href="#profile1">Emir Gecmisim</a></li>
                        <li><a href="#messages1">Piyasa Gecmisi</a></li>
                        <li><a href="#settings1">Karlilik</a></li>
                    </ul>

                       <div class="tab-content">
                        <div class="tab-pane active" id="home1">
                            <?php
                                $acik_emir = $db->customQuery('SELECT * FROM emirler WHERE status=0 AND user_id='.$memberInfo->id)->getAll();
                                $json_data = json_encode($acik_emir);
                            ?>
                            <table class="table" id="emirler">
                                <thead>
                                    <tr>
                                        <th>Islem</th>
                                        <th>Islem Tipi</th>
                                        <th>Emir Zamani</th>
                                        <th>Kripto Miktar</th>
                                        <th>Degerler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($acik_emir as $key => $value){ ?>
                                    <tr>
                                        <td>
                                            <?php 
                                                if($value->emir_tip=='alis'){
                                                    echo '<button type="button" class="btn btn-sm" style="background-color: #96a825; color: white;">ALIS</button>';
                                                }else{
                                                    echo '<button type="button" class="btn btn-sm" style="background-color: #e84362; color: white;">SATIS</button>';
                                                }
                                            ?>
                                        </td>
                                        <td><?=$value->emir_islem_tip?></td>
                                        <td><?=tarihCevir($value->emir_tarih)?></td>
                                        <td><?=$value->curr_miktar?> <small><?=$value->curr_tip?></small></td>
                                        <td><?=$value->degerler?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="profile1">
                         <p>Profile Content ....</p>
                        </div>

                        <div class="tab-pane" id="messages1">
                         <p>Messages Content .....</p>
                        </div>

                        <div class="tab-pane" id="settings1">
                         <p>Settings Content ....</p>
                        </div>
                       </div>
                </div>
            </div>
        </div>
        <?php
        
            /*$coins = $db->customQuery('SELECT crypto_id, crypto_name, crypto_abbr_name, crypto_img FROM currencies')->getAll();
            //echo '<pre>'.print_r($coins,1)."</pre>";
            foreach($coins as $key => $value){
                $data[] = [
                    'value' =>  seo($value->crypto_abbr_name),
                    'text'  =>  $value->crypto_abbr_name,
                    'image' =>  'curr_images/'.explode('?',basename($value->crypto_img))[0],
                    'title' =>  $value->crypto_name
                ];
            }
            //echo '<pre>'.print_r($data,1)."</pre>";
            $orderbook = file_get_contents('orderbookabbr.txt');

            $patlat = explode("\n", $orderbook);
            for($i=0; $i<count($patlat);$i++){ 
                //$opt_value = str_replace('https://www.binance.com/en/orderbook/','',$patlat[$i]);
                //$opt_text   = str_replace('_','/',$opt_value);
                $datax[] = $patlat[$i];
            }*/
        ?>
        <script src="js/frontend_func.js"></script>
    </body>
</html>
