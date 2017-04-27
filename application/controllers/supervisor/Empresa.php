<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends MY_Controller {
    

function __construct(){

        parent::__construct();
        $this->load->model('supervisor/Empresa_model', 'empresa');
        
    }
    
    public function index(){

        if($this->session->userdata('id_cood')){
        
            $data['nome']       = $this->session->userdata('nome_cood');
            $data['curso']      = $this->model->sql("select titulo from curso where id = ? ",  $this->model->id_curso())->row()->titulo; 
            $data['periodo']    = $this->model->sql("select periodo from periodo_curso where id = ? ",  $this->model->id_periodo())->row()->periodo; 
            $data['page']       = 'empresa';
            
            $this->load->view('supervisor/body_view',$data);
            
        }else{
        
            redirect(base_url('supervisor/dashboard/login'));    
            
        }
        
    }
    
    public function salvar_empresa(){
        
        $id    = $this->encrypt->decode($this->input->post('id'));
        
        $dados = array('nome'       => $this->input->post('nome'),
                       'cnpj'       => $this->input->post('cnpj'),
                       'responsavel'=> $this->input->post('responsavel'),
                       'contato'    => $this->input->post('contato'),
                       'cep'        => $this->input->post('cep'),
                       'uf'         => $this->input->post('uf'),
                       'cidade'     => $this->input->post('cidade'),
                       'rua'        => $this->input->post('rua'),
                       'numero'     => $this->input->post('numero'),
                       'bairro'     => $this->input->post('bairro'),
                       'complemento'=> $this->input->post('complemento'));
        
        if(empty($dados['nome'])){
            
            die('Nome da empresa Obrigatório');
            
        }
        if(empty($dados['cnpj'])){
            
            die('CNPJ Obrigatório');
            
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
        if(!validaCNPJ($dados['cnpj'])){
            
            die('CNPJ não válido');
            
        }
        if(!validarCep($dados['cep'])){
            
            die('CEP não válido');
            
        }
        
        if(empty($id)){
    
            if($this->empresa->verifica_empresa($dados['cnpj'])){
                
                die("Empresa já cadastrada!");
                
            }
            
            echo $this->empresa->salvar_empresa($dados);
            
        }else{
            
            if($this->empresa->verifica_empresa_editar($dados['cnpj'], $id)){
                
                die("Empresa já cadastrada!");
                
            }
            
            echo $this->empresa->alterar_empresa($dados, $id);
            
        }
        
    }
    
    public function listar_empresa(){
        
        $dados = $this->empresa->listar_empresa($this->input->post('page'),
                                                $this->input->post('filtro'));
        $html  = "";
        
        foreach ($dados as $item):
            
            $id = $this->encrypt->encode($item->id);
            
            $html .= "<tr>
                          <td style='vertical-align:middle;'>$item->nome</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>". $item->responsavel ."<br>".$item->telefone."</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>". mask($item->cnpj,'##.###.###/####-##')."</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>$item->cidade</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>". mask($item->cep,'#####-###')."</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>$item->rua, Nº ".$item->numero." </td>
                          <td style='text-align:center; vertical-align:middle;'>
                          
                            <div class='btn-group' role='group'>
                                <button type='button' class='btn btn-primary dropdown-toggle btn-xs' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <strong>Ações</strong>
                                <span class='fa fa-angle-down'></span>
                                </button>
                                <ul class='dropdown-menu'>
                                  <li><a href='javascript:' class='link-alterar' id='".$id."'>Alterar Empresa</a></li>
                                </ul>
                            </div>
                          
                          </td>
                      </tr>";
            
        endforeach;
        
        if($html==""){
            
            $html .= "<tr colspan='6'><td>Não foi encontrado nenhum registro...<td><tr>";
            
        }
        
        echo json_encode(array('paginacao'  => $this->ajax_pagination->create_links(),
                               'html'       => $html));
        
    }
    
    public function dados_empresa(){
        
        $id = $this->encrypt->decode($this->input->post('id'));
        
        if(empty($id)){
            
            echo json_encode(array('error'=>true));
            
        }
        
        $dados = $this->empresa->dados_empresa($id);
        
        if($dados){
            
            echo json_encode(array('error'        => false,
                                   'nome'         => $dados->nome,
                                   'responsavel'  => $dados->responsavel,
                                   'contato'      => $dados->telefone,
                                   'cnpj'         => mask($dados->cnpj,'#####.###/####-##'),
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
    
    public function pdf(){
        
        $filtro  = $this->input->post('filtro');
        
        $dados   = $this->empresa->gera_arquivo($filtro);
        
        $html    = "<link href='".base_url('assets/one/css/bootstrap.min.css')."' rel='stylesheet'>
            
                    <div class='center-block text-center'><img src='".base_url('assets/img/logo_fatec.png')."' style='max-width:110px; margin-bottom:10px;' border='0'></div>  

                    <hr>

                    <table class='table table-bordered' style='margin-top: 10px;'>
                        <thead style='margin:5px;'>
                            <tr>
                                <th>Empresa</th>
                                <th style='text-align: center; padding:5px;'>Contato</th>
                                <th style='text-align: center; padding:5px;'>CNPJ</th>
                                <th style='text-align: center; padding:5px;'>Cidade</th>
                                <th style='text-align: center; padding:5px;'>CEP</th>
                                <th style='text-align: center; padding:5px;'>Endereço</th>
                                <th style='text-align: center; padding:5px;'>Qtde Alunos na Empresa</th>
                            </tr>
                        </thead>
                        <tbody>";
        $empresa = "";
        
        foreach($dados as $item):
            
            $empresa .= "<tr>
                          <td style='vertical-align:middle; padding:5px;'>$item->nome</td>
                          <td style='text-align:center; vertical-align:middle; padding:5px;'>". $item->responsavel ."<br>".$item->telefone."</td>
                          <td style='text-align:center; vertical-align:middle;  padding:5px;'>". mask($item->cnpj,'##.###.###/####-##')."</td>
                          <td style='text-align:center; vertical-align:middle; padding:5px;'>$item->cidade</td>
                          <td style='text-align:center; vertical-align:middle; padding:5px;'>". mask($item->cep,'#####-###')."</td>
                          <td style='text-align:center; vertical-align:middle; padding:5px;'>$item->rua, Nº ".$item->numero." </td>
                          <td style='text-align:center; vertical-align:middle; padding:5px;'>".$item->aluno_empresa." </td>
                        </tr>";
            
        endforeach;
        
        if($empresa==""){
           $empresa = "<tr colspan='6'><td>Não foi encontrado nenhum registro...<td><tr>";
        }
        
        $html .= $empresa . "</tbody></table>";
        
        $this->load->library('pdf');
        
        $pdf = $this->pdf->load('c', 'A4-L');
        $this->load->library('user_agent');
        $this->load->helper('string');
        
        $random = random_string('numeric', 5);

        $version = $this->agent->platform();
 
        $teste = strrpos(strtoupper($version), 'WINDOWS');
        
        if($teste === false){
            $pdfFilePath = $_SERVER['DOCUMENT_ROOT']."assets/pdf/empresa_".$this->model->id_cood().$random.".pdf";    
        }else{
            $pdfFilePath = "assets/pdf/empresa_".$this->model->id_cood().$random.".pdf";    
        }
        
        $pdf->writeHTML($html);  
        $pdf->Output($pdfFilePath,'F');
        
        echo base_url('assets/pdf')."/empresa_".$this->model->id_cood().$random.".pdf";
        
    }
    
    public function excel(){
        
        $filtro  = $this->input->post('filtro');
        $dados   = $this->empresa->gera_arquivo($filtro);
        
        $this->load->library('PHPExcel');
        $this->load->library('user_agent');
        $this->load->helper('string');
        
        $random = random_string('numeric', 5);
        
        $fileName = "empresa_".$this->model->id_cood().$random.".php";
        
        $version = $this->agent->platform();
        
        $teste = strrpos(strtoupper($version), 'WINDOWS');
        
        if($teste === false){
            $saveFilePATH = $_SERVER['DOCUMENT_ROOT']."assets/excel/".$fileName;    
        }else{
            $saveFilePATH = "./assets/excel/".$fileName;
        }

	$objPHPExcel = $this->phpexcel;

	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setLastModifiedBy("Sistema de Estágio");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setTitle("Empresas - Sistema de Estágio");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setSubject("Empresas - Sistema de Estágio");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setDescription("Excel gerado de empresas do Sistema de Estágio");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setKeywords("Empresa");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setCategory("Empresa");

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Empresa');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'Contato');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'CNPJ');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Cidade');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'CEP');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Endereço');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'Qtde Alunos na Empresa');
        
        $cont = 2;
        
        foreach ($dados as $item):
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$cont, $item->nome);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$cont, $item->responsavel . " " . $item->telefone);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$cont, mask($item->cnpj,'##.###.###/####-##'));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$cont, $item->cidade);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$cont, mask($item->cep,'#####-###'));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$cont, $item->rua . ", Nº ".$item->numero);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$cont, $item->aluno_empresa);
            
            $cont++;
            
        endforeach;
        
	$objPHPExcel->getActiveSheet()->setTitle('Simple');
	
	$objPHPExcel->setActiveSheetIndex(0);
        
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', $saveFilePATH));

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save(str_replace('.php', '.xls', $saveFilePATH));
        
        echo base_url('assets/excel')."/empresa_".$this->model->id_cood().$random.".xls";
	
    }
    
    
    
}
