/*
Created		10/23/2016
Modified		11/8/2016
Project		
Model		
Company		
Author		
Version		
Database		Oracle 10g 
*/


-- Create Types section


-- Create Tables section


Create table OSOBA (
	rod_cislo Char (11) NOT NULL ,
	meno Varchar2 (15) NOT NULL ,
	priezvisko Varchar2 (15) NOT NULL ,
	ulica Varchar2 (30) NOT NULL ,
	psc Char (5) NOT NULL ,
	obec Varchar2 (30) NOT NULL ,
primary key (rod_cislo) 
) 
/

Create table HISTORIA_SMS (
	datum Date NOT NULL ,
	posielajuci Char (10) NOT NULL ,
	prijimatel Char (10) NOT NULL ,
	typ Char (1) NOT NULL ,
primary key (datum,posielajuci,prijimatel) 
) 
/

Create table HISTORIA_HOVOR (
	datum Date NOT NULL ,
	volajuci Char (10) NOT NULL ,
	prijimatel Char (10) NOT NULL ,
	koniec_hovoru Date,
primary key (datum,volajuci,prijimatel) 
) 
/

Create table HISTORIA_INTERNET (
	datum Date NOT NULL ,
	tel_cislo Char (10) NOT NULL ,
	data_MB Integer NOT NULL ,
primary key (datum,tel_cislo) 
) 
/

Create table TEL_CISLO (
	tel_cislo Char (10) NOT NULL ,
	rod_cislo Char (11),
primary key (tel_cislo) 
) 
/

Create table SLUZBA (
	id_sluzby Integer NOT NULL ,
	nazov Varchar2 (30) NOT NULL ,
primary key (id_sluzby) 
) 
/

Create table TEL_CISLO_SLUZBA (
	odkedy Date NOT NULL ,
	tel_cislo Char (10) NOT NULL ,
	id_sluzby Integer NOT NULL ,
	dokedy Date,
primary key (odkedy,tel_cislo,id_sluzby) 
) 
/

Create table SMS_SLUZBA (
	id_sms Integer NOT NULL ,
	v_sieti Integer NOT NULL ,
	mimo_siet Integer NOT NULL ,
primary key (id_sms) 
) 
/

Create table MINUTY_SLUZBA (
	id_sluzby Integer NOT NULL ,
	minuty_v_sieti Integer NOT NULL ,
	minuty_mimo_siet Integer NOT NULL ,
primary key (id_sluzby) 
) 
/

Create table INTERNET_SLUZBA (
	id_internet Integer NOT NULL ,
	data_MB Integer NOT NULL ,
	MB_s Float NOT NULL ,
primary key (id_internet) 
) 
/

Create table PAROVA_SLUZBA (
	odkedy Date NOT NULL ,
	tel_cislo Char (10) NOT NULL ,
	prijimatel Char (10) NOT NULL ,
	minuty Integer NOT NULL ,
	sms Integer NOT NULL ,
	cena Float NOT NULL ,
	dokedy Date,
primary key (odkedy,tel_cislo,prijimatel) 
) 
/

Create table CENNIK_OPERATOR (
	odkedy Date NOT NULL ,
	id_operator Integer NOT NULL ,
	cena_minuta Float NOT NULL ,
	cena_sms Float NOT NULL ,
	dokedy Varchar2 (30),
primary key (odkedy,id_operator) 
) 
/

Create table FAKTURA (
	id_faktury Integer NOT NULL ,
	tel_cislo Char (10) NOT NULL ,
	suma Float NOT NULL ,
	vystavena Date NOT NULL ,
	splatna Date NOT NULL ,
	odkedy Date NOT NULL ,
	dokedy Date NOT NULL ,
	zaplatene Date,
primary key (id_faktury,tel_cislo) 
) 
/

Create table CENNIK_SLUZBA (
	odkedy Date NOT NULL ,
	id_sluzby Integer NOT NULL ,
	cena Float NOT NULL ,
	dokedy Date,
primary key (odkedy,id_sluzby) 
) 
/

Create table OPERATOR (
	id_operator Integer NOT NULL ,
	nazov Varchar2 (10) NOT NULL ,
primary key (id_operator) 
) 
/

Create table TEL_CISLO_OPERATOR (
	tel_cislo Char (10) NOT NULL ,
	id_operator Integer NOT NULL ,
primary key (tel_cislo,id_operator) 
) 
/

Create table BALICEK (
	id_sluzby Integer NOT NULL ,
	minuty_v Integer NOT NULL ,
	minuty_mimo Integer NOT NULL ,
	sms_v Integer NOT NULL ,
	sms_mimo Integer NOT NULL ,
	internet Integer NOT NULL ,
primary key (id_sluzby) 
) 
/


-- Create Foreign keys section

Alter table TEL_CISLO add  foreign key (rod_cislo) references OSOBA (rod_cislo) 
/

Alter table HISTORIA_HOVOR add  foreign key (volajuci) references TEL_CISLO (tel_cislo) 
/

Alter table HISTORIA_HOVOR add  foreign key (prijimatel) references TEL_CISLO (tel_cislo) 
/

Alter table HISTORIA_SMS add  foreign key (posielajuci) references TEL_CISLO (tel_cislo) 
/

Alter table HISTORIA_SMS add  foreign key (prijimatel) references TEL_CISLO (tel_cislo) 
/

Alter table HISTORIA_INTERNET add  foreign key (tel_cislo) references TEL_CISLO (tel_cislo) 
/

Alter table TEL_CISLO_SLUZBA add  foreign key (tel_cislo) references TEL_CISLO (tel_cislo) 
/

Alter table PAROVA_SLUZBA add  foreign key (prijimatel) references TEL_CISLO (tel_cislo) 
/

Alter table PAROVA_SLUZBA add  foreign key (tel_cislo) references TEL_CISLO (tel_cislo) 
/

Alter table FAKTURA add  foreign key (tel_cislo) references TEL_CISLO (tel_cislo) 
/

Alter table TEL_CISLO_OPERATOR add  foreign key (tel_cislo) references TEL_CISLO (tel_cislo) 
/

Alter table TEL_CISLO_SLUZBA add  foreign key (id_sluzby) references SLUZBA (id_sluzby) 
/

Alter table SMS_SLUZBA add  foreign key (id_sms) references SLUZBA (id_sluzby) 
/

Alter table INTERNET_SLUZBA add  foreign key (id_internet) references SLUZBA (id_sluzby) 
/

Alter table CENNIK_SLUZBA add  foreign key (id_sluzby) references SLUZBA (id_sluzby) 
/

Alter table MINUTY_SLUZBA add  foreign key (id_sluzby) references SLUZBA (id_sluzby) 
/

Alter table BALICEK add  foreign key (id_sluzby) references SLUZBA (id_sluzby) 
/

Alter table TEL_CISLO_OPERATOR add  foreign key (id_operator) references OPERATOR (id_operator) 
/

Alter table CENNIK_OPERATOR add  foreign key (id_operator) references OPERATOR (id_operator) 
/


-- Create Object Tables section


-- Create XMLType Tables section


-- Create Functions section


-- Create Sequences section


-- Create Packages section


-- Create Synonyms section


-- Create Table comments section


-- Create Attribute comments section


