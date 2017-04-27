<html lang="pt_br">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title;?> - Departamento de Estágio Fatec Garça</title>
	<!-- core CSS -->
        <link href="<?=base_url('assets/one/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/one/css/font-awesome.min.css');?>" rel="stylesheet">
    <link href="<?=base_url('assets/one/css/animate.css');?>" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="icon" href="<?=base_url('assets/img/favicon.ico');?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet"> 
    <style>
        body{font-family: Roboto Condensed;}
    </style>
	
</head><!--/head-->

<body>
    <div class="row" style="background-color:white;height:100px;margin-bottom: 20px;border-bottom: 1px solid black;">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <a class=" center-block" href="<?=base_url();?>"><img class="img-responsive center-block" style="max-width: 110px; margin-top: 10px;" title="Fatec Garça" src="<?=base_url('assets/img/logo_fatec.png');?>"></a>
        </div>
    </div>
  
    <div class="container">
        
        <div class="jumbotron" style="background-color:#FFFFFF; border-radius: 0px; border: 2px dotted black; padding-left:20px; padding-right: 20px; padding-top: 10px; padding-bottom: 10px;">
            
            <h3><?=$title;?></h3>
            <h6>Data cadastro: <?=$data_cadastro;?></h6>
            
            <hr>
            
            <?=$html;?>
            
            <p class="text-right">
                <a class="btn btn-xl btn-danger" role="button" href="<?=base_url('aluno/estagio');?>"><span class="glyphicon glyphicon-log-out"></span> Voltar</a>
            </p>
            
        </div>
            
        
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2" style="text-align: center">
                <a style="color:#0e4a5c;text-decoration:none;font-size:16px;font-weight:bold" href="<?=base_url();?>">Sistema de Estágio</a>
            </div>
        </div>
          
    </div>
    <script src="<?=base_url('assets/one/js/jquery.min.js');?>"></script>
    <script src="<?=base_url('assets/one/js/bootstrap.min.js');?>"></script>
   
</body>
</html>