CREATE DATABASE EventAdvisors;

CREATE TABLE Registration(
	id INTEGER AUTO_INCREMENT,
	UFname CHAR(255) NOT NULL,
	ULname CHAR(255) NOT NULL,
	UPswd CHAR(255) NOT NULL,
	Uemail CHAR(255) NOT NULL,
	Uphone CHAR(15) DEFAULT 'N/A',
	Uadmin CHAR(1) DEFAULT 0,
	UuserName CHAR(255) NOT NULL,
	Upic Char(255),
	PRIMARY KEY(id, UuserName)
);

CREATE TABLE Events(
	Eid	INT	AUTO_INCREMENT,
	UuserName CHAR(255) NOT NULL,
	Evename VARCHAR(26) NOT NULL,
	EstartDate VARCHAR(20) NOT NULL,
	EendDate VARCHAR(20) NOT NULL,
	Eaddress VARCHAR(255) NOT NULL,
	Ecity VARCHAR(50) NOT NULL,
	Estate CHAR(10) NOT NULL,
	Ezip INT(5) NOT NULL,
	EphoneNumber INT(10),
	Edescription VARCHAR(26) NOT NULL,
	Etype VARCHAR(26) NOT NULL,
	Ewebsite VARCHAR(26) NOT NULL,
	Ehashtag CHAR(255),
	Efacebook CHAR(255),
	Etwitter CHAR(255),
	Egoogle CHAR(255),
	Eflyer CHAR(255),
	Eother CHAR(255),
	EtimeStart CHAR(255),
	EtimeEnd CHAR(255),
	Elat DECIMAL(10,6),
	Elong DECIMAL(10,6),
	Erank CHAR(255),
	PRIMARY KEY(Eid, UuserName)
);



USERNAME:admindev
PASSWORD:17s_9Eyr