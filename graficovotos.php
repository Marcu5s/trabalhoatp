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
		  $estados = '';   
		  $valor = '';
		  $data = '';
		  $valores = array();
		  
		  while($linha =  $obj->fetch(PDO::FETCH_OBJ)){
		   $i=0;                      
			if(!empty($linha->uf)){
			     
			    $obj2 =  parent::pdo()->prepare("SELECT count(voto) as valor,voto FROM `votos` WHERE uf='".$linha->uf."'");
				$obj2->execute();
				$cont = $obj2->fetch(PDO::FETCH_OBJ);
             		 
				$valor   .= (int)$cont->valor.',';  
				$estados .= "'".$linha->uf."',";
				 
		    }			   
		 }		 
		        
		   $return = array("[".substr($estados,0,-1)."]","[".substr($valor,0,-1)."]",$data);
		  
	       return $return;
   }
   
   public function valor($voto){
		
	     	    $SQL = "SELECT `cand_nome_urna_candidato` as nomecand, `cand_sigla_uf` as uf
		FROM `cantidatos`
		GROUP BY cand_sigla_uf";

		  $obj = parent::pdo()->prepare($SQL);
		  if($obj)
		   $obj->execute();
		   else
		   echo die('Erro de sql');
		   	  
		   
		  $str='';
		  $estados = '';   
		  $valor = '';
		  $data = '';
		  $valores = array();
		   
		  while($linha =  $obj->fetch(PDO::FETCH_OBJ)){
		   $i=0;                      
			if(!empty($linha->uf)){
			    $data =  "SELECT count(voto) as valor,voto FROM `votos` WHERE uf='".$linha->uf."' AND voto='".$voto."'";
			    $obj2 =  parent::pdo()->prepare($data);
				$obj2->execute();
				$cont = $obj2->fetch(PDO::FETCH_OBJ);
			 
					$valor   .= (int)$cont->valor.',';  			 
		    }			   
			 
		   }
		        
		   $return = "[".substr($valor,0,-1)."]";
		  
	       return $return;
	}
	
	public function valores(){
	  $tipovotos = array('','Verde','Branco','Amarelo');
	  $i=1;
	  $str = '';
	  while($i < 4){
	        $str .= "{name:'".$tipovotos[$i]."',data:".$this->valor($i)."},";
	  ++$i;
	  }	  
	  return $str;  
	}
	

  }
  $t =  new	Teste(); 
  $grafico = (array) $t->grafico();  
    
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts Example</title>

		<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>

		<style type="text/css">
#container {
	height: 400px; 
	min-width: 310px; 
	max-width: 800px;
	margin: 0 auto;
}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
				enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: '3D chart with null values'
        },
        subtitle: {
            text: 'Notice the difference between a 0 value and a null point'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            categories: <?php echo $grafico[0] ?>
        },
        yAxis: {
            opposite: true
        },
        series: [ <?php echo $t->valores()  ?>]
    });
});
		</script>
	</head>
	<body>
<script src="js/highcharts.js"></script>
<script src="js/highcharts-3d.js"></script>
<script src="js/modules/exporting.js"></script>

<div id="container" style="height: 400px"></div>
	</body>
</html>
