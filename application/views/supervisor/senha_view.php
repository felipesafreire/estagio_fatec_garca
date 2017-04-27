
    <div class="panel panel-default">

        <div class="panel-heading">
            <h4>Alterar Senha</h4>
        </div>

        <div class="panel-body">

            <div class="row">

                <div class="col-lg-12 col-md-12">

                    <div class="form-group">
                        <label class="control-label">Senha Atual</label>
                        <input type="password" class="form-control" id="txtSenha">
                    </div>

                </div>

            </div>
            
            <div class="row">

                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Nova Senha</label>
                        <input type="password" class="form-control" id="txtNovasenha">
                    </div>

                </div>
                
                <div class="col-lg-6 col-md-6">

                    <div class="form-group">
                        <label class="control-label">Repete Senha</label>
                        <input type="password" class="form-control" id="txtRepetesenha">
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
        
        $("#btnSalvar").click(function(){
           
           var senha       = $("#txtSenha").val();
           var novasenha   = $("#txtNovasenha").val();
           var repetesenha = $("#txtRepetesenha").val();
           
           $(".spAviso").hide();
           $(".has-error").removeClass('has-error');
           
           if(senha==""){
               
               $("#txtSenha").parent('.form-group').addClass('has-error');
               
           }
           if(novasenha==""){
               
               $("#txtNovasenha").parent('.form-group').addClass('has-error');
               
           }
           if(repetesenha==""){
               
               $("#txtRepetesenha").parent('.form-group').addClass('has-error');
               
           }
           if(novasenha!=repetesenha){
               
               alert("Senhas não conferem");
               
           }
           if($(".has-error").length > 0){
               
               $(".spAviso").addClass('text-danger').html('<br>Verifique os campos antes de continuar...').show();
               
           }else{
               
               $("#btnSalvar").button('loading');
               
               $.post('<?=base_url('supervisor/dashboard/alterar_senha');?>',
               {
                   'senha':senha,
                   'novasenha':novasenha,
                   'repetesenha':repetesenha
               },
                function(retorno){
                  
                  if(retorno==true){
                      
                      $(".spAviso").addClass('text-primary').html('<br>Dados alterados com sucesso...').show();
                      $("#btnSalvar").button('reset');
                      
                  }else{
                      
                      $(".spAviso").addClass('text-danger').html('<br><strong>'+retorno+'<strong>').show();
                      $("#btnSalvar").button('reset');
                  }      
                  
                });
               
           }
            
        });
        
    });    
        
</script>