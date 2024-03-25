<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement Page</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        #container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            max-width: 800px;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .announcement-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .announcement {
            background-color: #5cb85c;
            color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            margin: 10px 0;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .announcement:hover {
            transform: scale(1.05);
        }

        .announcement h2 {
            margin: 0;
        }

        .announcement p {
            margin: 10px 0 0;
        }

        .announcement .date {
            color: black;
            font-size: 0.9em;
        }

        #addAnnouncementBtn {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #337ab7;
            color: #fff;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>

<body data-role="admin">
    <div id="container">
        <h1>ATTENDANCE ALERT</h1>

        <div class="announcement-container">
            <div class="announcement">
                <h2>ATTENDANCE STATUS:</h2>
                <?php

session_start();
$x=$_SESSION['roll'];
error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "attendance";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
$sql="SELECT name, roll , message FROM message WHERE roll= ?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("s",$x);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows >=1) {
    $stmt->bind_result($roll,$name,$message);
    while($stmt->fetch())
    {
        echo "<h3>".$message."</h3>";
    }
}

?>
                <!-- <h3>You have been marked absent for 2nd hour</h3> -->
                
            </div>

            
            <button id="addAnnouncementBtn" onclick="addAnnouncement()">Add Announcement</button>
        
        </div>
    </div>
</body>

</html>
