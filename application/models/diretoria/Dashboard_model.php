<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function valida_login($email){
        
        return $this->sql("select a.*
                           from diretor a
                           where a.email = ? ",$email)->row();
        
    }
    
    public function aluno_empresa($id){
        
        return $this->sql("select 
                           a.nome as nome_aluno,
                           a.ra,
                           a.cpf,
                           a.rg,
                           a.email,
                           b.nome,
                           b.cnpj,
                           b.telefone,
                           b.responsavel,
                           b.cnpj,
                           concat(e.rua,', Nº ',e.numero) as endereco,
                           e.cep,
                           e.cidade,
                           f.titulo as estagio,
                           a.telefone as tel_aluno,
                           a.celular as cel_aluno
                           from aluno a
                           inner join empresa b on
                           b.id = a.id_empresa
                           inner join endereco_empresa e on
                           e.id_empresa = b.id
                           inner join estagio f on
                           f.id = a.id_estagio
                           where b.id = ? ",array($id))->result();
        
    }
    
    public function primeiro_acesso($senha, $email){
        
        try{
           
            $this->start_transaction();
            
            $dados = array('senha'            => md5($senha),
                           'senha_temporaria' => NULL);
            
            $this->update('diretor', $dados, array('email'=>$email));
            
            $info = $this->sql("select * from diretor where email = ? ",$email)->row();
            
            $this->commit();
            return array('result'=>true,'dados'=>$info);
            
        }catch(Exception $ex) {
            
            $this->rollback();
            return array('result'=>false);
            
        }
        
    }
    
    public function listar_dados(){
        
        return $this->sql("select a.nome, a.email
                           from diretor a 
                           where a.id = ? ",$this->id_diretor())->row();
        
    }
    
    public function email_cadastrado($email){
        
        $sql = "select count(a.id) as qtde
                from diretor a
                where ltrim(lower(a.email)) = ltrim(lower('".$email."'))  
                and a.id <> ".$this->id_diretor()." ";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function alterar_dados($email,$nome){
        
        $dados = array('nome'   => $nome,
                       'email'  => $email);
        
        $x = $this->update('diretor', $dados, array('id'=>$this->id_diretor()));
        
        if($x){
            
            $this->session->set_userdata('email_diretor', $email);
            $this->session->set_userdata('nome_diretor', $nome);
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public function alterar_senha($senha){
        
        $dados = array('senha' => md5($senha));
        
        $x = $this->update('diretor', $dados, array('id'=>$this->id_diretor()));
        
        if($x){
            
            $this->session->set_userdata('senha_diretor', $senha);
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public function verifica_email($email){
        
        $sql = "select count(a.id) as qtde
                from diretor a
                where ltrim(lower(a.email)) = ltrim(lower('".$email."'))";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;

    }
    
    public function reset_senha($email){
        
        $this->load->helper('string');
        $senha = random_string('numeric', 10);
        
        $dados = array('senha'            => NULL,
                       'senha_temporaria' => $senha);
        
        $x = $this->update('diretor', $dados, array('email'=>$email));
        
        if($x){
            
            return array('result'=>true, 'senha'=>$senha);
            
        }else{
            
            return array('result'=>FALSE);
            
        }
        
    }
    
    public function listar_empresa($offset=0,$filtro){
        
        if(empty($filtro['nome']) && empty($filtro['cnpj'])){
            
            $var = "";
            
        }else if(empty($filtro['nome']) && !empty($filtro['cnpj'])){
            
            $var = "where a.cnpj  = " . soNumero($filtro['cnpj']) ." ";
            
        }else if(empty($filtro['cnpj']) && !empty($filtro['nome'])){
            
            $var = "where lower(a.nome) like '%" . strtolower($filtro['nome']) . "%'";
            
        }else{
            
            $var = "where a.cnpj  = " . soNumero($filtro['cnpj']) ." and
                    lower(a.nome) like '%" . strtolower($filtro['nome']) . "%'";
        }
        
        $sql = "select a.*, b.*,
                (select count(c.id)
                from aluno c
                where c.status = 1
                and a.id = c.id_empresa) as aluno_empresa
                from empresa a
                inner join endereco_empresa b on
                b.id_empresa = a.id
                ".$var."
                order by a.nome";
        
        config_pagination($this, $sql, $offset, 10);
        return $this->sql($sql . ' LIMIT ' . $this->ajax_pagination->per_page . ' OFFSET ' . $this->ajax_pagination->cur_page)->result();
        
    }
    
    public function gera_arquivo_empresa($filtro){
        
        if(empty($filtro['nome']) && empty($filtro['cnpj'])){
            
            $var = "";
            
        }else if(empty($filtro['nome']) && !empty($filtro['cnpj'])){
            
            $var = "where a.cnpj  = " . soNumero($filtro['cnpj']) ." ";
            
        }else if(empty($filtro['cnpj']) && !empty($filtro['nome'])){
            
            $var = "where lower(a.nome) like '%" . strtolower($filtro['nome']) . "%'";
            
        }else{
            
            $var = "where a.cnpj  = " . soNumero($filtro['cnpj']) ." and
                    lower(a.nome) like '%" . strtolower($filtro['nome']) . "%'";
        }
        
        $sql = "select a.*,
                b.*,
                (select count(c.id)
                from aluno c
                where c.status = 1
                and a.id = c.id_empresa) as aluno_empresa
                from empresa a
                inner join endereco_empresa b on
                b.id_empresa = a.id
                ".$var."
                order by a.nome";
        
        return $this->sql($sql)->result();
        
    }
    
    public function listar_supervisor($offset=0){
        
        $sql = "select 
                a.id,
                a.nome,
                a.email,
                (case a.periodo_manha
                when 1 then 'Manhã' else null end) as periodo_manha,
                (case a.periodo_tarde
                when 1 then 'Tarde' else null end) as periodo_tarde,
                (case a.periodo_noite
                when 1 then 'Noite' else null end) as periodo_noite,
                b.titulo
                from supervisor a
                inner join curso b on
                        a.id_curso = b.id
                where a.status = 1
                order by b.titulo ";
        
        config_pagination($this, $sql, $offset, 10);
        return $this->sql($sql . ' LIMIT ' . $this->ajax_pagination->per_page . ' OFFSET ' . $this->ajax_pagination->cur_page)->result();
        
    }
    
    public function gera_arquivo_supervisor(){
        
        $sql = "select 
                a.id,
                a.nome,
                a.email,
                (case a.periodo_manha
                when 1 then 'Manhã' else null end) as periodo_manha,
                (case a.periodo_tarde
                when 1 then 'Tarde' else null end) as periodo_tarde,
                (case a.periodo_noite
                when 1 then 'Noite' else null end) as periodo_noite,
                b.titulo
                from supervisor a
                inner join curso b on
                        a.id_curso = b.id
                where a.status = 1
                order by b.titulo ";
       
        return $this->sql($sql)->result();
        
    }
    
    public function dados_email_supervisor($id){
        
        return $this->sql("select a.email
                           from supervisor a
                           where a.id = ? ",array($id))->row();
        
    }
    
}

