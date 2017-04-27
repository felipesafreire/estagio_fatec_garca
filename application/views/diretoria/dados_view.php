
    <div class="panel panel-default">

        <div class="panel-heading">
            <h4>Alterar Dados</h4>
        </div>

        <div class="panel-body">

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
                        <label class="control-label">Nome</label>
                        <input type="text" class="form-control" id="txtNome">
                    </div>

                </div>

            </div>
            
        </div>
        
        <div class="panel-footer">
            
            <button class="btn  btn-primary" id="btnSalvar" data-loading-text="Aguarde...">Salvar</button>
            <div class="spAviso"></div>
            
        </div>

    </div>


<script>

    $(document).ready(function(){
        
        dados();
        
        $("#btnSalvar").click(function(){
           
           var email = $.trim($("#txtEmail").val());
           var nome  = $("#txtNome").val();
           
           $(".spAviso").hide();
           $(".has-error").removeClass('has-error');
           
           if(email==""){
               
               $("#txtEmail").parent('.form-group').addClass('has-error');
               
           }
           if(nome==""){
               
               $("#txtNome").parent('.form-group').addClass('has-error');
               
           }
           if($(".has-error").length > 0){
               
               $(".spAviso").addClass('text-danger').html('<br>Verifique os campos antes de continuar...').show();
               
           }else{
               
               $("#btnSalvar").button('loading');
               
               $.post('<?=base_url('diretoria/dashboard/salvar_dados');?>',
               {
                   'email':email,
                   'nome':nome
               },
                function(retorno){
                  
                  if(retorno==true){
                      
                      $(".spAviso").addClass('text-primary').html('<br>Dados alterados com sucesso...').show();
                      $("#btnSalvar").button('reset');
                      dados();
                      
                  }else{
                      
                      $(".spAviso").addClass('text-danger').html('<br><strong>'+retorno+'<strong>').show();
                      $("#btnSalvar").button('reset');
                  }      
                  
                });
               
           }
            
        });
        
    });    
    
    function dados(){
    
    $.post('<?=base_url('diretoria/dashboard/listar_dados');?>',
    {},
    function(retorno){

        $("#txtEmail").val(retorno.email);
        $("#txtNome").val(retorno.nome);

    },'json');
    }
        
</script>