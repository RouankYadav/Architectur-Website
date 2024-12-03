<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css">
    <title>Admin Panel - Home</title>
</head>
<body>

    <!-- Header section -->
    <header class="header">
    <a href="../login.php" id="logout-link" class="logo"><img src="../logo.jpeg" alt="Logo"></a>
    <nav>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="admin_users.php">Users</a></li>
                <li><a href="admin_contactus.php">Contact Us</a></li>
                <li><a href="admin_consults.php">Consults</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main content section -->
    <main class="container mt-5">
        <div class="row">
            <!-- Section 1: Number of Users -->
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <?php
                        include '../_connection.php'; // Include your database connection
                        $sql = "SELECT COUNT(*) AS user_count FROM user"; // Replace 'users' with your users table name
                        $result = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_assoc($result);
                        ?>
                        <p class="card-text"><?php echo $data['user_count']; ?> Users</p>
                        <a href="admin_users.php" class="btn btn-primary mt-2">View All Users</a>
                    </div>
                </div>
            </div>

            <!-- Section 2: Number of Consults -->
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Consults</h5>
                        <?php
                        $sql = "SELECT COUNT(*) AS consult_count FROM consult"; // Replace 'consult' with your consult table name
                        $result = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_assoc($result);
                        ?>
                        <p class="card-text"><?php echo $data['consult_count']; ?> Consults</p>
                        <a href="admin_consults.php" class="btn btn-primary mt-2">View All Users</a>
                    </div>
                </div>
            </div>

            <!-- Section 3: Number of Messages -->
            <div class="col-md-4 mb-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total Messages</h5>
                        <?php
                        $sql = "SELECT COUNT(*) AS message_count FROM contact_us"; // Replace 'contact_messages' with your messages table name
                        $result = mysqli_query($conn, $sql);
                        $data = mysqli_fetch_assoc($result);
                        ?>
                        <p class="card-text"><?php echo $data['message_count']; ?> Messages</p>
                        <a href="admin_contactus.php" class="btn btn-primary mt-2">View All Users</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer section -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    
                    <p>At Arya Interior, we specialize in transforming spaces into refined, functional works of art. With a keen eye for detail and a passion for innovative design, we blend aesthetics and practicality to create interiors that truly reflect your vision.</p>
                </div>
                <div class="col-md-3">
                    <h2>Our Location</h2>
                    <div class="list">
                        <a href="#">Navi-Mumbai</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h2>Follow Us</h2>
                    <div class="list">
                        <a href="#">Facebook</a>
                        <a href="#">Instagram</a>
                    </div>
                </div>
                
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the link
            var confirmLogout = confirm('Do you want to log out of the admin panel?');
            if (confirmLogout) {
                window.location.href = this.href; // If confirmed, redirect to the login page
            }
        });
    </script>
</body>
</html>