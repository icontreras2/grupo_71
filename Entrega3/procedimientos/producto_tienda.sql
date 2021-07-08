CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
producto_tienda (producto_id int, tienda_id int)

-- declaramos lo que retorna 
RETURN boolean AS $$

-- definimos nuestra función
BEGIN
    -- control de flujo
    IF producto_id IN (SELECT id_producto FROM PerteneceA WHERE id_tienda = tienda_id) THEN
        RETURN TRUE;
    
    ELSE
        RETURN FALSE;

    END IF;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql