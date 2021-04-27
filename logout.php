<?php
session_start();
//unset the session
session_unset();
// redirect to same page to remove url paramters
$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
header('Location: index.php');