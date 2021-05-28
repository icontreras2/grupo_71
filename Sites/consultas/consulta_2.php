<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $comuna = $_POST["comuna_elegida"];

 	$query = "SELECT DISTINCT Trabajadores.id, Trabajadores.nombre, Trabajadores.rut, Trabajadores.edad, Trabajadores.sexo FROM Trabajadores, Tiendas, Direcciones, TiendasTrabajadores, Comunas WHERE TiendasTrabajadores.id_tienda = Tiendas.id AND Tiendas.id_jefe = TiendasTrabajadores.id_trabajador AND Tiendas.id_direccion = Direcciones.id AND Direcciones.id_comuna = Comunas.id AND Comunas.nombre = '$comuna';";
	$result = $db -> prepare($query);
	$result -> execute();
	$jefes = $result -> fetchAll();
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
	foreach ($jefes as $jefe) {
  		echo "<tr><td>$jefe[0]</td><td>$jefe[1]</td><td>$jefe[2]</td><td>$jefe[3]</td><td>$jefe[4]</td></tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
