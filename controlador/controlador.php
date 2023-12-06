<?php
    require_once("../modelo/modelo.php");
	
	function instancia( ){
		$db=Database::getInstance();
		$conn = $db->getConnection();
		$MySQL = new Modelo($conn);
		return $MySQL;
	}

	function compras()
	{ 	
		$MySQL = instancia();
		$result = $MySQL-> consCompras();
			return $result;

	}

	function c_Compras(){
		$datos = compras();
		$tblmain = "";
		foreach ($datos as $filas){

			if($filas['cAnimal'] == "Vaca"){
				$rutaAnimal = "vaca.jpg";
			} else if($filas['cAnimal'] == "Cerdo"){
				$rutaAnimal = "puerco.png";
			} else if($filas['cAnimal'] == "Pollo"){
				$rutaAnimal = "gallina.png";
			} else if($filas['cAnimal'] == "Chiva"){
				$rutaAnimal = "chiva.png";
			} else if($filas['cAnimal'] == "Borrega"){
				$rutaAnimal = "borrego.png";
			} 

			$tblmain .="<div class='grid-tarjeta'>";
            $tblmain .="<div class='fecha-tarjeta'>";
            $tblmain .="  <h4>".$filas['dFechaCompra'] ."</h4>";
            $tblmain .="  <hr>";
            $tblmain .="</div>";
            $tblmain .="<img class='imagen-tarjeta' src='imagenes/animales/". $rutaAnimal. "' alt=''>";
            $tblmain .="<div class='grid-tarjeta__descripcion'>";
            $tblmain .="  <h3 class='titulo-tarjeta'>". $filas['cAnimal'] . "</h3>";
            $tblmain .="  <p>Se compraron 50 machos y 20 hembras</p>";
            $tblmain .="</div>";
            $tblmain .="<p class='distribuidor-tarjeta'> <b>Distribuidor: </b> Juan Perez</p>";
            $tblmain .="<a href='../vista/animales.php?ID=".$filas["IdCompraAnimal"]."'>Ver detalles</a>";
        	$tblmain .="</div>";
		}
		return $tblmain;
	}

	function ventas()
	{ 	
		$MySQL = instancia();
		$result = $MySQL-> consVentas();
			return $result;

	}

	function c_Ventas(){
		$datos = ventas();
		$tblmain = "";
		foreach ($datos as $filas){
			$tblmain .="<tr class='text-center'>\n";
			$tblmain .="<td>". $filas['IdCompraAnimal'] . "</td>\n";
			$tblmain .="<td>". $filas['cAnimal'] . "</td>\n";
			$tblmain .="<td>". $filas['dFechaCompra'] . "</td>\n";
			$tblmain .= "<td>
			<a href='../vista/animalesVendidos.php?ID=".$filas["IdCompraAnimal"]."'>Ver Todos</a>\n";

		}
		return $tblmain;
	}
		
	function animales($compra)
	{ 	
		$MySQL = instancia();
		$result = $MySQL-> consAnimales($compra);
			return $result;

	}

	function c_Animales($compra){
		$datos = animales($compra);
		$tblmain = "";
		foreach ($datos as $filas){
			$tblmain .="<tr class='text-center'>\n";
            $tblmain .="<td>". $filas['IdDetalleAnimal'] . "</td>\n";
			$tblmain .="<td>". $filas['cAnimal'] . "</td>\n";
            $tblmain .="<td>". $filas['cRaza'] . "</td>\n";
            $tblmain .="<td>". $filas['cSexo'] . "</td>\n";
            $tblmain .="<td>". $filas['nGenetica'] . "</td>\n";
			$tblmain .="<td>". $filas['dFechaCompra'] . "</td>\n";
            $tblmain .="<td>". $filas['nPesoCompra'] . "</td>\n";
            $tblmain .="<td>". $filas['nPrecioCompra'] . "</td>\n";
			$tblmain .="<td> <a href='../vista/registrarGastos.php?IdGastoAnimal=". $filas['IdGastoAnimal'] ."'>Agregar</a>    <button type='button' class='btn btn-primary personalizado-btn' data-toggle='modal' data-target='.bd-example-modal-lg' onclick='abrirModalGastos(". $filas['IdDetalleAnimal'] .", " . $filas['nComida'] ." , " . $filas['nAgua'] ." , " . $filas['nMedicina'] ." , " . $filas['nVeterinario'] ." , " . $filas['nTransporte'] ." , " . $filas['nOtros'] .")'>Ver</button></td>\n";
			$tblmain .="<td> <a class='venderButton' href='#'>Vender</a></td>\n ";
		}

		$resul[] = $tblmain;
		$resul[] = $filas["IdCompraAnimal"];

		return $resul;

	}

	function animalesVendidos($compra)
	{ 	
		$MySQL = instancia();
		$result = $MySQL-> consAnimales($compra);
			return $result;

	}

	function c_AnimalesVendidos($compra){
		
		$datos = animales($compra);
		$tblmain = "";
		foreach ($datos as $filas){
			$tblmain .="<tr class='text-center'>\n";
            $tblmain .="<td>". $filas['cCodigoPatente'] . "</td>\n";
			$tblmain .="<td>". $filas['cAnimal'] . "</td>\n";
            $tblmain .="<td>". $filas['cRaza'] . "</td>\n";
            $tblmain .="<td>". $filas['cSexo'] . "</td>\n";
            $tblmain .="<td>". $filas['nGenetica'] . "</td>\n";
			$tblmain .="<td>". $filas['dFechaCompra'] . "</td>\n";
            $tblmain .="<td>". $filas['nPesoCompra'] . "</td>\n";
            $tblmain .="<td>". $filas['nPrecioCompra'] . "</td>\n";
			$tblmain .="<td>". $filas['nComida'] . "</td>\n";
            $tblmain .="<td>". $filas['nAgua'] . "</td>\n";
            $tblmain .="<td>". $filas['nMedicina'] . "</td>\n";
			$tblmain .="<td>". $filas['nVeterinario'] . "</td>\n";
            $tblmain .="<td>". $filas['nTransporte'] . "</td>\n";
            $tblmain .="<td>". $filas['nOtros'] . "</td>\n";
		}
		$id = $filas['IdCompraAnimal'];
		$resul[] = $tblmain;
		$resul[] = $id;

		return $resul;

	}


	
?>