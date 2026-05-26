<?php
session_start();        
session_unset();        
session_destroy();      

header("Location: /TUMBASO/index.php");
exit;
?>