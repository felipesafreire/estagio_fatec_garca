<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso extends MY_Controller {

    function __construct(){

        parent::__construct();
        $this->load->model('admin/Curso_model', 'curso');
        
    }
    
    public function index(){

        if($this->session->userdata('id_admin')){
        
            $data['nome'] = $this->session->userdata('nome_admin');
            $data['page'] = 'curso';
            $this->load->view('admin/body_view',$data);
            
        }else{
        
            redirect(base_url());    
            
        }
        
    }
    
    public function salvar_curso(){
        
        $id    = $this->encrypt->decode($this->input->post('id'));
        $dados = array('titulo' => $this->input->post('titulo'),
                       'status' => $this->input->post('status'));
        
        if(empty($dados['titulo'])){
            
            die('Nome do curso Obrigátorio');
            
        }
        if(empty($id)){
        
            if($this->curso->curso_cadastrado($dados)){
                
                die("Curso já cadastrado!");
                
            }
            
            echo $this->curso->salvar_curso($dados);
            
        }else{
            
            if($this->curso->curso_cadastrado_editar($dados,$id)){
                
                die("Curso já cadastrado!");
                
            }
            
            echo $this->curso->editar_curso($dados,$id);
            
        }
        
        
    }
    
    public function listar_curso(){
        
        $dados = $this->curso->listar_curso();
        
        $html = "";
        
        foreach ($dados as $item):
            
            $id = $this->encrypt->encode($item->id);
            
            if($item->status==1){
                
                $status = "<span class='label label-success'>Ativo</span>";
                $ativo  = "<li><a href='javascript:' class='link-inativar' id='".$id."'>Inativar Curso</a></li>";
                
            }else{
                
                $status = "<span class='label label-danger'>Inativo</span>";
                $ativo  = "<li><a href='javascript:' class='link-ativar' id='".$id."'>Ativar Curso</a></li>";
                
            }
            
            
            
            $html .= "<tr>
                          <td style='vertical-align:middle;'>$item->titulo</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>$status</td>
                          <td style='text-align:center; vertical-align:middle;'>
                          
                            <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                Ações
                                <span class='fa fa-angle-down'></span>
                                </button>
                                <ul class='dropdown-menu'>
                                  <li><a href='javascript:' class='link-alterar' id='".$id."'>Alterar Curso</a></li>
                                  $ativo
                                </ul>
                            </div>
                          
                          </td>
                      </tr>
                
                
                ";
            
        endforeach;
        
        if($html==""){
            
            $html = "<tr><td colspan='4'>Não foi encontrado nenhum registro...</td></tr>";
            
        }
        
        echo json_encode($html);
        
    }
    
    public function dados_curso(){
        
        $id = $this->encrypt->decode($this->input->post('id'));
        
        $dados = $this->curso->dados_curso($id);
        
        if($dados){
            
            echo json_encode(array('error'  => false,
                                   'titulo' => $dados->titulo,
                                   'status' => $dados->status));
            
        }else{
            
            echo json_encode(array('error'  => true));
            
        }
        
        
    }
    
    public function inativar_curso(){
        
        $id = $this->encrypt->decode($this->input->post('id'));
        
       echo $this->curso->inativar_curso($id);
        
    }
    
    public function ativar_curso(){
        
        $id = $this->encrypt->decode($this->input->post('id'));
        
       echo $this->curso->ativar_curso($id);
        
    }

}
