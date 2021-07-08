CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
usuario_tienda_cobertura (direccion_id int, tienda_id int)

-- declaramos lo que retorna 
RETURN boolean AS $$

-- definimos nuestra función
BEGIN
    -- control de flujo
    IF direccion_id IN (SELECT Direcciones.id FROM Direcciones, TiendasComunasCovertura WHERE Direcciones.id_comuna = TiendasComunasCovertura.id_comuna AND TiendasComunasCovertura.id_tienda = tienda_id) THEN
        RETURN TRUE;
    
    ELSE
        RETURN FALSE;

    END IF;

-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql