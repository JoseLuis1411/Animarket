<?php
	require_once("../controlador/controlador.php");
	@session_start();

  //si existe la sesion
  if(isset($_SESSION["nombre"])){

    $compra = $_GET['ID'];
    list($tabla, $IdCompraAnimal) = c_Animales($compra);
    //$cAnimales = c_Animales($compra);
  
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
    <h1>Animales</h1>
    <button><a href="registrarGastos.php?IdCompraAnimal=<?php echo $IdCompraAnimal ?>">Agregar en todos los gastos</a></button>
        <section class="section">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                  <div class="bg-white p-4">
                    <table class="table">
                      <thead>
                        <tr class="" style="background: #C0F6F0; color:#000;">
                          <th class="text_center">Codigo </th>
                          <th class="text_center">Animal</th>
                          <th class="text_center">Raza</th>
                          <th class="text_center">Sexo </th>
                          <th class="text_center">Genetica</th>
                          <th class="text_center">Fecha Compa</th>
                          <th class="text_center">Peso Compra</th>
                          <th class="text_center">Precio Compa</th>
                          <th class="text_center">Gasto en comida</th>
                          <th class="text_center">Gasto en agua </th>
                          <th class="text_center">Gasto en medicina</th>
                          <th class="text_center">Gasto en veterinario</th>
                          <th class="text_center">Gasto en transporte</th>
                          <th class="text_center">Otros gastos</th>
                          <th class="text_center">Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php echo $tabla; ?>
                      </tbody>
                    </table>
                  </div>  
            </div>
        </section>

        <a href="compras.php">Regresar</a>
</body>
</html>