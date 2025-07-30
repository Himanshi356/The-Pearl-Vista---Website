<?php
// check_admin_session.php
session_start();
if (isset($_SESSION['admin_id'])) {
    echo json_encode([
        'logged_in' => true,
        'admin_id' => $_SESSION['admin_id'],
        'admin_name' => $_SESSION['admin_name'],
        'admin_role' => $_SESSION['admin_role']
    ]);
} else {
    echo json_encode(['logged_in' => false]);
} 