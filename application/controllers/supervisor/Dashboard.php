<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

function __construct(){

        parent::__construct();
        $this->load->model('supervisor/Dashboard_model', 'dashboard');
        
    }
    
    public function index(){

        if($this->session->userdata('id_cood')){
            
            $data['nome']       = $this->session->userdata('nome_cood');
            $data['curso']      = $this->model->sql("select titulo from curso where id = ? ",  $this->model->id_curso())->row()->titulo; 
            $data['periodo']    = $this->model->sql("select periodo from periodo_curso where id = ? ",  $this->model->id_periodo())->row()->periodo; 
            $data['page']       = 'blank';
            
            $sql  = "select 
                     count(a.id) as qtde_empresa,
                     (select count(b.id) 
                     from aluno b
                     where b.id_curso = ".$this->model->id_curso()."
                     and b.id_periodo_curso = ".$this->model->id_periodo().") as qtde_aluno,
                     (select count(c.id) 
                     from vaga_estagio c
                     where c.curso_id   = ".$this->model->id_curso()."
                     and c.periodo_id  = ".$this->model->id_periodo().") as qtde_vaga
                     from empresa a";
            
            $data['dados'] =  $this->model->sql($sql)->row();
            
            
            
            $this->load->view('supervisor/body_view',$data);
            
        }else{
        
            redirect(base_url('supervisor/dashboard/login'));    
            
        }
        
    }
    
    public function login(){
        
     
            
            $this->session->unset_userdata('id_cood');
            $this->session->unset_userdata('email_cood');
            $this->session->unset_userdata('senha_cood');
            $this->session->unset_userdata('nome_cood');
            $this->session->unset_userdata('id_curso');
            $this->session->unset_userdata('id_periodo');

            $this->load->view('supervisor/login_view');
            
        
        
    }
    
    public function entrar(){
        
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');
        
        if(empty($email)){
            
            die(json_encode(array('result'=>false,'msg'=>"Campo e-mail obrigatório!")));
            
        }
        if(empty($senha)){
            
            die(json_encode(array('result'=>false,'msg'=>"Campo senha obrigatório!")));
            
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            
            die(json_encode(array('result'=>false,'msg'=>"E-mail inválido")));
            
        }
        
        $x  = $this->dashboard->valida_login($email);
        
        if(empty($x)){
            
            die(json_encode(array('result'=>false,'msg'=>"Dados inválidos!")));
            
        }else{
            
            if($x->status!=1){
                
                $msg = " ".$x->nome.", seu(a) usuário consta inativo, entre em contato com o administrador.";
                
                die(json_encode(array('result'=>false,'msg'=>$msg)));
                
            }else{
                
                $curso = $this->dashboard->valida_curso($x->id_curso);
            
                if($curso==false){

                    die(json_encode(array('result'=>false,'msg'=>"Curso que administra consta inativo, entre em contato com o administrador.")));

                }else{

                    if($x->senha_temporaria!=NULL){
                        
                        if($x->senha_temporaria!=$senha){
                            
                            die(json_encode(array('result'=>false,'msg'=>"Senha incorreta")));
                            
                        }else{
                        
                            echo json_encode(array('result'=>true,'ok'=>1));
                            
                        }
                        
                    }else{
                        
                        if($x->senha!=md5($senha)){
                            
                            die(json_encode(array('result'=>false,'msg'=>"Senha incorreta")));
                            
                        }else{
                            
                            $html = "<option value='0'>Selecione o Período Desejado</option>";
                            
                            $seleciona_periodo = $this->dashboard->seleciona_periodo($x->id);
                            $periodos           = $this->dashboard->periodo();
                            $cont = 0;
                            
                            foreach ($seleciona_periodo as $key => $item) :
                                
                                foreach ($periodos as $periodo):
                                
                                    if(strtolower(removerAcento($periodo->periodo))==$key && $item==1){
                                        
                                        $html .= "<option value='".$periodo->id."'>".$periodo->periodo."</option>";
                                        $cont++;
                                    }
                                
                                endforeach;
                                
                            endforeach;
                            
                            if($cont==1){
                                
                                $x = $this->grava_sessao($x->nome, $x->email, $x->id, $x->senha, $x->id_curso, soNumero($html));
                                        
                                if($x){
                                    
                                    echo json_encode(array('result'=>true,'ok'=> 2, 'url'=>base_url('supervisor/dashboard')));
                                    
                                }
                                
                            }else{
                                
                                $this->session->set_userdata('id_cood', $x->id);  
                                $this->session->set_userdata('email_cood', $x->email);    
                                $this->session->set_userdata('senha_cood', $x->senha);
                                $this->session->set_userdata('nome_cood', $x->nome);
                                $this->session->set_userdata('id_curso', $x->id_curso);
                                
                                echo json_encode(array('result'=>true,'html'=>$html));    
                                
                            }
                            
                        }    
                        
                    }

                }  
                
            }
            
        }
        
    }
    
    public function primeiro_acesso(){
        
        $email       = $this->input->post('email');
        $senha       = $this->input->post('senha');
        $repetesenha = $this->input->post('repetesenha');
        
        if(empty($email)){
            
            die(json_encode(array('result'=>false)));
            
        }
        if(empty($senha)){
            
            die(json_encode(array('result'=>false,'msg'=>"Campo senha vazio!")));
            
        }
        if(empty($repetesenha)){
            
            die(json_encode(array('result'=>false,'msg'=>"Campo repete senha vazio")));
            
        }
        if($senha!=$repetesenha){
            
            die(json_encode(array('result'=>false,'msg'=>"Senhas não conferem")));
            
        }
        
        $x = $this->dashboard->primeiro_acesso($senha,$email);
        
        if($x['result']){
            
            echo json_encode(array('result'=>true));
            
        }else{
            
            echo json_encode(array('result'=>false));
            
        }
        
    }
    
    public function grava_sessao($nome,$email,$id,$senha,$curso_id,$periodo){
        
        $this->session->set_userdata('id_cood', $id);  
        $this->session->set_userdata('email_cood', $email);    
        $this->session->set_userdata('senha_cood', $senha);
        $this->session->set_userdata('nome_cood', $nome);
        $this->session->set_userdata('id_curso', $curso_id);
        $this->session->set_userdata('id_periodo', $periodo);
        
        return true;
        
    }
    
    public function set_periodo(){
        
        $periodo = $this->input->post('periodo');
        
        if(empty($periodo)){
            
            die(json_encode(array('result'=>false,'url'=>base_url('supervisor/dashboard/login'))));
            
        }
        if($periodo==0){
            
            die(json_encode(array('result'=>false,'url'=>base_url('supervisor/dashboard/login'))));
            
        }
        
        $this->session->set_userdata('id_periodo', $periodo);
        
        echo json_encode(array('result'=>true,'url'=>base_url('supervisor/dashboard')));
        
    }
    
    public function dados(){
        
        if($this->session->userdata('id_cood')){
            
            $data['nome'] = $this->session->userdata('nome_cood');
            $data['curso'] = $this->model->sql("select titulo from curso where id = ? ",  $this->model->id_curso())->row()->titulo; 
            $data['periodo'] = $this->model->sql("select periodo from periodo_curso where id = ? ",  $this->model->id_periodo())->row()->periodo; 
            $data['page'] = 'dados';
            
            $this->load->view('supervisor/body_view',$data);
            
        }else{
        
            redirect(base_url('supervisor/dashboard/login'));    
            
        }
        
    }
    
    public function senha(){
        
        if($this->session->userdata('id_cood')){
            
            $data['nome'] = $this->session->userdata('nome_cood');
            $data['curso'] = $this->model->sql("select titulo from curso where id = ? ",  $this->model->id_curso())->row()->titulo; 
            $data['periodo'] = $this->model->sql("select periodo from periodo_curso where id = ? ",  $this->model->id_periodo())->row()->periodo; 
            $data['page'] = 'senha';
            
            $this->load->view('supervisor/body_view',$data);
            
        }else{
        
            redirect(base_url('supervisor/dashboard/login'));    
            
        }
        
    }
    
    public function listar_dados(){
        
        $dados = $this->dashboard->listar_dados();
        
        if($dados){
            
            echo json_encode(array('error'=>false,
                                   'email'=>$dados->email,
                                   'nome' =>$dados->nome));
            
        }else{
            
            echo json_encode(array('error'=>true));
            
        }
        
    }
    
    public function salvar_dados(){
        
        $email = $this->input->post('email');
        $nome  = $this->input->post('nome');
        
        if(empty($email)){
            
            die("E-mail obrigatório");
            
        }
        if(empty($nome)){
            
            die("Nome obrigatório");
            
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            
            die("E-mail inválido");
            
        }
        
        if($this->dashboard->email_cadastrado($email)){
            
           die("E-mail já cadastrado!"); 
            
        }
        
        echo $this->dashboard->alterar_dados($email,$nome);
        
    }
    
    public function alterar_senha(){
        
        $dados = array('senha'      => md5($this->input->post('senha')),
                       'novasenha'  => $this->input->post('novasenha'),
                       'repetesenha'      => $this->input->post('repetesenha'));
        
        if(empty($dados['senha'])){
            
            die("Senha obrigatório.");
            
        }
        if(empty($dados['novasenha'])){
            
            die("Nova Senha obrigatório.");
            
        }
        if(empty($dados['repetesenha'])){
            
            die("Repete Senha obrigatório.");
            
        }
        if($dados['novasenha']!=$dados['repetesenha']){
            
            die("Senhas não conferem.");
            
        }
        
        if($dados['senha'] != $this->model->senha_cood()){
            
            die("Senha Atual errada, tente novamente.");
            
        }
        
        echo $this->dashboard->alterar_senha($dados['novasenha']);
        
    }
    
    public function esqueceu_senha(){
        
        $email = $this->input->post('email');
        
        if(empty($email)):
            die("E-mail em branco");
        endif;
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
            die("E-mail invalído");
        endif;
        
        if($this->dashboard->verifica_email($email)){
            
            $x = $this->dashboard->reset_senha($email);
            
            if($x['result']){
                
                $nome       = 'Sistema de Estágio';
                $destino    = $email;
                $assunto    = "Recuperar senha do Sistema de Estágio";
                $mensagem   = "Olá, você está recebendo este email para recuperar sua
                               senha do 
                               <strong>Sistema de Estágio</strong>.<br><br>

                               Seus dados temporários de acesso são:<br>
                               <strong>Email:</strong> ".$email."<br>
                               <strong>Senha:</strong> ".$x['senha']."<br><br>
                               
                    <a href='".base_url('supervisor/dashboard/login')."' style='text-align:center;
                    font-size:14px;text-decoration:none; color:black;'>
                    <strong>Clique aqui para recuperar a senha</strong></a><br><br>
                                   ";
                
                $this->template_email($nome, $destino, $assunto, $mensagem);
                
            }else{
                
                die("Erro ao reenviar senha!");
                
            }
            
        }else{
            
            die("E-mail não encontrado...");
            
        }     
    }
    
}
