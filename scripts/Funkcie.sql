/*
Project		Fakturacny system
Author		Tomas Illo
*/

CREATE OR REPLACE FUNCTION internet_data
	(p_tel_c IN HISTORIA_INTERNET.TEL_CISLO%TYPE,
    odkedy in date,
    dokedy in date)
RETURN integer
IS 
d_MB integer;
BEGIN
  SELECT SUM(DATA_MB) INTO d_MB From HISTORIA_INTERNET
    where TEL_CISLO = p_tel_c AND DATUM > odkedy AND DATUM < dokedy;
	return d_MB; 
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
	
