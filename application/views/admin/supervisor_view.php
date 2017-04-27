<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/select2.css');?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/select2-bootstrap.css');?>">
    <div class="panel panel-default" id="panelList">

        <div class="panel-heading">
            <h4>Supervisores de Estágio</h4>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <button class="btn btn-primary" id="btnAdicionar"><span class="icons icon-user-follow"></span> Adiocionar Supervisor</button>

                </div>

            </div>
            
            <div class="row">
                
                <div class="col-lg-12 col-md-12">
                
                    <table class="table table-responsive table-condensed table-hover table-bordered table-striped" id="tblLista" style="margin-top: 10px;">

                        <thead>

                            <tr>
                                <th>Nome</th>
                                <th style="" class="hidden-xs hidden-sm">E-mail</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Status</th>
                                <th style="text-align: center; max-width: 100px;">Ação</th>
                            </tr>

                        </thead>
                        
                        <tbody>
                            
                           <tr><td colspan='4'>Não foi encontrado nenhum registro...</td></tr>
                            
                        </tbody>

                    </table>
                    
                </div>    
                
            </div>

        </div>

    </div>

    <div class="panel panel-default" id="panelAdd">

        <div class="panel-heading">
            <h4>Adicionar Supervisor</h4>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <div class="form-group">
                        <label class="control-label">Status do Supervisor</label>
                        <select class="form-control" id="cmbStatus">
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>

                </div>

            </div>
            
            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <div class="form-group">
                        <label class="control-label">Nome</label>
                        <input type="text" class="form-control" id="txtNome">
                    </div>

                </div>

            </div>
            
            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input type="text" class="form-control" id="txtEmail">
                    </div>

                </div>

            </div>
            
            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <div class="form-group">
                        <label class="control-label">Curso que Administra</label>
                        <select class="form-control" id="cmbCurso">
                        </select>
                    </div>

                </div>

            </div>
            
            <div class="row periodo" style="display: none;">

                <div class="col-lg-12 col-md-12">

                    <div class="form-group">
                        <label for="cmbPeriodo">Período(s) que Administra</label>
                        <select class="form-control select2" id="cmbPeriodo" multiple="multiple">
                        </select>
                    </div>

                </div>

            </div>
            
        </div>

        <div class="panel-footer">
            
            <button class="btn  btn-primary" id="btnSalvar" data-loading-text="Aguarde...">Salvar</button>
            <button class="btn  btn-default" id="btnVoltar">Voltar</button>
            <input type="hidden" id="txtID" value="">
            <input type="hidden" id="txtIDAU" value="">
            <div class="spAviso"></div>
            
        </div>
        
    </div>

<script src="<?=base_url('assets/js/plugins/mask/jquery.maskedinput.js');?>"></script>
<script src="<?=base_url('assets/js/plugins/select2.min.js');?>"></script>

