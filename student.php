<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Student</title>
    <link rel="stylesheet" href="student.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
    <div class="container">
        <nav>
            <ul>
                <li><a href="#" class="logo">
                        <img src="logo.png">
                        <span class="nav-item">Student</span>
                    </a></li>
                <li><a href="#">
                        <i class="fas fa-menorah"></i>
                        <span class="nav-item">Dashboard</span>
                    </a></li>
                <li><a href="message.php">
                        <i class="fas fa-comment"></i>
                        <span class="nav-item">Message</span>
                    </a></li>
                <li><a href="login.php" class="logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="nav-item">Log out</span>
                    </a></li>
            </ul>
        </nav>
<?php
session_start();
$x=$_SESSION['roll'];


?>

        <section class="main">
            <div class="main-top">
                <h1>AT-TRACK</h1>
                <i class="fas fa-user-cog"></i>
            </div>
            <div class="users">
                <div class="card">
                    <img src="student.png">
                    <h4>ATTENDANCE ANALYSIS</h4>
                    <div class="per">
                    </div>
                    <button><a href="analysis.php">view</a></button>
                </div>
                <div class="card">
                    <img src="attend.png">
                    <h4>ATTENDANCE CALCULATOR</h4>
                    <div class="per">
                    </div>
                    <button><a href="report.html">view</a></button>
                </div>
            </div>

            <section class="attendance">
                <div class="profile-list">
                    <h1>INFO</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>FEATURES</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Time Table</td>
                                <td><a href="timetable.html"><button>View</button></a></td>
                            </tr>
                            <tr>
                                <td>Academic Calendar</td>
                                <td><a href="academiccalendar.html"><button>View</button></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

        </section>
    </div>

</body>

</html>
