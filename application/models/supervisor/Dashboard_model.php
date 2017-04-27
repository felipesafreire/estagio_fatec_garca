<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function valida_login($email){
        
        return $this->sql("select a.*
                           from supervisor a
                           where a.email = ? ",$email)->row();
        
    }
    
    public function valida_curso($id) {
        
        $sql = "select a.status
                from curso a
                where a.id = ".$id." ";
        
        $x = $this->sql($sql)->row(); 
       
        return $x->status == 1 ? TRUE:FALSE;
        
    }
    
    public function primeiro_acesso($senha, $email){
        
        try{
           
            $this->start_transaction();
            
            $dados = array('senha'            => md5($senha),
                           'senha_temporaria' => NULL);
            
            $this->update('supervisor', $dados, array('email'=>$email));
            
            $info = $this->sql("select * from supervisor where email = ? ",$email)->row();
            
            $this->commit();
            return array('result'=>true,'dados'=>$info);
            
        }catch(Exception $ex) {
            
            $this->rollback();
            return array('result'=>false);
            
        }
        
    }
    
    public function seleciona_periodo($id){
        
        return $this->sql("select 
                           coalesce(a.periodo_manha,0) as manha,
                           coalesce(a.periodo_tarde,0) as tarde,
                           coalesce(a.periodo_noite,0) as noite
                           from supervisor a
                           where a.id = ? ",$id)->row();
        
    }
    public function periodo(){
        
        return $this->sql("select a.*
                           from periodo_curso a")->result();
        
    }
    
    public function listar_dados(){
        
        return $this->sql("select a.nome, a.email
                           from supervisor a 
                           where a.id = ? ",$this->id_cood())->row();
        
    }
    
    public function email_cadastrado($email){
        
        $sql = "select count(a.id) as qtde
                from supervisor a
                where ltrim(lower(a.email)) = ltrim(lower('".$email."'))  
                and a.id <> ".$this->id_cood()." ";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function alterar_dados($email,$nome){
        
        $dados = array('nome'   => $nome,
                       'email'  => $email);
        
        $x = $this->update('supervisor', $dados, array('id'=>$this->id_cood()));
        
        if($x){
            
            $this->session->set_userdata('email_cood', $email);
            $this->session->set_userdata('nome_cood', $nome);
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public function alterar_senha($senha){
        
        $dados = array('senha' => md5($senha));
        
        $x = $this->update('supervisor', $dados, array('id'=>$this->id_cood()));
        
        if($x){
            
            $this->session->set_userdata('senha_cood', $senha);
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public function verifica_email($email){
        
        $sql = "select count(a.id) as qtde
                from supervisor a
                where ltrim(lower(a.email)) = ltrim(lower('".$email."'))";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;

    }
    
    public function reset_senha($email){
        
        $this->load->helper('string');
        $senha = random_string('numeric', 10);
        
        $dados = array('senha'            => NULL,
                       'senha_temporaria' => $senha);
        
        $x = $this->update('supervisor', $dados, array('email'=>$email));
        
        if($x){
            
            return array('result'=>true, 'senha'=>$senha);
            
        }else{
            
            return array('result'=>FALSE);
            
        }
        
    }
    
}

