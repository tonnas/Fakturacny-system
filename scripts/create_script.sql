/*
Project		Fakturacny system
Author		Tomas Illo
*/

Create table "Osoba" (
	"rod_cislo" Char (11) NOT NULL ,
	"meno" Varchar2 (15) NOT NULL ,
	"priezvisko" Varchar2 (15) NOT NULL ,
	"ulica" Varchar2 (30) NOT NULL ,
	"psc" Char (5) NOT NULL ,
	"obec" Varchar2 (30) NOT NULL ,
primary key ("rod_cislo") 
) 
/

Create table "sms_historia" (
	"datum" Date NOT NULL ,
	"posielajuci" Char (10) NOT NULL ,
	"prijimatel" Char (10) NOT NULL ,
	"typ" Char (1) NOT NULL  Check (typIN{'M','S'} ) ,
primary key ("datum","posielajuci","prijimatel") 
) 
/

Create table "hovor_historia" (
	"datum" Date NOT NULL ,
	"volajuci" Char (10) NOT NULL ,
	"prijimatel" Char (10) NOT NULL ,
	"koniec_hovoru" Date NOT NULL ,
primary key ("datum","volajuci","prijimatel") 
) 
/

Create table "internet_historia" (
	"datum" Date NOT NULL ,
	"tel_cislo" Char (10) NOT NULL ,
	"data_MB" Integer NOT NULL ,
	"do" Date NOT NULL ,
primary key ("datum","tel_cislo") 
) 
/

Create table "Tel_cislo" (
	"tel_cislo" Char (10) NOT NULL ,
	"rod_cislo" Char (11),
primary key ("tel_cislo") 
) 
/

Create table "Sluzba" (
	"id_sluzby" Integer NOT NULL ,
	"nazov" Varchar2 (30) NOT NULL ,
primary key ("id_sluzby") 
) 
/

Create table "Tel_cislo_sluzba" (
	"odkedy" Date NOT NULL ,
	"tel_cislo" Char (10) NOT NULL ,
	"id_sluzby" Integer NOT NULL ,
	"dokedy" Date,
primary key ("odkedy","tel_cislo","id_sluzby") 
) 
/

Create table "Sms_sluzba" (
	"id_sms" Integer NOT NULL ,
	"id_balicek" Integer NOT NULL ,
	"v_sieti" Integer NOT NULL ,
	"mimo_siet" Integer NOT NULL ,
primary key ("id_sms") 
) 
/

Create table "Minuty_sluzba" (
	"id_sluzby" Integer NOT NULL ,
	"id_balicek" Integer NOT NULL ,
	"minuty_v_sieti" Integer NOT NULL ,
	"minuty_mimo_siet" Integer NOT NULL ,
primary key ("id_sluzby") 
) 
/

Create table "Internet_sluzba" (
	"id_internet" Integer NOT NULL ,
	"id_balicek" Integer NOT NULL ,
	"data_MB" Integer NOT NULL ,
	"MB_s" Float NOT NULL ,
primary key ("id_internet") 
) 
/

Create table "Parova_sluzba" (
	"odkedy" Date NOT NULL ,
	"tel_cislo" Char (10) NOT NULL ,
	"prijimatel" Char (10) NOT NULL ,
	"minuty" Integer NOT NULL ,
	"sms" Integer NOT NULL ,
	"cena" Float NOT NULL ,
	"dokedy" Date,
primary key ("odkedy","tel_cislo","prijimatel") 
) 
/

Create table "Cennik_operator" (
	"odkedy" Date NOT NULL ,
	"id_operator" Integer NOT NULL ,
	"cena_minuta" Float NOT NULL ,
	"cena_sms" Float NOT NULL ,
	"dokedy" Varchar2 (30),
primary key ("odkedy","id_operator") 
) 
/

Create table "Faktura" (
	"id_faktury" Integer NOT NULL ,
	"tel_cislo" Char (10) NOT NULL ,
	"suma" Float NOT NULL ,
	"vystavena" Date NOT NULL ,
	"splatna" Date NOT NULL ,
	"odkedy" Date NOT NULL ,
	"dokedy" Date NOT NULL ,
	"zaplatene" Date,
primary key ("id_faktury","tel_cislo") 
) 
/

