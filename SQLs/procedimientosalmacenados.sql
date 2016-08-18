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
CREATE PROCEDURE equalsNIP(IN user varchar(60), nip int(11))
  BEGIN
    SELECT accesos.sEmail, accesos.nNIP FROM accesos WHERE accesos.sEmail = user AND accesos.nNIP = md5(nip);

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
CREATE PROCEDURE insertarPaciente(IN user varchar(60),IN curp varchar(18),IN nombre varchar(50), IN apepa varchar(50), IN apema varchar(50),IN sexo char(1),IN fecha date, IN telefono varchar(13),IN direccion varchar(100),IN  cp varchar(5), IN correo varchar(50), IN estadocivil varchar(50))
  BEGIN
    INSERT INTO paciente(sCurpPaciente,sNombre,sApPaterno,sApMaterno,sSexo,dFecNacimiento,sTelefono,sDireccion,sCP,sEmail,sEstadoCivil)
    VALUES (curp, nombre,apepa,apema,sexo,fecha,telefono,direccion,cp,correo,estadocivil);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'paciente', CONCAT('Se insertó un nuevo paciente ', nombre, ' ', apepa, ' ', apema));
  END;
//

delimiter //
CREATE PROCEDURE insertarExpediente(IN user varchar(60),IN nExpediente varchar(20),IN Curp varchar(18))
  BEGIN
    INSERT INTO expediente(nNumero,sCurpPaciente)
    VALUES (nExpediente, Curp);
    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'expediente', CONCAT('Se insertó una nueva clave de expediente ', nExpediente, 'para el paciente  ', Curp));
  END;
//

DELIMITER //
CREATE PROCEDURE insertarAntPat (IN user VARCHAR(60),IN Expediente varchar(20), IN Alergia VARCHAR(200),IN Cardiopatia VARCHAR(100), IN Transfusiones VARCHAR(50), Diabetes VARCHAR(50), IN Cardiovascular VARCHAR(50), IN HTA VARCHAR(50))
  BEGIN
    INSERT INTO antepatologicos(nNumero, sAlergias, sCardipatias,sTransfusiones, sDiabetico, sCardioVasculares, sHTA)
      VALUES( Expediente, Alergia,Cardiopatia,Transfusiones,Diabetes,Cardiovascular,HTA);
    INSERT INTO bitacora(sEmail, sAccion,dFechaAccion,sTabla,sDescripcionAccion)
      VALUES (user,'INSERT', current_date,'antepatologicos',CONCAT('se insertaron los antecedentes patologicos del expediente ', Expediente));
      END ;
//

