<?php
if(!isset($_COOKIE['cart']))
setcookie('cart', json_encode([]), time()+999*999, "/");
# VAPO - 19/10 #
if(!isset($_GET['page']))
$_GET['page'] = "home";

include_once("_inc/global.php");
?>