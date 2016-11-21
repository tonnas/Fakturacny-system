/*
Project		Fakturacny system
Author		Tomas Illo
*/

/*
	Kontrola rodneho cisla
*/
create or replace TRIGGER TR_ROD_C
	BEFORE INSERT OR UPDATE OF ROD_CISLO ON OSOBA
		FOR EACH ROW
			 DECLARE
			   rod_c OSOBA.ROD_CISLO%TYPE;
			   den CHAR(2);
			   mesiac CHAR(2);
			   rok CHAR(2);
			   datum DATE;
			 BEGIN
			   rod_c := :NEW.ROD_CISLO;	   
			   mesiac := MID(rod_c,3,2); 
			   den   := MID(rod_c,5,2);;  
			   rok   := MID(rod_c,1,2);;	     

			 IF ( MOD(to_number(rod_c), 11) <> 0 ) THEN
				Raise_Application_Error (-20203, 'Neplatne rodne cislo');
			 END IF;

			 IF ( to_number(mesiac) > 50 ) THEN
			   mesiac := mesiac - 50;
			 END IF;

			 BEGIN
			  datum := den||'.'||mesic||'.'||rok;
			 WHEN OTHERS THEN
				Raise_Application_Error (-20204, 'Neplatny datum narodenia');
			 END;
 END TR_ROD_C;
 d
 /*
	Kontrola telefonneho cisla
 */
 create or replace TRIGGER TR_TEL_C
   BEFORE INSERT OR UPDATE OF ROD_CISLO ON OSOBA
	 FOR EACH ROW
		DECLARE
			tel_c TEL_CISLO.TEL_CISLO%TYPE
		BEGIN
			tel_c := :NEW.TEL_CISLO;
		IF(substr(tel_c,1,2) <> '09') THEN
			Raise_Application_Error (-20203, 'Neplatne telefonne cislo');
		END IF;
	END;
END TR_TEL_C;

/*
	Ak cislo z historie hovor neexistuje v tel_cislach
	prida toto cislo ako nove cislo do zoznamu
*/
create or replace TRIGGER TR_TEL_C_EXIST
   AFTER INSERT OR UPDATE OF PRIJIMATEL ON HISTORIA_HOVOR
	 FOR EACH ROW
		DECLARE
			tel_c HISTORIA_HOVOR.PRIJIMATEL%TYPE;
		BEGIN
			tel_c := :NEW.PRIJIMATEL;
		IF((SELECT count(TEL_CISLO) FROM TEL_CISLO where TEL_CISLO = tel_c) = 0) THEN
			INSERT INTO TEL_CISLO VALUES (tel_c,NULL);
		END IF;
	END;
END TR_TEL_C_EXIST;

/*
	Ak cislo z historie_sms neexistuje v tel_cislach
	prida toto cislo ako nove cislo do zoznamu
*/
create or replace TRIGGER TR_TEL_C_EXIST
   AFTER INSERT OR UPDATE OF PRIJIMATEL ON HISTORIA_SMS
	 FOR EACH ROW
		DECLARE
			tel_c TEL_CISLO.TEL_CISLO%TYPE
		BEGIN
			tel_c := :NEW.TEL_CISLO;
		IF((SELECT count(TEL_CISLO) FROM TEL_CISLO where TEL_CISLO = tel_c) = 0) 
		THEN
			INSERT INTO TEL_CISLO VALUES (tel_c,NULL);
		END IF;
	END;
END TR_TEL_C_EXIST;














 
 
 
 