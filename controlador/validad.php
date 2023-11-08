<?php
    @session_start();
    require_once("../modelo/modelo.php");

    $cont = $_POST['contraseña'];

    $pass = hash("sha512", $cont);



    $params = array (
        "correo"=>$_POST['correo'],
        "pass"=>$pass,
    );

    //print_r ($params); die ();  

    //instacia y coneccion bd

    $db = Database::getInstance(); //bd
    $conn = $db->getConnection();   //bd
    $sesion = new Modelo($conn);

    //llamar a la funcion validaUsuario
    list ($valor, $error) = $sesion->validaUsuario( $params );
    if ( empty($valor)){
        echo "<script>alert('El usuario o la contraseña son incorrectos');
        window.location.href='../vista/login.html';
        </script>";
    } 
    else{
        
        header("location:../vista/compras.php");
        
    }
?>