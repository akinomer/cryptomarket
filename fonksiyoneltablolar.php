<?php
if($_GET['f']=='Limit' && $_GET['tip']=='alis'){
?> 
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
<?php } ?> 
<?php
if($_GET['f']=='Limit' && $_GET['tip']=='satis'){
?> 
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
                    <input onclick="$(this).val('')" onkeyup="alisHesapla()" placeholder="Miktar" type="text" class="form-control" id="demand_toplam">
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
<?php } ?> 
<?php
if($_GET['f']=='Piyasa' && $_GET['tip']=='alis'){
?> 
<table class="table">
    <tr>
        <td><input type="text" placeholder="Piyasa" id="piyasa" class="form-control" disabled></td>
    </tr>
    <tr>
        <td><input type="text" id="yaklasik_btc_miktari" placeholder="Yaklasik Miktar BTC" class="form-control" disabled></td>
    </tr>
    <tr>
        <td>
            <div class="input-group">
                <input type="text" placeholder="Toplam TRY" id="piyasa_toplam_tl" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="piyasa_plus" type="button">
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </span>
            </div>
        </td>
    </tr>
</table>
<?php } ?> 
<?php
if($_GET['f']=='Piyasa' && $_GET['tip']=='satis'){
?> 
<table class="table">
    <tr>
        <td><input type="text" placeholder="Piyasa" id="yaklasik_btc_miktari" class="form-control" disabled>
            
        </td>
    </tr>
    <tr>
        <td>
            <div class="input-group">
                <input type="text" id="piyasa" placeholder="Miktar BTC" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="piyasa_plus" type="button">
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </span>
            </div>
        </td>
    </tr>
    <tr>
        <td><input type="text" id="piyasa_toplam_tl" placeholder="Yaklasik Toplam TRY" class="form-control" disabled></td>
    </tr>
</table>
<?php } ?> 
<?php
if($_GET['f']=='Kosul (Stoploss)' && $_GET['tip']=='satis'){
?> 
<table class="table">
    <tr>
        <td>
            <div class="input-group">
                <input placeholder="Stop" type="text" id="stoploss_stop" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="stoploss_stop_plus" type="button">
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </span>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <input placeholder="Limit" type="text" id="stoploss_limit" class="form-control">
        </td>
    </tr>
    <tr>
        <td style="text-align: left;">
            <div class="input-group">
                <input placeholder="BTC Miktar" type="text" id="stoploss_miktar" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="stoploss_miktar_plus" type="button">
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
            <input type="text" placeholder="Toplam" id="stoploss_toplam" class="form-control">
        </td>
    </tr>
</table>
<?php } ?>
<?php
if($_GET['f']=='Kosul (Stoploss)' && $_GET['tip']=='alis'){
?> 
<table class="table">
    <tr>
        <td>
            <div class="input-group">
                <input placeholder="Stop" type="text" id="stoploss_stop" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="stoploss_stop_plus" type="button">
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </span>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <input placeholder="Limit" type="text" id="stoploss_limit" class="form-control">
        </td>
    </tr>
    <tr>
        <td style="text-align: left;">
            <input placeholder="BTC Miktar" type="text" id="stoploss_miktar" class="form-control">
            
            
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
                <input type="text" placeholder="Toplam" id="stoploss_toplam" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="stoploss_miktar_plus" type="button">
                        <i class="fa fa-plus-circle"></i>
                    </button>
                </span>
            </div>
            
        </td>
    </tr>
</table>
<?php } ?>