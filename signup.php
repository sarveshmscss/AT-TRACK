<!DOCTYPE html>
<html lang="en">
    <?php
    // Connect to the database (you'll need to replace these with your database credentials)
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
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userName = $_POST["userName"];
        $roll = $_POST["RollNumber"];
        $email = $_POST["email"];
        $pass = $_POST["password"];
        $cpass = $_POST["confirmPassword"];
        $role =  $_POST["role"];
        
        if($userName!="" && $email!="" && $pass!="" && $cpass!="" && $role!="")
        {
            if ($pass == $cpass)
            {
                
            if(preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/',$email))
            {
                
                $sql = "INSERT INTO user ( name , roll , email , password , role ) VALUES (?, ?, ?, ?, ?)";
                
                $stmt=$conn->prepare($sql);
                $stmt->bind_param("sssss", $userName, $roll, $email, $pass, $role);
                if ($stmt->execute())
                {
                    $variable = "Registered Succesfully";

                    echo '<script type="text/javascript">alert("' . $variable . '");</script>';
   
                    header("Location: login.php");   
                }
                else
                {
                    echo "ERRR:".$stmt->error;
                }

            
                    $stmt->close();
                    $conn->close();
            }
            else{
                $variable = "Invalid email format";

                echo '<script type="text/javascript">alert("' . $variable . '");</script>';

            }
            }
            else{
                $variable = "Password does not match";
                echo '<script type="text/javascript">alert("' . $variable . '");</script>';

            }
        }
        else{
            $variable = "Input Fields must not be empty";

// Generate JavaScript alert
            echo '<script type="text/javascript">alert(" ' . $variable . '");</script>';

        }
        // Add more fields as needed
    
        // Sanitize and validate data
    
        // Insert data into the database
        
        
        }
    
    ?>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign up</title>
    <link rel="stylesheet" href="signup.css" />
    <!-- <script>
        function validateForm() {
            var userName = document.getElementById('userName').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirmPassword').value;

            // Basic form validation
            if (!userName || !email || !password || !confirmPassword) {
                alert('All fields must be filled out.');
                return false;
            }

            // Validate email format
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Invalid email format.');
                return false;
            }

            // Check if passwords match
            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return false;
            }

            // You can add more advanced password validation here

            // If all validation passes, allow form submission
            return true;
        }
    </script> -->
</head>

<body>
    <div class="container">
        <div class="login">
            <form method="post" action="signup.php">
                <!-- Labels added for accessibility -->
                <h1>AT-TRACK</h1>
                <hr />
                <p>Sign Up</p>
                <label for="userName">User Name</label>
                <input type="text" name="userName" placeholder="" />
                <label for="RollNumber">Roll Number</label>
                <input type="text" name="RollNumber" placeholder="" />
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Email" />
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" />
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" name="confirmPassword" placeholder="Password" />
                <div class="login">
                    <label for="role">Role</label>
                    <select id="role" name="role">
                        <option value="admin">Admin</option>
                        <option value="faculty">Faculty</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <button type="submit"><span>Submit</span></button>
                <p class="para2">
                    Already have an account? <a href="login.html">Login here</a>
                </p>
            </form>
        </div>
        <div class="pic">
            <img src="loginimage.png" />
            <p style="color:white">
                By clicking the Sign Up button, you agree to our <br />
                <a href="#">Terms and Condition</a> and <a href="#">Policy Privacy</a>
            </p>
        </div>
    </div>
</body>

</html>
