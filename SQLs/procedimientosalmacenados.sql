﻿DELIMITER //
CREATE PROCEDURE buscarEmailPassUser(IN user VARCHAR(60), IN email VARCHAR(60), spass VARCHAR(30))
  BEGIN
    SELECT usuarios.sEmail
    FROM usuarios
      LEFT OUTER JOIN personal
        ON personal.sEmail = usuarios.sEmail
    WHERE usuarios.sEmail = email AND usuarios.sPassword = md5(spass)
          AND personal.bEstatus = 1;

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES
      (user, 'SELECT', current_date, 'USUARIOS', CONCAT('Búsqueda de datos de inicio de sesión por el usuario ', user));
  END;
//

DELIMITER //
CREATE PROCEDURE insertarUsuario(IN user VARCHAR(60), IN email VARCHAR(60), IN pass VARCHAR(30))
  BEGIN
    INSERT INTO usuarios (sEmail, sPassword, dFechaRegistro) VALUES (email, md5(pass), current_date);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'USUARIOS', CONCAT('Se insertó el usuario ', email));
  END;
//

DELIMITER //
CREATE PROCEDURE insertaRol(IN user VARCHAR(60), IN descripcion VARCHAR(200))
  BEGIN
    INSERT INTO roles (sDescripcion) VALUES (descripcion);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'ROL', CONCAT('Se insertó el rol  ', descripcion));
  END;
//

DELIMITER //
CREATE PROCEDURE insertarPersonal(IN user      VARCHAR(60), IN nombre VARCHAR(40), IN apPaterno VARCHAR(40),
                                  IN apMaterno VARCHAR(40), IN telefono VARCHAR(15),
                                  IN sexo      CHAR(1), IN curp VARCHAR(18), IN rol INT(11), IN email VARCHAR(60),
                                  IN pass      VARCHAR(30), IN imagen VARCHAR(200))
  BEGIN
    CALL insertarUsuario(user, email, pass);

    INSERT INTO personal (sNombres, sApPaterno, sApMaterno, sTelefono, sSexo, sCurp, sEmail, bEstatus, sImagen)
    VALUES (nombre, apPaterno, apMaterno, telefono, sexo, curp, email, 1, imagen);

    CALL insertaUserRol(user, email, rol);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'PERSONAL',
            CONCAT('Se insertó un nuevo colega  ', nombre, ' ', apPaterno, ' ', apMaterno));
  END;
//


/*Fecha de creación 9 de agosto*/
DELIMITER //
CREATE PROCEDURE equalsNIP(IN user VARCHAR(60), nip INT(11))
  BEGIN
    SELECT
      accesos.sEmail,
      accesos.nNIP
    FROM accesos
    WHERE accesos.sEmail = user AND accesos.nNIP = md5(nip);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES
      (user, 'SELECT', current_date, 'ACCESOS', CONCAT('Búsqueda de identificador personal por el usuario ', user));
  END;
//


DELIMITER //
CREATE PROCEDURE checkValue(IN nip INT(11))
  BEGIN
    SELECT nNIP
    FROM accesos
    WHERE nNIP = md5(nip);
  END;
//

DELIMITER //
CREATE PROCEDURE insertaAcceso(IN user VARCHAR(60), IN nip INT(11))
  BEGIN
    INSERT INTO accesos (sEmail, nNIP, bEstado) VALUES (user, md5(nip), 1);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'ACCESOS', CONCAT('Registro de NIP por el usuario', user));
  END;
//

DELIMITER //
CREATE PROCEDURE insertaAcceso2(IN us1 VARCHAR(60), IN user VARCHAR(60), IN nip INT(11))
  BEGIN
    INSERT INTO accesos (sEmail, nNIP, bEstado) VALUES (user, md5(nip), 1);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (us1, 'INSERT', current_date, 'ACCESOS', CONCAT('Registro de NIP por el usuario', us1));
  END;
//

DELIMITER //
CREATE PROCEDURE insertarPaciente(IN user      VARCHAR(60), IN curp VARCHAR(18), IN nombre VARCHAR(50),
                                  IN apepa     VARCHAR(50), IN apema VARCHAR(50), IN sexo CHAR(1), IN fecha DATE,
                                  IN telefono  VARCHAR(13), IN direccion VARCHAR(100), IN cp VARCHAR(5),
                                  IN correo    VARCHAR(50), IN estadocivil VARCHAR(50), IN rfc VARCHAR(18),
                                  IN localidad VARCHAR(100), IN municipio INT, IN estado INT, IN medico INT, IN consultorio INT)
  BEGIN
    INSERT INTO paciente (sCurpPaciente, sNombre, sApPaterno, sApMaterno, sSexo, dFecNacimiento, sTelefono, sDireccion, sCP, sEmail, sEstadoCivil, sRFC, sLocalidad, sMunicipio, sEstado, sMedico,sConsultorio)
    VALUES
      (curp, nombre, apepa, apema, sexo, fecha, telefono, direccion, cp, correo, estadocivil, rfc, localidad, municipio,
       estado, medico,consultorio);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'paciente',
            CONCAT('Se insertó un nuevo paciente ', nombre, ' ', apepa, ' ', apema));
  END;
//

DELIMITER //
CREATE PROCEDURE insertarExpediente(IN user VARCHAR(60), IN nExpediente VARCHAR(20), IN Curp VARCHAR(18))
  BEGIN
    INSERT INTO expediente (nNumero, sCurpPaciente)
    VALUES (nExpediente, Curp);
    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'expediente',
            CONCAT('Se insertó una nueva clave de expediente ', nExpediente, 'para el paciente  ', Curp));
  END;
//


DELIMITER //
CREATE PROCEDURE buscarPermisos(IN user VARCHAR(60))
  BEGIN
    SELECT DISTINCT
      menu.nClave,
      menu.sDescripcion AS Descrip
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


DELIMITER //
CREATE PROCEDURE buscarFunciones(IN user VARCHAR(60), IN menu INT(11))
  BEGIN
    SELECT
      funcion.nClaveFuncion,
      funcion.sDescripcion,
      funcion.sRutaPag,
      funcion.nPadre
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

DELIMITER //
CREATE PROCEDURE buscarDatosUsuario(IN email VARCHAR(60))
  BEGIN
    SELECT
      sNombres,
      sApPaterno,
      sApMaterno,
      bEstatus,
      sImagen
    FROM personal
      LEFT OUTER JOIN usuarios
        ON usuarios.sEmail = personal.sEmail
    WHERE usuarios.sEmail = email;
  END;
//

DELIMITER //
CREATE PROCEDURE buscarTodosPersonal()
  BEGIN
    SELECT
      personal.nIdPersonal,
      personal.sNombres,
      personal.sApPaterno,
      personal.sApMaterno,
      personal.sTelefono,
      personal.sSexo,
      personal.sCURP,
      personal.sEmail,
      personal.bEstatus,
      roles.sDescripcion
    FROM personal
      LEFT OUTER JOIN usuarios
        ON usuarios.sEmail = personal.sEmail
      LEFT OUTER JOIN usuario_rol
        ON usuario_rol.sEmail = usuarios.sEmail
      LEFT OUTER JOIN roles
        ON roles.nIdRol = usuario_rol.nIdRol;
  END;
//

DELIMITER //
CREATE PROCEDURE buscarTodosRoles()
  BEGIN
    SELECT *
    FROM roles;
  END;
//

DELIMITER //
CREATE PROCEDURE insertaMedico(IN user      VARCHAR(60), IN idPersona INT(11), IN numcedula VARCHAR(20),
                               IN feccedula DATE, IN cedespe VARCHAR(20),
                               IN feccedesp DATE, IN snumtel VARCHAR(15), IN especialidad int(11))
  BEGIN
    INSERT INTO medico (nIdPersonal, sNumCedula, dFechaExpedicionCed, sNumCedEsp, dFecExpedCedEsp, sNumTelefono1, sNumTelefono2, nIdEspecialidad)
    VALUES (idPersona, numcedula, feccedula, cedespe, feccedesp, snumtel, snumtel, especialidad);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'medico', 'Inserción de médico');
  END;
