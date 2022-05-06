function changeContent(el){
    var teks = el.textContent;
    var tip = el.parentNode.parentNode.previousElementSibling.id.split('-')[1];
    for(var i=0; i < 3; i++){
        var deger = el.parentNode.parentNode.previousElementSibling.nextElementSibling.children[0].children[i].textContent;
        if(deger==teks){
            el.parentNode.parentNode.previousElementSibling.nextElementSibling.children[0].children[i].classList.add('active')
        }else{
            el.parentNode.parentNode.previousElementSibling.nextElementSibling.children[0].children[i].classList.remove('active')
        }
    }

    if(tip=='alis'){
        localStorage.setItem("fonksiyonel-alis", teks);
    }else{
        localStorage.setItem("fonksiyonel-satis", teks);
    }
    $.get("fonksiyoneltablolar.php?f="+teks+"&tip="+tip, function(data, status){
        $('#fonksiyon-'+tip).html(data);
    });
}

function alisHesapla(){
    var demand_miktar = $('#demand_miktar').val();
    var demand_price = $('#demand_price').val();
    $('#demand_toplam').val(numberWithCommas((parseFloat(demand_miktar)*parseFloat(demand_price)).toFixed(2)));
}

function satisHesapla(){
    var demand_miktar = $('#demand_miktar').val();
    var demand_price = $('#demand_price').val();
    $('#demand_toplam').val(numberWithCommas((parseFloat(demand_miktar)*parseFloat(demand_price)).toFixed(2)));
}

function bakiyeModalOpen(){
    document.querySelector('jsuites-modal').modal.open();
}

$('#bakiye_tanimla').click(bakiyeModalOpen);

/*$(document).on('keyup', '#piyasa_toplam_tl', function() {
    var yaklasik_btc_miktari = parseFloat($('#yaklasik_btc_miktari').val());
    $('#piyasa').val(parseFloat($(this).val()) / yaklasik_btc_miktari);
});*/

