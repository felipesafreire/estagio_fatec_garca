<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function template_email($nome,$destino,$assunto,$mensagem){
        
        $msg =  '<style>
                    @import "https://fonts.googleapis.com/css?family=Lato|Montserrat";
                </style>
                 <table width="550" border="0" align="center">
            
                    <tr >
                       <td style="text-align:center; vertical-align: middle;">
                         <a href="'.  base_url() .'" title="Fatec Garça">
                           <center><img style="max-width:110px;"  src="'.  base_url('assets/img/logo_fatec.png').'" border="0" /></center>
                         </a>
                       </td>
                    </tr>
                    <tr>
                       <td style="font-family:"Montserrat",Verdana, Geneva, sans-serif;font-size:16px;padding-bottom:10px;color:black;padding-top:20px; text-align:justify;">
                        
                        <div style="padding-bottom:10px;border-top:1px dotted black;color:black;"></div>
                       
                            '.$mensagem.'

                       </td>
                    </tr>

                    <tr>
                       <td colspan="2" style="font-family:Verdana, Geneva, sans-serif;padding-bottom:10px;border-top:1px dotted black;font-size:9px;color:black;" align="center">

                            <p style="font-family:Lato; font-size:12px; text-align:center;">Caso persita alguma dúvida, entre em contato conosco.</p>

                            <a title="Fatec Garça" style="font-family:"Lato",Verdana, Geneva, sans-serif;color:black;text-decoration:none;font-size:16px;font-weight:bold;" href="'.  base_url() .'">Departamento de Estágio - Fatec Garça</a><br>
                            

                        </td>
                    </tr>
                </table>';
        
        $origem = $this->email_envio();
        
        $this->load->library('email');
        $this->email->initialize();
        $this->email->set_newline("\r\n");  
        $this->email->from($origem, $nome);
        $this->email->to($destino);
        $this->email->cc($destino);
        $this->email->subject($assunto);
        $this->email->message($msg);
        $x = $this->email->send();
        echo $this->email->print_debugger();
        //echo true;
        
    }
    
    public function email_envio(){
        
        $origem = "estagio.garca@fatec.sp.gov.br";
        
        return $origem;
        
    }
   
    
    
}