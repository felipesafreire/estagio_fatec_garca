<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function verifica_aluno($ra){
        
        $sql = $this->sql("select count(a.id) as qtde
                           from aluno a
                           where a.ra = ? ",$ra)->row();
        
        return $sql->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function tipo_estagio($ra){
        
        return $this->sql("select a.id_estagio as estagio
                           from aluno a
                           where a.ra = ? ",$ra)->row();
        
    }
    
    public function dados($ra){
        
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
                           where a.ra = ? ",$ra)->row();
        
    }
    public function dados_email($ra){
        
        return $this->sql("select 
                           a.*, 
                           f.email as email_supervisor,
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
                           inner join supervisor f on
                           f.id_curso = b.id
                           where a.ra = ?
                           limit 1 ",$ra)->row();
        
    }
    
    public function documento_equivalencia($id){
        
        return $this->sql("select 
                           a.processo_equivalencia as e1,
                           a.plano_ativ_equivalencia as e2,
                           a.relatorio_final as e3
                           from documento_equivalencia a
                           where a.id_aluno = ?",$id)->row();
        
    }
    
    public function documento_curricular($id){
        
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
                           where a.id_aluno = ? ",$id)->row();
        
    }
    
    public function senha_temporaria($dados){
        
        $info = array('senha'            => md5($dados['senha']),
                      'senha_temporaria' => NULL);
        
        $x = $this->update('aluno', $info, array('ra' => $dados['ra']));
        
        if($x){
            return array('result' => true);
        }else{
            return array('result' => false);
        }
        
    }
    
    public function esqueceu_senha($ra){
        
        $this->load->helper('string');
        
        $senha = random_string('numeric', 10);
        
        $dados = array('senha'            => NULL,
                       'senha_temporaria' => $senha);
        
        $x = $this->update('aluno', $dados, array('ra' => $ra));
        
        if($x){
            
            $sql = $this->sql("select a.email
                               from aluno a
                               where a.ra = ? ",$ra)->row();
            
            return array('result' => true, 'email' => $sql->email, 'senha' => $senha);
            
        }else{
            
            return array('result' => false);
            
        }
        
    }
    
}

