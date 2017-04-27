<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=base_url('assets/img/favicon.ico');?>">
    <title>Departamento de Estágio Fatec Garça</title>
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url('assets/one/css/bootstrap.min.css');?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/font-awesome.min.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/simple-line-icons.css');?>"  />
    <!-- Custom styles for this template -->
    <link href="<?=base_url('assets/one/css/owl.carousel.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/one/css/owl.theme.default.min.css');?>"  rel="stylesheet">
    <link href="<?=base_url('assets/one/css/animate.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/one/css/style.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/one/css/accordion-menu.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/one/css/super-panel.css');?>" rel="stylesheet">
</head>
<body id="page-top">
    
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" style="padding-bottom: 15px;">
        
        <div class="container">
                            
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="margin-top: 20px;">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                <a class="navbar-brand page-scroll" href="#documento" >
                    <img style="max-width: 100px;margin-top: 3px" class="" src="<?=base_url('assets/img/logo_fatec.png');?>" alt="Fatec Garça">
                </a>
            </div>
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                            <li class="hidden">
                                <a href="#documento"></a>
                            </li>
                            <li>
                                <a href="<?=base_url('aluno/estagio');?>">Vagas de Estágio</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#documento">Documentos</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="#contato">Contato</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="<?=base_url('diretoria');?>">Diretoria</a>
                            </li>
                            <li>
                                <a href="<?=base_url('supervisor');?>">Supervisor de Estágio</a>
                            </li>
                            <li>
                                <?=$html;?>
                            </li>
                    </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
			<!-- /.container-fluid -->
		</nav>
		<!-- Header -->
		<header>
			<div class="container-fluid">
				<div class="slider-container">

				</div>
			</div>
		</header>


		<section id="documento" class="light-bg">
                    
                    <div class="container">
                            
                        <div class="row">

                            <div class="col-md-12 text-center">
                                <div class="section-title">
                                    <h2 style="color: black;">Documentos</h2>
                                </div>
                            </div>

                        </div>
                        
                        <div class="row">
                            
                            <div class="col-md-4">
                                
                                <h3 class="text-center" style="cursor: pointer;" id="inicial"><Strong>Documentos Iniciais</Strong></h3>
                                
                            </div>
                            
                            <div class="col-md-4">
                                
                                <h3 class="text-center" style="cursor: pointer;" id="equivalencia"><Strong>Documentos para Equivalência</Strong></h3>
                                
                            </div>
                            
                            <div class="col-md-4">
                                
                                <h3 class="text-center" style="cursor: pointer;" id="finais"><Strong>Documentos Finais</Strong></h3>
                                
                            </div>
                            
                        </div>
                        	
                    </div>
                    
		</section>

		<section id="contato" class="blue-bg">
                    
                    <div class="container">
                        
                        <div class="row"
                             
                            <div class="col-md-12 text-center">
                                
                                <div class="section-title text-center">

                                    <h2 style="color: white;">Fale com seu Supervisor de Estágio</h2>

                                </div>
                                
                            </div>
                        
                            <div class="row">

                                <div class="col-md-12">
                                    
                                         <div class="row">
                                            
                                            <div class="col-md-12">
                                                
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" placeholder="Digite seu RA" id="txtRAContado" maxlength="13">
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" placeholder="Digite seu Nome" id="txtNome">
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    
                                    
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                
                                                <div class="form-group">
                                                    
                                                    <input type="text" class="form-control" placeholder="Digite o Assunto" id="txtAssunto">
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    
                                        <div class="row">
                                                
                                            <div class="col-md-12">
                                                
                                                <div class="form-group">
                                                    <textarea rows="6" class="form-control" placeholder="Digite uma Mensagem" id="txtMensagem"></textarea>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                
                                                <button id="btnContato" data-loading-text="Aguarde..." class="btn btn-default btn-lg" style="margin-right: 5px;">Enviar</button>
                                                <button id="btnLimpar" class="btn btn-danger btn-lg">Limpar</button><br><br>
                                                <div id="spAviso"></div>
                                            </div>
                                            
                                        </div>
                                        
                                </div>

                            </div>
                             
                    </div>
                        
		</section>
		
<footer>
        <div class="container text-center">
                <p>2016 - Departamento de Estágio Fatec Garça</p>
        </div>
