<?php
session_start();
session_destroy();
setcookie("Session", md5("aa" . $txtuser . "bb"), time() - 1);

header("location:index.php");

?>