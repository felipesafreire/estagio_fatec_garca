
    <div class="panel panel-default" id="panelList">

        <div class="panel-heading">
            <h4>Cursos</h4>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <button class="btn btn-primary" id="btnAdicionar"><span class="icons icon-user-follow"></span> Adiocionar Curso</button>

                </div>

            </div>
            
            <div class="row">
                
                <div class="col-lg-12 col-md-12">
                
                    <table class="table table-responsive table-condensed table-hover table-bordered table-striped" id="tblLista" style="margin-top: 10px;">

                        <thead>

                            <tr>
                                <th>Título</th>
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
            <h4>Adicionar Curso</h4>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <div class="form-group">
                        <label class="control-label">Título do Curso</label>
                        <input type="text" class="form-control" id="txtTitulo">
                    </div>

                </div>

            </div>
            
            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <div class="form-group">
                        <label class="control-label">Status do Curso</label>
                        <select class="form-control" id="cmbStatus">
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
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


<script>

    $(document).ready(function(){
        
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
           
           var titulo   = $("#txtTitulo").val();
           var id       = $("#txtID").val();
           var status   = $("#cmbStatus").val();
           
           $(".spAviso").hide();
           $(".has-error").removeClass('has-error');
           
           if(titulo==""){
               
               $("#txtTitulo").parent('.form-group').addClass('has-error');
               $("#txtTitulo").focus();
           }
           if($(".has-error").length > 0){
               
               $(".spAviso").addClass('text-danger').html('<br>Verifique os campos antes de continuar...').show();
               
           }else{
               
               $("#btnSalvar").button('loading');
               
               $.post('<?=base_url('admin/curso/salvar_curso');?>',
               {
                   'titulo':titulo,
                   'id':id,
                   'status':status,
                   
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
            
            $.post('<?=base_url('admin/curso/dados_curso');?>',
               {
                   'id':id,   
               },
                function(retorno){
                    
                    $("#panelList").hide();
                    $("#panelAdd").show();
                 
                    $("#txtTitulo").val(retorno.titulo);
                    $("#cmbStatus").val(retorno.status);
                  
                },'json');
            
        });
        
        $('body').on('click','.link-inativar',function(){
        
            var id = $(this).attr('id');
            $("#txtID").val(id);
             if (!confirm("Deseja realmente inativar o curso?")){return;}
            $.post('<?=base_url('admin/curso/inativar_curso');?>',
               {
                   'id':id,   
               },
                function(retorno){
                    
                    tabela();  
                  
                });
            
        });
        
        $('body').on('click','.link-ativar',function(){
        
            var id = $(this).attr('id');
            $("#txtID").val(id);
             if (!confirm("Deseja realmente ativar o curso?")){return;}
            $.post('<?=base_url('admin/curso/ativar_curso');?>',
               {
                   'id':id,   
               },
                function(retorno){
                    
                    tabela();  
                  
                });
            
        });
        
        tabela();
        

    });
 
    function tabela(){
        
        $.post('<?=base_url('admin/curso/listar_curso');?>',
        {},
            function(retorno){
                
                $("#tblLista > tbody").html(retorno);
           
        },'json');
        
    }
    function limpar_campos(){
        
        $("#txtTitulo").val('');
        $("#txtID").val('');
        $("#cmbPeriodo").val(0);
        $("#btnSalvar").button('reset');
    }
    
</script>