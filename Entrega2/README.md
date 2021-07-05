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


#### 10) TIENDASCOMUNASCOBERTURA #####
# SQL #  
CREATE TABLE tiendascomunascobertura(id_tienda INT, id_comuna INT, PRIMARY KEY(id_tienda, id_comuna), FOREIGN KEY(id_tienda) REFERENCES tiendas(id) ON DELETE CASCADE, FOREIGN KEY(id_comuna) REFERENCES comunas(id) ON DELETE CASCADE);
# FOREIGN KEY #
* id_tienda --> ON DELETE CASCADE. JUSTIFICACIÓN: 
* id_comuna --> ON DELETE CASCADE. JUSTIFICACIÓN: 
# POBLAR TABLA DESDE CSV #
\COPY tiendascomunascobertura FROM Entrega2/csv/TiendasComunasCobertura.csv DELIMITER ',';



##### 11) DIRECCIONESUSUARIOS #### 
# SQL # 
CREATE TABLE direccionesusuarios(id_usuario INT, id_direccion INT, PRIMARY KEY(id_usuario, id_direccion), FOREIGN KEY(id_usuario) REFERENCES usuarios(id) ON DELETE CASCADE, FOREIGN KEY(id_direccion) REFERENCES direcciones(id) ON DELETE CASCADE);
# FOREIGN KEY #
* id_usuario --> ON DELETE CASCADE. JUSTIFICACIÓN: 
* id_direccion --> ON DELETE CASCADE. JUSTIFICACIÓN: 
# POBLAR TABLA DESDE CSV #
\COPY direccionesusuarios FROM Entrega2/csv/DireccionesUsuarios.csv DELIMITER ',';



#### 12) PERTENECEA ####
# SQL # 
CREATE TABLE pertenecea(id_producto INT, id_tienda INT, PRIMARY KEY(id_producto, id_tienda), FOREIGN KEY(id_producto) REFERENCES productos(id) ON DELETE CASCADE, FOREIGN KEY(id_tienda) REFERENCES tiendas(id) ON DELETE CASCADE);
# FOREIGN KEY #
* id_producto --> ON DELETE CASCADE. JUSTIFICACIÓN: 
* id_tienda --> ON DELETE CASCADE. JUSTIFICACIÓN: 
# POBLAR TABLA DESDE CSV #
\COPY pertenecea FROM Entrega2/csv/PerteneceA.csv DELIMITER ',';


#### 13) PRODUCTOSNOCOMESTIBLES ####
# SQL # 
CREATE TABLE productosnocomestibles(id INT PRIMARY KEY, ancho FLOAT, alto FLOAT, largo FLOAT, peso FLOAT, FOREIGN KEY(id) REFERENCES productos(id) ON DELETE CASCADE);
# FOREIGN KEY #
* id --> ON DELETE CASCADE. JUSTIFICACIÓN: 
# POBLAR TABLA DESDE CSV #
\COPY productosnocomestibles FROM Entrega2/csv/ProductosNoComestibles.csv DELIMITER ',';


#### 14) PRODUCTOSCOMESTIBLESENCONSERVAS ####
# SQL #
CREATE TABLE productoscomestiblesenconservas(id INT PRIMARY KEY, metodo_conservacion VARCHAR(100), fecha_expiracion DATE, FOREIGN KEY(id) REFERENCES productos(id) ON DELETE CASCADE);
# FOREIGN KEY #
* id --> ON DELETE CASCADE. JUSTIFICACIÓN: 
# POBLAR TABLA DESDE CSV #
\COPY productoscomestiblesenconservas FROM Entrega2/csv/ProductosComestiblesEnConservas.csv DELIMITER ',';


#### 15) PRODUCTOSCOMESTIBLESCONGELADOS ####
# SQL #
CREATE TABLE productoscomestiblescongelados(id INT PRIMARY KEY, peso FLOAT, fecha_expiracion DATE, FOREIGN KEY(id) REFERENCES productos(id) ON DELETE CASCADE);
# FOREIGN KEY #
* id --> ON DELETE CASCADE. JUSTIFICACIÓN: 
# POBLAR TABLA DESDE CSV #
\COPY productoscomestiblescongelados FROM Entrega2/csv/ProductosComestiblesCongelados.csv DELIMITER ',';



