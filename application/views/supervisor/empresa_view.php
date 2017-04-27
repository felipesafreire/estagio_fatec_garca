
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

                <div class="col-lg-6 col-md-6">

                    <button class="btn btn-primary" id="btnAdicionar"><span class="icons icon-user-follow"></span> Cadastrar Empresa</button>

                </div>
                
                <div class="col-lg-6 col-md-6 paginacao">    
                            
                </div>

            </div>
            
            <div class="row">
                
                <div class="col-lg-12 col-md-12">
                
                    <table class="table table-responsive table-condensed table-hover table-bordered table-striped" id="tblLista" style="margin-top: 10px;">

                        <thead>

                            <tr>
                                <th>Empresa</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Contato</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">CNPJ</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Cidade</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">CEP</th>
                                <th style="text-align: center;" class="hidden-xs hidden-sm">Endereço</th>
                                <th style="text-align: center; max-width: 100px;">
                                    
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm"><strong>Exportar</strong></button>
                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                          <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="javascript:" class="gera-pdf">Exportar para PDF</a></li>
                                            <li><a href="javascript:" class="gera-excel">Exportar para Excel</a></li>
                                        </ul>
                                    </div>
                                    
                                </th>
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

    <div class="panel panel-default" id="panelAdd">

        <div class="panel-heading">
            <h4>Cadastrar Empresa</h4>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Nome da Empresa</label>
                        <input type="text" class="form-control" id="txtNome">
                    </div>

                </div>
                
                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">CNPJ</label>
                        <input type="text" class="form-control" id="txtCNPJ">
                    </div>

                </div>

            </div>
            
            <div class="row">

                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Responsável pela empresa</label>
                        <input type="text" class="form-control" id="txtResponsavel">
                    </div>

                </div>
                
                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Telefone de Contato</label>
                        <input type="text" class="form-control" id="txtTelefone">
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

<script src="<?=base_url('assets/js/plugins/mask/jquery.maskedinput.js');?>"></script>
<script>

    $(document).ready(function(){
        
        $("#txtCNPJ").mask("99999.999/9999-99",{placeholder:" _"});
        $("#txtCNPJFiltro").mask("99999.999/9999-99",{placeholder:" _"});
        $("#txtCEP").mask("99999-999",{placeholder: "_"});
        
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
        
        $(".gera-pdf").click(function(){
           
            var nome = $("#txtEmpresaFiltro").val();
            var cnpj = $("#txtCNPJFiltro").val();

            var filtro = new Object();

            filtro = {'nome':nome,
                      'cnpj':cnpj};
        
            $.post('<?=base_url('supervisor/empresa/pdf');?>',
            {'filtro':filtro},
            function(data){
                
                window.open(data, '_blank');
                
            });
           
        });
        
        $(".gera-excel").click(function(){
           
            var nome = $("#txtEmpresaFiltro").val();
            var cnpj = $("#txtCNPJFiltro").val();

            var filtro = new Object();

            filtro = {'nome':nome,
                      'cnpj':cnpj};
        
            $.post('<?=base_url('supervisor/empresa/excel');?>',
            {'filtro':filtro},
            function(data){
                
                window.open(data, '_blank');
                
            });
           
        });
        
        $("#btnSalvar").click(function(){
           
           var id           = $("#txtID").val();
           var nome         = $("#txtNome").val();
           var responsavel  = $("#txtResponsavel").val();
           var contato      = $("#txtTelefone").val();
           var cnpj         = $("#txtCNPJ").val();
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
           if(cnpj==""){
               
               $("#txtCNPJ").parent('.form-group').addClass('has-error');
               
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
               
               $.post('<?=base_url('supervisor/empresa/salvar_empresa');?>',
               {
                    'id':id,
                    'nome':nome,
                    'responsavel':responsavel,
                    'contato':contato,
                    'cnpj':cnpj,
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
        
            var id = $(this).attr('id');
            $("#txtID").val(id);
            
            $.post('<?=base_url('supervisor/empresa/dados_empresa');?>',
               {
                   'id':id,   
               },
                function(retorno){
                    
                    $("#panelList").hide();
                    $("#panelAdd").show();
                 
                    $("#txtNome").val(retorno.nome).focus();
                    $("#txtCNPJ").val(retorno.cnpj);
                    $("#txtCEP").val(retorno.cep);
                    $("#txtResponsavel").val(retorno.responsavel);
                    $("#txtTelefone").val(retorno.contato);
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
        

    });
 
    function tabela(page){
        
        $('#tblLista > tbody').html('<tr><td colspan="3">....Aguarde....</td></tr>');
        
        var nome = $("#txtEmpresaFiltro").val();
        var cnpj = $("#txtCNPJFiltro").val();
        
        var filtro = new Object();
        
        filtro = {'nome':nome,
                  'cnpj':cnpj};
        
        $.post('<?=base_url('supervisor/empresa/listar_empresa');?>',
        {'page':page,'filtro':filtro},
            function(retorno){
                
                $("#tblLista > tbody").html(retorno.html);
                $('.paginacao').html(retorno.paginacao);
           
        },'json');
        
    }
    
    function limpar_campos(){
        
        $("#txtID").val('');
        $("#txtNome").val('').focus();
        $("#txtCNPJ").val('');
        $("#txtResponsavel").val('');
        $("#txtTelefone").val('');
        $("#txtCEP").val('');
        $("#cmbEstado").val(0);
        $("#txtCidade").val('');
        $("#txtRua").val('');
        $("#txtNumero").val('');
        $("#txtBairro").val('');
        $("#txtComplemento").val('');
        $("#btnSalvar").button('reset');
        
    }
    
</script>