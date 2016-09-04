/*Fecha de creación 6 de agosto */
delimiter //
CREATE PROCEDURE buscarEmailPassUser(IN user varchar(60), IN email varchar(60), spass varchar(30))
  BEGIN
    SELECT  usuarios.sEmail FROM usuarios
      LEFT OUTER JOIN personal
        ON personal.sEmail = usuarios.sEmail
    WHERE usuarios.sEmail = email AND usuarios.sPassword = md5(spass)
          AND personal.bEstatus = 1;

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'SELECT', current_date, 'USUARIOS', CONCAT('Búsqueda de datos de inicio de sesión por el usuario ',user));
  END;
//


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
                                  IN sexo char(1), IN curp varchar(18), IN rol int(11), IN email varchar(60), IN pass  varchar(30), IN imagen varchar(200))
  BEGIN
    call insertarUsuario(user, email, pass);

    INSERT INTO Personal(sNombres, sApPaterno, sApMaterno, sTelefono, sSexo, sCurp, sEmail, bEstatus, sImagen)
    VALUES (nombre, apPaterno, apMaterno, telefono, sexo, curp, email, 1, imagen);

    call insertaUserRol(user, email, rol);

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
CREATE PROCEDURE insertaAcceso2(IN us1 varchar(60), IN user varchar(60), IN nip int(11))
  BEGIN
    INSERT INTO accesos(sEmail, nNIP, bEstado) VALUES(user, md5(nip), 1);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(us1, 'INSERT', current_date, 'ACCESOS', CONCAT('Registro de NIP por el usuario', us1));
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


delimiter //
CREATE PROCEDURE buscarPermisos(IN user varchar(60))
  BEGIN
    SELECT distinct menu.nClave, menu.sDescripcion as Descrip
    FROM menu
      LEFT OUTER JOIN funcion
        ON funcion.nPadre = menu.nClave
      LEFT OUTER JOIN funcion_rol
        ON funcion_rol.nClaveFuncion = funcion.nClaveFuncion
      LEFT OUTER JOIN roles
        ON roles.nIdRol = funcion_rol.nIdRol
      LEFT OUTER JOIN usuario_rol
        ON usuario_rol.nIdRol = roles.nIdRol
      LEFT OUTER JOIN usuarios
        ON usuarios.sEmail = usuario_rol.sEmail
    WHERE usuarios.sEmail = user;
  END;
//


delimiter //
CREATE PROCEDURE buscarFunciones(IN user varchar(60), IN menu int(11))
  BEGIN
    SELECT funcion.nClaveFuncion, funcion.sDescripcion, funcion.sRutaPag, funcion.nPadre
    FROM funcion
      LEFT OUTER JOIN menu
        ON menu.nClave = funcion.nPadre
      LEFT OUTER JOIN funcion_rol
        ON funcion_rol.nClaveFuncion = funcion.nClaveFuncion
      LEFT OUTER JOIN roles
        ON roles.nIdRol = funcion_rol.nIdRol
      LEFT OUTER JOIN usuario_rol
        ON usuario_rol.nIdRol = roles.nIdRol
      LEFT OUTER JOIN usuarios
        ON usuarios.sEmail = usuario_rol.sEmail
    WHERE menu.nClave = menu AND usuarios.sEmail = user;

  END;
//

delimiter //
CREATE PROCEDURE buscarDatosUsuario(IN email varchar(60))
  BEGIN
    Select sNombres, sApPaterno, sApMaterno, bEstatus, sImagen
    FROM Personal
      LEFT OUTER JOIN Usuarios
        ON usuarios.sEmail = personal.sEmail
    WHERE usuarios.sEmail = email;
  END;
//

delimiter //
CREATE PROCEDURE buscarTodosPersonal()
  BEGIN
    SELECT Personal.nIdPersonal, Personal.sNombres, Personal.sApPaterno, Personal.sApMaterno, Personal.sTelefono, Personal.sSexo,
      Personal.sCURP, Personal.sEmail, Personal.bEstatus, Roles.sDescripcion
    FROM Personal
      LEFT OUTER JOIN usuarios
        ON usuarios.sEmail = Personal.sEmail
      LEFT OUTER JOIN usuario_rol
        ON usuario_rol.sEmail = usuarios.sEmail
      LEFT OUTER JOIN roles
        ON roles.nIdRol = usuario_rol.nIdRol;
  END;
