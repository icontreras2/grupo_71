CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
importar_personal (nombre varchar(50), rut varchar(20), edad int, sexo varchar(10), contraseña varchar(20), id_direccion int)

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
id_max_usuario int;

-- definimos nuestra función
BEGIN

    -- control de flujo

    IF 'contraseña' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD COLUMN contraseña varchar(20);
        UPDATE usuarios SET contraseña = 'clave';

    END IF;

    IF rut IN (SELECT usuarios.rut FROM usuarios) THEN
        RETURN FALSE;
    
    ELSE
        SELECT INTO id_max_usuario
        MAX(id)
        FROM usuarios;

        INSERT INTO usuarios values(id_max_usuario + 1, nombre, rut, edad, sexo, contraseña);
        INSERT INTO direccionesusuarios values(id_max_usuario + 1, id_direccion);

        RETURN TRUE;

    END IF;




-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql