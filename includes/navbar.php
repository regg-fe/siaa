<head>
  <title>SIAA: <?php echo $title ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="assets\plugins\Bootstrap-CSS\bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" type="text/css" href="assets\plugins\FontAwesome\css\all.min.css">
    <link rel="stylesheet" type="text/css" href="assets\plugins\FontAwesome\css\fontawesome.min.css">
    <!-- JQUERY -->
    <script type="text/javascript" src="assets\libs\jquery.js"></script>
    <!-- Bootstrap JS -->
    <script type="text/javascript" src="assets\plugins\Bootstrap-JS\bootstrap.bundle.min.js"></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

</head>
<body>
  <!-- BARRA DE NAV </!-->
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="home.php">SIAA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0"> 
        <li class="nav-item">
          <a class="nav-link active" href="home.php">Actividades</a>
        </li>
        <!-- ADMINISTRADOR </!-->
        <?php if ($_SESSION['admin'] == 1):?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="users.php">Usuarios</a>
          </li>
        <?php endif; ?>
        <!-- ADMINISTRADOR </!-->
      </ul>
      <ul class="navbar-nav me-left mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link disable">©INGS22</a>
        </li> 
        <a class="nav-link active" href="exit.php">Cerrar Sesion</a>
      </ul>
    </div>
  </div>
</nav>