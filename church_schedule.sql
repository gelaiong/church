CREATE DATABASE church_schedule;
USE church_schedule;

CREATE TABLE `church`(
	church_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	church_name varchar(100) UNIQUE NOT NULL,
	church_address varchar(100) NOT NULL,
	church_info text,
	church_status enum('active','inactive') DEFAULT 'active'
);


CREATE TABLE account(
    account_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    account_username varchar(50) UNIQUE NOT NULL,
    account_password char(16) NOT NULL,
    account_type enum('admin','superadmin') DEFAULT 'admin',
    account_status enum('active','inactive') DEFAULT 'active'
);

CREATE TABLE admin(
	admin_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	admin_name varchar(50) NOT NULL,
	admin_contact char(11) NOT NULL,
	admin_account_id int(11) UNIQUE NOT NULL,
	admin_church_id int(11) UNIQUE NOT NULL,

	CONSTRAINT admin_fk1 FOREIGN KEY (admin_account_id) REFERENCES `account` (account_id),
    CONSTRAINT admin_fk2 FOREIGN KEY (admin_church_id) REFERENCES `church` (church_id)

);


CREATE TABLE `schedule`(
	schedule_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	schedule_starttime char(8) NOT NULL,
	schedule_endtime char(8),
	schedule_specific_sched char(30),
	schedule_day char(9) NOT NULL,
	schedule_week char(6),
	schedule_event enum ('Confession','Baptism','Wedding','Pre-Cana','Pre-Jordan','Mass') DEFAULT 'Mass',
	schedule_church_id int(11) NOT NULL,
	schedule_status enum('active','inactive') DEFAULT 'active',

	CONSTRAINT schedule_fk FOREIGN KEY (schedule_church_id) REFERENCES `church` (church_id)
);

INSERT INTO `account`(`account_id`, `account_username`, `account_password`,`account_type`, `account_status`) VALUES (1,"superadmin","superadmin",'superadmin','active');