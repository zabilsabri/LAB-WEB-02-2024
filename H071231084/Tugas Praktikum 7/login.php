<?php
session_start();
include 'config.php';

function setupAdmin($conn) {       
    $check = $conn->query("SELECT * FROM users WHERE username = 'admin'");
    
    if ($check->num_rows == 0) {
        $admin_username = 'admin';
        $admin_password = 'admin123';
        $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
        $role = 'admin';
        
        $query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $admin_username, $hashed_password, $role);
        $stmt->execute();
        
        return [
            'username' => $admin_username,
            'password' => $admin_password
        ];
    }
    return null;
}

$adminCreated = setupAdmin($conn);

if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
   
    if(empty($username) || empty($password)) {
        $error = "Please enter your username and password";
    } else {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
       
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header("Location: index.php");
                exit();
            } else {
                $error = "Incorrect password!";
            }
        } else {
            $error = "Username not found!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="login.css" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <div class="form-container">
            <h1>Log In to <br> Your Account</h1>
            <form method="POST">
                <i class="fas fa-user mr" ></i>
                <label for="username">Username</label><br>
                <input type="text" name="username" id="username" required placeholder="Enter Username"><br>

                <i class="fas fa-lock mr"></i>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password"  required placeholder="Enter Password">

                <button type="submit">
                <i class="fas fa-sign-in-alt mr"></i>Log In
                </button>
                
                <?php if ($error != ''): ?>
                <div style="color: yellow;"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <p>Don't have an account?
                <a href="register.php" style="color: yellow;"> Register here</a>
            </form>
        </div>
    </div>
</body>

</html>