//

DELIMITER //
CREATE PROCEDURE buscarDatosMedico(IN idPersonal INT(11))
  BEGIN
    SELECT
      medico.sNumCedula,
      medico.dFechaExpedicionCed,
      medico.sNumCedEsp,
      medico.dFecExpedCedEsp,
      medico.sNumTelefono1,
      especialidad.sDescripcion
    FROM medico
      LEFT OUTER JOIN especialidad
        ON especialidad.nIdEspecialidad = medico.nIdEspecialidad
    WHERE medico.nIdPersonal = idPersonal;
  END;
//

DELIMITER //
CREATE PROCEDURE insertaPersonalMedico(IN user         VARCHAR(60), IN nombre VARCHAR(40), IN apPaterno VARCHAR(40),
                                       IN apMaterno    VARCHAR(40), IN telefono VARCHAR(15),
                                       IN sexo         CHAR(1), IN curp VARCHAR(18), IN rol INT(11),
                                       IN email        VARCHAR(60), IN pass VARCHAR(30), IN numced VARCHAR(20),
                                       IN fechacedula  DATE,
                                       IN numcedesp    VARCHAR(20), IN feccedesp DATE, IN numtel VARCHAR(15),
                                       IN especialidad int(11), IN imagen VARCHAR(200))
  BEGIN
    CALL insertarUsuario(user, email, pass);

    INSERT INTO personal (sNombres, sApPaterno, sApMaterno, sTelefono, sSexo, sCurp, sEmail, bEstatus, sImagen)
    VALUES (nombre, apPaterno, apMaterno, telefono, sexo, curp, email, 1, imagen);

    SET @nPersonal = (SELECT LAST_INSERT_ID());

    CALL insertaMedico(user, @nPersonal, numced, fechacedula, numcedesp, feccedesp, numtel, especialidad);

    CALL insertaUserRol(user, email, rol);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'PERSONAL',
            CONCAT('Se insertó un nuevo colega  ', nombre, ' ', apPaterno, ' ', apMaterno));
  END;
//

DELIMITER //
CREATE PROCEDURE modificaPersonal1(IN user      VARCHAR(60), IN idpersonal INT(11), IN nombres VARCHAR(40),
                                   IN appaterno VARCHAR(40), IN apmaterno VARCHAR(40),
                                   IN telefono  VARCHAR(15), IN spass VARCHAR(200), IN estatus INT(11))
  BEGIN
    SET @smail = (SELECT sEmail
                  FROM personal
                  WHERE nIdPersonal = idpersonal);

    UPDATE usuarios
    SET sPassword = md5(spass)
    WHERE sEmail = @smail;

    UPDATE personal
    SET sNombres = nombres, sApPaterno = appaterno, sApMaterno = apmaterno, sTelefono = telefono, bEstatus = estatus
    WHERE nIdPersonal = idpersonal;

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'UPDATE', current_date, 'usuarios', concat('Modificación de contraseña al usuario ', @smail));

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'UPDATE', current_date, 'personal',
            concat('Modificación de datos básicos del usuario con clave ', idpersonal));
  END;
//

DELIMITER //
CREATE PROCEDURE modificaPersonal2(IN user      VARCHAR(60), IN idpersonal INT(11), IN nombres VARCHAR(40),
                                   IN appaterno VARCHAR(40), IN apmaterno VARCHAR(40),
                                   IN telefono  VARCHAR(15), IN estatus INT(11))
  BEGIN
    UPDATE personal
    SET sNombres = nombres, sApPaterno = appaterno, sApMaterno = apmaterno, sTelefono = telefono, bEstatus = estatus
    WHERE nIdPersonal = idpersonal;

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'UPDATE', current_date, 'personal',
            concat('Modificación de datos básicos del usuario con clave ', idpersonal));
  END;
//

DELIMITER //
CREATE PROCEDURE modificarPersonalMedico1(IN user         VARCHAR(60), IN idpersonal INT(11), IN nombres VARCHAR(40),
                                          IN appaterno    VARCHAR(40), IN apmaterno VARCHAR(40),
                                          IN telefono     VARCHAR(15), IN spass VARCHAR(200), IN numced VARCHAR(20),
                                          IN numcedesp    VARCHAR(20), IN numtel1 VARCHAR(15),
                                          IN estatus INT(11))
  BEGIN
    SET @smail = (SELECT sEmail
                  FROM personal
                  WHERE nIdPersonal = idpersonal);

    UPDATE usuarios
    SET sPassword = md5(spass)
    WHERE sEmail = @smail;

    UPDATE personal
    SET sNombres = nombres, sApPaterno = appaterno, sApMaterno = apmaterno, sTelefono = telefono, bEstatus = estatus
    WHERE nIdPersonal = idpersonal;

    UPDATE medico
    SET sNumCedula  = numced, sNumCedEsp = numcedesp, sNumTelefono1 = numtel1, sNumTelefono2 = numtel1
    WHERE nIdPersonal = idpersonal;

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'UPDATE', current_date, 'usuarios', concat('Modificación de contraseña al usuario ', @smail));

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'UPDATE', current_date, 'personal',
            concat('Modificación de datos básicos del usuario con clave ', idpersonal));

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'UPDATE', current_date, 'medico', concat('Modificación de datos del médico con clave ', idpersonal));

  END;
//


DELIMITER //
CREATE PROCEDURE modificarPersonalMedico2(IN user      VARCHAR(60), IN idpersonal INT(11), IN nombres VARCHAR(40),
                                          IN appaterno VARCHAR(40), IN apmaterno VARCHAR(40),
                                          IN telefono  VARCHAR(15), IN numced VARCHAR(20), IN numcedesp VARCHAR(20),
                                          IN numtel1   VARCHAR(15), IN estatus INT(11))
  BEGIN

    UPDATE personal
    SET sNombres = nombres, sApPaterno = appaterno, sApMaterno = apmaterno, sTelefono = telefono, bEstatus = estatus
    WHERE nIdPersonal = idpersonal;

    UPDATE medico
    SET sNumCedula  = numced, sNumCedEsp = numcedesp, sNumTelefono1 = numtel1, sNumTelefono2 = numtel1
    WHERE nIdPersonal = idpersonal;

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'UPDATE', current_date, 'personal',
            concat('Modificación de datos básicos del usuario con clave ', idpersonal));

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'UPDATE', current_date, 'medico', concat('Modificación de datos del médico con clave ', idpersonal));

  END;
//


DELIMITER //
CREATE PROCEDURE buscaDatosPersona(IN idpersona INT(11))
  BEGIN
    SELECT
      personal.nIdPersonal,
      personal.sNombres,
      personal.sApPaterno,
      personal.sApMaterno,
      personal.sTelefono,
      personal.sSexo,
      personal.sCURP,
      personal.sEmail,
      personal.bEstatus,
      roles.sDescripcion,
      personal.sImagen,
      roles.nIdRol
    FROM personal
      LEFT OUTER JOIN usuarios
        ON usuarios.sEmail = personal.sEmail
      LEFT OUTER JOIN usuario_rol
        ON usuario_rol.sEmail = usuarios.sEmail
      LEFT OUTER JOIN roles
        ON roles.nIdRol = usuario_rol.nIdRol
    WHERE personal.nIdPersonal = idpersona;
  END;
//

DELIMITER //
CREATE PROCEDURE insertaUserRol(IN user VARCHAR(30), IN email VARCHAR(60), rol INT(11))
  BEGIN
    INSERT INTO usuario_rol (sEmail, nIdRol) VALUES (email, rol);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'usuario_rol', 'Inserción de un usuario y el rol que desempeña');
  END;
//


/*Fecha de creación 29 de agosto*/

