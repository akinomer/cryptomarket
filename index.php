<?php include('vt.php');

if($_SESSION['login']==true){
    header('Location: dashboard.php');
}

if($_GET['type']=='regMember'){
    $data = [
        'parola'    =>  md5($_POST['parola']),
        'email'     =>  $_POST['e_posta'],
        'ad_soyad'  =>  $_POST['ad_soyad'],
        'reg_date'  =>  date('Y-m-d H:i:s')
    ];
    $db->table('members')->insert($data);
    exit;
}

if($_GET['type']=='loginMember'){
    $sql = 'SELECT COUNT(*) AS toplam, id, ad_soyad FROM members WHERE email="'.$_POST['e_posta'].'" AND parola="'.md5($_POST['parola']).'" GROUP BY id';
    $sonuc = $db->customQuery($sql)->getRow();
    if($sonuc->toplam==0){
        echo '0';
    }else{
        echo $sonuc->id;
        $_SESSION['login'] = true;
        $_SESSION['email'] = $_POST['e_posta'];
        
    }
    exit;
}

?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" type="image/png" href="https://cpwebassets.codepen.io/assets/favicon/apple-touch-icon-5ae1a0698dcc2402e9712f7d01ed509a57814f994c660df9f7a952f3060705ee.png" />
    <meta name="apple-mobile-web-app-title" content="CodePen">
    <link rel="shortcut icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/favicon-aec34940fbc1a6e787974dcd360f2c6b63348d4b1f4e06c77743096d55480f33.ico" />
    <link rel="mask-icon" type="image/x-icon" href="https://cpwebassets.codepen.io/assets/favicon/logo-pin-8f3771b1072e3c38bd662872f6b673a722f4b3ca2421637d5596661b4e2132cc.svg" color="#111" />
    <script src='js/jquery.min.js'></script>
    <script src="js/jsuites.js"></script>
    <link rel="stylesheet" href="css/jsuites.css" type="text/css" />
    <title></title>
<style>
@charset "UTF-8";
* {
  box-sizing: border-box;
}

body {
  background: #fff;
  font-family: "Rubik", sans-serif;
  margin: 0;
  padding: 0;
}

form,
fieldset {
  border: 0;
  padding: 0;
  margin: 0;
}

.container {
  align-items: center;
  display: flex;
  justify-content: center;
  margin: 50px auto;
  max-width: 1200px;
  width: 100%;
}
@media (max-width: 768px) {
  .container {
    flex-wrap: wrap;
  }
}

.btn {
  align-items: center;
  background: #4d61fc;
  border-radius: 3px;
  border: 0;
  color: #fff;
  cursor: pointer;
  display: flex;
  font-size: 16px;
  padding: 15px 45px;
  transition: 0.2s;
}
.btn:hover {
  background: #2036de;
  transform: translateY(-2px);
}
.btn .fas.fa-arrow-right {
  color: #fff;
  font-size: 12px;
  line-height: 12px;
  margin: 0 0 0 10px;
}

.register,
.login {
  border-radius: 5px;
  box-shadow: 0 7px 30px -10px rgba(150, 170, 180, 0.5);
  height: auto;
  max-width: 400px;
  padding: 40px 15px;
  text-align: center;
  width: 100%;
}
.register .fas,
.login .fas {
  color: #4d61fc;
  font-size: 35px;
  margin-bottom: 5px;
}
.register strong,
.login strong {
  color: #2f2f2f;
  display: block;
  font-size: 40px;
}
.register span,
.login span {
  color: #2f2f2f;
}
.register .create-account,
.login .create-account {
  border-top: 1px solid #e2e2e2;
  display: flex;
  justify-content: center;
  margin-top: 30px;
  padding-top: 30px;
}
.register .create-account strong,
.login .create-account strong {
  font-size: 16px;
  margin-left: 5px;
  text-decoration: underline;
}

