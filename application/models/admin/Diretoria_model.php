<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diretoria_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function salvar_diretoria($dados){
        
        try{
            
            $this->start_transaction();
            
            $this->load->helper('string');
        
            $senha = random_string('numeric', 10);
        
            $info = array('status'              =>  $dados['status'],
                          'nome'                =>  $dados['nome'],
                          'email'               =>  $dados['email'],
                          'senha'               =>  NULL,
                          'senha_temporaria'    =>  $senha);
        
            $x = $this->insert('diretor', $info);
            
            $this->commit();
            
            return array('result'=>true,'dados'=>$info);
            
        }catch(Exception $ex){
            
            $this->rollback();
            
            return array('result'=>false);
            
        }
        
    }
    
    public function alterar_diretoria($dados,$id){
        
        try{
            
            $this->start_transaction();
            
            $info = array('status'              =>  $dados['status'],
                          'nome'                =>  $dados['nome'],
                          'email'               =>  $dados['email']);
        
            $x = $this->update('diretor', $info, array('id'=>$id));
            
            $this->commit();
            
            return true;
            
        }catch(Exception $ex){
            
            $this->rollback();
            
            return false;
            
        }
        
    }
    
    public function listar_diretoria(){
        
        return $this->sql("select a.*
                           from diretor a
                           order by a.nome, a.email ")->result();
        
    }
    
    public function dados_diretoria($id){
        
        return $this->sql("select *
                           from diretor
                           where id = ?",$id)->row();
        
    }
    
    public function diretoria_cadastrado($email){
        
        $email = removerAcento($email);
                
        $sql = "select count(a.id) as qtde
                from diretor a
                where ltrim(lower(a.email)) = ltrim(lower('".$email."'))";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function diretoria_cadastrado_editar($email, $id){
        
        $email = removerAcento($email);
                
        $sql = "select count(a.id) as qtde
                from diretor a
                where ltrim(lower(a.email)) = ltrim(lower('".$email."'))
                and a.id <> ".$id."";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function excluir_diretoria($id){
        
        $x = $this->delete('diretor', array('id'=>$id));
        
        if($x){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function reenviar($id) {
        
        return $this->sql("select 
                           a.email, 
                           a.senha_temporaria as senha
                           from diretor a
                           where a.id = ? ",array($id))->row();
        
    }
    
}