<script>

    $(document).ready(function(){
        
        $("#cmbPeriodo").select2();
        
        curso();
        
        $("#cmbCurso").change(function(){
            
            var id = $("#txtID").val();
            var idau = $("#txtIDAU").val();
            
            if((id=="" && idau!="") || (id=="" && idau=="")){
               
                var cursoadm = $("#cmbCurso").val();

                if(cursoadm==0){

                    $(".periodo").hide();

                }else{

                    periodo(cursoadm);

                }
             
            }else{
                
                $.post('<?=base_url('admin/supervisor/reset_curso');?>',
                {
                   'id':id,
                },
                function(retorno){
                    
                    curso();
                    $("#cmbPeriodo").select2("val", "");
                    $('.periodo').slideUp();
                    $('.periodo').slideDown();
                    $("#txtID").val('');
                    
                });
                
                if($("#txtIDAU").val()==""){
                
                    $("#txtIDAU").val(id);    
                
                }
                
            }
           
        });
        
        $("#panelList").show();
        $("#panelAdd").hide();
        
        $("#btnAdicionar").click(function(){
           
           $("#panelList").hide();
           $("#panelAdd").show();
           limpar_campos();
           
        });
        
        $("#btnVoltar").click(function(){
           
           $("#panelList").show();
           $("#panelAdd").hide();
           tabela();
           
        });
        
        $("#btnSalvar").click(function(){
                    
           var status       = $("#cmbStatus").val();
           var id           = $("#txtIDAU").val();
           var nome         = $("#txtNome").val();
           var email        = $.trim($("#txtEmail").val());
           var cursoadm     = $("#cmbCurso").val();
           //var periodo      = $("#cmbPeriodo").val();
           
           var periodo      = [];
           
           $.each($("#cmbPeriodo").val(),function(key,value){
               
               periodo[key] = value;
               
           });
           
           $(".spAviso").hide();
           $(".has-error").removeClass('has-error');
           
           if(nome==""){
               
               $("#txtNome").parent('.form-group').addClass('has-error');
               
           }
           if(email==""){
               
               $("#txtEmail").parent('.form-group').addClass('has-error');

           }
           if(cursoadm==0){
               
               $("#cmbCurso").parent('.form-group');
               alert('Selecione um Curso');
               
           }
           if(periodo==""){
               
               alert('Todos os Periodos ja foram Cadastrados!');
               
           }
           if($(".has-error").length > 0){
               
               $(".spAviso").addClass('text-danger').html('<br>Verifique os campos antes de continuar...').show();
               
           }else{
               
               $("#btnSalvar").button('loading');
               
               $.post('<?=base_url('admin/supervisor/salvar_supervisor');?>',
                {
                   'status':status,
                   'id':id,
                   'nome':nome,
                   'email':email,
                   'curso':cursoadm,
                   'periodo':periodo,
                },
                function(retorno){
                  
                  if(retorno==true){
                      
                      $(".spAviso").addClass('text-primary').html('<br>Salvo com sucesso...').show();
                      curso();
                      limpar_campos();
                      
                  }else{
                      
                      $(".spAviso").addClass('text-danger').html('<br>'+retorno).show();
                      $("#btnSalvar").button('reset');
                      
                  }      
                  
                });
               
           }
            
        });
        
        $('body').on('click','.link-reenviar',function(){
        
            var id = $(this).attr('id');
            
            $.post('<?=base_url('admin/supervisor/reenviar_senha');?>',
            {
                'id':id,   
            },
            function(retorno){

                if(retorno==true){

                   alert('Senha enviada com sucesso!');
                   tabela();

                }else{

                    alert('Erro... Tente novamente mais Tarde');

                }

            });
        
        });
        
        $('body').on('click','.link-excluir',function(){
        
            var id      = $(this).attr('id');
            var conf = confirm("Deseja realmente excluir o Supervisor?");
        
            if(conf==true){
                
                $.post('<?=base_url('admin/supervisor/excluir_supervisor');?>',
                {
                    'id':id,   
                },
                function(retorno){

                    if(retorno==true){
                       
                       tabela();
                       
                    }else{
                    
                        alert('Erro... Tente novamente mais Tarde');
                    
                    }

                });
                
            }
        
        });
        
        $('body').on('click','.link-alterar',function(){
        
            var id = $(this).attr('id');
            $("#txtID").val(id);
            $("#txtIDAU").val(id);
            
            $.post('<?=base_url('admin/supervisor/dados_supervisor');?>',
               {
                   'id':id,   
               },
                function(retorno){
                    
                    $("#panelList").hide();
                    $("#panelAdd").show();
                 
                    $("#cmbStatus").val(retorno.status);
                    $("#txtNome").val(retorno.nome);
                    $("#txtEmail").val(retorno.email);
                    $("#cmbPeriodo").html(retorno.periodo);
                    $('.periodo').slideDown();
                    $("#cmbCurso").val(retorno.curso);
                    var selectCat = retorno.periodos;

                    var sel = [];
                    $.each(selectCat, function (i) {
                        sel.push(selectCat[i]);
                    });
                    
                    $("#cmbPeriodo").val(sel).trigger("change");

                },'json');
            
        });
        
        tabela();
        

    });
    
    function tabela(){
        
        $.post('<?=base_url('admin/supervisor/listar_supervisor');?>',
        {},
            function(retorno){
                
                $("#tblLista > tbody").html(retorno);
           
        },'json');
        
    }
    
    function curso(){
        
        $.post('<?=base_url('admin/supervisor/listar_curso');?>',
        {},
            function(retorno){
                
                $("#cmbCurso").html(retorno.html);
                
           
        },'json');
        
    }
    
    function cursos(){
        
        $.post('<?=base_url('admin/supervisor/listar_curso_editar');?>',
        {},
            function(retorno){
                
                $("#cmbCurso").html(retorno.html);
                
                var c = $("#cmbCurso").val();
                periodo(c);
              
        },'json');
        
    }
    
    function periodo(curso){
        
        $.post('<?=base_url('admin/supervisor/listar_periodo');?>',
        {'curso':curso},
        function(retorno){
            
            $("#cmbPeriodo").select2("val", "");
            $('.periodo').slideUp();
            $('.periodo').slideDown();
            $("#cmbPeriodo").html(retorno.html);
                
        },'json');
        
    }
    
    function limpar_campos(){
        
        $("#txtNome").val('');
        $("#txtEmail").val('');
        $("#txtID").val('');
        $("#txtIDAU").val('');
        $("#cmbCurso").val(0);
        $(".periodo").hide();
        $("#cmbPeriodo").select2("val", "");
        $("#btnSalvar").button('reset');
    }
    
</script>