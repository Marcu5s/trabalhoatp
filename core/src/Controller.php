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
          
         $count  =  count($class::import());
         $i=0;
         while($i < $count){
              
              $path = $pathTheme.$class::import()[$i].'.php';
              
              if(file_exists($path)){
                 
                  require_once $path;
                  
              }
              
             ++$i;
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