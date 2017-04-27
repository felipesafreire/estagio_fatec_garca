<div class="panel " style="background-color: #2196F3!important;">
    <div class="panel-body text-white">
       <h2 class="animated fadeInUp"><i class="fa fa-university"></i> Alunos</h2>
        <div class="col-md-12 padding-0">
            <div style="padding-top:8px;" class="text-left col-md-6 col-lg-6">
                <h4 class="text-white">Quantidade de Alunos: <?=$dados->qtde_aluno;?></h4>
            </div>
            <div style="padding-top:8px;" class="text-right col-md-6 col-lg-6">
                <a href="<?=base_url('supervisor/aluno');?>" title="Alunos"><button class="btn btn-default">Acessar Alunos</button></a>
            </div>
        </div>
    </div>
</div>

<div class="panel bg-green">
    <div class="panel-body text-white">
       <h2 class="animated fadeInUp"><i class="fa-home fa"></i> Empresas</h2>
        <div class="col-md-12 padding-0">
            <div style="padding-top:8px;" class="text-left col-md-6 col-lg-6">
                <h4 class="text-white">Quantidade de Empresas: <?=$dados->qtde_empresa;?></h4>
            </div>
            <div style="padding-top:8px;" class="text-right col-md-6 col-lg-6">
                <a href="<?=base_url('supervisor/empresa');?>" title="Empresa"><button class="btn btn-default">Acessar Empresas</button></a>
            </div>
        </div>
    </div>
</div>

<div class="panel bg-red">
    <div class="panel-body text-white">
       <h2 class="animated fadeInUp"><i class="icons icon-feed"></i> Vagas de Estágio</h2>
        <div class="col-md-12 padding-0">
            <div style="padding-top:8px;" class="text-left col-md-6 col-lg-6">
                <h4 class="text-white">Quantidade de Vagas: <?=$dados->qtde_vaga;?></h4>
            </div>
            <div style="padding-top:8px;" class="text-right col-md-6 col-lg-6">
              <a href="<?=base_url('supervisor/estagio');?>" title="Vaga de Estágio"><button class="btn btn-default">Acessar Vagas de Estágio</button></a>
            </div>
        </div>
    </div>
</div>