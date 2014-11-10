<div class="page1_block"><div>
   <div class="container_12">
     <div class="grid_4">
       <div class="box">
         <div class="maxheight">
           <div class="title">ELEIÇÕES</div>
           <div class="inner1">
             <img src="<?php echo Controller::Assets() ?>images/page1_img1.jpg" alt="">
             <h3></h3>
             <div class="clear"></div>
             <br>
             <a href="<?php echo PATH_HTTP ?>?pg=media" class="btn">Detalhes</a>
           </div>
         </div>
       </div>
     </div>
     <div class="grid_4">
       <div class="box">
         <div class="maxheight">
           <div class="title">QUESTÕES</div>
           <div class="inner1">
             <img src="<?php echo Controller::Assets() ?>images/page1_img2.jpg" alt="">
             <h3></h3>
             <div class="clear"></div>
             <br>
             <a href="#" class="btn">Detalhes</a>
           </div>
         </div>
       </div>
     </div>
     <div class="grid_4">
       <div class="box">
         <div class="maxheight">
           <div class="title">MISSÃO</div>
           <div class="inner1">
             <img src="<?php echo Controller::Assets() ?>images/page1_img3.jpg" alt="">
             <h3></h3>
             <div class="clear"></div>
             <br>
             <a href="#" class="btn">Detalhes</a>
           </div>
         </div>
       </div>
     </div>
   </div>
   </div>
 </div> 

<!--=======content================================-->
<div class="content page1">
  <div class="container_12">
     <br/>
     <div class="panel panel-default">
           <div class="panel-heading">Estatística de votos</div>
            
           <script>
           $(function () {
    $('#Candidatos').highcharts({
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
            data: <?php echo SiteController::getCharts() ?>
        }]
    });
});</script>
           <div class="row">
            <div class="col-xs-12 col-md-8"></div>
            <div class="col-xs-6 col-md-4"><a href="<?php echo PATH_HTTP ?>?pg=voting"  class="btn btn-success">Votar</a></div>
        </div>
        <div class="panel-body" id="Candidatos"></div>
        
     </div>
  </div> 
</div>