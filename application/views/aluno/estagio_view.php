
<h2>Estágio</h2>
  
<div class="line" style="margin-bottom: 10px;">
    
    <div class="margin">
    
        <div class="right">

            <div class="btn-group">
                <button type="button" class="btn btn-primary">Exportar</button>
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="<?=base_url('aluno/dashboard/gera_pdf');?>" target="_blank">Exportar para PDF</a></li>
                </ul>
            </div>

        </div>

    </div>    
    
</div>

<div class="line">
    
    <div class="margin">
        
        <div class="consulta">Aguarde...</div>
        
    </div>
    
</div>

<script>
   
   $(document).ready(function(){
       
       estagio();
       
   });
   
   function estagio(){
       
        $.post('<?=base_url('aluno/dashboard/estagio');?>',
        {},
        function(retorno){

            $(".consulta").html(retorno);

        });
       
   }
   
</script>