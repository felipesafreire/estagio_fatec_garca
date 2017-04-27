<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supervisor extends MY_Controller {

    function __construct(){

        parent::__construct();
        $this->load->model('admin/Supervisor_model', 'supervisor');
        
    }
    
    public function index(){

        if($this->session->userdata('id_admin')){
        
            $data['nome'] = $this->session->userdata('nome_admin');
            $data['page'] = 'supervisor';
            $this->load->view('admin/body_view',$data);
            
        }else{
        
            redirect(base_url());    
            
        }
        
    }
    
    public function salvar_supervisor(){
        
        $id    = $this->input->post('id');
        $id    = $this->encrypt->decode($id);
        
        $dados = array('status'     =>  $this->input->post('status'),
                       'nome'       =>  $this->input->post('nome'),
                       'email'      =>  $this->input->post('email'),
                       'curso'      =>  $this->input->post('curso'));
        
        $periodo = $this->input->post('periodo');
        
        if(empty($dados['nome'])){
            
            die('Nome Obrigatório!');
            
        }
        if(empty($dados['email'])){
            
            die('E-mail Obrigatório!');
            
        }
        if(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
            
            die('E-mail inválido');
            
        }
        if($dados['curso']==0){
            
            die('Selecione um curso');
            
        }
        if($dados['curso']==0){
            
            die('Selecione um curso');
            
        }
        if(empty($periodo)){
            
            die('Selecione algum periodo');
            
        }
        
        $periodos = $this->supervisor->periodo();
        
        $cont = 0;
        
        foreach ($periodos as $per):

            if(in_array($per->id, $periodo)){
                
                $p[$cont] = array("periodo_".strtolower(removerAcento($per->periodo)) => 1);
                
            }
            
            $cont++;
            
        endforeach;
        
        if(empty($id)){
        
            if($this->supervisor->supervisor_cadastrado($dados['email'])){
                
                die('E-mail já cadastrado!');
                
            }
            
            $x =  $this->supervisor->salvar_supervisor($dados,$p);
            
            if($x['result']){
                
                $nome       = 'Sistema de Estágio';
                $destino    = $x['dados']['email'];
                $assunto    = "Dados de acesso ao Sistema de Estágio";
                $mensagem   = "Olá, você está recebendo este email para finalizar o
                               processo de cadastro de supervisor do 
                               <strong>Sistema de Estágio</strong>.<br><br>

                               Seus dados temporários de acesso são:<br>
                               <strong>Email:</strong> ".$x['dados']['email']."<br>
                               <strong>Senha:</strong> ".$x['dados']['senha_temporaria']."<br><br>
                               
                    <a href='".base_url('supervisor/dashboard/login')."' style='text-align:center;font-size:14px;
                    text-decoration:none; color:black;'>
                    <strong>Clique aqui para finalizar o cadastro</strong></a><br><br>
                                   ";
                
                $this->template_email($nome, $destino, $assunto, $mensagem);
                
            }
            
        }else{
            
            if($this->supervisor->supervisor_cadastrado_editar($dados['email'],$id)){
                
                die('E-mail já cadastrado!');
                
            }
            
            echo $this->supervisor->alterar_supervisor($dados,$p,$id);
            
        }
        
    }
    
    public function listar_supervisor(){
        
        $dados = $this->supervisor->listar_supervisor();
        
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
                                  <li><a href='javascript:' class='link-alterar' id='".$id."'>Alterar Supervisor</a></li>
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
    
    public function listar_periodo(){
        
        $curso = $this->input->post('curso');
        
        if($curso==0){
            
            echo json_encode(array('result'=>false,'msg'=>"Selecione um Curso para Listar os periodos"));
            
        }
        
        $html  = "";
        
        $dados = $this->supervisor->listar_periodo($curso);
        
        $periodos = $this->supervisor->periodo();
        
        if(empty($dados)){
            
            foreach ($periodos as $periodo):
                
                $html .= "<option value='".$periodo->id."'>".$periodo->periodo."</option>";
                
            endforeach;
             
        }else{
            
            if($dados->manha!=1){

                $html .= "<option value='".$periodos[0]->id."'>".$periodos[0]->periodo."</option>";

            }
            if($dados->tarde!=1){

                $html .= "<option value='".$periodos[1]->id."'>".$periodos[1]->periodo."</option>";

            }
            if($dados->noite!=1){

                $html .= "<option value='".$periodos[2]->id."'>".$periodos[2]->periodo."</option>";

            }
            
        }
       
        echo json_encode(array('html'=>$html));
        
        
    }
    
    public function listar_curso(){
        
        $dados = $this->supervisor->listar_curso();
        
        $html = "<option value='0'>Selecione um curso</option>";
        
        foreach ($dados as $item) {
            
            $html .= "<option value='".$item->id."'>$item->titulo</option>";
            
        }
        
        echo json_encode(array('html'=>$html));
        
    }
    
    public function listar_curso_editar(){
        
        $dados = $this->supervisor->listar_curso();
        
        $html = "";
        
        foreach ($dados as $item) {
            
            $html .= "<option value='".$item->id."'>$item->titulo</option>";
            
        }
        
        echo json_encode(array('html'=>$html));
        
    }
    
    public function dados_supervisor(){
        
        $id = $this->input->post('id');
        $id = $this->encrypt->decode($id);
        
        $dados = $this->supervisor->dados_supervisor($id);
        
        if($dados){
            
            $html = "";
            
            $curso = $this->supervisor->listar_periodo($dados->id_curso);
        
            $periodos = $this->supervisor->periodo();
        
            if(empty($curso)){

                foreach ($periodos as $periodo):

                    $html .= "<option value='".$periodo->id."'>".$periodo->periodo."</option>";

                endforeach;
             
            }else{
            
                //$per = array();
                
                if($dados->periodo_manha==1){

                    $html .= "<option value='".$periodos[0]->id."'>".$periodos[0]->periodo."</option>";
                    $per[] = $periodos[0]->id;

                }
                if($dados->periodo_tarde==1){

                    $html .= "<option value='".$periodos[1]->id."'>".$periodos[1]->periodo."</option>";
                    $per[] = $periodos[1]->id;
                    
                }
                if($dados->periodo_noite==1){

                    $html .= "<option value='".$periodos[2]->id."'>".$periodos[2]->periodo."</option>";
                    $per[] = $periodos[2]->id;
                }
                
            }
            
            echo json_encode(array('error'    =>false,
                                   'curso'    => $dados->id_curso,
                                   'nome'     => $dados->nome,
                                   'email'    => $dados->email,
                                   'periodo'  => $html,
                                   'periodos' => empty($per)?'':$per,
                                   'status'   => $dados->status,
                ));
            
        }else{
            
            echo json_encode(array('error'=>true));
            
        }
        
    }
    
    public function reset_curso(){
        
        $id = $this->input->post('id');
        $id = $this->encrypt->decode($id);
        
        echo $this->supervisor->reset_curso($id);
        
    }
    
    public function excluir_supervisor(){
        
        $id = $this->encrypt->decode($this->input->post('id'));
        
        echo $this->supervisor->excluir_supervisor($id); 
        
    }
    
    public function reenviar_senha(){
        
        $id = $this->input->post('id');
        
        if(empty($id)){
            die(false);
        }
        
        $id    = $this->encrypt->decode($id);
        $dados = $this->supervisor->reenviar($id);
        
        $nome       = 'Sistema de Estágio';
        $destino    = $dados->email;
        $assunto    = "Dados de acesso ao Sistema de Estágio";
        $mensagem   = "Olá, você está recebendo este email para finalizar o
                       processo de cadastro de supervisor do 
                       <strong>Sistema de Estágio</strong>.<br><br>

                       Seus dados temporários de acesso são:<br>
                       <strong>Email:</strong> ".$dados->email."<br>
                       <strong>Senha:</strong> ".$dados->senha."<br><br>

            <a href='".base_url('supervisor/dashboard/login')."' style='text-align:center;font-size:14px;
            text-decoration:none; color:black;'>
            <strong>Clique aqui para finalizar o cadastro</strong></a><br><br>
                           ";

        $this->template_email($nome, $destino, $assunto, $mensagem);
        
    }
    
}
