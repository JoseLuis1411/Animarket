<?php
	require_once("../controlador/controlador.php");
	@session_start();

  //si existe la sesion
  if(isset($_SESSION["nombre"]) ){
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
    <!--Iconos-->
    <script src="https://kit.fontawesome.com/73804f7b43.js" crossorigin="anonymous"></script>
    <!--Alertas-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

      <div class="container-general">
        <div class="item flex-header">
          <div class="logo"></div>
          <ul>
            <li <?php if ($currentPage === 'compras.php') echo 'class="active"'; ?>><a href="compras.php">Compras</a></li>
            <li <?php if ($currentPage === 'historialVentas.php') echo 'class="active"'; ?>><a href="historialVentas.php">Ventas</a></li>
            <li <?php if ($currentPage === 'ayuda.php') echo 'class="active"'; ?>><a href="ayuda.php">Ayuda</a></li>
            <li><a href="javascript:void(0)" onclick="cerrarSesionConfirmacion()"><i class="fa-solid fa-right-from-bracket"></i></a></li>
          </ul>
        </div>
      </div>
    
      <div class="contenedor-general2">
        <div class="item flex-main">
          <h1>Compras</h1>
          <div class="registrar-button"><a  href="registroAnimal.php">Registrar nueva compra</a></div>
          <?php echo $cCompras;  ?>
        </div>
        <div class="piePagina">
          <p>&copy; 2023 Animarket | Todos los derechos reservados</p>
        </div>
      </div>

      <script>

        function cerrarSesionConfirmacion() {

            swal.fire({
                title: "¿Seguro que quieres cerrar sesión?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, cerrar sesion",
                cancelButtonText: "No, cancelar",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirige a la página de cerrar sesión si la confirmación es exitosa
                    window.location.href = '../controlador/cerrarSesion.php';
                }
            });
        }

        function bienvenida(){
          Swal.fire({
          title: "Bienvenido",
          width: 600,
          padding: "3em",
          color: "#716add",
          backdrop: `
            rgba(0,0,123,0.4)
            url("imagenes/gif/puercoCorriendo.gif")
            left top
            no-repeat
          `
        });
        }

    </script>

      <?php 
      if(empty($_SESSION["bienvenida"])) {
        $_SESSION["bienvenida"] = "ya estuvo suavicremas";
        $_SESSION["nuevoRegistro"] = false;
        $_SESSION["nuevoGasto"] = false;
        echo "<script>bienvenida();</script>";
      }
      ?>


    <?php if ($_SESSION["nuevoRegistro"]){ ?>
        <script>          
          const Toast = Swal.mixin({
              toast: true,
              position: "top-end",
              showConfirmButton: false,
              timer: 4000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
              }
            });
            Toast.fire({
              icon: "success",
              title: "Compra registrada exitosamente"
            });
        </script>
      <?php 
          $_SESSION["nuevoRegistro"] = false;
    } ?>


  </body>
</html>