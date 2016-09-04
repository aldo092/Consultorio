GRANT SELECT, INSERT, UPDATE, DELETE, EXECUTE ON consultorio.* TO 'adminconsultorio'@'%' IDENTIFIED BY 'sisadmin0303';
GRANT SELECT, INSERT, UPDATE, DELETE, EXECUTE ON consultorio.* TO 'adminconsultorio'@'localhost' IDENTIFIED BY 'sisadmin0303';

CREATE DATABASE consultorio;
ALTER SCHEMA `consultorio`  DEFAULT CHARACTER SET utf8  DEFAULT COLLATE utf8_spanish2_ci ;
USE consultorio;


CREATE TABLE Menu (
  nClave INT AUTO_INCREMENT NOT NULL,
  sDescripcion VARCHAR(200) NOT NULL,
  nPadre INT,
  PRIMARY KEY (nClave)
);


CREATE TABLE Funcion (
  nClaveFuncion INT AUTO_INCREMENT NOT NULL,
  sDescripcion VARCHAR(150) NOT NULL,
  sRutaPag VARCHAR(300) NOT NULL,
  nPadre INT NOT NULL,
  PRIMARY KEY (nClaveFuncion)
);


CREATE TABLE Roles (
  nIdRol INT AUTO_INCREMENT NOT NULL,
  sDescripcion VARCHAR(200) NOT NULL,
  PRIMARY KEY (nIdRol)
);


CREATE TABLE funcion_rol (
  nClaveFuncion INT NOT NULL,
  nIdRol INT NOT NULL,
  PRIMARY KEY (nClaveFuncion, nIdRol)
);


CREATE TABLE Estudios (
  nClaveInterna INT AUTO_INCREMENT NOT NULL,
  sDescripcion VARCHAR(100) NOT NULL,
  nIVA DECIMAL(10,2) NOT NULL,
  nCostoNormal DECIMAL(10,2) NOT NULL,
  nCostoAseg DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (nClaveInterna)
);


CREATE TABLE Horarios (
  nClaveHorario SMALLINT AUTO_INCREMENT NOT NULL,
  sDia VARCHAR(10) NOT NULL,
  sHoraInicio VARCHAR(5) NOT NULL,
  sHoraFin VARCHAR(5) NOT NULL,
  PRIMARY KEY (nClaveHorario)
);


CREATE TABLE Usuarios (
  sEmail VARCHAR(60) NOT NULL,
  sPassword VARCHAR(200) NOT NULL,
  dFechaRegistro DATE NOT NULL,
  PRIMARY KEY (sEmail)
);


CREATE TABLE usuario_rol (
  sEmail VARCHAR(60) NOT NULL,
  nIdRol INT NOT NULL,
  PRIMARY KEY (sEmail, nIdRol)
);


CREATE TABLE Accesos (
  sEmail VARCHAR(60) NOT NULL,
  nNIP INT NOT NULL,
  bEstado SMALLINT NOT NULL,
  PRIMARY KEY (sEmail, nNIP)
);


CREATE TABLE Bitacora (
  nClaveAccion INT AUTO_INCREMENT NOT NULL,
  sEmail VARCHAR(60) NOT NULL,
  sAccion VARCHAR(40) NOT NULL,
  dFechaAccion DATE NOT NULL,
  sTabla VARCHAR(100) NOT NULL,
  sDescripcionAccion text NOT NULL,
  PRIMARY KEY (nClaveAccion)
);


CREATE TABLE Personal (
  nIdPersonal INT AUTO_INCREMENT NOT NULL,
  sNombres VARCHAR(40) NOT NULL,
  sApMaterno VARCHAR(40) NOT NULL,
  sApPaterno VARCHAR(40) NOT NULL,
  sTelefono VARCHAR(15),
  sSexo CHAR(1),
  sCURP VARCHAR(18),
  sEmail VARCHAR(60),
  bEstatus SMALLINT DEFAULT 1 NOT NULL,
  sImagen VARCHAR(200),
  PRIMARY KEY (nIdPersonal)
);

