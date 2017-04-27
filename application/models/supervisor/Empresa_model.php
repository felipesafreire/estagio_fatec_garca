<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function verifica_empresa($cnpj){
        
        $sql = "select count(a.id) as qtde
                from empresa a
                where a.cnpj = ".  soNumero($cnpj)." ";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function verifica_empresa_editar($cnpj,$id){
        
        $sql = "select count(a.id) as qtde
                from empresa a
                where a.cnpj = ".  soNumero($cnpj)." 
                and id <> ".$id." ";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function salvar_empresa($dados){
        
        try{
            
            $this->start_transaction();
            
            $empresa = array('nome'         => $dados['nome'],
                             'cnpj'         => soNumero($dados['cnpj']),
                             'telefone'     => $dados['contato'],
                             'responsavel'  => $dados['responsavel']);
            
            $this->insert('empresa', $empresa);
            $id_empresa = $this->last_id();
            
            $info    = array('id_empresa'    => $id_empresa,
                             'rua'           => $dados['rua'],
                             'bairro'        => $dados['bairro'],
                             'numero'        => $dados['numero'],
                             'complemento'   => empty($dados['complemento'])?NULL:$dados['complemento'],
                             'cep'           => soNumero($dados['cep']),
                             'cidade'        => $dados['cidade'],
                             'uf'            => $dados['uf']);
            
            $this->insert('endereco_empresa', $info);
            
            $this->commit();
                    
            return true;
            
        }catch(Exception $ex) {
            
            $this->rollback();
            
            return false;
            
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
        
        $sql = "select a.*, b.*
                from empresa a
                inner join endereco_empresa b on
                b.id_empresa = a.id
                ".$var."
                order by a.nome";
        
        config_pagination($this, $sql, $offset);
        return $this->sql($sql . ' LIMIT ' . $this->ajax_pagination->per_page . ' OFFSET ' . $this->ajax_pagination->cur_page)->result();
        
    }
    
    public function dados_empresa($id){
        
        return $this->sql("select a.*, b.*
                           from empresa a
                           inner join endereco_empresa b on
                           b.id_empresa = a.id
                           where a.id = ? ",$id)->row();
        
    }
    
    public function alterar_empresa($dados, $id){
        
        try{
            
            $this->start_transaction();
            
            $empresa = array('nome'         => $dados['nome'],
                             'cnpj'         => soNumero($dados['cnpj']),
                             'telefone'     => $dados['contato'],
                             'responsavel'  => $dados['responsavel']);
            
            $this->update('empresa', $empresa, array('id' => $id));
            
            $info    = array('rua'           => $dados['rua'],
                             'bairro'        => $dados['bairro'],
                             'numero'        => $dados['numero'],
                             'complemento'   => empty($dados['complemento'])?NULL:$dados['complemento'],
                             'cep'           => soNumero($dados['cep']),
                             'cidade'        => $dados['cidade'],
                             'uf'            => $dados['uf']);
            
            $this->update('endereco_empresa', $info, array('id_empresa' => $id));
            
            $this->commit();
                    
            return true;
            
        }catch(Exception $ex) {
            
            $this->rollback();
            
            return false;
            
        }
        
    }
    
    public function gera_arquivo($filtro){
        
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
    
}

