<?php
session_start();
include 'config.php';

$error = '';
$success = false;

// Redirect jika user sudah login
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Proses form registrasi saat di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'student';
    
    // Validasi username
    if (empty($username)) {
        $error = "Username cannot be empty";
    } elseif (strlen($username) < 4) {
        $error = "Username must be at least 4 chars";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $error = "Username is already taken";
        }
    }
    
    // Validate password
    if (empty($password)) {
        $error = "Password cannot be empty";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 chars";
    } elseif ($password !== $confirm_password) {
        $error = "Password confirmation doesn't match";
    }
    
    // If validation is successful, insert data into the database
    if (empty($error)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $role);
        
        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = "An error occurred during registration. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <div class="form-container">
            <h1>Create New Account</h1>
            <form method="POST">
                <i class="fas fa-user mr"></i>
                <label for="username">Username</label><br>
                <input type="text" name="username" id="username" required placeholder="Enter Username"><br>

                <i class="fas fa-lock mr"></i>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" required placeholder="Enter Password">

                <i class="fas fa-lock mr"></i>
                <label for="password">Confirm Password</label><br>
                <input type="password" name="confirm_password" id="password" required placeholder="Confirm Password">

                <button type="submit" name="login">
                <i class="fas fa-user-plus mr"></i> Register 
                </button>
                <?php if ($success): ?>
                    <div>Registration successful! Please Login!</p>
                <?php else: ?>
                    <?php if ($error != ''): ?>
                        <div style="color: yellow;"><?php echo $error; ?></div>
                    <?php endif; ?>
                <?php endif; ?>
                <p>Already have an account?
                <a href="login.php" style="color: yellow;"> Login here</a>                
            </form>
        </div>
    </div>
</body>
</html>