//

delimiter //
CREATE PROCEDURE buscarTodosRoles()
  BEGIN
    SELECT * FROM roles;
  END;
//
delimiter //
CREATE PROCEDURE insertaMedico(IN user varchar(60), IN idPersona int(11), IN numcedula varchar(20),IN feccedula date, IN cedespe varchar(20),
                               IN feccedesp date, IN snumtel varchar(15), IN especialidad varchar(100))
  BEGIN
    INSERT INTO medico (nIdPersonal, sNumCedula, dFechaExpedicionCed, sNumCedEsp, dFecExpedCedEsp, sNumTelefono1, sNumTelefono2, sEspecialidad)
    VALUES(idPersona, numcedula, feccedula, cedespe, feccedesp, snumtel, snumtel, especialidad);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'medico', 'Inserción de médico');
  END;
//

delimiter //
CREATE PROCEDURE buscarDatosMedico(IN idPersonal int(11))
  BEGIN
    SELECT medico.sNumCedula, medico.dFechaExpedicionCed, medico.sNumCedEsp, medico.dFecExpedCedEsp, medico.sNumTelefono1, medico.sEspecialidad
    FROM medico
    WHERE medico.nIdPersonal = idPersonal;
  END;
//

delimiter //
CREATE PROCEDURE insertaPersonalMedico(IN user varchar(60), IN nombre varchar(40), IN apPaterno varchar(40), IN apMaterno varchar(40), IN telefono VARCHAR(15),
                                       IN sexo char(1), IN curp varchar(18), IN rol int(11), IN email varchar(60), IN pass  varchar(30), IN numced varchar(20), IN fechacedula date,
                                       IN numcedesp varchar(20), IN feccedesp date, IN numtel varchar(15), IN especialidad varchar(100), IN imagen varchar(200))
  BEGIN
    call insertarUsuario(user, email, pass);

    INSERT INTO Personal(sNombres, sApPaterno, sApMaterno, sTelefono, sSexo, sCurp, nIdRol, sEmail, bEstatus, sImagen)
    VALUES (nombre, apPaterno, apMaterno, telefono, sexo, curp, email, 1, imagen);

    SET @nPersonal = (SELECT LAST_INSERT_ID());

    call insertaMedico(user, @nPersonal, numced, fechacedula, numcedesp, feccedesp, numtel, especialidad);

    call insertaUserRol(user, email, rol);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'PERSONAL', CONCAT('Se insertó un nuevo colega  ', nombre, ' ', apPaterno, ' ', apMaterno));
  END;
//


delimiter //
CREATE PROCEDURE modificaPersonal1(IN user varchar(60), IN idpersonal int(11), IN nombres varchar(40), IN appaterno varchar(40), IN apmaterno varchar(40),
                                   IN telefono varchar(15), IN spass varchar(200), IN estatus int(11))
  BEGIN
    SET @smail = (SELECT sEmail FROM personal WHERE nIdPersonal = idpersonal);

    UPDATE usuarios
    SET sPassword = md5(spass)
    WHERE sEmail = @smail;

    UPDATE personal
    SET sNombres = nombres, sApPaterno = appaterno, sApMaterno = apmaterno, sTelefono = telefono, bEstatus = estatus
    WHERE nIdPersonal = idpersonal;

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'UPDATE', current_date, 'usuarios', concat('Modificación de contraseña al usuario ',@smail));

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'UPDATE', current_date, 'personal', concat('Modificación de datos básicos del usuario con clave ',idpersonal));
  END;
//

delimiter //
CREATE PROCEDURE modificaPersonal2(IN user varchar(60), IN idpersonal int(11), IN nombres varchar(40), IN appaterno varchar(40), IN apmaterno varchar(40),
                                   IN telefono varchar(15), IN estatus int(11))
  BEGIN
    UPDATE personal
    SET sNombres = nombres, sApPaterno = appaterno, sApMaterno = apmaterno, sTelefono = telefono, bEstatus = estatus
    WHERE nIdPersonal = idpersonal;

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'UPDATE', current_date, 'personal', concat('Modificación de datos básicos del usuario con clave ',idpersonal));
  END;
//

