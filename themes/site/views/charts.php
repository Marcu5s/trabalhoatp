<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
        <title>Highcharts Example</title>

        <script type='text/javascript' src='js/jquery-1.11.1.min.js'></script>
        <style type='text/css'>

        </style>
        <script type='text/javascript'>
            $(function() {
                $('container').highcharts({
                chart: {
                plotBackgroundColor: null,
                        plotBorderWidth: 1, //null,
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
                                data: [ <?php echo $t->grafico() ?>
                                }
                                });
                            });

        </script>
    </head>
    <body>
        <script src='js/highcharts.js'></script>
        <script src='js/modules/exporting.js'></script>

        <div id='container' style='min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto'></div>

    </body>
</html>