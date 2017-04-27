
    <div class="panel panel-default" id="panelList">

        <div class="panel-heading">
            <h4>Vagas de Estágio</h4>
        </div>

        <div class="panel-body">

            <h5><i class="fa fa-filter"></i> FILTROS</h5> 
            
            <div class="row">
                
                <div class="col-lg-5 col-md-5">
                    
                    <div class="form-group">
                        <label class="control-label">Título da Vaga</label>
                        <input class="form-control" id="txtTituloFiltro" type="text">
                    </div>
                    
                </div>
                
                <div class="col-lg-3 col-md-3">
                    
                    <label class="control-label">Data Inicial do Cadastro</label>
                    <div class="input-group">
                        <input class="form-control datepicker" data-date-format="dd/mm/yyyy" id="txtDataInicialFiltro" type="text">
                        <span class="input-group-addon"><span class="icons icon-calendar"></span></span>
                    </div>
                    
                </div>
                
                <div class="col-lg-3 col-md-3">
                    
                    <label class="control-label">Data Final do Cadastro</label>
                    <div class="input-group">
                        <input class="form-control datepicker2" data-date-format="dd/mm/yyyy" id="txtDataFinalFiltro" type="text">
                        <span class="input-group-addon"><span class="icons icon-calendar"></span></span>
                    </div>
                    
                </div>
                
                <div class="col-md-1 col-lg-1">
                    
                    <div class="form-group text-center">
                        <button id="btnBuscar" class="btn btn-primary" style="margin-top: 24px;"><i class="fa fa-fw fa-search"></i></button>
                    </div>
                    
                </div>
                
            </div>
            
            <div class="row">

                <div class="col-lg-6 col-md-6">

                    <button class="btn btn-primary" id="btnAdicionar"><span class="icons icon-user-follow"></span> Cadastrar Vaga</button>

                </div>
                
                <div class="col-lg-6 col-md-6 paginacao">    
                            
                </div>

            </div>
            
            <div class="row">
                
                <div class="col-lg-12 col-md-12">
                
                    <table class="table table-responsive table-condensed table-hover table-bordered table-striped" id="tblLista" style="margin-top: 10px;">

                        <thead>

                            <tr>
                                <th>Título, URL</th>
                                <th style="text-align: center; max-width: 120px;" class="hidden-xs hidden-sm">Data de Cadastro</th>
                                <th style="text-align: center; max-width: 100px;">Ação</th>
                            </tr>

                        </thead>
                        
                        <tbody>
                            
                           <tr><td colspan='2'>Não foi encontrado nenhum registro...</td></tr>
                            
                        </tbody>

                    </table>
                    
                </div>    
                
            </div>

        </div>

    </div>

    <div class="panel panel-default" id="panelAdd">

        <div class="panel-heading">
            <h4>Cadastrar Vaga de Estágio</h4>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <div class="form-group">
                        <label class="control-label">Título da Vaga</label>
                        <input type="text" class="form-control" id="txtTitulo">
                    </div>

                </div>
                
            </div>
            
            <div class="row">
                        
                <div class="col-md-12 col-lg-12">

                    <div class="form-group">
                        <label for="txtURL">URL</label>
                        <div class="input-group">
                            <span class="input-group-addon " style="background-color:#eee" id="basic-addon3"><?=base_url();?></span>
                            <input class="form-control" id="txtURL" readonly="readonly" placeholder="vaga-estagio" type="text">
                        </div>                      
                    </div>

                </div>

            </div>
            
             <div class="row upload">
                        
                <div class="col-md-12 col-lg-12">

                    <div class="form-group">
                        <label for="txtImagem">Imagem</label>
                        <div class="input-group">
                            <input id="txtImagem" type="file" name="arquivo">
                        </div>                      
                    </div>

                </div>

            </div>
            
            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <div class="form-group">
                        <label class="control-label">Descrição da Vaga</label>
                        <textarea id="txtHTML"></textarea>
                    </div>

                </div>
               
            </div>
            
        </div>    
            
        <div class="panel-footer">
            
            <button class="btn  btn-primary" id="btnSalvar" data-loading-text="Aguarde...">Salvar</button>
            <button class="btn  btn-default" id="btnVoltar">Voltar</button>
            <input type="hidden" id="txtID" value="">
            <div class="spAviso"></div>
            
        </div>
        
    </div>