</footer>
                
    <div class="modal fade" tabindex="-1" role="dialog" id="modalInicial">
        
        <div class="modal-dialog">
            
            <div class="modal-content">
              
                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                  <h4 class="modal-title">Documentos Iniciais</h4>

                </div>
              
                <div class="modal-body">

                    <div class="list-group">

                        <li  class="list-group-item"><i class="fa fa-file-word-o"></i><a href="<?=base_url('assets/one/documento/inicial/i1.doc');?>"> 01 - Convênio de Concessão de Estágio</a></li>
                        <li  class="list-group-item"><i class="fa fa-file-word-o"></i><a href="<?=base_url('assets/one/documento/inicial/i2.doc');?>"> 02 - Termo de Compromisso de Estágio</a></li>
                        <li  class="list-group-item"><i class="fa fa-file-word-o"></i><a href="<?=base_url('assets/one/documento/inicial/i3.doc');?>"> 03 - Plano de Atividades de Estágio</a></li>
                        <li  class="list-group-item"><i class="fa fa-file-pdf-o"></i><a href="<?=base_url('assets/one/documento/inicial/seguro.pdf');?>" target="_blank"> Apólice de Seguro</a></li>

                    </div>
                   
                    <div class="text-right">
                    
                        <button type="button" class="btn btn-default btn-danger" data-dismiss="modal" style="margin: 0 10px 10px 0">Fechar</button>
                    
                    </div>
                    
                </div>
              
            </div><!-- /.modal-content -->
          
        </div><!-- /.modal-dialog -->
        
    </div><!-- /.modal --> 
    
    <div class="modal fade" tabindex="-1" role="dialog" id="modalEquivalencia">
        
        <div class="modal-dialog">
            
            <div class="modal-content">
              
                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                  <h4 class="modal-title">Documentos para Equivalência</h4>

                </div>
              
                <div class="modal-body">

                    <div class="list-group">

                        <li  class="list-group-item"><i class="fa fa-file-word-o"></i><a href="<?=base_url('assets/one/documento/equivalencia/e1.doc');?>"> 01 - Processo de Equivalência</a></li>
                        <li  class="list-group-item"><i class="fa fa-file-word-o"></i><a href="<?=base_url('assets/one/documento/equivalencia/e2.doc');?>"> 02 - Plano de Atividades para Equivalência</a></li>
                        <li  class="list-group-item"><i class="fa fa-file-word-o"></i><a href="<?=base_url('assets/one/documento/equivalencia/e3.doc');?>"> 03 - Modelo de Relatório Final Completo</a></li>

                    </div>
                   
                    <div class="text-right">
                    
                        <button type="button" class="btn btn-default btn-danger" data-dismiss="modal" style="margin: 0 10px 10px 0">Fechar</button>
                    
                    </div>
                    
                </div>
              
            </div><!-- /.modal-content -->
          
        </div><!-- /.modal-dialog -->
        
    </div><!-- /.modal -->     
    
    <div class="modal fade" tabindex="-1" role="dialog" id="modalFinais">
        
        <div class="modal-dialog">
            
            <div class="modal-content">
              
                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                  <h4 class="modal-title">Documentos Finais</h4>

                </div>
              
                <div class="modal-body">

                    <div class="list-group">

                        <li  class="list-group-item"><i class="fa fa-file-word-o"></i><a href="<?=base_url('assets/one/documento/final/f1.doc');?>"> 01 - Relatório Final Simplificado</a></li>
                        <li  class="list-group-item"><i class="fa fa-file-word-o"></i><a href="<?=base_url('assets/one/documento/final/f2.doc');?>"> 02 - Relatório para Supervisão de Estágio</a></li>
                        <li  class="list-group-item"><i class="fa fa-file-word-o"></i><a href="<?=base_url('assets/one/documento/final/f3.doc');?>"> 03 - Modelo de Relatório Final Completo</a></li>
                        <li  class="list-group-item"><i class="fa fa-file-word-o"></i><a href="<?=base_url('assets/one/documento/final/f4.doc');?>"> 04 - Ficha de Avaliação de Desempenho do Estagiário</a></li>

                    </div>
                   
                    <div class="text-right">
                    
                        <button type="button" class="btn btn-default btn-danger" data-dismiss="modal" style="margin: 0 10px 10px 0">Fechar</button>
                    
                    </div>
                    
                </div>

            </div><!-- /.modal-content -->
          
        </div><!-- /.modal-dialog -->
        
    </div><!-- /.modal -->
    
    <div class="modal fade" tabindex="-1" role="dialog" id="modalLogin">
        
        <div class="modal-dialog">
            
            <div class="modal-content">
              
                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                  <h4 class="modal-title">Login Aluno</h4>

                </div>
              
                <div class="modal-body">
                    
                    <div class="loginAuno">
                    
                        <div class="col-lg-12" style="margin-top: 10px;">

                            <div class="form-group">

                                <div class="input-group">
                                    <input type="text" maxlength="13" class="form-control" id="txtRA" placeholder="Digite seu RA">
                                    <span for="txtRA" class="input-group-addon "><i class="glyphicon glyphicon-user"></i></span>
                                </div>

                            </div>

                        </div>

                        <div class="col-lg-12">

                            <div class="form-group">

                                <div class="input-group">
                                    <input type="password" class="form-control" id="txtSenha" placeholder="Digite sua Senha">
                                    <span for="txtSenha" class="input-group-addon"><i class=" glyphicon glyphicon-lock"></i></span>
                                </div>

                            </div>

                        </div>

                        <div class="col-lg-2">

                            <div class="form-group">
                                <button type="button" id="btnEntrar" data-loading-text="Aguarde..." onclick="logar()" class="btn btn-default btn-primary">Entrar</button>
                            </div>

                        </div>

                        <div class="col-lg-10">
                            <div id="spAvisoLogin" style="margin-top: 5px;"></div>
                        </div>

                        <div class="col-lg-12">

                            <div class="form-group">
                                <a href="javascript:" id="esqueceuSenha">Esqueceu sua Senha?</a>
                            </div>

                        </div>
                        
                    </div>   
                    
                    <div class="senhaTemporaria" style="display: none;">
                        
                        <div class="col-lg-12" style="margin-top: 10px;">

                            <div class="form-group">

                                <div class="input-group">
                                    <input type="password" class="form-control" id="txtNovaSenha" placeholder="Digite sua Nova Senha">
                                    <span for="txtNovaSenha" class="input-group-addon"><i class=" glyphicon glyphicon-lock"></i></span>
                                </div>

                            </div>

                        </div>
                        
                        <div class="col-lg-12">

                            <div class="form-group">

                                <div class="input-group">
                                    <input type="password" class="form-control" id="txtConfSenha" placeholder="Confirme a Senha">
                                    <span for="txtConfSenha" class="input-group-addon"><i class=" glyphicon glyphicon-lock"></i></span>
                                </div>

                            </div>

                        </div>
                        
                        <div class="col-lg-3">

                            <div class="form-group">
                                <button type="button" onclick="senha_temporaria()" class="btn btn-default btn-primary">Alterar Senha</button>
                            </div>

                        </div>

                        <div class="col-lg-9">
                            <div id="spAvisoSenhaTemporaria" style="margin-top: 5px;"></div>
                        </div>
                        
                    </div>
                    
                    <div class="EsqueceuSenha" style="display: none;">
                        
                        <div class="col-lg-12" style="margin-top: 10px;">

                            <div class="form-group">

                                <div class="input-group">
                                    <input type="text" class="form-control" maxlength="13" id="txtEsqueceuRa" placeholder="Digite seu RA">
                                    <span for="txtEsqueceuRa" class="input-group-addon"><i class=" glyphicon glyphicon-user"></i></span>
                                </div>

                            </div>

                        </div>
                        
                        <div class="col-lg-3">

                            <div class="form-group">
                                <button type="button" onclick="esqueceu_senha()" class="btn btn-default btn-primary">Reenviar Senha</button>
                            </div>

                        </div>

                        <div class="col-lg-9">
                            <div id="spAvisoEsqueceuSenha" style="margin-top: 5px;"></div>
                        </div>
                        
                        <div class="col-lg-12">

                            <div class="form-group">
                                <a href="javascript:" id="VoltarLogin">Voltar</a>
                            </div>

                        </div>
                        
                    </div>
                         
                </div>
            
                    
                <div class="modal-footer">
                    
                    <div class="col-lg-12">
                    
                        <div class="text-right">

                            <button type="button" class="btn btn-default btn-danger" data-dismiss="modal" style="margin: 0 10px 10px 0">Fechar</button>

                        </div>
                        
                    </div>
                    
                </div>

            </div><!-- /.modal-content -->
          
        </div><!-- /.modal-dialog -->
        
    </div><!-- /.modal -->

