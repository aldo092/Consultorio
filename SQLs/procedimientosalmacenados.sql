delimiter //
CREATE PROCEDURE inserta_paciente(sCurp varchar(18), sNombre VARCHAR(50),sApPat VARCHAR(50), sApMat VARCHAR(50), sSexo CHAR(1), dFecha DATE,
  sTel VARCHAR(13), sDireccion VARCHAR(100), sCP CHAR(5), sEmail VARCHAR(50),sEstadoCivil VARCHAR(50) )
  BEGIN
    INSERT INTO Paciente(sCurpPaciente,sNombre,sApPaterno,sApMaterno,sSexo,dFecNacimiento,sTelefono,sDireccion,sCP,sEmail,sEstadoCivil) VALUES (sCurp, sNombre,sApPat,sApMat, sSexo,dFecha,sTel,sDireccion,sCP,sEmail,sEstadoCivil);
  END;
//

delimiter //
CREATE PROCEDURE  inserta_AntePatologicos( nNumero INT, sAlergias VARCHAR(200),sCardiopatias VARCHAR(100), sTransfusiones VARCHAR(50),sDiabetico VARCHAR(50),sCardiovascular VARCHAR(50),sHTA VARCHAR(50))
  BEGIN
    INSERT INTO AntePatologicos(nNumero, sAlergias, sCardiopatias, sTranfusiones, sDiabetico, sCardioVasculares, sHTA) VALUES (nNumero,sAlergias,sCardiopatias,sTranfusiones,sDiabetico,sCardiovascular,sHTA);
    END ;
//

DELIMITER //
CREATE PROCEDURE inserta_AnteNoPatologicos(nNumero int,sReligion VARCHAR(50),bTabaquismo CHAR(1),sEscolaridad VARCHAR(50),sOcupacion VARCHAR(50),bAlcoholismo VARCHAR(50), SDrogas VARCHAR(50), bAgua CHAR(1),bElectricidad CHAR(1), bDrenaje CHAR(1))
  BEGIN
    INSERT INTO AnteNoPatologicos(nNumero, sReligion, bTabaquismo, sEscolaridad, sOcupacion, bAlcoholismo, sDrogas, bAguaPotable, bElectricidad, bDrenaje) VALUES (nNumero,sReligion,bTabaquismo,sEscolaridad,sOcupacion,bAlcoholismo,SDrogas,bAgua,bElectricidad,bDrenaje );
  END //

DELIMITER //
CREATE PROCEDURE  inserta_AntecenteFam(nNumero int, sAlcoholismo VARCHAR(50), sAlergias VARCHAR(200), SAsma VARCHAR(50), sCancer VARCHAR(50), sCongenitos VARCHAR(50), sConvulsiones VARCHAR(50),sDiabetes VARCHAR(50),sHipertension VARCHAR(50),sDrogadiccion VARCHAR(50),sTabaquismo VARCHAR(50))
BEGIN
  INSERT INTO AntecedenteFam(nNumero, sAlcoholismo, sAlergias, sAsma, sCancer, sCongenitos, sConvulsiones, sDiabetes, sHipertension, sDrogadiccion, sTabaquismo) VALUES (nNumero,sAlergias,SAsma, sCancer,sCongenitos,sConvulsiones,sDiabetes,sHipertension,sDrogadiccion, sTabaquismo);
END //

/*Fecha de creación 6 de agosto */
delimiter //
CREATE PROCEDURE buscarEmailPassUser(IN user varchar(60), IN email varchar(60), spass varchar(30))
  BEGIN
    SELECT  usuarios.sEmail FROM usuarios WHERE usuarios.sEmail = email AND usuarios.sPassword = md5(spass);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'SELECT', current_date, 'USUARIOS', CONCAT('Búsqueda de datos de inicio de sesión por el usuario ',user));
  END;
//

call buscarEmailPassUser('llarena_92@hotmail.com','llarena_92@hotmail.com','pablo123');

delimiter //
CREATE PROCEDURE  insertarUsuario(IN user varchar(60), IN email varchar(60), IN pass varchar(30))
  BEGIN
    INSERT INTO usuarios(sEmail,sPassword, dFechaRegistro) VALUES(email, md5(pass), current_date);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'USUARIOS', CONCAT('Se insertó el usuario ', email));
  END;
//

delimiter //
CREATE PROCEDURE insertaRol(IN user varchar(60), IN descripcion varchar(200))
  BEGIN
    INSERT INTO roles(sDescripcion) VALUES (descripcion);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'ROL', CONCAT('Se insertó el rol  ', descripcion));
  END;
//

delimiter //
CREATE PROCEDURE insertarPersonal(IN user varchar(60), IN nombre varchar(40), IN apPaterno varchar(40), IN apMaterno varchar(40), IN telefono VARCHAR(15),
                                  IN sexo char(1), IN curp varchar(18), IN rol int(11), IN email varchar(60), IN pass  varchar(30))
  BEGIN
    call insertarUsuario(email, pass);

    INSERT INTO Personal(sNombres, sApPaterno, sApMaterno, sTelefono, sSexo, sCurp, nIdRol, sEmail, bEstatus)
    VALUES (nombre, apPaterno, apMaterno, telefono, sexo, curp, rol, email, 1);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'PERSONAL', CONCAT('Se insertó un nuevo colega  ', nombre, ' ', apPaterno, ' ', apMaterno));
  END;
//


/*Fecha de creación 9 de agosto*/
delimiter //
CREATE PROCEDURE equalNIP(IN user varchar(60), nip int(11))
  BEGIN
    SELECT accesoss.Email, accesos.nNIP FROM accesos WHERE accesos.sEmail = user AND accesos.nNIP = md5(nip);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'SELECT', current_date, 'ACCESOS', CONCAT('Búsqueda de identificador personal por el usuario ', user));
  END;
//

delimiter //
CREATE PROCEDURE checkValue(IN nip int(11))
  BEGIN
    SELECT nNIP FROM accesos WHERE  nNIP = md5(nip);
  END;
//

delimiter //
CREATE PROCEDURE insertaAcceso(IN user varchar(60), IN nip int(11))
  BEGIN
    INSERT INTO accesos(sEmail, nNIP, bEstado) VALUES(user, md5(nip), 1);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'ACCESOS', CONCAT('Registro de NIP por el usuario', user));
  END;
//

delimiter //
CREATE PROCEDURE updateStatusAccess(IN user varchar(60), IN nip int(11))
  BEGIN
    UPDATE accesos
    SET bEstado = 0
    WHERE sEmail = user AND nNIP = md5(nip);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'UPDATE', current_date, 'ACCESOS', CONCAT('Invalidó un NIP por exceso de intentos de validacion el  usuario ', user));
  END;

