<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <title>Departamento de Estágio</title>
  <link rel="shortcut icon" href="<?=base_url('assets/img/icone.png');?>">
  <script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
  <script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.min.css');?>">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/font-awesome.min.css');?>"/>
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/simple-line-icons.css');?>"/>
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/animate.min.css');?>"/>
  <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/icheck/skins/flat/aero.css');?>"/>
  <link href="<?=base_url('assets/css/style.css');?>" rel="stylesheet">
  
  <!-- end: Css -->

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body id="mimin" class="dashboard form-signin-wrapper">

      <div class="container">

        <div class="form-signin">
          <div class="panel periodic-login">
              <div class="panel-body text-center">
                  <p class="element-name"><img  class="img-responsive" src="<?=base_url('assets/img/logo.png');?>" title="Sistema de Gerenciamento de Estágio"></p>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      <input type="text" class="form-text" required id="txtEmail" value="lipe_safreire@hotmail.com">
                    <span class="bar"></span>
                    <label>E-mail</label>
                  </div> 
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      <input type="password" class="form-text" required id="txtSenha" value="safreire">
                    <span class="bar"></span>
                    <label>Senha</label>
                  </div>
                  <button id="btnLogar" class="btn col-md-12">Entrar</button>
              </div>
                <div class="text-center" style="padding:5px;">
                    <a href="#">Esqueceu a senha?</a>
                </div>
          </div>
        </div>

      </div>

      <!-- end: Content -->
      <!-- start: Javascript -->
      
      
   </body>
</html>

<script>
    
    $(document).ready(function(){

        $("#btnLogar").click(function(){
           
           var email = $("#txtEmail").val();
           var senha = $("#txtSenha").val();
           
           if(email==""){
               alert("Campo e-mail vazio!");
           }
           
           if(senha==""){
               alert("Campo senha vazio!");
           }
           
            $("#btnLogar").text("Aguarde");
         
            $.post('<?=base_url('login/entrar');?>',
            {'email':email,'senha':senha},
            function(retorno){

                if(retorno.result==true){
                    window.location = retorno.url;
                    $("#btnLogar").text("Entrar");
                }else{
                    alert(retorno.msg);
                    $("#btnLogar").text("Entrar");
                }
                
            },'json');

        });
    
    });
    
</script>   
   