ALTER TABLE Personal MODIFY COLUMN bEstatus SMALLINT COMMENT 'nte';


CREATE TABLE Medico (
  nIdPersonal INT NOT NULL,
  sNumCedula VARCHAR(20) NOT NULL,
  dFechaExpedicionCed DATE NOT NULL,
  sNumCedEsp VARCHAR(20) NOT NULL,
  dFecExpedCedEsp DATE NOT NULL,
  sNumTelefono1 VARCHAR(15),
  sNumTelefono2 VARCHAR(15),
  sEspecialidad VARCHAR(100),
  PRIMARY KEY (nIdPersonal)
);


CREATE TABLE Consultorio (
  nIdConsultorio SMALLINT NOT NULL,
  nIdPersonal INT NOT NULL,
  sDescripcion VARCHAR(100),
  PRIMARY KEY (nIdConsultorio)
);


CREATE TABLE asignaConsultorio (
  nIdConsultorio SMALLINT NOT NULL,
  nClaveHorario SMALLINT NOT NULL,
  PRIMARY KEY (nIdConsultorio, nClaveHorario)
);


CREATE TABLE MetodoAnticonceptivo (
  nClaveAnticonceptivo INT AUTO_INCREMENT NOT NULL,
  sDescripcion VARCHAR(60),
  PRIMARY KEY (nClaveAnticonceptivo)
);


CREATE TABLE Aseguradora (
  nIdAseguradora INT AUTO_INCREMENT NOT NULL,
  sNombre VARCHAR(100),
  sDireccion VARCHAR(200),
  sTelefono VARCHAR(13),
  PRIMARY KEY (nIdAseguradora)
);


CREATE TABLE Paciente (
  sCurpPaciente VARCHAR(18) NOT NULL,
  sNombre VARCHAR(50) NOT NULL,
  sApPaterno VARCHAR(50) NOT NULL,
  sApMaterno VARCHAR(50) NOT NULL,
  sSexo CHAR(1) NOT NULL,
  dFecNacimiento DATE,
  sTelefono VARCHAR(13),
  sDireccion VARCHAR(100),
  sCP CHAR(5),
  sEmail VARCHAR(50),
  sEstadoCivil VARCHAR(50),
  PRIMARY KEY (sCurpPaciente)
);


CREATE TABLE Expediente (
  nNumero VARCHAR(20) NOT NULL,
  sCurpPaciente VARCHAR(18) NOT NULL,
  PRIMARY KEY (nNumero)
);


CREATE TABLE Seguro (
  nIdAseguradora INT NOT NULL,
  nNumero VARCHAR(20) NOT NULL,
  dFechaVigencia DATE NOT NULL,
  PRIMARY KEY (nIdAseguradora, nNumero)
);


CREATE TABLE Cita (
  nFolioCita BIGINT AUTO_INCREMENT NOT NULL,
  nIdConsultorio SMALLINT NOT NULL,
  nClaveHorario SMALLINT NOT NULL,
  nNumero VARCHAR(20) NOT NULL,
  dFecRegistro DATETIME NOT NULL,
  dFechaCita DATETIME NOT NULL,
  PRIMARY KEY (nFolioCita, nIdConsultorio, nClaveHorario)
);


CREATE TABLE EstudioRealizado (
  nIdEstudioReal INT AUTO_INCREMENT NOT NULL,
  nClaveInterna INT NOT NULL,
  nNumero VARCHAR(20) NOT NULL,
  dFechaRealizado DATE NOT NULL,
  sImpresionDiagnostica text,
  sRutaArchivo text,
  PRIMARY KEY (nIdEstudioReal, nClaveInterna)
);


CREATE TABLE ReciboCobro (
  nIdFactura INT AUTO_INCREMENT NOT NULL,
  nIdEstudioReal INT NOT NULL,
  nClaveInterna INT NOT NULL,
  nTotal DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (nIdFactura)
);


