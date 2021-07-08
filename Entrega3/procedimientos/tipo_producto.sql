CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
tipo_producto (id_producto int)

-- declaramos lo que retorna 
RETURNS VARCHAR AS $$

-- definimos nuestra función
BEGIN
    -- control de flujo
    IF id_producto IN (SELECT id FROM ProductosNoComestibles) THEN
        RETURN 'No comestible';
    
    ELSE
        RETURN 'Comestible';

    END IF;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql