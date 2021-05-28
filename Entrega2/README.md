
#### COMPRAS ####

# FOREIGN KEY #

* id_usuario --> ON DELETE SET NULL

Nos interesa que la información en una fila de direcciones se mantenga, a pesar de perder el id_usuario y que este quede en NULL, ya que es información útil para tomar decisiones estratégicas.

# SQL #

CREATE TABLE compras(id INT PRIMARY KEY, id_usuario INT, id_direccion INT, id_tienda INT, FOREIGN KEY(id_usuario) REFERENCES usuarios ON DELETE SET NULL, 




#### 1) USUARIOS ####


# SQL #
CREATE TABLE usuarios(id INT PRIMARY KEY, nombre VARCHAR(100), rut VARCHAR(10), sexo VARCHAR(10), edad INT)

# POBLAR TABLA DESDE CSV #
\COPY usuarios FROM Entrega2/csv/Usuarios.csv DELIMITER ',';


#### 2) COMUNAS ####

# SQL #
CREATE TABLE comunas(id INT PRIMARY KEY, nombre VARCHAR(50));

# POBLAR TABLA DESDE CSV #
\COPY comunas FROM Entrega2/csv/Comunas.csv DELIMITER ',';


#### 3) PRODUCTOS ####

# SQL #
CREATE TABLE productos(id INT PRIMARY KEY, nombre VARCHAR(130), precio INT, descripcion VARCHAR(200));

# POBLAR TABLA DESDE CSV #
\COPY productos FROM Entrega2/csv/Productos.csv DELIMITER ',';


#### 4) DIRECCIONES ####

# SQL #
CREATE TABLE direcciones(id INT PRIMARY KEY, nombre VARCHAR(150), id_comuna INT, FOREIGN KEY(id_comuna) REFERENCES comunas ON DELETE SET NULL);

# FOREIGN KEY id_comuna #
* id_comuna --> ON DELETE SET NULL
Nos interesa que la información en una fila de direcciones se mantenga, a pesar de perder el id_comuna y que este quede en NULL, ya que ese id_direcciones puede estar en otras tablas según nuestro esquema diseñado.

# POBLAR TABLA DESDE CSV #
\COPY direcciones FROM Entrega2/csv/Direcciones.csv DELIMITER ',';



#### 5) TRABAJADORES ####
# SQL #
CREATE TABLE trabajadores(id INT PRIMARY KEY, nombre VARCHAR(100), rut VARCHAR(10), edad INT, sexo VARCHAR(10));
# POBLAR TABLA DESDE CSV #
\COPY trabajadores FROM Entrega2/csv/Trabajadores.csv DELIMITER ',';





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
  