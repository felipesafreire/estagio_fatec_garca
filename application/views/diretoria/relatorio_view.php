
    <div class="panel panel-default" id="panelList">

        <div class="panel-heading">
            <h4>Supervisores de Estágio</h4>
        </div>

        <div class="panel-body">

            <div class="row">
                
                <div class="col-lg-6">
                    
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm"><strong>Exportar</strong></button>
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:" class="gera-pdf-supervisor">Exportar para PDF</a></li>
                            <li><a href="javascript:" class="gera-excel-supervisor">Exportar para Excel</a></li>
                        </ul>
                    </div>
                    
                </div>

                <div class="col-lg-6 col-md-6 paginacao">    
                            
                </div>

            </div>
            
            <div class="row">
                
                <div class="col-lg-12 col-md-12">
                
                    <table class="table table-responsive table-condensed table-hover table-bordered table-striped" id="tblListaSupervisor" style="margin-top: 10px;">

                        <thead>

                            <tr>
                                <th>Nome</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">E-mail</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Curso Administra</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Periodo(s) Curso</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Ação</th>
                            </tr>

                        </thead>
                        
                        <tbody>
                            
                           <tr><td colspan='5'>Não foi encontrado nenhum registro...</td></tr>
                            
                        </tbody>

                    </table>
                    
                </div>    
                
            </div>

        </div>

    </div>

    <div class="panel panel-default" id="panelList">

        <div class="panel-heading">
            <h4>Empresas</h4>
        </div>

        <div class="panel-body">

            <h5><i class="fa fa-filter"></i> FILTROS</h5>    
            
            <div class="row">
                
                <div class="col-lg-6 col-md-6">
                    
                    <div class="form-group">
                        <label class="control-label">Nome da Empresa</label>
                        <input class="form-control" id="txtEmpresaFiltro" type="text">
                    </div>
                    
                </div>
                
                <div class="col-lg-5 col-md-5">
                    
                    <div class="form-group">
                        <label class="control-label">CNPJ</label>
                        <input class="form-control" id="txtCNPJFiltro" type="text">
                    </div>
                    
                </div>
                
                <div class="col-md-1 col-lg-1">
                    
                    <div class="form-group text-center">
                        <button id="btnBuscar" class="btn btn-primary" style="margin-top: 24px;"><i class="fa fa-fw fa-search"></i></button>
                    </div>
                    
                </div>
                
            </div>
            
            <div class="row">
                
                <div class="col-lg-6">
                    
                    <div class="btn-group">
                        <button type="button" class="btn btn-success btn-sm"><strong>Exportar</strong></button>
                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="javascript:" class="gera-pdf-empresa">Exportar para PDF</a></li>
                            <li><a href="javascript:" class="gera-excel-empresa">Exportar para Excel</a></li>
                        </ul>
                    </div>
                    
                </div>

                <div class="col-lg-6 col-md-6 paginacao">    
                            
                </div>

            </div>
            
            <div class="row">
                
                <div class="col-lg-12 col-md-12">
                
                    <table class="table table-responsive table-condensed table-hover table-bordered table-striped" id="tblListaEmpresa" style="margin-top: 10px;">

                        <thead>

                            <tr>
                                <th>Empresa</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Contato</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">CNPJ</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Cidade</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">CEP</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Endereço</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Qtde Alunos</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Ação</th>
                            </tr>

                        </thead>
                        
                        <tbody>
                            
                           <tr><td colspan='5'>Não foi encontrado nenhum registro...</td></tr>
                            
                        </tbody>

                    </table>
                    
                </div>    
                
            </div>

        </div>

    </div>

    <div class="modal fade emailmodal" style="display: none;" >
        
        <div class="modal-dialog ">
            
            <div class="modal-content">
                
                <div class="modal-header">
                  
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Enviar E-mail</h4>
                
                </div>
                
                <div class="modal-body">
                  
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">

                            <div class="form-group">
                                <label class="control-label">Origem:</label>
                                <input type="text" class="form-control" id="txtOrigem">
                            </div>

                        </div>
                        
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">

                            <div class="form-group">
                                <label class="control-label">Destinatário:</label>
                                <input type="text" class="form-control" id="txtDestinatario">
                            </div>

                        </div>
                        
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">

                            <div class="form-group">
                                <label class="control-label">Assunto:</label>
                                <input type="text" class="form-control" id="txtAssunto">
                            </div>

                        </div>
                        
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">

                            <div class="form-group">
                                <label class="control-label">Mensagem:</label>
                                <textarea name="txtMensagem" id="txtMensagem" style="height: 150px;"></textarea>
                                
                                <div class="avisoEmail"></div>
                                
                            </div>

                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="btnEnviarEmail">Enviar E-mail</button>
                    
                </div>
                
            </div>
            
        </div>
        
    </div>

