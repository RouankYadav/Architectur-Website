<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="register1.css">
</head>
<body>

    <div class="video-background">
        <video autoplay muted loop id="background-video">
            <source src="vids/background.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- PHP Code Begins Here -->
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            include '_connection.php';
            $name = $_POST['name'];
            $email = $_POST['email'];
            $mobile = $_POST['mobile'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            // Check if mobile number exists
            $sql = "SELECT * FROM `user` WHERE mobile_no = '$mobile'";
            $result = mysqli_query($conn, $sql);
            $mobileCount = mysqli_num_rows($result);

            if ($mobileCount == 0) {
                // Validate password length
                if (strlen($password) < 6) {
                    echo '<script>
                    window.location.href = "register.php";
                    alert("Password must be at least 6 characters long.");
                    </script>';
                } else {
                    if ($password == $cpassword) {
                        $sql = "INSERT INTO `user` (`name`, `email`, `mobile_no`, `password`) VALUES ('$name', '$email', '$mobile', '$password')";
                        $result = mysqli_query($conn, $sql);

                        if ($result) {
                            echo "Your name is '$name', email is '$email'";
                            echo "Your data has been successfully stored in our database";
                            header("Location: frontend.php", true, 303);
                            exit();
                        }
                    } else {
                        echo '<script>alert("Passwords do not match.");</script>';
                    }
                }
            } else {
                if ($mobileCount > 0) {
                    echo '<script>
                    window.location.href = "register.php";
                    alert("Mobile Number already exists! Try logging in or registering with a new phone number.");
                    </script>';
                }
            }
        }
    ?>
    <!-- PHP Code Ends Here -->

    <!-- HTML Form with Validation -->
    <div class="register-container">
        <h2>Register</h2>
        <form action="register.php" method="post" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" required minlength="3">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile Number</label>
                <input type="tel" class="form-control" name="mobile" id="mobile" placeholder="Enter mobile number" required pattern="[0-9]{10}">
                <small class="form-text text-muted">Must be a valid 10-digit phone number.</small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required minlength="6">
                <small class="form-text text-muted">Password must be at least 6 characters long.</small>
            </div>
            <div class="mb-3">
                <label for="confirm-password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="cpassword" id="confirm-password" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <p>Have an account? <a href="login.php">Sign in</a></p>
    </div>

    <script>
        // JavaScript validation for matching passwords
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm-password").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }

            return true;
        }
    </script>

</body>
</html>
