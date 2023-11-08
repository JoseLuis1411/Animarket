<?php
	require_once("../controlador/controlador.php");
	@session_start();

  //si existe la sesion
  if(isset($_SESSION["nombre"])){

    $compra = $_GET['ID'];


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
    <title>Compra</title>
</head>
<body>
    <h2>Seguro que vendiste toda esta compra ?</h2>

    <button><a href="../controlador/venderCompra.php?Id=<?php echo $compra ?>">SI</a></button>
    <button><a href="compras">No</a></button>


</body>
</html>