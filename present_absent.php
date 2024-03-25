<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Mark Attendance</title>
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <style>
    /* Add your custom styles here */
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
    }

    nav {
      background-color: #343a40;
      color: #fff;
      padding: 10px 0;
      text-align: center;
    }

    nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    nav ul li {
      display: inline;
      margin-right: 20px;
    }

    nav a {
      text-decoration: none;
      color: #fff;
      font-size: 16px;
    }

    nav .logo img {
      height: 30px;
      margin-right: 10px;
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

    .text p {
      font-size: 14px;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #343a40;
      color: #fff;
    }

    td {
      background-color: #fff;
    }

    .switch-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 150px;
      margin-top: 10px;
    }

    .switch-label {
      font-size: 14px;
      margin-right: 5px;
    }

    .switch {
      position: relative;
      display: inline-block;
      width: 40px;
      height: 20px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 16px;
      width: 16px;
      left: 2px;
      bottom: 2px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #28a745; /* Green color when switch is on */
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #28a745; /* Green color when switch is on */
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(20px);
      -ms-transform: translateX(20px);
      transform: translateX(20px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 20px;
    }

    .slider.round:before {
      border-radius: 50%;
    }

    #theme_switch {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
      font-size: 16px;
    }
  </style>
</head> 

<body>
  <div class="container">
    <!-- Navigation -->
    <main>
      <header>
        <div class="text">
          <span>
            <h2 class="head"><B>MARK ATTENDANCE</B></h2>
          </span>
          <form method="post">
          <label for="datepicker">Date:</label>
          <input type="date" id="datepicker" name="datepicker">
          <!-- Student Table -->
          <table class="table">
            <thead>
              <tr>
                <th scope="col" width="50px">ROLL NUMBER</th>
                <th scope="col" width="150px">Name</th>
                <th scope="col" width="150px">Department</th>
                <th scope="col" width="150px">Attendance</th>
              </tr>
            </thead>
            <tbody>
              <!-- Sample student rows, add more as needed -->
              <!-- <tr>
                <td data-label="Roll Number">21MSS043</td>
                <td data-label="Name"><img src="icon.png" class="tab-img"> K Sarvesh</td>
                <td data-label="Department">Software Systems</td>
                <td data-label="Attendance">
                  <div class="switch-container">
                    <label class="switch-label">Absent</label>
                    <label class="switch">
                      <input type="checkbox">
                      <span class="slider round"></span>
                    </label>
                    <label class="switch-label">Present</label>
                  </div>
                </td>
              </tr> -->
              <!-- Add nine more student rows -->
              <?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "attendance";

$conn = new mysqli($servername, $username, $password, $dbname);
$role="student";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT roll, name FROM user WHERE role = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $role);
$stmt->execute();
$stmt->store_result();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["attendance"])) {
      $attendanceData = $_POST["attendance"];
      $date=$_POST["datepicker"];
      
      $ssql = "INSERT INTO attendance (  roll , date , present , name ) VALUES (?, ?, ?, ?)";
      $psql = "INSERT INTO message (  roll , name , message ) VALUES (?, ?, ?)";
                
      $sstmt=$conn->prepare($ssql);    
      $pstmt=$conn->prepare($psql);    
                
      // foreach ($attendanceData as $sr => $status) {
      //     // $sroll is the Roll Number, and $status is "present" or "absent"
      //     echo "$sr";
      // }
      if ($stmt->num_rows >=1) {
        $stmt->bind_result($sroll,$sname);
        while($stmt->fetch())
        {
          $x=$sroll.'-'.$sname;
          if(isset($attendanceData[$x]))
          {
            $status=$attendanceData[$x];
            $msg="You are marked present in date:".$date;
            $sstmt->bind_param("ssis", $sroll, $date, $status, $sname);
          $sstmt->execute();
          $pstmt->bind_param("sss", $sroll, $sname, $msg );
          $pstmt->execute();
          }
          else{
            $msg="You are marked absent in date:".$date;
            $pstmt->bind_param("sss", $sroll, $sname, $msg);
          $pstmt->execute();
          }
        }
      
       
  }
}

}

if ($stmt->num_rows >=1) {
  $stmt->bind_result($sroll,$sname);
  while($stmt->fetch())
  {
    echo '<tr>
                <td data-label="Roll Number">' . $sroll . '</td>
                <td data-label="Name">
                    <img src="icon.png" class="tab-img">' . $sname . '
                </td>
                <td data-label="Department">Software Systems</td>
                <td data-label="Attendance">
                    <div class="switch-container">
                        <label class="switch-label">Absent</label>
                        <label class="switch">
                            <input type="checkbox" name="attendance[' . $sroll.'-'.$sname.']" value="1">
                            <span class="slider round"></span>
                        </label>
                        <label class="switch-label">Present</label>
                    </div>
                </td>
            </tr>';
  
  }
  echo '</tbody>
  </table>
  <input type="submit" value="Submit">
  </form>';
}

?>

<!-- <tr>
    <td data-label="Roll Number">21MSS048</td>
    <td data-label="Name"><img src="icon.png" class="tab-img"> P Srikanth</td>
    <td data-label="Department">Software Systems</td>
    <td data-label="Attendance">
      <div class="switch-container">
        <label class="switch-label">Absent</label>
        <label class="switch">
          <input type="checkbox">
          <span class="slider round"></span>
        </label>
        <label class="switch-label">Present</label>
      </div>
    </td>
  </tr>
  
  <tr>
    <td data-label="Roll Number">21MSS041</td>
    <td data-label="Name"><img src="icon.png" class="tab-img"> S Sangameshwar Hari</td>
    <td data-label="Department">Software Systems</td>
    <td data-label="Attendance">
      <div class="switch-container">
        <label class="switch-label">Absent</label>
        <label class="switch">
          <input type="checkbox">
          <span class="slider round"></span>
        </label>
        <label class="switch-label">Present</label>
      </div>
    </td>
  </tr>
  
  <tr>
    <td data-label="Roll Number">21MSS013</td>
    <td data-label="Name"><img src="icon.png" class="tab-img"> G GOKUL</td>
    <td data-label="Department">Software Systems</td>
    <td data-label="Attendance">
      <div class="switch-container">
        <label class="switch-label">Absent</label>
        <label class="switch">
          <input type="checkbox">
          <span class="slider round"></span>
        </label>
        <label class="switch-label">Present</label>
      </div>
    </td>
  </tr>
  
  <tr>
    <td data-label="Roll Number">21MSS050</td>
    <td data-label="Name"><img src="icon.png" class="tab-img"> R VASANTH</td>
    <td data-label="Department">Software Systems</td>
    <td data-label="Attendance">
      <div class="switch-container">
        <label class="switch-label">Absent</label>
        <label class="switch">
          <input type="checkbox">
          <span class="slider round"></span>
        </label>
        <label class="switch-label">Present</label>
      </div>
    </td>
  </tr>
  
  <tr>
    <td data-label="Roll Number">21MSS018</td>
    <td data-label="Name"><img src="icon.png" class="tab-img"> J V HARRIS DHANRAJ</td>
    <td data-label="Department">Software Systems</td>
    <td data-label="Attendance">
      <div class="switch-container">
        <label class="switch-label">Absent</label>
        <label class="switch">
          <input type="checkbox">
          <span class="slider round"></span>
        </label>
        <label class="switch-label">Present</label>
      </div>
    </td>
  </tr> -->
            </tbody>
          </table>
        </div>
        </header>
        </main>
        </div>
        </body>
        </html>
  
     