DELIMITER //
CREATE PROCEDURE BuscaTodosPacientesExpediente()
  BEGIN
    SELECT
      e.nNumero,
      e.sCurpPaciente,
      p.sNombre,
      p.sApPaterno,
      p.sApMaterno,
      p.sSexo,
      p.dFecNacimiento,
      p.sTelefono,
      p.sDireccion,
      p.sCP,
      p.sEmail,
      p.sEstadoCivil,
      p.sRFC,
      p.sLocalidad,
      p.sMunicipio,
      p.sEstado,
      p.sMedico
    FROM expediente e, paciente p
    WHERE e.sCurpPaciente = p.SCurpPaciente;

  END;
//

/*Fecha de creación 30 de agosto Procedimientos Almacenados de Antecedentes de pacientes*/
/*Fecha de Modificacion 25/01/2017 agregados mas campos requeridos por ginecologia */
DELIMITER //
CREATE PROCEDURE insertarAntFam(IN user         VARCHAR(60), IN Expediente VARCHAR(20), IN Alcoholismo CHAR(2),
                                IN Alergias     CHAR(2), IN Asma CHAR(2), IN Cancer CHAR(2), IN Congenitos CHAR(2),
                                IN Convulsiones CHAR(2), IN Diabetes CHAR(2),
                                IN Hipertension CHAR(2), IN Drogas CHAR(2), IN Tabaquismo CHAR(2), IN Cardiopatias CHAR(2), IN TB CHAR(2), IN  Epilepsia CHAR(2), IN InsRenal CHAR(2))
  BEGIN
    INSERT INTO antecedentefam (nNumero, sAlcoholismo, sAlergias, sAsma, sCancer, sCongenitos, sConvulsiones, sDiabetes, sHipertension, sDrogadiccion, sTabaquismo,
                                sCardiopatias,sTuberculosis, sEpilepsia,sInsRenal)
    VALUES (Expediente, Alcoholismo, Alergias, Asma, Cancer, Congenitos, Convulsiones, Diabetes, Hipertension, Drogas,Tabaquismo,Cardiopatias,TB,Epilepsia, InsRenal);
    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'antecedentefam',
            CONCAT('se insertaron los antecedentes familiares del expediente ', Expediente));
  END;
//

DELIMITER //
CREATE PROCEDURE insertarAntPat(IN user VARCHAR(60), IN Expediente VARCHAR(20), IN Alergia VARCHAR(200),
                                IN Cardiopatia    VARCHAR(100), IN Transfusiones CHAR(2), IN Diabetes VARCHAR(50),
                                IN Cardiovascular CHAR(2), IN HTA CHAR(2),IN	Fracturas CHAR(2),	IN	Reumaticas CHAR(2),		IN	Rinitis CHAR(2),
                                IN	Asma CHAR(2),	IN	Convulsiones CHAR(2),	IN	Migrañas CHAR(2),
                                IN	Psiquiatricos CHAR(2),	IN	TB CHAR(2),	IN	EVC CHAR (2),
                                IN	Dermatosis CHAR(2),	IN	Audicion CHAR(2),	IN	Vision CHAR(2),
                                IN	EnfArt CHAR(2),	IN	Varices CHAR(2),	IN	Ulceras CHAR(2),
                                IN	Apendicits CHAR(2),	IN	Prostata CHAR(2),	IN	Urinarias CHAR(2),
                                IN	AcidoPep CHAR(2),	IN	SanDig CHAR(2),	IN	Hepatitis CHAR(2),
                                IN	Hernias CHAR(2),	IN	Colitis CHAR(2),	IN	Colecis CHAR(2),
                                IN	PatAnal CHAR(2),	IN	Internamientos CHAR(2),	IN	Cirujias CHAR(2),IN Obeso CHAR(2), IN Cancer VARCHAR(30))

   BEGIN
    INSERT INTO antepatologicos (nNumero, sAlergias, sCardiopatias, sTranfusiones, sDiabetico, sCardioVasculares, sHTA,sFracturas ,sReumaticas,sRinitis,  sAsma, Sconvulsiones,sMigrañas,sPsiquiatricos,
sTB, sEVC, sDermatosis, sAudicion, sVision, sEnfArt, sVarices, sUlceras, sApendicits, sProstata, sUrinarias, sAcidoPep, sSanDig, sHepatitis, sHernias, sColitis, sColecis,  sPatAnal, sInternamientos, sCirujias,Obesidad, Cancer)
    VALUES (Expediente, Alergia, Cardiopatia, Transfusiones, Diabetes, Cardiovascular, HTA, Fracturas,Reumaticas, Rinitis, Asma, Convulsiones,Migrañas, Psiquiatricos,TB,EVC,Dermatosis,Audicion,Vision,EnfArt,Varices,
      Ulceras,Apendicits,Prostata,Urinarias,AcidoPep,SanDig,Hepatitis,Hernias,Colitis,Colecis,PatAnal,Internamientos,Cirujias,Obeso,Cancer);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'antepatologicos',
            CONCAT('se insertaron los antecedentes patologicos del expediente ', Expediente));
  END;
//


DELIMITER //
CREATE PROCEDURE insertarAntNoPat(IN user        VARCHAR(60), IN Expediente VARCHAR(20), IN Religion VARCHAR(100),
                                  IN Tabaquismo  CHAR(2), IN Escolaridad VARCHAR(50), IN Ocupacion VARCHAR(100),
                                  IN Alcoholismo CHAR(2), IN Drogas CHAR(2), IN Agua CHAR(2), IN Electridad CHAR(2),
                                  IN Drenaje     CHAR(2), IN Wc CHAR(2), IN BCG CHAR(2), IN Polio CHAR(2),IN Penta CHAR(2), IN Influenza CHAR(2))
  BEGIN
    INSERT INTO antenopatologicos (nNumero, sReligion, bTabaquismo, sEscolaridad, sOcupacion, bAlcoholismo, sDrogas, bAguaPotable, bElectricidad, bDrenaje, bServSanit,  sBCG, sPolio, sPenta,sInfluenza )

    VALUES
      (Expediente, Religion, Tabaquismo, Escolaridad, Ocupacion, Alcoholismo, Drogas, Agua, Electridad, Drenaje, Wc, BCG, Polio,Penta,Influenza);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'antenopatologicos',
            CONCAT('se insertaron los antecedentes no patologicos del expediente ', Expediente));

  END;
//

DELIMITER //
CREATE PROCEDURE checkAccess(IN usuario VARCHAR(60), IN descripcionfuncion VARCHAR(150))
  BEGIN
    SELECT funcion.nClavefuncion
    FROM funcion
      LEFT OUTER JOIN funcion_rol
        ON funcion_rol.nClaveFuncion = funcion.nClaveFuncion
      LEFT OUTER JOIN roles
        ON roles.nIdRol = funcion_rol.nIdRol
      LEFT OUTER JOIN usuario_rol
        ON usuario_rol.nIdRol = roles.nIdrol
      LEFT OUTER JOIN usuarios
        ON usuario_rol.sEmail = usuarios.sEmail
    WHERE usuarios.sEmail = usuario AND funcion.sRutaPag = descripcionfuncion;
  END;
//

DELIMITER //
CREATE PROCEDURE consultarBitacora()
  BEGIN
    SELECT
      nClaveAccion,
      sEmail,
      dFechaAccion,
      sTabla,
      sDescripcionAccion
    FROM bitacora
    WHERE dFechaAccion >= date_sub(curdate(), INTERVAL 3 MONTH)
    ORDER BY dFechaAccion DESC;
  END;
//

/*6 de septiembre, procedimiento almacenado de aseguradora */

DELIMITER //
CREATE PROCEDURE insertarAseguradora(IN user      VARCHAR(60), IN Nombre VARCHAR(100), IN Telefono VARCHAR(13),
                                     IN Direccion VARCHAR(200))
  BEGIN
    INSERT INTO aseguradora (sNombre, sTelefono, sDireccion)

    VALUES (Nombre, Telefono, Direccion);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'Aseguradora', CONCAT('Se insertaron los datos de la aseguradora ', Nombre));

  END;
