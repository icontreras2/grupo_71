
#### COMPRAS ####

# FOREIGN KEY #

* id_usuario --> ON DELETE SET NULL

Nos interesa que la información en una fila de compras se mantenga, apesar de perder el id_usuario y que este quede 
en NULL. Ya que es información útil tomar decisiones   estratégicas.

# SQL #

CREATE TABLE compras(id INT PRIMARY KEY, id_usuario INT, id_direccion INT, id_tienda INT, FOREIGN KEY(id_usuario) REFERENCE usuarios ON DELETE SET NULL, 

#### USUARIOS ####


# SQL #

CREATE TABLE usuarios(id INT PRIMARY KEY, nombre VARCHAR(100), rut VARCHAR(10), sexo VARCHAR(10), edad INT)

# POBLAR TABLA DESDE CSV #

\COPY usuarios FROM Entrega2/csv/Usuarios.csv DELIMITER ',';


#### COMUNAS ####


# SQL #

CREATE TABLE comunas(id INT PRIMARY KEY, nombre VARCHAR(50));
CREATE TABLE

# POBLAR TABLA DESDE CSV #

\COPY usuarios FROM Entrega2/csv/Usuarios.csv DELIMITER ',';

RUTAS

  Entrega2/csv/Compras.csv
  Entrega2/csv/ComprasPorProducto.csv
  Entrega2/csv/Comunas.csv
  Entrega2/csv/Direcciones.csv
  Entrega2/csv/DireccionesUsuarios.csv
  Entrega2/csv/PerteneceA.csv
  Entrega2/csv/Productos.csv
  Entrega2/csv/ProductosComestiblesCongelados.csv
  Entrega2/csv/ProductosComestiblesEnConservas.csv
  Entrega2/csv/ProductosComestiblesFrescos.csv
  Entrega2/csv/ProductosNoComestibles.csv
  Entrega2/csv/Tiendas.csv
  Entrega2/csv/TiendasComunasCobertura.csv
  Entrega2/csv/Trabajadores.csv
  