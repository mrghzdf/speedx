<?php
session_start();
session_unset();
session_destroy();
echo "<script>document.location = '../../../index.php';</script>";
?>