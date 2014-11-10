<?php
/**
 * @copyright (c) 
 * @author Marcus Antonio  <marcusx.p@hotmail.com>
 * @access public
 */

class Controller{
    
    public function __construct() {
      
         if(THEME){
         $class = THEME.'Controller';   
                 
         $pathTheme = WWW_ROOT.'/themes/'.strtolower(THEME).'/views/imports/';            
          
         require_once WWW_ROOT.'/protected/controllers/'.$class.'.php';            
          
         $array = (array)  $class::import();
          
         $i=0;
         
         
         foreach($array as $key => $page){
              
               $path = $pathTheme.$page.'.php';
              
              if(file_exists($path)){
                 include $path;
                  
              }
           }          
        }      
        
    }    
    /**
     * @static
     * @public
     * 
     * @return string Path para inclusão dos arquivos css,js,images,etc
     * 
     */
    public static function Assets(){
     
        return  SERVER_NAME.'assets/';
        
    }
    
}