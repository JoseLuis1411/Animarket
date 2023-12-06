<?php
	require_once("../controlador/controlador.php");
	@session_start();

  //si existe la sesion
  if(isset($_SESSION["nombre"]) ){

    //Dependiendo de donde entran a la pagina le damos un valor a la variable ir para cmabiar el contenido de la pagina
    if(isset($_GET["IdCompraAnimal"]) || isset($_GET["IdGastoAnimal"])){
        if(isset($_GET["IdCompraAnimal"])){
            $ir = 1; 
        } 

        if (isset($_GET["IdGastoAnimal"])) {
            $ir = 2;
        } 

    } else {
        echo "<script>alert('Por favor ingresa desde donde corresponde');
        window.location.href='compras.php';
        </script>"; 
    }
  
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
    <title>Registrar datos</title>
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
            <li><a href="compras.php">Compras</a></li>
            <li><a href="historialVentas.php">Ventas</a></li>
            <li><a href="ayuda.php">Ayuda</a></li>
            <li><a href="javascript:void(0)" onclick="cerrarSesionConfirmacion()"><i class="fa-solid fa-right-from-bracket"></i></a></li>
            </ul>
        </div>
    </div>
    
    <div class="contenedor-general2">
        <div class="contenedor-registroGastos">
            <div class="contenedorFormulario-registroGastos">

                <h2>Registro de gastos adicionales <?php echo ($ir == 1)?" en grupo":" individuales"; ?></h2>
                <form action="../controlador/registrarGastos.php" method="POST">
                    
                    <!-- Envia cierto id dependiendo de por donde haya entrado a formulario-->
                    <input type="number" name="id" id="id" value="<?php echo ($ir == 1)? $_GET['IdCompraAnimal']: $_GET["IdGastoAnimal"];  ?>" hidden>

                    <label for="comida">Gasto de comida</label>
                    <input type="number" name="comida" id="comida" value="0">
                    
                    <label for="agua">Gasto de agua</label>
                    <input type="number" name="agua" id="agua" value="0">

                    <label for="medicina">Gasto de medicina</label>
                    <input type="number" name="medicina" id="medicina" value="0">

                    <label for="veterinario">Gasto de veterinario</label>
                    <input type="number" name="veterinario" id="veterinario" value="0">

                    <label for="transporte">Gasto de transporte</label>
                    <input type="number" name="transporte" id="transporte" value="0">

                    <label for="otros">Otros gastos</label>
                    <input type="number" name="otros" id="otros" value="0">

                    <!-- Si es una insercion en grupo se agrega este campo -->
                    <?php if ($ir == 1) { ?>
                        <label for="repartir">Selecciona el modo de registrar los gastos</label>
                        <select name="repartir" id="repartir" required>
                            <option value="todosIgual">Darle a todos los registros de la compra el valor ingresado</option>
                            <option value="entreTodos">Repartir los valores ingresados entre todos los registros de la compra</option>
                        </select>
                    <?php } ?>

                    <button>Registrar</button>

                </form>
            </div>
            <a class="buttonRegresar" onclick="retroceder();"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <div class="piePagina">
            <p>&copy; 2023 Animarket | Todos los derechos reservados</p>
        </div>
    </div>


    <script type='text/javascript'>
        function retroceder() {
            window.history.back(-1);
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

</body>
</html>