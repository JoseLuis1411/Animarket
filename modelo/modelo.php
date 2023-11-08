<?php
    require_once("../controlador/conexion.php");
	require_once("../controlador/controlador.php");

    class Modelo{

        private $conn;
		
		function __construct( $conexion ){
			$this->conn = $conexion;
		}

		function select( $consulta ){ 
		    $this->total_consultas++;
		    $resultado = mysqli_query($this->conn, $consulta);
		    if(!$resultado){ 
		    	$error = 'MySQL Error: ' . mysqli_connect_error();
		    	
		    }
		    return $resultado;
		}
		
		function mostrarTablas( ){
			$sqlTablas = "SELECT TABLE_NAME as 'tabla' FROM INFORMATION_SCHEMA.tables ";
			$sqlTablas .= "WHERE TABLE_SCHEMA='sistema_archivos'";
			//Se ejecuta la consulta
			$resTablas = mysqli_query($this->conn, $sqlTablas);
			if( !$resTablas ){ 
		    	$error = 'MySQL Error: ' . mysqli_connect_error();
		    	$alert = 'danger';
			}
			$resultado = array();
			while($row = mysqli_fetch_array($resTablas))
			{
				$resultado[] = $row['tabla'];
			}
			return $resultado;
		}
		//-----------------------------------------------

        function agregaUsuario( $params ){
			$error = "";
			$valor = "";
            $correo = $params["correo"];
			$nombre = $params["nombre"];
			$ap1 = $params["ap1"];
			$ap2 = $params["ap2"];
			//se recibe la contraseña encriptada
			$pass = $params["contra"];
			$valpass = $params["valc"];


			/*
			if donde se compara que las dos contraseñas que ingreso sean iguales si es asi entra y valida que no se repetido el correo 
			o el usuario y registra al usuario
			*/
			if($pass == $valpass){

				//para hacer una consulta o realizar una accion de sql se deve de crear una variable para guardar la consulta y otra variable para ejecutarla 
				/*se hace una consulta para ver que el correo que ingreso o el usuario ya existen esto porque no pueden existir usuarios o
				correos duplicados 
				*/
				$sqlValidar = "SELECT * FROM usuarios WHERE cCorreo = '".$correo."'  ";
				//linea para la ejecucion de la consulata
				$resultado = mysqli_query($this->conn, $sqlValidar);

				
				//este if evalua que el correo que se quiere registrar ya exista si es asi solo asigna d al error y no hace el registro
				//se cuentan los renglones y si es mayor a 0 es porque encontro un registro igual al usuario o correo
				if(mysqli_num_rows($resultado)!= 0) {				
					$error="d";
				}else{
					
					$query = "INSERT INTO usuarios(cNombre, cAp1, cAp2, cCorreo, cContraseña, bEstatus)";
					$query .= " VALUES ('".$nombre."', '".$ap1."', '".$ap2."', '".$correo."', '".$pass."' , 1);";

					if($this->conn->query($query)){
						$valor = $this->conn->affected_rows;		
					}else{
						$error = '[' . $this->conn->error . ']';
					}
										
				}
			
            }else{
                /*si no coinciden las contraseñas estra al else y asigna un no a error para mandarlos al controlador y mandar el mensaje 
                de que no coinciden las contraseñas*/
                $error = "n";
            }
			 
			$resul[] = $valor;
			$resul[] = $error;	
			return $resul;
		}

        function validaUsuario($params){
			$error = "";
			$valor = "";
			$correo = $params["correo"];//user
			$pass = $params["pass"];//pass

			//$pass = hash("sha256", $cont);
	
			//selec para ver que la contraseña y el usuario existan y coisidan
			$query = "SELECT * FROM usuarios WHERE cCorreo = '".$correo."' AND cContraseña = '".$pass."';";
	
			$resultado = mysqli_query($this->conn, $query);
			//si se cumple la sentencia de arriba el renglon sera 1 y eso quiere decir que si exixte el correo y la contraseña y estos coinciden
			if(mysqli_num_rows($resultado)!=0){
				$valor = "Ok";
				//si se cumple crea la variable de sesion 
				@session_start(); 
				$_SESSION["logueado"] = TRUE;

				//se crean las variables de sesion
				while($row = mysqli_fetch_array($resultado)){
					$_SESSION["nombre"] = $row['cNombre'];
					$_SESSION["id"] = $row['IdUsuario'];
					$_SESSION["estatus"] = $row['cEstatus'];
					//optenemos la hora donde se inicio la sesion para poder destruirla en un determinado tiempo
					$_SESSION["tiempo"] = time();
					
				}	

			}

			$resul[] = $valor;
			$resul[] = $error;
	
			return $resul;
		}


		function agregaAnimal( $params, $conn ){

			$error = "";
			$valor = "";
			$animal = $params["animal"];
            $hembras = $params["hembras"];
			$machos = $params["machos"];
			$peso = $params["peso"];
			$precio = $params["precio"];
			$genetica = $params["genetica"];
			$raza = $params["raza"];

			$VcAccion = "I";
			$VbEstatus = 1;
			$VIdAnimal = $params["animal"];
			$VIdCompraAnimal = 0;
			$VIdUs = $_SESSION['id'];
			$VnPesoCompra = $params["peso"];
			$VnPrecioCompra = $params["precio"];

			$n = $hembras + $machos;

			/*
			// Llamar al procedimiento almacenado
			$stmt = $conn->prepare("CALL psComprasAnimales(?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("siiiidd", $VcAccion, $VbEstatus, $VIdAnimal, $VIdCompraAnimal, $VIdUs, $VnPesoCompra, $VnPrecioCompra);

			// Ejecutar el procedimiento almacenado
			if ($stmt->execute()) {
				$valor = $stmt->affected_rows;
					//con las suma de las hembras y machos registrados se hace un for para registrar todos los animales 
					//con el if registramos hembra o macho
					for($i = 1; $i <= $n; $i++)
					{
						//selecciono el id maximo de compras cuando el idUs sea igual al de la variable de sesio 
						//para sacar el dato para la llaveforane de idcompra de todos los animales que va a detalle animal
						if($i <= $hembras)
						{
							$query = "INSERT INTO detalleanimales(IdCompraAnimal, cCodigoPatente, IdSexo, nGenetica, cRaza, bEstatus)";
							$query .= " VALUES ((SELECT MAX(IdCompraAnimal) FROM comprasanimales WHERE IdUs = '".$VIdUs."'), '".$i."', 1, '".$genetica."', '".$raza."' , 1);";
				
							if($this->conn->query($query)){
								$valor = $this->conn->affected_rows;		
							}else{
								$error = '[' . $this->conn->error . ']';
							}
						}
						else
						{
							$query = "INSERT INTO detalleanimales(IdCompraAnimal, cCodigoPatente, IdSexo, nGenetica, cRaza, bEstatus)";
							$query .= " VALUES ((SELECT MAX(IdCompraAnimal) FROM comprasanimales ), '".$i."', 2, '".$genetica."', '".$raza."' , 1);";
				
							if($this->conn->query($query)){
								$valor = $this->conn->affected_rows;		
							}else{
								$error = '[' . $this->conn->error . ']';
							}
						}
					}
			} else {
				$error = '[' . $stmt->error . ']';
			}
			*/
			

			
			//para hacer una consulta o realizar una accion de sql se debe de crear una variable para guardar la consulta y otra variable para ejecutarla 
			//guardamos la compra para tener la llave foranea para registrar cada animal
			$query = "INSERT INTO comprasanimales(IdUs, dFechaCompra, nPrecioCompra, nPesoCompra, IdAnimal, bEstatus)";
			$query .= " VALUES ('".$VIdUs."', NOW(), '".$precio."', '".$peso."', '".$animal."' , 1);";

			if($this->conn->query($query)){
				//$valor = $this->conn->affected_rows;			

				//con las suma de las hembras y machos registrados se hace un for para registrar todos los animales 
				//con el if registramos hembra o macho
				for($i = 1; $i <= $n; $i++)
				{
					//selecciono el id maximo de compras cuando el idUs sea igual al de la variable de sesio 
					//para sacar el dato para la llaveforane de idcompra de todos los animales que va a detalle animal
					if($i <= $hembras)
					{
						$query = "INSERT INTO detalleanimales(IdCompraAnimal, cCodigoPatente, IdSexo, nGenetica, cRaza, bEstatus)";
						$query .= " VALUES ((SELECT MAX(IdCompraAnimal) FROM comprasanimales WHERE IdUs = '".$VIdUs."'), '".$i."', 1, '".$genetica."', '".$raza."' , 1);";
			
						if($this->conn->query($query)){
							//$valor = $this->conn->affected_rows;
							$query2 = "INSERT INTO gastosanimales(IdDetalleAnimal)";
							$query2 .= "VALUES ((SELECT LAST_INSERT_ID()));"; 

							if($this->conn->query($query2)){
								$valor = $this->conn->affected_rows;		
							}else{
								$error = '[' . $this->conn->error . ']';
							}
						}else{
							$error = '[' . $this->conn->error . ']';
						}
					}
					else
					{
						$query = "INSERT INTO detalleanimales(IdCompraAnimal, cCodigoPatente, IdSexo, nGenetica, cRaza, bEstatus)";
						$query .= " VALUES ((SELECT MAX(IdCompraAnimal) FROM comprasanimales WHERE IdUs = '".$VIdUs."'), '".$i."', 2, '".$genetica."', '".$raza."' , 1);";
			
						if($this->conn->query($query)){
							//$valor = $this->conn->affected_rows;	
							$query2 = "INSERT INTO gastosanimales(IdDetalleAnimal)";
							$query2 .= "VALUES ((SELECT LAST_INSERT_ID()));"; 

							if($this->conn->query($query2)){
								$valor = $this->conn->affected_rows;		
							}else{
								$error = '[' . $this->conn->error . ']';
							}
						}else{
							$error = '[' . $this->conn->error . ']';
						}
					}
				}

			}else{
				$error = '[' . $this->conn->error . ']';
			}
			
			
			 
			$resul[] = $valor;
			$resul[] = $error;	
			return $resul;
		}

		function consCompras ( ){

			$VIdUs = $_SESSION['id'];

			$sql = "SELECT CA.IdCompraAnimal, A.cAnimal, CA.dFechaCompra 
			FROM comprasanimales CA 
			INNER JOIN animales A ON CA.IdAnimal = A.IdAnimal 
			WHERE CA.IdUs = '".$VIdUs."'
			ORDER BY CA.IdCompraAnimal DESC;";

			$resCompra = mysqli_query ($this->conn, $sql);
			if(!$resCompra){
				$error = 'MYSQL Error: ' . mysqli_connect_error();
			}
			return $resCompra;
		}

		function consAnimales ($compra){

			$VIdCompraAnimal = $compra;

			$sql = "SELECT DA.*, A.cAnimal, S.cSexo, CA.IdCompraAnimal ,CA.nPrecioCompra, CA.nPesoCompra, CA.dFechaCompra, GA.IdGastoAnimal,
			GA.nComida, GA.nAgua, GA.nMedicina, GA.nVeterinario, GA.nTransporte, GA.nOtros 
			FROM detalleanimales DA 
			INNER JOIN sexos S ON S.IdSexo = DA.IdSexo 
			INNER JOIN comprasanimales CA ON CA.IdCompraAnimal = DA.IdCompraAnimal 
			INNER JOIN animales A ON A.IdAnimal = CA.IdAnimal 
			INNER JOIN gastosanimales GA ON GA.IdDetalleAnimal = DA.IdDetalleAnimal 
			WHERE DA.IdCompraAnimal = '".$VIdCompraAnimal."';";

			$resAnimales = mysqli_query ($this->conn, $sql);
			if(!$resAnimales){
				$error = 'MYSQL Error: ' . mysqli_connect_error();
			}
			return $resAnimales;
		}

		
		function agregarGastos($params){
			$error="";
			$valor="";
			$id = $params["id"];
			$comida = $params["comida"];
			$agua = $params["agua"];
			$medicina = $params["medicina"];
			$veterinario = $params["veterinario"];
			$transporte = $params["transporte"];
			$otros = $params["otros"];
			$repartir = $params["repartir"];


			if($params["repartir"] != null) { //Quiere decir que si es diferente de null seria un registro en grupo puesto qeu este es el select que solo se habilitaba para los envios en grupo
								
				$sqlValidar = "SELECT d.*, g.* FROM detalleanimales AS d INNER JOIN gastosanimales AS g ON d.IdDetalleAnimal = g.IdDetalleAnimal WHERE d.IdCompraAnimal = '".$id."';";
				$resultado = mysqli_query($this->conn, $sqlValidar);
	
				if ($resultado) {
					$numeroRegistros = mysqli_num_rows($resultado);
				} else {
					$error = "Error en la consulta: " . mysqli_error($conexion);
				}
	

				if ($params["repartir"] == "entreTodos"){ // Dependiendo de lo recibido en el select, reparti el valor de input entre todos
					if($comida != 0){
						$comida /= $numeroRegistros;
					}
					if($agua != 0){
						$agua /= $numeroRegistros;
					}
					if($medicina != 0){
						$medicina /= $numeroRegistros;
					}
					if($veterinario != 0){
						$veterinario /= $numeroRegistros;
					}
					if($transporte != 0){
						$transporte /= $numeroRegistros;
					}
					if($otros != 0){
						$otros /= $numeroRegistros;
					}
				}

				
				if ($resultado) {
					
					// La consulta se ejecutó correctamente
					if (mysqli_num_rows($resultado) > 0) {
						// Hay al menos una fila de resultado
						while ($fila = mysqli_fetch_assoc($resultado)) {

							//Dandole valor de 0 a lo que vamos a guardar para que aunmente bien
							$comidaNueva = 0;
							$aguaNueva = 0;
							$medicinaNueva = 0;
							$veterinarioNueva = 0;
							$transporteNueva = 0;
							$otrosNueva = 0;

							// Procesa cada fila de resultado
							$idGastoAnimal = $fila['IdGastoAnimal'];
							$comidaActual = $fila['nComida'];
							$aguaActual = $fila['nAgua'];
							$medicinaActual = $fila['nMedicina'];
							$veterinarioActual = $fila['nVeterinario'];
							$transporteActual = $fila['nTransporte'];
							$otrosActual = $fila['nOtros'];

							//Sumando lo que indico mas lo que ya habia en la base de datos
							$comidaNueva = $comida + $comidaActual;
							$aguaNueva = $agua + $aguaActual;
							$medicinaNueva = $medicina + $medicinaActual;
							$veterinarioNueva = $veterinario + $veterinarioActual;
							$transporteNueva = $transporte + $transporteActual;
							$otrosNueva = $otros + $otrosActual;
			 
							$query2 = "UPDATE `gastosanimales` SET `nComida` = '$comidaNueva', `nAgua` = '$aguaNueva', `nMedicina` = '$medicinaNueva', `nVeterinario` = '$veterinarioNueva', `nTransporte` = '$transporteNueva', `nOtros` = '$otrosNueva' WHERE `gastosanimales`.IdGastoAnimal = '$idGastoAnimal'";	
	
							if(!($this->conn->query($query2))){
								$error = '[' . $this->conn->error . ']';
							}
						}

					} else {
						$error = "Error en la consulta: " . mysqli_error($this->conn);

					}
				} else {
						// La consulta tuvo un error
						$error = "Error en la consulta: " . mysqli_error($this->conn);
				}				



			} else { //Si es nulo quiere decir que es un registro individual de gastos

				$sqlValidar = "SELECT *FROM gastosanimales WHERE IdGastoAnimal = '".$id."'  ";
				$resultado = mysqli_query($this->conn, $sqlValidar);

				if ($resultado) {
					// La consulta se ejecutó correctamente
					if (mysqli_num_rows($resultado) > 0) {
						// Hay al menos una fila de resultado
						while ($fila = mysqli_fetch_assoc($resultado)) {
							// Procesa cada fila de resultado
							$idGastoAnimal = $fila['IdGastoAnimal'];
							$comidaActual = $fila['nComida'];
							$aguaActual = $fila['nAgua'];
							$medicinaActual = $fila['nMedicina'];
							$veterinarioActual = $fila['nVeterinario'];
							$transporteActual = $fila['nTransporte'];
							$otrosActual = $fila['nOtros'];
						}

						$comida += $comidaActual;
						$agua += $aguaActual;
						$medicina += $medicinaActual;
						$veterinario += $veterinarioActual;
						$transporte += $transporteActual;
						$otros += $otrosActual;
		 
						$query2 = "UPDATE `gastosanimales` SET `nComida` = '$comida', `nAgua` = '$agua', `nMedicina` = '$medicina', `nVeterinario` = '$veterinario', `nTransporte` = '$transporte', `nOtros` = '$otros' WHERE `gastosanimales`.IdGastoAnimal = '$idGastoAnimal'";	

						if(!($this->conn->query($query2))){
							$error = '[' . $this->conn->error . ']';
						}

					} else {
						$error = "Error en la consulta: " . mysqli_error($this->conn);

					}
				} else {
						// La consulta tuvo un error
						$error = "Error en la consulta: " . mysqli_error($this->conn);
				}				
				

			}


			$resul[] = $valor;
			$resul[] = $error;	
			return $resul;
		}




    }
	
?>