<script src="<?=base_url('assets/js/plugins/ckeditor/ckeditor.js');?>"></script>
<script>
    
    $(document).ready(function(){
       
      CKEDITOR.replace('txtMensagem');
      tabela_empresa();
      tabela_supervisor();
      
      $("#btnEnviarEmail").click(function(){
           
            $(".avisoEmail").hide();
            $(".has-error").removeClass('has-error');
           
            var mensagem = CKEDITOR.instances.txtMensagem.getData();
           
            if($("#txtOrigem").val()==""){
                $("#txtOrigem").parent('.form-group').addClass('has-error');
            }
            if($("#txtDestinatario").val()==""){
                $("#txtDestinatario").parent('.form-group').addClass('has-error');
            }
            if($("#txtAssunto").val()==""){
                $("#txtAssunto").parent('.form-group').addClass('has-error');
            }
            if(mensagem==""){
                alert('Preencha a mensagem!');
                CKEDITOR.instances.txtMensagem.focus();
            }
           
            if($(".has-error").length > 0){
               
               $(".avisoEmail").addClass('text-danger').html('<strong>Verifique os campos antes de continuar...</strong>').show();
               
            }else{
                
                var assunto      = $('#txtAssunto').val();
                var destinatario = $('#txtDestinatario').val();
                
                $.post('<?=base_url('diretoria/dashboard/enviar_email');?>',
                {
                   'mensagem':mensagem,
                   'assunto':assunto,
                   'destinatario':destinatario
                },
                function(retorno){

                    if(retorno==true){
                        
                        alert('E-mail enviado com sucesso!');
                        $("#txtAssunto").val('');
                         CKEDITOR.instances.txtMensagem.setData('');
                        $(".emailmodal").modal('hide');
                        
                    }else{
                        
                        alert('Erro... Tente novamente mais tarde!');
                        $(".emailmodal").modal('hide');
                    }

                }); 
                
            }
            
           
        });
        
        $('body').on('click','.enviar-email-supervisor',function(){
           
           var id = $(this).attr('id');
           
           $.post('<?=base_url('diretoria/dashboard/dados_email');?>',
               {
                   'id':id,
               },
                function(retorno){
                 
                    if(retorno.error==false){
                        
                        $("#txtOrigem").val(retorno.origem).prop('disabled','disabled');
                        $("#txtDestinatario").val(retorno.destinatario).prop('disabled','disabled');
                        $(".emailmodal").modal('show');
                        $("#txtAssunto").focus();
                        
                    }else{
                        
                        alert('Erro... Tente novamente mais tarde!');
                        $(".emailmodal").modal('hide');
                    }
                    
                },'json');
           
        });
      
        $(".gera-pdf-supervisor").click(function(){
        
            $.post('<?=base_url('diretoria/dashboard/pdf_supervisor');?>',
            {},
            function(data){
                
                window.open(data, '_blank');
                
            });
           
        });
        
        $('body').on('click','.relatorio-empresa',function(){
           
           var id = $(this).attr('id');
           
            $.post('<?=base_url('diretoria/dashboard/aluno_empresa');?>',
            {'id':id},
            function(data){
                
                window.open(data, '_blank');
                
            });
           
        });
        
        $(".gera-pdf-empresa").click(function(){
        
            $.post('<?=base_url('diretoria/dashboard/pdf_empresa');?>',
            {},
            function(data){
                
                window.open(data, '_blank');
                
            });
           
        });
        
        $(".gera-excel-empresa").click(function(){
           
            var nome = $("#txtEmpresaFiltro").val();
            var cnpj = $("#txtCNPJFiltro").val();

            var filtro = new Object();

            filtro = {'nome':nome,
                      'cnpj':cnpj};
        
            $.post('<?=base_url('diretoria/dashboard/excel_empresa');?>',
            {'filtro':filtro},
            function(data){
                
                window.open(data, '_blank');
                
            });
           
        });
        
        $(".gera-excel-supervisor").click(function(){
           
            $.post('<?=base_url('diretoria/dashboard/excel_supervisor');?>',
            {},
            function(data){
                
                window.open(data, '_blank');
                
            });
           
        });
       
    });
    
    function tabela_empresa(page){
        
        $('#tblListaEmpresa > tbody').html('<tr><td colspan="8">....Aguarde....</td></tr>');
        
        var nome = $("#txtEmpresaFiltro").val();
        var cnpj = $("#txtCNPJFiltro").val();
        
        var filtro = new Object();
        
        filtro = {'nome':nome,
                  'cnpj':cnpj};
        
        $.post('<?=base_url('diretoria/dashboard/listar_empresa');?>',
        {'page':page,'filtro':filtro},
            function(retorno){
                
                $("#tblListaEmpresa > tbody").html(retorno.html);
                $('.paginacao').html(retorno.paginacao);
           
        },'json');
        
    }
    
    function tabela_supervisor(page){
        
        $('#tblListaSupervisor > tbody').html('<tr><td colspan="6">....Aguarde....</td></tr>');
        
        $.post('<?=base_url('diretoria/dashboard/listar_supervisor');?>',
        {'page':page},
            function(retorno){
                
                $("#tblListaSupervisor > tbody").html(retorno.html);
                $('.paginacao').html(retorno.paginacao);
           
        },'json');
        
    }
    
</script>