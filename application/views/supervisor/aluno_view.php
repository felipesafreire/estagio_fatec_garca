<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/select2.css');?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/plugins/select2-bootstrap.css');?>">
    <div class="panel panel-default" id="panelList">

        <div class="panel-heading">
            <h4>Alunos</h4>
            <h5><strong>Curso:</strong> <?=$curso;?></h5>
            <h6><strong>Turmo:</strong> <?=$periodo;?></h6>
            
        </div>

        <div class="panel-body">

            <h5><i class="fa fa-filter"></i> FILTROS</h5>    
            
            <div class="row">
                
                <div class="col-lg-3 col-md-3">
                    
                    <div class="form-group">
                        <label class="control-label">RA</label>
                        <input class="form-control" maxlength="13" id="txtRaFiltro" type="text">
                    </div>
                    
                </div>
                
                <div class="col-lg-5 col-md-5">
                    
                    <div class="form-group">
                        <label class="control-label">Nome do Aluno</label>
                        <input class="form-control" id="txtNomeFiltro" type="text">
                    </div>
                    
                </div>
                
                <div class="col-lg-4 col-md-4">
                    
                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input class="form-control" id="txtEmailFiltro" type="text">
                    </div>
                    
                </div>
                
            </div>
            
            <div class="row">
                
                <div class="col-lg-3 col-md-3">

                    <div class="form-group">
                        <label class="control-label">Tipo do Estágio</label>
                        <select class="form-control" id="cmbDocumentoFiltro">
                            <option value="0" selected="">Todas as opções</option>
                            <option value="1">Estágio Curricular</option>
                            <option value="2">Estágio com Equivalência</option>
                        </select>
                    </div>

                </div>
                
                <div class="col-lg-3 col-md-3">

                    <div class="form-group">
                        <label class="control-label">Status Aluno</label>
                        <select class="form-control" id="cmbStatusFiltro">
                            <option value="1" selected="">Alunos Ativos</option>
                            <option value="0" >Alunos Inativos</option>
                        </select>
                    </div>

                </div>
                
                <div class="col-lg-4 col-md-4">

                    <div class="form-group">
                        <label class="control-label">Empresa</label>
                        <select class="form-control" id="cmbEmpresaFiltro">
                        </select>
                    </div>

                </div>
                
                <div class="col-md-2 col-lg-2">
                    
                    <div class="form-group text-center">
                        <button id="btnBuscar" class="btn btn-primary" style="margin-top: 24px;"><i class="fa fa-fw fa-search"></i></button>
                    </div>
                    
                </div>
                
            </div>
            
            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <button class="btn btn-primary" id="btnAdicionar"><span class="icons icon-user-follow"></span> Cadastrar Aluno</button>

                </div>
                
                <div class="col-lg-6 col-md-6 paginacao">    
                            
                </div>

            </div>
            
            <div class="row">
                
                <div class="col-lg-12 col-md-12">
                
                    <table class="table table-responsive table-condensed table-bordered table-striped" id="tblLista" style="margin-top: 10px;">

                        <thead>

                            <tr>
                                <th>Nome, E-mail</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Status</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Estágio</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Documentos</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm hidden-md">Empresa</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Contato</th>
                                <th style="text-align: center; max-width: 100px;">
                                
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm"><strong>Ações</strong></button>
                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                          <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            
                                            <li><a href="javascript:">Relátorios</a></li>
                                            
                                            <li class="divider"></li>
                                            
                                            <li><a href="javascript:" class="gera-pdf">Exportar para PDF</a></li>
                                            <li><a href="javascript:" class="gera-excel">Exportar para Excel</a></li>
                                            <li><a href="javascript:" class="gera-pdf-aluno">PDF (Aluno Especifico)</a></li>
                                            
                                             <li class="divider"></li>
                                            
                                             <li><a href="javascript:" class="enviar-email-multiplo">Enviar e-mail (Múltiplo)</a></li>
                                            
                                            
                                        </ul>
                                    </div>
                                
                                </th>
                            </tr>

                        </thead>
                        
                        <tbody>
                            
                           <tr><td colspan='7'>Não foi encontrado nenhum registro...</td></tr>
                            
                        </tbody>

                    </table>
                    
                </div>    
                
            </div>

        </div>

    </div>

    <div class="panel panel-default" id="panelAdd">

        <div class="panel-heading">
            <h4>Cadastrar Aluno</h4>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Nome do Aluno</label>
                        <input type="text" class="form-control" id="txtNome">
                    </div>

                </div>
                
                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">E-mail do Aluno</label>
                        <input type="text" class="form-control" id="txtEmail">
                    </div>

                </div>

            </div>
            
            <div class="row">
                
                <div class="col-lg-4 col-md-4">

                    <div class="form-group">
                        <label class="control-label">RA</label>
                        <input type="text" maxlength="13" class="form-control" id="txtRa">
                    </div>

                </div>
                
                <div class="col-lg-4 col-md-4">

                    <div class="form-group">
                        <label class="control-label">CPF</label>
                        <input type="text" class="form-control" id="txtCPF">
                    </div>

                </div>
                
                <div class="col-lg-4 col-md-4">

                    <div class="form-group">
                        <label class="control-label">RG</label>
                        <input type="text" class="form-control" id="txtRG">
                    </div>

                </div>
                
                
                
            </div>
            
            <div class="row">
                
                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Tipo do Estágio</label>
                        <select class='form-control' id='cmbDocumento'>
                        </select>
                    </div>

                </div>
                
                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Empresa</label>
                        <select class='form-control' id='cmbEmpresa'>
                        </select>
                    </div>

                </div>
                
            </div>    
            
            <div class="row">
                
                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Data de Nascimento</label>
                        <input type="text" class="form-control" id="txtNascimento">
                    </div>

                </div>
                
                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Sexo</label>
                        <select class='form-control' id='cmbSexo'>
                            <option value="M" selected>Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                    </div>

                </div>
                
            </div>
            
            <div class="row">
                
                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Telefone</label>
                        <input type="text" class="form-control" id="txtTelefone">
                    </div>

                </div>
                
                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Celular</label>
                        <input type="text" class="form-control" id="txtCelular">
                    </div>

                </div>
                
            </div>
            
            <div class="row">

                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">CEP</label>
                        <input type="text" class="form-control" id="txtCEP">
                    </div>

                </div>
                
                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Estado</label>
                        <select class='form-control' id='cmbEstado'>
                            <option selected value="0">Escolha o Estado</option>
                            <option value='AC'>Acre</option>
                            <option value='AL'>Alagoas</option>
                            <option value='AP'>Amapá</option>
                            <option value='AM'>Amazonas</option>
                            <option value='BA'>Bahia</option>
                            <option value='CE'>Ceará</option>
                            <option value='DF'>Distrito Federal</option>
                            <option value='ES'>Espirito Santo</option>
                            <option value='GO'>Goiás</option>
                            <option value='MA'>Maranhão</option>
                            <option value='MT'>Mato Grosso</option>
                            <option value='MS'>Mato Grosso do Sul</option>
                            <option value='MG'>Minas Gerais</option>
                            <option value='PA'>Pará</option>
                            <option value='PB'>Paraiba</option>
                            <option value='PR'>Paraná</option>
                            <option value='PE'>Pernambuco</option>
                            <option value='PI'>Piauí</option>
                            <option value='RJ'>Rio de Janeiro</option>
                            <option value='RN'>Rio Grande do Norte</option>
                            <option value='RS'>Rio Grande do Sul</option>
                            <option value='RO'>Rondônia</option>
                            <option value='RR'>Roraima</option>
                            <option value='SC'>Santa Catarina</option>
                            <option value='SP'>São Paulo</option>
                            <option value='SE'>Sergipe</option>
                            <option value='TO'>Tocantis</option>
                        </select>
                    </div>
                    
                </div>

            </div>
            
            <div class="row">

                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Cidade</label>
                        <input type="text" class="form-control" id="txtCidade">
                    </div>

                </div>
                
                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Rua</label>
                        <input type="text" class="form-control" id="txtRua">
                    </div>

                </div>

            </div>
            
            <div class="row">

                <div class="col-lg-2 col-md-2">

                    <div class="form-group">
                        <label class="control-label">Numero</label>
                        <input type="text" class="form-control" id="txtNumero">
                    </div>

                </div>
                
                <div class="col-lg-4 col-md-4">

                    <div class="form-group">
                        <label class="control-label">Bairro</label>
                        <input type="text" class="form-control" id="txtBairro">
                    </div>

                </div>
                
                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Complemento</label>
                        <input type="text" class="form-control" id="txtComplemento">
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

    <div class="modal fade pdfaluno" style="display: none;" >
        
        <div class="modal-dialog ">
            
            <div class="modal-content">
                
                <div class="modal-header">
                  
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Gerar PDF Aluno</h4>
                
                </div>
                
                <div class="modal-body">
                  
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">

                            <div class="input-group">
                                <input type="text" id="txtBuscaAluno" class="form-control" placeholder="Digite o RA, Nome ou E-mail do aluno.">
                                <div class="input-group-btn">
                                    <button type="button" id="btnBuscarAluno" class="btn btn-primary">Buscar</button>
                                </div>
                            </div>

                        </div>
                        
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12" id="busca_aluno" style="max-height:300px;overflow:auto;">
                            
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    
                </div>
                
            </div>
            
        </div>
        
    </div>

    <div class="modal fade emailmultiploaluno" style="display: none;" >
        
        <div class="modal-dialog ">
            
            <div class="modal-content">
                
                <div class="modal-header">
                  
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Enviar E-mail para vários Alunos</h4>
                
                </div>
                
                <div class="modal-body">
                  
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">

                            <div class="form-group">
                                <label class="control-label"><strong>Selecione os Alunos</strong></label>
                                <select class='form-control' id='cmbEmailAluno'  multiple>
                                </select>
                                <p class="help-block"><strong>Digite o Nome do Aluno ou o E-mail.</strong></p>
                            </div>

                        </div>
                        
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">

                            <div class="form-group">
                                <label class="control-label">Assunto:</label>
                                <input type="text" class="form-control" id="txtAssuntoEmailAluno">
                            </div>

                        </div>
                        
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">

                            <div class="form-group">
                                <label class="control-label">Mensagem:</label>
                                <textarea name="txtMensagem" id="txtMensagemEmailAluno" style="height: 150px;"></textarea>
                                
                            </div>

                        </div>
                        
                    </div>
                    
                    <div class="row">
                        
                        <div class="col-lg-12 col-md-12">
                            
                            <div class="spAvisoEmail"></div>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-primary" id="btnEmailMultiplo" onclick="lista_email()">Dispar E-mail(s)</button>
                    
                </div>
                
            </div>
            
        </div>
        
    </div>

