<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Attendance Analysis</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f1f1f1;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    main {
      padding: 20px;
    }

    header {
      text-align: center;
      margin-bottom: 20px;
    }

    .head {
      color: #333;
    }

    .attendance-analysis {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
    }

    .chart {
      width: 48%;
      background-color: #fff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      padding: 20px;
      box-sizing: border-box;
      text-align: center;
    }

    .chart h3 {
      margin-bottom: 20px;
    }

    canvas {
      max-height: 300px; /* Set a fixed height for the charts */
      margin: 0 auto; /* Center the charts */
      display: block;
    }
  </style>
</head>
<body>
  <div class="container">
    <main>
      <header>
        <div class="head">
          <h2>Attendance Analysis</h2>
        </div>
      </header>

      <div class="attendance-analysis">
        <form method="post">
        <label for="RollNumber">Enter Total Number of Days:</label>
                <input type="number" name="total" placeholder="" />
        <button type="submit"><span>Submit</span></button>
      </form>
        <!-- Attendance chart for student 1 -->
        <?php
        // Create a function to connect to your database (not shown here)

        // Assuming you have a students table with columns: id, name, present_days, total_days
        
          error_reporting(E_ALL);
      ini_set('display_errors', 1);
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "attendance";
    
      $conn = new mysqli($servername, $username, $password, $dbname);
    
    $status=[];
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $total=$_POST['total'];
      
    
    
        // Retrieve attendance data for each student
        $sql = "SELECT roll, name , present FROM attendance";
        $stmt = $conn->prepare($sql);
            $stmt->execute();
            $stmt->store_result(); 
            if ($stmt->num_rows >=1) {
              $stmt->bind_result($sroll,$sname,$pr);
              
              while($stmt->fetch())
              {
                if(isset($status[$sroll]))
                {
                  $status[$sroll]++;
                }
                else{
                  $status[$sroll]=1;
                }
              }
              
              foreach($status as $roll=>$days)
              {
                $absent=$total-$days;
                echo '<div class="chart">';
                      echo '<h3>' . $roll . '</h3>';
                      echo '<canvas id="chart-' . $roll . '"></canvas>';
                      echo "<h4>Total present:".$days;
                  echo "&nbsp Total Absent:".$absent."</h4>";
                      echo '</div>';
                      echo '<script>
                              var dataStudent' . $roll . ' = {
                                labels: ["Present", "Absent"],
                                datasets: [{
                                  data: [' . $days . ', ' . $absent . '],
                                  backgroundColor: ["#28a745", "#dc3545"],
                                }],
                              };
                              var options = {
                                responsive: true,
                                maintainAspectRatio: false,
                            };
                              var ctxStudent' . $roll . ' = document.getElementById("chart-' . $roll . '").getContext("2d");
                                      new Chart(ctxStudent' . $roll . ', {
                                        type: "pie",
                                        data: dataStudent' . $roll . ',
                                        options: options,
                                      });
                                    </script>';
                  
              }
        }
    }
    //   error_reporting(E_ALL);
    //   ini_set('display_errors', 1);
    //   $servername = "localhost";
    //   $username = "";
    //   $password = "";
    //   $dbname = "attendance";
    
    //   $db = new mysqli($servername, $username, $password, $dbname);
    
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
    //     // Retrieve attendance data for each student
    //     $sql = "SELECT id, name, present_days, total_days FROM students";
    //     $result = $db->query($sql);

    //     while ($row = $result->fetch_assoc()) {
    //       $studentName = $row['name'];
    //       $presentDays = $row['present_days'];
    //       $absentDays = $row['total_days'] - $presentDays;

    //       echo '<div class="chart">';
    //       echo '<h3>' . $studentName . '</h3>';
    //       echo '<canvas id="chart-' . $row['id'] . '"></canvas>';
    //       echo '</div>';

    //       // Generate JavaScript data for the current student
    //       echo '<script>
    //         var dataStudent' . $row['id'] . ' = {
    //           labels: ["Present", "Absent"],
    //           datasets: [{
    //             data: [' . $presentDays . ', ' . $absentDays . '],
    //             backgroundColor: ["#28a745", "#dc3545"],
    //           }],
    //         };

    //         var ctxStudent' . $row['id'] . ' = document.getElementById("chart-' . $row['id'] . '").getContext("2d");
    //         new Chart(ctxStudent' . $row['id'] . ', {
    //           type: "pie",
    //           data: dataStudent' . $row['id'] . ',
    //           options: options,
    //         });
    //       </script>';
        // }
        // $db->close();
        ?>
      </div>
    </main>
  </div>
<!-- 
  <script>
    // Generate random attendance percentages
    function generateRandomPercentage() {
      return Math.floor(Math.random() * 100) + 1;
    }

    var dataStudent1 = {
      labels: ['Present', 'Absent'],
      datasets: [{
        data: [generateRandomPercentage(), 100 - generateRandomPercentage()],
        backgroundColor: ['#28a745', '#dc3545'],
      }],
    };

    var dataStudent2 = {
      labels: ['Present', 'Absent'],
      datasets: [{
        data: [generateRandomPercentage(), 100 - generateRandomPercentage()],
        backgroundColor: ['#28a745', '#dc3545'],
      }],
    };

    var dataStudent3 = {
      labels: ['Present', 'Absent'],
      datasets: [{
        data: [generateRandomPercentage(), 100 - generateRandomPercentage()],
        backgroundColor: ['#28a745', '#dc3545'],
      }],
    };

    // Chart options
    var options = {
      responsive: true,
      maintainAspectRatio: false,
    };

    // Create charts
    var ctxStudent1 = document.getElementById('chartStudent1').getContext('2d');
    var ctxStudent2 = document.getElementById('chartStudent2').getContext('2d');
    var ctxStudent3 = document.getElementById('chartStudent3').getContext('2d');

    new Chart(ctxStudent1, {
      type: 'pie',
      data: dataStudent1,
      options: options,
    });

    new Chart(ctxStudent2, {
      type: 'pie',
      data: dataStudent2,
      options: options,
    });

    new Chart(ctxStudent3, {
      type: 'pie',
      data: dataStudent3,
      options: options,
    });
  </script> -->
</body>
</html>