#### 16) PRODUCTOSCOMESTIBLESFRESCOS ####
# SQL #
CREATE TABLE productoscomestiblesfrescos(id INT PRIMARY KEY, duracion_sin_refrigeracion FLOAT, fecha_expiracion DATE, FOREIGN KEY(id) REFERENCES productos(id) ON DELETE CASCADE);
# FOREIGN KEY #
* id --> ON DELETE CASCADE. JUSTIFICACIÓN: 
# POBLAR TABLA DESDE CSV #
\COPY productoscomestiblesfrescos FROM Entrega2/csv/ProductosComestiblesFrescos.csv DELIMITER ',';


# CONSULTAS SQL

#1)  Muestre nombre de todas las tiendas, junto con los nombres de las comunas a cuales realizan despachos.
# SELECT Tiendas.id, Tiendas.nombre, Comunas.nombre FROM Tiendas, Comunas, TiendasComunasCobertura WHERE Tiendas.id = TiendasComunasCobertura.id_tienda AND Comunas.id = TiendasComunasCobertura.id_comuna ORDER BY Tiendas.id;

#2) Ingrese una comuna. Muestre todos los jefes de tiendas ubicadas en dicha comuna
#nombre_comuna_ingresado = input(str)
# SELECT DISTINCT Trabajadores.id, Trabajadores.nombre, Trabajadores.rut, Trabajadores.edad, Trabajadores.sexo FROM Trabajadores, Tiendas, Direcciones, TiendasTrabajadores, Comunas WHERE TiendasTrabajadores.id_tienda = Tiendas.id AND Tiendas.id_jefe = TiendasTrabajadores.id_trabajador AND Tiendas.id_direccion = Direcciones.id AND Direcciones.id_comuna = Comunas.id AND Comunas.nombre = {nombre_comuna_ingresado};

#3) Seleccione un tipo de producto. Muestre todas las tiendas que venden al menos un producto de dicha categoría.
#Hay que dar las siguientes opciones para elegir:
#a = ProductosNoComestibles
#b = ProductosComestiblesEnConservas
#c = ProductosComestiblesCongelados
#d = ProductosComestiblesFrescos
#e = ProductosComestibles

#si marca a:
#SELECT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM Tiendas, PerteneceA, Productos, ProductosNoComestibles WHERE Productos.id =  ProductosNoComestibles.id AND Productos.id = PerteneceA.id_producto AND Tiendas.id = PerteneceA.id_tienda;

#si marca b:
#SELECT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM Tiendas, PerteneceA, Productos, ProductosComestiblesEnConservas WHERE Productos.id =  ProductosComestiblesEnConservas.id AND Productos.id = PerteneceA.id_producto AND Tiendas.id = PerteneceA.id_tienda;

#si marca c:
#SELECT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM Tiendas, PerteneceA, Productos, ProductosComestiblesCongelados WHERE Productos.id =  ProductosComestiblesCongelados.id AND Productos.id = PerteneceA.id_producto AND Tiendas.id = PerteneceA.id_tienda;

#si marca d:
#SELECT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM Tiendas, PerteneceA, Productos, ProductosComestiblesFrescos WHERE Productos.id =  ProductosComestiblesFrescos.id AND Productos.id = PerteneceA.id_producto AND Tiendas.id = PerteneceA.id_tienda;

#si marca e:
#es la unión de las consultas b, c y d
#(SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM Tiendas, PerteneceA, Productos, ProductosComestiblesEnConservas WHERE Productos.id =  ProductosComestiblesEnConservas.id AND Productos.id = PerteneceA.id_producto AND Tiendas.id = PerteneceA.id_tienda) UNION (SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM Tiendas, PerteneceA, Productos, ProductosComestiblesCongelados WHERE Productos.id =  ProductosComestiblesCongelados.id AND Productos.id = PerteneceA.id_producto AND Tiendas.id = PerteneceA.id_tienda) UNION (SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM Tiendas, PerteneceA, Productos, ProductosComestiblesFrescos WHERE Productos.id =  ProductosComestiblesFrescos.id AND Productos.id = PerteneceA.id_producto AND Tiendas.id = PerteneceA.id_tienda);


