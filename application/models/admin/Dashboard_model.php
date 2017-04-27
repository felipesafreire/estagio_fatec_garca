<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function valida_login($email, $senha){
        
        $sql = $this->sql("select count(*) as qtde
                           from admin 
                           where email = ?
                           and senha = md5(?) ",array($email,$senha))->row();
        
        if($sql->qtde > 0){
            
            $dados = $this->sql("select *
                                 from admin
                                 where email = ? ",$email)->row();
            
            $this->session->set_userdata('id_admin',$dados->id);
            $this->session->set_userdata('email_admin',$email);
            $this->session->set_userdata('senha_admin',$dados->senha);
            $this->session->set_userdata('nome_admin',$dados->nome);
            
            return array('result'=>true);
            
        }else{
            
            return array('result'=>false);
            
        }
        
    }
   
}