delimiter //
CREATE PROCEDURE modificarPersonalMedico1(IN user varchar(60), IN idpersonal int(11), IN nombres varchar(40), IN appaterno varchar(40), IN apmaterno varchar(40),
                                          IN telefono varchar(15),IN spass varchar(200), IN numced varchar(20), IN numcedesp varchar(20), IN numtel1 varchar(15), IN especialidad varchar(100), IN estatus int(11))
  BEGIN
    SET @smail = (SELECT sEmail FROM personal WHERE nIdPersonal = idpersonal);

    UPDATE usuarios
    SET sPassword = md5(spass)
    WHERE sEmail = @smail;

    UPDATE personal
    SET sNombres = nombres, sApPaterno = appaterno, sApMaterno = apmaterno, sTelefono = telefono, bEstatus = estatus
    WHERE nIdPersonal = idpersonal;

    UPDATE medico
    SET sNumCedula = numced, sNumCedEsp = numcedesp, sNumTelefono1 = numtel1, sNumTelefono2 = numtel1, sEspecialidad = especialidad
    WHERE nIdPersonal = idpersonal;

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'UPDATE', current_date, 'usuarios', concat('Modificación de contraseña al usuario ',@smail));

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'UPDATE', current_date, 'personal', concat('Modificación de datos básicos del usuario con clave ',idpersonal));

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'UPDATE', current_date, 'medico', concat('Modificación de datos del médico con clave ',idpersonal));

  END;
//

delimiter //
CREATE PROCEDURE modificarPersonalMedico2(IN user varchar(60), IN idpersonal int(11), IN nombres varchar(40), IN appaterno varchar(40), IN apmaterno varchar(40),
                                          IN telefono varchar(15), IN numced varchar(20), IN numcedesp varchar(20), IN numtel1 varchar(15), IN especialidad varchar(100), IN estatus int(11))
  BEGIN

    UPDATE personal
    SET sNombres = nombres, sApPaterno = appaterno, sApMaterno = apmaterno, sTelefono = telefono, bEstatus = estatus
    WHERE nIdPersonal = idpersonal;

    UPDATE medico
    SET sNumCedula = numced, sNumCedEsp = numcedesp, sNumTelefono1 = numtel1, sNumTelefono2 = numtel1, sEspecialidad = especialidad
    WHERE nIdPersonal = idpersonal;

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'UPDATE', current_date, 'personal', concat('Modificación de datos básicos del usuario con clave ',idpersonal));

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'UPDATE', current_date, 'medico', concat('Modificación de datos del médico con clave ',idpersonal));

  END;
//

delimiter //
CREATE PROCEDURE buscaDatosPersona(IN idpersona int(11))
  BEGIN
    SELECT Personal.nIdPersonal, Personal.sNombres, Personal.sApPaterno, Personal.sApMaterno, Personal.sTelefono, Personal.sSexo,
      Personal.sCURP, Personal.sEmail, Personal.bEstatus, Roles.sDescripcion, Personal.sImagen, Roles.nIdRol
    FROM Personal
      LEFT OUTER JOIN usuarios
        ON usuarios.sEmail = Personal.sEmail
      LEFT OUTER JOIN usuario_rol
        ON usuario_rol.sEmail = usuarios.sEmail
      LEFT OUTER JOIN roles
        ON roles.nIdRol = usuario_rol.nIdRol
    WHERE Personal.nIdPersonal = idpersona;
  END;
//

delimiter //
CREATE PROCEDURE insertaUserRol(IN user varchar(30), IN email varchar(60), rol int(11))
  BEGIN
    INSERT INTO usuario_rol(sEmail, nIdRol) VALUES (email, rol);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'usuario_rol', 'Inserción de un usuario y el rol que desempeña');
  END;
//


/*Fecha de creación 29 de agosto*/

DELIMITER //
CREATE PROCEDURE BuscaTodosPacientesExpediente()
  BEGIN
    select e.nNumero, e.sCurpPaciente, p.sNombre, p.sApPaterno, p.sApMaterno from expediente  e ,paciente p where e.sCurpPaciente=p.SCurpPaciente;

  END //

/*Fecha de creación 30 de agosto Procedimientos Almacenados de Antecedentes de pacientes*/

