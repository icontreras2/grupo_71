CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
verificar_registrar (nombre varchar(100), rut varchar(20), edad int, sexo varchar(10), contraseña varchar(20))

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
id_max int;

-- definimos nuestra función
BEGIN

    -- control de flujo
    IF rut IN (SELECT rut FROM usuarios;) THEN
        RETURNS FALSE;
    
    ELSE
        SELECT INTO id_max
        MAX(id)
        FROM usuarios;

        insert into usuarios values(id_max + 1, nombre, rut, edad, sexo, contraseña);
        RETURNS TRUE;

    END IF;


-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql