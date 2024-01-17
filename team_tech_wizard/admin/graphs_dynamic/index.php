


<!DOCTYPE html>
<html>

<head>
    <title>Creating Dynamic Data Graph using PHP and Chart.js</title>
    <style type="text/css">
        .chart-container {
            display: inline-block;
            width: 100%;
        }

        .pie-chart {
            margin: 40px 20px;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script type="text/javascript" src="vendor/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <h2 class="text-center">analytics</h2>
        <br>
    
    </div>
   
    <div class="container-fluid">
        <a href="https://smilewellnessfoundation.org/team_tech_wizard/admin/welcome.php" class="btn btn-primary text-center">back</a><br><br>
        <div class="row">
            
            
                <div class="col-lg-6">
                <h5 class="text-center">User account verification status</h5>
                <div class="chart-container pie-chart">
                    <canvas id="doughnut-chart"></canvas>
                </div>
            </div>
            
                
            <div class="col-lg-6">
                <h5 class="text-center">Complaint status</h5>
                <div class="chart-container pie-chart">
                    <canvas id="pie-chart"></canvas>
                </div>
            </div>
                
        </div>
        <div class="row">
            <div class="col-lg-6">
            <h5 class="text-center">Feedback Status</h5>
                <div class="chart-container pie-chart">
                    <canvas id="pie-chart1"></canvas>
                </div>
            </div>
            
            <div class="col-lg-6">
                <!--<div class="chart-container">-->
                <!--    <canvas id="stacked-vertical-chart"></canvas>-->
                <!--</div>-->
            </div>
        </div>
    </div>


    <script src="./assets/js/graph.js"></script>

    <script>
        $(document).ready(function () {
           
            showPieChart();
            showPieChart1();
            showDoughnutChart();
        });
    </script>
    


</body>

</html>
