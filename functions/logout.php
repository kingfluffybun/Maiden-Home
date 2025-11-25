<?php
session_start();

$_SESSION = array();

session_destroy();

setCookie("user_id", "", time() - 3600, "/");
setcookie("username", "", time() - 3600, "/");
setcookie("user_email", "", time() - 3600, "/");
setcookie("role", "", time() - 3600, "/");

header("Location: /Maiden-Home/login/");
exit;