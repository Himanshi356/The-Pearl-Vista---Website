<?php
// admin_logout.php
session_start();
session_unset();
session_destroy();
header('Location: ../../index.html');
exit();
?> 