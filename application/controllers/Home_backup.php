<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Home_model', 'home');
    }
    
    public function index(){

        $html = "";
        
        if(!empty($this->model->id_aluno())){
            
            $html .= " <div style='margin-left:15px;'>
                      <p class='' style='font-size:14px;'>Bem Vindo ".$this->model->nome_aluno()."<p> 
                      <a href='".  base_url('aluno/dashboard')."' target='_blank'><button class='btn btn-primary'>Acessar Painel</button></a>
                      <a href='".  base_url('home/sair')."'><button class='btn btn-danger'>Sair</button></a></div>";
            
        }else{
            $html .= "<a href='javascript:' id='login'>Aluno</a>";
        }
        
        $data['html'] = $html;
        
        $this->load->view('index', $data);

    }
    
    public function sair(){
        
        $this->session->unset_userdata('id_aluno');
        $this->session->unset_userdata('nome_aluno');
        $this->session->unset_userdata('ra_aluno');
        $this->session->unset_userdata('senha_aluno');
        $this->session->unset_userdata('curso_aluno');
        $this->session->unset_userdata('periodo_aluno');
        
        redirect(base_url());
        
    }

    public function email(){
        
        $dados = array('nome'     => $this->input->post('nome'),
                       'ra'       => $this->input->post('ra'),
                       'mensagem' => $this->input->post('mensagem'),
                       'assunto'  => $this->input->post('assunto'));
        
        if(empty($dados['nome'])){
            
            die("Nome obrigatório.");
            
        }    
        if(empty($dados['ra'])){
            
            die("RA obrigatório.");
            
        }    
        if(empty($dados['mensagem'])){
            
            die("Mensagem obrigatório.");
            
        }    
        if(empty($dados['assunto'])){
            
            die("Assunto obrigatório.");
            
        }  
        
        $dados_email = $this->home->dados_email($dados['ra']);
        
        $this->load->library('user_agent');
        
        $origem  = $dados_email->email;
        $destino = $dados_email->email_supervisor;
        
        $mensagem = "<strong>Nome aluno:</strong> ".$dados['nome']."<br>
                     <strong>E-mail do aluno:</strong> ".$origem."<br>
                     <strong>Assunto:</strong> ".$dados['assunto']."<br>
                     <strong>Mensagem:</strong> ".$dados['mensagem']."";   
        
        $x = $this->template_email($dados['nome'],$origem,$destino,$dados['assunto'],$mensagem);
        
        if($x){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function consulta(){
        
        $ra = $this->input->post('ra');
        
        if(empty($ra)){
            
            die(json_encode(array('result'=>false,'msg'=>"Campo RA obrigatório")));
            
        }
        
        $verifica = $this->home->verifica_aluno($ra);
        
        if($verifica){
            
            $estagio = $this->home->tipo_estagio($ra);
            
            $html = "";
            
            switch($estagio->estagio):
                
                case "1":   $dados     = $this->home->dados($ra);
                    
                            $documento = $this->home->documento_curricular($dados->id);
                            
                            $data = array();
                            
                            foreach($documento as $key => $item):
                                
                                if($item==0){
                                   
                                    $data[$key] = "<span class='text-warning'>Documento não Entregue</span>";
                                   
                                }else{
                                    
                                    $data[$key] = "<span class='text-success'>Documento Entregue</span>";
                                   
                                }
                                
                            endforeach;
                            
                            $html .= "
                                      <div class='list-group'>

                                        <li  class='list-group-item'><strong>Nome:</strong> ".$dados->nome."</li>
                                        <li  class='list-group-item'><strong>Curso:</strong> ".$dados->titulo." <strong>Periodo:</strong> ".$dados->periodo."</li>
                                        <li  class='list-group-item'><strong>Empresa:</strong> ".$dados->empresa." <strong>CNPJ:</strong> ".mask($dados->cnpj,'##.###.###/####-##')."</li>

                                      </div>
                                     
                                        <h4 style='padding-left: 10px;'>Documentos</h4>
                                        
                                      <div class='list-group'>

                                        <li  class='list-group-item'><strong>1 - Convênio de Concessão de Estágio:</strong> ".$data['i1']."</li>
                                        <li  class='list-group-item'><strong>2 - Termo de Compromisso de Estágio:</strong> ".$data['i2']."</li>
                                        <li  class='list-group-item'><strong>3 - Plano de Atividades de Estágio:</strong> ".$data['i3']."</li>
                                        <li  class='list-group-item'><strong>4 - Apólice de Seguro:</strong> ".$data['i4']."</li>
                                        <li  class='list-group-item'><strong>5 - Relatório Final Simplificado:</strong> ".$data['f1']."</li>
                                        <li  class='list-group-item'><strong>6 - Relatório para Supervisão de Estágio:</strong> ".$data['f2']."</li>
                                        <li  class='list-group-item'><strong>7 - Modelo de Relatório Final Completo:</strong> ".$data['f3']."</li>
                                        <li  class='list-group-item'><strong>8 - Ficha de Avaliação de Desempenho do Estagiário:</strong> ".$data['f4']."</li>
                                      </div>
                                
                                ";
                    
                            echo json_encode(array('result'=>true, 'html'=>$html));
                    
                            break;
                
                case "2":   $dados     = $this->home->dados($ra);
                    
                            $documento = $this->home->documento_equivalencia($dados->id);
                            
                            $data = array();
                            
                            foreach($documento as $key => $item):
                                
                                if($item==0){
                                   
                                    $data[$key] = "<span class='text-warning'>Documento não Entregue</span>";
                                   
                                }else{
                                    
                                    $data[$key] = "<span class='text-success'>Documento Entregue</span>";
                                   
                                }
                                
                            endforeach;
                            
                            $html .= "
                                      <div class='list-group'>

                                        <li  class='list-group-item'><strong>Nome:</strong> ".$dados->nome."</li>
                                        <li  class='list-group-item'><strong>Curso:</strong> ".$dados->titulo." <strong>Periodo:</strong> ".$dados->periodo."</li>
                                        <li  class='list-group-item'><strong>Empresa:</strong> ".$dados->empresa." <strong>CNPJ:</strong> ".mask($dados->cnpj,'##.###.###/####-##')."</li>

                                      </div>
                                     
                                        <h4 style='padding-left: 10px;'>Documentos</h4>
                                        
                                      <div class='list-group'>

                                        <li  class='list-group-item'><strong>1 - Processo de Equivalência:</strong> ".$data['e1']."</li>
                                        <li  class='list-group-item'><strong>2 - Plano de Atividades para Equivalência:</strong> ".$data['e2']."</li>
                                        <li  class='list-group-item'><strong>3 - Modelo de Relatório Final Completo:</strong> ".$data['e3']."</li>
                                        
                                      </div>
                                
                                ";
                    
                            echo json_encode(array('result'=>true, 'html'=>$html));
                            
                            break;        
                        
            endswitch;
            
        }else{
            
            die(json_encode(array('result'=>false,'msg'=>"RA não encontrado.")));
            
        }
        
    }
    
    public function verifica_ra(){
        
        $ra = $this->input->post('ra');
        
        if(empty($ra)):
            die(json_encode(array('result'=>false,'msg'=>"RA em branco.")));
        endif;
        
        if(!$this->home->verifica_aluno($ra)){
            die(json_encode(array('result'=>false,'msg'=>'RA não encontrado')));
        }
        
        $dados = $this->home->dados($ra);
        
        if($dados){
            die(json_encode(array('result'=>true,
                                  'nome' => $dados->nome)));
        }else{
            die(json_encode(array('result'=>false,'msg'=>'Erro tente novamente mais tarde.')));
        }
        
    }
    
    public function logar(){
        
        $dados = array('ra'    => $this->input->post('ra'),
                       'senha' => $this->input->post('senha'));
        
        if(empty($dados['ra'])){
            die(json_encode(array('result'=>false,'msg'=>"RA em branco.")));
        }
        if(empty($dados['senha'])){
            die(json_encode(array('result'=>false,'msg'=>"Senha em branco.")));
        }
        
        if(!$this->home->verifica_aluno($dados['ra'])){
            die(json_encode(array('result'=>false,'msg'=>'RA não encontrado')));
        }
        
        $info = $this->home->dados($dados['ra']);
        
        if($info->status!=1){
            die(json_encode(array('result'=>false,'msg'=>"Aluno inativo. Favor falar com o seu Orientador.")));
        }
        
        if(!empty($info->senha)){
            
            if($info->senha!=md5($dados['senha'])){
                die(json_encode(array('result'=>false,'msg'=>"Senha incorreta.")));
            }else{
                
                $this->session->set_userdata('id_aluno', $info->id);
                $this->session->set_userdata('nome_aluno', $info->nome);
                $this->session->set_userdata('ra_aluno', $info->ra);
                $this->session->set_userdata('senha_aluno', $info->senha);
                $this->session->set_userdata('curso_aluno', $info->id_curso);
                $this->session->set_userdata('periodo_aluno', $info->id_periodo_curso);
     
                echo json_encode(array('result'=>true,'ok'=>2, 'url'=>base_url('aluno/dashboard')));
            }
            
        }else{
            
            if($info->senha_temporaria!=$dados['senha']){
                die(json_encode(array('result'=>false,'msg'=>"Senha incorreta.")));
            }else{
                echo json_encode(array('result'=>true,'ok'=>1));
            }
            
        }
        
    }
    
    public function senha_temporaria(){
        
        $dados = array('ra'        => $this->input->post('ra'),
                       'senha'     => $this->input->post('senha'),
                       'senhaconf' => $this->input->post('senhaconf'));
        
        if(empty($dados['ra'])){
            die(json_encode(array('result'=>false,'msg'=>"RA em branco.")));
        }
        if(empty($dados['senha'])){
            die(json_encode(array('result'=>false,'msg'=>"Nova senha em branco.")));
        }
        if(empty($dados['senhaconf'])){
            die(json_encode(array('result'=>false,'msg'=>"Confirmação de senha em branco.")));
        }
        if($dados['senha']!=$dados['senhaconf']){
            die(json_encode(array('result'=>false,'msg'=>"Senhas não conferem.")));
        }
        if(!$this->home->verifica_aluno($dados['ra'])){
            die(json_encode(array('result'=>false,'msg'=>'Impossivel alterar a senha.')));
        }
        
        $x = $this->home->senha_temporaria($dados);
        
        if($x['result']){
            
            echo json_encode(array('error'=>false));
            
        }else{
            
            echo json_encode(array('error'=>true, 'msg' => "Erro ao alterar senha."));
            
        }
        
    }
    
    public function esqueceu_senha(){
        
        $ra = $this->input->post('ra');
        
        if(empty($ra)){
            die("RA em branco.");
        }
        
        if(!$this->home->verifica_aluno($ra)){
           die("Ra não encontrado") ;
        }
        
        $x = $this->home->esqueceu_senha($ra);
        
        if($x['result']){
            
            $nome       = 'Sistema de Estágio';
            $destino    = $x['email'];
            $assunto    = "Dados de acesso ao Sistema de Estágio";
            $mensagem   = "Olá, você está recebendo este e-mail, pois
                           você pediu uma redefinição de senha.<br><br>

                           Seus dados temporários de acesso são:<br>
                           <strong>RA:</strong> ".$ra."<br>
                           <strong>Senha:</strong> ".$x['senha']."<br><br>

                <a href='".base_url()."' style='text-align:center;font-size:14px;
                text-decoration:none; color:black;'>
                <strong>Clique aqui para continuar.</strong></a><br><br>
                               ";

            $this->template_email($nome, $destino, $assunto, $mensagem);
            
        }else{
            
            die("Erro ao redefinir senha!");
            
        }
        
    }
    
    
}

