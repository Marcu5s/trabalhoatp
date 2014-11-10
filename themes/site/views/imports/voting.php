<?php
$mongoDb = new Mongo();

$db = $mongoDb->selectDB('trabalhoatp')->candidato;

/**
 * @descricao Retornando somente as siglas dos estados.
 * 
 */
$distinct = $db->distinct('SIGLA_UF');
?>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading">Enviar mensagem</div>
                <div class="panel-body">
                    <form class="form-horizontal" name="message" id="Message" role="form">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Nome">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Mensagem</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="message"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" onclick="AjaxMessage()" class="btn btn-success">Enviar</button>
                                <button type="button" style="display:nome" id="returnMessage" class="btn"></button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
                    <div class="panel-heading">Escolha o estado e a categoria</div>
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
                            <div class="Candidatos" style="height: 280px; overflow-y: auto; overflow-x: hidden;"></div>
                        </div>
                        <script>
                            var Doubt = function (id, SIGLA_UF) {
                                $('#doubt_' + id).addClass('disabled');
                                var key = 'dout';
                                Ajax(id, key, SIGLA_UF);
                            }
                            var Deny = function (id, SIGLA_UF) {
                                $('#deny_' + id).addClass('disabled');
                                var key = 'deny';
                                Ajax(id, key, SIGLA_UF);
                            }
                            var Confirm = function (id, SIGLA_UF) {
                                $('#confirm_' + id).addClass('disabled');
                                var key = 'confirm';
                                Ajax(id, key, SIGLA_UF);
                            }
                            var Ajax = function (id, key, SIGLA_UF) {

                                var type = {id: id, key: key, SIGLA_UF: SIGLA_UF};
                                $.post('themes/site/views/ajax/voting.php', type, function (data) {
                                    console.log(data);
                                });

                            }
                            var Message = function (id) {

                                document.message.reset();

                                $('#returnMessage').fadeOut().html('').addClass('btn');

                                $('#idcandidato').remove();

                                var input = "<input type='hidden' id='idcandidato' name='idcandidato' value='" + id + "' />";

                                $('#Message').append(input);

                            }

                            var AjaxMessage = function () {

                                $.post('themes/site/views/ajax/message.php', $('#Message').serialize(), function (data) {

                                    document.message.reset();

                                    var Class = data.class;

                                    setTimeout(function () {
                                        $('#returnMessage').removeClass(Class);
                                        $('#returnMessage').fadeOut().html('');

                                    }, 3000);

                                    $('#returnMessage').fadeIn().addClass(Class).html(data.message);

                                }, 'JSON');

                                return false;
                            }

                        </script>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#LISTAR').click(function () {


                    $.ajax({
                        url: 'themes/site/views/ajax/candidate.php',
                        type: 'POST',
                        data: $('#FormDados').serialize(),
                        dataType: 'JSON',
                        beforeSend: function () {
                            $('.Candidatos').addClass('loading');
                            $(this).attr('disabled', true);
                        },
                        success: function (data) {
                            $('.quant').fadeIn().html("Quantidade: " + data.count);
                            $('.Candidatos').html('');
                            $('.Candidatos').removeClass('loading');
                            for (var i = 0; i < data.HTML.length; i++) {
                                $('.Candidatos').append(data.HTML[i]);
                            }
                        },
                        error: function () {

                            console.log("Error");

                        }
                    });
                });
            });
            $('.myModal').modal(options);
        </script>
    </div>
</div>
