<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <title>Departamento de Estágio Fatec Garça</title>
  <link rel="shortcut icon" href="<?=base_url('assets/img/favicon.ico');?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

        <div class="form-signin login">
          <div class="panel periodic-login">
				<span class="atomic-number"></span>
              <div class="panel-body text-center">
                  <p class="element-name"><img  class="img-responsive" src="<?=base_url('assets/img/logo_fatec.png');?>" title="Sistema de Gerenciamento de Estágio"></p>
                  
                  <h5 class="text-center"><strong>Diretoria</strong></h5>
                  
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      <input type="text" class="form-text" required id="txtEmail" value="">
                    <span class="bar"></span>
                    <label>E-mail</label>
                  </div> 
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      <input type="password" class="form-text" required id="txtSenha" value="">
                    <span class="bar"></span>
                    <label>Senha</label>
                  </div>
                  <div id="spAviso"></div>
                  <button id="btnLogar" class="btn col-md-12" data-loading-text="Aguarde...">Entrar</button>
              </div>
              <div class="text-center">
                  <span><strong><a href="javascript:" class="link-esqueceu">Esqueceu a senha?</a></strong></span>
              </div>
              
          </div>
        </div>
		
        <div class="form-signin senha">
          <div class="panel periodic-login">
              <div class="panel-body text-center">
                  <p class="element-name"><img  class="img-responsive" src="<?=base_url('assets/img/logo_fatec.png');?>" title="Sistema de Gerenciamento de Estágio"></p>
                  
                  <h5 class="text-center"><strong>Diretoria</strong></h5>
                  
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      <input type="password" class="form-text" required id="txtNovasenha" value="">
                    <span class="bar"></span>
                    <label>Nova senha</label>
                  </div> 
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      <input type="password" class="form-text" required id="txtSenhaRepete" value="">
                    <span class="bar"></span>
                    <label>Repita a senha</label>
                  </div>
                  <div id="spAvisoSenha"></div>
                  <button id="btnAlterarSenha" class="btn col-md-12" data-loading-text="Aguarde...">Alterar Senha</button>
              </div>
          </div>
        </div>
          
        <div class="form-signin esqueceusenha">
          <div class="panel periodic-login">
              <div class="panel-body text-center">
                  <p class="element-name"><img  class="img-responsive" src="<?=base_url('assets/img/logo_fatec.png');?>" title="Sistema de Gerenciamento de Estágio"></p>
                  
                  <h5 class="text-center"><strong>Diretoria</strong></h5>
                  
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                      <input type="text" class="form-text" required id="txtEmailEsqueceu" value="">
                    <span class="bar"></span>
                    <label>E-mail</label>
                  </div>
                  <div id="spAvisoSenhaEsqueceu"></div>
                  <button id="btnEsqueceuSenha" class="btn col-md-12" data-loading-text="Aguarde...">Reenviar Senha</button>
              </div>
              <div class="text-center">
                  <span><strong><a href="javascript:" class="link-voltar">Voltar</a></strong></span>
              </div>
          </div>
        </div>  
          

      </div>
        
	</div>		
		
        <script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
        <script src="<?=base_url('assets/js/jquery.ui.min.js');?>"></script>
        <script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
		<script src="<?=base_url('assets/js/plugins/icheck.min.js');?>"></script>
		
        <script src="<?=base_url('assets/js/main.js');?>"></script>

      <!-- end: Content -->
      <!-- start: Javascript -->
      
      
   </body>
</html>

