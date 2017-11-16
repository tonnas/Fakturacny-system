/*
Project		Fakturacny system
Author		Tomas Illo
*/

/*
	Vytvorenie pomocnych tabuliek
*/
create or replace PROCEDURE vyt_pom_tabuliek
	( p_tel_c IN HISTORIA_HOVOR.VOLAJUCI%TYPE,
    p_odkedy in date,
    p_dokedy in date )
IS
  var_create_table varchar2(4000);
BEGIN
  var_create_table := 
            'create table pom_h (
            "prijimatel" Char(10) NOT NULL,
            "minuty" integer,
            primary key("prijimatel")
            )
            create table pom_s (
            "prijimatel" Char(10) NOT NULL,
            "pocet_sms" integer,
            primary key("prijimatel")
            )
            create table pom_m (
            "prijimatel" Char(10) NOT NULL,
            "pocet_mms" integer, 
            primary key("prijimatel")
            )';
  EXECUTE IMMEDIATE var_create_table;
  NAPLNENIE_POMOCNYCH_TABULIEK(p_tel_c,p_odkedy,p_dokedy);
END;

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

/*
	vypocet minut v sieti a mimo siete
	NEJDE !!!!
*/
create or replace PROCEDURE minuty_vm
	(p_tel_c IN TEL_CISLO.TEL_CISLO%TYPE,
   p_prijimatel IN TEL_CISLO.TEL_CISLO%TYPE,
   p_minuty_v IN integer, 
   p_minuty_mimo IN integer)
IS
  minuty_v integer;
  minuty_mimo integer;
BEGIN
  select sum("dlzka_hovoru") into minuty_v from POM_H 
  where OPERTOR_TC(P_TEL_C,P_PRIJIMATEL) = 1;
  select sum("dlzka_hovoru") into minuty_mimo from POM_H 
  where OPERTOR_TC(P_TEL_C,P_PRIJIMATEL) = 0;
  p_minuty_v := minuty_v;
  p_minuty_mimo := minuty_mimo;
END;