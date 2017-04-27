<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno extends MY_Controller {
    

function __construct(){

        parent::__construct();
        $this->load->model('supervisor/Aluno_model', 'aluno');
        
    }
    
    public function index(){

        if($this->session->userdata('id_cood')){
        
            $data['nome']       = $this->session->userdata('nome_cood');
            $data['curso']      = $this->model->sql("select titulo from curso where id = ? ",  $this->model->id_curso())->row()->titulo; 
            $data['periodo']    = $this->model->sql("select periodo from periodo_curso where id = ? ",  $this->model->id_periodo())->row()->periodo; 
            $data['page']       = 'aluno';
            
            $this->load->view('supervisor/body_view',$data);
            
        }else{
        
            redirect(base_url('supervisor/dashboard/login'));    
            
        }
        
    }
    
    public function salvar_aluno(){
        
        $id    = $this->encrypt->decode($this->input->post('id'));
          
        $dados = array('nome'           =>  $this->input->post('nome'),
                       'email'          =>  $this->input->post('email'),
                       'cpf'            =>  $this->input->post('cpf'),
                       'rg'             =>  $this->input->post('rg'),
                       'ra'             =>  $this->input->post('ra'),
                       'estagio'        =>  $this->input->post('estagio'),
                       'empresa'        =>  $this->input->post('empresa'),
                       'nascimento'     =>  $this->input->post('nascimento'),
                       'sexo'           =>  $this->input->post('sexo'),
                       'telefone'       =>  $this->input->post('telefone'),
                       'celular'        =>  $this->input->post('celular'),
                       'cep'            =>  $this->input->post('cep'),
                       'uf'             =>  $this->input->post('uf'),
                       'rua'            =>  $this->input->post('rua'),
                       'cidade'         =>  $this->input->post('cidade'),
                       'numero'         =>  $this->input->post('numero'),
                       'bairro'         =>  $this->input->post('bairro'),
                       'complemento'    =>  $this->input->post('numero'));
        
        if(empty($dados['nome'])){
            die("Nome Obrigatório.");
        }
        if(empty($dados['ra'])){
            die("RA Obrigatório.");
        }
        if(empty($dados['email'])){
            die("E-mail Obrigatório.");
        }
        if(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
            die("E-mail não válido.");
        }
        if(empty($dados['cpf'])){
            die("CPF Obrigatório.");
        }
        if($dados['estagio']==0){
            die("Tipo do estágio Obrigatório.");
        }
        if(empty($dados['empresa'])){
            die("Empresa Obrigatório.");
        }
        if(empty($dados['nascimento'])){
            die("Data de Nascimento Obrigatório.");
        }
        if(empty($dados['celular'])){
            die("Celular Obrigatório.");
        }
        
        if(empty($dados['uf'])){
            
            die('Estado Obrigatório');
            
        }
        if(empty($dados['cidade'])){
            
            die('Cidade Obrigatório');
            
        }
        if(empty($dados['cep'])){
            
            die('CEP Obrigatório');
            
        }
        if(empty($dados['rua'])){
            
            die('Rua Obrigatório');
            
        }
        if(empty($dados['numero'])){
            
            die('Número Obrigatório');
            
        }
        if(empty($dados['bairro'])){
            
            die('Bairro Obrigatório');
            
        }
        
        if(!validarCep($dados['cep'])){
            
            die('CEP não válido');
            
        }
        if(!@validaCPF($dados['cpf'])){
            
            die('CPF não válido');
            
        }
        
        if(empty($id)){
            
            if($this->aluno->verifica_email($dados['email'])){
                die("Aluno já cadastrado (E-mail em uso)");
            }
            if($this->aluno->verifica_ra($dados['ra'])){
                die("Aluno já cadastrado (RA já cadastrado)");
            }
            if($this->aluno->verifica_cpf($dados['cpf'])){
                die("Aluno já cadastrado (CPF ja cadastrado)");
            }
            
            $x = $this->aluno->salvar_aluno($dados);
            
            if($x['result']){
                
                $nome       = 'Sistema de Estágio';
                $destino    = $dados['email'];
                $assunto    = "Dados de acesso ao Sistema de Estágio";
                $mensagem   = "Olá, você está recebendo este e-mail para finalizar o
                               processo de cadastro do seu estágio
                               <strong>para realizar a consulta dos documentos entregues
                               </strong>.<br><br>

                               Seus dados temporários de acesso são:<br>
                               <strong>RA:</strong> ".$dados['ra']."<br>
                               <strong>Senha:</strong> ".$x['senha']."<br><br>
                               
                    <a href='".base_url()."' style='text-align:center;font-size:14px;
                    text-decoration:none; color:black;'>
                    <strong>Clique aqui para finalizar o cadastro</strong></a><br><br>
                                   ";
                
                $this->template_email($nome, $destino, $assunto, $mensagem);
                
            }else{
             
                
                
            }
            
        }else{
        
            if($this->aluno->verifica_email_editar($dados['email'],$id)){
                die("Aluno já cadastrado (E-mail em uso)");
            }
            if($this->aluno->verifica_ra_editar($dados['ra'],$id)){
                die("Aluno já cadastrado (RA já cadastrado)");
            }
            if($this->aluno->verifica_cpf_editar($dados['cpf'],$id)){
                die("Aluno já cadastrado (CPF ja cadastrado)");
            }
            
            switch($dados['estagio']):
                
                case "1":   $this->aluno->verifica_documento($id, $dados['estagio']);  
                    
                            break;
                        
                case "2":   $this->aluno->verifica_documento($id, $dados['estagio']);  
                    
                            break;        
                
            endswitch;
            
            echo $this->aluno->editar_aluno($dados, $id);
            
        }
        
    }
    
    public function listar_estagio(){
        
        $dados = $this->aluno->listar_estagio();
        
        $html = "<option value='0' selected>Selecione uma opção de Estágio</option>";
        
        foreach($dados as $item):
            
            $html .= "<option value='$item->id'>$item->titulo</option>";
            
        endforeach;
        
        echo $html;
        
    }
    
    public function listar_empresa(){
        
        $dados = $this->aluno->listar_empresa();
        
        $html = "";
        
        foreach($dados as $item):
            
            $html .= "<option value='$item->id'>$item->nome - CNPJ: ".$item->cnpj."</option>";
            
        endforeach;
        
        echo $html;
        
    }
    
    public function listar_aluno(){
        
        $dados = $this->aluno->listar_alunos($this->input->post('page'),
                                             $this->input->post('filtro'));
        $html  = "";
        
        foreach ($dados as $item):
            
            $menu_documento       = "";
            $conteudo_documento   = "";
            
            $id = $this->encrypt->encode($item->id);
        
            if(empty($item->telefone)):
                
                $telefone = ''; 
            
            else:
                
                $telefone = mask($item->telefone,'(##) ####-####') . '<br>';
                
            endif;
            
            if($item->tipo_estagio==1){
                
                $menu_documento .= "<li role='presentation' class='active'>
                                        <a href='#tabs-demo7-area1' class='documentoinicial' id='tabs-demo6-1' role='tab' data-toggle='tab' aria-expanded='true'>Documentos Iniciais</a>
                                    </li>
                                    <li role='presentation'>
                                        <a href='#tabs-demo7-area2' class='documentofinal' role='tab' id='tabs-demo6-2' data-toggle='tab' aria-expanded='false'>Documentos Finais</a>
                                    </li>"; 
                
                $conteudo_documento .= "<div role='tabpanel' class='tab-pane fade active documentoinicial in' id='tabs-demo7-area1' aria-labelledby='tabs-demo7-area1'>
                                            
                                            <div class='row'>

                                                <div class='col-md-6 col-lg-6'>
                                                
                                                    <div class='form-group'>
                                                        <label class='control-label'>Convênio de Concessão de Estágio</label>
                                                        <select class='form-control' id='i1$item->id'>
                                                            <option value='0' selected>Documento Não Entregue</option>
                                                            <option value='1'>Documento Entregue</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class='col-md-6 col-lg-6'>
                                                
                                                    <div class='form-group'>
                                                        <label class='control-label'>Termo de Compromisso de Estágio</label>
                                                        <select class='form-control' id='i2$item->id'>
                                                            <option value='0' selected>Documento Não Entregue</option>
                                                            <option value='1'>Documento Entregue</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>

                                            </div>
                                            
                                            <div class='row'>

                                                <div class='col-md-6 col-lg-6'>
                                                
                                                    <div class='form-group'>
                                                        <label class='control-label'>Plano de Atividades de Estágio</label>
                                                        <select class='form-control' id='i3$item->id'>
                                                            <option value='0' selected>Documento Não Entregue</option>
                                                            <option value='1'>Documento Entregue</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class='col-md-6 col-lg-6'>
                                                
                                                    <div class='form-group'>
                                                        <label class='control-label'>Apólice de Seguro</label>
                                                        <select class='form-control' id='i4$item->id'>
                                                            <option value='0' selected>Documento Não Entregue</option>
                                                            <option value='1'>Documento Entregue</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>

                                            </div>
                                            
                                        </div>
                                      
                                        <div role='tabpanel' class='tab-pane fade documentofinal' id='tabs-demo7-area2' aria-labelledby='tabs-demo7-area2'>
                                        
                                            <div class='row'>

                                                <div class='col-md-6 col-lg-6'>
                                                
                                                    <div class='form-group'>
                                                        <label class='control-label'>Relatório Final Simplificado</label>
                                                        <select class='form-control' id='f1$item->id'>
                                                            <option value='0' selected>Documento Não Entregue</option>
                                                            <option value='1'>Documento Entregue</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class='col-md-6 col-lg-6'>
                                                
                                                    <div class='form-group'>
                                                        <label class='control-label'>Relatório para Supervisão de Estágio</label>
                                                        <select class='form-control' id='f2$item->id'>
                                                            <option value='0' selected>Documento Não Entregue</option>
                                                            <option value='1'>Documento Entregue</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>

                                            </div>
                                            
                                            <div class='row'>

                                                <div class='col-md-6 col-lg-6'>
                                                
                                                    <div class='form-group'>
                                                        <label class='control-label'>Modelo de Relatório Final Completo</label>
                                                        <select class='form-control' id='f3$item->id'>
                                                            <option value='0' selected>Documento Não Entregue</option>
                                                            <option value='1'>Documento Entregue</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class='col-md-6 col-lg-6'>
                                                
                                                    <div class='form-group'>
                                                        <label class='control-label'>Ficha de Avaliação de Desempenho do Estagiário</label>
                                                        <select class='form-control' id='f4$item->id'>
                                                            <option value='0' selected>Documento Não Entregue</option>
                                                            <option value='1'>Documento Entregue</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>

                                            </div>
                                            
                                        </div>"; 
                
            }else{
                
                $menu_documento .= "<li class='' role='presentation' class='active'>
                                        <a href='#tabs-demo7-area3' class='documentoequivalencia' id='tabs-demo6-3' role='tab' data-toggle='tab' aria-expanded='false'>Documentos para Equivalência</a>
                                    </li>"; 
                
                $conteudo_documento .= "<div role='tabpanel' class='tab-pane fade active documentoequivalencia in' id='tabs-demo7-area3' aria-labelledby='tabs-demo7-area3'>
                                        
                                            <div class='row'>

                                                <div class='col-md-4 col-lg-4'>
                                                
                                                    <div class='form-group'>
                                                        <label class='control-label'>Processo de Equivalência</label>
                                                        <select class='form-control' id='e1$item->id'>
                                                            <option value='0' selected>Documento Não Entregue</option>
                                                            <option value='1'>Documento Entregue</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class='col-md-4 col-lg-4'>
                                                
                                                    <div class='form-group'>
                                                        <label class='control-label'>Plano de Atividades para Equivalência</label>
                                                        <select class='form-control' id='e2$item->id'>
                                                            <option value='0'>Documento Não Entregue</option>
                                                            <option value='1'>Documento Entregue</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class='col-md-4 col-lg-4'>
                                                
                                                    <div class='form-group'>
                                                        <label class='control-label'>Modelo de Relatório Final Completo</label>
                                                        <select class='form-control' id='e3$item->id'>
                                                            <option value='0' selected>Documento Não Entregue</option>
                                                            <option value='1'>Documento Entregue</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>

                                            </div>
                                            
                                            <div class='row'>
                                    
                                                <div class='col-md-12 col-lg-12'>

                                                    
                                                    <div class='spAvisoDoc$item->id'></div>    
                                                    
                                                </div>    

                                            </div>
                                        
                                        </div>"; 
                
            }
            
            if($item->status==1){
                $status      = "<span class='label label-success'>Ativo</span>";
                $menu_status = "<li><a href='javascript:' class='link-inativar' id='".$id."'>Inativar Aluno</a></li>";
            }else{
                $status      = "<span class='label label-danger'>Inativo</span>";
                $menu_status = "<li><a href='javascript:' class='link-ativar' id='".$id."'>Ativar Aluno</a></li>";
            }
            
            
            
            $html .= "  <tr>
                
                            <td style='vertical-align:middle;'>$item->nome<br>$item->email</td>
                            <td style='vertical-align:middle; text-align:center;'  class='hidden-xs hidden-sm'>$status</td>
                            <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>$item->estagio</td>
                            <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>  ".$item->ra."<br>
                                                                                                                ".mask($item->cpf,'###.###.###-##')."<br>
                                                                                                                ".(!empty($item->rg)?mask($item->rg,'##.###.###-#'):"")."    
                                                                                                             </td>
                            <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm hidden-md'>".$item->empresa." <br>". mask($item->cnpj,'##.###.###/####-##')."</td>
                            <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>". $telefone .mask($item->celular,'(##) #####-####')."</td>
                            <td style='text-align:center; vertical-align:middle;'>

                              <div class='btn-group' role='group'>
                                  <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                  <strong>Ações</strong>
                                  <span class='fa fa-angle-down'></span>
                                  </button>
                                  <ul class='dropdown-menu'>
                                    <li><a href='javascript:' class='link-alterar' id='".$id."'>Alterar Aluno</a></li>
                                    <li><a href='javascript:' class='link-documento' id='".$item->id."'>Documentos</a></li>
                                    <li><a href='javascript:' class='link-email' id='".$id."'>Enviar E-mail</a></li>
                                    ".$menu_status."
                                  </ul>
                              </div>

                            </td>
                          
                        </tr>
                        
                        <tr style='display: none;' class='documento$item->id'>
                            
                            <td colspan='7'>
                      
                                <div class='col-md-12 tabs-area'>

                                    <ul id='tabs-demo6' class='nav nav-tabs nav-tabs-v6' role='tablist'>
                                    
                                      ".$menu_documento."      
                                      
                                    </ul>
                                    
                                    <div id='tabsDemo6Content' class='tab-content tab-content-v6 col-md-12'>

                                        ".$conteudo_documento."
                                      
                                    </div>
                                    
                                </div>
                    
                                <div class='row'>

                                    <div class='col-md-12 col-lg-12'>

                                        <button type='button' data-loading-text='Aguarde...' class='btn btn-primary btnSalvarDocumento$item->id'>Salvar</button>    
                                        <button class='btn btn-danger btnFechaDocumento$item->id'>Fechar</button>
                                        <input type='hidden' id='txtTipoDocumento$item->id' value='".$item->tipo_estagio."'>      

                                        <script>

                                            $('body').on('click','.btnFechaDocumento$item->id',function(){

                                                $('.documento$item->id').hide();

                                            });

                                        </script>

                                    </div>

                                </div>
                    
                            </td>

                        </tr>";
            
        endforeach;
        
        if($html==""){
            
            $html .= "<tr><td colspan='7'>Não foi encontrado nenhum registro...</td><tr>";
            
        }
        
        echo json_encode(array('paginacao'  => $this->ajax_pagination->create_links(),
                               'html'       => $html));
        
    }
    
    public function dados_aluno(){
        
        $id = $this->encrypt->decode($this->input->post('id'));
        
        if(empty($id)){
            
            echo json_encode(array('error'=>true));
            
        }
        
        $dados = $this->aluno->dados_aluno($id);
        
        if($dados){
            
            echo json_encode(array('error'        => false,
                                   'nome'         => $dados->nome,
                                   'email'        => $dados->email,
                                   'ra'           => $dados->ra,
                                   'cpf'          => mask($dados->cpf,'###.###.###-##'),
                                   'rg'           => mask($dados->rg,'##.###.###-#'),
                                   'estagio'      => $dados->id_estagio,
                                   'empresa'      => $dados->id_empresa,
                                   'nascimento'   => inverteData($dados->dt_nascimento),
                                   'sexo'         => $dados->sexo,
                                   'telefone'     => empty($dados->telefone)?'':mask($dados->telefone,'(##) ####-###'),
                                   'celular'      => mask($dados->celular,'(##) #####-###'),
                                   'rua'          => $dados->rua,
                                   'bairro'       => $dados->bairro,
                                   'numero'       => $dados->numero,
                                   'complemento'  => $dados->complemento,
                                   'cep'          => mask($dados->cep,'#####-###'),
                                   'cidade'       => $dados->cidade,
                                   'uf'           => $dados->uf,
                ));
            
        }else{
            
            echo json_encode(array('error'=>true));
            
        }
        
    }
    
    public function salvar_documento(){
        
        $id = $this->input->post('id');
        $tipo = $this->input->post('tipo');
        
        switch($tipo):
            
            case  "1":  $dados = array('i1' => $this->input->post('i1'),
                                       'i2' => $this->input->post('i2'),
                                       'i3' => $this->input->post('i3'),
                                       'i4' => $this->input->post('i4'),
                                       'f1' => $this->input->post('f1'),
                                       'f2' => $this->input->post('f2'),
                                       'f3' => $this->input->post('f3'),
                                       'f4' => $this->input->post('f4'));
                
                        $this->aluno->verifica_documento($id, $tipo);  
                        
                        $verifica = $this->aluno->verifica_valor_curricular($id);

                        if($verifica):

                            $this->aluno->editar_documento_curricular($id,$dados);

                        else:    

                            $this->aluno->salvar_documento_curricular($id,$dados);

                        endif;
                
                        break;
                    
            case  "2":  $dados = array('e1' => $this->input->post('e1'),
                                       'e2' => $this->input->post('e2'),
                                       'e3' => $this->input->post('e3'));
                
                        $this->aluno->verifica_documento($id, $tipo);      

                        $verifica = $this->aluno->verifica_valor_equivalencia($id);

                        if($verifica):

                            $this->aluno->editar_documento_equivalencia($id,$dados);

                        else:    

                            $this->aluno->salvar_documento_equivalencia($id,$dados);

                        endif;
                       
                        break;
            
        endswitch;
        
    }
    
    public function listar_documento(){
        
        $id = $this->input->post('id');
        $tipo = $this->input->post('tipo');
        
        switch($tipo):
            
            case "1":   $dados = $this->aluno->listar_curricular($id);
                
                        if($dados){
                            
                            echo json_encode(array('error' => false,
                                                   'i1'    => empty($dados->i1)?0:$dados->i1,
                                                   'i2'    => empty($dados->i2)?0:$dados->i2,
                                                   'i3'    => empty($dados->i3)?0:$dados->i3,
                                                   'i4'    => empty($dados->i4)?0:$dados->i4,
                                                   'f1'    => empty($dados->f1)?0:$dados->f1,
                                                   'f2'    => empty($dados->f2)?0:$dados->f2,
                                                   'f3'    => empty($dados->f3)?0:$dados->f3,
                                                   'f4'    => empty($dados->f4)?0:$dados->f4));
                            
                        }else{
                            
                            echo json_encode(array('error' => true));
                        }
                        
                        break;
                    
            case "2":   $dados = $this->aluno->listar_equivalencia($id);
                
                        if($dados){
                            
                            echo json_encode(array('error' => false,
                                                   'e1'    => empty($dados->processo_equivalencia)?0:$dados->processo_equivalencia,
                                                   'e2'    => empty($dados->plano_ativ_equivalencia)?0:$dados->plano_ativ_equivalencia,
                                                   'e3'    => empty($dados->relatorio_final)?0:$dados->relatorio_final));
                            
                        }else{
                            
                            echo json_encode(array('error' => true));
                        }
                
                        break;        
            
        endswitch;
        
    }
    
    public function dados_email(){
        
        $id = $this->encrypt->decode($this->input->post('id'));
        
        if(empty($id)):
            die(json_encode(array('error'=>true, 'msg'=>'Erro... Tente novamente mais tarde!')));
        endif;
        
        $destinatario = $this->model->sql('select a.email
                                           from aluno a
                                           where a.id = ? ',$id)->row()->email;
        
        if($destinatario){
            
            echo json_encode(array('error'        => false,
                                   'origem'       => $this->model->email_cood(),
                                   'destinatario' => $destinatario));
            
        }else{
            
            echo json_encode(array('error'=> true));
            
        }
        
    }
    
    public function enviar_email(){
        
        $dados = array('assunto'      => $this->input->post('assunto'),
                       'mensagem'     => $this->input->post('mensagem'),
                       'destinatario' => $this->input->post('destinatario'));
        
        if(empty($dados['assunto'])){
            die('Assunto Obrigatório');
        }
        if(empty($dados['mensagem'])){
            die('Mensagem Obrigatório');
        }
        if(empty($dados['assunto'])){
            die(false);
        }
        
        $mensagem = $dados['mensagem'].  
                   "<hr><h4>Sistema de Estágio<br>
                    (Foi enviado através do Sistema de Estágio)<br>
                    <strong>*** NÃO RESPONDA A ESSE EMAIL ***</strong></h4>";
        
        $this->load->library('email');
        $this->email->initialize();
        $this->email->from($this->email_envio(), $this->model->nome_cood());
        $this->email->to($dados['destinatario']);
        $this->email->subject($dados['assunto']);
        $this->email->message($mensagem);
        $x =  $this->email->send();
        
        echo true;
        
    }
    
    public function pdf(){
        
        $filtro = $this->input->post('filtro');
        $dados  = $this->aluno->gera_arquivo($filtro);
        $html   = "";
        
        $curso   = $this->model->sql("select a.titulo from curso a where a.id = ? ",  $this->model->id_curso())->row()->titulo;
        $periodo = $this->model->sql("select a.periodo from periodo_curso a where a.id = ? ",  $this->model->id_periodo())->row()->periodo;
        
        $aluno  = "<link href='".base_url('assets/one/css/bootstrap.min.css')."' rel='stylesheet'>
            
                    <div class='center-block text-center'><img src='".base_url('assets/img/logo_fatec.png')."' style='max-width:110px; margin-bottom:10px;' border='0'></div>  
                        
                    <hr>

                    <p><strong>Curso:</strong> ".$curso." </strong><br>
                    <strong>Período:</strong> ".$periodo." </strong><p>

                    <table class='table table-bordered' style='margin-top: 10px;'>
                        <thead style='margin:5px;'>
                            <tr>
                                <th>Nome, E-mail</th>
                                <th style='text-align: center; padding:5px;'>Documentos</th>
                                <th style='text-align: center; padding:5px;'>Empresa</th>
                                <th style='text-align: center; padding:5px;'>Contato</th>
                            </tr>
                        </thead>
                        <tbody>";
        
        foreach ($dados as $item):
            
            if(empty($item->telefone)):
                
                $telefone = ''; 
            
            else:
                
                $telefone = mask($item->telefone,'(##) ####-####') . '<br>';
                
            endif;
            
            $aluno .= "<tr>
                
                            <td style='vertical-align:middle; padding:5px;'>$item->nome <br> $item->email</td>
                            <td style='text-align:center; vertical-align:middle; padding:5px;'>  ".$item->ra."<br>
                                                                                                                ".mask($item->cpf,'###.###.###-##')."<br>
                                                                                                                ".(!empty($item->rg)?mask($item->rg,'##.###.###-#'):"")."    
                                                                                                             </td>
                            <td style='text-align:center; vertical-align:middle; padding:5px;'>".$item->empresa." <br>". mask($item->cnpj,'##.###.###/####-##')."</td>
                            <td style='text-align:center; vertical-align:middle; padding:5px;'>". $telefone .mask($item->celular,'(##) #####-####')."</td>
                          
                        </tr>";
            
        endforeach;
        
        if($aluno==""){
           $aluno = "<tr colspan='7'><td>Não foi encontrado nenhum registro...<td><tr>";
        }
        
        $html .= $aluno . "</tbody></table>";
        
        $this->load->library('pdf');
        
        $pdf = $this->pdf->load('c', 'A4-L');
        $this->load->library('user_agent');
        $this->load->helper('string');
        
        $random = random_string('numeric', 5);

        $version = $this->agent->platform();
 
        $teste = strrpos(strtoupper($version), 'WINDOWS');
        
        if($teste === false){
            $pdfFilePath = $_SERVER['DOCUMENT_ROOT']."assets/pdf/aluno_".$this->model->id_cood().$random.".pdf";    
        }else{
            $pdfFilePath = "assets/pdf/aluno_".$this->model->id_cood().$random.".pdf";    
        }
        
        $pdf->writeHTML($html);  
        $pdf->Output($pdfFilePath,'F');
        
        echo base_url('assets/pdf')."/aluno_".$this->model->id_cood().$random.".pdf";
        
        
    }
    
    public function excel(){
        
        $filtro = $this->input->post('filtro');
        $dados  = $this->aluno->gera_arquivo($filtro);
        
        $this->load->library('PHPExcel');
        $this->load->library('user_agent');
        $this->load->helper('string');
        
        $random = random_string('numeric', 5);
        
        $fileName = "aluno_".$this->model->id_cood().$random.".php";
        
        $version = $this->agent->platform();
        
        $teste = strrpos(strtoupper($version), 'WINDOWS');
        
        if($teste === false){
            $saveFilePATH = $_SERVER['DOCUMENT_ROOT']."assets/excel/".$fileName;    
        }else{
            $saveFilePATH = "./assets/excel/".$fileName;
        }

	$objPHPExcel = $this->phpexcel;

	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setLastModifiedBy("Sistema de Estágio");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setTitle("Alunos - Sistema de Estágio");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setSubject("Alunos - Sistema de Estágio");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setDescription("Excel gerado dos alunos do Sistema de Estágio");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setKeywords("Empresa");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setCategory("Empresa");

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Curso");
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', $this->model->sql("select a.titulo from curso a where a.id = ? ",  $this->model->id_curso())->row()->titulo);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'Período');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', $this->model->sql("select a.periodo from periodo_curso a where a.id = ? ",  $this->model->id_periodo())->row()->periodo);
        
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A4', 'Nome');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B4', 'E-mail');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C4', 'Estágio');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D4', 'RA');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E4', 'CPF');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F4', 'RG');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G4', 'Empresa');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H4', 'CNPJ Empresa');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I4', 'Telefone');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J4', 'Celular');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K4', 'Status Aluno');
        
        $cont = 5;
        
        foreach ($dados as $item):
            
            if(empty($item->telefone)):
              
                $telefone = ''; 
            
            else:
                
                $telefone = mask($item->telefone,'(##) ####-####') . '<br>';
                
            endif;
            
            if($item->status==1){
                
                $status = "Ativo";

            }else{

                $status = "Inativo";

            }
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$cont, $item->nome);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$cont, $item->email);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$cont, $item->estagio);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$cont, "$item->ra");
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$cont, mask($item->cpf,'###.###.###-##'));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$cont, (!empty($item->rg)?mask($item->rg,'##.###.###-#'):""));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$cont, $item->empresa);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$cont, mask($item->cnpj,'##.###.###/####-##'));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$cont, $telefone);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$cont, mask($item->celular,'(##) #####-####'));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$cont, $status);
            
            $cont++;
            
        endforeach; 
        
        $objPHPExcel->getActiveSheet()->setTitle('Simple');
	
	$objPHPExcel->setActiveSheetIndex(0);
        
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', $saveFilePATH));

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save(str_replace('.php', '.xls', $saveFilePATH));
        
        echo base_url('assets/excel')."/aluno_".$this->model->id_cood().$random.".xls";
        
    }
    
    public function busca_aluno(){
        
        $busca = $this->input->post('busca');
        
        if(empty($busca)){
            die(false);
        }
        
        $dados = $this->aluno->busca_aluno($busca);
        $html  = "<table class='table table-bordered' style='margin-top: 20px;'>
                    <thead>
                        <tr>
                            <th>Nome, E-mail</th>
                            <th style='vertical-align:middle; text-align:center;'>Ação</th>
                        </tr>
                    </thead>
                    <tbody>";
        $aluno = "";
        
        foreach ($dados as $item):
            
            $id = $this->encrypt->encode($item->id);
            
            $aluno .= "<tr>
                            <td style='vertical-align:middle'>$item->nome <br> $item->email</td>
                            <td style='vertical-align:middle; text-align:center;'>
                                <a href='".base_url('supervisor/aluno/gera_pdf_aluno').'/'.$id."' target='_blank'><button type='button' class='btn btn-primary btn-xs'>Gerar PDF</button></a>
                            </td>
                        </tr>";
            
        endforeach;
        
        if($aluno==""){
           $aluno = "<tr colspan='2'><td>Não foi encontrado nenhum registro...<td><tr>";
        }
        
        $html .= $aluno . "</tbody></table>";
        
        echo $html;
        
    }
    
    public function gera_pdf_aluno($id){
        
        $session = $this->session->userdata('id_cood');
        
        if(empty($session)){
            die("Acesso negado.");
        }
        
        $id = $this->encrypt->decode($id);
        
        $estagio = $this->aluno->tipo_estagio($id);

        $html = "<link href='".base_url('assets/one/css/bootstrap.min.css')."' rel='stylesheet'>";

        switch($estagio->estagio):

            case "1":   $dados     = $this->aluno->dados($id);
                
                        $documento = $this->aluno->documento_curricular($id);

                        $data = array();

                        foreach($documento as $key => $item):

                            if($item==0){

                                $data[$key] = "<span class='text-warning'>Documento não Entregue</span>";

                            }else{

                                $data[$key] = "<span class='text-success'>Documento Entregue</span>";

                            }

                        endforeach;

                        if($dados->status==1){
                
                            $status = "<span class='text-success'>Ativo</span>";

                        }else{

                            $status = "<span class='text-danger'>Inativo</span>";

                        }
            
                        
                        
                        $html .= "
                            
                                  <div class='center-block text-center'><img src='".base_url('assets/img/logo_fatec.png')."' style='max-width:110px; margin-bottom:10px;' border='0'></div>  

                                  <ul  class='list-group' style='list-style:none;'>

                                    <li  class='list-group-item'><strong>Nome:</strong> ".$dados->nome." <strong>Status Aluno:</strong> ".$status."</li>
                                    <li  class='list-group-item'><strong>Curso:</strong> ".$dados->titulo." <strong>Periodo:</strong> ".$dados->periodo."</li>
                                    <li  class='list-group-item'><strong>Empresa:</strong> ".$dados->empresa." <strong>CNPJ:</strong> ".mask($dados->cnpj,'##.###.###/####-##')."</li>

                                  </ul>

                                    <h4>Documentos Iniciais</h4>

                                  <ul class='list-group' style='list-style:none;'>

                                    <li  class='list-group-item'><strong>1 - Convênio de Concessão de Estágio:</strong> ".$data['i1']."</li>
                                    <li  class='list-group-item'><strong>2 - Termo de Compromisso de Estágio:</strong> ".$data['i2']."</li>
                                    <li  class='list-group-item'><strong>3 - Plano de Atividades de Estágio:</strong> ".$data['i3']."</li>
                                    <li  class='list-group-item'><strong>4 - Apólice de Seguro:</strong> ".$data['i4']."</li>
                                    
                                  </ul>
                                  
                                    <h4>Documentos Finais</h4>

                                  <ul class='list-group' style='list-style:none;'>

                                    <li  class='list-group-item'><strong>5 - Relatório Final Simplificado:</strong> ".$data['f1']."</li>
                                    <li  class='list-group-item'><strong>6 - Relatório para Supervisão de Estágio:</strong> ".$data['f2']."</li>
                                    <li  class='list-group-item'><strong>7 - Modelo de Relatório Final Completo:</strong> ".$data['f3']."</li>
                                    <li  class='list-group-item'><strong>8 - Ficha de Avaliação de Desempenho do Estagiário:</strong> ".$data['f4']."</li>
                                        
                                  </ul>

                            ";



                        break;

            case "2":   $dados     = $this->aluno->dados($id);

                        $documento = $this->aluno->documento_equivalencia($id);

                        $data = array();

                        foreach($documento as $key => $item):

                            if($item==0){

                                $data[$key] = "<span class='text-warning'>Documento não Entregue</span>";

                            }else{

                                $data[$key] = "<span class='text-success'>Documento Entregue</span>";

                            }

                        endforeach;
                        
                        if($dados->status==1){
                
                            $status = "<span class='text-success'>Ativo</span>";

                        }else{

                            $status = "<span class='text-danger'>Inativo</span>";

                        }

                        $html .= "
                                    <div class='center-block text-center'><img src='".base_url('assets/img/logo_fatec.png')."' style='max-width:110px; margin-bottom:10px;' border='0'></div>  

                                     <ul class='list-group' style='list-style:none;'>

                                    <li  class='list-group-item'><strong>Nome:</strong> ".$dados->nome." <strong>Status Aluno:</strong> ".$status."</li>
                                    <li  class='list-group-item'><strong>Curso:</strong> ".$dados->titulo." <strong>Periodo:</strong> ".$dados->periodo."</li>
                                    <li  class='list-group-item'><strong>Empresa:</strong> ".$dados->empresa." <strong>CNPJ:</strong> ".mask($dados->cnpj,'##.###.###/####-##')."</li>

                                  </ul>

                                    <h4 style='padding-left: 10px;'>Documentos</h4>

                                  <ul  class='list-group' style='list-style:none;'>

                                    <li  class='list-group-item'><strong>1 - Processo de Equivalência:</strong> ".$data['e1']."</li>
                                    <li  class='list-group-item'><strong>2 - Plano de Atividades para Equivalência:</strong> ".$data['e2']."</li>
                                    <li  class='list-group-item'><strong>3 - Modelo de Relatório Final Completo:</strong> ".$data['e3']."</li>

                                  </ul>

                            ";

                        break;        

        endswitch;

        $this->load->library('pdf');
        
        $pdf = $this->pdf->load();
        $pdfFilePath = "estagio.pdf";    
        $pdf->writeHTML($html);   
        $pdf->Output($pdfFilePath, "D");
        
    }
    
    public function ativar(){
        
        $id = $this->input->post('id');
        
        if(empty($id)){
            die(false);
        }
        
        $id = $this->encrypt->decode($id);
        
        echo $this->aluno->ativar($id);
        
    }
    
    public function inativar(){
        
        $id = $this->input->post('id');
        
        if(empty($id)){
            die(false);
        }
        
        $id = $this->encrypt->decode($id);
        
        echo $this->aluno->inativar($id);
        
    }
    
    public function listar_aluno_email(){
        
        $dados = $this->aluno->dados_email();
        
        $html  = "";
        
        if(empty($dados)){
            
            $html .= "<option value='0'>Nenhum aluno encontrado</option>";
            
        }else{
            
            foreach($dados as $item):
                
                $html .= "<option value='".$item->email."'>".$item->nome." - ".$item->email."</option>";
                
            endforeach;
               
        }
        
        echo $html;
        
    }
    
    public function disparar_email_aluno(){
        
        $email    = $this->input->post('email');
        $assunto  = $this->input->post('assunto');
        $mensagem = $this->input->post('mensagem');
        
        if(empty($assunto)){
            die("Assunto Obrigatório");
        }
        if(empty($mensagem)){
            die("Mensagem Obrigatória");
        }
        if($email==0){
            die("Nenhum aluno para enviar e-mail.");
        }
        if(empty($email)){
            die("Selecione um Aluno para enviar e-mail.");
        }
        
        $msg = $mensagem.  
               "<hr><h4>Sistema de Estágio<br>
               (Foi enviado através do Sistema de Estágio)<br>
               <strong>*** NÃO RESPONDA A ESSE EMAIL ***</strong></h4>";
     
        $this->load->library('email');
        $this->email->initialize();
        $this->email->from($this->email_envio(), $this->model->nome_cood());
        $this->email->to($email);
        $this->email->subject($assunto);
        $this->email->message($msg);
        $x =  $this->email->send();  
        echo true;
        
    }
    
}
