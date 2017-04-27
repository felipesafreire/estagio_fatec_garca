<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diretoria extends MY_Controller {

    function __construct(){

        parent::__construct();
        $this->load->model('admin/Diretoria_model', 'diretoria');
        
    }
    
    public function index(){

        if($this->session->userdata('id_admin')){
        
            $data['nome'] = $this->session->userdata('nome_admin');
            $data['page'] = 'diretoria';
            $this->load->view('admin/body_view',$data);
            
        }else{
        
            redirect(base_url());    
            
        }
        
    }
    
    public function salvar_diretoria(){
        
        $id    = $this->input->post('id');
        $id    = $this->encrypt->decode($id);
        
        $dados = array('status'     =>  $this->input->post('status'),
                       'nome'       =>  $this->input->post('nome'),
                       'email'      =>  $this->input->post('email'));
        
        if(empty($dados['nome'])){
            
            die('Nome Obrigatório!');
            
        }
        if(empty($dados['email'])){
            
            die('E-mail Obrigatório!');
            
        }
        if(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
            
            die('E-mail inválido');
            
        }
        
        if(empty($id)){
        
            if($this->diretoria->diretoria_cadastrado($dados['email'])){
                
                die('E-mail já cadastrado!');
                
            }
            
            $x =  $this->diretoria->salvar_diretoria($dados);
            
            if($x['result']){
                
                $nome       = 'Sistema de Estágio';
                $destino    = $x['dados']['email'];
                $assunto    = "Dados de acesso ao Sistema de Estágio";
                $mensagem   = "Olá, você está recebendo este email para finalizar o
                               processo de cadastro de diretor(a) do 
                               <strong>Sistema de Estágio</strong>.<br><br>

                               Seus dados temporários de acesso são:<br>
                               <strong>Email:</strong> ".$x['dados']['email']."<br>
                               <strong>Senha:</strong> ".$x['dados']['senha_temporaria']."<br><br>
                               
                    <a href='".base_url('diretoria/dashboard/login')."' style='text-align:center;font-size:14px;
                    text-decoration:none; color:black;'>
                    <strong>Clique aqui para finalizar o cadastro</strong></a><br><br>
                                   ";
                
                $this->template_email($nome, $destino, $assunto, $mensagem);
                
            }
            
        }else{
            
            if($this->diretoria->diretoria_cadastrado_editar($dados['email'],$id)){
                
                die('E-mail já cadastrado!');
                
            }
            
            echo $this->diretoria->alterar_diretoria($dados,$id);
            
        }
        
    }
    
    public function listar_diretoria(){
        
        $dados = $this->diretoria->listar_diretoria();
        
        $html = "";
        
        foreach ($dados as $item):
            
            $id = $this->encrypt->encode($item->id);
            
            if($item->status==1){
                
                $status = "<span class='label label-success'>Ativo</span>";
                
            }else{
                
                $status = "<span class='label label-danger'>Inativo</span>";
                
            }
            
            if(empty($item->senha)){
                
                $status = "<button class='btn btn-primary btn-xs link-reenviar' id='$id'><strong>Reenviar Senha</strong></button>
                           <br>Senha Temporária:<br>
                           ".$item->senha_temporaria."";
                
            }
            
            $html .= "<tr>
                          <td style='vertical-align:middle;'>$item->nome</td>
                          <td style='vertical-align:middle;' class='hidden-xs hidden-sm'>$item->email</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>$status</td>
                          <td style='text-align:center; vertical-align:middle;'>
                          
                            <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <strong>Ações</strong>
                                <span class='fa fa-angle-down'></span>
                                </button>
                                <ul class='dropdown-menu'>
                                  <li><a href='javascript:' class='link-alterar' id='".$id."'>Alterar Diretor(a)</a></li>
                                  <li><a href='javascript:' class='link-excluir' id='".$id."'>Excluir</a></li>
                                </ul>
                            </div>
                          
                          </td>
                      </tr>
                
                
                ";
            
        endforeach;
        
        if($html==""){
            
            $html = "<tr><td colspan='6'>Não foi encontrado nenhum registro...</td></tr>";
            
        }
        
        echo json_encode($html);
        
    }
    
    public function dados_diretoria(){
        
        $id = $this->input->post('id');
        $id = $this->encrypt->decode($id);
        
        $dados = $this->diretoria->dados_diretoria($id);
        
        if($dados){
            
            echo json_encode(array('error'    =>false,
                                   'nome'     => $dados->nome,
                                   'email'    => $dados->email,
                                   'status'   => $dados->status));
            
        }else{
            
            echo json_encode(array('error'=>true));
            
        }
        
    }
    
    public function excluir_diretoria(){
        
        $id = $this->encrypt->decode($this->input->post('id'));
        
        echo $this->diretoria->excluir_diretoria($id); 
        
    }
    
    public function reenviar_senha(){
        
        $id = $this->input->post('id');
        
        if(empty($id)){
            die(false);
        }
        
        $id    = $this->encrypt->decode($id);
        $dados = $this->diretoria->reenviar($id);
        
        $nome       = 'Sistema de Estágio';
        $destino    = $dados->email;
        $assunto    = "Dados de acesso ao Sistema de Estágio";
        $mensagem   = "Olá, você está recebendo este email para finalizar o
                       processo de cadastro de diretor(a) do 
                       <strong>Sistema de Estágio</strong>.<br><br>

                       Seus dados temporários de acesso são:<br>
                       <strong>Email:</strong> ".$dados->email."<br>
                       <strong>Senha:</strong> ".$dados->senha."<br><br>

            <a href='".base_url('diretoria/dashboard/login')."' style='text-align:center;font-size:14px;
            text-decoration:none; color:black;'>
            <strong>Clique aqui para finalizar o cadastro</strong></a><br><br>
                           ";

        $this->template_email($nome, $destino, $assunto, $mensagem);
        
    }
    
}
