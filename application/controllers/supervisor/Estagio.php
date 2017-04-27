<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estagio extends MY_Controller {
    

function __construct(){

        parent::__construct();
        $this->load->model('supervisor/Estagio_model', 'estagio');
        
    }
    
    public function index(){

        if($this->session->userdata('id_cood')){
        
            $data['nome']       = $this->session->userdata('nome_cood');
            $data['curso']      = $this->model->sql("select titulo from curso where id = ? ",  $this->model->id_curso())->row()->titulo; 
            $data['periodo']    = $this->model->sql("select periodo from periodo_curso where id = ? ",  $this->model->id_periodo())->row()->periodo; 
            $data['page']       = 'estagio';
            
            $this->load->view('supervisor/body_view',$data);
            
        }else{
        
            redirect(base_url('supervisor/dashboard/login'));    
            
        }
        
    }
    
    public function salvar_estagio(){
        
        $dados = array('id'        => $this->encrypt->decode($this->input->post('id')),
                       'titulo'    => $this->input->post('titulo'),
                       'descricao' => $this->input->post('descricao'),
                       'url'       => $this->input->post('url'));
        
        if(empty($dados['titulo'])){
            die("Título do Estágio Obrigatório.");
        }
        if(empty($dados['descricao'])){
            die("Descrição do Estágio Obrigatório.");
        }
        
        if(empty($dados['id'])){
            if($this->estagio->vaga_cadastrada($dados['titulo'])){
                die("Título da Vaga já cadastrada");
            }
            echo $this->estagio->salvar_estagio($dados);
        }else{
            if($this->estagio->vaga_cadastrada_editar($dados['titulo'],$dados['id'])){
                die("Título da Vaga já cadastrada");
            }
            echo $this->estagio->editar_estagio($dados);
        }
        
    }
    
    public function check_url(){
        
        $nome = $this->input->post('nome');
       
        $this->load->helper('url');
        $this->load->helper('text');
        
        $qtde = $this->estagio->verifica_url($nome);
        $url = strtolower(convert_accented_characters(url_title(trataString($nome), '-', TRUE)));
        if ($qtde != 0) {
            
            $url .= '-' . $qtde;
        }

        echo $url;
    }
    
    public function listar_estagio() {
        
        $dados = $this->estagio->dados_estagio($this->input->post('page'),  $this->input->post('filtro'));
        
        $html  = "";
        
        foreach ($dados as $item):
            
            $id = $this->encrypt->encode($item->id);
            
            $html .= "<tr>
                          <td style='vertical-align:middle;'><strong>".$item->titulo."</strong><br><a target='_blank' href='".  base_url('aluno/estagio/vaga/'.$item->url_vaga)."'>".  base_url('aluno/estagio/vaga/'.$item->url_vaga)."</a></td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>".FormataDataBR($item->data_cadastro)." </td>
                          <td style='text-align:center; vertical-align:middle;'>
                          
                            <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <strong>Ações</strong>
                                <span class='fa fa-angle-down'></span>
                                </button>
                                <ul class='dropdown-menu'>
                                  <li><a href='javascript:' class='link-alterar' id='".$id."'>Alterar Vaga</a></li>
                                  <li><a href='javascript:' class='link-excluir' id='".$id."'>Deletar Vaga</a></li>
                                </ul>
                            </div>
                          
                          </td>
                      </tr>";
            
        endforeach;
        
        if($html==""){
            
            $html .= "<tr><td colspan='2'>Não foi encontrado nenhum registro...<td><tr>";
            
        }
        
        echo json_encode(array('paginacao'  => $this->ajax_pagination->create_links(),
                               'html'       => $html));
        
    }
    
    public function dados_estagio(){
        
        $id = $this->encrypt->decode($this->input->post('id'));
        
        $dados = $this->estagio->dados_vaga($id);
        
        if($dados){
            
            echo json_encode(array('error'  => false,
                                   'titulo' => $dados->titulo,
                                   'html'   => $dados->html,
                                   'url'    => $dados->url_vaga));            
            
        }else{
            
            echo json_encode(array('error'  => true));     
            
        }
        
    }
    
    public function excluir_vaga(){
        
        $id = $this->encrypt->decode($this->input->post('id'));
        
        echo $this->estagio->excluir_vaga($id);
        
    }
    
    public function upload(){
        
        $ext = explode(".", $_FILES['arquivo']['name']);
        $ext = $ext[count($ext) - 1];
        $this->load->helper('string');
        
        $config['upload_path'] = 'assets/estagio/';
        
        if(!is_dir($config['upload_path'])){
            mkdir($config['upload_path'], 0777, true);
        }
        
        $config['file_name']     = md5(date('d/m/Y H:i:s') . random_string()) . '.' . $ext;
        $config['allowed_types'] = 'jpg|png';
        $config['max_size']      = 1024*3;
        
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('arquivo')){
            
            $error = array('error' => true, 'msg'=> $this->upload->display_errors());
            echo json_encode($error);
            
        }else{
            
            $data = array('error' => false, 
                          'msg'   => $this->upload->data(), 
                          'img'   => base_url('assets/estagio/'.$config['file_name']));
            echo json_encode($data);
            
        }
    }
    
}
