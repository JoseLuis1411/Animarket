<?php
	require_once("../controlador/controlador.php");
	@session_start();

  //si existe la sesion
  if(isset($_SESSION["nombre"]) ){

    if(empty($_SESSION["bienvenida"])) {
      $_SESSION["bienvenida"] = "ya estuvo suavicremas";
      echo "<script>alert('Bienvenido');
      </script>";
    }

    $cCompras = c_Compras();
  
    //si no destrulle la sesion
  }else{
    session_destroy();
    echo "<script>alert('no has iniciado sesión');
    window.location.href='login.html'; 
    </script>";
  }
  
  $currentPage = basename($_SERVER['PHP_SELF']); // Obtiene el nombre del archivo actual
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>
    <link rel="stylesheet" href="css/styleGeneral.css">
    <script src="https://kit.fontawesome.com/73804f7b43.js" crossorigin="anonymous"></script>

</head>
<body>

      <div class="container-general">
        <div class="item flex-header">
          <div class="logo"></div>
          <ul>
            <li <?php if ($currentPage === 'compras.php') echo 'class="active"'; ?>><a href="compras.php">Compras</a></li>
            <li <?php if ($currentPage === 'historialVentas.php') echo 'class="active"'; ?>><a href="historialVentas.php">Ventas</a></li>
            <li <?php if ($currentPage === 'ayuda.php') echo 'class="active"'; ?>><a href="ayuda.php">Ayuda</a></li>
            <li><a href="../controlador/cerrarSesion.php"><i class="fa-solid fa-right-from-bracket"></i></a></li>
          </ul>
        </div>
      </div>
    
      <div class="contenedor-general2">
        <div class="item flex-main">
          <h1>Compras</h1>
          <div class="registrar-button"><a  href="registroAnimal.html">Registrar nueva compra</a></div>
          <?php echo $cCompras;  ?>
        </div>
      </div>

  </body>
</html>