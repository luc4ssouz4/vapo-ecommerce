<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />  
  <title>Vapo Shop</title>    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="shortcut icon" href="<?= _CONFIG['SITE_URL']; ?>/assets/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="<?= _CONFIG['SITE_URL']; ?>/assets/style.css?<?= time(); ?>" />

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="<?= _CONFIG['SITE_URL']; ?>/assets/scripts.js?<?= time(); ?>"></script>

  <!-- snackbar -->
  <link rel="stylesheet" href="<?= _CONFIG['SITE_URL']; ?>/assets/snack/js-snackbar.css?v=1.0.0">
  <script src="<?= _CONFIG['SITE_URL']; ?>/assets/snack/js-snackbar.js?v=1.0.0"></script>

  <script>
    var urlSite = "<?= _CONFIG['SITE_URL']; ?>";
  </script>
</head>
<body>
  <header id="header" class="header">
    <div class="navigation">
      <div class="container">
        <nav class="nav">
          
          <div class="nav__logo">
            <a href="<?= _CONFIG['SITE_URL']; ?>/" class="scroll-link">
              VAPO
            </a>
          </div>

          <div class="nav__icons">
            <a href="<?= _CONFIG['SITE_URL']; ?>/profile" class="icon__item">
            <i class="fa-solid fa-user"></i>
            </a>

            <a href="#" class="icon__item" id="cart-btn">
            <i class="fa-solid fa-cart-shopping"></i>
              <span id="cart__total">0</span>
            </a>
          </div>
        </nav>
      </div>
    </div>   
</header>