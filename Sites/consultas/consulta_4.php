<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $descrip = $_POST["descripcion_ingresada"];

 	$query = "SELECT DISTINCT Usuarios.id, Usuarios.nombre, Usuarios.rut, Usuarios.edad, Usuarios.sexo FROM Compras, ComprasPorProducto, Usuarios, Productos WHERE ComprasPorProducto.id_producto = Productos.id AND ComprasPorProducto.id_compra = Compras.id AND Compras.id_usuario = Usuarios.id AND Productos.descripcion = '$descrip';";
	$result = $db -> prepare($query);
	$result -> execute();
	$usuarios = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>RUT</th>
      <th>edad</th>
      <th>sexo</th>
    </tr>
  <?php
	foreach ($usuarios as $usuario) {
  		echo "<tr><td>$usuario[0]</td><td>$usuario[1]</td><td>$usuario[2]</td><td>$usuario[3]</td><td>$usuario[4]</td></tr>";
	}
  ?>
  </table>

<?php include('../templates/footer.html'); ?>
