<?php

    @session_start();
    require_once("../modelo/modelo.php");

    //se crea una variable que recibira la contraseña que se ingreso en el formulario con el metodo POST
    $clave = $_POST ['contraseña'];

        //Viendo si lo que llego cumple con todo
        $_SESSION["error_clave"] = NULL;

        if(strlen($clave) < 8){
        $_SESSION["error_clave"] = "La clave debe tener al menos 8 caracteres";
        }
        if(strlen($clave) > 16){
        $_SESSION["error_clave"] = "La clave no puede tener más de 16 caracteres";
        }
        if (!preg_match('`[a-z]`',$clave)){
        $_SESSION["error_clave"] = "La clave debe tener al menos una letra minúscula";
        }
        if (!preg_match('`[A-Z]`',$clave)){
        $_SESSION["error_clave"] = "La clave debe tener al menos una letra mayúscula";
        }
        if (!preg_match('`[0-9]`',$clave)){
        $_SESSION["error_clave"] = "La clave debe tener al menos un caracter numérico";
        }
        
        //Si hubo algun error lo mandamos de nuevo a que lo corrija
        if($_SESSION["error_clave"] != NULL){
            echo "<script>alert('Por favor ingresa una contraseña valida.');
            window.history.back();
            </script>";
            exit();
        }

  
    //se crea una nueva variable para encritar la contraseña que se guardo el la variable de arriba
    $contra = hash("sha512", $clave);

    /*se hace el mismo paso de arriba pero con la contraseña que puso el campo para validar para compararlas 
    y si coinciden hacer el insert a la BD
    */

    
    $valCon = $_POST['valcontraseña'];

    $valC = hash("sha512", $valCon);

    $params = array (
        "correo" => $_POST ['correo'],
        "nombre" => $_POST ['nombre'],
        "ap1" => $_POST ['ap1'],
        "ap2" => $_POST ['ap2'],    
        //se guada la variable con la contraseña encritada en el arreglo para madarla al modelo 
        "contra" => $contra,
        "valc" => $valC,
    );
// print_r($params)

    	//instancia y conexion bd
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $sesion = new Modelo($conn);
        
    
        //llamar a la funcion 'agregausuario'
        list ($valor, $error) = $sesion->agregaUsuario( $params );
        if ( empty( $valor ) ){
            
            if($error == "d"){
                echo "<script>alert('Usuario duplicado, vuelva a intentar');
                history.go(-1);
                </script>";
                 
            //history.go(-1); si te da un error te regresa al formulario para que se corriga pero los campos no se borran

           //si error el igual a no las contraseñas no coinciden y debe corregirlas e ingresarlas nuevamente para registrarse
            }else if($error == "n"){
                echo "<script>alert('Las contraseñas no coinciden, revisalas');
                history.go(-1);
                </script>";
            }
            else{
                echo "<script>alert('Ocurrió un error al hacer el registro');
                window.location.href='../vista/registro.html';
                history.go(-1);
                </script>";   			
            }
                           
        } else {
            echo "<script>alert('Su usuario fue registrado exitosamente');
            window.location.href='../Vista/login.html';
            </script>";
        }
?>
