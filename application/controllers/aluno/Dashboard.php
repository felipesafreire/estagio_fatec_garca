<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    function __construct(){

        parent::__construct();
        $this->load->model('aluno/Dashboard_model', 'dashboard');
        
    }
    
    public function index(){

        if($this->session->userdata('id_aluno')){
        
            $data['nome'] = $this->model->nome_aluno();
            $data['page'] = 'estagio';
            
            $this->load->view('aluno/body_view',$data);
            
        }else{
        
            redirect(base_url());    
            
        }
        
    }
    
    public function senha() {
        
        if($this->session->userdata('id_aluno')){
        
            $data['nome'] = $this->model->nome_aluno();
            $data['page'] = 'senha';
            
            $this->load->view('aluno/body_view',$data);
            
        }else{
        
            redirect(base_url());    
            
        }
        
    }
    
    public function estagio(){
        
        $estagio = $this->dashboard->tipo_estagio();

        $html = "";

        switch($estagio->estagio):

            case "1":   $dados     = $this->dashboard->dados();

                        $documento = $this->dashboard->documento_curricular();

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



                        break;

            case "2":   $dados     = $this->dashboard->dados();

                        $documento = $this->dashboard->documento_equivalencia();

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

                        break;        

        endswitch;

        echo $html;
        
    }
    
    public function alterar_senha(){
        
        $dados = array('senha'       => $this->input->post('senha'),
                       'novasenha'   => $this->input->post('novasenha'),
                       'repetesenha' => $this->input->post('repetesenha'));
        
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
        
        if(md5($dados['senha']) != $this->model->senha_aluno()){
            
            die("Senha Atual errada, tente novamente.");
            
        }
        
        echo $this->dashboard->alterar_senha($dados['novasenha']);
        
    }
    
    public function gera_pdf(){
        
        if(empty($this->session->userdata('id_aluno'))){
            die("Acesso negado.");
        }
        
        $estagio = $this->dashboard->tipo_estagio();

        $html = "<link href='".base_url('assets/one/css/bootstrap.min.css')."' rel='stylesheet'>";

        switch($estagio->estagio):

            case "1":   $dados     = $this->dashboard->dados();

                        $documento = $this->dashboard->documento_curricular();

                        $data = array();

                        foreach($documento as $key => $item):

                            if($item==0){

                                $data[$key] = "<span class='text-warning'>Documento não Entregue</span>";

                            }else{

                                $data[$key] = "<span class='text-success'>Documento Entregue</span>";

                            }

                        endforeach;

                        
                        
                        $html .= "
                            
                                  <div class='center-block text-center'><img src='".base_url('assets/img/logo_fatec.png')."' style='max-width:110px; margin-bottom:10px;' border='0'></div>  

                                  <ul  class='list-group' style='list-style:none;'>

                                    <li  class='list-group-item'><strong>Nome:</strong> ".$dados->nome."</li>
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

            case "2":   $dados     = $this->dashboard->dados();

                        $documento = $this->dashboard->documento_equivalencia();

                        $data = array();

                        foreach($documento as $key => $item):

                            if($item==0){

                                $data[$key] = "<span class='text-warning'>Documento não Entregue</span>";

                            }else{

                                $data[$key] = "<span class='text-success'>Documento Entregue</span>";

                            }

                        endforeach;

                        $html .= "
                                    <div class='center-block text-center'><img src='".base_url('assets/img/logo_site.png')."' style='width:250px; margin-bottom:10px;' border='0'></div>  

                                     <ul class='list-group' style='list-style:none;'>

                                    <li  class='list-group-item'><strong>Nome:</strong> ".$dados->nome."</li>
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
    
}