<script src="<?=base_url('assets/js/plugins/mask/jquery.maskedinput.js');?>"></script>
<script src="<?=base_url('assets/js/plugins/select2.min.js');?>"></script>
<script src="<?=base_url('assets/js/plugins/jquery.maskMoney.min.js');?>"></script>
<script src="<?=base_url('assets/js/plugins/ckeditor/ckeditor.js');?>"></script>
<script type="text/javascript">

    $(document).ready(function(){
        
        $("#cmbEmpresa").select2();
        $("#cmbEmpresaFiltro").select2();
        $("#cmbEmailAluno").select2();
        CKEDITOR.replace('txtMensagem');
        CKEDITOR.replace('txtMensagemEmailAluno');
    
        $("#txtRa").maskMoney({thousands:'', decimal:'', precision: 0});
        $("#txtCPF").mask("999.999.999-99",{placeholder: "_"});
        $("#txtRG").mask("99.999.999-9",{placeholder: "_"});
        $("#txtNascimento").mask("99/99/9999",{placeholder: "_"});
        $("#txtTelefone").mask("(99) 9999-9999",{placeholder: "_"});
        $("#txtCelular").mask("(99) 99999-9999",{placeholder: "_"});
        $("#txtCEP").mask("99999-999",{placeholder: "_"});

        listar_estagio();
        empresa();

        $("#panelList").show();
        $("#panelAdd").hide();
        
        $(".enviar-email-multiplo").click(function(){
           
           emailmultiplo();
           $(".emailmultiploaluno").modal('show');
           
        });
        
        $(".gera-pdf").click(function(){
           
            var ra      = $("#txtRaFiltro").val();
            var nome    = $("#txtNomeFiltro").val();
            var email   = $.trim($("#txtEmailFiltro").val());
            var estagio = $("#cmbDocumentoFiltro").val();
            var status  = $("#cmbStatusFiltro").val();
            var empresa = $("#cmbEmpresaFiltro").val();

            var filtro  = new Object();

            filtro ={'ra':ra,
                     'nome':nome,
                     'email':email,
                     'estagio':estagio,
                     'status':status,
                     'empresa':empresa};
        
            $.post('<?=base_url('supervisor/aluno/pdf');?>',
            {'filtro':filtro},
            function(data){
                
                window.open(data, '_blank');
                
            });
           
        }); 
        
        $(".gera-excel").click(function(){
           
            var ra      = $("#txtRaFiltro").val();
            var nome    = $("#txtNomeFiltro").val();
            var email   = $.trim($("#txtEmailFiltro").val());
            var estagio = $("#cmbDocumentoFiltro").val();
            var status  = $("#cmbStatusFiltro").val();
            var empresa = $("#cmbEmpresaFiltro").val();

            var filtro  = new Object();

            filtro ={'ra':ra,
                     'nome':nome,
                     'email':email,
                     'estagio':estagio,
                     'status':status,
                     'empresa':empresa};
        
            $.post('<?=base_url('supervisor/aluno/excel');?>',
            {'filtro':filtro},
            function(data){
                
                window.open(data, '_blank');
                
            });
           
        }); 
       
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
                
                $.post('<?=base_url('supervisor/aluno/enviar_email');?>',
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
        
        $('body').on('click','.link-ativar',function(){
        
            var id = $(this).attr('id');
            
            $.post('<?=base_url('supervisor/aluno/ativar');?>',
            {
               'id':id,
            },
            function(retorno){

                if(retorno==true){

                    alert("Aluno Ativado com sucesso");
                    tabela();

                }else{

                    alert('Erro... Tente novamente mais tarde!');
                    
                }

            });
        
        });
        
        $('body').on('click','.link-inativar',function(){
        
            var id = $(this).attr('id');
            
            $.post('<?=base_url('supervisor/aluno/inativar');?>',
            {
               'id':id,
            },
            function(retorno){

                if(retorno==true){

                    alert("Aluno inativado com sucesso!");
                    tabela();

                }else{

                    alert('Erro... Tente novamente mais tarde!');
                    
                }

            });
        
        });
        
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
        
        $('body').on('click','.link-email',function(){
           
           var id = $(this).attr('id');
           
           $.post('<?=base_url('supervisor/aluno/dados_email');?>',
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
        
        $("#btnSalvar").click(function(){
           
           var id           = $("#txtID").val();
           var nome         = $("#txtNome").val();
           var email        = $.trim($("#txtEmail").val());
           var cpf          = $("#txtCPF").val();
           var ra           = $("#txtRa").val();
           var rg           = $("#txtRG").val();
           var estagio      = $("#cmbDocumento").val();
           var empresa      = $("#cmbEmpresa").val();
           var nascimento   = $("#txtNascimento").val();
           var sexo         = $("#cmbSexo").val();
           var telefone     = $("#txtTelefone").val();
           var celular      = $("#txtCelular").val();
           var cep          = $("#txtCEP").val();
           var uf           = $("#cmbEstado").val();
           var cidade       = $("#txtCidade").val();
           var rua          = $("#txtRua").val();
           var numero       = $("#txtNumero").val();
           var bairro       = $("#txtBairro").val();
           var complemento  = $("#txtComplemento").val();
           
           
           $(".spAviso").hide();
           $(".has-error").removeClass('has-error');
           
           if(nome==""){
               
               $("#txtNome").parent('.form-group').addClass('has-error');
               
           }
           if(ra==""){
               
               $("#txtRa").parent('.form-group').addClass('has-error');
               
           }
           if(email==""){
               
               $("#txtEmail").parent('.form-group').addClass('has-error');
               
           }
           if(cpf==""){
               
               $("#txtCNPJ").parent('.form-group').addClass('has-error');
               
           }
           if(estagio=="0"){
               
               alert("Selecione um tipo de estágio");
               return;
               
           }
           if(nascimento==""){
               
               $("#txtNascimento").parent('.form-group').addClass('has-error');
               
           }
           if(celular==""){
               
               $("#txtCelular").parent('.form-group').addClass('has-error');
               
           }
           if(empresa==null){
               
               alert("Selecione uma empresa");
               return;
           }
           
           if(cep==""){
               
               $("#txtCEP").parent('.form-group').addClass('has-error');
               
           }
           if(uf=="0"){
               
               $("#cmbEstado").parent('.form-group').addClass('has-error');
               
           }
           if(cidade==""){
               
               $("#txtCidade").parent('.form-group').addClass('has-error');
               
           }
           if(rua==""){
               
               $("#txtRua").parent('.form-group').addClass('has-error');
               
           }
           if(numero==""){
               
               $("#txtNumero").parent('.form-group').addClass('has-error');
               
           }
           if(bairro==""){
               
               $("#txtBairro").parent('.form-group').addClass('has-error');
               
           }
           if($(".has-error").length > 0){
               
               $(".spAviso").addClass('text-danger').html('<br>Verifique os campos antes de continuar...').show();
               
           }else{
               
               $("#btnSalvar").button('loading');
               
               $.post('<?=base_url('supervisor/aluno/salvar_aluno');?>',
               {
                    'id':id,
                    'nome':nome,
                    'ra':ra,
                    'email':email,
                    'cpf':cpf,
                    'rg':rg,
                    'estagio':estagio,
                    'empresa':empresa,
                    'nascimento':nascimento,
                    'sexo':sexo,
                    'telefone':telefone,
                    'celular':celular,
                    'cep':cep,
                    'uf':uf,
                    'cidade':cidade,
                    'rua':rua,
                    'numero':numero,
                    'bairro':bairro,
                    'complemento':complemento,
                    
               },
                function(retorno){
                  
                  if(retorno==true){
                      
                      $(".spAviso").addClass('text-primary').html('<br>Salvo com sucesso...').show();
                      limpar_campos();
                      
                  }else{
                      
                      $(".spAviso").addClass('text-danger').html('<br>Erro ao efetuar o registro...').show();
                      $("#btnSalvar").button('reset');
                      alert(retorno);
                  }      
                  
                });
               
           }
            
        });
        
        $('body').on('click','.link-alterar',function(){
        
            limpar_campos();
        
            var id = $(this).attr('id');
            $("#txtID").val(id);
            
            $.post('<?=base_url('supervisor/aluno/dados_aluno');?>',
               {
                   'id':id,   
               },
                function(retorno){
                    
                    $("#panelList").hide();
                    $("#panelAdd").show();
                    
                    $("#txtNome").val(retorno.nome).focus();
                    $("#txtEmail").val(retorno.email);
                    $("#txtRa").val(retorno.ra);
                    $("#txtCPF").val(retorno.cpf);
                    $("#txtRG").val(retorno.rg);
                    $("#cmbDocumento").val(retorno.estagio);
                    $("#cmbEmpresa").select2("val", retorno.empresa);
                    $("#txtNascimento").val(retorno.nascimento);
                    $("#cmbSexo").val(retorno.sexo);
                    retorno.telefone==""?$("#txtTelefone").val(''):$("#txtTelefone").val(retorno.telefone);
                    $("#txtCelular").val(retorno.celular);
                    $("#txtCEP").val(retorno.cep);
                    $("#cmbEstado").val(retorno.uf);
                    $("#txtCidade").val(retorno.cidade);
                    $("#txtRua").val(retorno.rua);
                    $("#txtNumero").val(retorno.numero);
                    $("#txtBairro").val(retorno.bairro);
                    $("#txtComplemento").val(retorno.complemento);
                    
                },'json');
            
        });
        
        tabela();
        
        $("#txtCEP").change(function(){
           
           var cep = $("#txtCEP").val();
           
            $.getJSON('//viacep.com.br/ws/'+ cep +'/json/?callback=?', function(dados) {
                
                $("#cmbEstado").val(dados.uf);
                $("#txtCidade").val(dados.localidade);
                $("#txtRua").val(dados.logradouro);
                $("#txtBairro").val(dados.bairro);
                $("#txtNumero").focus();
                
            });
           
        });
        
        
        $('body').on('click','.link-documento',function(){
        
            var id = $(this).attr('id');
            
            $(".documento"+id).show();
            var tipo = $("#txtTipoDocumento"+id).val();
            
            dados_documento(id,tipo);
            salvar(id,tipo);
            
        });
        
        $(".gera-pdf-aluno").click(function(){
            
            $("#txtBuscaAluno").val('');
            $("#busca_aluno").html('');
            $(".pdfaluno").modal('show');
            
        });
        
        $("#btnBuscarAluno").click(function(){
           
           var busca = $("#txtBuscaAluno").val();
           
           if(busca==""){
               alert('Campo de busca em branco!');
           }else{
                $.post('<?=base_url('supervisor/aluno/busca_aluno');?>',
                {
                   'busca':busca,   
                },
                function(retorno){
                    $("#busca_aluno").html(retorno);
                }); 
           }
           
        });
        
    });
    
    function salvar(id,tipo){
    
        $('body').one('click','.btnSalvarDocumento'+id,function(){
               
           if(tipo==1){

                var i1  = $("#i1"+id).val();
                var i2  = $("#i2"+id).val();
                var i3  = $("#i3"+id).val();
                var i4  = $("#i4"+id).val();

                var f1  = $("#f1"+id).val();
                var f2  = $("#f2"+id).val();
                var f3  = $("#f3"+id).val();
                var f4  = $("#f4"+id).val();

                $("#btnSalvarDocumento"+id).button('loading');

                $.post('<?=base_url('supervisor/aluno/salvar_documento');?>',
                {'i1':i1,'i2':i2,'i3':i3,'i4':i4,'f1':f1,'f2':f2,'f3':f3,'f4':f4,'tipo':tipo,'id':id},
                   function(retorno){

                    if(retorno){

                        $("#btnSalvarDocumento"+id).button('reset');
                        alert("Erro ao Salvar Informações, tente novamente!");

                    }else{

                        $("#btnSalvarDocumento"+id).button('reset');
                        $(".btnFechaDocumento"+id).trigger('click');
                        alert("Informações salva com sucesso!");

                    }      

                });
                
            }else{
                
                var e1  = $("#e1"+id).val();
                var e2  = $("#e2"+id).val();
                var e3  = $("#e3"+id).val();
                
                $("#btnSalvarDocumento"+id).button('loading');
                
                $.post('<?=base_url('supervisor/aluno/salvar_documento');?>',
                {'e1':e1,'e2':e2,'e3':e3,'tipo':tipo,'id':id},
                   function(retorno){
                  
                    if(retorno){
                        
                        $("#btnSalvarDocumento"+id).button('reset');
                        alert("Erro ao Salvar Informações, tente novamente!");
                        
                    }else{
                      
                        $("#btnSalvarDocumento"+id).button('reset');
                        $(".btnFechaDocumento"+id).trigger('click');
                        alert("Informações salva com sucesso!");
                      
                    }      
                  
                });
                
            }
               
        });
    
    }
    
    function tabela(page){
        
        $('#tblLista > tbody').html('<tr><td colspan="7">....Aguarde....</td></tr>');
        
        var ra      = $("#txtRaFiltro").val();
        var nome    = $("#txtNomeFiltro").val();
        var email   = $.trim($("#txtEmailFiltro").val());
        var estagio = $("#cmbDocumentoFiltro").val();
        var empresa = $("#cmbEmpresaFiltro").val();
        var status  = $("#cmbStatusFiltro").val();
        
        var filtro  = new Object();
        
        filtro ={'ra':ra,
                 'nome':nome,
                 'email':email,
                 'status':status,
                 'estagio':estagio,
                 'empresa':empresa};
        
        $.post('<?=base_url('supervisor/aluno/listar_aluno');?>',
        {'page':page,'filtro':filtro},
            function(retorno){
                
                $("#tblLista > tbody").html(retorno.html);
                $('.paginacao').html(retorno.paginacao);
           
        },'json');
        
    }
    
    function limpar_campos(){
        
        $("#txtID").val('');
        $("#txtNome").val('').focus();
        $("#txtEmail").val('');
        $("#txtRa").val('');
        $("#txtCPF").val('');
        $("#txtRG").val('');
        $("#cmbDocumento").val(0);
        $("#cmbEmpresa").select2("val", "");
        $("#txtNascimento").val('');
        $("#cmbSexo").val("M");
        $("#txtTelefone").val('');
        $("#txtCelular").val('');
        $("#txtCEP").val('');
        $("#cmbEstado").val(0);
        $("#txtCidade").val('');
        $("#txtRua").val('');
        $("#txtNumero").val('');
        $("#txtBairro").val('');
        $("#txtComplemento").val('');
        $("#btnSalvar").button('reset');
        
    }
    
    function listar_estagio(){
        
        $.post('<?=base_url('supervisor/aluno/listar_estagio');?>',
        {},
            function(retorno){
                
                $("#cmbDocumento").html(retorno);
           
        });
    
    }
    
    function dados_documento(id,tipo){
        
        $.post('<?=base_url('supervisor/aluno/listar_documento');?>',
        {'id':id,'tipo':tipo},
        
            function(retorno){
                
                if(tipo==1){
                    
                    $("#i1"+id).val(retorno.i1);
                    $("#i2"+id).val(retorno.i2);
                    $("#i3"+id).val(retorno.i3);
                    $("#i4"+id).val(retorno.i4);
                    $("#f1"+id).val(retorno.f1);
                    $("#f2"+id).val(retorno.f2);
                    $("#f3"+id).val(retorno.f3);
                    $("#f4"+id).val(retorno.f4);
                    
                }else if(tipo==2){
                
                    $("#e1"+id).val(retorno.e1);
                    $("#e2"+id).val(retorno.e2);
                    $("#e3"+id).val(retorno.e3);
                
                }
           
        },'json');
        
    }
    
    function emailmultiplo(){
        
        $.post('<?=base_url('supervisor/aluno/listar_aluno_email');?>',
        {},
            function(retorno){
             
                $(".spAvisoEmail").html('').hide();
                $("#cmbEmailAluno").select2("val", "");  
                $("#cmbEmailAluno").html(retorno);
           
        });
        
    }
    
    function lista_email(){
        
        var email = $("#cmbEmailAluno").val();
        var assunto = $("#txtAssuntoEmailAluno").val();
        var mensagem = CKEDITOR.instances.txtMensagemEmailAluno.getData();
        
        $.post('<?=base_url('supervisor/aluno/disparar_email_aluno');?>',
        {'email':email,'assunto':assunto,'mensagem':mensagem},
            function(retorno){
                
                if(retorno==true){
                    $(".emailmultiploaluno").modal('hide');
                    $("#cmbEmailAluno").select2("val", "");  
                    $("#cmbEmailAluno").html(retorno); 
                    $("#txtAssuntoEmailAluno").val('');
                    CKEDITOR.instances.txtMensagemEmailAluno.setData('');
                }else{
                    $(".spAvisoEmail").addClass('text-danger').html("<strong>"+retorno+"<strong>").show();
                }
                
        });
     
    }
    
    function empresa(){
        
        $.post('<?=base_url('supervisor/aluno/listar_empresa');?>',
        {},
            function(retorno){
                
                $("#cmbEmpresa").html(retorno);
                $("#cmbEmpresaFiltro").html(retorno);
           
        });
        
    }
    
</script>