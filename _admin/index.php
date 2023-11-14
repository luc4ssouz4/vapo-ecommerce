<?php
/** Sistema de pagina de admin */
if(isset($_GET['admin'])):
    $pageName = $_GET['admin'];    
        
    include("_admin/_pages/_parts/header.php");
    if(file_exists("_admin/_pages/{$pageName}.php"))
    include("_admin/_pages/{$pageName}.php");       
    include("_admin/_pages/_parts/footer.php");

    die();
endif;
?>