.register,
.login {
  background: #fff;
}
.register .form,
.login .form {
  margin-top: 30px;
  padding: 0 20px;
}
.register .form .form-row,
.login .form .form-row {
  position: relative;
  text-align: left;
}
.register .form .form-row .fas,
.login .form .form-row .fas {
  font-size: 15px;
  position: absolute;
  right: 10px;
  top: 30px;
}
.register .form .form-row.bottom,
.login .form .form-row.bottom {
  display: flex;
  justify-content: space-between;
}
.register .form .form-row.bottom .forgot,
.login .form .form-row.bottom .forgot {
  color: #4d61fc;
}
.register .form .form-row.button-login,
.login .form .form-row.button-login {
  margin-top: 50px;
}
.register .form .form-row.button-login .fas,
.login .form .form-row.button-login .fas {
  position: static;
}
.register .form .form-row .form-check input[type=checkbox] + label,
.login .form .form-row .form-check input[type=checkbox] + label {
  color: #555;
  cursor: pointer;
  display: block;
}
.register .form .form-row .form-check input[type=checkbox],
.login .form .form-row .form-check input[type=checkbox] {
  display: none;
}
.register .form .form-row .form-check input[type=checkbox] + label:before,
.login .form .form-row .form-check input[type=checkbox] + label:before {
  border-radius: 3px;
  border: 1px solid #e2e2e2;
  color: transparent;
  content: "✔";
  display: inline-block;
  height: 15px;
  margin-right: 5px;
  transition: 0.2s;
  vertical-align: bottom;
  width: 15px;
  line-height: 16px;
  font-size: 12px;
  text-align: center;
}
.register .form .form-row .form-check input[type=checkbox] + label:active:before,
.login .form .form-row .form-check input[type=checkbox] + label:active:before {
  transform: scale(1.1);
}
.register .form .form-row .form-check input[type=checkbox]:checked + label:before,
.login .form .form-row .form-check input[type=checkbox]:checked + label:before {
  background-color: #4d61fc;
  border-color: #4d61fc;
  color: #fff;
}
.register .form .form-label,
.login .form .form-label {
  color: #555;
  font-size: 12px;
}
.register .form-password,
.register .form-text,
.login .form-password,
.login .form-text {
  border-radius: 2px;
  border: 0;
  height: 40px;
  margin-bottom: 20px;
  padding: 0 40px 0 10px;
  width: 100%;
  background: #f1f1f1 no-repeat;
  transition: 100ms all linear 0s;
  background-image: linear-gradient(109.6deg, #7412cb 11.2%, #e62e83 91.2%);
  background-size: 0 2px, 100% 1px;
  background-position: 50% 100%, 50% 100%;
  transition: background-size 0.3s cubic-bezier(0.64, 0.09, 0.08, 1);
}
.register .form-password:focus,
.register .form-text:focus,
.login .form-password:focus,
.login .form-text:focus {
  background-size: 100% 2px, 100% 1px;
  outline: none;
}

.register {
  transform: scale(1.01);
  background-image: linear-gradient(109.6deg, #7412cb 11.2%, #e62e83 91.2%);
}
.register .fas,
.register strong {
  color: #fff;
}
.register .form .form-label {
  color: #fff;
}
.register .form .form-row .fas {
  color: #4d61fc;
}
.register .form .form-row .button-login {
  margin-top: 20px;
}
.register .btn-login {
  background: #fff;
  color: #555;
}
.register .btn-login .fas.fa-arrow-right {
  color: #555;
}
.register .btn-login:hover {
  background: #d5d7de;
}
.register .create-account {
  color: #fff;
}
.register .social-media {
  color: #fff;
  font-size: 20px;
  margin-top: 10px;
}
.register .social-media .fab {
  margin: 0 3px;
}
</style>


</head>

<body translate="no" >
  <!-- 
Front-End Design (pure css)
Ui Design
www.cupcom.com.br
-->

<link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

<main>
  <section class="container">
    <!-- login -->
    <div class="login">

      <i class="fas fa-sign-in-alt"></i>
      <strong>Hos Geldiniz!</strong>
      <span>Hesabiniza giris yapabilirsiniz</span>

      <form id='login'>
        <fieldset>
          <div class="form">
            <div class="form-row">
              <i class="fas fa-user"></i>
              <label class="form-label" for="input" >E-Posta adresiniz</label>
              <input type="text" class="form-text" name="e_posta" placeholder="e-posta adresinizi giriniz">
            </div>
            <div class="form-row">
              <i class="fas fa-eye"></i>
              <label class="form-label" for="input">Parolaniz</label>
              <input type="password" class="form-text" name="parola" placeholder="parolanizi giriniz">
            </div>
            <div class="form-row bottom">
              <div class="form-check">
                <input type="checkbox" id="remenber" name="remember" value="remember">
                <label for="remenber">Beni hatirla</label>
              </div>
                <a href="" class="forgot"><small>Parolanizi mi unuttunuz?</small></a>
            </div>
            <div class="form-row button-login">
                <button type="button" id="loginbtn" class="btn btn-login">Giris Yap <i class="fas fa-arrow-right"></i></button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>

    <!-- register -->
    <div class="register">
      <i class="fas fa-user-circle"></i>
      <strong>Hesap Olustur!</strong>
      <form id="register">
        <fieldset>
          <div class="form">
            <div class="form-row">
              <i class="fas fa-user"></i>
              <label class="form-label" for="input" >Adiniz ve Soyadiniz</label>
              <input type="text" class="form-text" name="ad_soyad" placeholder="Adiniz ve Soyadinizi giriniz">
            </div>
            <div class="form-row">
              <i class="fas fa-envelope"></i>
              <label class="form-label" for="input">E-Posta Adresiniz</label>
              <input type="email" class="form-text" name="e_posta" placeholder="E-Posta adresinizi giriniz">
            </div>
            <div class="form-row">
              <i class="fas fa-lock"></i>
              <label class="form-label" for="input">Parolaniz</label>
              <input type="password" class="form-text" name="parola" placeholder="Parolanizi giriniz">
            </div>
            <div class="form-row">
              <i class="fas fa-lock"></i>
              <label class="form-label" for="input">Parola Tekrar</label>
              <input type="password" class="form-text" name="parola_tekrar" placeholder="Parolanizi giriniz">
            </div>
            <div class="form-row button-login">
                <button type="button" id="registerbtn" class="btn btn-login">Hesabimi Olustur <i class="fas fa-arrow-right"></i></button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </section>
</main>
<script>
    
    function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }
    
    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
    
    $('#loginbtn').click(function() {
        var regFormVals = getFormData($('#login'));
        console.log(regFormVals);
        if(validateEmail(regFormVals['e_posta'])==false || regFormVals['e_posta']==''){
            jSuites.notification({
                error: 1,
                name: 'Hata Mesaji',
                message: 'Lutfen gecerli bir e-posta adresi giriniz',
            })
        }else if(regFormVals['parola']==''){
            jSuites.notification({
                error: 1,
                name: 'Hata Mesaji',
                message: 'Lutfen parolanizi belirtiniz',
            })
        }else{
            $.post("index.php?type=loginMember",
                regFormVals
            ,
            function(data, status){
                if(data==0){
                    jSuites.notification({
                        error: 1,
                        name: 'Hata Mesaji',
                        message: 'Yanlis kullanici adi yada parola girdiniz',
                    })
                }else{
                    localStorage.setItem('user_id', data);
                    jSuites.notification({
                        name: 'Tebrikler!',
                        message: 'Sayfaniza yonlendiriliyorsunuz',
                    });
                    setTimeout(function(){ location.href = 'dashboard.php'; }, 3000);
                }
            });
        }
    });
    
    $('#registerbtn').click(function() {
        var regFormVals = getFormData($('#register'));
        if(validateEmail(regFormVals['e_posta'])==false || regFormVals['e_posta']==''){
            jSuites.notification({
                error: 1,
                name: 'Hata Mesaji',
                message: 'Lutfen gecerli bir e-posta adresi giriniz',
            })
        }else if(regFormVals['ad_soyad']=='' || regFormVals['ad_soyad'].length < 5){
            jSuites.notification({
                error: 1,
                name: 'Hata Mesaji',
                message: 'Lutfen adinizi ve soyadinizi belirtiniz',
            })
        }
        else if(regFormVals['parola']==''){
            jSuites.notification({
                error: 1,
                name: 'Hata Mesaji',
                message: 'Lutfen parolanizi belirtiniz',
            })
        }
        else if(regFormVals['parola_tekrar']!=regFormVals['parola']){
            jSuites.notification({
                error: 1,
                name: 'Hata Mesaji',
                message: 'Belirtmis oldugunuz parololar eslesmiyor. Lutfen tekrar deneyiniz.',
            })
        }
        else{
            $.post("index.php?type=regMember",
                regFormVals
            ,
            function(data, status){
                jSuites.notification({
                    name: 'Tebrikler!',
                    message: 'Basariyla kaydoldunuz. E-Posta ve Parolaniz ile giris yapabilirsiniz.',
                });
            });
        }
    });
</script>
</body>
</html>
 