CREATE TABLE AnteGinecoObstetricos (
  nNumero VARCHAR(20) NOT NULL,
  nGestaciones INT,
  nPartos INT,
  nClaveAnticonceptivo INT NOT NULL,
  nAbortos INT,
  sIVSA SMALLINT,
  nParejasSexuales SMALLINT,
  sETS VARCHAR(200),
  nCesareas INT,
  dUltPapanicolau DATE,
  PRIMARY KEY (nNumero)
);


CREATE TABLE AntePatologicos (
  nNumero VARCHAR(20) NOT NULL,
  sAlergias VARCHAR(200),
  sCardiopatias VARCHAR(100),
  sTranfusiones CHAR(2),
  sDiabetico VARCHAR(50),
  sCardioVasculares CHAR(2),
  sHTA CHAR(2),
  PRIMARY KEY (nNumero)
);


CREATE TABLE AnteNoPatologicos (
  nNumero VARCHAR(20) NOT NULL,
  sReligion VARCHAR(100),
  bTabaquismo CHAR(2),
  sEscolaridad VARCHAR(50),
  sOcupacion VARCHAR(100),
  bAlcoholismo VARCHAR(2),
  sDrogas CHAR(2),
  bAguaPotable CHAR(2),
  bElectricidad CHAR(2),
  bDrenaje CHAR(2),
  bServSanit CHAR(2),
  PRIMARY KEY (nNumero)
);


CREATE TABLE AntecedenteFam (
  nNumero VARCHAR(20) NOT NULL,
  sAlcoholismo CHAR(2),
  sAlergias CHAR(2),
  sAsma CHAR(2),
  sCancer CHAR(2),
  sCongenitos CHAR(2),
  sConvulsiones CHAR(2),
  sDiabetes CHAR(2),
  sHipertension CHAR(2),
  sDrogadiccion CHAR(2),
  sTabaquismo CHAR(2),
  PRIMARY KEY (nNumero)
);


