<?php
$mongoDb = new Mongo();

$db = $mongoDb->selectDB('trabalhoatp')->voting;
$message = $mongoDb->selectDB('trabalhoatp')->message;

$select = array('idcandidato' => $_POST['idcandidato']);

$count = $db->find($select)->count();

$json = array();

if($count){
    
    $findeOne = $db->findOne($select);
    
    $confirm = (int) $findeOne['confirm'];
    $deny    = (int) $findeOne['deny'];
    $dout    = (int) $findeOne['dout'];
    
    $chart = "['Rejeitado',{$deny}],['Dúvida',{$dout}],['Confirmado',{$confirm}]";
    
    $json['chart'] =  "<script>
           $(function () {
    $('.Candidatos').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Estatística de votos.'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.y}</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y}:votos',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Votos',
            data:[$chart]
        }]
    });
});</script>";
    
    $cout = $message->find($select)->count();
    
    if($cout){
        
        $findMessage = $message->find($select);
        
        foreach($findMessage as $key){
                              
            $json['message'][]  = "<p style=\"color:#080808\" class=\"mensagens\">
                                    Nome: {$key['name']} <br/>
                                    Mensagem:<br/>
                                    {$key['message']}.
            </p>";          
        }       
        array_unshift($json['message'],"<strong>Mensagens..</strong>" );
    }
      
    echo json_encode($json);   
    
}else{
    
    echo json_encode(array('Mensagem'=>"<div class=\"alert alert-warning\" role=\"alert\">Candiato nao encotrado! Ou nao possui voto.</div>"));
}