<script>
    
    $(document).ready(function(){
		
	$('input').iCheck({
          checkboxClass: 'icheckbox_flat-aero',
          radioClass: 'iradio_flat-aero'
        });
        
        $("#spAviso").hide();
        $("#spAviso").hide();
        $(".senha").hide();
        $(".login").show();
        $(".periodo").hide();
        $(".esqueceusenha").hide();

        $("#btnLogar").click(function(){
           
            var email = $.trim($("#txtEmail").val());
            var senha = $("#txtSenha").val();
           
            $("#spAviso").hide();
            $(".danger").removeClass('danger');
            
            if(email==""){
                
               $("#txtEmail").parent('.form-group').addClass('danger');
               
            }
            if(senha==""){
                
               $("#txtSenha").parent('.form-group').addClass('danger');
               
            }
            if($(".danger").length > 0){
               
               $("#spAviso").html('<strong>Verifique os campos antes de continuar...</strong>').show();
               
            }else{
                
                $("#btnLogar").button('loading');
         
                $.post('<?=base_url('diretoria/dashboard/entrar');?>',
                {'email':email,'senha':senha},
                function(retorno){

                    if(retorno.result==true){

                        if(retorno.ok==1){

                            $(".senha").show();
                            $(".login").hide();
                            $(".periodo").hide();
                            $(".esqueceusenha").hide();

                        }else if(retorno.ok==2){

                            window.location=retorno.url;

                        }    

                        $("#btnLogar").button('reset');

                    }else{

                        $("#spAviso").html("<strong>"+retorno.msg+"</strong>").show()
                        $("#btnLogar").button('reset');

                    }

                },'json');
                
            }
           
        });
        
        $("#btnAlterarSenha").click(function(){
        
            var senha       = $("#txtNovasenha").val();
            var senhaRepete = $("#txtSenhaRepete").val();
            var email       = $("#txtEmail").val();
           
            $("#spAvisoSenha").hide();
            $(".danger").removeClass('danger');
            
            if(email==""){
                
                alert('Ocorreu um erro você será redirecionado para tentar novamente');
                window.location = '<?=base_url('diretoria/dashboard/login');?>';
                
            }
            if(senha==""){
                
               $("#txtNovasenha").parent('.form-group').addClass('danger');
               
            }
            if(senhaRepete==""){
                
               $("#txtSenhaRepete").parent('.form-group').addClass('danger');
               
            }
            if(senha!=senhaRepete){
            
                $("#spAvisoSenha").html('<strong>Senhas não são iguais...</strong>').show();
            
            }
            if($(".danger").length > 0){
               
               $("#spAvisoSenha").html('<strong>Verifique os campos antes de continuar...</strong>').show();
               
            }else{
                
                $("#btnAlterarSenha").button('loading');
                
                $.post('<?=base_url('diretoria/dashboard/primeiro_acesso');?>',
                {'email':email,'senha':senha,'repetesenha':senhaRepete},
                function(retorno){

                    $("#btnAlterarSenha").button('reset');

                    if(retorno.result==true){
                        
                        alert('senha alterado com sucesso');
                        
                        $(".senha").hide();
                        $(".esqueceusenha").hide();
                        $(".periodo").hide();
                        $(".login").show();
                        
                        $("#txtSenha").val('');
                        $("#txtSenha").focus();
                        
                        $("#btnAlterarSenha").button('reset');

                    }else{
                        
                        if(retorno.msg==""){
                            
                            $("#spAviso").html("<strong>Erro ao alterar senha...</strong>").show()
                            
                        }else{
                            
                            $("#spAviso").html("<strong>"+retoro.msg+"</strong>").show()
                            
                        }
                        
                        $("#btnAlterarSenha").button('reset');

                    }

                },'json');
                
            }
        
        });
        
        $("#btnEsqueceuSenha").click(function(){
        
            var email = $.trim($("#txtEmailEsqueceu").val());
            
            if(email==""){
            
                $("#spAvisoSenhaEsqueceu").html('<strong>Campo E-mail em branco...</strong>').show();
            
            }
            if($(".danger").length > 0){
               
               $("#spAvisoSenhaEsqueceu").html('<strong>Verifique os campos antes de continuar...</strong>').show();
               
            }else{
                
                $("#btnEsqueceuSenha").button('loading');
                
                $.post('<?=base_url('diretoria/dashboard/esqueceu_senha');?>',
                {'email':email},
                function(retorno){
                    
                    if(retorno==true){
                        
                        alert('Redefinição de senha enviada para o E-mail');
                        $('.link-voltar').trigger('click');
                        $("#btnEsqueceuSenha").button('reset');
                        
                    }else{
                        
                        $("#spAvisoSenhaEsqueceu").html('<strong>'+retorno+'</strong>').show();
                        $("#btnEsqueceuSenha").button('reset');
                    }
                    
                });
                
            }
        
        
        });
        
        $(".link-esqueceu").click(function(){
        
            $(".senha").hide();
            $(".login").hide();
            $(".esqueceusenha").show();
            $(".periodo").hide();
            $('#txtEmailEsqueceu').val('');
          
        });
    
        $(".link-voltar").click(function(){
        
            $(".senha").hide();
            $(".login").show();
            $(".esqueceusenha").hide();
            $(".periodo").hide();
            $('#txtEmail').val('');
            $('#txtSenha').val('');
          
        });
    
    });
    
</script>   
   