//

/*9 de septiembre, procedimiento almacenado seguro */

DELIMITER //
CREATE PROCEDURE buscarAseguradora()
  BEGIN
    SELECT
      nIdAseguradora,
      sNombre
    FROM aseguradora;
  END;
//

DELIMITER //
CREATE PROCEDURE insertarSeguro(IN user       VARCHAR(60), IN Poliza VARCHAR(20), IN Aseguradora INT(11),
                                IN Expediente VARCHAR(20), IN Vigencia DATE)
  BEGIN
    INSERT INTO seguro (nNumeroPoliza, nIdAseguradora, nNumero, dFechaVigencia)
    VALUES (Poliza, Aseguradora, Expediente, Vigencia);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'Seguro', CONCAT('Se registró el seguro del Expediente ', Expediente));

  END;
//


DELIMITER //
CREATE PROCEDURE buscarEstados()
  BEGIN
    SELECT
      CVE_ENT,
      NOM_ENT
    FROM estados;
  END;
//


DELIMITER //
CREATE PROCEDURE buscarMunicipios(IN estado INT)
  BEGIN
    SELECT
      CVE_MUN,
      NOM_MUN
    FROM Municipios
    WHERE CVE_ENT = estado;
  END;
//

DELIMITER //
CREATE PROCEDURE buscarTodosMetodosAntic()
  BEGIN
    SELECT
      nClaveAnticonceptivo,
      sDescripcion
    FROM metodoanticonceptivo;
  END;
//

DELIMITER //
CREATE PROCEDURE buscarMedicoEspecialidad()
  BEGIN
    SELECT
      p.nIdPersonal,
      p.sNombres,
      p.sApPaterno,
      p.sApMaterno,
      e.sDescripcion
    FROM personal p
      JOIN medico m
        ON m.nIdPersonal = p.nIdPersonal
      JOIN especialidad e
        ON e.nIdEspecialidad = m.nIdEspecialidad;
  END;
//

DELIMITER //
CREATE PROCEDURE insertarAntGin(IN user           VARCHAR(60), IN Expediente VARCHAR(20), IN Gestaciones INT(11),
                                IN Partos         INT(11), IN Abortos INT(11), IN Ivsa INT(11), IN Parejas INT(11),
                                IN ETS            VARCHAR(200), IN Cesareas INT(11), IN Papanicolau DATE,IN Anticonceptivo INT(11),IN FUP DATE, IN FUM DATE,IN Menarca INT(2), IN Observaciones TEXT)
  BEGIN
    INSERT INTO anteginecoobstetricos (nNumero, nGestaciones, nPartos, nAbortos, sIVSA, nParejasSexuales, sETS, nCesareas, dUltPapanicolau, nClaveAnticonceptivo, dFUP, dFUM, sMenarca, vObservaciones)
    VALUES (Expediente, Gestaciones, Partos, Abortos, Ivsa, Parejas, ETS, Cesareas, Papanicolau, Anticonceptivo,FUP,FUM,Menarca, Observaciones);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'anteginecoobstetricos',
            CONCAT('se insertaron los antecedentes gineco-obstetricos del expediente ', Expediente));

  END;
//

DELIMITER //
CREATE PROCEDURE insertarEstudios(IN user varchar(60), IN descripcion varchar(100), IN iva decimal(10,2),
                                  IN costonormal decimal(10,2), IN costoaseg decimal(10,2), IN espe int(11))
  BEGIN
    INSERT INTO estudios(sDescripcion, nIVA, nCostoNormal, nCostoAseg, nIdEspecialidad)
    VALUES(descripcion, iva, costonormal, costoaseg, espe);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'ESTUDIOS', CONCAT('Registro de nuevo estudio por el usuario', user));
  END
//

DELIMITER //
CREATE PROCEDURE buscarTodosEspecialidad()
  BEGIN
    SELECT
      especialidad.nIdEspecialidad,
      especialidad.sDescripcion
    FROM especialidad;
  END
  //

DELIMITER //
CREATE PROCEDURE eliminaEstudio(IN user varchar(60), IN clave int(11))
  BEGIN
    DELETE FROM estudios WHERE nClaveInterna = clave;

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'DELETE', current_date, 'estudios',
            CONCAT('Se eliminó el estudio ', clave, ' por el usuario ', user));

  END
//

DELIMITER //
CREATE PROCEDURE buscarDatosEstudio(IN clave int(11))
  BEGIN
    SELECT estudios.nClaveInterna, estudios.sDescripcion as DescEst, estudios.nIVA, estudios.nCostoNormal, estudios.nCostoAseg, especialidad.sDescripcion as DescEspe
    FROM estudios
      JOIN especialidad
        ON especialidad.nIdEspecialidad = estudios.nIdEspecialidad
    WHERE nClaveInterna = clave;
  END
//

DELIMITER //
CREATE PROCEDURE buscarEstudiosPorEspecialidad(IN user varchar(60))
  BEGIN
    SELECT estudios.nClaveInterna, estudios.sDescripcion
    FROM estudios
      JOIN especialidad
        ON especialidad.nIdEspecialidad = estudios.nIdEspecialidad
      JOIN medico
        ON medico.nIdEspecialidad = especialidad.nIdEspecialidad
      JOIN personal
        ON personal.nIdPersonal = medico.nIdPersonal
      JOIN usuarios
        ON usuarios.sEmail = personal.sEmail
    WHERE usuarios.sEmail = user;
  END
//

DELIMITER //
CREATE PROCEDURE buscarEstudios()
  BEGIN
    SELECT estudios.nClaveInterna, estudios.sDescripcion, estudios.nIVA, estudios.nCostoNormal, estudios.nCostoAseg
    FROM estudios;
  END;
//

DELIMITER //
CREATE PROCEDURE insertarCita(IN user varchar(60), IN Consultorio INT(6), IN Horario INT(6),IN Paciente VARCHAR(20), IN FechaCita DATE)
  BEGIN
    INSERT INTO cita (nIdConsultorio, nClaveHorario, nNumero, dFecRegistro, dFechaCita,nIdEstatus)
    VALUES(Consultorio,Horario,Paciente,current_date,FechaCita,1);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'CITAS', CONCAT('Registro de  nueva cita por el usuario ', user));
  END
    //


DELIMITER //
CREATE PROCEDURE ExisteAntFam (IN Expediente VARCHAR(20))
  BEGIN
    SELECT nNumero from antecedentefam where nNumero=Expediente;
  END //


DELIMITER //
CREATE PROCEDURE ExisteAntPat (IN Expediente VARCHAR(20))
  BEGIN
    SELECT nNumero from antepatologicos where nNumero=Expediente;
  END //

DELIMITER //
CREATE PROCEDURE ExisteAntNoPat (IN Expediente VARCHAR(20))
  BEGIN
    SELECT nNumero from antenopatologicos where nNumero=Expediente;
  END //

DELIMITER //
CREATE PROCEDURE ExisteAntGin (IN Expediente VARCHAR(20))
  BEGIN
    SELECT nNumero from anteginecoobstetricos where nNumero=Expediente;
  END //

DELIMITER //
CREATE PROCEDURE insertarConsultorio(IN user VARCHAR(60),IN Medico INT(11), IN Descripcion VARCHAR(100))
  BEGIN
    INSERT into consultorio(nIdPersonal, sDescripcion)
      VALUES (Medico,Descripcion);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'CONSULTORIO', CONCAT('Registro de  nuevo consultorio por el usuario ', user));


  END //


DELIMITER //
CREATE PROCEDURE BuscarTodosConsultorios()
  BEGIN
    select c.nIdConsultorio, c.sDescripcion, p.SNombres,p.sApPaterno, p.SApMaterno
    from consultorio c , personal p
    where c.nIdPersonal=p.nIdPersonal;
  END //