ALTER TABLE Menu ADD CONSTRAINT menu_menu_fk
FOREIGN KEY (nPadre)
REFERENCES Menu (nClave)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE Funcion ADD CONSTRAINT menu_funcion_fk
FOREIGN KEY (nPadre)
REFERENCES Menu (nClave)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE funcion_rol ADD CONSTRAINT funcion_perfil_funcion_fk
FOREIGN KEY (nClaveFuncion)
REFERENCES Funcion (nClaveFuncion)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE usuario_rol ADD CONSTRAINT roles_usuario_rol_fk
FOREIGN KEY (nIdRol)
REFERENCES Roles (nIdRol)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE funcion_rol ADD CONSTRAINT roles_usuarios_funcion_fk
FOREIGN KEY (nIdRol)
REFERENCES Roles (nIdRol)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE EstudioRealizado ADD CONSTRAINT estudios_estudiorealizad_fk
FOREIGN KEY (nClaveInterna)
REFERENCES Estudios (nClaveInterna)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE asignaConsultorio ADD CONSTRAINT horarios_asignaconsultorio_fk
FOREIGN KEY (nClaveHorario)
REFERENCES Horarios (nClaveHorario)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE Personal ADD CONSTRAINT usuarios_personal_fk
FOREIGN KEY (sEmail)
REFERENCES Usuarios (sEmail)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE Bitacora ADD CONSTRAINT usuarios_bitacora_fk
FOREIGN KEY (sEmail)
REFERENCES Usuarios (sEmail)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE Accesos ADD CONSTRAINT usuarios_accesos_fk
FOREIGN KEY (sEmail)
REFERENCES Usuarios (sEmail)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE usuario_rol ADD CONSTRAINT usuarios_usuario_rol_fk
FOREIGN KEY (sEmail)
REFERENCES Usuarios (sEmail)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE Medico ADD CONSTRAINT personal_medico_fk
FOREIGN KEY (nIdPersonal)
REFERENCES Personal (nIdPersonal)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE Consultorio ADD CONSTRAINT medico_consultorios_fk
FOREIGN KEY (nIdPersonal)
REFERENCES Medico (nIdPersonal)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE asignaConsultorio ADD CONSTRAINT consultorio_asignaconsultorio_fk
FOREIGN KEY (nIdConsultorio)
REFERENCES Consultorio (nIdConsultorio)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE Cita ADD CONSTRAINT asignaconsultorio_cita_fk
FOREIGN KEY (nIdConsultorio, nClaveHorario)
REFERENCES asignaConsultorio (nIdConsultorio, nClaveHorario)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE AnteGinecoObstetricos ADD CONSTRAINT metodoanticonceptivo_anteginecoobstetricos_fk
FOREIGN KEY (nClaveAnticonceptivo)
REFERENCES MetodoAnticonceptivo (nClaveAnticonceptivo)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE Seguro ADD CONSTRAINT aseguradora_pacienteasegurado_fk
FOREIGN KEY (nIdAseguradora)
REFERENCES Aseguradora (nIdAseguradora)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE Expediente ADD CONSTRAINT paciente_expediente_fk
FOREIGN KEY (sCurpPaciente)
REFERENCES Paciente (sCurpPaciente)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE AntecedenteFam ADD CONSTRAINT expediente_antecedentefam_fk
FOREIGN KEY (nNumero)
REFERENCES Expediente (nNumero)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE AnteNoPatologicos ADD CONSTRAINT expediente_antenopatologicos_fk
FOREIGN KEY (nNumero)
REFERENCES Expediente (nNumero)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE AntePatologicos ADD CONSTRAINT expediente_antepatologicos_fk
FOREIGN KEY (nNumero)
REFERENCES Expediente (nNumero)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE AnteGinecoObstetricos ADD CONSTRAINT expediente_anteginecoobstetricos_fk
FOREIGN KEY (nNumero)
REFERENCES Expediente (nNumero)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE EstudioRealizado ADD CONSTRAINT expediente_estudiorealizado_fk
FOREIGN KEY (nNumero)
REFERENCES Expediente (nNumero)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE Cita ADD CONSTRAINT expediente_cita_fk
FOREIGN KEY (nNumero)
REFERENCES Expediente (nNumero)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE Seguro ADD CONSTRAINT expediente_seguro_fk
FOREIGN KEY (nNumero)
REFERENCES Expediente (nNumero)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE ReciboCobro ADD CONSTRAINT estudiorealizad_facturas_fk
FOREIGN KEY (nIdEstudioReal, nClaveInterna)
REFERENCES EstudioRealizado (nIdEstudioReal, nClaveInterna)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

ALTER TABLE personal
DROP FOREIGN KEY usuarios_personal_fk;
ALTER TABLE personal
ADD CONSTRAINT usuarios_personal_fk
FOREIGN KEY (sEmail)
REFERENCES usuarios(sEmail)
  ON DELETE CASCADE
  ON UPDATE NO ACTION;

ALTER TABLE medico
DROP FOREIGN KEY personal_medico_fk;
ALTER TABLE medico
ADD CONSTRAINT personal_medico_fk
FOREIGN KEY (nIdPersonal)
REFERENCES personal(nIdPersonal)
  ON DELETE CASCADE
  ON UPDATE NO ACTION;


INSERT INTO roles(sDescripcion) VALUES('ADMINISTRADOR');
INSERT INTO roles(sDescripcion) VALUES('MEDICO');
INSERT INTO roles(sDescripcion) VALUES('RECEPCIONISTA');

INSERT INTO Usuarios(sEmail, sPassword, dFechaRegistro)
VALUES ('sisalpasolft@gmail.com',md5('acm1pt'), CURRENT_DATE());

