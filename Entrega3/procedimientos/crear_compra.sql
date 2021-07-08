CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
crear_compra (id_usuario int, id_direccion int, id_tienda int, id_producto, int, cantidad int)

-- declaramos lo que retorna 
RETURN BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
id_compra int;

-- definimos nuestra función
BEGIN

    SELECT INTO id_compra
    MAX(id)
    FROM Compras;

    INSERT INTO Compras VALUES(id_compra + 1, id_usuario, id_direccion, id_tienda)
    INSERT INTO ComprasPorProducto VALUES(id_compra + 1, id_producto, cantidad)
    RETURN TRUE;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql