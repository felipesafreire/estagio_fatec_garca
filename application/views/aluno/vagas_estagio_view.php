
<div class="container-fluid">
    
    <h2>Vagas de Estágio</h2>

    <hr>

    <div class="row" style="margin-top: 20px;">

        <div class="col-lg-12 col-md-12">

            <div class="consulta"><h3>Aguarde...</h3></div>

        </div>

    </div>

</div>

<script>
   
   $(document).ready(function(){
       
        $(".active").each(function(i) {
       
            var id =  $(this).attr('id');
            
            $(".consulta").html("<h3>Aguarde...</h3>");
            
            $.post('<?=base_url('aluno/estagio/vaga_curso');?>',
            {'id':id},
            function(retorno){

                $(".consulta").html(retorno);

            });
            
        });
        
        $(".link-curso").click(function(){
           
            $(".consulta").html("<h3>Aguarde...</h3>");
           
            var id =  $(this).attr('id');
            
            $.post('<?=base_url('aluno/estagio/vaga_curso');?>',
            {'id':id},
            function(retorno){

                $(".consulta").html(retorno);

            });
           
        });
              
   });
   
   function estagio(){
       
        $.post('<?=base_url('aluno/dashboard/estagio');?>',
        {},
        function(retorno){

            $(".consulta").html(retorno);

        });
       
   }
   
</script>