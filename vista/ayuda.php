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

      <div class="contenedor-general2">
        <div class="contenedor-ayuda">
            <h1>Preguntas frecuentes</h1>
            <div class="botones">
              <button class="boton" onclick="mostrarContenido('contenido1')">General</button>
              <button class="boton" onclick="mostrarContenido('contenido2')">Funcionalidad</button>
              <button class="boton" onclick="mostrarContenido('contenido3')">Dinero</button>
            </div>

            <div id="contenido1" class="contenido">
              <div class="contenedor-preguntas">
                <details>
                  <summary>1¿Como registrar un animal?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>
                <details>
                  <summary>¿Como se divide la funcionalidad?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>
                <details>
                  <summary>¿En que consiste la funcion de registrar gastos?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>
                <details>
                  <summary>¿Como registrar un animal?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>
                <details>
                  <summary>¿Como se divide la funcionalidad?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>
                <details>
                  <summary>¿En que consiste la funcion de registrar gastos?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>
              </div>
            </div>

            <div id="contenido2" class="contenido">
              <div class="contenedor-preguntas">
                <details>
                  <summary>2¿Como registrar un animal?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>
                <details>
                  <summary>¿Como se divide la funcionalidad?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>
                <details>
                  <summary>¿En que consiste la funcion de registrar gastos?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>
                <details>
                  <summary>¿Como registrar un animal?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>

              </div>
            </div>

            <div id="contenido3" class="contenido">
              <div class="contenedor-preguntas">
                <details>
                  <summary>3¿Como registrar un animal?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>
                <details>
                  <summary>¿Como se divide la funcionalidad?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>
                <details>
                  <summary>¿En que consiste la funcion de registrar gastos?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>
                <details>
                  <summary>¿Como registrar un animal?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>
                <details>
                  <summary>¿Como se divide la funcionalidad?</summary>
                  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Obcaecati ipsam natus architecto ea ad! Culpa cumque corporis, facilis doloremque aliquid quisquam sapiente molestias. Officia dolore eos quae possimus sint voluptatum?</p>
                </details>

              </div>
            </div>
        </div>
        <div class="piePagina">
          <p>&copy; 2023 Animarket | Todos los derechos reservados</p>
        </div>
      </div>

      


      <script>
        function mostrarContenido(idContenido) {
          // Oculta todos los contenidos
          var contenidos = document.getElementsByClassName('contenido');
          for (var i = 0; i < contenidos.length; i++) {
              contenidos[i].style.display = 'none';
          }

          // Desactiva todos los botones
          var botones = document.getElementsByClassName('boton');
          for (var i = 0; i < botones.length; i++) {
              botones[i].classList.remove('activo');
          }

          // Muestra el contenido correspondiente
          document.getElementById(idContenido).style.display = 'block';

          // Activa el botón clicado  
          event.currentTarget.classList.add('activo');
        }

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