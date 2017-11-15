<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>PARMS Monthly Uploads</title>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <style type="text/css">
            #container {

                height: 400px; 
                min-width: 310px; 
                max-width: 800px;
                margin: 0 auto;
                
            }
        </style>
        

<?php 

$months = array('0'=>"Select year");


echo form_dropdown("upload[year]", $upload_year,'', 'class="form-control" id="year_id" style=width:200px;height:40px;font-size:1.5em; onchange="show_graphics();"');

        $arr_uploads_monthly = implode(",",$data_uploads);

        echo '<script type="text/javascript">

        $(function () {

         
            $(\'#container\').highcharts({
                chart: {
                    type: \'column\',
                    margin: 75,
                    options3d: {
                        enabled: true,
                        alpha: 10,
                        beta: 25,
                        depth: 75
                    }
                },
                title: {
                    text: \'DTI - Caraga 3D Chart Post Activity Report Monthly Uploads\'
                },
                subtitle: {
                    text: \'Notice the difference between a 0 value and a null point\'
                },
                plotOptions: {
                    column: {
                        depth: 40
                    }
                },
                xAxis: {
                    categories: Highcharts.getOptions().lang.shortMonths
                },
                yAxis: {
                    title: {
                        text: null
                    }
                },
                series: [{
                    name: \'Number of uploads\',
                    data: ['.$arr_uploads_monthly.']
                }]
            });
        });


        </script>';  

?> 

    </head>

    <script type="text/javascript">

    var res = [];

        function show_graphics(){

            var year_val = $("#year_id option:selected").text();


            $.post("<?php echo base_url(); ?>main_controller/show_monthly_analytics_ajax", {"year_val":year_val}, function(data){

                  if( data.notify == "Success" ){
                    
                    /*Object.keys(data.upload_data).forEach(function(key) {
                        res.push(data.upload_data[key]);
                    });*/

                     res = Object.keys(data.upload_data).map(function(k) { return data.upload_data[k] });


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
                                categories: Highcharts.getOptions().lang.shortMonths
                            },
                            yAxis: {
                                title: {
                                    text: null
                                }
                            },
                            series: [{
                                name: 'Sales',
                                data: res
                            }]
                        });

                  } else{

                    console.log(data.notify);

                    }

            },'json');

        
       }

    

    </script>



    <body>

<script src="<?php echo base_url('asset/highchart/js/highcharts.js'); ?>"></script>
<script src="<?php echo base_url('asset/highchart/js/highcharts-3d.js'); ?>"></script>
<script src="<?php echo base_url('asset/highchart/js/modules/exporting.js'); ?>"></script>
<script src="<?php echo base_url('asset/highchart/js/themes/sand-signika.js'); ?>"></script>

<div id="container" style="height: 400px"></div>

    </body>
</html>
