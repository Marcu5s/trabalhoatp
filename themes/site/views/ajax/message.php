<?php
$mongoDb = new Mongo();

$db = $mongoDb->selectDB('trabalhoatp')->message;

$json = array();

if(empty($_POST['name'])){
   
    $json['message'] = "Campo nome é obrigatório!";
    $json['class']   = "btn-danger";
    echo json_encode ($json);
    exit;
    
}
if(empty($_POST['message'])){
    
    $json['message'] = "Campo mensagem é obrigatório!";
    $json['class']   = "btn-danger";
    echo json_encode ($json);
    exit;
}
 
$_POST['date'] = new MongoDate();

$insert = $db->insert($_POST);

if($insert){
    $json['message'] = "Mensagem cadastrada com sucesso!";
    $json['class']   = "btn-success";
   echo json_encode ($json);
    exit;
    
}
     