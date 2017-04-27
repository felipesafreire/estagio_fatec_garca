<?php

class MY_Model extends CI_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function sql($query,$condicao=array()){
         return $this->db->query($query,$condicao);
    }
    
    public function insert($tabela,$dados){
        $this->db->insert($tabela,$dados);
        return $this->db->affected_rows();
    } 
    
    public function update($tabela,$dados,$condicao){
        $this->db->update($tabela,$dados,$condicao);
        return $this->db->affected_rows();
    }     
    
    public function last_id(){
        return $this->db->insert_id();
    }
    
    public function delete($tabela,$condicao){
        $this->db->delete($tabela,$condicao);
        return $this->db->affected_rows();
    } 
    
    public function start_transaction(){
        $this->db->trans_start();
    }
    
    public function commit(){
        $this->db->trans_complete();
    }    
    
    public function rollback(){
        $this->db->trans_rollback();
    }
    
    public function id_admin(){
        return $this->session->userdata('id_admin');
    }
    
    public function email_admin(){
        return $this->session->userdata('email_admin');
    }
    
    public function senha_admin(){
        return $this->session->userdata('senha_admin');
    }
    
    public function nome_admin(){
        return $this->session->userdata('nome_admin');
    }
    
    public function id_cood(){
        return $this->session->userdata('id_cood');
    }
    
    public function email_cood(){
        return $this->session->userdata('email_cood');
    }
    
    public function senha_cood(){
        return $this->session->userdata('senha_cood');
    }
    
    public function nome_cood(){
        return $this->session->userdata('nome_cood');
    }
    
    public function id_curso(){
        return $this->session->userdata('id_curso');
    }
    
    public function id_periodo(){
        return $this->session->userdata('id_periodo');
    }
    
    public function id_aluno(){
        return $this->session->userdata('id_aluno');
    }
    
    public function nome_aluno(){
        return $this->session->userdata('nome_aluno');
    }
    
    public function ra_aluno(){
        return $this->session->userdata('ra_aluno');
    }
    
    public function senha_aluno(){
        return $this->session->userdata('senha_aluno');
    }
    
    public function curso_aluno(){
        return $this->session->userdata('curso_aluno');
    }
    
    public function periodo_aluno(){
        return $this->session->userdata('periodo_aluno');
    }
    
    public function id_diretor(){
        return $this->session->userdata('id_diretor');
    }
    
    public function email_diretor(){
        return $this->session->userdata('email_diretor');
    }
    
    public function senha_diretor(){
        return $this->session->userdata('senha_diretor');
    }
    
    public function nome_diretor(){
        return $this->session->userdata('nome_diretor');
    }
    
}