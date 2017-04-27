<!DOCTYPE html>
<html lang="pt_br">
<head>
	
	<meta charset="utf-8">
	<meta name="keyword" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Departamento de Estágio Fatec Garça - Dashboard Coordenador</title>
 
    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.min.css');?>">

      <!-- plugins -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/font-awesome.min.css');?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/simple-line-icons.css');?>"  />
    <link href="<?=base_url('assets/css/style.css');?>" rel="stylesheet">
    <!-- end: Css -->
    <!-- start: Javascript -->
    <script src="<?=base_url('assets/js/jquery.min.js');?>"></script>
    <script src="<?=base_url('assets/js/jquery.ui.min.js');?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.min.js');?>"></script>
   
    
    <!-- plugins -->
    <script src="<?=base_url('assets/js/plugins/moment.min.js');?>"></script>   
    <script src="<?=base_url('assets/js/plugins/pt-br.js');?>"></script>   
    <script src="<?=base_url('assets/js/plugins/jquery.nicescroll.js');?>"></script>

      
    <link rel="shortcut icon" href="<?=base_url('assets/img/favicon.ico');?>">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  
     
  </head>

 <body id="mimin" class="dashboard">
      <!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div>
                <a href="<?=base_url('supervisor/dashboard');?>" class="navbar-brand"> 
                    <span style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-size: 18px;">Departamento de Estágio</span>
                </a>

              <ul class="nav navbar-nav navbar-right user-nav hidden-xs hidden-sm hidden-md">
                <li class="user-name"><span>Seja Bem Vindo ao Sistema! <?=$nome;?></span></li>
              </ul>
            </div>
          </div>
        </nav>
      <!-- end: Header -->

      <div class="container-fluid mimin-wrapper">
  
          <!-- start:Left Menu -->
            <div id="left-menu">
                <div class="sub-left-menu scroll" style="background-color: #F4F4F4;">
                <ul class="nav nav-list">
                    
                    <img style="max-width: 150px;margin-top: 12px" class=" center-block" src="<?=base_url('assets/img/logo_fatec.png');?>" alt="Fatec Garça">
                    
                    <li class="time">
                        <h1 class="animated fadeInLeft" style="margin-top: 0px;"></h1>
                        <p class="animated fadeInRight"></p>
                      
                      <h5 class="text-center"><strong><?=$curso;?></strong></h5>
                      <h6 class="text-center"><strong><?=$periodo;?></strong></h6>
                    </li>
                    
                    <li class="active ripple" style="background-color: #E0E0E0;">
                        <a href="<?=base_url('supervisor/dashboard');?>"><span class=" fa fa-dashboard"></span>Dashboard</a>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header">
                         <span class="icons icon-user-follow"></span> Cadastros
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                            <li><a href="<?=base_url('supervisor/aluno');?>"><i class="fa fa-university"></i> Aluno</a></li>
                            <li><a href="<?=base_url('supervisor/empresa');?>"><i class="fa-home fa"></i> Empresa</a></li>
                            <li><a href="<?=base_url('supervisor/estagio');?>"><i class="icons icon-feed"></i> Vagas de Estágio</a></li>
                      </ul>
                    </li>
                    <li><a href="<?=base_url('supervisor/dashboard/dados');?>"><span class="fa fa-user"></span> Alterar Dados</a></li>
                    <li><a href="<?=base_url('supervisor/dashboard/senha');?>"><span class="fa fa-lock"></span> Alterar Senha</a></li>
                    <li><a href="<?=base_url('supervisor/dashboard/login/sair');?>"><span class="icons icon-logout"></span> Sair</a></li>
                  </ul>
                </div>
            </div>
          <!-- end: Left Menu -->

           <div id="content" style="padding-left: 230px; padding-right: 0px; padding-top: 25px;">
            
                <div class="col-md-12 tab-pane">
               
                    <div class="col-md-12 tab-content">

                         <?php require_once ($page . '_view.php'); ?>

                    </div>    
                   
                </div>    
                   
          </div>
          
      </div>
   

      <!-- start: Mobile -->
      <div id="mimin-mobile" class="reverse">
        <div class="mimin-mobile-menu-list">
            <div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
                <ul class="nav nav-list">
                    <li class="active ripple">
                      <a class="tree-toggle nav-header">
                        <a href="<?=base_url('supervisor/dashboard');?>"><span class="fa fa-dashboard"></span>Dashboard</a>
                      </a>
                    </li>
                    <li class="ripple">
                      <a class="tree-toggle nav-header">
                        <span class="icons icon-user-follow"></span> Cadastros
                        <span class="fa-angle-right fa right-arrow text-right"></span>
                      </a>
                      <ul class="nav nav-list tree">
                            <li><a href="<?=base_url('supervisor/aluno');?>"><i class="fa fa-university"></i> Aluno</a></li>
                            <li><a href="<?=base_url('supervisor/empresa');?>"><i class="fa-home fa"></i> Empresa</a></li>
                            <li><a href="<?=base_url('supervisor/estagio');?>"><i class="icons icon-feed"></i> Vagas de Estágio</a></li>
                      </ul>
                    </li>
                    <li><a href="<?=base_url('supervisor/dashboard/dados');?>"><span class="fa fa-user"></span> Alterar Dados</a></li>
                    <li><a href="<?=base_url('supervisor/dashboard/senha');?>"><span class="fa fa-lock"></span> Alterar Senha</a></li>
                    <li><a href="<?=base_url('supervisor/dashboard/login/sair');?>">Sair</a></li>
                  </ul>
            </div>
        </div>       
      </div>
      <button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
        <span class="fa fa-bars"></span>
      </button>
      
      
      <!-- custom -->
     <script src="<?=base_url('assets/js/main.js');?>"></script>  
      
     <div class="modal fade" id="loading" role="dialog" style=" display:table; height: 100%; width: 100%; display: none;" data-backdrop="static">
        <div class="modal-dialog" modal-sm style="display: table-cell; vertical-align: middle;">
            <div class="modal-content" style="max-width: 155px; margin: 0 auto;">
                <div class="modal-body">
                    <img src="<?=base_url('assets/img/loading.gif');?>">
                </div>
            </div>
        </div>
    </div>

  <!-- end: Javascript -->
  </body>
</html>