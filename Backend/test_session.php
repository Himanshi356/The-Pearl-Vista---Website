<?php
session_start();
header('Content-Type: application/json');

echo json_encode([
    'session_exists' => isset($_SESSION),
    'user_exists' => isset($_SESSION['user']),
    'role_exists' => isset($_SESSION['role']),
    'user' => $_SESSION['user'] ?? 'not_set',
    'role' => $_SESSION['role'] ?? 'not_set',
    'is_admin' => isset($_SESSION['user']) && in_array($_SESSION['role'], ['admin', 'super_admin', 'manager'])
]);
?> 