DELIMITER //
CREATE PROCEDURE modificaEstudio(IN user varchar(60), IN clave int(11), IN descrip varchar(100), IN iva decimal(10,2), IN costonormal decimal(10,2), IN costoaseg decimal(10,2))
  BEGIN
    UPDATE estudios
    SET sDescripcion = descrip, nIVA = iva, nCostoNormal = costonormal, nCostoAseg = costoaseg
    WHERE nClaveInterna = clave;

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'UPDATE', current_date, 'estudios',
            CONCAT('Se actualizó el estudio ', clave));
  END
//
DELIMITER //
CREATE  PROCEDURE buscarHorariosDisponibles(IN consultorio int(6),IN FECHA DATE, IN DiaSemana VARCHAR(20))
  BEGIN
    select h.nClaveHorario, h.sHoraInicio, h.sHoraFin
    from horarios h
      join asignaconsultorio a
        on h.nClaveHorario=a.nClaveHorario
    where not exists
    (select c.nClaveHorario from cita c where c.nClaveHorario=h.nClaveHorario and c.dFechaCita=FECHA  and c.nIdConsultorio=consultorio)
          and a.nIdConsultorio=consultorio
          and h.sDia=DiaSemana;
  END;
//

DELIMITER  //
CREATE  PROCEDURE buscarPacientesConsultorio (IN consultorio INT)
  BEGIN
    select  e.nNumero, p.sNombre, p.sApPaterno, p.sApMaterno
    from paciente p
      join expediente e on e.sCurpPaciente=p.sCurpPaciente
      join medico m on m.nIdPersonal=p.sMedico
      join consultorio c on c.nIdConsultorio=p.sConsultorio
    where c.nIdConsultorio=consultorio;

  END //


DELIMITER //
CREATE PROCEDURE buscarPacientesPorMedico(IN user varchar(60))
  BEGIN
    SELECT paciente.sNombre, paciente.sApPaterno, paciente.sApMaterno, expediente.nnumero, notaintervencion.bEstadoProce,paciente.sMedico
    FROM paciente
      JOIN expediente
        ON expediente.sCurpPaciente = paciente.sCurpPaciente
      JOIN medico
        ON medico.nIdPersonal = paciente.sMedico
      JOIN personal
        ON personal.nIdPersonal = medico.nIdPersonal
      LEFT OUTER JOIN notaintervencion
        ON notaintervencion.nNumero = expediente.nNumero
    WHERE personal.sEmail = user;
  END
//


DELIMITER //
CREATE PROCEDURE buscarDatosPaciente(IN expediente varchar(20))
  BEGIN
    SELECT paciente.sNombre, paciente.sApPaterno, paciente.sApMaterno, paciente.sSexo, YEAR(CURDATE())-YEAR(paciente.dFecNacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(paciente.dFecNacimiento,'%m-%d'), 0, -1) as edad,
      notaintervencion.bEstadoProce
    FROM paciente
      JOIN expediente
        ON expediente.sCurpPaciente = paciente.sCurpPaciente
      LEFT OUTER JOIN notaintervencion
        ON notaintervencion.nNumero = expediente.nNumero
    WHERE expediente.nNumero = expediente;
  END
//

DELIMITER //
CREATE PROCEDURE buscarTodosAnestesia()
  BEGIN
    SELECT anestesia.nIdAnestesia, anestesia.sDescripcion FROM anestesia;
  END
//

DELIMITER //
CREATE PROCEDURE insertaNotaIntervencion(IN user varchar(60), IN fechasolicitada date, IN expediente varchar(20), IN prioridad char(1), IN diagnosticopreope text,
                                         IN operacionplaneada text, IN tipoopera varchar(20), IN gruposan char(2), IN rh char(1), IN anestesia int(11), IN tiempoestimado varchar(200),
                                         IN riesgos text, IN beneficios text)
  BEGIN
    SET @IdPersonal = (select personal.nIdPersonal from personal join medico on medico.nIdPersonal = personal.nIdPersonal where personal.sEmail = user);


    INSERT INTO notaintervencion(nNumero, dFechaSolicitud, dFechaSolicitada, sPrioridad, nIdPersonal, sDiagnositicoPreope, sOperacionPlaneada, sTipoOperacion, sGrupoSanguineo, sRH, nIdAnestesia, sTiempoEstimado, sRiesgos, sBeneficios, bEstadoProce)
    VALUES (expediente, current_date(), fechasolicitada, prioridad, @idPersonal, diagnosticopreope, operacionplaneada, tipoopera, gruposan, rh, anestesia, tiempoestimado, riesgos, beneficios, 1);

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'NOTA INTERVENCION', CONCAT('Registro de solicitud de intervención al paciente', expediente, 'por ', user));

  END
//

DELIMITER //
CREATE PROCEDURE buscarDatosProcedimiento(IN expediente varchar(20))
  BEGIN
    SELECT notaintervencion.sTipoOperacion, notaintervencion.sDiagnositicoPreope, notaintervencion.sOperacionPlaneada, notaintervencion.sRiesgos,
      notaintervencion.sBeneficios, personal.sNombres, personal.sApPaterno, personal.sApMaterno, medico.sNumCedula
    FROM notaintervencion
      LEFT OUTER JOIN personal
        ON personal.nIdPersonal = notaintervencion.nIdPersonal
      LEFT OUTER JOIN expediente
        ON expediente.nNumero = notaintervencion.nNumero
      LEFT OUTER JOIN medico
        ON medico.nIdPersonal = personal.nIdPersonal
    WHERE expediente.nNumero = expediente AND notaintervencion.bEstadoProce = 1;
  END
//

/* Se agrega un alias a la columna co.sDescripcion as Consultorio ya que los dos atributos de descripcion causan conflicto */
DELIMITER //
CREATE  PROCEDURE BuscarTodasCitas ()
  BEGIN
    select c.nFolioCita,p.sNombre, p.sApPaterno, p.sApMaterno, co.sDescripcion, h.sHoraInicio, c.dFechaCita,  s.sNombre as estatus
    from cita c
      join consultorio co
        on c.nIdConsultorio=co.nIdConsultorio
      join horarios h
        on c.nClaveHorario=h.nClaveHorario
      join estatus s
        on c.nIdEstatus=s.nIdEstatus
      join expediente ex
        on ex.nNumero=c.nNumero
      join paciente p
        on p.sCurpPaciente=ex.sCurpPaciente
    where c.nIdEstatus=1
    order by c.dFechaCita;
  END //

DELIMITER //
CREATE  PROCEDURE BuscaEstatus()
  BEGIN
    select nIdEstatus, sNombre from estatus
    where nIdEstatus != 1;
  END //


DELIMITER //
CREATE  PROCEDURE ModificaEstatus(IN user VARCHAR(60),IN ID INT, IN estatus INT)
  BEGIN
    UPDATE cita SET nIdEstatus =estatus WHERE nFolioCita = ID;

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'Cita', CONCAT('Actualizacion de estado a la cita ', ID, 'por  ', user));

  END //



DELIMITER //
CREATE PROCEDURE CancelarCita(IN user VARCHAR(60), IN Folio INT)
  BEGIN
    DELETE  FROM cita WHERE nFolioCita=Folio;

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'CITA', CONCAT(' Cita con folio  ', Folio, ' cancelada por  el usuario ', user));
  END //

DELIMITER //
CREATE PROCEDURE buscarPacientesPorMedico2(IN user varchar(60))
  BEGIN
    SELECT distinct paciente.sNombre, paciente.sApPaterno, paciente.sApMaterno, expediente.nnumero, notaintervencion.bEstadoProce
    FROM paciente
      JOIN expediente
        ON expediente.sCurpPaciente = paciente.sCurpPaciente
      JOIN medico
        ON medico.nIdPersonal = paciente.sMedico
      JOIN personal
        ON personal.nIdPersonal = medico.nIdPersonal
      LEFT OUTER JOIN notaintervencion
        ON notaintervencion.nNumero = expediente.nNumero
    WHERE personal.sEmail = user;
  END
//


