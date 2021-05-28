<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	$tipo = $_POST["tipo"];

	if ($tipo == "ProductoNoComestible"){
		$query = "SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM Tiendas, PerteneceA, Productos, ProductosNoComestibles WHERE Productos.id =  ProductosNoComestibles.id AND Productos.id = PerteneceA.id_producto AND Tiendas.id = PerteneceA.id_tienda;";
	}elseif ($tipo == "ProductoComestible") {
		$query = "(SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM Tiendas, PerteneceA, Productos, ProductosComestiblesEnConservas WHERE Productos.id =  ProductosComestiblesEnConservas.id AND Productos.id = PerteneceA.id_producto AND Tiendas.id = PerteneceA.id_tienda) UNION (SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM Tiendas, PerteneceA, Productos, ProductosComestiblesCongelados WHERE Productos.id =  ProductosComestiblesCongelados.id AND Productos.id = PerteneceA.id_producto AND Tiendas.id = PerteneceA.id_tienda) UNION (SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM Tiendas, PerteneceA, Productos, ProductosComestiblesFrescos WHERE Productos.id =  ProductosComestiblesFrescos.id AND Productos.id = PerteneceA.id_producto AND Tiendas.id = PerteneceA.id_tienda);";
	}elseif ($tipo == "ProductoComestibleCongelado") {
		$query = "SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM Tiendas, PerteneceA, Productos, ProductosComestiblesCongelados WHERE Productos.id =  ProductosComestiblesCongelados.id AND Productos.id = PerteneceA.id_producto AND Tiendas.id = PerteneceA.id_tienda;";
	}elseif ($tipo == "ProductoComestibleFresco") {
		$query = "SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM Tiendas, PerteneceA, Productos, ProductosComestiblesFrescos WHERE Productos.id =  ProductosComestiblesFrescos.id AND Productos.id = PerteneceA.id_producto AND Tiendas.id = PerteneceA.id_tienda;";
	}else {
		$query = "SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM Tiendas, PerteneceA, Productos, ProductosComestiblesEnConservas WHERE Productos.id =  ProductosComestiblesEnConservas.id AND Productos.id = PerteneceA.id_producto AND Tiendas.id = PerteneceA.id_tienda;";
	}


	$result = $db -> prepare($query);
	$result -> execute();
	$tiendas = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>id_direccion</th>
	  <th>id_jefe</th>
    </tr>
  <?php
	foreach ($tiendas as $tienda) {
  		echo "<tr> <td>$tienda[0]</td> <td>$tienda[1]</td> <td>$tienda[2]</td> <td>$tienda[3]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
