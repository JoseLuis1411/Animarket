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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histoeial ventas</title>
</head>
<body>
    <h1>Histial Ventas</h1>
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
                        <?php echo $cVentas; ?>
                      </tbody>
                    </table>
                  </div>  
            </div>
        </section>
        <a href="compras.php">Regresar</a>

</body>
</html>