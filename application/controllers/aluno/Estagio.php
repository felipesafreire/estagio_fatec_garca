<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estagio extends MY_Controller {

    function __construct(){

        parent::__construct();
        $this->load->model('aluno/Estagio_model', 'estagio');
        
    }
    
    public function index(){

        $html = "";
        
        $dados = $this->model->sql("select a.* from curso a where a.status = 1 order by a.titulo ")->result();
        
        $html .= "<li><a class='active link-curso' href='javascript:' id='".$this->encrypt->encode($dados[0]->id)."'>".$dados[0]->titulo."</a></li>";
        
        foreach ($dados as $key => $item){
            
            if($key >= 1):
            
                $html .= "<li><a class='link-curso' href='javascript:' id='".$this->encrypt->encode($item->id)."'>".$item->titulo."</a></li>";
                
            endif;
            
        }
        
        $html .= "<li><a class='' href='".  base_url() ."'>Voltar</a></li>";
        
        if(empty($html)){
            $html .= "<li><a href='javascript:'>Nenhum Curso Cadastrado</a></li>";
        }
        
        $data['curso'] = $html;
        $data['font'] = "https://fonts.googleapis.com/css?family=Roboto+Condensed";
        $data['page']  = 'vagas_estagio';       
        $this->load->view('aluno/vagasbody_view',$data);
     
    }
    
    public function vaga_curso(){
        
        $id = $this->encrypt->decode($this->input->post('id'));
        
        $dados = $this->estagio->vaga_curso($id);
        $html  = "<div class='list-group'>";
        
        foreach ($dados as $item):
            
            $html .= "<li class='list-group-item'><a href=".base_url('aluno/estagio/vaga/'.$item->url)." style='color: black;'><h4>".$item->titulo."</h4></a>                        
                                                  <h6>Data de Cadastro: ".inverteData($item->data)."</h6>
                                                  <div class='text-right' ><a href=".base_url('aluno/estagio/vaga/'.$item->url)." style='color: #235D98;'>Ver informações</a></div>
                      </li>";
            
        endforeach;
     
        $html .= "</div>";

        if(empty($dados)){
            
            $html = "<h4>Nenhuma Vaga de Estágio encontrada...</h4>";
            
        }                            
                                  
        echo $html;
        
    }
    
    public function vaga($url){
        
        if(empty($url)){
            
            redirect(base_url('aluno/estagio'));
            
        }else{
            
            $dados = $this->estagio->busca_vaga_url($url);
            
            if(empty($dados)){
            
                redirect(base_url('aluno/estagio'));
                
            }else{
            
                $data['title']         = $dados->titulo;
                $data['html']          = $dados->html;
                $data['data_cadastro'] = inverteData($dados->data);
                
                $this->load->view('aluno/vaga_dados_view',$data);
                
            }
            
        }
        
    }
    
}
