<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estagio_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function vaga_curso($id){
        
        return $this->sql("select 
                           a.titulo,
                           a.url_vaga as url,
                           cast(a.data_cadastro as date) as data
                           from vaga_estagio a
                           where a.curso_id = ? 
                           order by 3 desc ",array($id))->result();
        
    }
    
    public function busca_vaga_url($url){
        
        return $this->sql("select
                           a.titulo,
                           a.html,
                           cast(a.data_cadastro as date) as data
                           from vaga_estagio a
                           where a.url_vaga = ? ", array($url))->row();
        
    }
    
}