DELIMITER //
CREATE PROCEDURE insertarAntFam (IN user VARCHAR(60),IN Expediente varchar(20), IN Alcoholismo CHAR(2),IN Alergias CHAR(2), IN Asma CHAR(2), IN Cancer CHAR(2), IN Congenitos CHAR(2), IN Convulsiones CHAR(2), IN Diabetes CHAR(2),
  IN Hipertension CHAR(2), IN Drogas CHAR(2), IN Tabaquismo CHAR(2))
  BEGIN
    INSERT INTO antecedentefam(nNumero, sAlcoholismo, sAlergias,sAsma, sCancer, sCongenitos, sConvulsiones,sDiabetes,sHipertension,sDrogadiccion, sTabaquismo)
    VALUES( Expediente, Alcoholismo,Alergias,Asma,Cancer,Congenitos, Convulsiones,Diabetes,Hipertension,Drogas,Tabaquismo);
    INSERT INTO bitacora(sEmail, sAccion,dFechaAccion,sTabla,sDescripcionAccion)
    VALUES (user,'INSERT', current_date,'antecedentefam',CONCAT('se insertaron los antecedentes familiares del expediente ', Expediente));
  END ;
//

DELIMITER //
CREATE PROCEDURE insertarAntPat (IN user VARCHAR(60),IN Expediente varchar(20), IN Alergia VARCHAR(2),IN Cardiopatia VARCHAR(100), IN Transfusiones CHAR(2), IN Diabetes VARCHAR(50), IN Cardiovascular CHAR(2), IN HTA CHAR(2))
  BEGIN
    INSERT INTO antepatologicos(nNumero, sAlergias, sCardiopatias,sTranfusiones, sDiabetico, sCardioVasculares, sHTA)
    VALUES( Expediente, Alergia,Cardiopatia,Transfusiones,Diabetes,Cardiovascular,HTA);

    INSERT INTO bitacora(sEmail, sAccion,dFechaAccion,sTabla,sDescripcionAccion)
    VALUES (user,'INSERT', current_date,'antepatologicos',CONCAT('se insertaron los antecedentes patologicos del expediente ', Expediente));
  END ;
//


DELIMITER //
CREATE PROCEDURE insertarAntNoPat(IN user VARCHAR(60),IN Expediente VARCHAR(20), IN Religion VARCHAR(100), IN Tabaquismo CHAR(2),IN Escolaridad VARCHAR(50),IN Ocupacion VARCHAR(100), IN Alcoholismo CHAR(2), IN Drogas CHAR(2),IN Agua CHAR(2), IN Electridad CHAR(2),IN Drenaje CHAR(2), IN Wc CHAR(2))
  BEGIN
    INSERT INTO antenopatologicos(nNumero, sReligion, bTabaquismo, sEscolaridad, sOcupacion, bAlcoholismo, sDrogas, bAguaPotable, bElectricidad, bDrenaje, bServSanit)

    VALUES (Expediente, Religion, Tabaquismo, Escolaridad, Ocupacion, Alcoholismo, Drogas, Agua, Electridad, Drenaje, Wc);

    INSERT INTO bitacora(sEmail, sAccion,dFechaAccion,sTabla,sDescripcionAccion)
    VALUES (user,'INSERT', current_date,'antenopatologicos',CONCAT('se insertaron los antecedentes no patologicos del expediente ', Expediente));

  END ;
//

delimiter //
CREATE PROCEDURE checkAccess(IN usuario VARCHAR(60), IN descripcionfuncion varchar(150))
  BEGIN
    Select funcion.nClavefuncion
    FROM funcion
      LEFT OUTER JOIN funcion_rol
        ON funcion_rol.nClaveFuncion = funcion.nClaveFuncion
      LEFT OUTER JOIN roles
        ON roles.nIdRol = funcion_rol.nIdRol
      LEFT OUTER JOIN usuario_rol
        ON usuario_rol.nIdRol = roles.nIdrol
      LEFT OUTER JOIN usuarios
        ON usuario_rol.sEmail =  usuarios.sEmail
    WHERE usuarios.sEmail = usuario AND funcion.sRutaPag = descripcionfuncion;
  END;
//

delimiter //
CREATE PROCEDURE consultarBitacora()
  BEGIN
    SELECT nClaveAccion, sEmail, dFechaAccion, sTabla, sDescripcionAccion
    FROM bitacora
    WHERE dFechaAccion >= date_sub(curdate(), interval 3 month)
    ORDER BY dFechaAccion DESC;
  END;
//
