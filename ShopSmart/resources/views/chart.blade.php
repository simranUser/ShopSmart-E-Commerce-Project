<!doctype html>
<html lang="en">
  <head>
    <title>Google Pie Charts,Bar Charts and Line Charts</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>

    <div class="container p-5">
        <h5>Google Pie Charts,Bar Charts and Line Charts</h5>
        <canvas id="myChart" width="400" height="400"></canvas>
        <canvas id="myBarChart" width="400" height="400"></canvas>
        <div id="piechart" style="width: 900px; height: 500px;"></div>
    </div>

    <!-- For Bar charts-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const ctx2 = document.getElementById('myBarChart').getContext('2d');

    //for bar chart
    const myChart = new Chart(ctx2, 
    {
        type: 'bar',
        data: {
                labels: [
                    @php
                        foreach($products as $product) {
                            echo "['".$product->name."'],";
                        }
                    @endphp
                ],           
                datasets: [{
                label: '# of Votes',
                data: [
                    @php
                        foreach($products as $product) {
                            echo "['".$product->price."'],";
                        }
                    @endphp
    
                   
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    //for line chart
    const myChart1 = new Chart(ctx, 
    {
        type: 'line',
        data: {
                labels: [
                    @php
                        foreach($products as $product) {
                            echo "'".$product->name."',";
                        }
                    @endphp
                ],               datasets: [{
                label: 'My First Line Chart',
                data: [ @php
                        foreach($products as $product) {
                            echo "'".$product->price."',";
                        }
                    @endphp],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>

    // <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    // <script>
      
    // </script> -->
 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Product Name', 'price','description'],

                @php
                foreach($products as $product) {
                    echo "['".$product->name."', ".$product->price.",'".$product->description."'],";
                }
                @endphp
        ]);

          var options = {
            title: 'Product Details',
            is3D: true,
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart'));

          chart.draw(data, options);
        }
    </script>

</body>
</html>