<?php
define('path_http','http://'.$_SERVER['SERVER_NAME'].'/trabalhoatp/root/');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<link href="<?php echo path_http  ?>css/bootstrap.css" rel="stylesheet">
	<script src="<?php echo path_http ?>js/jquery.js"></script>
		<meta charset="utf-8">
		
		<?php 
		$ver = "#009900";
		$lar = "#CC5200";
		?>
	</head>
	<title>Candidatos</title>
	<body>
		<nav class="navbar navbar-default" role="navigation">
		  <div class="container-fluid">
			<div class="navbar-header">
					<a class="navbar-brand" href="#">Candidatos 2014</a>
			</div>
			<div class="collapse navbar-collapse  navbar-right" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
				<li>
			
				<a 	data-toggle="modal" data-target="#myModal"><strong>Entrar</strong></a></li>
				</button>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Minas Gerais <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu"><!--//LISTA DE ESTADOS-->
						<li><a href="#">Lista de Estados</a></li>
					</ul>
				</li>
				</ul>
		  </div>
		</nav>
		<!--Corpo do site -->
		<div class="container">
			<div class="row">
				<div class="col-md-10">
				<div class="panel panel-default">
				 <ul class="nav nav-tabs" role="tablist">
					 <?php
					 /**
					 * Variável de referncia da url
					 */
					 $path  = path_http; 
					/**
					* @descricao contendo os valores dos menus
					  @type array
					*/
                                       function Active($url,$ke){  
                                           
                                        $active = '';
                                       
                                        if(empty($url))
                                            return 'active';     
                                        
                                        if($url=='gov' && $ke == 'gov'){
                                            $active = 'active';
                                        }
                                        if($url=='depfed' && $ke == 'depfed'){
                                            $active = 'active';
                                        }
                                        if($url=='depest' && $ke == 'depest'){
                                            $active = 'active';
                                        }
                                        if($url=='presidente' && $ke == 'presidente'){
                                            $active = 'active';
                                        }
                                       
                                        return $active;    
                                       
                                       }  
				       $menus = array(	
				
					"<li class=\"".  Active($_GET['page'],'presidente')."\"><a href=\"{$path}?page=presidente\" >Presidente da República</a></li>",
					"<li class=\"".  Active($_GET['page'],'gov')."\"><a href=\"{$path}?page=gov\">Governador</a></li>",
					"<li class=\"".  Active($_GET['page'],'depfed')."\"><a href=\"{$path}?page=depfed\">Deputado Federal</a></li>",
					"<li class=\"".  Active($_GET['page'],'depest')."\"><a href=\"{$path}?page=depest\">Deputado Estadual</a></li>"
					
					);
					echo $menus[0].$menus[1].$menus[2].$menus[3];		 		
			   ?>
				</ul>
					<div class="panel-body">
						<img src="images/pizza.gif" height=200 width=250/>
					</div>
					<div class="panel-footer">Mais informações</div>
				</div>
				</div>
			</div>
		</div>
		<!--Fim Corpo do site -->
		<div class="container">
			<div class="row">
			<form action="#" method = "post">
				<div class="col-md-10">
					<div class="input-group">

					  <div class="input-group-addon">
						<span class="glyphicon glyphicon-user"></span>
					  </div>
					  
						<input class="form-control" id='dados' type="text" placeholder="Digite o nome ou numero de eleição do candidato">
					 	
					</div>					
				</div>
				<div class="col-md-2">
					<button type="submit" class="btn btn-default" ><span class="glyphicon glyphicon-search"></span> Buscar</button>
				</div>
			</form>
			</div>
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel"> <font color="black">Entrar</font></h4>
				  </div>
				  <div class="modal-body">
					<font color="black">Atenção nenhuma informação sobre você será armazenada ou divulgada,você deve logar apenas para autenticarmos os votos.</font>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-primary">Entrar com o Facebook</button>
				  </div>
				</div>
			  </div>
			</div>
		</div>		
		<script>
		$(document).ready(function(){
		      $('.btn-default').click(function(e){
			     e.preventDefault(); 
				var dados = $('#dados').val();
			
				$.post('buscarCandidatos/candidatos.php',{dados:dados},function(data){
				       console.log(data);
				},'Json');
			
			  });
		});
		</script>
	</body>
</html>