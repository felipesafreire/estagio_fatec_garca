<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_coordenador 
    {

    private $CI = null;
    function __construct($params = array()) {       
    }
    
    public function enviar_email($texto){

        return  $mensagem =  '<table width="550" border="0" align="center">
                    <tr>
                       <td style="">
                         <a href="http://www.sysemp.com.br" title="Sysemp - Tecnologia em Sistemas">
                           <img src="'.  base_url('assets/img/logo.png').'" border="0" />
                         </a>
                       </td>
                    </tr>

                    <tr>
                       <td style="font-family:Verdana, Geneva, sans-serif;font-size:12px;padding-bottom:30px;color:#0e4a5c;padding-top:20px">
                          ' . $texto . ' 
                       </td>
                    </tr>

                    <tr>
                       <td colspan="2" style="font-family:Verdana, Geneva, sans-serif;padding-bottom:10px;border-top:1px dotted #0e4a5c;font-size:9px;color:#0e4a5c;" align="center">

                            <a title="http://www.sysemp.com.br" style="color:#0e4a5c;text-decoration:none;font-size:12px;font-weight:bold" href="http://www.sysemp.com.br">SysEmp - Tecnologia em Sistemas</a><br>
                            

                        </td>
                    </tr>
                </table>';
        
    }
    
}