#4) Ingrese una descripción. Muestre todos los usuarios que compraron el producto con esa descripción.
#descripcion = input(str)
 #Usuarios(id, nombre, rut, edad, sexo)
# SELECT DISTINCT Usuarios.id, Usuarios.nombre, Usuarios.rut, Usuarios.edad, Usuarios.sexo FROM Compras, ComprasPorProducto, Usuarios, Productos WHERE ComprasPorProducto.id_producto = Productos.id AND ComprasPorProducto.id_compra = Compras.id AND Compras.id_usuario = Usuarios.id AND Productos.descripcion = {descripcion};


#5) Ingrese el nombre de una comuna. Muestre la edad promedio de los trabajadores de tiendas en esa comuna.
#nombre_comuna_ingresado = input(str)
# SELECT AVG(Trabajadores.edad) FROM Trabajadores, TiendasTrabajadores, Tiendas, Direcciones, Comunas WHERE TiendasTrabajadores.id_tienda = Tiendas.id AND Tiendas.id_direccion = Direcciones.id AND Direcciones.id_comuna = Comunas.id AND TiendasTrabajadores.id_trabajador = Trabajadores.id AND Comunas.nombre = '{nombre_comuna_ingresado}' GROUP BY Comunas.nombre;

#6) Seleccione un tipo de producto. Muestre las tiendas que han registrado la venta de la mayor cantidad de productos del tipo seleccionado.
#Hay que dar las siguientes opciones para elegir:
#a = ProductosNoComestibles
#b = ProductosComestiblesEnConservas
#c = ProductosComestiblesCongelados
#d = ProductosComestiblesFrescos
#e = ProductosComestibles

SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado

#si marca a:
#tabla_tiendas_cantidad_productos_vendidos
#SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS suma FROM ComprasPorProducto, Compras, Tiendas, ProductosNoComestibles, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosNoComestibles.id GROUP BY Tiendas.id ORDER BY suma;

#SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre



18178

#valor_maximo_cantidades
#SELECT MAX(A.cantidad_de_productos_vendidos_del_tipo_seleccionado) FROM (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosNoComestibles, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosNoComestibles.id GROUP BY Tiendas.id) AS A;
#consulta final
#SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM ComprasPorProducto, Compras, Tiendas, ProductosNoComestibles, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosNoComestibles.id AND cantidad_de_productos_vendidos_del_tipo_seleccionado = (SELECT MAX(A.cantidad_de_productos_vendidos_del_tipo_seleccionado) FROM (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosNoComestibles, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosNoComestibles.id GROUP BY Tiendas.id) AS A);

#finalisima
SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe, SUM(ComprasPorProducto.cantidad) AS resultado_suma FROM ComprasPorProducto, Compras, Tiendas, ProductosNoComestibles, Productos, (SELECT MAX(A.cantidad_de_productos_vendidos_del_tipo_seleccionado) AS valormaximo FROM (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosNoComestibles, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosNoComestibles.id GROUP BY Tiendas.id) AS A) AS max WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosNoComestibles.id AND resultado_suma = max.valormaximo;


#si marca b:
#tabla_tiendas_cantidad_productos_vendidos
#SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesEnConservas, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesEnConservas.id GROUP BY Tiendas.id;
#valor_maximo_cantidades
#SELECT MAX(A.cantidad_de_productos_vendidos_del_tipo_seleccionado) FROM (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesEnConservas, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesEnConservas.id GROUP BY Tiendas.id) AS A;
#consulta final
#SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesEnConservas, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesEnConservas.id AND cantidad_de_productos_vendidos_del_tipo_seleccionado = (SELECT MAX(A.cantidad_de_productos_vendidos_del_tipo_seleccionado) FROM (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesEnConservas, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesEnConservas.id GROUP BY Tiendas.id) AS A);


