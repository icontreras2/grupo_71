<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $comuna = $_POST["comuna_elegida"];

 	$query = "SELECT AVG(Trabajadores.edad) FROM Trabajadores, TiendasTrabajadores, Tiendas, Direcciones, Comunas WHERE TiendasTrabajadores.id_tienda = Tiendas.id AND Tiendas.id_direccion = Direcciones.id AND Direcciones.id_comuna = Comunas.id AND TiendasTrabajadores.id_trabajador = Trabajadores.id AND Comunas.nombre = '$comuna' GROUP BY Comunas.nombre;";
	$result = $db -> prepare($query);
	$result -> execute();
	$trabajadores = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>PROMEDIO</th>
    </tr>
  <?php
	foreach ($trabajadores as $trabajador) {
  		echo "<tr><td>$trabajador[0]</td></tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>