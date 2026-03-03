<?php
session_start();

// Get cookie value if exists
$saved_name = $_COOKIE['user_name'] ?? '';

// Check if there's an error message
$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>🔐 Login Form</h2>
        
        <?php if($error != ""): ?>
            <div class="error">⚠️ <?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="dashboard.php">
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($saved_name); ?>" placeholder="Enter your name" required>
            </div>
            
            <div class="form-group">
                <label>Email Address:</label>
                <input type="email" name="email" placeholder="your@email.com" required>
            </div>
            
            <button type="submit">Login to Dashboard</button>
        </form>
    </div>
</body>
</html>