Create table "Cennik_sluzba" (
	"odkedy" Date NOT NULL ,
	"id_sluzby" Integer NOT NULL ,
	"cena" Float NOT NULL ,
	"dokedy" Date,
primary key ("odkedy","id_sluzby") 
) 
/

Create table "Operator" (
	"id_operator" Integer NOT NULL ,
	"nazov" Varchar2 (10) NOT NULL ,
primary key ("id_operator") 
) 
/

Create table "Balicek_sluzba" (
	"id_balicek" Integer NOT NULL ,
	"nazov" Varchar2 (20) NOT NULL ,
primary key ("id_balicek") 
) 
/

Create table "Cennik_balicek" (
	"odkedy" Date NOT NULL ,
	"id_balicek" Integer NOT NULL ,
	"cena" Float NOT NULL ,
	"dokedy" Date,
primary key ("odkedy","id_balicek") 
) 
/

Create table "Tel_cislo_operator" (
	"odkedy" Date NOT NULL ,
	"tel_cislo" Char (10) NOT NULL ,
	"id_operator" Integer NOT NULL ,
	"dokedy" Date NOT NULL ,
primary key ("odkedy","tel_cislo","id_operator") 
)
/
 
Alter table "Tel_cislo" add  foreign key ("rod_cislo") references "Osoba" ("rod_cislo") 
/

Alter table "hovor_historia" add  foreign key ("volajuci") references "Tel_cislo" ("tel_cislo") 
/

Alter table "hovor_historia" add  foreign key ("prijimatel") references "Tel_cislo" ("tel_cislo") 
/

Alter table "sms_historia" add  foreign key ("posielajuci") references "Tel_cislo" ("tel_cislo") 
/

Alter table "sms_historia" add  foreign key ("prijimatel") references "Tel_cislo" ("tel_cislo") 
/

Alter table "internet_historia" add  foreign key ("tel_cislo") references "Tel_cislo" ("tel_cislo") 
/

Alter table "Tel_cislo_sluzba" add  foreign key ("tel_cislo") references "Tel_cislo" ("tel_cislo") 
/

Alter table "Parova_sluzba" add  foreign key ("prijimatel") references "Tel_cislo" ("tel_cislo") 
/

Alter table "Parova_sluzba" add  foreign key ("tel_cislo") references "Tel_cislo" ("tel_cislo") 
/

Alter table "Faktura" add  foreign key ("tel_cislo") references "Tel_cislo" ("tel_cislo") 
/

Alter table "Tel_cislo_operator" add  foreign key ("tel_cislo") references "Tel_cislo" ("tel_cislo") 
/

Alter table "Tel_cislo_sluzba" add  foreign key ("id_sluzby") references "Sluzba" ("id_sluzby") 
/

Alter table "Sms_sluzba" add  foreign key ("id_sms") references "Sluzba" ("id_sluzby") 
/

Alter table "Internet_sluzba" add  foreign key ("id_internet") references "Sluzba" ("id_sluzby") 
/

Alter table "Cennik_sluzba" add  foreign key ("id_sluzby") references "Sluzba" ("id_sluzby") 
/

Alter table "Minuty_sluzba" add  foreign key ("id_sluzby") references "Sluzba" ("id_sluzby") 
/

Alter table "Tel_cislo_operator" add  foreign key ("id_operator") references "Operator" ("id_operator") 
/

Alter table "Cennik_operator" add  foreign key ("id_operator") references "Operator" ("id_operator") 
/

Alter table "Minuty_sluzba" add  foreign key ("id_balicek") references "Balicek_sluzba" ("id_balicek") 
/

Alter table "Sms_sluzba" add  foreign key ("id_balicek") references "Balicek_sluzba" ("id_balicek") 
/

Alter table "Internet_sluzba" add  foreign key ("id_balicek") references "Balicek_sluzba" ("id_balicek") 
/

Alter table "Cennik_balicek" add  foreign key ("id_balicek") references "Balicek_sluzba" ("id_balicek") 
/



