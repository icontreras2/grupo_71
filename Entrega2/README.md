




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
CREATE TABLE direcciones(id INT PRIMARY KEY, nombre VARCHAR(150), id_comuna INT, FOREIGN KEY(id_comuna) REFERENCES comunas(id) ON DELETE SET NULL);

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


#### 6) TIENDAS ####
# SQL #
CREATE TABLE tiendas(id INT PRIMARY KEY, nombre VARCHAR(100), id_direccion INT, id_jefe INT, FOREIGN KEY(id_direccion) REFERENCES direcciones(id) ON DELETE SET NULL, FOREIGN KEY(id_jefe) REFERENCES trabajadores(id) ON DELETE SET NULL);
# FOREIGN KEY #
* id_direccion --> ON DELETE SET NULL. JUSTIFICACIÓN:
* id_jefe --> ON DELETE SET NULL. JUSTIFICACIÓN:  
# POBLAR TABLA DESDE CSV #
\COPY tiendas FROM Entrega2/csv/Tiendas.csv DELIMITER ',';


#### 7) COMPRAS ####
# SQL #
CREATE TABLE compras(id INT PRIMARY KEY, id_usuario INT, id_direccion INT, id_tienda INT, FOREIGN KEY(id_usuario) REFERENCES usuarios(id) ON DELETE SET NULL, FOREIGN KEY(id_direccion) REFERENCES direcciones(id) ON DELETE SET NULL, FOREIGN KEY(id_tienda) REFERENCES tiendas(id) ON DELETE SET NULL);
# FOREIGN KEY #
* id_usuario --> ON DELETE SET NULL. JUSTIFICACIÓN: 
* id_direccion --> ON DELETE SET NULL. JUSTIFICACIÓN: 
* id_tienda --> ON DELETE SET NULL. JUSTIFICACIÓN: 
# POBLAR TABLA DESDE CSV #
\COPY compras FROM Entrega2/csv/Compras.csv DELIMITER ',';


#### 8) COMPRASPORPRODUCTO ####
# SQL #
CREATE TABLE comprasporproducto(id_compra INT, id_producto INT, cantidad INT, PRIMARY KEY(id_compra, id_producto), FOREIGN KEY(id_compra) REFERENCES compras(id) ON DELETE CASCADE, FOREIGN KEY(id_producto) REFERENCES productos(id) ON DELETE SET NULL);
# FOREIGN KEY #
* id_compra --> ON DELETE CASCADE. JUSTIFICACIÓN: 
* id_producto --> ON DELETE SET NULL. JUSTIFICACIÓN: 
# POBLAR TABLA DESDE CSV #
\COPY comprasporproducto FROM Entrega2/csv/ComprasPorProducto.csv DELIMITER ',';


#### 9) TIENDASTRABAJADORES ####
# SQL #
CREATE TABLE tiendastrabajadores(id_tienda INT, id_trabajador INT, PRIMARY KEY(id_tienda, id_trabajador), FOREIGN KEY(id_tienda) REFERENCES tiendas(id) ON DELETE CASCADE, FOREIGN KEY(id_trabajador) REFERENCES trabajadores(id) ON DELETE CASCADE);
# FOREIGN KEY #
* id_tienda --> ON DELETE CASCADE. JUSTIFICACIÓN: 
* id_trabajador --> ON DELETE CASCADE. JUSTIFICACIÓN: 
# POBLAR TABLA DESDE CSV #
\COPY tiendastrabajadores FROM Entrega2/csv/TiendasTrabajadores.csv DELIMITER ',';










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
  