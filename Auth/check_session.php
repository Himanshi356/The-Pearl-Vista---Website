<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['user'])) {
    echo json_encode([
        'loggedIn' => true,
        'user_id' => $_SESSION['user']
    ]);
} else {
    echo json_encode([
        'loggedIn' => false
    ]);
}
?> 