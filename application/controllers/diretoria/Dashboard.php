<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

function __construct(){

        parent::__construct();
        $this->load->model('diretoria/Dashboard_model', 'dashboard');
        
    }
    
    public function index(){

        if($this->model->id_diretor()){
            
            $data['nome']       = $this->model->nome_diretor();
            $data['page']       = 'relatorio';
            $this->load->view('diretoria/body_view',$data);
            
        }else{
        
            redirect(base_url('diretoria/dashboard/login'));    
            
        }
        
    }
    
    public function login(){
            
        $this->session->unset_userdata('id_diretor');
        $this->session->unset_userdata('email_diretor');
        $this->session->unset_userdata('senha_diretor');
        $this->session->unset_userdata('nome_diretor');

        $this->load->view('diretoria/login_view');
        
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
        
        $x = $this->dashboard->valida_login($email);
        
        if(empty($x)){
            
            die(json_encode(array('result'=>false,'msg'=>"Usuário não cadastrado!")));
            
        }else{
            
            if($x->status!=1){
                
                $msg = " ".$x->nome.", seu(a) usuário consta inativo, entre em contato com o administrador.";
                
                die(json_encode(array('result'=>false,'msg'=>$msg)));
                
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

                        $x = $this->grava_sessao($x->nome, $x->email, $x->id, $x->senha);

                        if($x){

                            echo json_encode(array('result'=>true,'ok'=> 2, 'url'=>base_url('diretoria/dashboard')));

                        }else{
                            
                            die(json_encode(array('result'=>false,'msg'=>"Erro ao logar!")));
                            
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
    
    public function grava_sessao($nome,$email,$id,$senha){
        
        $this->session->set_userdata('id_diretor', $id);  
        $this->session->set_userdata('email_diretor', $email);    
        $this->session->set_userdata('senha_diretor', $senha);
        $this->session->set_userdata('nome_diretor', $nome);
        return true;
        
    }
            
    public function dados(){
        
        if($this->model->id_diretor()){
            
            $data['nome'] = $this->model->nome_diretor();
            $data['page'] = 'dados';
            
            $this->load->view('diretoria/body_view',$data);
            
        }else{
        
            redirect(base_url('diretoria/dashboard/login'));    
            
        }
        
    }
    
    public function senha(){
        
        if($this->model->id_diretor()){
            
            $data['nome'] = $this->model->nome_diretor();
            $data['page'] = 'senha';
            
            $this->load->view('diretoria/body_view',$data);
            
        }else{
        
            redirect(base_url('diretoria/dashboard/login'));    
            
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
        
        $dados = array('senha'       => md5($this->input->post('senha')),
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
        
        if($dados['senha'] != $this->model->senha_diretor()){
            
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
                               
                    <a href='".base_url('diretoria/dashboard/login')."' style='text-align:center;
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
    
    public function listar_empresa(){
        
        $dados = $this->dashboard->listar_empresa($this->input->post('page'),
                                                $this->input->post('filtro'));
        $html  = "";
        
        foreach ($dados as $item):
            
            $id = $this->encrypt->encode($item->id);
        
            if($item->aluno_empresa>0){
                $relatorio = "<a href='javascript:' id='".$id."' class='relatorio-empresa'> <button type='button' class='btn btn-primary btn-xs'><strong>Aluno(s) Empresa</strong></button></a>";
            }else{
                $relatorio = " - ";
            }
            
            $html .= "<tr>
                          <td style='vertical-align:middle;'>$item->nome</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>". $item->responsavel ."<br>".$item->telefone."</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>". mask($item->cnpj,'##.###.###/####-##')."</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>$item->cidade</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>". mask($item->cep,'#####-###')."</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>$item->rua, Nº ".$item->numero." </td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>".$item->aluno_empresa."</td>
                              
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>

                                ".$relatorio."

                          </td>
                          
                      </tr>";
            
        endforeach;
        
        if($html==""){
            
            $html .= "<tr colspan='6'><td>Não foi encontrado nenhum registro...<td><tr>";
            
        }
        
        $tabela = "tabela_empresa";
        
        echo json_encode(array('paginacao'  => $this->ajax_pagination->create_links($tabela),
                               'html'       => $html));
        
    }
    
    public function pdf_empresa(){
        
        $filtro  = $this->input->post('filtro');
        
        $dados   = $this->dashboard->gera_arquivo_empresa($filtro);
        
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
            $pdfFilePath = $_SERVER['DOCUMENT_ROOT']."assets/pdf/empresa_".$this->model->id_diretor().$random.".pdf";    
        }else{
            $pdfFilePath = "assets/pdf/empresa_".$this->model->id_diretor().$random.".pdf";    
        }
        
        $pdf->writeHTML($html);  
        $pdf->Output($pdfFilePath,'F');
        
        echo base_url('assets/pdf')."/empresa_".$this->model->id_diretor().$random.".pdf";
        
    }
    
    public function excel_empresa(){
        
        $filtro  = $this->input->post('filtro');
        $dados   = $this->dashboard->gera_arquivo_empresa($filtro);
        
        $this->load->library('PHPExcel');
        $this->load->library('user_agent');
        $this->load->helper('string');
        
        $random = random_string('numeric', 5);
        
        $fileName = "empresa_".$this->model->id_diretor().$random.".php";
        
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
        
        echo base_url('assets/excel')."/empresa_".$this->model->id_diretor().$random.".xls";
	
    }
    
    public function listar_supervisor(){
        
        $dados = $this->dashboard->listar_supervisor($this->input->post('page'));
        $html  = "";
        
        foreach ($dados as $item):
            
            $id = $this->encrypt->encode($item->id);
            
            if($item->periodo_manha!=NULL){
                $manha = $item->periodo_manha."<br>";
            }else{
                $manha = null;
            }
                
            if($item->periodo_tarde!=NULL){
                $tarde = $item->periodo_tarde."<br>";
            }else{
                $tarde = null;
            }
            if($item->periodo_noite!=NULL){
                $noite = $item->periodo_noite;
            }else{
                $noite = null;
            }
            
            $html .= "<tr>
                          <td style='vertical-align:middle;'>$item->nome</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>". $item->email ."</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>". $item->titulo ."</td>
                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>
                            
                            ".$manha."
                            ".$tarde."
                            ".$noite."
                                
                            
                          </td>

                          <td style='text-align:center; vertical-align:middle;' class='hidden-xs hidden-sm'>

                            <div class='btn-group'>
                                <button type='button' class='btn btn-primary btn-xs'><strong>Ações</strong></button>
                                <button type='button' class='btn btn-primary btn-xs dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                                  <span class='caret'></span>
                                </button>
                                <ul class='dropdown-menu' role='menu'>
                                    <li><a href='javascript:' id='".$id."' class='enviar-email-supervisor'>Enviar E-mail</a></li>
                                </ul>
                            </div>
                            
                            </td>

                      </tr>";
            
        endforeach;
        
        if($html==""){
            
            $html .= "<tr colspan=''><td>Não foi encontrado nenhum registro...<td><tr>";
            
        }
        
        $tabela = "tabela_supervisor";
        
        echo json_encode(array('paginacao'  => $this->ajax_pagination->create_links($tabela),
                               'html'       => $html));
        
    }
    
    public function dados_email(){
        
        $id = $this->encrypt->decode($this->input->post('id'));
        
        if(empty($id)){
            die(false);
        }
        
        $dados = $this->dashboard->dados_email_supervisor($id);
        
        if($dados){
            
            echo json_encode(array('error'        => false,
                                   'origem'       => $this->model->email_diretor(),
                                   'destinatario' => $dados->email));
            
        }else{
            
            echo json_encode(array('error'=>true));
            
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
                   "<br><br><br><hr><h4>Sistema de Estágio<br>
                    (Foi enviado através do Sistema de Estágio)<br>
                    <strong>*** NÃO RESPONDA A ESSE EMAIL ***</strong></h4>";
        
        $this->load->library('email');
        $this->email->initialize();
        $this->email->from($this->email_envio(), $this->model->nome_diretor());
        $this->email->to($dados['destinatario']);
        $this->email->subject($dados['assunto']);
        $this->email->message($mensagem);
        $x = $this->email->send();
        
        echo true;
        
    }
    
    public function pdf_supervisor(){

        
        $dados   = $this->dashboard->gera_arquivo_supervisor();
        
        $html    = "<link href='".base_url('assets/one/css/bootstrap.min.css')."' rel='stylesheet'>
            
                    <div class='center-block text-center'><img src='".base_url('assets/img/logo_fatec.png')."' style='max-width:110px; margin-bottom:10px;' border='0'></div>  

                    <hr>

                    <table class='table table-bordered' style='margin-top: 10px;'>
                        <thead style='margin:5px;'>
                            <tr>
                                <th style='padding:5px;'>Nome</th>
                                <th style='text-align: center; padding:5px;'>E-mail</th>
                                <th style='text-align: center; padding:5px;'>Curso Administra</th>
                                <th style='text-align: center; padding:5px;'>Periodo(s) Curso</th>
                            </tr>
                        </thead>
                        <tbody>";
        $supervisor = "";
        
        foreach($dados as $item):
            
            if($item->periodo_manha!=NULL){
                $manha = $item->periodo_manha."<br>";
            }else{
                $manha = null;
            }
                
            if($item->periodo_tarde!=NULL){
                $tarde = $item->periodo_tarde."<br>";
            }else{
                $tarde = null;
            }
            if($item->periodo_noite!=NULL){
                $noite = $item->periodo_noite;
            }else{
                $noite = null;
            }
            
            $supervisor .= "<tr>
                                <td style='vertical-align:middle;  padding:5px;'>$item->nome</td>
                                <td style='text-align:center; vertical-align:middle;  padding:5px;' >". $item->email ."</td>
                                <td style='text-align:center; vertical-align:middle;  padding:5px;'>". $item->titulo ."</td>
                                <td style='text-align:center; vertical-align:middle;  padding:5px;'>
                                  ".$manha."
                                  ".$tarde."
                                  ".$noite."
                                </td>
                            </tr>";
            
        endforeach;
        
        if($supervisor==""){
           $supervisor = "<tr colspan='4'><td>Não foi encontrado nenhum registro...<td><tr>";
        }
        
        $html .= $supervisor . "</tbody></table>";
        
        $this->load->library('pdf');
        
        $pdf = $this->pdf->load('c', 'A4-L');
        $this->load->library('user_agent');
        $this->load->helper('string');
        
        $random = random_string('numeric', 5);

        $version = $this->agent->platform();
 
        $teste = strrpos(strtoupper($version), 'WINDOWS');
        
        if($teste === false){
            $pdfFilePath = $_SERVER['DOCUMENT_ROOT']."assets/pdf/supervisor_".$this->model->id_diretor().$random.".pdf";    
        }else{
            $pdfFilePath = "assets/pdf/supervisor_".$this->model->id_diretor().$random.".pdf";    
        }
        
        $pdf->writeHTML($html);  
        $pdf->Output($pdfFilePath,'F');
        
        echo base_url('assets/pdf')."/supervisor_".$this->model->id_diretor().$random.".pdf";
        
    }
    
    public function excel_supervisor(){
        
        $dados   = $this->dashboard->gera_arquivo_supervisor();
        
        $this->load->library('PHPExcel');
        $this->load->library('user_agent');
        $this->load->helper('string');
        
        $random = random_string('numeric', 5);
        
        $fileName = "supervisor_".$this->model->id_diretor().$random.".php";
        
        $version = $this->agent->platform();
        
        $teste = strrpos(strtoupper($version), 'WINDOWS');
        
        if($teste === false){
            $saveFilePATH = $_SERVER['DOCUMENT_ROOT']."assets/excel/".$fileName;    
        }else{
            $saveFilePATH = "./assets/excel/".$fileName;
        }

	$objPHPExcel = $this->phpexcel;

	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setLastModifiedBy("Sistema de Estágio");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setTitle("Supervisores de Estágio - Sistema de Estágio");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setSubject("Supervisores de Estágio - Sistema de Estágio");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setDescription("Excel gerado de supervisores do Sistema de Estágio");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setKeywords("Supervisores de Estágio");
	$objPHPExcel->getProperties()->setCreator("Sistema de Estágio")->setCategory("Supervisores de Estágio");

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Nome');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'E-mail');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'Curso Administra');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Manhã');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'Tarde');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Noite');
        
        $cont = 2;
        
        foreach ($dados as $item):
            
            if($item->periodo_manha!=NULL){
                $manha = $item->periodo_manha;
            }else{
                $manha = null;
            }   
            if($item->periodo_tarde!=NULL){
                $tarde = $item->periodo_tarde;
            }else{
                $tarde = null;
            }
            if($item->periodo_noite!=NULL){
                $noite = $item->periodo_noite;
            }else{
                $noite = null;
            }
            
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$cont, $item->nome);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$cont, $item->email);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$cont, $item->titulo);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$cont, $manha);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$cont, $tarde);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$cont, $noite);
            
            $cont++;
            
        endforeach;
        
	$objPHPExcel->getActiveSheet()->setTitle('Simple');
	
	$objPHPExcel->setActiveSheetIndex(0);
        
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save(str_replace('.php', '.xlsx', $saveFilePATH));

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save(str_replace('.php', '.xls', $saveFilePATH));
        
        echo base_url('assets/excel')."/supervisor_".$this->model->id_diretor().$random.".xls";
	
    }
    
    public function aluno_empresa(){
        
        $id = $this->encrypt->decode($this->input->post('id'));
        
        if(empty($id)){
            die(false);
        }
        
        $dados = $this->dashboard->aluno_empresa($id);
        
        $html        = "<link href='".base_url('assets/one/css/bootstrap.min.css')."' rel='stylesheet'>
            
                    <div class='center-block text-center'><img src='".base_url('assets/img/logo_fatec.png')."' style='max-width:110px; margin-bottom:10px;' border='0'></div>  

                    <hr>
                    
                    <ul style='list-style:none; padding-left:0px!important; margin-left:0px!important;'>
                        <li><span style='font-weight: bold;'>Nome Empresa:</span> ".$dados[0]->nome." <span style='font-weight: bold;'>CNPJ:</span> ".mask($dados[0]->cnpj,'##.###.###/####-##')."</li>
                        <li><span style='font-weight: bold;'>Responsável da Empresa:</span> ".$dados[0]->responsavel." <span style='font-weight: bold;'>Telefone:</span> ".$dados[0]->telefone."</li>
                        <li><span style='font-weight: bold;'>Endereço:</span> ".$dados[0]->endereco."</li>
                        <li><span style='font-weight: bold;'>Cidade:</span> ".$dados[0]->cidade." <span style='font-weight: bold;'>CEP:</span> ".mask($dados[0]->cep,'#####-###')."</li>
                    </ul>

                    <p><span style='font-weight: bold;'>Alunos</span></p>
                    
                    <table class='table table-bordered' style='margin-top: 10px;'>
                        <thead style='margin:5px;'>
                            <tr>
                                <th style='padding:5px;'>Nome, E-mail</th>
                                <th style='text-align: center; padding:5px;'>Estágio</th>
                                <th style='text-align: center; padding:5px;'>Documentos</th>
                                <th style='text-align: center; padding:5px;'>Contato</th>
                            </tr>
                        </thead>
                        <tbody>";
       
        foreach ($dados as $item):
            
            $html .= "<tr>
                        <td style='vertical-align:middle;  padding:5px;'>".$item->nome_aluno." <br> ".$item->email."</td>
                        <td style='text-align:center; vertical-align:middle;  padding:5px;' >". $item->estagio ."</td>
                        <td style='text-align:center; vertical-align:middle;  padding:5px;'>".$item->ra." <br> ".mask($item->cpf, "###.###.###-##")." <br> ".$item->rg."</td>
                        <td style='text-align:center; vertical-align:middle;  padding:5px;'>".mask($item->cel_aluno,'(##) ####-####')." <br> ".mask($item->tel_aluno,'(##) ###-####')."</td>
                      </tr>";
            
        endforeach;
        
        $html .= "</tbody></table>";
        
        $this->load->library('pdf');
        
        $pdf = $this->pdf->load('c', 'A4-L');
        $this->load->library('user_agent');
        $this->load->helper('string');
        
        $random = random_string('numeric', 5);

        $version = $this->agent->platform();
 
        $teste = strrpos(strtoupper($version), 'WINDOWS');
        
        if($teste === false){
            $pdfFilePath = $_SERVER['DOCUMENT_ROOT']."assets/pdf/aluno".$this->model->id_diretor().$random.".pdf";    
        }else{
            $pdfFilePath = "assets/pdf/aluno".$this->model->id_diretor().$random.".pdf";    
        }
        
        $pdf->writeHTML($html);  
        $pdf->Output($pdfFilePath,'F');
        
        echo base_url('assets/pdf')."/aluno".$this->model->id_diretor().$random.".pdf";
        
    }
    
}
