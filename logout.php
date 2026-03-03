<?php
session_start();

// Destroy session
session_unset();
session_destroy();

// Remove cookie (set to expire in the past)
setcookie("user_name", "", time() - 3600);

// Redirect to form
header("Location: form.php");
exit();
?>