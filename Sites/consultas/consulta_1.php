<?php include('../templates/header.html');   ?>

<body>
<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  #Se obtiene el valor del input del usuario
  

  #Se construye la consulta como un string
 	$query = "SELECT Tiendas.id, Tiendas.nombre, Comunas.nombre FROM Tiendas, Comunas, TiendasComunasCobertura WHERE Tiendas.id = TiendasComunasCobertura.id_tienda AND Comunas.id = TiendasComunasCobertura.id_comuna ORDER BY Tiendas.id;";

  #Se prepara y ejecuta la consulta. Se obtienen TODOS los resultados
	$result = $db -> prepare($query);
	$result -> execute();
	$tiendas = $result -> fetchAll();
  ?>

  <table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Comuna</th>
    </tr>
  
      <?php
        // echo $pokemones;
        foreach ($tiendas as $p) {
          echo "<tr><td>$p[0]</td><td>$p[1]</td><td>$p[2]</td></tr>";
      }
      ?>
      
  </table>

<?php include('../templates/footer.html'); ?>
