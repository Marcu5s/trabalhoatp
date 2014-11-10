<?php
$mongoDb = new Mongo();

$db = $mongoDb->selectDB('trabalhoatp')->candidato;

$json = array(); 

$select = array('CODIGO_CARGO'=>(int)$_POST['_id'],'SIGLA_UF'=>$_POST['uf']);
 
$res  = $db->find($select);

foreach($res as $candidato){
    
  $json['NOME_CANDIDATO'][] = "<option value=\"{$candidato['_id']}\" >{$candidato['NOME_CANDIDATO']}</option>";    
   
} 
array_unshift($json['NOME_CANDIDATO'],"<option>Selecione um candidato</option>" );

echo json_encode($json);