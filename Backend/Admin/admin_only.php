<?php
session_start();
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_role']) || !in_array($_SESSION['admin_role'], ['admin', 'super_admin', 'manager'])) {
    http_response_code(403);
    echo json_encode(["error" => "Admin access only"]);
    exit;
}
