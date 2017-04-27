<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf{
   
    public function __construct() {    

    }
    
    public function load($params=null){
        
        if($params==NULL){
            $param = '"en-GB-x","A4","","",10,10,10,10,6,3'; 
        }else{
            $param = $params; 
        }
        
        include_once 'mpdf/mpdf.php';
        
                
        return new mPDF($param);
        
        
    }
    
}