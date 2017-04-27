<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function dados(){
        
        return $this->sql("select 
                           a.*, 
                           b.titulo, 
                           d.periodo, 
                           e.nome as empresa, 
                           e.cnpj
                           from aluno a
                           inner join curso b on
                           b.id = a.id_curso
                           inner join periodo_curso d on
                           d.id = a.id_periodo_curso
                           inner join empresa e on
                           e.id = a.id_empresa
                           where a.id = ? ",  $this->id_aluno())->row();
        
    }
    
    public function tipo_estagio(){
        
        return $this->sql("select a.id_estagio as estagio
                           from aluno a
                           where a.id = ? ",$this->id_aluno())->row();
        
    }
    
    public function documento_equivalencia(){
        
        return $this->sql("select 
                           a.processo_equivalencia as e1,
                           a.plano_ativ_equivalencia as e2,
                           a.relatorio_final as e3
                           from documento_equivalencia a
                           where a.id_aluno = ?",$this->id_aluno())->row();
        
    }
    
    public function documento_curricular(){
        
        return $this->sql("select 
                           a.convenio_concessao_estagio as i1,
                           a.termo_compromisso_estagio as i2,
                           a.plano_ativ_estagio as i3,
                           a.apolice_seguro as i4,
                           a.relatorio_final_simplificado as f1,
                           a.relatorio_supervisao_estagio as f2,
                           a.modelo_relatorio_final as f3,
                           a.avaliacao_desempenho_estagio as f4
                           from documento_curricular a
                           where a.id_aluno = ? ",$this->id_aluno())->row();
        
    }
    
    public function alterar_senha($senha){
        
        $dados = array('senha' => md5($senha));
        
        $x = $this->update('aluno', $dados, array('id'=>$this->id_aluno()));
        
        if($x){
            
            $this->session->set_userdata('senha_aluno', $senha);
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    
    
}

