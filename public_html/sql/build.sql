DROP TABLE USERS_UNIVERSITIES;
DROP TABLE UNIVERSITIES;
DROP TABLE USERS_PUBLICATIONS;
DROP TABLE PUBLICATIONS;
DROP TABLE USERS_SKILLS;
DROP TABLE SKILLS;
DROP TABLE USERS_INTERESTS;
DROP TABLE INTERESTS;
DROP TABLE USERS_EMPLOYERS;
DROP TABLE EMPLOYERS;
DROP TABLE USERS;
DROP TABLE DEPARTMENTS;

CREATE TABLE DEPARTMENTS
(
	DEP_ID			INT				NOT NULL		AUTO_INCREMENT,
	NAME			VARCHAR(255)	NOT NULL,
	PRIMARY KEY (DEP_ID)
);

CREATE TABLE USERS
(
	USER_ID			INT				NOT NULL		AUTO_INCREMENT,
	USERNAME		VARCHAR(255)	NOT NULL,
	EMAIL			VARCHAR(320)	NOT NULL,
	PASSWORD		VARCHAR(64)		NOT NULL,
	SALT			VARCHAR(255)	NOT NULL,
	FNAME			VARCHAR(255)	NOT NULL,
	LNAME			VARCHAR(255)	NOT NULL,
	TITLE			VARCHAR(10),
	HOMETOWN		VARCHAR(255),
	PHONE_NUM		VARCHAR(12),
	BIO				VARCHAR(5000),
	PROFILE			VARCHAR(255),
	RESUME			VARCHAR(320),
	CREATE_TIME		DATETIME		NOT NULL,
	DEP_ID			INT				NOT NULL,
	PRIMARY KEY (USER_ID),
	FOREIGN KEY (DEP_ID) REFERENCES DEPARTMENTS(DEP_ID)
);

CREATE TABLE EMPLOYERS
(
	EMP_ID			INT				NOT NULL		AUTO_INCREMENT,
	NAME			VARCHAR(255)	NOT NULL,
	PRIMARY KEY (EMP_ID)
);

CREATE TABLE USERS_EMPLOYERS
(
	USER_ID			INT				NOT NULL,
	EMP_ID			INT				NOT NULL,
	TITLE			VARCHAR(255)	NOT NULL,
	ST_DATE			VARCHAR(255)	NOT NULL,
	END_DATE		VARCHAR(255)	NOT NULL,
	PRIMARY KEY (USER_ID, EMP_ID),
	FOREIGN KEY (USER_ID) REFERENCES USERS(USER_ID),
	FOREIGN KEY (EMP_ID) REFERENCES EMPLOYERS(EMP_ID)
);

CREATE TABLE INTERESTS
(
	INT_ID			INT				NOT NULL		AUTO_INCREMENT,
	NAME			VARCHAR(255)	NOT NULL,
	DESCRIPTION		VARCHAR(5000),
	PRIMARY KEY (INT_ID)
);

CREATE TABLE USERS_INTERESTS
(
	USER_ID			INT				NOT NULL,
	INT_ID			INT				NOT NULL,
	PRIMARY KEY (USER_ID, INT_ID),
	FOREIGN KEY (USER_ID) REFERENCES USERS(USER_ID),
	FOREIGN KEY (INT_ID) REFERENCES INTERESTS(INT_ID)
);

CREATE TABLE SKILLS
(
	SKILL_ID		INT				NOT NULL		AUTO_INCREMENT,
	NAME			VARCHAR(255)	NOT NULL,
	DESCRIPTION		VARCHAR(5000),
	PRIMARY KEY (SKILL_ID)
);

CREATE TABLE USERS_SKILLS
(
	USER_ID			INT				NOT NULL,
	SKILL_ID		INT				NOT NULL,
	PRIMARY KEY (USER_ID, SKILL_ID),
	FOREIGN KEY (USER_ID) REFERENCES USERS(USER_ID),
	FOREIGN KEY (SKILL_ID) REFERENCES SKILLS(SKILL_ID)
);

