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