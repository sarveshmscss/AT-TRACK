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
        
        $email = $_POST["email"];
        $pass = $_POST["password"];
        $role = $_POST["role"];
        
        if( $email!="" && $pass!="" && $role!="" )
        {
            $sql = "SELECT id,roll, email, password, role FROM user WHERE email = ? AND role = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $role);
            $stmt->execute();
            $stmt->store_result();
        
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id,$roll, $email_db, $stored_password, $user_role);
                $stmt->fetch();
        
                // Compare the provided password with the stored password
                if ($pass == $stored_password) {
                    // Authentication successful
                    // Store user session data or tokens
                    
                    switch ($role)
                    {
                        case "admin":
                            session_start();
                            $_SESSION['roll']=$roll;
                            header("Location: admin.html");
                            
                            break;
                        case "student":
                            session_start();
                                $_SESSION['roll']=$roll;
                                header("Location: student.php");
                                
                            break;
                        case "faculty":
                            session_start();
                            $_SESSION['roll']=$roll;
                                    header("Location: faculty.html");
                            
                                    break;
                        default:
                            break;
                                    
                    }
                
                    } 
                    else {
                    // Incorrect password
                    echo "$pass $stored_password";
                    $variable = "Incorrect password. Please try again.";

                    echo '<script type="text/javascript">alert("' . $variable . '");</script>';
    
                }
            } else {
                // User with the provided email and role not found
                
                $variable = "User not found or does not match the specified role. Please try again.";

                    echo '<script type="text/javascript">alert("' . $variable . '");</script>';
    
            }
        
            $stmt->close();
            $conn->close();
        }
        else{
            $variable = "Input Fields must not be empty";


            echo '<script type="text/javascript">alert(" ' . $variable . '");</script>';

        }
        
        
        
        }
    
    ?>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="login.css" />
</head>
<body>
    <div class="container">
        <div class="login">
            <form id="loginForm" method="post" action="login.php">
                <h1>AT-TRACK</h1>
                <hr />
                <p>Login In</p>
                <label>Email</label>
                <input type="text" name="email" placeholder="Email" />
                <label>Password</label>
                <input type="password" name="password" placeholder="Password" />
                <div class="login">
                    <label for="role">Role</label>
                    <select style="margin-left: 10px;" id="role" name="role">
                        <option value="admin">Admin</option>
                        <option value="faculty">Faculty</option>
                        <option value="student">Student</option>
                    </select>
                </div>
                <button type="submit"><span>Submit</span></button>
            </form>
        </div>
        <div class="pic">
            <img src="loginimage.png" />
        </div>
    </div>

    <!-- <script>
        function validateAndRedirect() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var role = document.getElementById('role').value;
            var redirectUrl;

            // Basic validation
            if (!email.trim() || !password.trim()) {
                alert('Email and password are required.');
                return;
            }

            // Email format validation (simple check for @)
            if (!email.includes('@')) {
                alert('Invalid email format.');
                return;
            }

            // Password requirements (e.g., at least 8 characters)
            if (password.length < 8) {
                alert('Password must be at least 8 characters.');
                return;
            }

            switch (role) {
                case 'admin':
                    redirectUrl = 'admin.html';
                    break;
                case 'faculty':
                    redirectUrl = 'faculty.html';
                    break;
                case 'student':
                    redirectUrl = 'student.html';
                    break;
                default:
                    alert('Invalid role selected.');
                    return;
            }

            window.location.href = redirectUrl;
        }
    </script> -->
</body>
</html>
