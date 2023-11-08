<?php

    @session_start();
    require_once("../modelo/modelo.php");

    $id = $_GET['Id'];

    $params = array (
        "id" => $id
    );
//para ver que si traigamos algo en el arreglo de las variables 
// print_r($params)


    	//instancia y conexion bd
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $sesion = new Modelo($conn);
        
    
        //llamar a la funcion 'agregaAnimal'
        list ($valor, $error) = $sesion->vendeCompra( $params );
        if ( empty( $valor ) )
        {             
            echo "<script>alert('Ocurrió un error al actualizar los datos');
            window.location.href='../vista/ventaCompra.php';
            history.go(-1);
            </script>";   			                          
        } 
        else 
        {
            echo "<script>alert('Datos guardados con exito');
            window.location.href='../Vista/compras.php  ';
            </script>";
        }
?>
