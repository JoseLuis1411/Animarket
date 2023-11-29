<?php
	require_once("../controlador/controlador.php");
	@session_start();

  //si existe la sesion
  if(isset($_SESSION["nombre"]) ){
  
    //si no destrulle la sesion
  }else{
    session_destroy();
    echo "<script>alert('no has iniciado sesión');
    window.location.href='login.html'; 
    </script>";
  }
  //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::Corregir la ruta login
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar compra</title>
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
      <div class="contenedor-registroAnimal" >
          <img id="imagenAnimal" src="imagenes/animales/signoInterrogacion.png" alt="">
          <div class="contenedorFormulario-registroAnimal">
            <h2>Registrar Animal</h2>
            <form id="formularioRegistroCompra" action="../controlador/guardarAnimal.php" method="post" >

                <label for="animal">¿Que animal registraras?</label>
                <select name="animal" id="animal" onchange="cambiarImagen()" required>
                  <option value="">Selecciona un animal</option>
                  <option value="1">Vaca</option>
                  <option value="2">Cerdo</option>
                  <option value="3">Pollo / Gallina</option>
                  <option value="4">Chiva</option>
                  <option value="5">Borrego</option>
                </select>

                <label for="hembras">Hembras</label>
                <input id="hembras" name="hembras" type="number"placeholder="Numero de hembras" required 
                min="1" pattern="[0-9]+" title="Ingresa solo numeros" />

                <label for="machos">Machos</label>
                <input id="machos" name="machos" type="number"placeholder="Numero de machos" required 
                min="1" title="Ingresa solo numeros" />

                <label for="peso">Peso (kg)</label>
                <input id="peso" name="peso" type="number" step="0.01" placeholder="Peso en kilos"
                value="0" min="0" title="Ingresa solo numeros" />

                <label for="precio">Precio</label>
                <input id="precio" name="precio" type="number" step="0.01" placeholder="Precio en pesos*" required 
                value="0" min="1" pattern="[0-9]+" title="Ingresa solo numeros" />

                <label for="genetica">Genetica (opcional)</label>
                <input id="genetica" name="genetica" type="number"placeholder="Genetica del especimen"
                value="0" pattern="[0-9]+" title="Ingresa solo numeros" />

                <label for="raza">Raza (opcional)</label>
                <input id="raza" name="raza" type="text" placeholder="Raza del especimen" maxlength="20" 
                pattern="[a-z A-Z]*[a-z]" title="No ingresar numeros, simbolos o cadenas mayores a 20 ceracteres" />

                <button>REGISTRAR COMPRA</button>
                
            </form>
          </div>  
          <a class="buttonRegresar" href="compras.php"><i class="fa-solid fa-arrow-left"></i></a>
      </div>
      <div class="piePagina">
        <p>&copy; 2023 Animarket | Todos los derechos reservados</p>
      </div>
    </div>

    <script>
        function cambiarImagen() {
            // Obtén el valor seleccionado del select
            var seleccion = document.getElementById("animal");
            var valorSeleccionado = seleccion.options[seleccion.selectedIndex].value;

            // Construye la ruta de la imagen basada en el valor seleccionado
            var rutaImagen = "imagenes/animales/";
            switch (valorSeleccionado) {
                case "1":
                    rutaImagen += "vaca.jpg";
                    break;
                case "2":
                    rutaImagen += "puerco.png";
                    break;
                case "3":
                    rutaImagen += "gallina.png";
                    break;
                case "4":
                    rutaImagen += "chiva.png";
                    break;
                case "5":
                    rutaImagen += "borrego.png";
                    break;
                default:
                    // Si no se selecciona nada, muestra la imagen predeterminada
                    rutaImagen += "signoInterrogacion.png";
            }

            // Cambia la fuente de la imagen
            document.getElementById("imagenAnimal").src = rutaImagen;
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
</body>
</html>