<div class="line">

    <h2 style="margin-bottom: 10px;">Alterar Senha</h2>
    
</div>

<form class="customform">

    <div class="line">

        <div class="margin">

            <div class="s-12 l-12">
                
                <div class="form-group">
                    <label class="control-label">Senha Atual</label>
                    <input class="form-control" id="txtSenhaAtual" type="password" placeholder="Senha Atual">
                </div>

            </div>

        </div>

    </div>
    
    <div class="line">

        <div class="margin">

            <div class="s-12 l-12">

                <div class="form-group">
                    <label class="control-label">Nova Senha</label>
                    <input class="form-control" id="txtNovaSenha" type="password" placeholder="Nova Senha">
                </div>
                
            </div>

        </div>

    </div>
    
    <div class="line">

        <div class="margin">

            <div class="s-12 l-12">

                <div class="form-group">
                    <label class="control-label">Repete Senha</label>
                    <input class="form-control" id="txtRepetesenha" type="password" placeholder="Repete Senha">
                </div>

            </div>

        </div>

    </div>
 
</form>

    <div class="s-12 l-2">
        <button class="btn btn-primary" id="btnAlterarSenha">Alterar Senha</button>    
    </div>
    <div id="spAviso"></div>

<script>

    $(document).ready(function(){
        
        $("#btnAlterarSenha").click(function(){
           
            $("#spAviso").hide();
           
            $(".has-error").removeClass("has-error");
           
            if($.trim($("#txtSenhaAtual").val())==""){
               
                $("#txtSenhaAtual").parent('div').addClass('has-error');
               
            }
            if($.trim($("#txtNovaSenha").val())==""){
               
                $("#txtNovaSenha").parent('div').addClass('has-error');
               
            }
            if($.trim($("#txtRepetesenha").val())==""){
               
                $("#txtRepetesenha").parent('div').addClass('has-error');
               
            }
            if($(".has-error").length > 0){
               
                $("#spAviso").addClass('text-danger').html("<strong>Verifique os campos para continuar...</strong>").show();
               
            }else{
           
                
           
                $.post('<?=base_url('aluno/dashboard/alterar_senha');?>',
                {
                    'senha':$.trim($("#txtSenhaAtual").val()),
                    'novasenha':$.trim($("#txtNovaSenha").val()),
                    'repetesenha': $.trim($("#txtRepetesenha").val())
                },
                function(retorno){

                    if(retorno==true){
                        $("#txtSenhaAtual").val('');
                        $("#txtNovaSenha").val('');
                        $("#txtRepetesenha").val('');
                        $("#spAviso").addClass('text-blue').html("<strong>Senha alterada com sucesso</strong>").show();
                    }else{
                        $("#spAviso").addClass('text-danger').html("<strong>"+retorno+"</strong>").show();
                    }

                });
            
           
           }
           
        });
        
    });


</script>


                              