$(document).on('click', '#piyasa_plus', function() {
    var tip = $(this).parents('.col-md-9').attr('id').split('-')[1];
    console.log(tip);
    if(tip=='satis'){
        localStorage.setItem('curr_miktar',$('.alis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#yaklasik_btc_miktari').val(parseFloat($('.alis-emri-td')[0].textContent));
        $('#fonksiyon-'+tip).find('#piyasa_toplam_tl').val(parseFloat($('#balanceAmount').html()));
        $('#fonksiyon-'+tip).find('#piyasa').val((parseFloat($('#balanceAmount').html()) / parseFloat($('.satis-emri-td')[0].textContent)).toFixed(6));
    }else{
        localStorage.setItem('curr_miktar',$('.satis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#piyasa_toplam_tl').val(parseFloat($('#balanceAmount').html()));
        $('#fonksiyon-'+tip).find('#yaklasik_btc_miktari').val(parseFloat($('.satis-emri-td')[0].textContent));
        $('#fonksiyon-'+tip).find('#piyasa').val((parseFloat($('#balanceAmount').html()) / parseFloat($('.satis-emri-td')[0].textContent)).toFixed(6));
    }
});


$(document).on('click', '.limit_plus', function() {
    localStorage.setItem('curr_miktar',$('.alis-emri-td')[0].textContent);
    var tip = $(this).parents('.col-md-9').attr('id').split('-')[1];
    if(tip=='satis'){
        var satis_emri = parseFloat($('.alis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#demand_price').val(satis_emri);
        $('#fonksiyon-'+tip).find('#demand_miktar').val(parseFloat($('#balanceAmount').html()));
        $('#fonksiyon-'+tip).find('#demand_toplam').val((parseFloat($('#balanceAmount').html()) / satis_emri).toFixed(6));
    }else{
        var alis_emri = parseFloat($('.satis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#demand_price').val($('.satis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#demand_miktar').val(parseFloat($('#balanceAmount').html()));
        $('#fonksiyon-'+tip).find('#demand_toplam').val((parseFloat($('#balanceAmount').html()) / alis_emri).toFixed(6));
    }
});

$(document).on('click', '#stoploss_stop_plus', function() {
    var tip = $(this).parents('.col-md-9').attr('id').split('-')[1];

    if(tip=='satis'){
        localStorage.setItem('curr_miktar',$('.alis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#stoploss_stop').val($('.alis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#stoploss_limit').val($('.alis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#stoploss_miktar').val((parseFloat($('#balanceAmount').html()) / parseFloat($('.alis-emri-td')[0].textContent)).toFixed(6));
        $('#fonksiyon-'+tip).find('#stoploss_toplam').val(parseFloat($('#balanceAmount').html()));
    }else{
        localStorage.setItem('curr_miktar',$('.satis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#stoploss_stop').val($('.satis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#stoploss_limit').val($('.satis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#stoploss_miktar').val((parseFloat($('#balanceAmount').html()) / parseFloat($('.satis-emri-td')[0].textContent)).toFixed(6));
        $('#fonksiyon-'+tip).find('#stoploss_toplam').val(parseFloat($('#balanceAmount').html()));
    }
});

$(document).on('click', '#stoploss_miktar_plus', function() {
    var tip = $(this).parents('.col-md-9').attr('id').split('-')[1];
    if(tip=='satis'){
        localStorage.setItem('curr_miktar',$('.alis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#stoploss_stop').val($('.alis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#stoploss_limit').val($('.alis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#stoploss_miktar').val((parseFloat($('#balanceAmount').html()) / parseFloat($('.alis-emri-td')[0].textContent)).toFixed(6));
        $('#fonksiyon-'+tip).find('#stoploss_toplam').val(parseFloat($('#balanceAmount').html()));
    }else{
        localStorage.setItem('curr_miktar',$('.satis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#stoploss_stop').val($('.satis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#stoploss_limit').val($('.satis-emri-td')[0].textContent);
        $('#fonksiyon-'+tip).find('#stoploss_miktar').val((parseFloat($('#balanceAmount').html()) / parseFloat($('.satis-emri-td')[0].textContent)).toFixed(6));
        $('#fonksiyon-'+tip).find('#stoploss_toplam').val(parseFloat($('#balanceAmount').html()));
    }

});

$(document).on('click', '#alis_btn', function() {
    
    var arr = {};
    var emir_islem_tip = '', degerler='';
    var flag_err = 0;
    
    var ids = $('#fonksiyon-alis input[id]').map(function() {
        return this.id;
    }).get();
    
    for(var i=0; i<ids.length; i++){
        if($('#fonksiyon-alis #'+ids[i]).val()==''){
            flag_err = 1;
            jSuites.notification({
                error: 1,
                name: 'Hata Mesaji',
                message: 'Lutfen form bilgilerini duzenli bir sekilde doldurunuz',
            })
        }
    }
    
    if(flag_err===0){
        for(var i=0; i<ids.length; i++){
            arr[ids[i]] = $('#fonksiyon-alis #'+ids[i]).val();
        }

        degerler = JSON.stringify(arr);

        var butonlar = $('#fonksiyon-alis').next().children().children();
        for(var i=0; i<butonlar.length; i++){
            if(butonlar[i].className.indexOf('active')>-1){
                emir_islem_tip = butonlar[i].textContent;
            }
        }

        $.post("dashboard.php?tip=emir_ekle", {
            user_id: localStorage.getItem('user_id'),
            emir_islem_tip: emir_islem_tip,
            emir_tip: 'alis',
            degerler: degerler,
            curr_tip: orderbook_parity.getText(),
            curr_miktar: localStorage.getItem('curr_miktar')
        }, function(result){
            alert('Eklendi');
        });
    }
    
    
});

$(document).on('click', '#satis_btn', function() {
    var arr = {};
    var emir_islem_tip = '', degerler='';
    var flag_err = 0;
    var ids = $('#fonksiyon-satis input[id]').map(function() {
        return this.id;
    }).get();
    
    for(var i=0; i<ids.length; i++){
        if($('#fonksiyon-satis #'+ids[i]).val()==''){
            flag_err = 1;
            jSuites.notification({
                error: 1,
                name: 'Hata Mesaji',
                message: 'Lutfen form bilgilerini duzenli bir sekilde doldurunuz',
            })
        }
    }
    
    if(flag_err===0){
        
        for(var i=0; i<ids.length; i++){
            arr[ids[i]] = $('#fonksiyon-satis #'+ids[i]).val();
        }
        
        degerler = JSON.stringify(arr);
    
        var butonlar = $('#fonksiyon-satis').next().children().children();
        for(var i=0; i<butonlar.length; i++){
            if(butonlar[i].className.indexOf('active')>-1){
                emir_islem_tip = butonlar[i].textContent;
            }
        }

        $.post("dashboard.php?tip=emir_ekle", {
            user_id: localStorage.getItem('user_id'),
            emir_islem_tip: emir_islem_tip,
            emir_tip: 'satis',
            degerler: degerler,
            curr_tip: orderbook_parity.getText(),
            curr_miktar: localStorage.getItem('curr_miktar')
        }, function(result){
            alert('Eklendi');
        });
    }
    
    
});


$(document).on('click', '.btn-group .btn', function() {
    var carpan = parseInt($(this).html().replace('%','')) / 100;
    var balanceAmount = parseFloat($('#balanceAmount').html())*carpan;
    var tip = $(this).parents('.col-md-9').attr('id').split('-')[1];
    console.log(localStorage.getItem('fonksiyonel-'+tip))
    console.log(carpan)
    if(localStorage.getItem('fonksiyonel-'+tip)=='Limit'){
        $('#fonksiyon-'+tip).find('#demand_miktar').val(balanceAmount);
        var demand_price = $('#fonksiyon-'+tip).find('#demand_price').val();
        $('#fonksiyon-'+tip).find('#demand_toplam').val(parseFloat($('#fonksiyon-'+tip).find('#demand_miktar').val()) / parseFloat(demand_price))
    }else if(localStorage.getItem('fonksiyonel-'+tip)=='Piyasa'){

    }else{
        var anlikdeger = (parseFloat($('#balanceAmount').html()) / parseFloat($('.alis-emri-td')[0].textContent)) * carpan;
        $('#fonksiyon-'+tip).find('#stoploss_miktar').val(anlikdeger);
        $('#fonksiyon-'+tip).find('#stoploss_toplam').val($('#fonksiyon-'+tip).find('#stoploss_limit').val()*anlikdeger);
    }
});

$('[id^=line_alis_]').click(function() {
    $('html, body').animate({
        scrollTop: $("#tabs").offset().top-100
    }, 1000);
    var id = $(this)[0].id;
    var cryp_val = $('#'+id).find('td')[0].textContent;
    localStorage.setItem('curr_miktar', cryp_val);
    var cryp_miktar = parseFloat($('#balanceAmount').html());
    $("#satis_tab").click();
    for(var i=0; i < 3; i++){
        var deger = document.getElementsByClassName('btn-group-vertical')[1].children[i];
        if(deger.className.indexOf('active')>-1){
            console.log(deger.textContent);
            if(deger.textContent=='Limit'){
                var satis_toplam = cryp_miktar / parseFloat(cryp_val);
                console.log(cryp_miktar);
                console.log(parseFloat(cryp_val));
                $('#fonksiyon-satis').find('#demand_price').val(cryp_val);
                $('#fonksiyon-satis').find('#demand_miktar').val(cryp_miktar);
                $('#fonksiyon-satis').find('#demand_toplam').val(satis_toplam);
            }else if(deger.textContent=='Piyasa'){
                $('#fonksiyon-satis').find('#piyasa_toplam_tl').val($('#'+id).find('td')[2].textContent);
                $('#fonksiyon-satis').find('#yaklasik_btc_miktari').val($('#'+id).find('td')[1].textContent);
                $('#fonksiyon-satis').find('#piyasa').val($('#'+id).find('td')[0].textContent);
            }else{
                $('#fonksiyon-satis').find('#stoploss_stop').val(cryp_val);
                $('#fonksiyon-satis').find('#stoploss_limit').val(cryp_val);
                $('#fonksiyon-satis').find('#stoploss_miktar').val(parseFloat($('#balanceAmount').html()));
                $('#fonksiyon-satis').find('#stoploss_miktar').attr('placeholder',orderbook_parity.getText().split('_')[0]+' Miktar');
                $('#fonksiyon-satis').find('#stoploss_toplam').val(parseFloat($('#balanceAmount').html()) / cryp_val);
            }
        }
    }
});

$('[id^=line_satis_]').click(function() {
    $('html, body').animate({
        scrollTop: $("#tabs").offset().top-100
    }, 1000);
    var id = $(this)[0].id;
    var cryp_val = $('#'+id).find('td')[0].textContent;
    localStorage.setItem('curr_miktar', cryp_val);
    var cryp_miktar = parseFloat($('#balanceAmount').html());
    $("#alis_tab").click();
    for(var i=0; i < 3; i++){
        var deger = document.getElementsByClassName('btn-group-vertical')[0].children[i];
        if(deger.className.indexOf('active')>-1){
            console.log(deger.textContent);
            if(deger.textContent=='Limit'){
                var satis_toplam = cryp_miktar / parseFloat(cryp_val);
                $('#fonksiyon-alis').find('#demand_price').val(cryp_val);
                $('#fonksiyon-alis').find('#demand_miktar').val(cryp_miktar);
                $('#fonksiyon-alis').find('#demand_toplam').val(satis_toplam);
            }else if(deger.textContent=='Piyasa'){
                console.log($('#'+id).find('td')[2].textContent);
                $('#fonksiyon-alis').find('#piyasa_toplam_tl').val($('#'+id).find('td')[2].textContent);
                $('#fonksiyon-alis').find('#yaklasik_btc_miktari').val($('#'+id).find('td')[1].textContent);
                $('#fonksiyon-alis').find('#piyasa').val($('#'+id).find('td')[0].textContent);
            }else{
                $('#fonksiyon-alis').find('#stoploss_stop').val(cryp_val);
                $('#fonksiyon-alis').find('#stoploss_limit').val(cryp_val);
                $('#fonksiyon-alis').find('#stoploss_miktar').val(parseFloat($('#balanceAmount').html()));
                $('#fonksiyon-alis').find('#stoploss_miktar').attr('placeholder',orderbook_parity.getText().split('_')[0]+' Miktar');
                $('#fonksiyon-alis').find('#stoploss_toplam').val(parseFloat($('#balanceAmount').html()) / cryp_val);
            }
        }
    }

});

var orderbook_parity = jSuites.dropdown(document.getElementById('orderbook'), {
    url: 'dashboard.php?search=true',
    remoteSearch: true,
    autocomplete: true,
    lazyLoading: true,
    width:'100%'
});

$( document ).ready(function() {
    
    
    $('.jtabs-controls').remove();
    $('.nomics-ticker-widget-footer').remove();
    $('.nomics-ticker-widget-embedded.nomics-ticker-widget-size-responsive').css('max-width','100%');

    for(var i=0; i < 3; i++){
        document.getElementsByClassName('btn-group-vertical')[0].children[i].classList.add('group-alis-sag-butonlar')
    }
    for(var i=0; i < 3; i++){
        document.getElementsByClassName('btn-group-vertical')[1].children[i].classList.add('group-satis-sag-butonlar')
    }
    document.getElementsByClassName('btn btn-default form-control')[0].parentNode.parentNode.children[0].classList.add('group-satis-sag-butonlar')
    document.getElementsByClassName('btn btn-default form-control')[1].parentNode.parentNode.children[0].classList.add('group-alis-sag-butonlar')
    localStorage.setItem("fonksiyonel-alis", "Limit");
    localStorage.setItem("fonksiyonel-satis", "Limit");


    //dropdown.selectIndex(0);
    var ask_hacim=0;
    var bid_hacim=0;
    var html_alis = ``;
    var html_satis = ``;
    var interval = setInterval(function(){
        $.get("https://www.binance.com/api/v3/depth?symbol=BTCTRY&limit=15", function(data, status){
            for(var i=0; i< 15; i++){
                var ask_alis = data.asks[i][0];
                var ask_fiyat = data.asks[i][1];
                var ask_toplam = ask_alis * ask_fiyat;
                ask_hacim += ask_toplam;
                html_alis =  `<td class="alis-emri-td">`+parseFloat(ask_alis).toFixed(2)+`</td>
                      <td>`+parseFloat(ask_fiyat).toFixed(8)+`</td>
                      <td>`+ask_toplam.toFixed(2)+`</td>
                      <td>`+ask_hacim.toFixed(6)+`</td>
                  `;
                $('#line_alis_'+i).html(html_alis);

                var bid_alis = data.bids[i][0];
                var bid_fiyat = data.bids[i][1];
                var bid_toplam = bid_alis * bid_fiyat;
                bid_hacim += bid_toplam;
                html_satis =  `<td class="satis-emri-td">`+parseFloat(bid_alis).toFixed(2)+`</td>
                      <td>`+parseFloat(bid_fiyat).toFixed(8)+`</td>
                      <td>`+bid_toplam.toFixed(2)+`</td>
                      <td>`+bid_hacim.toFixed(6)+`</td>
                  `;
                $('#line_satis_'+i).html(html_satis);
            }  

        });
    }, 1500);


    orderbook_parity.selectIndex(0);

    orderbook_parity.options.onchange = function() {
        clearInterval(interval);
        var newParity = orderbook_parity.getText().replace('_','');
        var sol = orderbook_parity.getText().split('_')[0];
        var sag = orderbook_parity.getText().split('_')[1];

        changeParity(newParity);

        $('#fonksiyon-satis').find('#stoploss_miktar').attr('placeholder',sol+' Miktar');
        $('#fonksiyon-alis').find('#stoploss_miktar').attr('placeholder',sol+' Miktar');

        $('#fonksiyon-satis').find('#demand_toplam').attr('placeholder','Miktar ('+sol+')');
        $('#fonksiyon-alis').find('#demand_toplam').attr('placeholder','Miktar ('+sol+')');

        //$('iframe').attr("src","https://widget.nomics.com/assets/"+sol+"/"+sag+"/")
        $('.toplam').html(sag);
        $('.fiyat').html(sag);
        $('.hacim').html(sag);
        $('.miktar').html(sol);
        var saydir = 0;
        interval = setInterval(function(){
            saydir++;
            
            $.get("https://www.binance.com/api/v3/depth?symbol="+newParity+"&limit=15", function(data, status){
                for(var i=0; i< 15; i++){
                    var ask_alis = data.asks[i][0];
                    var ask_fiyat = data.asks[i][1];
                    var ask_toplam = ask_alis * ask_fiyat;
                    ask_hacim += ask_toplam;
                    html_alis =  `<td class="alis-emri-td">`+parseFloat(ask_alis).toFixed(2)+`</td>
                          <td>`+parseFloat(ask_fiyat).toFixed(8)+`</td>
                          <td>`+ask_toplam.toFixed(2)+`</td>
                          <td>`+ask_hacim.toFixed(6)+`</td>
                      `;
                    $('#line_alis_'+i).html(html_alis);

                    var bid_alis = data.bids[i][0];
                    var bid_fiyat = data.bids[i][1];
                    var bid_toplam = bid_alis * bid_fiyat;
                    bid_hacim += bid_toplam;
                    html_satis =  `<td class="satis-emri-td">`+parseFloat(bid_alis).toFixed(2)+`</td>
                          <td>`+parseFloat(bid_fiyat).toFixed(8)+`</td>
                          <td>`+bid_toplam.toFixed(2)+`</td>
                          <td>`+bid_hacim.toFixed(6)+`</td>
                      `;
                    $('#line_satis_'+i).html(html_satis);
                } 
                var balanceAmount = $('#balanceAmount').html();
                if(saydir==1){
                    $('#bakiye_tanimla').before('<b>'+(balanceAmount / $('#line_satis_1 td').html()).toFixed(6)+'</b> <small>BTC<br>tahmini miktar</small>');
                    $('#bakiye_tanimla').prev().remove()
                    $('#bakiye_tanimla').prev().remove()
                }
            });
        }, 1500);

        var i = 0;
        var curr_interval = setInterval(function(){
            if($('#line_satis_1 td:eq(0)').html()!='undefined'){
                i++;
                if(i>=6){
                   clearInterval(curr_interval);
                   var balanceAmount = $('#balanceAmount').html();
                    $('#btc_bakiye').html('<b>'+(balanceAmount / parseFloat($('#line_satis_1 td:eq(0)').html())).toFixed(6)+'</b> <small>'+sol+'<br>tahmini miktar</small>');
                }
            }
            console.log($('#line_satis_1 td:eq(0)').html());
        },500);

    }
    var i = 0;
    var curr_interval = setInterval(function(){
        if($('#line_satis_1 td:eq(0)').html()!='undefined'){
            i++;
            if(i>=6){
               clearInterval(curr_interval);
               var balanceAmount = $('#balanceAmount').html();
                $('#btc_bakiye').html('<b>'+(balanceAmount / parseFloat($('#line_satis_1 td:eq(0)').html())).toFixed(6)+'</b> <small>BTC<br>tahmini miktar</small>');
            }
        }
        console.log($('#line_satis_1 td:eq(0)').html());
    },500);
});



var price = 0;
var market = '';
var curr = '';
var coin_id = '';

/*var orderbook_parity = jSuites.dropdown(document.getElementById('orderbook'), {
    data:<?=json_encode($datax)?>,
    width:'100%',
    autocomplete:true
});*/



/*var dropdown = jSuites.dropdown(document.getElementById('dropdown'), {
    data:<?=json_encode($data)?>,
    width:'100%',
    autocomplete: true,
    onchange: function() {
        jSuites.loading.show();

        $('.tv-lightweight-charts').remove();

        $.get("markets.php?coinId="+dropdown.getValue(), function(data, status){
            if(data!=''){
                jSuites.loading.hide();

                if(data=='0'){
                    $('#icerik').html("Herhangi bir veriye ulasilamadi.");
                }else{
                    price = data.split('|')[0];
                    market = data.split('|')[1];
                    curr = data.split('|')[2];
                    coin_id = data.split('|')[3];
                    $('#icerik').html("<img class='curr_icon' src='"+$(".jdropdown-selected img")[0].src+"'> <b>"+price+"</b> <small>"+curr+"</small>");
                    $.get("https://api.coingecko.com/api/v3/coins/"+coin_id+"/market_chart?vs_currency=try&days=1&interval=hourly", function(bilgi, status){
                        var jsonData = [];
                        var myObj = {};
                        for(var i=0; i<bilgi.prices.length;i++){
                            //console.log(i+':'+bilgi.prices[i][1]);
                            //create object
                            var date = Math.round((bilgi.prices[i][0]+10800000) / 1000);
                            if(i+1==bilgi.prices.length){
                                myObj = {
                                    "time" : date,    //your artist variable
                                    "value" : bilgi.prices[i][1]//price.replace(',','')   //your title variable
                                };
                            }else{
                                myObj = {
                                    "time" : date,    //your artist variable
                                    "value" : bilgi.prices[i][1]   //your title variable
                                };
                            }

                            //push the object to your array
                            jsonData.push( myObj );
                        }
                        if(coin_id=='bitcoin'){
                            var balanceAmount = $('#balanceAmount').html();
                            $('#btc_bakiye').html('<b>'+(balanceAmount / bilgi.prices[bilgi.prices.length-1][1].toFixed(2)).toFixed(8)+'</b> <small>BTC<br>tahmini miktar</small>');
                        }

                        $('.curr_icon').after(" <b>"+numberWithCommas(bilgi.prices[bilgi.prices.length-1][1].toFixed(2))+'</b> <small>TRY</small> ');
                        console.log(jsonData);
                        var chart = LightweightCharts.createChart(document.getElementById('chart'), {
                            width: $('.jdropdown-header').width(),
                            localization: {
                                locale: 'tr-TR',
                            },
                            height: 300,
                                  layout: {
                                          backgroundColor: '#ffffff',
                                          textColor: 'rgba(33, 56, 77, 1)',
                                  },
                                  grid: {
                                          vertLines: {
                                            color: 'rgba(197, 203, 206, 0.7)',
                                          },
                                          horzLines: {
                                            color: 'rgba(197, 203, 206, 0.7)',
                                          },
                                  },
                                  timeScale: {
                                    timeVisible: true,
                                    secondsVisible: false,
                                  },
                          });
                        chart.timeScale().fitContent();

                        var lineSeries = chart.addLineSeries();

                        lineSeries.setData(jsonData);
                    });

                }


            }

        });
   }
});
*/
var tabs = jSuites.tabs(document.getElementById('tabs'), {
    animation: true,
    allowCreate: false,
    allowChangePosition: true,
    padding: '10px',
});

/*
var emirler = jSuites.tabs(document.getElementById('emirler'), {
    animation: true,
    allowCreate: false,
    allowChangePosition: true,
    padding: '10px',
});

emirler.options.data[0].titleElement.style.width = '33%';
emirler.options.data[1].titleElement.style.width = '33%';
emirler.options.data[2].titleElement.style.width = '33%';
*/

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

!(function($) {
	"use strict";
	var a = {
		accordionOn: ["xs"]
	};
	$.fn.responsiveTabs = function(e) {
		var t = $.extend({}, a, e),
			s = "";
		return (
			$.each(t.accordionOn, function(a, e) {
				s += " accordion-" + e;
			}),
			this.each(function() {
				var a = $(this),
					e = a.find("> li > a"),
					t = $(e.first().attr("href")).parent(".tab-content"),
					i = t.children(".tab-pane");
				a.add(t).wrapAll('<div class="responsive-tabs-container" />');
				var n = a.parent(".responsive-tabs-container");
				n.addClass(s),
					e.each(function(a) {
						var t = $(this),
							s = t.attr("href"),
							i = "",
							n = "",
							r = "";
						t.parent("li").hasClass("active") && (i = " active"),
							0 === a && (n = " first"),
							a === e.length - 1 && (r = " last"),
							t
								.clone(!1)
								.addClass("accordion-link" + i + n + r)
								.insertBefore(s);
					});
				var r = t.children(".accordion-link");
				e.on("click", function(a) {
					a.preventDefault();
					var e = $(this),
						s = e.parent("li"),
						n = s.siblings("li"),
						c = e.attr("href"),
						l = t.children('a[href="' + c + '"]');
					s.hasClass("active") ||
						(s.addClass("active"),
						n.removeClass("active"),
						i.removeClass("active"),
						$(c).addClass("active"),
						r.removeClass("active"),
						l.addClass("active"));
				}),
					r.on("click", function(t) {
						t.preventDefault();
						var s = $(this),
							n = s.attr("href"),
							c = a.find('li > a[href="' + n + '"]').parent("li");
						s.hasClass("active") ||
							(r.removeClass("active"),
							s.addClass("active"),
							i.removeClass("active"),
							$(n).addClass("active"),
							e.parent("li").removeClass("active"),
							c.addClass("active"));
					});
			})
		);
	};
})(jQuery);

$(".responsive-tabs").responsiveTabs({
	accordionOn: ["xs", "sm"]
});