DELIMITER //
CREATE PROCEDURE buscarTodosHeridas()
  BEGIN
    SELECT clasificacionheridas.nIdClasificacion, clasificacionheridas.sDescripcion FROM clasificacionheridas;
  END
//

DELIMITER //
CREATE PROCEDURE buscarTodosManejo()
  BEGIN
    SELECT manejoheridas.nIdManejo, manejoheridas.sDescripcion FROM manejoheridas;
  END
//

DELIMITER //
CREATE PROCEDURE buscarTodosAntibioticos()
  BEGIN
    SELECT antibiotico.nIdAntibiotico, antibiotico.sDescripcion FROM antibiotico;
  END
//

DELIMITER //
CREATE PROCEDURE buscarPacientesPorMedico3(IN user varchar(60))
  BEGIN
    SELECT distinct paciente.sNombre, paciente.sApPaterno, paciente.sApMaterno, expediente.nnumero, notaintervencion.bEstadoProce
    FROM paciente
      JOIN expediente
        ON expediente.sCurpPaciente = paciente.sCurpPaciente
      JOIN medico
        ON medico.nIdPersonal = paciente.sMedico
      JOIN personal
        ON personal.nIdPersonal = medico.nIdPersonal
      LEFT OUTER JOIN notaintervencion
        ON notaintervencion.nNumero = expediente.nNumero
    WHERE personal.sEmail = user and notaintervencion.bEstadoProce = 1 and notaintervencion.dFechaSolicitud > current_date();
  END
//

DELIMITER //
CREATE PROCEDURE insertarResultadosIntervencion(IN user varchar(60), IN expediente varchar(20), IN dxposope text, IN opereal text, IN anestesiaapli int(11),
                                                IN examenhistopato text, IN otrosestudiosol text, IN fechaproce date, IN horaproce varchar(30), IN descriptecnica text,
                                                IN hallazgos text, IN incidentes text, IN accidentes text, IN complicaciones text, IN observaciones text, IN estadoposope text,
                                                IN planmanejoposope text, IN pronostico text, IN clasificacionherida int(11), IN implante char(2), IN tipoimplante text,
                                                IN manejoherida int(11), IN osteomia char(2), IN tipoosteomia text, IN localosteomia text, IN drenaje char(2), IN tipodrenaje char(1),
                                                IN antibiotico char(2), IN claveanti int(11), IN cirujano varchar(200), IN cedulacir varchar(50), IN anestesiologo varchar(200), IN cedanest varchar(50),
                                                IN fechaaplica date, IN horainicio varchar(30))
  BEGIN
    UPDATE notaintervencion
    SET sDxPosoperatorio = dxposope, sOperacionRealizada = opereal, nAnestesiaAplicada = anestesiaapli, sExaHistoTransSol = examenhistopato,
      sOtrosEstTras = otrosestudiosol, dFechaProcedimiento = fechaproce, sHoraProce = horaproce, sDescripcionTecnica = descriptecnica,
      sHallazgos = hallazgos, sIncidentes = incidentes, sAccidentes = accidentes, sComplicaciones = complicaciones, sObservaciones = observaciones,
      sEstadoPosope = estadoposope, sPlanManejoPosope = planmanejoposope, sPronostico = pronostico, nIdClasificacion = clasificacionherida,
      sImplante = implante, sTipoImplante = tipoimplante, nIdManejo = manejoherida, sOsteomias = osteomia, sTipoOsteomias = tipoosteomia,
      sLocalizacionOsteomias = localosteomia, sDrenaje = drenaje, sTipoDrenaje = tipodrenaje, sAntibiotico = antibiotico, nIdAntibiotico = claveanti,
      sCirujano = cirujano, sCedulaCir = cedulacir, sAnestesiologo = anestesiologo, sCedulaAnest = cedanest, dFechaInicio = fechaaplica, sHoraInicio = horainicio,
      bEstadoProce = 0
    WHERE nNumero = expediente AND bEstadoProce = 1;

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'NOTA INTERVENCION', CONCAT('Registro de resultados de un procedimiento', expediente, 'por ', user));

  END
//

/*Procedimiento para recetas*************************************************************************************************/
DELIMITER //
CREATE PROCEDURE insertarReceta(IN user VARCHAR(60),IN Paciente VARCHAR(20),IN Descripcion TEXT,IN Medico INT)
  BEGIN
    INSERT INTO receta(fecha_expedicion,Paciente,descripcion,medico)
      VALUES (CURRENT_DATE,Paciente,Descripcion,Medico);
    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'RECETA', CONCAT('Creacion de receta para el paciente ', Paciente, 'por ', user));

  END //

/******************************************************************************************************************************/

DELIMITER //
CREATE PROCEDURE PacientesDoctor(IN user varchar(60))
  BEGIN
    SELECT paciente.sNombre, paciente.sApPaterno, paciente.sApMaterno, expediente.nnumero,paciente.sMedico,paciente.sSexo, consultorio.sDescripcion
    FROM paciente
      JOIN expediente
        ON expediente.sCurpPaciente = paciente.sCurpPaciente
      JOIN medico
        ON medico.nIdPersonal = paciente.sMedico
      JOIN personal
        ON personal.nIdPersonal = medico.nIdPersonal
      JOIN consultorio
        ON consultorio.nIdConsultorio=paciente.sConsultorio
    WHERE personal.sEmail = user;
  END
//



/*Buscar  todos los procedimientos cerrados de un paciente */

DELIMITER //
CREATE PROCEDURE buscarTodosProcePacientes(IN expediente varchar(20))
  BEGIN
    SELECT paciente.sNombre, paciente.sApPaterno, paciente.sApMaterno, expediente.nNumero, notaintervencion.nIdNota, notaintervencion.dFechaProcedimiento,
      notaintervencion.sDiagnositicoPreope, notaintervencion.sOperacionPlaneada, notaintervencion.sOperacionRealizada
    FROM paciente
      JOIN expediente
        ON paciente.sCurpPaciente = expediente.sCurpPaciente
      JOIN notaintervencion
        ON notaintervencion.nNumero = expediente.nNumero
    WHERE expediente.nNumero = expediente AND notaintervencion.bEstadoProce = 0;
  END
//

DELIMITER //
CREATE PROCEDURE buscarReporteIntervencion(IN idNota int(11))
  BEGIN
    SELECT notaintervencion.sDiagnositicoPreope, notaintervencion.sDxPosoperatorio, notaintervencion.sOperacionRealizada,
      notaintervencion.sCirujano, notaintervencion.sCedulaCir, notaintervencion.sAnestesiologo, notaintervencion.sCedulaAnest,
      notaintervencion.sExaHistoTransSol, notaintervencion.sOtrosEstTras, anestesia.sDescripcion as anestesiaaplicada, notaintervencion.dFechaProcedimiento,
      notaintervencion.sHoraProce, notaintervencion.sDescripcionTecnica, notaintervencion.sHallazgos, notaintervencion.sIncidentes,
      notaintervencion.sAccidentes, notaintervencion.sComplicaciones, notaintervencion.sObservaciones, notaintervencion.sEstadoPosope,
      notaintervencion.sPlanManejoPosope, notaintervencion.sPronostico, clasificacionheridas.sDescripcion as clasificacion, notaintervencion.sImplante,
      notaintervencion.sTipoImplante, manejoheridas.sDescripcion as heridas, notaintervencion.sOsteomias, notaintervencion.sTipoOsteomias,
      notaintervencion.sLocalizacionOsteomias, notaintervencion.sDrenaje, notaintervencion.sTipoDrenaje, notaintervencion.sAntibiotico,
                                                                          antibiotico.sDescripcion as antibioticorecetado,  notaintervencion.dFechaInicio, notaintervencion.sHoraInicio, paciente.sNombre, paciente.sApPaterno,
      paciente.sApMaterno, expediente.nNumero, personal.sNombres as nommed, personal.sApPaterno as appatmed, personal.sApMaterno as apmatmed
    FROM notaintervencion
      LEFT JOIN expediente
        ON expediente.nnumero = notaintervencion.nnumero
      LEFT JOIN paciente
        ON paciente.sCurpPaciente = expediente.sCurpPaciente
      LEFT OUTER JOIN anestesia
        ON anestesia.nIdAnestesia = notaintervencion.nAnestesiaAplicada
      LEFT OUTER JOIN clasificacionheridas
        ON clasificacionheridas.nIdClasificacion = notaintervencion.nIdClasificacion
      LEFT OUTER JOIN manejoheridas
        ON manejoheridas.nIdManejo = notaintervencion.nIdManejo
      LEFT OUTER JOIN antibiotico
        ON antibiotico.nIdAntibiotico = notaintervencion.nIdAntibiotico
      LEFT JOIN personal
        ON personal.nIdPersonal = paciente.sMedico
    WHERE notaintervencion.nIdNota = idNota;
  END
