<?php
include "../classes/db.php";

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_unset();
session_destroy();
header('location:'.$urlServer.'home?data='.microtime().'&strings=you have loged out!');
?>
