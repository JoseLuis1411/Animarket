<?php

    @session_start();
    require_once("../modelo/modelo.php");

    $params = array (

        "animal" => $_POST ['animal'],
        "hembras" => $_POST ['hembras'],
        "machos" => $_POST ['machos'],
        "peso" => $_POST ['peso'],
        "precio" => $_POST ['precio'],   
        "genetica" => $_POST ['genetica'], 
        "raza" => $_POST ['raza'], 

    );
//para ver que si traigamos algo en el arreglo de las variables 
// print_r($params)


    	//instancia y conexion bd
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $sesion = new Modelo($conn);
        
    
        //llamar a la funcion 'agregaAnimal'
        list ($valor, $error) = $sesion->agregaAnimal( $params, $conn );
        if ( empty( $valor ) )
        {             
            echo "<script>alert('Ocurrió un error al hacer el registro');
            window.location.href='../vista/registroAnimal.html';
            history.go(-1);
            </script>";   			                          
        } 
        else 
        {
            echo "<script>alert('Registro exitoso');
            window.location.href='../Vista/compras.php  ';
            </script>";
        }
?>
