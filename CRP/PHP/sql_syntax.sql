CREATE TABLE admin_user
(
	username VARCHAR(20) PRIMARY KEY REFERENCES user(username)
)
CREATE TABLE user
(
	username VARCHAR(20) PRIMARY KEY,
	password VARCHAR(100) NOT NULL,
	pro_pic VARCHAR(100)
)

CREATE TABLE student_user
(
	username VARCHAR(20) PRIMARY KEY REFERENCES user(username),
	fullname VARCHAR(30) NOT NULL,
	nickname VARCHAR(20),
	father VARCHAR(30) NOT NULL,
	dob VARCHAR(20) NOT NULL,
	gender VARCHAR(10) NOT NULL,
	email VARCHAR(30) NOT NULL,
	ph_no BIGINT(15) NOT NULL,
	area VARCHAR(30) NOT NULL,
	city VARCHAR(30) NOT NULL,
	state VARCHAR(30) NOT NULL,
	country VARCHAR(30) NOT NULL,
	pin INT(10) NOT NULL

)
CREATE TABLE company_user
(
	username VARCHAR(20) PRIMARY KEY REFERENCES user(username),
	fullname VARCHAR(30) NOT NULL,
	estd VARCHAR(20) NOT NULL,
	email VARCHAR(30) NOT NULL,
	ph_no BIGINT(15) NOT NULL,
	url VARCHAR(30) NOT NULL,
	area VARCHAR(30) NOT NULL,
	city VARCHAR(30) NOT NULL,
	state VARCHAR(30) NOT NULL,
	country VARCHAR(30) NOT NULL,
	pin INT(10) NOT NULL

)

CREATE TABLE education_table
(
	college VARCHAR(50),
	reg_no VARCHAR(20),
	branch VARCHAR(30) NOT NULL,
	session VARCHAR(20) NOT NULL,
	HSC VARCHAR(10) NOT NULL,
	ISC VARCHAR(10) NOT NULL,
	CGPA VARCHAR(10) NOT NULL,
	skills VARCHAR(100) NOT NULL,
	CV VARCHAR(100) NOT NULL,
	PRIMARY KEy(college,reg_no)
)

CREATE TABLE student_education
(
	username VARCHAR(20) PRIMARY KEY REFERENCES student_user(username),
	college VARCHAR(50) REFERENCES education_table(college),
	reg_no VARCHAR(20) REFERENCES education_table(reg_no)
)

CREATE TABLE jobs
(
	j_id BIGINT(20) AUTO_INCREMENT PRIMARY KEY ,
	j_type VARCHAR(50) NOT NULL,
	req_skills VARCHAR(50) NOT NULL,
	qualifications VARCHAR(50) NOT NULL,
	sal_pr_annum BIGINT(15) NOT NUlL,
	j_desc VARCHAR(100) NOT NULL,
	LDTA VARCHAR(30) NOT NULL,
	hr_name VARCHAR(30) NOT NUll,
	hr_phone BIGINT(15) NOT NULL,
	username VARCHAR(20) REFERENCES company_user(username),
	posted_on DATETIME NOT NULL	DEFAULT NOW()
)

CREATE TABLE applied
(
	username VARCHAR(20) REFERENCES student_user(username),
	j_id BIGINT(20) REFERENCES jobs(j_id),
	applied_on DATETIME NOT NULL DEFAULT NOW(),
	selected INT(5),
	PRIMARY KEY(username,j_id)
)


