<?php
/**
 * @copyright (c) 
 * @author Marcus Antonio  <marcusx.p@hotmail.com>
 * @access public
 */
class SiteController{
    
    public static function import(){
        
        $import = array('header','menu','slide','content','footer');      
        
        if(self::getimports()){
            unset($import[3]);
            $import[2] = self::getimports();
            
        }
        return   $import;       
    }
    
    public static function getimports(){
        
         if(filter_input(INPUT_GET, 'pg')){
             
             $import = array('voting');
             if(in_array(filter_input(INPUT_GET, 'pg'), $import)) 
                  return filter_input(INPUT_GET, 'pg');
             else
                 return false;
             
         }else{
            return false ;
         }
        
    }
    
    public static function totalCharts($campo){
        $mongoDb = new Mongo();
        
        $db = $mongoDb->selectDB('trabalhoatp')->voting;
          
        $aggregate = $db->aggregate(array('$group'=>array(
            '_id'=>null,
            'total'=> array('$sum'=>self::getString($campo)),
            )
          )
        );
        return (int) $aggregate['result'][0]['total'];             
    }
    public static function getString($campo){
        
        switch ($campo){
            
           case 'confirm' :
                return '$confirm';
           break; 
       
           case 'deny' :
                return '$deny';
           break;          
           case 'dout' :
               return '$dout';
           break;          
        }        
    }
    
    public static function getCharts(){
        
        $tables = array('confirm'=>"Confirmado",'deny'=>"Negar",'dout'=>"Dúvida");
        
        $string = '';
        
        foreach($tables as $column => $name){
           
           $value = self::totalCharts($column);
            
           $string .= "['{$name}',{$value}],";
            
        }        
        return "[$string]";
    }
    
    
    
}