<?php
$mongoDb = new Mongo();

$db = $mongoDb->selectDB('trabalhoatp')->candidato;

 
$_POST['CODIGO_CARGO'] = (int) $_POST['CODIGO_CARGO'];
 
$json = array();$html = array();

$res  = $db->find($_POST);

$path = 'http://localhost/trabalhoatp/themes/site/assets/images/avatar.png';

$i=0;

foreach($res as $candidato){
    
   $html[$i] = "<div class=\"media\">
         <a href=\"#\" class=\"media-left\">
         <img  src=\"$path\" style=\"width: 64px; height: 64px;\" >
         </a>
         <div class=\"media-body\">
         <h4 class=\"media-heading\">{$candidato['NOME_CANDIDATO']}</h4>
             
            <ul class=\"list-group\">
                <li class=\"list-group-item\" style=\"margin-left: 4px; width: 440px;\" >NÚMERO: {$candidato['NUMERO_CANDIDATO']}</li>
                <li class=\"list-group-item\" style=\"margin-left: 4px; width: 440px;\" >PARTIDO: {$candidato['SIGLA_PARTIDO']}</li>
             </ul>
            <div style=\"margin-left:4px\" class=\"row\">
            <button type=\"button\" onclick=\"Doubt('{$candidato['_id']}','{$_POST['SIGLA_UF']}')\"   id=\"doubt_{$candidato['_id']}\"   class=\"btn btn-primary\">DÚVIDA</button>
            <button type=\"button\" onclick=\"Deny('{$candidato['_id']}','{$_POST['SIGLA_UF']}')\"    id=\"deny_{$candidato['_id']}\"    class=\"btn btn-danger\">REJEITAR</button>
            <button type=\"button\" onclick=\"Confirm('{$candidato['_id']}','{$_POST['SIGLA_UF']}')\" id=\"confirm_{$candidato['_id']}\" class=\"btn btn-success\">CONFIMAR</button>
            <button type=\"button\" onclick=\"Message('{$candidato['_id']}')\" data-toggle=\"modal\" data-target=\".bs-example-modal-lg\" id=\"confirm_{$candidato['_id']}\" class=\"btn btn-warning myModal\">ENVIAR MENSAGEM</button>
            </div>
           </div>
    </div>";    
    ++$i;
}

$json['HTML'] = $html;
$json['count'] = $i;

echo json_encode($json);