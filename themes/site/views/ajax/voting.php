<?php
$mongoDb = new Mongo();

$db = $mongoDb->selectDB('trabalhoatp')->voting;

$select = array('idcandidato' => $_POST['id']);

$count = $db->find($select)->count();

if ($count) {
    $find = $db->findOne($select);

    $id = new MongoId($find['_id']);

    if ($find[$_POST['key']]) {

        /**
         * Aumentando o numero de votos 
         */
        $count = $find[$_POST['key']] + 1;

        $update = $db->update(array('_id' => $id), array('$set' => array($_POST['key'] => (int) $count)));

        var_dump($update);
    } else {

        $update = $db->update(array('_id' => $id), array('$set' => array($_POST['key'] => (int)1)));

        var_dump($update);
    }
} else {

    $insert = array('idcandidato' => $_POST['id'], $_POST['key'] => (int) 1,'SIGLA_UF'=>$_POST['SIGLA_UF']);

    $res = $db->insert($insert);

    var_dump($res);
}