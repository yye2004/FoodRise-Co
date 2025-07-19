<?php

session_start();

$timeout_duration = 600; 


if (isset($_SESSION['last_activity'])) {
    $elapsed_time = time() - $_SESSION['last_activity'];

    if ($elapsed_time > $timeout_duration) {
        session_unset();
        session_destroy();
        
        // Redirect to login page with a timeout notification
        header("Location: index.php?timeout=1");
        exit();
    }
}

$_SESSION['last_activity'] = time();
?>