#si marca c:
#tabla_tiendas_cantidad_productos_vendidos
#SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesCongelados, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesCongelados.id GROUP BY Tiendas.id;
#valor_maximo_cantidades
#SELECT MAX(A.cantidad_de_productos_vendidos_del_tipo_seleccionado) FROM (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesCongelados, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesCongelados.id GROUP BY Tiendas.id) AS A;
#consulta final
#SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesCongelados, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesCongelados.id AND cantidad_de_productos_vendidos_del_tipo_seleccionado = (SELECT MAX(A.cantidad_de_productos_vendidos_del_tipo_seleccionado) FROM (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesCongelados, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesCongelados.id GROUP BY Tiendas.id) AS A);


#si marca d:
#tabla_tiendas_cantidad_productos_vendidos
#SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesFrescos, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesFrescos.id GROUP BY Tiendas.id;
#valor_maximo_cantidades
#SELECT MAX(A.cantidad_de_productos_vendidos_del_tipo_seleccionado) FROM (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesFrescos, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesFrescos.id GROUP BY Tiendas.id) AS A;
#consulta final
#SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesFrescos, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesFrescos.id AND cantidad_de_productos_vendidos_del_tipo_seleccionado = (SELECT MAX(A.cantidad_de_productos_vendidos_del_tipo_seleccionado) FROM (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesFrescos, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesFrescos.id GROUP BY Tiendas.id) AS A);

#si marca e:
#tabla_tiendas_cantidad_productos_vendidos
#SELECT id_tienda, nombre_tienda, SUM(cantidad_de_productos_vendidos_del_tipo_seleccionado) FROM ((SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesFrescos, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesFrescos.id GROUP BY Tiendas.id) AS consulta_frescos) UNION (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesCongelados, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesCongelados.id GROUP BY Tiendas.id) AS consulta_congelados) UNION (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesEnConservas, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesEnConservas.id GROUP BY Tiendas.id) AS consulta_conservas)) AS tres_consultas GROUP BY id_tienda, nombre_tienda;
#valor_maximo_cantidades
#SELECT MAX(A.cantidad_de_productos_vendidos_del_tipo_seleccionado) FROM (SELECT id_tienda, nombre_tienda, SUM(cantidad_de_productos_vendidos_del_tipo_seleccionado) FROM ((SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesFrescos, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesFrescos.id GROUP BY Tiendas.id) AS consulta_frescos) UNION (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesCongelados, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesCongelados.id GROUP BY Tiendas.id) AS consulta_congelados) UNION (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesEnConservas, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesEnConservas.id GROUP BY Tiendas.id) AS consulta_conservas)) AS tres_consultas GROUP BY id_tienda, nombre_tienda) AS A;
#consulta final
#SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesFrescos, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesFrescos.id AND cantidad_de_productos_vendidos_del_tipo_seleccionado = (SELECT MAX(A.cantidad_de_productos_vendidos_del_tipo_seleccionado) FROM (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosComestiblesFrescos, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosComestiblesFrescos.id GROUP BY Tiendas.id) AS A));


SELECT DISTINCT Tiendas.id, Tiendas.nombre, Tiendas.id_direccion, Tiendas.id_jefe, SUM(ComprasPorProducto.cantidad) AS resultado_suma FROM ComprasPorProducto, Compras, Tiendas, ProductosNoComestibles, Productos, (SELECT MAX(A.cantidad_de_productos_vendidos_del_tipo_seleccionado) AS valormaximo FROM (SELECT Tiendas.id AS id_tienda, Tiendas.nombre AS nombre_tienda, SUM(ComprasPorProducto.cantidad) AS cantidad_de_productos_vendidos_del_tipo_seleccionado FROM ComprasPorProducto, Compras, Tiendas, ProductosNoComestibles, Productos WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosNoComestibles.id GROUP BY Tiendas.id) AS A) AS max WHERE Compras.id = ComprasPorProducto.id_compra AND Compras.id_tienda = Tiendas.id AND Productos.id = ProductosNoComestibles.id AND resultado_suma = max.valormaximo GROUP BY Tiendas.id;




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
  