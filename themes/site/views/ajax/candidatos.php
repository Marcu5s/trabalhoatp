<?php
$mongoDb = new Mongo();

$db = $mongoDb->selectDB('trabalhoatp')->votacao;

$_POST['CODIGO_CARGO'] = (int) $_POST['CODIGO_CARGO'];

$res  = $db->find($_POST);

$path = 'http://localhost/trabalhoatp/themes/site/assets/images/avatar.png';
 
foreach($res as $candidato){
    
   echo "<div class=\"media\">
         <a href=\"#\" class=\"media-left\">
         <img  src=\"$path\" style=\"width: 64px; height: 64px;\" >
         </a>
         <div class=\"media-body\">
         <h4 class=\"media-heading\">{$candidato['NOME_CANDIDATO']}</h4>
             
            <ul class=\"list-group\">
                <li class=\"list-group-item\">NÚMERO: {$candidato['NUMERO_CANDIDATO']}</li>
               <li class=\"list-group-item\">PARTIDO: {$candidato['SIGLA_PARTIDO']}</li>
             </ul>
            <button type=\"button\" onclick=\"Doubt('{$candidato['_id']}','{$_POST['SIGLA_UF']}')\"   id=\"doubt_{$candidato['_id']}\"   class=\"btn btn-primary\">DÚVIDA</button>
            <button type=\"button\" onclick=\"Deny('{$candidato['_id']}','{$_POST['SIGLA_UF']}')\"    id=\"deny_{$candidato['_id']}\"    class=\"btn btn-danger\">NEGAR</button>
            <button type=\"button\" onclick=\"Confirm('{$candidato['_id']}','{$_POST['SIGLA_UF']}')\" id=\"confirm_{$candidato['_id']}\" class=\"btn btn-success\">CONFIMAR</button>
         </div>
    </div>";    
}