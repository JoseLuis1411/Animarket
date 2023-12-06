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
    <title>Animales</title>
    <!-- Agrega las referencias a Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/styleGeneral.css">
    
    <!--Iconos-->
    <script src="https://kit.fontawesome.com/73804f7b43.js" crossorigin="anonymous"></script>
    <!--Alertas-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>
<body>
    <!-- Contenido personalizado, aqui no le afecta boostrap -->
    <div class="container-general">
        <div class="item flex-header">
            <div class="logo"></div>
            <ul>
            <li><a href="compras.php">Compras</a></li>
            <li><a href="historialVentas.php">Ventas</a></li>
            <li><a href="ayuda.php">Ayuda</a></li>
            <li><a href="javascript:void(0)" onclick="cerrarSesionConfirmacion()"><i class="fa-solid fa-right-from-bracket"></i></a></li>
            </ul>
        </div>
    </div>

      <div class="contenedor-general2">
        <div class="contenedor-Animales">
            <h1>Animales</h1>
            <a class="button" href="registrarGastos.php?IdCompraAnimal=<?php echo $IdCompraAnimal ?>">Agregar en todos los gastos</a>
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
                  <th class="text_center">Gastos</th>
                  <th  class="text_center">Accion</th>
                </tr>
              </thead>
              <tbody>
                <?php echo $tabla; ?>
              </tbody>
            </table>
          <a class="buttonRegresar" href="compras.php"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="piePagina">
            <p>&copy; 2023 Animarket | Todos los derechos reservados</p>
        </div>


        <!-- Large modal -->
        <div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="contenedorFormulario-registroGastos">
              <h2 id="titulo" > </h2>
              <form class="mostrarGastos" action="../controlador/registrarGastos.php" method="POST">
                  
                  <div class="grupo"> 
                    <label for="comida">Gasto de comida</label>
                    <input type="number" name="comida" id="comida" value="0" disabled>
                  </div>

                  <div class="grupo"> 
                    <label for="agua">Gasto de agua</label>
                    <input type="number" name="agua" id="agua" value="0" disabled>
                  </div>

                  <div class="grupo"> 
                    <label for="medicina">Gasto de medicina</label>
                    <input type="number" name="medicina" id="medicina" value="0" disabled>
                  </div>

                  <div class="grupo"> 
                    <label for="veterinario">Gasto de veterinario</label>
                    <input type="number" name="veterinario" id="veterinario" value="0" disabled>
                  </div>

                  <div class="grupo"> 
                    <label for="transporte">Gasto de transporte</label>
                    <input type="number" name="transporte" id="transporte" value="0" disabled>
                  </div>

                  <div class="grupo"> 
                    <label for="otros">Otros gastos</label>
                    <input type="number" name="otros" id="otros" value="0" disabled>
                  </div>


              </form>
            </div>
            </div>
          </div>
        </div>

      </div>


      <!-- Script para abrir el modal -->
      <script>
        function abrirModalGastos(valor, comida, agua, medicina, veterinario, transporte, otros) {
          $('#modal').modal('show');
        
          // Coloca el valor en el contenido del modal
          document.getElementById('titulo').innerText = 'Gastos del registro: ' + valor;

          var miComida = document.getElementById('comida');
          var miAgua = document.getElementById('agua');
          var miMedicina = document.getElementById('medicina');
          var miVeterinario = document.getElementById('veterinario');
          var miTransporte = document.getElementById('transporte');
          var miOtros = document.getElementById('otros');

          miComida.value = comida;
          miAgua.value = agua;
          miMedicina.value = medicina;
          miVeterinario.value = veterinario;
          miTransporte.value = transporte;
          miOtros.value = otros;

        }
        
      </script>


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

        <?php if ($_SESSION["nuevoGasto"]){ ?>
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
              title: "Gastos registrados exitosamente"
            });
        </script>
        <?php 
          $_SESSION["nuevoGasto"] = false;
        } ?>
</body>
</html>