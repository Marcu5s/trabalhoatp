
<div class="page1_block"><div>
   <div class="container_12">
     <div class="grid_4">
       <div class="box">
         <div class="maxheight">
           <div class="title">ELEIÇÕES</div>
           <div class="inner1">
             <img src="<?php echo Controller::Assets() ?>images/page1_img1.jpg" alt="">
             <h3>Dolore ipsum</h3>
             <div class="clear"></div>Mes cuml dia sed in lacus ut eniascet aliiqt es sitet amet eismod ictor ut lig ameti dapibus ticdu nt mtsenе dolorlt comme. Mes cuml dia sed inertio.
             <br>
             <a href="#" class="btn">Detalhes</a>
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
             <h3>Dolore ipsum</h3>
             <div class="clear"></div>Mes cuml dia sed in lacus ut eniascet aliiqt es sitet amet eismod ictor ut lig ameti dapibus ticdu nt mtsenе dolorlt comme. Mes cuml dia sed inertio.
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
             <h3>Dolore ipsum</h3>
             <div class="clear"></div>Mes cuml dia sed in lacus ut eniascet aliiqt es sitet amet eismod ictor ut lig ameti dapibus ticdu nt mtsenе dolorlt comme. Mes cuml dia sed inertio.
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
           <div class="panel-body" id="Candidatos"></div>
     </div>
  </div> 
</div>