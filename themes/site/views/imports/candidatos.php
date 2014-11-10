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
    .mensagens{
        border-bottom: 2px solid #ebebeb;
    }
</style>
<!--=======content================================-->
<div class="content">
    <div class="container_12">
        <div class="row">
            <div class="col-xs-6">
                <br/>
                <div class="panel panel-default">
                    <div class="panel-heading">Escolha o estado e a categoria</div>
                    <div class="panel-body">

                        <span>Seleciona o seu estado</span>
                        <form method="POST" action="" id="FormDados">
                            <select class="form-control" id="SIGLA_UF" name="SIGLA_UF">
                                <option selected="">Escolha um estado</option>
                                <?php
                                foreach ($distinct as $key => $name) {
                                    ?>
                                    <option value="<?php echo $name ?>"><?php echo $name ?></option>   
                                    <?php
                                }
                                ?>
                            </select> 
                            
                            <span>Categoria</span>
                            <select class="form-control" id="CODIGO_CARGO" name="CODIGO_CARGO">
                                 
                                <option selected="">Seleciona uma categoria</option>
                                <option value="7">DEPUTADO(A) ESTADUAL</option>
                                <option value="6">DEPUTADO FEDERAL</option>
                                <option value="5">SENADOR</option>
                                <option value="3">GOVERNADOR</option>
                                <option value="1">PRESIDENTE DA REPÚBLICA</option>
                         
                            </select>
                            
                            <span>Candidatos</span>
                            <select class="form-control Search" id="NOME_CANDIDATO" name="idcandidato">
                                 
                            </select> 
                             
                            <div class="row">
                                <br/>
                                <div class="col-xs-12 col-md-6"><a href="<?php echo PATH_HTTP ?>"> <button type="button" class="btn btn-danger">VOLTAR</button></a></div>
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
                    <div class="panel-heading">Lista de candidatos <span style="display:none; margin-left: 281px;" class="alert alert-success quant"></span></div>
                    <div class="panel-body" >
                     
                        <div class="row"  >
                            <div id="Candidatos" class="Candidatos"></div>
                            
                        </div>
                        <div class="row">
                            <div class="col-xs-7 messagem" style="width: 458px; height: 400px; overflow: auto;"></div>
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
                        
            /**
             * @descricao Retonar os nomes dos candidatos
             * 
             */
            $('#CODIGO_CARGO').change(function(){
                   
             var key = {_id:$(this).val(),uf:$('#SIGLA_UF').val()};
                            
            $.post('themes/site/views/ajax/search.php',key,function(data){
                
                   $('.Search').html('');
                      for(var i=0;i < data.NOME_CANDIDATO.length;i++){
                         $('.Search').append(data.NOME_CANDIDATO[i]);                                   
                   }
                
                 
                },'JSON');                   
            });
                
            $('#LISTAR').click(function () {
                
            $.ajax({
         
            url  : 'themes/site/views/ajax/charts.php',
            type : 'POST',
            data: $('#FormDados').serialize(),
            dataType :'JSON',
            beforeSend:function(){
            $('#Candidatos').addClass('loading');
            $(this).attr('disabled',true);
            
            /**
            * Limpando as divs      
            */
           
            $('.Candidatos').html('');                        
            $('.messagem').html(''); 
            
            },
            success:function(data){
                $('#Candidatos').removeClass('loading');
                               
                $('.Candidatos').append(data.chart);        
                
                if(data.Mensagem){
                    $('.Candidatos').html(data.Mensagem);        
                }
                
                if(data.message){
                        for(var i=0;i < data.message.length;i++){
                                 $('.messagem').append(data.message[i]);                                   
                        }
               }
            },
         error:function(){
             
                console.log("Error");
         
         }
                });
                 });
            });
        </script>
    </div>
</div>