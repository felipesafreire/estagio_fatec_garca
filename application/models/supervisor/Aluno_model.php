<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aluno_model extends MY_Model {

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    
    public function listar_estagio(){
        
        return $this->sql("select a.*
                           from estagio a")->result();
        
    }
    
    public function listar_empresa(){
        
        return $this->sql("select a.*
                           from empresa a")->result();
        
    }
    
    public function verifica_email($email){
        
        $sql = "select count(a.id) as qtde
                from aluno a
                where lower(a.email) = lower('". $email ."') ";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function verifica_email_editar($email,$id){
        
        $sql = "select count(a.id) as qtde
                from aluno a
                where lower(a.email) = lower('". $email ."')
                and a.id <> ".$id." ";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function verifica_ra_editar($ra,$id){
        
        $sql = "select count(a.id) as qtde
                from aluno a
                where a.ra = '". $ra ."'
                and a.id <> ".$id." ";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function verifica_ra($ra){
        
        $sql = "select count(a.id) as qtde
                from aluno a
                where a.ra = '". $ra ."' ";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function verifica_cpf($cpf){
        
        $cpf = soNumero($cpf);
        
        $sql = "select count(a.id) as qtde
                from aluno a
                where a.cpf = '". $cpf ."' ";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function verifica_cpf_editar($cpf,$id){
        
        $cpf = soNumero($cpf);
        
        $sql = "select count(a.id) as qtde
                from aluno a
                where a.ra = ". $cpf ."
                and a.id <> ".$id." ";
        
        $result = $this->sql($sql)->row();
        
        return $result->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function salvar_aluno($dados){
        
        try {
            
            $this->start_transaction();
            
            $this->load->helper('string');
        
            $senha = random_string('numeric', 10);
        
            
            $aluno   = array('ra'               => $dados['ra'],
                             'nome'             => $dados['nome'],
                             'email'            => $dados['email'],
                             'rg'               => soNumero($dados['rg']),
                             'id_estagio'       => $dados['estagio'],
                             'senha_temporaria' => $senha,
                             'id_empresa'       => $dados['empresa'],
                             'dt_nascimento'    => inverteData($dados['nascimento']),
                             'sexo'             => $dados['sexo'],
                             'cpf'              => soNumero($dados['cpf']),
                             'telefone'         => empty($dados['telefone'])?NULL:soNumero($dados['telefone']),
                             'celular'          => soNumero($dados['celular']),
                             'id_curso'         => $this->id_curso(),
                             'id_periodo_curso' => $this->id_periodo());
                
            $this->insert('aluno', $aluno);
            
            $id_aluno = $this->last_id();
            
            $info    = array('id_aluno'      => $id_aluno,
                             'rua'           => $dados['rua'],
                             'bairro'        => $dados['bairro'],
                             'numero'        => $dados['numero'],
                             'complemento'   => empty($dados['complemento'])?NULL:$dados['complemento'],
                             'cep'           => soNumero($dados['cep']),
                             'cidade'        => $dados['cidade'],
                             'uf'            => $dados['uf']);
            
            $this->insert('endereco_aluno', $info);
            
            switch($dados['estagio']):
                
                case "1":   $info = array('id_aluno'                        => $id_aluno,
                                          'convenio_concessao_estagio'      => 0,
                                          'termo_compromisso_estagio'       => 0,
                                          'plano_ativ_estagio'              => 0,
                                          'apolice_seguro'                  => 0,
                                          'relatorio_final_simplificado'    => 0,
                                          'relatorio_supervisao_estagio'    => 0,
                                          'modelo_relatorio_final'          => 0,
                                          'avaliacao_desempenho_estagio'    => 0);
        
                            $this->insert('documento_curricular', $info);
                    
                            break;
                        
                case "2":   $info = array('id_aluno'                => $id_aluno,
                                          'processo_equivalencia'   => 0,
                                          'plano_ativ_equivalencia' => 0,
                                          'relatorio_final'         => 0);

                            $this->insert('documento_equivalencia', $info);
                            
                            break;
                
            endswitch;
        
            $this->commit();
            
            return array('result'=>true, 'senha' => $senha);

        }catch (Exception $ex) {
         
            $this->rollback();
            
            return array('result'=>false);
            
        }
        
    }
    
    public function editar_aluno($dados,$id){
        
        try {
            
            $this->start_transaction();
            
            $aluno   = array('ra'               => $dados['ra'],
                             'nome'             => $dados['nome'],
                             'email'            => $dados['email'],
                             'rg'               => soNumero($dados['rg']),
                             'id_estagio'       => $dados['estagio'],
                             'id_empresa'       => $dados['empresa'],
                             'dt_nascimento'    => inverteData($dados['nascimento']),
                             'sexo'             => $dados['sexo'],
                             'cpf'              => soNumero($dados['cpf']),
                             'telefone'         => empty($dados['telefone'])?NULL:soNumero($dados['telefone']),
                             'celular'          => soNumero($dados['celular']),
                             'id_curso'         => $this->id_curso(),
                             'id_periodo_curso' => $this->id_periodo());
                
            $this->update('aluno', $aluno, array('id'=>$id));
            
            $info    = array('rua'           => $dados['rua'],
                             'bairro'        => $dados['bairro'],
                             'numero'        => $dados['numero'],
                             'complemento'   => empty($dados['complemento'])?NULL:$dados['complemento'],
                             'cep'           => soNumero($dados['cep']),
                             'cidade'        => $dados['cidade'],
                             'uf'            => $dados['uf']);
            
            $this->update('endereco_aluno', $info, array('id_aluno'=>$id));
        
            $this->commit();
            
            return true;

        }catch (Exception $ex) {
         
            $this->rollback();
            
            return false;
            
        }
        
    }
    
    public function listar_alunos($offset=0,$filtro){
        
        $sql = "select 
                a.*, 
                b.id as tipo_estagio,
                b.titulo as estagio,
                c.nome as empresa,
                c.cnpj,
                a.ra,
                a.cpf,
                a.rg
                from aluno a
                inner join estagio b on
                b.id = a.id_estagio 
                inner join empresa c on
                c.id = a.id_empresa
                where 
                a.id_curso = ".$this->id_curso()."
                and a.id_periodo_curso = ".$this->id_periodo()." 
                ".($filtro['estagio']==0?'':'and a.id_estagio = '.$filtro['estagio'])." 
                ".($filtro['status']==0?'and a.status = 0 ':'and a.status = 1 ')." 
                ".(!empty($filtro['ra'])?'and a.ra = '.$filtro['ra']:"")."    
                ".(!empty($filtro['email'])?'and lower(a.email) = lower("'.$filtro['email'].'")':"")."    
                ".(!empty($filtro['nome'])?'and lower(a.nome) like "%'.strtolower($filtro['nome']).'%"':"")."    
                order by a.nome";
        
        config_pagination($this, $sql, $offset);
        return $this->sql($sql . ' LIMIT ' . $this->ajax_pagination->per_page . ' OFFSET ' . $this->ajax_pagination->cur_page)->result();
        
    }
    
    public function dados_aluno($id){
        
        return $this->sql("select a.*, b.*
                           from aluno a
                           inner join endereco_aluno b on
                           b.id_aluno = a.id
                           where a.id = ? ",$id)->row();
        
    }
    
    public function verifica_documento($id,$tipo){
        
        switch($tipo):
            
            case "1":   $sql = $this->sql("select count(a.id_aluno) as qtde
                                           from documento_equivalencia a
                                           where a.id_aluno = ? ",$id)->row();
                
                        if(!empty($sql)):
                            
                            $this->delete('documento_equivalencia', array('id_aluno'=>$id));
                            
                            $info = array('id_aluno'                        => $id,
                                          'convenio_concessao_estagio'      => 0,
                                          'termo_compromisso_estagio'       => 0,
                                          'plano_ativ_estagio'              => 0,
                                          'apolice_seguro'                  => 0,
                                          'relatorio_final_simplificado'    => 0,
                                          'relatorio_supervisao_estagio'    => 0,
                                          'modelo_relatorio_final'          => 0,
                                          'avaliacao_desempenho_estagio'    => 0);
        
                            $this->insert('documento_curricular', $info);
                        
                            return true;
                        
                        endif;
                
                            return true;
                        
                        break;

            case "2":   $sql = $this->sql("select count(a.id_aluno) as qtde
                                           from documento_curricular a
                                           where a.id_aluno = ? ",$id)->row();
                
                        if(!empty($sql)):
                            
                            $this->delete('documento_curricular', array('id_aluno'=>$id));
                            
                            $info = array('id_aluno'                => $id,
                                          'processo_equivalencia'   => 0,
                                          'plano_ativ_equivalencia' => 0,
                                          'relatorio_final'         => 0);

                            $this->insert('documento_equivalencia', $info);
                        
                            return true;
                        
                        endif;
                        
                            return true;
                            
                        break;
            
            
        endswitch;
        
    }
    
    public function verifica_valor_equivalencia($id){
        
        $sql = "select count(a.id_aluno) as qtde
                from documento_equivalencia a
                where a.id_aluno = ".$id."";
        
        $return = $this->sql($sql)->row();
        
        return $return->qtde > 0 ? TRUE:FALSE;
        
    }
    public function verifica_valor_curricular($id){
        
        $sql = "select count(a.id_aluno) as qtde
                from documento_curricular a
                where a.id_aluno = ".$id."";
        
        $return = $this->sql($sql)->row();
        
        return $return->qtde > 0 ? TRUE:FALSE;
        
    }
    
    public function salvar_documento_equivalencia($id, $dados){
        
        $info = array('id_aluno'                => $id,
                      'processo_equivalencia'   => $dados['e1'],
                      'plano_ativ_equivalencia' => $dados['e2'],
                      'relatorio_final'         => $dados['e3']);
        
        $x  = $this->insert('documento_equivalencia', $info);
        
        if($x){
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public function salvar_documento_curricular($id, $dados){
        
        $info = array('id_aluno'                        => $id,
                      'convenio_concessao_estagio'      => $dados['i1'],
                      'termo_compromisso_estagio'       => $dados['i2'],
                      'plano_ativ_estagio'              => $dados['i3'],
                      'apolice_seguro'                  => $dados['i4'],
                      'relatorio_final_simplificado'    => $dados['f1'],
                      'relatorio_supervisao_estagio'    => $dados['f2'],
                      'modelo_relatorio_final'          => $dados['f3'],
                      'avaliacao_desempenho_estagio'    => $dados['f4']);
        
        $x  = $this->insert('documento_curricular', $info);
        
        if($x){
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public function editar_documento_curricular($id, $dados){
        
        $info = array('convenio_concessao_estagio'      => $dados['i1'],
                      'termo_compromisso_estagio'       => $dados['i2'],
                      'plano_ativ_estagio'              => $dados['i3'],
                      'apolice_seguro'                  => $dados['i4'],
                      'relatorio_final_simplificado'    => $dados['f1'],
                      'relatorio_supervisao_estagio'    => $dados['f2'],
                      'modelo_relatorio_final'          => $dados['f3'],
                      'avaliacao_desempenho_estagio'    => $dados['f4']);
        
        $x  = $this->update('documento_curricular', $info, array('id_aluno'=>$id));
        
        if($x){
            
            return true;
            
        }else{
            
            return false;
            
        }
        
    }
    
    public function editar_documento_equivalencia($id, $dados){
        
        $info = array('processo_equivalencia'   => $dados['e1'],
                      'plano_ativ_equivalencia' => $dados['e2'],
                      'relatorio_final'         => $dados['e3']);
        
        $x  = $this->update('documento_equivalencia', $info, array('id_aluno'=>$id));
        
        if($x){
            
            return array('result'=>true);
            
        }else{
            
            return array('result'=>false);

            
        }
        
    }

    public function listar_equivalencia($id){
        
        return $this->sql("select a.*
                           from documento_equivalencia a
                           where a.id_aluno = ? ",$id)->row();
        
    }
    
    public function listar_curricular($id){
        
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
    
    public function gera_arquivo($filtro){
        
        $sql = "select 
                a.*, 
                b.id as tipo_estagio,
                b.titulo as estagio,
                c.nome as empresa,
                c.cnpj,
                a.ra,
                a.cpf,
                a.rg
                from aluno a
                inner join estagio b on
                b.id = a.id_estagio 
                inner join empresa c on
                c.id = a.id_empresa
                where 
                a.id_curso = ".$this->id_curso()."
                and a.id_periodo_curso = ".$this->id_periodo()." 
                ".($filtro['estagio']==0?'':'and a.id_estagio = '.$filtro['estagio'])." 
                ".($filtro['status']==0?'and a.status = 0 ':'and a.status = 1 ')." 
                ".(!empty($filtro['ra'])?'and a.ra = '.$filtro['ra']:"")."    
                ".(!empty($filtro['email'])?'and lower(a.email) = lower("'.$filtro['email'].'")':"")."    
                ".(!empty($filtro['nome'])?'and lower(a.nome) like "%'.strtolower($filtro['nome']).'%"':"")."    
                order by a.nome";
        
        return $this->sql($sql)->result();
        
    }
    
    public function busca_aluno($busca){
        
        $sql = "select a.* from aluno a where lower(a.email) = lower('".$busca."') and a.id_curso = ".$this->id_curso()." and a.id_periodo_curso = ".$this->id_periodo()." ";
        $sql = $this->sql($sql)->result();
        
        if(empty($sql)){
         
            $sql = "select a.* from aluno a where a.ra = '".$busca."' and a.id_curso = ".$this->id_curso()." and a.id_periodo_curso = ".$this->id_periodo()." ";
            $sql = $this->sql($sql)->result();
         
            if(empty($sql)){
                
                $sql = "select a.* from aluno a where lower(a.nome) like '%".strtolower($busca)."%' and a.id_curso = ".$this->id_curso()." and a.id_periodo_curso = ".$this->id_periodo()." ";
                $sql = $this->sql($sql)->result();
                
            }
            
        }
        
        return $sql;
        
    }
    
    public function tipo_estagio($id){
        
        return $this->sql("select a.id_estagio as estagio
                           from aluno a
                           where a.id = ? ",$id)->row();
        
    }
    
    public function dados($id){
        
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
                           where a.id = ? ",  $id)->row();
        
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
    
    public function ativar($id){
        
        $dados = array('status' => 1);
        
        $x = $this->update('aluno', $dados, array('id'=>$id));
        
        if($x){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function inativar($id){
        
        $dados = array('status' => 0);
        
        $x = $this->update('aluno', $dados, array('id'=>$id));
        
        if($x){
            return true;
        }else{
            return false;
        }
        
    }
    
    public function dados_email(){
        
        return $this->sql("select 
                           a.email,
                           a.nome
                           from aluno a
                           where a.id_curso = ? and
                           a.id_periodo_curso = ? ",array($this->id_curso(),
                                                         $this->id_periodo()))->result();
        
    }
    
}

