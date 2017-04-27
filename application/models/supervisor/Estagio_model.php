<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estagio_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function vaga_cadastrada($titulo){
        
        $titulo = removerAcento($titulo);
                
        $sql = "select count(a.id) as qtde
                from vaga_estagio a
                where ltrim(lower(a.titulo)) = ltrim(lower('".$titulo."'))";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function vaga_cadastrada_editar($titulo,$id){
        
        $titulo = removerAcento($titulo);
                
        $sql = "select count(a.id) as qtde
                from vaga_estagio a
                where ltrim(lower(a.titulo)) = ltrim(lower('".$titulo."'))
                and a.id <> ".$id."";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function salvar_estagio($dados){
        
        $info = array('titulo'         => $dados['titulo'],
                      'html'           => $dados['descricao'],
                      'periodo_id'     => $this->id_periodo(),
                      'curso_id'       => $this->id_curso(),
                      'url_vaga'       => $dados['url']);
        
        $x = $this->insert('vaga_estagio', $info);
        
        if($x){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function editar_estagio($dados){
        
        $info = array('titulo'         => $dados['titulo'],
                      'html'           => $dados['descricao'],
                      'url_vaga'       => $dados['url']);
        
        $x = $this->update('vaga_estagio', $info, array('id' => $dados['id']));
        
        if($x){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function verifica_url($nome){

        $sql = "select count(*) qtde
                from vaga_estagio 
                where lower(titulo) = lower(?)";

        $row = $this->db->query($sql,array($nome))->row();  

        return ($row->qtde);
              
    }
    
    public function dados_estagio($offset=0,$filtro){
        
        $sql = "select a.*
                from vaga_estagio a
                where a.periodo_id = ".$this->id_periodo()."
                and a.curso_id = ".$this->id_curso()." 
                ".(!empty($filtro['nome'])?'and lower(a.titulo) like "%'.strtolower($filtro['nome']).'%"':"")."         
                ".(!empty($filtro['datainicial'])?'and cast(a.data_cadastro as date) >= "'.inverteData($filtro['datainicial']).'"':"")."        
                ".(!empty($filtro['datafinal'])?'and cast(a.data_cadastro as date) <= "'.inverteData($filtro['datafinal']).'"':"")."
                order by a.data_cadastro desc ";
        
        config_pagination($this, $sql, $offset);
        return $this->sql($sql . ' LIMIT ' . $this->ajax_pagination->per_page . ' OFFSET ' . $this->ajax_pagination->cur_page)->result();
        
    }
    
    public function dados_vaga($id){
        
         $sql = "select a.*
                from vaga_estagio a
                where a.periodo_id = ".$this->id_periodo()."
                and a.curso_id = ".$this->id_curso()." 
                and a.id = ".$id." ";
         
        return $this->sql($sql)->row();
        
    }
    
    public function excluir_vaga($id) {
        
        $x = $this->delete('vaga_estagio', array('id'         => $id,
                                                 'periodo_id' => $this->id_periodo(),
                                                 'curso_id'   => $this->id_curso()));
        
        if($x){
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
}

