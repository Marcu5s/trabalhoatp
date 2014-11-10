<?php
/**
 * @copyright (c) 
 * @author Marcus Antonio  <marcusx.p@hotmail.com>
 * @access public
 */
class SiteController{
      
    
    public $uf = '';
    
    /**
     * 
     */
    public static function import(){
        
        $import = array('header','menu','slide','content','footer');      
        
        if(filter_input(INPUT_GET, 'pg')){
            unset($import[2]);
            $import[3] = filter_input(INPUT_GET, 'pg');            
        }
        
           
        
        return   $import;       
    }
    
    /**
     * 
    */
    
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
    
    /**
    * 
    */
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
    
    /**
     * 
     */
    
    public static function getString($column){
        
        switch ($column){
            
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
        
        $tables = array('deny'=>"Rejeitado",'dout'=>"Dúvida",'confirm'=>"Confirmado",);
        
        $string = '';
        
        foreach($tables as $column => $name){
           
           $value = self::totalCharts($column);
            
           $string .= "['{$name}',{$value}],";
            
        }        
        return "[$string]";
    }
    
    /**
    * 
    */
    
    public function Aggregate($uf,$name){
        
        $mongoDb = new Mongo();
        $voting = $mongoDb->selectDB('trabalhoatp')->voting;
                     
        $aggregate = array(
            array(
                '$match'=>array('SIGLA_UF'=>$uf),
                ),
            array(
                '$group'=>array(
                    '_id'=>null,
                    $name => array('$sum'=>  self::getString($name)),      
                    
               ),      
            )         
       );    
       
       $count =  $voting->find(array('SIGLA_UF'=>$uf))->count();
        
       if($count){    
        
       $result = $voting->aggregate($aggregate);
       
       unset($result['result'][0]['_id']);       
       return $result['result'][0];
       
       }else{
           
           return false;
           
       } 
           
        
    } 

    public function xAxis(){
        $mongoDb = new Mongo();
        
        $candidato = $mongoDb->selectDB('trabalhoatp')->candidato;
        $distinct = $candidato->distinct('SIGLA_UF');        
        $name = '';
        
        foreach($distinct as $nameUF){
           
            $name .= "'$nameUF',";
           
        }        
        return $name;
    }
    
    public function Data($column){
        
        $mongoDb = new Mongo();
        $candidato = $mongoDb->selectDB('trabalhoatp')->candidato;
        $distinct = $candidato->distinct('SIGLA_UF');  
        
        $data = '';
        
        foreach($distinct as $nameUF){
           
        $result = $this->Aggregate($nameUF,$column);
        
        $result =  (int) $result[$column];
        
        if(!$result)
           $result = (int) 0;
        
            $data .= "$result,";
                
        }
        return "[$data]";
        
    }

        /**
     * 
     */       
    public  function Series(){
           
        $votingCoulun = array('deny'=>'Dúvida','dout'=>'Rejeitado','confirm'=>'Confirmado');
                 
        foreach ($votingCoulun as $column => $nameChart) {
              
        $data .= "{name:'$nameChart',data:{$this->Data($column)}},";
                
        }                   
        
        return $data;
           
    } 
    
}