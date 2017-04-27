<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
   
    public function listar_curso() {
        
        return $this->sql("select a.*
                           from curso a 
                           order by a.titulo")->result();
        
    }
    
    public function curso_cadastrado($dados){
        
        $dados['titulo'] = removerAcento($dados['titulo']);
                
        $sql = "select count(a.id) as qtde
                from curso a
                where ltrim(lower(a.titulo)) = ltrim(lower('".$dados['titulo']."'))";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function curso_cadastrado_editar($dados, $id){
        
        $dados['titulo'] = removerAcento($dados['titulo']);
        
        $sql = "select count(a.id) as qtde
                from curso a
                where ltrim(lower(a.titulo)) = ltrim(lower('".$dados['titulo']."'))  
                and a.id <> ".$id." ";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function salvar_curso($dados){
        
        $dados = array('titulo'=>$dados['titulo'],
                       'status'=>$dados['status']);
        
        $x = $this->insert('curso', $dados);
        
        if($x){
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public function editar_curso($dados, $id){
        
        $dados = array('titulo'=>$dados['titulo'],
                       'status'=>$dados['status']);
        
        $x = $this->update('curso', $dados, array('id'=>$id));
        
        if($x){
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }

    public function dados_curso($id){
        
        return $this->sql("select *
                           from curso a
                           where a.id = ? ",$id)->row();
        
    }
    
    public function inativar_curso($id) {
        
        $x = $this->update('curso', array('status'=>0), array('id'=>$id));
        
        if($x){
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public function ativar_curso($id) {
        
        $x = $this->update('curso', array('status'=>1), array('id'=>$id));
        
        if($x){
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public function reset_curso($id){
        
        $x = $this->update('curso', array('status'=>1), array('id'=>$id));
        
        if($x){
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
}

