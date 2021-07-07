CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
verificar_ingreso (rut varchar(20), contraseña varchar(20))

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario

-- definimos nuestra función
BEGIN

    -- control de flujo
    IF rut NOT IN (SELECT rut FROM usuarios) THEN
        RETURNS FALSE;
    
    ELSE IF contraseña NOT IN (SELECT contraseña FROM usuarios WHERE usuarios.rut = rut) THEN
        RETURNS FALSE;
    
    ELSE
        RETURNS TRUE;
        
    END IF;


-- -- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql