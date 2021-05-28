<?php include('templates/header.html');   ?>

<body>
  <h1 align="center"> Super entrega 2 con todo el flow </h1>
  <p style="text-align:center;">Aquí podrás consultar información sobre tú negocio.</p>

  <br>



  <?php
  #CONSULTA 1
  ?>

  <h3 align="center"> Obtener nombre de todas las tiendas, junto con los nombres de las comunas a las cuales despacho.</h3>

  <form align="center" action="consultas/consulta_1.php" method="post">
    
    <br/><br/>
    <input type="submit" value="Obtener">
  </form>
  
  <br>
  <br>
  <br>

  <?php
  #CONSULTA 2
  ?>

  <h3 align="center"> Obtener todos los jefes de tiendas en una comuna determinada.</h3>

  <form align="center" action="consultas/consulta_2.php" method="post">
    Comuna:
    <input type="text" name="comuna_elegida">
    <br/><br/>
    <input type="submit" value="Obtener">
  </form>
  
  <br>
  <br>
  <br>

  <?php
  #CONSULTA 3
  ?>

  <h3 align="center"> Obtener todas las tiendas que vendan al menos un producto del tipo seleccionado </h3>

  <form align="center" action="consultas/consulta_3.php" method="post">
    Selecciona tipo: 

    <select name="tipo">
         <option value="ProductoNoComestible">ProductoNoComestible</option>
         <option value="ProductoComestible">ProductoComestible</option>
         <option value="ProductoComestibleCongelado">ProductoComestibleCongelado</option>
         <option value="ProductoComestibleFresco">ProductoComestibleFresco</option>
         <option value="ProductoComestibleEnConserva">ProductoComestibleEnConserva</option>
    </select>

    <br/><br/>
    <input type="submit" value="Obtener">

  </form>

  <br>
  <br>
  <br>


  <?php
  #CONSULTA 4
  ?>

  <h3 align="center"> Obtener usuarios que hayan comprado un producto con una determinada descripción.</h3>

  <form align="center" action="consultas/consulta_4.php" method="post">
    Descripción:
    <input type="text" name="descripcion_ingresada">
    <br/><br/>
    <input type="submit" value="Obtener">
  </form>
  <br>
  <br>
  <br>

  <?php
  #CONSULTA 5
  ?>

  <h3 align="center"> Obtener edad promedio de trabajadores en un comuna determinada.</h3>

  <form align="center" action="consultas/consulta_5.php" method="post">
    Comuna:
    <input type="text" name="comuna_elegida">
    <br/><br/>
    <input type="submit" value="Obtener">
  </form>

  <br>
  <br>
  <br>


  <?php
  #CONSULTA 6 AGREGAR LASOPCIONES SELECCIONABLES
  ?>

  <h3 align="center"> Obtener las tiendas que han registrado la venta de la mayor cantidad de productos del tipo seleccionado.</h3>

  <form align="center" action="consultas/consulta_6.php" method="post">
    Selecciona tipo: 

    <select name="tipo">
         <option value="ProductoNoComestible">ProductoNoComestible</option>
         <option value="ProductoComestible">ProductoComestible</option>
         <option value="ProductoComestibleCongelado">ProductoComestibleCongelado</option>
         <option value="ProductoComestibleFresco">ProductoComestibleFresco</option>
         <option value="ProductoComestibleEnConserva">ProductoComestibleEnConserva</option>
    </select>

    <br/><br/>
    <input type="submit" value="Obtener">

  </form>

  <br>
  <br>
  <br>




  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT tipo FROM pokemones;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>

  <form align="center" action="consultas/consulta_tipo.php" method="post">
    Seleccinar un tipo:
    <select name="tipo">
      <?php
      #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
      foreach ($dataCollected as $d) {
        echo "<option value=$d[0]>$d[0]</option>";
      }
      ?>
    </select>
    <br><br>
    <input type="submit" value="Buscar por tipo">
  </form>

  <br>
  <br>
  <br>
  <br>
</body>
</html>