//

delimiter //
CREATE PROCEDURE updateStatusAccess(IN user varchar(100))
  BEGIN
    UPDATE accesos
    SET bEstado = 0
    WHERE sEmail = user;

    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'UPDATE', current_date, 'ACCESOS', CONCAT('Actualización del acceso para el usuario' | user));

  END
//

delimiter //
CREATE PROCEDURE consultarHistorialClinicoGin (IN paciente VARCHAR(20))
  BEGIN
    select p.sApPaterno, p.sApMaterno, p.sNombre, e.nNumero, p.sDireccion, m.NOM_MUN, edo.NOM_ENT, p.sTelefono,
      af.sDiabetes, af.sHipertension, af.sCardiopatias, af.sTuberculosis, af.sCancer, af.sEpilepsia, af.sInsRenal,
      an.bTabaquismo, an.bAlcoholismo, an.sDrogas,an.sBCG, an.sPolio, an.sPenta, an.sInfluenza,
      ap.sAlergias, ap.sCardiopatias as CP2, ap.sTranfusiones, ap.sDiabetico, ap.sCardioVasculares, ap.sHTA, ap.sFracturas,ap.sReumaticas,ap.sRinitis, ap.sAsma,ap.sConvulsiones, ap.sMigrañas,
      ap.sPsiquiatricos, ap.sTB, ap.sEVC, ap.sDermatosis, ap.sAudicion,ap.sVision, ap.sEnfArt, ap.sVarices, ap.sUlceras,ap.sApendicits, ap.sProstata,ap.sUrinarias, ap.sAcidoPep, ap.sSanDig,
      ap.sHepatitis, ap.sHernias, ap.sColitis, ap.sColecis, ap.sPatAnal, ap.sInternamientos, ap.sCirujias,
      ag.sMenarca, ag.sIVSA, ag.dFUM, ag.dFUP, ag.nGestaciones, ag.nPartos, ag.nCesareas,ag.nAbortos, ag.vObservaciones,ap.Obesidad,ap.Cancer
    from paciente p
      JOIN expediente e
        on e.sCurpPaciente=p.sCurpPaciente
      JOIN municipios m
        on m.CVE_MUN=p.sMunicipio
      JOIN estados edo
        on edo.CVE_ENT=p.sEstado
      JOIN antecedentefam af
        on af.nNumero=e.nNumero
      JOIN antenopatologicos an
        on an.nNumero=e.nNumero
      JOIN antepatologicos ap
        on ap.nNumero=e.nNumero
      JOIN anteginecoobstetricos ag
        on ag.nNumero=e.nNumero
    where e.nNumero=paciente;
  END //

delimiter //
CREATE PROCEDURE consultarHistorialClinicoUro (IN paciente VARCHAR(20))
  BEGIN
    select p.sApPaterno, p.sApMaterno, p.sNombre, e.nNumero, p.sDireccion, m.NOM_MUN, edo.NOM_ENT, p.sTelefono,
      af.sDiabetes, af.sHipertension, af.sCardiopatias, af.sTuberculosis, af.sCancer, af.sEpilepsia, af.sInsRenal,
      an.bTabaquismo, an.bAlcoholismo, an.sDrogas,an.sBCG, an.sPolio, an.sPenta, an.sInfluenza,
      ap.sAlergias, ap.sCardiopatias as CP2, ap.sTranfusiones, ap.sDiabetico, ap.sCardioVasculares, ap.sHTA, ap.sFracturas,ap.sReumaticas,ap.sRinitis, ap.sAsma,ap.sConvulsiones, ap.sMigrañas,
      ap.sPsiquiatricos, ap.sTB, ap.sEVC, ap.sDermatosis, ap.sAudicion,ap.sVision, ap.sEnfArt, ap.sVarices, ap.sUlceras,ap.sApendicits, ap.sProstata,ap.sUrinarias, ap.sAcidoPep, ap.sSanDig,
      ap.sHepatitis, ap.sHernias, ap.sColitis, ap.sColecis, ap.sPatAnal, ap.sInternamientos, ap.sCirujias,ap.Obesidad,ap.Cancer
    from paciente p
      JOIN expediente e
        on e.sCurpPaciente=p.sCurpPaciente
      JOIN municipios m
        on m.CVE_MUN=p.sMunicipio
      JOIN estados edo
        on edo.CVE_ENT=p.sEstado
      JOIN antecedentefam af
        on af.nNumero=e.nNumero
      JOIN antenopatologicos an
        on an.nNumero=e.nNumero
      JOIN antepatologicos ap
        on ap.nNumero=e.nNumero
      where e.nNumero=paciente;
  END //

delimiter //
CREATE PROCEDURE  buscarConsultoriosMedico(IN medico INT)
  BEGIN
    select nIdConsultorio, sDescripcion from consultorio WHERE nIdPersonal=medico;
  END //

