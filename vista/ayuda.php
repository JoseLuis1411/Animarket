<?php
	require_once("../controlador/controlador.php");
	@session_start();

    //si existe la sesion
    if(isset($_SESSION["nombre"])){
        $cVentas = c_Ventas();

    }else{
        session_destroy();
        echo "<script>alert('no has iniciado sesión');
        window.location.href='login.html'; 
        </script>";
    }
    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    $currentPage = basename($_SERVER['PHP_SELF']); // Obtiene el nombre del archivo actual

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial ventas</title>
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

    </script>

</body>
</html>