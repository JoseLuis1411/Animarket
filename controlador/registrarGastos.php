<?php
@session_start();
    require_once("../modelo/modelo.php");

    if($_POST){
        $params = array (
            "id" => $_POST ['id'],
            "comida" => $_POST ['comida'],
            "agua" => $_POST ['agua'],
            "medicina" => $_POST ['medicina'],
            "veterinario" => $_POST ['veterinario'],
            "transporte" => $_POST ['transporte'],   
            "otros" => $_POST ['otros'], 
            "repartir" => NULL, 

        );

        //Si se recibio repartir cambia el valor, si no permanece nulo
        if(isset($_POST ['repartir'])){
            $params["repartir"] = $_POST ['repartir'];
        }

    	//instancia y conexion bd
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $sesion = new Modelo($conn);
        
    
        //llamar a la funcion 'agregaAnimal'
        list ($valor, $error) = $sesion->agregarGastos($params);
        if ( !empty( $error ) )
        {             
            echo "<script>alert('Ocurrió un error al hacer el registro de gastos');
            history.go(-1);
            </script>";   			                          
        } 
        else 
        {
            echo "<script>alert('Registro de gastos exitoso');
            history.go(-2);
            </script>";
        }
    } else {
        echo "<script>alert('Error de acceso');
        window.location.href='../Vista/login.html';
        </script>";
    }
?>