<script src="<?=base_url('assets/js/plugins/ckeditor/ckeditor.js');?>"></script>
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/date/datepicker.css');?>"/>          
<script src="<?=base_url('assets/js/plugins/date/bootstrap-datepicker.js');?>"></script>
<script src="<?=base_url('assets/js/plugins/AjaxFileUpload.js');?>"></script>
<script>

    $(document).ready(function(){
        
        $("#txtImagem").AjaxFileUpload({
            action: '<?=base_url('supervisor/estagio/upload');?>',
            secureuri: false,
            fileElementId: 'arquivo',
            dataType: 'JSON',
            onSubmit: function(filename){
                $('#loading').modal('show');
            },
            onComplete: function(filename, response){
                
                if(response.error==true){
                    $('#loading').modal('hide');
                    alert(response.msg);
                }else{
                    $('#loading').modal('hide');
                    $(".upload").hide();
                    
                    var html = "<div align='center'><img src='"+response.img+"'></div>";
                    
                    CKEDITOR.instances.txtHTML.setData(html);
                }
                
                console.log(filename);
                console.log(response);
            }
        });
        
        var startDate = new Date();

        $('.datepicker').datepicker({

        });

        $('.datepicker2').datepicker('setValue', startDate);
        
        var base = "<?=base_url();?>";
        
        CKEDITOR.replace('txtHTML');
        
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
        
        $("#btnBuscar").click(function(){
           
           tabela();
           
        });
        
        $("#txtTitulo").keyup(function () {

            if ($.trim($(this).val()) == "") {
                $('#txtURL').val('');
                return;
            }
            $('#txtURL').val('...Aguarde...');
            $.post('<?= base_url('supervisor/estagio/check_url'); ?>',
            {'nome': $.trim($(this).val())},
            function (retorno) {
                $('#txtURL').val(retorno);
            });
            
        });
        
        $("#btnSalvar").click(function(){
           
           var id           = $("#txtID").val();
           var titulo       = $("#txtTitulo").val();
           var descricao    = CKEDITOR.instances.txtHTML.getData();
           
           $(".spAviso").hide();
           $(".has-error").removeClass('has-error');
           
           if(titulo==""){
               
               $("#txtTitulo").parent('.form-group').addClass('has-error');
               
           }
           if(descricao==""){
                alert('Preencha a mensagem!');
                CKEDITOR.instances.txtHTML.focus();
            }
           if($(".has-error").length > 0){
               
               $(".spAviso").addClass('text-danger').html('<br>Verifique os campos antes de continuar...').show();
               
           }else{
               
               $("#btnSalvar").button('loading');
               
               $.post('<?=base_url('supervisor/estagio/salvar_estagio');?>',
               {
                    'id':id,
                    'titulo':titulo,
                    'descricao':descricao,
                    'url': $.trim($("#txtURL").val())
               },
                function(retorno){
                  
                    if(retorno==true){

                        $(".spAviso").addClass('text-primary').html('<br>Salvo com sucesso...').show();
                        limpar_campos();

                    }else{

                        $(".spAviso").addClass('text-danger').html('<br><strong>'+retorno+'</strong>').show();
                        $("#btnSalvar").button('reset');

                    }      
                  
                });
               
           }
            
        });
        
        $('body').on('click','.link-alterar',function(){
        
            var id = $(this).attr('id');
            $("#txtID").val(id);
            
            $.post('<?=base_url('supervisor/estagio/dados_estagio');?>',
               {
                   'id':id,   
               },
                function(retorno){
                    
                    $("#panelList").hide();
                    $("#panelAdd").show();
                    
                    $(".upload").hide();
                 
                    $("#txtTitulo").val(retorno.titulo).focus();
                    CKEDITOR.instances.txtHTML.setData(retorno.html)
                    $("#txtURL").val(retorno.url);
                    
                },'json');
            
        });
        
        $('body').on('click','.link-excluir',function(){
        
            var id = $(this).attr('id');
            $("#txtID").val(id);
            var conf = confirm("Deseja realmente excluir o Coordenador?");
            
            if(conf==true){
                
                $.post('<?=base_url('supervisor/estagio/excluir_vaga');?>',
                {
                   'id':id,   
                },
                function(retorno){

                    if(retorno==true){

                        tabela();

                    }else{

                        alert("Erro ao deletar Vaga!");

                    }

                });
                
            }
            
        });
        
        tabela();
        
    });
 
    function tabela(page){
        
        $('#tblLista > tbody').html('<tr><td colspan="3">....Aguarde....</td></tr>');
        
        var nome        = $("#txtTituloFiltro").val();
        var datainicial = $("#txtDataInicialFiltro").val();
        var datafinal   = $("#txtDataFinalFiltro").val();
        
        var filtro = new Object();
        
        filtro = {'nome':nome,
                  'datainicial':datainicial,
                  'datafinal':datafinal};
        
        $.post('<?=base_url('supervisor/estagio/listar_estagio');?>',
        {'page':page,'filtro':filtro},
            function(retorno){
                
                $("#tblLista > tbody").html(retorno.html);
                $('.paginacao').html(retorno.paginacao);
           
        },'json');
        
    }
    
    function limpar_campos(){
        
        $("#txtID").val('');
        $(".upload").show();
        $("#txtTitulo").val('').focus();
        $("#txtImagem").val('');
        $("#txtURL").val('vaga-estagio');
        CKEDITOR.instances.txtHTML.setData('');
        $("#btnSalvar").button('reset');
        
    }
    
</script>