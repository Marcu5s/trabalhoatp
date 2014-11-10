<?php 
$SiteController = new SiteController();
?>
<script src="<?php echo PATH_HTTP ?>js/highcharts-3d.js"></script>  
<script src="<?php echo PATH_HTTP ?>js/modules/exporting.js"></script>  
<script>
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 15,
                beta: 15,
                viewDistance: 25,
                depth: 40
            },
            marginTop: 80,
            marginRight: 40
        },

        title: {
            text: 'Total de votos de cada estado brasileiro'
        },

        xAxis: {
            categories: [<?php echo $SiteController->xAxis() ?>]
        },

        yAxis: {
            opposite: false
        },
        /* plotOptions: {
            column: {
                stacking: 'normal',
                depth: 40
            }
        },
        */
        series: [ <?php echo $SiteController->Series() ?>]
    });
});
</script>
<div class="container" id="container"></div>