INSERT INTO Personal(sNombres, sApPaterno, sApMaterno, sTelefono, sSexo, sCURP, sEmail, bEstatus)
VALUES ('Sistema','Expediente','Electrónico', '2717493689','M','LALP920516HVZLPB07','sisalpasolft@gmail.com' ,1);

INSERT INTO Accesos(sEmail, nNIP, bEstado) VALUES ('sisalpasolft@gmail.com',md5(3728),1);

INSERT INTO usuario_rol (sEmail, nIdRol) VALUES('sisalpasolft@gmail.com',1);

/*Menús del Sistema */
INSERT INTO menu (sDescripcion) values ('Pacientes');
INSERT INTO menu (sDescripcion) values ('Usuarios');
INSERT INTO menu (sDescripcion) values ('Citas');
INSERT INTO menu (sDescripcion) values ('Reportes');
INSERT INTO menu (sDescripcion) values ('Estudios');
INSERT INTO menu (sDescripcion) values ('Bitácora');
INSERT INTO menu (sDescripcion) values ('Seguro');
INSERT INTO menu (sDescripcion) values ('Consultorios');
INSERT INTO menu (sDescripcion) values ('Personal');
INSERT INTO menu (sDescripcion) values ('Otros');

INSERT INTO funcion(sDescripcion, sRutaPag, nPadre)
VALUES ('Registrar Pacientes', 'Sesiones/Pacientes/registroPacientes.php',1);
INSERT INTO funcion(sDescripcion, sRutaPag, nPadre)
VALUES ('Registrar Antecedentes', 'Sesiones/Pacientes/antecedentes.php',1);
INSERT INTO funcion(sDescripcion, sRutaPag, nPadre)
VALUES ('Control de Estudios', 'Sesiones/Estudios/controlEstudios.php',5);
INSERT INTO funcion(sDescripcion, sRutaPag, nPadre)
VALUES ('Control de Usuarios', 'Sesiones/Usuarios/controlUsuarios.php',2);
INSERT INTO funcion(sDescripcion, sRutaPag, nPadre)
VALUES ('Gestión de Roles de Usuario', 'Sesiones/Usuarios/gestionRoles.php',2);
INSERT INTO funcion(sDescripcion, sRutaPag, nPadre)
VALUES ('Registrar Cita', 'Sesiones/Citas/registrarCitas.php',3);
INSERT INTO funcion(sDescripcion, sRutaPag, nPadre)
VALUES ('Consultar Citas', 'Sesiones/Citas/consultarCitas.php',3);
INSERT INTO funcion(sDescripcion, sRutaPag, nPadre)
VALUES ('Cancelar Cita', 'Sesiones/Citas/cancelarCitas.php',3);
INSERT INTO funcion(sDescripcion, sRutaPag, nPadre)
VALUES ('Reportes de Estudios', 'Sesiones/Reportes/generarReporte.php',4);
INSERT INTO funcion(sDescripcion, sRutaPag, nPadre)
VALUES ('Registrar Consultorio', 'Sesiones/Consultorios/registrarConsultorio.php',8);
INSERT INTO funcion(sDescripcion, sRutaPag, nPadre)
VALUES ('Control de Aseguradoras', 'Sesiones/Seguro/controlSeguros.php',7);
INSERT INTO funcion(sDescripcion, sRutaPag, nPadre)
VALUES ('Control de Personal', 'Sesiones/Personal/controlPersonal.php',9);
INSERT INTO funcion(sDescripcion, sRutaPag, nPadre)
VALUES ('Consultar Bitácora del Sistema', 'Sesiones/Otros/consultarBitacora.php',6);

INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(1,1);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(2,1);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(3,1);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(6,1);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(7,1);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(8,1);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(9,1);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(10,1);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(11,1);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(12,1);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(13,1);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(1,2);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(2,2);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(6,2);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(7,2);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(8,2);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(9,2);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(6,3);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(7,3);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(8,3);
INSERT INTO funcion_rol(nClaveFuncion, nIdRol) VALUES(2,3);