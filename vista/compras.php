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
    window.location.href='login.php'; 
    </script>";
  }
  //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::Corregir la ruta login
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Compras</h1>
    <button><a href="../controlador/cerrarSesion.php">Cerrar sesion</a></button>
        <section class="section">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                  <div class="bg-white p-4">
                    <table class="table">
                      <thead>
                        <tr class="" style="background: #C0F6F0; color:#000;">
                          <th class="text_center">Animal</th>
                          <th class="text_center">Fecha de Compra</th>
                          <th class="text_center">Ver Animales</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php echo $cCompras; ?>
                      </tbody>
                    </table>
                  </div>  
            </div>
        </section>

        <a href="registroAnimal.html">Regístrato Animal</a>
</body>
</html>