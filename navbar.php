<style>
.navbar{
  position:fixed;
  width:100%;
  background-color:#f7f7f7;
  z-index:10;
  border-radius:0;
  border-color:transparent;
}
.navbar-default .navbar-nav > li > a{
  color:#000;
  
}
.jmodal_content {
    height:250px;
}
.jmodal{
    height: auto;
}

.navbar-brand {
    float: left;
    height: 50px;
    padding: 2px 35px;
    height: 75px;
    font-size: 18px;
    line-height: 20px;
}
</style>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="#"><img src="img/btconcelogo.jpg" style="width:65%; height: auto;"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right" style="margin-top: 10px;">
            <li><a href="javascript:;" id="btc_bakiye"></a></li>
            <li><a href="javascript:;" id="bakiye_tanimla"><b id="balanceAmount"><?=$memberInfo->balance?></b> <small>TRY</small> <i class="fas fa-plus-circle"></i></a> </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$memberInfo->email?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Kullanici Bilgileri</a></li>
                <li><a href="javascript:;" onclick='bakiyeModalOpen()'>Bakiye Yukle</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="logout.php">Cikis</a></li>
              </ul>
            </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<jsuites-modal title="Bakiye Yukle" closed="true" style='width:600px; height: auto;'>
    <table class="table">
        <tr>
            <td>
                <h7>Mevcut Bakiyeniz</h7>
                <span><b id="mevcutBakiye"><?=$memberInfo->balance?></b> <small>TRY</small></span>
            </td>
        </tr>
        <tr>
            <td><input type="text" id="bakiye_miktar" onkeyup='bakiyeTanimla();' placeholder="Miktari Belirtiniz" data-mask='[-]₺ #.##0,00' class="form-control"></td>
        </tr>
        <tr>
            <td>
                <h7>Bakiyenizde olacak miktar</h7>
                
                <span><b id='bakiyeToplam'></b> <small>TRY</small></span>
            </td>
        </tr>
        <tr>
            <td>
                <button id="bakiyeBtn" type="button" class='btn btn-primary form-control'>Bakiye Ekle</button>
            </td>
        </tr>
    </table>
</jsuites-modal>

<script>
    
    function bakiyeTanimla(){
        $.get("bakiyeSorgu.php?tip=sorgu&memberId=<?=$memberInfo->id?>", function(data, status){
            var bakiye_miktar = $('#bakiye_miktar').val();
            bakiye_miktar = bakiye_miktar.replace('₺ ','').replace('.','');
            $('#bakiyeToplam').html(parseFloat(data)+parseFloat(bakiye_miktar));
        });
    }
    
    document.querySelector('jsuites-modal').addEventListener('onopen', function() {
        $('#bakiye_miktar').val('');
    });
    
    $('#bakiyeBtn').click(function(){
        $.post("bakiyeSorgu.php?tip=addBalance",
        {
            memberId: <?=$memberInfo->id?>,
            balance: $('#bakiyeToplam').html()
        },
        function(data, status){
            $('#mevcutBakiye').html(data);
            $('#balanceAmount').html(data);
            document.querySelector('jsuites-modal').modal.close();
        });
    });
</script>

