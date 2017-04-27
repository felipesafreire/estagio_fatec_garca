<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    function __construct(){

        parent::__construct();
        $this->load->model('admin/Dashboard_model', 'dashboard');
        
    }
    
    public function index(){

        if($this->session->userdata('id_admin')){
        
            $data['nome'] = $this->session->userdata('nome_admin');
            $data['page'] = "blank";
            $this->load->view('admin/body_view',$data);
            
        }else{
        
            redirect(base_url('admin/dashboard/login'));    
            
        }
        
    }
    
    public function login(){
        
        $this->session->unset_userdata('id_admin');
        $this->session->unset_userdata('email_admin');
        $this->session->unset_userdata('senha_admin');
        $this->session->unset_userdata('nome_admin');
        
        $this->load->view('admin/login_view');
        
    }
    
    public function entrar(){
        
        $email = $this->input->post('email');
        $senha = $this->input->post('senha');
        
        if(empty($email)){
            
            die(json_encode(array('result'=>false,'msg'=>"Campo e-mail em branco!")));
            
        }
        if(empty($senha)){
            
            die(json_encode(array('result'=>false,'msg'=>"Campo senha em branco!")));
            
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            
            die(json_encode(array('result'=>false,'msg'=>"E-mail inválido!")));
            
        }
        
        $x =  $this->dashboard->valida_login($email,$senha);
        
        if($x['result']){
            
            echo json_encode(array('result'=>true, 'url'=>base_url('admin/dashboard')));
            
        }else{
            
             echo json_encode(array('result'=>false, 'msg'=>"Dados invalidos"));
            
        }
        
    }

}
