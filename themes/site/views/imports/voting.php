<?php
$mongoDb = new Mongo();

$db = $mongoDb->selectDB('trabalhoatp')->candidato;

/**
 * @descricao Retornando somente as siglas dos estados.
 * 
 */
$distinct = $db->distinct('SIGLA_UF');
?>
<style>
    .media{
        position: relative;
    }
    .media span{
        cursor:pointer;
    }
    .media-heading{
        color: #000;
        left: 72px;
        position: absolute;
        top: 46px;
        width: 360px;

    }
</style>
<!--=======content================================-->
<div class="content">
    <div class="container_12">
        <div class="row">
            <div class="col-xs-6">
                <br/>
                <div class="panel panel-default">
                    <div class="panel-heading">Panel heading without title</div>
                    <div class="panel-body">

                        <span>Seleciona o seu estado</span>
                        <form method="POST" action="" id="FormDados">
                            <select class="form-control" name="SIGLA_UF">
                                <?php
                                foreach ($distinct as $key => $name) {
                                    ?>
                                    <option value="<?php echo $name ?>"><?php echo $name ?></option>   
                                    <?php
                                }
                                ?>
                            </select>   
                            <span>Categoria</span>
                            <select class="form-control" name="CODIGO_CARGO">
                                <option value="7">DEPUTADO(A) ESTADUAL</option>
                                <option value="6">DEPUTADO FEDERAL</option>
                                <option value="5">SENADOR</option>
                                <option value="3">GOVERNADOR</option>
                                <option value="1">PRESIDENTE DA REPÚBLICA</option>
                            </select> 
                            <div class="row">
                                <br/>
                                <div class="col-xs-12 col-md-6"> <button type="button" class="btn btn-danger">VOLTAR</button></div>
                                <div class="col-xs-6 col-md-6"><button type="button" class="btn btn-default">ANULAR</button>
                                <button type="button" id="LISTAR" class="btn btn-success">LISTAR</button></div>
                            </div>
                        </form> 
                    </div>
                </div>



            </div>
            <div class="col-xs-6">
                <br/>
                <div class="panel panel-default">
                    <div class="panel-heading">Panel heading without title</div>
                    <div class="panel-body" id="Candidatos">
                        <div class="media">
                            <a class="media-left" href="#">
                                <img style="width: 64px; height: 64px;" src="http://localhost/trabalhoatp/themes/site/assets/images/avatar.png">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">JOÃO PIMENTA DA VEIGA FILHO</h4>
                                <p>
                             <ul class="list-group">
                                <li class="list-group-item">NÚMERO:</li>
                                <li class="list-group-item">PARTIDO:</li>
                                
                             </ul>
                                </p>
                                <button type="button"class="btn btn-primary">DÚVIDA</button>
                               <button type="button" class="btn btn-danger">NEGAR</button>
                               <button type="button" class="btn btn-success">CONFIMAR</button>
                            </div>
                            
                        </div>
                        <script>
                         var Doubt = function(id,SIGLA_UF){
                            $('#doubt_'+id).addClass('disabled');
                            var key = 'dout';
                            Ajax(id,key,SIGLA_UF);
                         }
                         var Deny = function(id,SIGLA_UF){
                            $('#deny_'+id).addClass('disabled');
                            var key = 'deny';
                            Ajax(id,key,SIGLA_UF);
                         }
                         var Confirm = function(id,SIGLA_UF){
                            $('#confirm_'+id).addClass('disabled');
                            var key = 'confirm';
                            Ajax(id,key,SIGLA_UF);
                         }                        
                         var Ajax = function(id,key,SIGLA_UF){
                            
                              var type = {id:id,key:key,SIGLA_UF:SIGLA_UF};
                              $.post('themes/site/views/ajax/voting.php',type, function (data) {
                              console.log(data);
                        });                             
                             
                         }                         
                        </script>
                     </div>
                </div>
            </div>

        </div>

        <script>

            $(document).ready(function () {
                 $('#LISTAR').click(function () {

                    $.post('themes/site/views/ajax/candidatos.php', $('#FormDados').serialize(), function (data) {
                        $('#Candidatos').html(data);
                    });

                });
            });
        </script>