<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>manage student</title>
  <link rel="stylesheet" href="viewstudent.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
</head>
<body>
  <div class="container">
    <nav>
        <ul>
          <li><a href="#" class="logo">
            <img src="logo.png">
            <span class="nav-item">Admin</span>
          </a></li>
          <li><a href="#">
            <i class="fas fa-menorah"></i>
            <span class="nav-item">Dashboard</span>
          </a></li>
          <li><a href="message.html">
            <i class="fas fa-comment"></i>
            <span class="nav-item">Message</span>
          </a></li>
          <li><a href="file:///C:/Users/sarve/OneDrive/Desktop/dashboard/login.html" class="logout">
            <i class="fas fa-sign-out-alt"></i>
            <span class="nav-item">Log out</span>
          </a></li>
        </ul>
      </nav>
  
    <main>
        <header>
          <div class="text">
          <span >  <h2 class="head"><B>STUDENT LIST</B></h2> 
            <p style="position: absolute;
            top:85px;
            left:575px;">"All Department Students are listed below"</p>
          </span>
    <table class="table">
      
      <thead>
        <tr>
          <th scope="col" width="50px">ROLL NUMBER</th>
          <th scope="col" width="150px">Name</th>
          <th scope="col" width="150px">Department</th>
          <th scope="col" width="150px">Message</th>
        </tr>
      </thead>
      <tbody>
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


if ($stmt->num_rows >=1) {
  $stmt->bind_result($sroll,$sname);
  while($stmt->fetch())
  {
    echo '<tr>
    <td data-label="Account">'.$sroll.'</td>
    <td data-label="Due Date"><img src="icon.png" class="tab-img"> '.$sname.'</td>
    <td data-label="Amount">Software Systems</td>
    <td data-label="msg"><i class="fas fa-envelope"></i></td>
  </tr>';
  
  }
  echo '</tbody>
  </table>
  <input type="submit" value="Submit">
  </form>';
}

?>

        <!-- <tr>
          <td data-label="Account">21MSS043</td>
          <td data-label="Due Date"><img src="icon.png" class="tab-img"> K Sarvesh</td>
          <td data-label="Amount">Software Systems</td>
        </tr>
    
        <tr class="active-tr">
          <td data-label="Account">21MSS048</td>
          <td data-label="Due Date"><img src="icon.png" class="tab-img">P Srikanth</td>
          <td data-label="Amount">Software Systems</td>
        </tr>
       <tr>
          <td data-label="Account">21MSS041</td>
          <td data-label="Due Date"><img src="icon.png" class="tab-img">S Sangameshwar Hari</td>
          <td data-label="Amount">Software Systems</td>
        </tr>
    
        <tr>
          <td data-label="Account">21MSS013</td>
          <td data-label="Due Date"><img src="icon.png" class="tab-img">G GOKUL</td>
          <td data-label="Amount">Software Systems</td>
        </tr>
        <tr>
          <td data-label="Account">21MSS050</td>
          <td data-label="Due Date"><img src="icon.png" class="tab-img">R VASANTH</td>
          <td data-label="Amount">Software Systems</td>
        </tr>
    
        <tr>
          <td data-label="Account">21MSS018</td>
          <td data-label="Due Date"><img src="icon.png" class="tab-img">J V HARRIS DHANRAJ</td>
          <td data-label="Amount">Software Systems</td>
        </tr> -->
      </tbody>
    </table>
          </div>
          <div>
            <button id="theme_switch">
              <i class='bx bx-sun'></i>
            </button>
          </div>
        </header>
        
        
      </main>
      <!-- <div id="addFacultyModal" class="modal">
        <div class="modal-content">
          <span class="close" onclick="closeAddFacultyModal()">&times;</span>
          
           <form id="addFacultyForm">
            <label for="facultyId">Roll Number:</label>
            <input type="text" id="facultyId" name="facultyId" required>
      
            <label for="facultyName">Student Name:</label>
            <input type="text" id="facultyName" name="facultyName" required>
      
            <label for="facultyDepartment">Department:</label>
            <input type="text" id="facultyDepartment" name="facultyDepartment" required>
            <div class="add">
            
          </form>
        </div>
      </div> -->
    
    <!-- <script>
        // Function to open the add faculty modal
        function openAddFacultyModal() {
          document.getElementById('addFacultyModal').style.display = 'block';
        }
      
        // Function to close the add faculty modal
        function closeAddFacultyModal() {
          document.getElementById('addFacultyModal').style.display = 'none';
        }
      
        // Function to add a new faculty member to the table
        function addFaculty() {
          // Get form values
          const facultyId = document.getElementById('facultyId').value;
          const facultyName = document.getElementById('facultyName').value;
          const facultyDepartment = document.getElementById('facultyDepartment').value;
          const facultyDesignation = document.getElementById('facultyDesignation').value;
      
          // Create a new row
          const table = document.querySelector('.table tbody');
          const newRow = table.insertRow(-1);
      
          // Insert cells
          const idCell = newRow.insertCell(0);
          const nameCell = newRow.insertCell(1);
          const departmentCell = newRow.insertCell(2);
          const designationCell = newRow.insertCell(3);
      
          // Set cell values
          idCell.textContent = facultyId;
          nameCell.innerHTML = `<img src="icon.png" class="tab-img">${facultyName}`;
          departmentCell.textContent = facultyDepartment;
          designationCell.textContent = facultyDesignation;
      
          // Close the modal
          closeAddFacultyModal();
        }
      </script> -->
      
      
    </div>
    </body>
    </html>
