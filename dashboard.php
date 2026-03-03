<?php
session_start();

// AUTHENTICATION RULE: Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from POST
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    
    // Validate
    if(empty($name) || empty($email)) {
        $_SESSION['error'] = "All fields are required!";
       header("Location: form.php");
        exit();
    }
    
    // Store in SESSION
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    
    // Store in COOKIE (remember name for 24 hours)
    setcookie("user_name", $name, time() + 86400); // 24 hours
    
} else {
    // If NOT POST request, check if session exists
    if (!isset($_SESSION['name']) || !isset($_SESSION['email'])) {
        // DIRECT ACCESS ATTEMPT - Redirect to form
        header("Location: form.php");
        exit();
    }
}

// If we get here, user is authenticated
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$cookie_name = $_COOKIE['user_name'] ?? 'No cookie set';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="welcome-card">
            <h2>🎉 Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
            <p>You have successfully logged in to your dashboard.</p>
        </div>
        
        <div class="info-card">
            <h3>📋 Session Data (Server-side)</h3>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
            <p><strong>Session ID:</strong> <?php echo session_id(); ?></p>
        </div>
        
        <div class="cookie-card">
            <h3>🍪 Cookie Data (Browser-side)</h3>
            <p><strong>Remembered Name:</strong> <?php echo htmlspecialchars($cookie_name); ?></p>
            <p><strong>Cookie Expires:</strong> <?php echo date('Y-m-d H:i:s', time() + 86400); ?></p>
        </div>
        
        <div class="text-center">
            <a href="logout.php" class="logout-btn">🚪 Logout</a>
        </div>
        
        <p class="text-center mt-20">
            <small>Try typing <strong>dashboard.php</strong> directly in URL - you'll be redirected!</small>
        </p>
    </div>
</body>
</html> 
