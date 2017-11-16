/*
Project		Fakturacny system
Author		Tomas Illo
*/

/*
	Funkcia pre vypocet celkovej ceny
*/
create or replace FUNCTION cena_faktury
	( p_tel_c IN TEL_CISLO.TEL_CISLO%TYPE,
    p_odkedy in date,
    p_dokedy in date )
RETURN integer
IS 
 cena integer;
 min_v integer;
 min_m integer;
 sms_v integer;
 sms_m integer;
 mms_v integer;
 mms_m integer;
 internet integer;
BEGIN
   VYT_POM_TABULIEK(p_tel_c, p_odkedy, p_dokedy);
   --Odcitat hodnoty z parovej sluzby
   internet := INTERNET_DATA(p_tel_c, p_odkedy, p_dokedy) 
            - INTERNET_DATA_SLUZBA(p_tel_c, p_odkedy, p_dokedy);
   IF (internet < 0) THEN internet := 0; END IF;
   /*
      minuty_v = sucet_minut_v_sieti ();
      minuty_mimo = sucet_minut_mimo ();
      sms_v = sucet_sms_v_sieti ();
      sms_mimo = sucet_sms_mimo ();
      mms_v = sucet_mms_v_sieti ();
      mms_mimo = sucet_mms_mimo ();
   */
   cena := min_v + min_m + sms_v + sms_m + mms_v + mms_m + internet;
   return cena;
END;

/*
	precerpane internet data 
*/
CREATE OR REPLACE FUNCTION internet_data
	(p_tel_c IN HISTORIA_INTERNET.TEL_CISLO%TYPE,
    odkedy in date,
    dokedy in date)
RETURN integer
IS 
d_MB_S integer,
d_MB_H integer,
d_MB integer;
BEGIN
  SELECT SUM(DATA_MB) into d_MB_S From INTERNET_SLUZBA
  JOIN SLUZBA ON SLUZBA.ID_SLUZBY = INTERNET_SLUZBA.ID_INTERNET
  JOIN TEL_CISLO_SLUZBA ON TEL_CISLO_SLUZBA.ID_SLUZBY = SLUZBA.ID_SLUZBY
  where TEL_CISLO = p_tel_c;
  AND DATUM > p_odkedy 
  AND DATUM < p_dokedy;
  
  SELECT SUM(DATA_MB) into d_MB_H From HISTORIA_INTERNET
  where TEL_CISLO = p_tel_c;
  AND DATUM > p_odkedy 
  AND DATUM < p_dokedy;
  
  d_MB := d_MB_H - d_MB_S;
  IF (d_MB >= 0) THEN
	return d_MB; 
  else
	return 0;
END;

/*
	Sucet ceny vsetkych sluzieb konkretneho cisla
	v konkretnom obdobii.
*/	
CREATE OR REPLACE FUNCTION vypocet_ceny_sluzby
	(p_tel_c IN TEL_CISLO.TEL_CISLO%TYPE,
    p_odkedy in date,
    p_dokedy in date)
RETURN integer
IS 
cRet integer;
BEGIN
  SELECT SUM(CENA) INTO cRet FROM CENNIK_SLUZBA
  JOIN SLUZBA ON CENNIK_SLUZBA.ID_SLUZBY = SLUZBA.ID_SLUZBY
  JOIN TEL_CISLO_SLUZBA ON SLUZBA.ID_SLUZBY = TEL_CISLO_SLUZBA.ID_SLUZBY
  where TEL_CISLO_SLUZBA.TEL_CISLO = p_tel_c
  AND TEL_CISLO_SLUZBA.ODKEDY >= p_odkedy
  AND NVL(TEL_CISLO_SLUZBA.DOKEDY,sysdate) >= p_dokedy;
  return cRet; 
END;

/*
	Sucet ceny parovej sluzby na konretnom cisle
	v konkretnom obdobii.
*/	
CREATE OR REPLACE FUNCTION vypocet_ceny_par
	( p_tel_c IN PAROVA_SLUZBA.TEL_CISLO%TYPE,
    p_odkedy in date,
    p_dokedy in date )
RETURN integer
IS 
cRet integer;
BEGIN
  SELECT SUM(CENA) INTO cRet FROM PAROVA_SLUZBA
  where TEL_CISLO = p_tel_c
  AND PAROVA_SLUZBA.ODKEDY <= p_odkedy
  AND NVL(PAROVA_SLUZBA.DOKEDY,sysdate) >= p_dokedy;
  return cRet; 
END;
	
/*
	Zisti ci su cisla u rovnakeho operatora
*/	
create or replace FUNCTION opertor_tc
	(p_tel_c IN TEL_CISLO.TEL_CISLO%TYPE,
   p_prijimatel IN TEL_CISLO.TEL_CISLO%TYPE)
RETURN integer
IS
 id_tc integer;
 id_pr integer;
BEGIN
  select id_operator into id_tc from TEL_CISLO_OPERATOR
  where TEL_CISLO = p_tel_c;
  select id_operator into id_pr from TEL_CISLO_OPERATOR
  where TEL_CISLO = p_prijimatel;
  IF ( id_tc = id_pr ) THEN
    return 1;
  ELSE 
    return 0;
  END IF;
END;
