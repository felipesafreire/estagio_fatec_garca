<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('removerAcento')){
    
    function removerAcento($string){
        
        return preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
        
    }
    
}

if ( ! function_exists('soNumero')){
    
    function soNumero($str) {
        
        return preg_replace("/[^0-9]/", "", $str);
        
    }
    
}

if ( ! function_exists('validaCNPJ')){
    
    function validaCNPJ($cnpj){
        
        $j=0;
        
        for($i=0; $i<(strlen($cnpj)); $i++){
            
            if(is_numeric($cnpj[$i])){
                $num[$j]=$cnpj[$i];
                $j++;
            }
            
        }
        
        if(count($num)!=14){
            $isCnpjValid=false;
        }
        
        if ($num[0]==0 && $num[1]==0 && $num[2]==0 && $num[3]==0 && $num[4]==0 && $num[5]==0 && $num[6]==0 && $num[7]==0 && $num[8]==0 && $num[9]==0 && $num[10]==0 && $num[11]==0){
            $isCnpjValid=false;
        }
        
        else{
            
            $j=5;
            
            for($i=0; $i<4; $i++){
                
                $multiplica[$i]=$num[$i]*$j;
                $j--;
                
            }
            
            $soma = array_sum($multiplica);
            $j=9;
            
            for($i=4; $i<12; $i++){
                
                $multiplica[$i]=$num[$i]*$j;
                 $j--;
                 
            }
            
            $soma = array_sum($multiplica);	
            $resto = $soma%11;			
            
            if($resto<2){
                
                $dg=0;          
                
            }else{
                
                $dg=11-$resto;
            }
            
            if($dg!=$num[12]){
                
                $isCnpjValid=false;
            } 
            
        }
        
        if(!isset($isCnpjValid)){
            
            $j=6;
            
            for($i=0; $i<5; $i++){
                
                $multiplica[$i]=$num[$i]*$j;
                $j--;
                
            }
            
            $soma = array_sum($multiplica);
            $j=9;
            
            for($i=5; $i<13; $i++){
                                   
                $multiplica[$i]=$num[$i]*$j;
                $j--;
                
            }
        
            $soma = array_sum($multiplica);	
            $resto = $soma%11;			
            
            if($resto<2){
                        
                $dg=0;
                
            }else{
                
                $dg=11-$resto;
                
            }
            
            if($dg!=$num[13]){
                
                $isCnpjValid=false;
                
            }else{
                
                $isCnpjValid=true;
            }
            
        }

        return $isCnpjValid;	
        
    }
    
}
if ( ! function_exists('validarCep')){
    
    function validarCep($cep){
        
        $cep = soNumero($cep);
     
        $avaliaCep = preg_match("/[0-9]{5,5}([- ]?[0-9]{4})?$/", $cep);

        if(!$avaliaCep){
            
            return false;
            
        }else{
            
            return true;
            
        }
        
    }
    
}

if ( ! function_exists('mask')){
    
    function mask($val, $mask){
        
        $maskared = '';
        $k = 0;

        for($i = 0; $i<=strlen($mask)-1; $i++){

            if($mask[$i] == '#'){

                if(isset($val[$k])){

                    $maskared .= $val[$k++];  

                }

            }else{

                if(isset($mask[$i])){

                    $maskared .= $mask[$i];

                }

            }
        }

        return $maskared;

    }
    
}

if ( ! function_exists('validaCPF')){
    function validaCPF($cpf = null) {

        // Verifica se um número foi informado
        if(empty($cpf)) {
            return false;
        }

        // Elimina possivel mascara
        $cpf = ereg_replace('[^0-9]', '', $cpf);
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Verifica se o numero de digitos informados é igual a 11 
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se nenhuma das sequências invalidas abaixo 
        // foi digitada. Caso afirmativo, retorna falso
        else if ($cpf == '00000000000' || 
            $cpf == '11111111111' || 
            $cpf == '22222222222' || 
            $cpf == '33333333333' || 
            $cpf == '44444444444' || 
            $cpf == '55555555555' || 
            $cpf == '66666666666' || 
            $cpf == '77777777777' || 
            $cpf == '88888888888' || 
            $cpf == '99999999999') {
            return false;
         // Calcula os digitos verificadores para verificar se o
         // CPF é válido
         } else {   

            for ($t = 9; $t < 11; $t++) {

                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf{$c} != $d) {
                    return false;
                }
            }

            return true;
        }
    }
}

if ( ! function_exists('inverteData')){
    function inverteData($data){
        if(count(explode("/",$data)) > 1){
            return implode("-",array_reverse(explode("/",$data)));
        }elseif(count(explode("-",$data)) > 1){
            return implode("/",array_reverse(explode("-",$data)));
        }
    }
}

if ( ! function_exists('config_pagination'))
{
    function config_pagination($class,$sql,$cur_page,$qtde=null,$tabela=null)
    {
        $class->load->library('ajax_pagination');
        //pega o total de linhas da consulta
        $total_rows = $class->sql($sql)->num_rows();

        $config['full_tag_open'] = '<ul class="pagination" style="float:right;margin:0px">'; 
        $config['full_tag_close'] = '</ul></div><!--pagination-->';
        $config['first_link'] = 'Primeira';
        $config['first_tag_open'] = '<li class="prev page">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Última';
        $config['last_tag_open'] = '<li class="next page">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = 'Próxima';
        $config['next_tag_open'] = '<li class="next page">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = 'Anterior';
        $config['prev_tag_open'] = '<li class="prev page">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0)">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';     
        $config['first_url']  = "";
        $config['base_url']   = "";
        $config['total_rows'] = $total_rows;
        $config['div']         = 'tbl';
       // $config['additional_param'] = 'dbop=table';
        $config['per_page']   = empty($qtde)?15:$qtde;
        $config['num_links']  = 5;
        $config['cur_page']   = empty($cur_page)?0:$cur_page;
        $config['show_count'] = true;

        $class->ajax_pagination->initialize($config); 
    }
}

if ( !function_exists('trataString')){
    function trataString($str) {
      return preg_replace('{\W}', ' ', preg_replace('{ +}', ' ', strtr(
        utf8_decode(html_entity_decode($str)),
        utf8_decode('ÀÁÃÂÉÊÍÓÕÔÚÜÇÑàáãâéêíóõôúüçñ'),
        'AAAAEEIOOOUUCNaaaaeeiooouucn')));
    }
}
if ( !function_exists('FormataDataBR')){
    function FormataDataBR($data) {
      return date('d/m/Y H:i:s', strtotime($data));
    }
}
