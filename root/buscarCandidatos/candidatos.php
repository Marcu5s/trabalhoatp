<?php
  
   if(!file_exists('../../SGBD.php')) die('Conex�o n�o encontrada');
    
    require_once '../../SGBD.php' ;
 
    $dados = $_POST['dados'];
	
    //cand_nome_canditato
    $SQL = "SELECT *  FROM `cantidatos` GROUP BY cand_sigla_uf WHERE cand_nome_canditato LIKE '%$dados%'";	
     
    $obj =  Atp::db()->prepare($SQL);
	 
	 if(!$obj->execute()) die('Erro para excutar!');
	 
      header('Content-type:application/Json');
	  $json = array();
	 if($ojb->rowCount() == 0){
			$json['erro'] = 'Candidato n�o encontrado!';
	 }	 
     while($res = $obj->fetch(PDO::FETCH_OBJ)){
	    $json['success'][] = $res->cand_nome_canditato;
	 }
	 echo json_encode($json);
	
 ?>