<?php
session_start();
session_unset();
sessions_destroy();

header("Location: index.php");
exit();
?>