<script src="<?=base_url('assets/one/js/jquery.min.js');?>"></script>
<script src="<?=base_url('assets/one/js/jquery.easing.min.js');?>"></script>
<script src="<?=base_url('assets/one/js/bootstrap.min.js');?>"></script>
<script src="<?=base_url('assets/one/js/owl.carousel.min.js');?>"></script>
<script src="<?=base_url('assets/one/js/cbpAnimatedHeader.js');?>"></script>
<script src="<?=base_url('assets/one/js/jquery.appear.js');?>"></script>
<script src="<?=base_url('assets/one/js/SmoothScroll.min.js');?>"></script>
<script src="<?=base_url('assets/one/js/theme-scripts.js');?>"></script>
<script src="<?=base_url('assets/one/js/accordion-menu.js');?>"></script>
<script src="<?=base_url('assets/one/js/super-panel.js');?>"></script>
<script src="<?=base_url('assets/js/plugins/jquery.maskMoney.min.js');?>"></script>

</body>
</html>
<script>

    $(document).ready(function(){
    
        $("#txtRA").maskMoney({thousands:'', decimal:'', precision: ''});
        $("#txtRAContado").maskMoney({thousands:'', decimal:'', precision: ''});
        $("#txtEsqueceuRa").maskMoney({thousands:'', decimal:'', precision: ''});
        
        $("#esqueceuSenha").click(function(){
            
            $(".loginAuno").hide();
            $(".senhaTemporaria").hide();
            $(".EsqueceuSenha").show();
            
        });
        
        $("#VoltarLogin").click(function(){
            
            $(".loginAuno").show();
            $(".senhaTemporaria").hide();
            $(".EsqueceuSenha").hide();
            
        });
        
        $("#inicial").click(function(){
           
           $('#modalInicial').modal('show');
           
        });
       
        $("#equivalencia").click(function(){
           
           $('#modalEquivalencia').modal('show');
           
        });
        
        $("#login").click(function(){
           
           limpar_login();
           
           $('#modalLogin').modal('show');
           
        });
       
        $("#finais").click(function(){
           
           $('#modalFinais').modal('show');
           
        });
       
       $("#btnContato").click(function(){
          
          $(".has-error").removeClass("has-error");
          $("#spAviso").hide();
          
          var nome     = $("#txtNome").val();
          var ra       = $.trim($("#txtRAContado").val());
          var assunto  = $("#txtAssunto").val();
          var mensagem = $("#txtMensagem").val();
          
          if(nome==""){
              
              $("#txtNome").parent('.form-group').addClass('has-error');
              
          }
          if(ra==""){
              
              $("#txtRAContado").parent('.form-group').addClass('has-error');
              
          }
          if(assunto==""){
              
              $("#txtAssunto").parent('.form-group').addClass('has-error');
              
          }
          if(mensagem==""){
              
              $("#txtMensagem").parent('.form-group').addClass('has-error');
              
          }
          if($(".has-error").length > 0){
              
               $("#spAviso").css({"color":"white","font-weight":"bold"}).text("Verique os campos que estão em branco...").show();
              
          }else{
              
              $("#btnContato").button('loading');
               
               $.post('<?=base_url('home/email');?>',
               {
                   'ra':ra,
                   'nome':nome,
                   'assunto':assunto,
                   'mensagem':mensagem
               },
                function(retorno){
                  
                  if(retorno==true){
                      
                      $("#spAviso").css({"color":"white","font-weight":"bold"}).text('E-mail enviado com sucesso.').show();
                      $("#btnContato").button('reset');
                      limpar_dados_form();
                      
                  }else{
                      
                      $("#spAviso").css({"color":"white","font-weight":"bold"}).text(retorno).show();
                      $("#btnContato").button('reset');
                      
                  }      
                  
                });
              
          }
          
        });
       
        
       
        $("#btnLimpar").click(function(){
       
            limpar_dados_form();
       
        });
       
       $("#txtRAContado").change(function(){
       
            var ra = $("#txtRAContado").val();

            $.post('<?=base_url('home/verifica_ra');?>',
            {
               'ra':ra,
            },
            function(retorno){

                if(retorno.result==true){

                    $('#btnContato').prop("disabled", false);
                    $("#txtRAContado").attr('disabled','disabled');
                    $("#txtNome").val(retorno.nome).attr('disabled','disabled');
                    $("#txtAssunto").focus();
                
                }else{

                    $("#spAviso").css({"color":"white","font-weight":"bold"}).text(retorno.msg).show();
                    $("#btnContato").attr('disabled','disabled');

                }      

            },'json');
          
       });
    
    });
    
    
    function limpar_dados_form(){
    
        $("#txtRAContado").val('').prop("disabled", false);
        $("#txtNome").val('').prop("disabled", false);
        $("#txtAssunto").val('');
        $("#txtMensagem").val('');
        $('#btnContato').prop("disabled", false);
        
    }
    
    function logar(){
        
        var ra    = $("#txtRA").val();
        var senha = $("#txtSenha").val();
        
        $(".has-error").removeClass("has-error");
        $("#spAvisoLogin").hide();
        
        if(ra==""){
              
            $("#txtRA").parent('.input-group').addClass('has-error');

        }
        if(senha==""){

          $("#txtSenha").parent('.input-group').addClass('has-error');

        }
        if($(".has-error").length > 0){

           $("#spAvisoLogin").css({"color":"red","font-weight":"bold"}).text("Campos em branco...").show();

        }else{

            $("#btnEntrar").button('loading');

            $.post('<?=base_url('home/logar');?>',
            {
               'ra':ra,
               'senha':senha,
            },
            function(retorno){

                if(retorno.result==true){

                    if(retorno.ok==1){
                        
                        $("#btnEntrar").button('reset');
                        
                        $(".loginAuno").hide();
                        $(".EsqueceuSenha").hide();
                        $("#txtSenha").val('');
                        $(".senhaTemporaria").fadeIn("slow");
                        $("#txtNovaSenha").focus();
                        
                    }else{
                        
                        $("#btnEntrar").button('reset');
                        
                        $('#modalLogin').modal('hide');
                        window.location=retorno.url; 
                        
                    }

                }else{

                    $("#spAvisoLogin").css({"color":"red","font-weight":"bold"}).text(retorno.msg).show();
                    
                    $("#btnEntrar").button('reset');
                    
                }      

            },'json');

        }
        
        
        
    }
    
    
    function limpar_login(){
        
        $(".EsqueceuSenha").hide();
        $(".senhaTemporaria").hide();
        $(".loginAuno").show();
        
        $(".has-error").removeClass("has-error");
        $("#spAvisoLogin").hide();
        $("#spAvisoEsqueceuSenha").hide();
        $("#txtRA").val('');
        $("#txtSenha").val('');
        $("#txtNovaSenha").val('');
        $("#txtConfSenha").val('');
        
    }
    
    function senha_temporaria(){
        
        var ra        = $("#txtRA").val();
        var senha     = $("#txtNovaSenha").val();
        var confsenha = $("#txtConfSenha").val();
        
        $(".has-error").removeClass("has-error");
        $("#spAvisoLogin").hide();
        
        if(ra==""){
              
            alert('Erro ao alterar a senha!');
            $("#txtNovaSenha").val('');
            $("#txtConfSenha").val('');
            $('#modalLogin').modal('hide');

        }
        if(senha==""){

          $("#txtNovaSenha").parent('.input-group').addClass('has-error');

        }
        if(confsenha==""){

          $("#txtConfSenha").parent('.input-group').addClass('has-error');

        }
        if(senha!=confsenha){

          $("#spAvisoSenhaTemporaria").css({"color":"red","font-weight":"bold"}).text("Senhas não conferem...").show();

        }
        if($(".has-error").length > 0){

           $("#spAvisoSenhaTemporaria").css({"color":"red","font-weight":"bold"}).text("Campos em branco...").show();

        }else{
            
            $.post('<?=base_url('home/senha_temporaria');?>',
            {
               'ra':ra,
               'senha':senha,
               'senhaconf':confsenha,
            },
            function(retorno){

                if(retorno.error==false){

                    $("#txtNovaSenha").val('');
                    $("#txtConfSenha").val('');
                    $(".EsqueceuSenha").hide();
                    $(".senhaTemporaria").hide();
                    $(".loginAuno").fadeIn("slow");
                    $("#txtSenha").focus();
                
                }else{

                    $("#spAvisoSenhaTemporaria").css({"color":"red","font-weight":"bold"}).text(retorno.msg).show();
                    
                }      

            },'json');
            
        }
        
    }
    
    function esqueceu_senha(){
    
        var ra = $("#txtEsqueceuRa").val();
        
        $(".has-error").removeClass("has-error");
        $("#spAvisoEsqueceuSenha").hide();
        
        if(ra==""){
              
            $("#txtEsqueceuRa").parent('.input-group').addClass('has-error');

        }
        if($(".has-error").length > 0){

           $("#spAvisoEsqueceuSenha").css({"color":"red","font-weight":"bold"}).text("Campo em branco...").show();

        }else{
            
            $.post('<?=base_url('home/esqueceu_senha');?>',
            {
               'ra':ra,
            },
            function(retorno){

                if(retorno==true){

                    alert('Uma senha temporaria foi gerada! Verifique seu e-mail.');
                    $("#txtNovaSenha").val('');
                    $("#txtConfSenha").val('');
                    $("#txtEsqueceuRa").val('');
                    $(".EsqueceuSenha").hide();
                    $(".senhaTemporaria").hide();
                    $(".loginAuno").fadeIn("slow");
                    $("#txtRA").focus();
                
                }else{

                    $("#spAvisoEsqueceuSenha").css({"color":"red","font-weight":"bold"}).text(retorno).show();
                    
                }      

            });
            
        }
    
    }
    
</script>