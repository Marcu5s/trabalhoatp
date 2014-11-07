<?php
 Class Atp{
 
		public static function  db(){
	     $dsn = 'mysql:host=localhost;dbname=candidatos';
			 try{

			 $con = new PDO($dsn,'root','vertrigo');
		     
		     return $con;
			 
			 }catch(PDOExeption $e){
			 
				echo $e->getMessage();
			    
			 } 
	}
 }