<?php
	Class Conexao{
 
		protected static function  pdo(){
	     $dsn = 'mysql:host=localhost;dbname=candidatos';
			 try{
			 
			 $con = new PDO($dsn,'root','vertrigo');
		     
		     return $con;
			 
			 }catch(PDOExeption $e){
			 
				echo $e->getMessage();
			    
			 } 
	}
 }
  /*
   @return array()
  */
   
 class Teste extends Conexao{ 
  
 
   public function grafico(){
                    
					
		$SQL = "SELECT `cand_nome_urna_candidato` as nomecand, `cand_sigla_uf` as uf
		FROM `cantidatos`
		GROUP BY cand_sigla_uf";

		  $obj = parent::pdo()->prepare($SQL);
		  if($obj)
		   $obj->execute();
		   else
		   echo die('Erro de sql');
		   
		  $str='';
		      
		  while($linha =  $obj->fetch(PDO::FETCH_OBJ)){
		                        
			if(!empty($linha->uf)){
			    $obj2 =  parent::pdo()->prepare("SELECT count(cand_sigla_uf) as valor FROM `cantidatos` WHERE cand_sigla_uf='".$linha->uf."'");
				$obj2->execute();
				$cont = $obj2->fetch(PDO::FETCH_OBJ);				
				$str  .= "['".$linha->uf."',".(int)$cont->valor."],";  
				
			 }
		   }
	       return substr($str,0,-1);
   }

  }
  $t =  new	Teste(); 
   
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: 1,//null,
            plotShadow: false
        },
        title: {
            text: 'Percentual de candidatos, 2014'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b> {point.y}qt</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>:{point.y}qt',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Browser share',
            data: [ <?php echo $t->grafico() ?>]
        }]
    });
});

	</script>
	</head>
	<body>
<script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>
<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>