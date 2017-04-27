<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supervisor_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function salvar_supervisor($dados,$p){
        
        try{
            
            $this->start_transaction();
            
            $this->load->helper('string');
        
            $senha = random_string('numeric', 10);
        
            $info = array('status'              =>  $dados['status'],
                          'id_curso'            =>  $dados['curso'],
                          'nome'                =>  $dados['nome'],
                          'email'               =>  $dados['email'],
                          'senha_temporaria'    =>  $senha,
                          'periodo_manha'       =>  empty($p[0]['periodo_manha'])?NULL:$p[0]['periodo_manha'],
                          'periodo_tarde'       =>  empty($p[1]['periodo_tarde'])?NULL:$p[1]['periodo_tarde'],
                          'periodo_noite'       =>  empty($p[2]['periodo_noite'])?NULL:$p[2]['periodo_noite']);
        
            $x = $this->insert('supervisor', $info);
            
            $this->commit();
            
            return array('result'=>true,'dados'=>$info);
            
        }catch(Exception $ex){
            
            $this->rollback();
            
            return array('result'=>false);
            
        }
        
    }
    
    public function alterar_supervisor($dados,$p,$id){
        
        try{
            
            $this->start_transaction();
            
            $info = array('status'              =>  $dados['status'],
                          'id_curso'            =>  $dados['curso'],
                          'nome'                =>  $dados['nome'],
                          'email'               =>  $dados['email'],
                          'periodo_manha'       =>  empty($p[0]['periodo_manha'])?NULL:$p[0]['periodo_manha'],
                          'periodo_tarde'       =>  empty($p[1]['periodo_tarde'])?NULL:$p[1]['periodo_tarde'],
                          'periodo_noite'       =>  empty($p[2]['periodo_noite'])?NULL:$p[2]['periodo_noite']);
        
            $x = $this->update('supervisor', $info, array('id'=>$id));
            
            $this->commit();
            
            return true;
            
        }catch(Exception $ex){
            
            $this->rollback();
            
            return false;
            
        }
        
    }
    
    public function listar_supervisor(){
        
        return $this->sql("select a.*
                           from supervisor a
                           order by a.nome, a.email ")->result();
        
    }
    
    public function listar_curso(){
        
        return $this->sql("select a.id, a.titulo
                           from curso a")->result();
        
    }
    
    public function listar_periodo($id_curso){
        
        return $this->sql("select
                           case when (select count(a.periodo_manha) from supervisor a where a.id_curso = ? and a.periodo_manha = 1) = 1 then 1 
                           else 0 end as manha,
                           case when (select count(a.periodo_tarde) from supervisor a where a.id_curso = ? and a.periodo_tarde = 1) = 1 then 1 
                           else 0 end as tarde,
                           case when (select count(a.periodo_noite) from supervisor a where a.id_curso = ? and a.periodo_noite = 1) = 1 then 1 
                           else 0 end as noite 
                           from supervisor a
                                     inner join curso b on
                                     b.id = a.id_curso 
                           where a.id_curso = ?
                           and b.status = 1
                           group by a.id_curso ",array($id_curso,
                                                       $id_curso,
                                                       $id_curso,
                                                       $id_curso))->row();
        
    }
    
    public function periodo(){
        
        return $this->sql("select a.*
                           from periodo_curso a")->result();
        
    }
    
    public function dados_supervisor($id){
        
        return $this->sql("select *
                           from supervisor
                           where id = ?",$id)->row();
        
    }
    
    public function supervisor_cadastrado($email){
        
        $email = removerAcento($email);
                
        $sql = "select count(a.id) as qtde
                from supervisor a
                where ltrim(lower(a.email)) = ltrim(lower('".$email."'))";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function supervisor_cadastrado_editar($email, $id){
        
        $email = removerAcento($email);
                
        $sql = "select count(a.id) as qtde
                from supervisor a
                where ltrim(lower(a.email)) = ltrim(lower('".$email."'))
                and a.id <> ".$id."";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function reset_curso($id){
        
        $x = $this->update('supervisor', array('id_curso'      => NULL,
                                                'periodo_manha' => NULL,
                                                'periodo_tarde' => NULL,
                                                'periodo_noite' => NULL), 
                                          array('id'=>$id));
        
        if($x){
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public function excluir_supervisor($id){
        
        $x = $this->delete('supervisor', array('id'=>$id));
        
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
                           from supervisor a
                           where a.id = ? ",array($id))->row();
        
    }
    
}

