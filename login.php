<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="login1.css">
</head>
<body>

    <div class="video-background">
        <video autoplay muted loop id="background-video">
            <source src="vids/background.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- PHP Code Starts HERE -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include '_connection.php';
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];

        // Check if the credentials are for admin
        if ($mobile === 'admin' && $password === 'admin') {
            header("Location: Admin/index.php");
            exit();
        }

        // Check if the credentials are for a regular user
        $sql = "SELECT * FROM user WHERE mobile_no = '$mobile'";
        $result = mysqli_query($conn, $sql);
        $resultCount = mysqli_num_rows($result);

        if ($resultCount > 0) {
            $row = $result->fetch_assoc();
            if ($password === $row['password']) {
                // Redirect on successful login
                header("Location: frontend.php");
                exit();
            } else {
                // Incorrect password
                echo '<script>
                window.location.href = "login.php";
                alert("Invalid Password!!");
                </script>';
            }
        } else {
            // Incorrect mobile number
            echo '<script>
            window.location.href = "login.php";
            alert("Invalid Mobile Number or Password!!");
            </script>';
        }
    }
    ?>
    <!-- PHP CODE ENDS HERE -->

    <!-- HTML Code Starts Here -->
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="Enter mobile number" required >
                <small class="form-text text-muted">Must be a valid 10-digit phone number.</small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required >
                <small class="form-text text-muted">Password must be at least 6 characters long.</small>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Sign up</a></p>
    </div>

    <script>
    // JavaScript validation with special case for admin
    function validateForm() {
        var mobile = document.getElementById("mobile").value;
        var password = document.getElementById("password").value;

        // Allow admin login to bypass validation
        if (mobile === "admin" && password === "admin") {
            return true;
        }

        // Regular user validation
        var mobilePattern = /^[0-9]{10}$/;
        if (!mobilePattern.test(mobile)) {
            alert("Please enter a valid 10-digit mobile number.");
            return false;
        }

        if (password.length < 6) {
            alert("Password must be at least 6 characters long.");
            return false;
        }

        return true;
    }
</script>


</body>
</html>
