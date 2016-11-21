/*
Project		Fakturacny system
Author		Tomas Illo
*/

/*
	Procedura naplni pomocne tabulky udajmi z historie 
	hovorov a sms
*/
create or replace PROCEDURE naplnenie_pomocnych_tabuliek
	( p_tel_c IN HISTORIA_HOVOR.VOLAJUCI%TYPE,
    p_odkedy in date,
    p_dokedy in date )
IS
BEGIN
  INSERT INTO POM_H ("tel_cislo","dlzka_hovoru")
    select PRIJIMATEL, sum((KONIEC_HOVORU - DATUM)*(1440*60)) 
      from HISTORIA_HOVOR
        where VOLAJUCI = p_tel_c 
        AND HISTORIA_HOVOR.DATUM >= p_odkedy
        AND HISTORIA_HOVOR.DATUM <= p_dokedy
            group by PRIJIMATEL;
   
   INSERT INTO POM_S ("tel_cislo","pocet_sms")         
    select PRIJIMATEL, count(*) 
      from HISTORIA_SMS
        where POSIELAJUCI = p_tel_c
        AND TYP = 'S'
        AND DATUM >= p_odkedy
        AND DATUM <= p_dokedy
            group by PRIJIMATEL;
            
    INSERT INTO POM_M ("tel_cislo","pocet_mms")         
    select PRIJIMATEL, count(*) 
      from HISTORIA_SMS
        where POSIELAJUCI = p_tel_c
        AND TYP = 'M'
        AND DATUM >= p_odkedy
        AND DATUM <= p_dokedy
            group by PRIJIMATEL;
END;