/*
Project		Fakturacny system
Author		Tomas Illo
*/

/*
	Cena sluzieb konkretneho cisla
*/
select sum(CENA) from CENNIK_SLUZBA
  JOIN SLUZBA
    ON CENNIK_SLUZBA.ID_SLUZBY = SLUZBA.ID_SLUZBY
      JOIN TEL_CISLO_SLUZBA
        ON SLUZBA.ID_SLUZBY = TEL_CISLO_SLUZBA.ID_SLUZBY
          where TEL_CISLO_SLUZBA.TEL_CISLO = '0948420074';
          
/*
	Dlzka hovoru konkretneho cisla v casovom rozmedzi
*/
select round(to_number(KONIEC_HOVORU-datum)*1440) from HISTORIA_HOVOR
  where VOLAJUCI = '0948420074'
    AND DATUM > to_date('101016','DDMMYY')
      AND DATUM < to_date('261016','DDMMYY');
    
/*
	Vsetko z balicka konkretneho cisla
*/
select * from BALICEK join SLUZBA
  ON SLUZBA.ID_SLUZBY = BALICEK.ID_SLUZBY
    JOIN TEL_CISLO_SLUZBA
      ON SLUZBA.ID_SLUZBY = BALICEK.ID_SLUZBY
        where TEL_CISLO_SLUZBA.TEL_CISLO = '0948420074'; 
		
/*
	Internetove data na konkretnom cisle SLUZBA
*/
select sum(data_MB) from INTERNET_SLUZBA
  JOIN SLUZBA ON INTERNET_SLUZBA.ID_INTERNET = SLUZBA.ID_SLUZBY
    JOIN TEL_CISLO_SLUZBA ON TEL_CISLO_SLUZBA.ID_SLUZBY = SLUZBA.ID_SLUZBY
      where TEL_CISLO_SLUZBA.TEL_CISLO = '0948420074';
    
/*
	Minuty v sieti	konkretneho cisle SLUZBA
*/
select minuty_v_sieti from MINUTY_SLUZBA
  join SLUZBA on SLUZBA.ID_SLUZBY = MINUTY_SLUZBA.ID_SLUZBY
    join TEL_CISLO_SLUZBA on SLUZBA.ID_SLUZBY = MINUTY_SLUZBA.ID_SLUZBY
      where TEL_CISLO_SLUZBA.TEL_CISLO = '0948420074';
	
/*
	SMS v sieti konkretneho cisla SLUZBA
*/
select v_sieti from SMS_SLUZBA
  join SLUZBA ON SMS_SLUZBA.ID_SMS = SLUZBA.ID_SLUZBY
   join TEL_CISLO_SLUZBA ON TEL_CISLO_SLUZBA.ID_SLUZBY = SLUZBA.ID_SLUZBY
    where TEL_CISLO_SLUZBA.TEL_CISLO = '0948420074';
	
/*
	Pocet minut v sieti (1) a mimo nej (0)
*/	
 select sum("dlzka_hovoru") from POM_H 
  where OPERTOR_TC(P_TEL_C,P_PRIJIMATEL) = 1;
  
 /*
	Pocet sms v sieti (1) a mimo nej (0)
 */
select sum("pocet_sms") from POM_S 
  where OPERTOR_TC(P_TEL_C,P_PRIJIMATEL) = 1;
 
 /*
	Pocet mms v sieti (1) a mimo nej (0)
 */
 select sum("pocet_mms") from POM_S 
  where OPERTOR_TC(P_TEL_C,P_PRIJIMATEL) = 1;
 
 