<!DOCTYPE html>
<html>

<head>
      <title>Dynamic Linear Chart</title>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
      <canvas id="chart"></canvas>

      <script>
            $(document).ready(function() {
                  var chart = new Chart($('#chart'), {
                        type: 'line',
                        data: {
                              labels: [], // Initialize empty labels
                              datasets: [{
                                    label: 'Dynamic Data',
                                    data: [], // Initialize empty data
                                    borderColor: 'blue',
                                    backgroundColor: 'transparent',
                              }]
                        },
                        options: {
                              responsive: true,
                              scales: {
                                    y: {
                                          beginAtZero: true
                                    }
                              }
                        }
                  });

                  function updateChart() {
                        $.ajax({
                              url: "<?php echo base_url('/getchartdata'); ?>",
                              type: "GET",
                              dataType: "json",
                              success: function(response) {
                                    // Update labels and data
                                    chart.data.labels = response.labels;
                                    chart.data.datasets[0].data = response.data;
                                    chart.update();
                              }
                        });
                  }

                  // Call updateChart() function every second
                  setInterval(function() {
                        updateChart();
                  }, 1000);
            });
      </script>
</body>

</html>