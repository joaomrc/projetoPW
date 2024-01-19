<?php
$_COOKIE['username'] = "";
setcookie('username', "", time() - 1, "/");
unset($_COOKIE['username']);
header('location: index.php?');
?>