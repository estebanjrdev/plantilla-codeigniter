




<script src="<?php echo base_url(); ?>boostrat/js/jquery-2.1.0.js"></script>
<script src="<?php echo base_url(); ?>boostrat/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>boostrat/js/common-script.js"></script>
<script src="<?php echo base_url(); ?>boostrat/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>boostrat/plugins/data-tables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>boostrat/plugins/data-tables/DT_bootstrap.js"></script>
<script src="<?php echo base_url(); ?>boostrat/plugins/data-tables/dynamic_table_init.js"></script>
<script src="<?php echo base_url(); ?>boostrat/plugins/edit-table/edit-table.js"></script>
<script src="<?php echo base_url(); ?>boostrat/plugins/validation/parsley.min.js"></script>
<script src="<?php echo base_url(); ?>boostrat/js/graph.js"></script>
 <script src="<?php echo base_url(); ?>boostrat/js/edit-graph.js"></script>
<script>
          jQuery(document).ready(function() {
              EditableTable.init();
          });
 </script>
 <script src="<?php echo base_url(); ?>boostrat/plugins/chart-js/chartjs-init.js"></script>
 <script src="<?php echo base_url(); ?>boostrat/plugins/chart-js/Chart.bundle.js"></script>
 <script src="<?php echo base_url(); ?>boostrat/js/jPushMenu.js"></script> 
<script src="<?php echo base_url(); ?>boostrat/js/side-chats.js"></script>
<?php
 foreach ($uno as $d){
 $one = $d;
 }
 foreach ($dos as $d){
 $two = $d;
 }
 foreach ($tres as $d){
 $tree = $d;
 }
 foreach ($cuatro as $d){
 $for = $d;
 }
 foreach ($cinco as $d){
 $five = $d;
 }
 foreach ($seis as $d){
 $six = $d;
 }
 foreach ($siete as $d){
 $seven = $d;
 }
 foreach ($ocho as $d){
 $heigt = $d;
 }
 foreach ($nueve as $d){
 $nai = $d;
 }
 foreach ($diez as $d){
 $ten = $d;
 }
 ?>
 
 <script>
 // Debemos crear una instancia del objeto canvas.
 var ctx = document.getElementById("myChart");
 var myChart = new Chart(ctx, {
 type: 'bar',
 data: {
 labels: ["1-9", "10-19", "20-29", "30-39", "40-49", "50-59", "60-69", "70-79", "80-89", "90-100"],
 datasets: [{
 label: 'Frecuencia Salida ',
 data                : [
 "<?php echo $one; ?>",
 "<?php echo $two; ?>",
 "<?php echo $tree; ?>",
 "<?php echo $for; ?>",
 "<?php echo $five; ?>",
 "<?php echo $six; ?>",
 "<?php echo $seven; ?>",
 "<?php echo $heigt; ?>",
 "<?php echo $nai; ?>",
 "<?php echo $ten; ?>"
 ],
 backgroundColor: [
 'rgba(54, 162, 235, 1)',
 'rgba(75, 192, 192, 1)',
 'rgba(54, 162, 235, 1)',
 'rgba(75, 192, 192, 1)',
 'rgba(54, 162, 235, 1)',
 'rgba(75, 192, 192, 1)',
 'rgba(54, 162, 235, 1)',
 'rgba(75, 192, 192, 1)',
 'rgba(54, 162, 235, 1)',
 'rgba(75, 192, 192, 1)'
 ],
 borderColor: [
 'rgba(54, 162, 235, 1)',
 'rgba(75, 192, 192, 1)',
 'rgba(54, 162, 235, 1)',
 'rgba(75, 192, 192, 1)',
 'rgba(54, 162, 235, 1)',
 'rgba(75, 192, 192, 1)',
 'rgba(54, 162, 235, 1)',
 'rgba(75, 192, 192, 1)',
 'rgba(54, 162, 235, 1)',
 'rgba(75, 192, 192, 1)'
 ],
 borderWidth: 1
 }]
 },
 options: {
 scales: {
 yAxes: [{
 ticks: {
 beginAtZero:false
 }
 }]
 }
 }
 });
 </script>
 <?php
 $arrtiro=array();
 $arrfecha=array();
 foreach ($ultimasemana as $d){
 $arrtiro[] = $d->tirada;
 $arrfecha[] = $d->fecha;
 }
 
 ?>
 <script>
 
var ctx = document.getElementById( "team-chart" );
    ctx.height = 150;
    var myChart = new Chart( ctx, {
        type: 'line',
        data: {
            labels              : [

            "<?php echo $arrfecha[9]; ?>",
            "<?php echo $arrfecha[8]; ?>",
            "<?php echo $arrfecha[7]; ?>",
            "<?php echo $arrfecha[6]; ?>",
           "<?php echo $arrfecha[5]; ?>",
           "<?php echo $arrfecha[4]; ?>",
           "<?php echo $arrfecha[3]; ?>",
           "<?php echo $arrfecha[2]; ?>",
           "<?php echo $arrfecha[1]; ?>",
           "<?php echo $arrfecha[0]; ?>"
            ],
            type: 'line',
            defaultFontFamily: 'Montserrat',
            datasets: [ {
                data             : [
                "<?php echo $arrtiro[9]; ?>",
                "<?php echo $arrtiro[8]; ?>",
                "<?php echo $arrtiro[7]; ?>",
                "<?php echo $arrtiro[6]; ?>",
                "<?php echo $arrtiro[5]; ?>",
                "<?php echo $arrtiro[4]; ?>",
                "<?php echo $arrtiro[3]; ?>",
                "<?php echo $arrtiro[2]; ?>",
                "<?php echo $arrtiro[1]; ?>",
                "<?php echo $arrtiro[0]; ?>"
                ],
                label: "Salio",
               
                backgroundColor: 'rgba(0,103,255,.15)',
                borderColor: 'rgba(0,103,255,0.5)',
                borderWidth: 3.5,
                pointStyle: 'circle',
                pointRadius: 5,
                pointBorderColor: 'transparent',
                pointBackgroundColor: 'rgba(0,103,255,0.5)',
                    }, ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                titleFontSize: 12,
                titleFontColor: '#000',
                bodyFontColor: '#000',
                backgroundColor: '#fff',
                titleFontFamily: 'Montserrat',
                bodyFontFamily: 'Montserrat',
                cornerRadius: 3,
                intersect: false,
            },
            legend: {
                display: false,
                position: 'top',
                labels: {
                    usePointStyle: true,
                    fontFamily: 'Montserrat',
                },


            },
            scales: {
                xAxes: [ {
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: false,
                        labelString: 'Días'
                    }
                        } ],
                yAxes: [ {
                    display: true,
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Tirada'
                    }
                        } ]
            },
            title: {
                display: false,
            }
        }
    } );


 </script>
 
</body>
</html>