CREATE TABLE PUBLICATIONS
(
	PUB_ID			INT				NOT NULL		AUTO_INCREMENT,
	NAME			VARCHAR(255)	NOT NULL,
	PUB_DATE		VARCHAR(255)	NOT NULL,
	PRIMARY KEY (PUB_ID)
);

CREATE TABLE USERS_PUBLICATIONS
(
	USER_ID			INT				NOT NULL,
	PUB_ID			INT				NOT NULL,
	PRIMARY KEY (USER_ID, PUB_ID),
	FOREIGN KEY (USER_ID) REFERENCES USERS(USER_ID),
	FOREIGN KEY (PUB_ID) REFERENCES PUBLICATIONS(PUB_ID)
);

CREATE TABLE UNIVERSITIES
(
	UNIV_ID			INT				NOT NULL		AUTO_INCREMENT,
	NAME			VARCHAR(255)	NOT NULL,
	PRIMARY KEY(UNIV_ID)
);

CREATE TABLE USERS_UNIVERSITIES
(
	USER_ID			INT				NOT NULL,
	UNIV_ID			INT				NOT NULL,
	PRIMARY KEY (USER_ID, UNIV_ID),
	FOREIGN KEY (USER_ID) REFERENCES USERS(USER_ID),
	FOREIGN KEY (UNIV_ID) REFERENCES UNIVERSITIES(UNIV_ID)
);

-- LOAD DEPARTMENTS
INSERT INTO DEPARTMENTS (NAME) VALUES ('College of Applied Science and Technology');
INSERT INTO DEPARTMENTS (NAME) VALUES ('College of Business');
INSERT INTO DEPARTMENTS (NAME) VALUES ('College of Communication, Languages, Arts, and Social Sciences');
INSERT INTO DEPARTMENTS (NAME) VALUES ('College of Graduate Studies');
INSERT INTO DEPARTMENTS (NAME) VALUES ('College of Health Sciences');
INSERT INTO DEPARTMENTS (NAME) VALUES ('College of Science, Technology, Engineering and Mathematics');
INSERT INTO DEPARTMENTS (NAME) VALUES ('School of Education');

-- LOAD EMPLOYERS
INSERT INTO EMPLOYERS (NAME) VALUES ('Wal-Mart');
INSERT INTO EMPLOYERS (NAME) VALUES ('Apple');
INSERT INTO EMPLOYERS (NAME) VALUES ('Google');
INSERT INTO EMPLOYERS (NAME) VALUES ('J.B. Hunt');

-- LOAD UNIVERSITIES
INSERT INTO UNIVERSITIES (NAME) VALUES ('University of Arkansas');
INSERT INTO UNIVERSITIES (NAME) VALUES ('University of Arkansas at Fort Smith');
INSERT INTO UNIVERSITIES (NAME) VALUES ('University of Oklahoma');

-- LOAD TEST USERS
INSERT INTO USERS (USERNAME, EMAIL, PASSWORD, SALT, FNAME, LNAME, TITLE, HOMETOWN, PHONE_NUM, BIO, PROFILE, CREATE_TIME, DEP_ID) VALUES ('cwestbrook', 'christianwestbrook@live.com', 'abc123', 'def456', 'Christian', 'Westbrook', 'Mr.', 'Van Buren', '123-456-7890', 'I like to read horror novels and take long walks at the beach.', './img/users/cwestbrook.jpg', NOW(), 6);

INSERT INTO USERS_UNIVERSITIES (USER_ID, UNIV_ID) VALUES (1, 2);
INSERT INTO USERS_UNIVERSITIES (USER_ID, UNIV_ID) VALUES (1, 1);

INSERT INTO USERS_EMPLOYERS (USER_ID, EMP_ID) VALUES (1, 2);
INSERT INTO USERS_EMPLOYERS (USER_ID, EMP_ID) VALUES (1, 3);
INSERT INTO USERS_EMPLOYERS (USER_ID, EMP_ID) VALUES (1, 4);