delimiter //
CREATE PROCEDURE insertarHojaGin (IN user VARCHAR(60),IN Expediente VARCHAR(20), IN Medico INT, IN Padecimiento VARCHAR(200),
  IN TA VARCHAR(30), IN FC VARCHAR(30), IN FR VARCHAR(30), IN Temp FLOAT, IN  Talla FLOAT, IN Peso FLOAT, IN IMC FLOAT, IN Exploracion VARCHAR(500),
  IN  Laboratoriales VARCHAR(500), IN Terapeutica VARCHAR(500), IN  Diagnosticos VARCHAR(500))
  BEGIN
    INSERT INTO HojaGin(Paciente, Medico, Padecimiento, TA, FC, FR, Temp, Talla, Peso, IMC, Exploracion, Laboratoriales, Terapeutica, Diagnosticos, Fecha)VALUES
      (Expediente,Medico,Padecimiento,TA,FC,FR,Temp,Talla,Peso, IMC,Exploracion,Laboratoriales,Terapeutica,Diagnosticos,CURRENT_DATE);
    INSERT INTO bitacora(sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES(user, 'INSERT', current_date, 'Hoja_Ginecologia', CONCAT('Captura de diagnotico para el paciente ', Expediente, 'por ', user));
  END //

delimiter //
CREATE PROCEDURE medicoCedula (IN medico INT)
  BEGIN
    select per.sNombres, per.sApPaterno, per.sApMaterno, med.sNumCedula
    FROM personal per
      JOIN medico med
        on per.nIdPersonal=med.nIdPersonal
    where med.nIdPersonal=medico;
  END //

delimiter //
CREATE PROCEDURE Especialidad (IN medico VARCHAR(60))
  BEGIN
    select nIdEspecialidad from medico m
      join  personal p
        on p.nIdPersonal=m.nIdPersonal
    where p.sEmail=medico;
  END //


DELIMITER //
CREATE PROCEDURE BuscarCitasMedico(IN Medico VARCHAR(60))
  BEGIN
    select c.nFolioCita,p.sNombre, p.sApPaterno, p.sApMaterno, co.sDescripcion, h.sHoraInicio, c.dFechaCita, s.sNombre as estatus
    from cita c
      join consultorio co
        on c.nIdConsultorio=co.nIdConsultorio
      join horarios h
        on c.nClaveHorario=h.nClaveHorario
      join estatus s
        on c.nIdEstatus=s.nIdEstatus
      join expediente ex
        on ex.nNumero=c.nNumero
      join paciente p
        on p.sCurpPaciente=ex.sCurpPaciente
      JOIN medico med
        on med.nIdPersonal=co.nIdPersonal
      join personal per
        on per.nIdPersonal=med.nIdPersonal
    where c.nIdEstatus=1 and
          per.sEmail=Medico
    order by c.dFechaCita;
  END//

DELIMITER //
CREATE PROCEDURE BuscarRol(IN usuario VARCHAR(60))
  BEGIN
    select nIdRol from usuario_rol
    where sEmail=usuario;
  END;


DELIMITER //
CREATE PROCEDURE CitasDiarias( IN Hoy DATE)
  BEGIN
    select c.nFolioCita,p.sNombre, p.sApPaterno, p.sApMaterno, co.sDescripcion, h.sHoraInicio, s.sNombre as estatus
    from cita c
      join consultorio co
        on c.nIdConsultorio=co.nIdConsultorio
      join horarios h
        on c.nClaveHorario=h.nClaveHorario
      join estatus s
        on c.nIdEstatus=s.nIdEstatus
      join expediente ex
        on ex.nNumero=c.nNumero
      join paciente p
        on p.sCurpPaciente=ex.sCurpPaciente
    where c.nIdEstatus=1
          and c.dFechaCita=Hoy
    order by h.sHoraInicio Desc;
  END //


DELIMITER //
CREATE PROCEDURE CitasDiariasMedico(IN Hoy DATE, IN Medico VARCHAR(60))
  BEGIN
    select c.nFolioCita,p.sNombre, p.sApPaterno, p.sApMaterno, co.sDescripcion, h.sHoraInicio,s.sNombre as estatus
    from cita c
      join consultorio co
        on c.nIdConsultorio=co.nIdConsultorio
      join horarios h
        on c.nClaveHorario=h.nClaveHorario
      join estatus s
        on c.nIdEstatus=s.nIdEstatus
      join expediente ex
        on ex.nNumero=c.nNumero
      join paciente p
        on p.sCurpPaciente=ex.sCurpPaciente
      JOIN medico med
        on med.nIdPersonal=co.nIdPersonal
      join personal per
        on per.nIdPersonal=med.nIdPersonal
    where c.nIdEstatus=1
          and per.sEmail=Medico
          and c.dFechaCita=Hoy
    order by h.sHoraInicio Desc;
  END //

DELIMITER //
CREATE PROCEDURE buscarIdMedico(IN user varchar(100))
  BEGIN
    SELECT nIdPersonal FROM personal
    WHERE sEmail = user;
  END
//

DELIMITER //
CREATE PROCEDURE insertarEstudioLab(IN user varchar(100), IN nClaveEstudio int(10), IN nClaveEstReal int(10), IN sEstudiosSol text)
  BEGIN
    INSERT INTO estlaboratorio(nIdEstudioReal, nClaveInterna, sEstudiosSolicitados)
    VALUES(nClaveEstReal, nClaveEstudio, sEstudiosSol);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'ESTLABORATORIO', 'Se insertó una solicitud de estudio de Laboratorio ');
  END
//


DELIMITER //
CREATE PROCEDURE insertarEstudioImagen(IN user varchar(100), IN nClaveEstudio int(10), IN nClaveEstReal int(10), IN sNivelUrgencia text,
                                       IN dFecSol date, IN sEstudiosSol text, IN sOtrosEst text, IN sRegionSol text)
  BEGIN
    INSERT INTO estimagen(nIdEstudioReal, nClaveInterna, sNivelUrgencia, dFechaSolicitud, sEstudioSolicitado, sOtrosEstudios, sRegionSolicitada)
    VALUES(nClaveEstReal, nClaveEstudio, sNivelUrgencia,dFecSol, sEstudiosSol, sOtrosEst, sRegionSol);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'ESTIMAGEN', 'Se insertó una solicitud de estudio de Imagenología ');
  END
//

DELIMITER //
CREATE PROCEDURE insertarNotaMedica (IN user varchar(100), IN nIdEstudio int(11), IN nClaveInterna int(11), IN sResumen text, IN sPresionArt varchar(200),
                                     IN sSignosVitales varchar(200), IN sTemperatura varchar(200))
  BEGIN
    INSERT INTO notamedica (nIdEstudioReal, nClaveInterna, sNumCama, sResumen, sPresionArterial, sSignosVitales, sTemperatura)
    VALUES(nIdEstudio, nClaveInterna, 'S/Cama', sResumen, sPresionArt, sSignosVitales, sTemperatura);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'NOTAMEDICA', 'Se insertó una nota médica');
  END
//

DELIMITER //
CREATE PROCEDURE insertarEstReal(IN user varchar(100), IN nClaveInterna int(11), IN nNumero varchar(20), IN nIdPersonal int(11), IN sDiagnostico text,
                                 IN dFechaRealizado date, IN sRutaArchivo text)
  BEGIN
    INSERT INTO estudiorealizado(nClaveInterna, nNumero, nIdPersonal, sDiagnostico, dFechaRealizado, sRutaArchivo)
    VALUES(nClaveInterna, nNumero, nIdPersonal, sDiagnostico, dFechaRealizado, sRutaArchivo);

    INSERT INTO bitacora (sEmail, sAccion, dFechaAccion, sTabla, sDescripcionAccion)
    VALUES (user, 'INSERT', current_date, 'ESTUDIOREALIZADO', 'Se insertó un registro de estudio realizado ');
  END
//


DELIMITER //
CREATE PROCEDURE insertarEstAtendido(IN user varchar(100), IN nClaveInterna int(11), IN nNumero varchar(20), IN nIdPersonal int(11), IN sDiagnostico text,
                                     IN dFechaRealizado date, IN sRutaArchivo text, IN sNivelUrgencia varchar(15), IN dFechaSolicitud date,
                                     IN sEstudiosSol text, IN sOtrosEst text, IN sRegionSol text, IN sEstSol text, IN sResumen text,
                                     IN sPresionArterial varchar(200), IN sSignosVitales varchar(200), IN sTemperatura varchar(20))
  BEGIN
    CALL  insertarEstReal(user,nClaveInterna, nNumero, nIdPersonal, sDiagnostico, dFechaRealizado, sRutaArchivo);

    SET @nEstReal = (SELECT max(nIdEstudioReal) FROM estudiorealizado);

    CALL insertarEstudioLab(user, nClaveInterna, @nEstReal, sEstSol);

    CALL insertarEstudioImagen(user, nClaveInterna, @nEstReal, sNivelUrgencia, dFechaSolicitud, sEstudiosSol, sOtrosEst, sRegionSol);

    CALL insertarNotaMedica(user, @nEstReal, nClaveInterna, sResumen, sPresionArterial, sSignosVitales, sTemperatura);
  END
//


DELIMITER //
CREATE PROCEDURE buscarNotasMedicasPaciente(IN sExpediente varchar(20))
  BEGIN
    SELECT paciente.sNombre, paciente.sApPaterno, paciente.sApMaterno, estudios.sDescripcion, estudiorealizado.dFechaRealizado
    FROM paciente
      LEFT JOIN expediente
        ON expediente.sCurpPaciente = paciente.sCurpPaciente
      LEFT JOIN estudiorealizado
        ON estudiorealizado.nNumero = expediente.nNumero
      LEFT JOIN estudios
        ON estudios.nClaveInterna = estudiorealizado.nClaveInterna
    WHERE estudiorealizado.nNumero = sExpediente;
  END
//

DELIMITER //
CREATE PROCEDURE BuscaNombreExpediente (IN expediente varchar(20))
    BEGIN
    select p.sNombre,p.sApPaterno, p.sApMaterno
    from paciente p
      join expediente e on p.sCurpPaciente=e.sCurpPaciente
    where e.nNumero=expediente;
  END
  //

