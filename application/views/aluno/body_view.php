<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="icon" href="<?=base_url('assets/img/favicon.ico');?>">
      <title>Departamento de Estágio Fatec Garça - Painel Aluno</title>
      <link rel="stylesheet" href="<?=base_url('assets/aluno/css/components.css');?>">
      <link rel="stylesheet" href="<?=base_url('assets/aluno/css/icons.css');?>">
      <link rel="stylesheet" href="<?=base_url('assets/aluno/css/responsee.css');?>">
      <!-- CUSTOM STYLE --> 
      <link href="<?=base_url('assets/one/css/bootstrap.min.css');?>" rel="stylesheet">
      <link rel="stylesheet" href="<?=base_url('assets/aluno/css/template-style.css');?>"> 
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
      <script src="<?=base_url('assets/one/js/jquery.min.js');?>"></script>
      <script type="text/javascript" src="<?=base_url('assets/aluno/js/responsee.js');?>"></script>  
      <script src="<?=base_url('assets/one/js/bootstrap.min.js');?>"></script>
   </head>
   <body class="size-1140 align-content-center">
      <div class="line">
         
            <!-- LEFT COLUMN -->
            <div class="s-12 m-4 l-3">
               <div class="logo-box">
                   <img src="<?=base_url('assets/img/logo_aluno.png');?>">
                   
               </div>
                <div class="logo-box" style="color: white;">
                    <p style="font-weight: bold; text-align: center;">Bem Vindo <?=$nome;?></p>
                </div>
               <div class="aside-nav">
                    <ul class="chevron">
                         <li><a href="<?=base_url('aluno/dashboard');?>"><i class="icon-list"></i>Estágio</a></li>
                        <li><a href="<?=base_url('aluno/dashboard/senha');?>"><i class="icon-lock"></i>Alterar Senha</a></li>
                         <li><a href="<?=base_url('home/sair');?>"><i class="icon-sli-logout"></i>Sair</a></li>
                    </ul>
                  </div>
            </div>
            <!-- RIGHT COLUMN -->   
            
            <div class="s-12 m-8 l-9">
                <div id="content-wrapper">
               <div class="box">
                  <!-- HEADER -->    
                  <section>
                     <article class="line">
                           
                           <div class="s-12 m-12 l-12">
                              <?php require_once $page . '_view.php'; ?>
                        </div>
                     </article>
                     
                  </section>
               </div>
              
            </div>
         </div>
      </div>
      
   </body>
</html>