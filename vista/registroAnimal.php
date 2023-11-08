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
    <!--link rel="stylesheet" href="css/styleLoginRegistro.css"-->
    <title>Login</title>
</head>
<body>
    <div >
        <div >
            <h2>Registro Animal</h2>
            <form action="../controlador/guardarAnimal.php" method="post" >
                
                <label>Animal<label>
                <input id="animal" name="animal" type="number"placeholder="¿Que animal registraras?*" required 
                min="1" pattern="[0-9]+" title="Ingresa solo numeros" />

                <label>Hembras<label>
                <input id="hembras" name="hembras" type="number"placeholder="Numero de hembras*" required 
                min="1" pattern="[0-9]+" title="Ingresa solo numeros" />

                <label>Machos<label>
                <input id="machos" name="machos" type="number"placeholder="Numero de machos*" required 
                min="1" title="Ingresa solo numeros" />

                <label>Peso<label>
                <input id="peso" name="peso" type="number" step="0.01" placeholder="Peso en kilos"
                value="0" min="0" title="Ingresa solo numeros" />

                <label>Precio<label>
                <input id="precio" name="precio" type="number" step="0.01" placeholder="Precio en pesos*" required 
                value="0" min="1" pattern="[0-9]+" title="Ingresa solo numeros" />

                <label>Genetica<label>
                <input id="genetica" name="genetica" type="number"placeholder="Genetica del especimen"
                value="0" pattern="[0-9]+" title="Ingresa solo numeros" />

                <label>Raza<label>
                <input id="raza" name="raza" type="text" placeholder="Raza del especimen" maxlength="20" 
                pattern="[a-z A-Z]*[a-z]" title="No ingresar numeros, simbolos o cadenas mayores a 20 ceracteres" />

                <button>Registrar</button>
                
            </form>
            <a href="compras.php">Regresar</a>

        </div>
    </div>

</body>
</html>