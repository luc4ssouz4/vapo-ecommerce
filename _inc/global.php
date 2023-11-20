<?php
/** Incluindo configurações */
include_once("_inc/config.php");

try {
    $conn = new PDO("mysql:host="._CONFIG["DB_SERVER"].";dbname="._CONFIG["DB_NAME"], _CONFIG["DB_USER"], _CONFIG["DB_PASS"]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
      die('ERROR: ' . $e->getMessage());
}

/** Sistema de login */
$isLogged = false;
if(isset($_COOKIE['hash'])):   
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE hash = ?");
    $stmt->execute([$_COOKIE['hash']]);
    if($user = $stmt->fetch())
    $isLogged = true;

endif;
DEFINE("LOGADO", $isLogged);

/** Sistema de admin */
if(isset($_GET['admin']) && LOGADO):
    
    if($user['rank'] > 1)
    include("_admin/index.php");

endif;

// CART
$cartCount = 0;
$cart = [];
if(isset($_COOKIE['cart']))
$cart = json_decode($_COOKIE['cart']);
else
setcookie('cart', json_encode($cart), time()+999*999, "/");

foreach($cart as $k => $value){
    $cartCount += $value->qnt;   
}

/** Sistema para a requisicao REST */
if(isset($_GET['ajax'])):
    $pageNameAjax = $_GET['ajax'];

    sleep(0.5);

    if(file_exists("_ajax/{$pageNameAjax}.php"))
    include("_ajax/{$pageNameAjax}.php");

    die();
endif;


/** Sistema de pagina */
if(isset($_GET['page'])):
    $pageName = $_GET['page'];

    if(!LOGADO && in_array($pageName, ["checkout"]))
    $pageName = "profile"; 

    if(!file_exists("_pages/{$pageName}.php"))
    $pageName = 404;    
    
    include("_pages/_parts/header.php");
    include("_pages/{$pageName}.php");
    include("_pages/_parts/footer.php");

endif;

?>