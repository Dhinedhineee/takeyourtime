-- Entities
CREATE TABLE User(
	user_ID 		INT(5) AUTO_INCREMENT,
	user_name		VARCHAR(20),
	rank			VARCHAR(10) DEFAULT NULL,
	primary key(user_ID)
);

CREATE TABLE Labels(
	label_ID		INT(5) AUTO_INCREMENT,
	label_name		VARCHAR(20),
	date_created	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	time_spent		TEXT DEFAULT NULL,
	primary key(label_ID)
);

CREATE TABLE Achievements(
	ach_ID			INT(5) AUTO_INCREMENT,
	ach_name		VARCHAR(20),
	exp_value		INT(5) DEFAULT 0,
	description		VARCHAR(500) DEFAULT NULL,
	primary key(ach_ID)
);

CREATE TABLE Tasks(
	task_ID			INT(5) AUTO_INCREMENT,
	task_name		VARCHAR(20),
	status			VARCHAR(10) DEFAULT NULL,
	priority		VARCHAR(10) DEFAULT NULL,
	start_date		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	due_date		TIMESTAMP,
	time_spent 		TEXT DEFAULT NULL,
	time_needed		TEXT DEFAULT NULL,
	primary key(task_ID)
);

CREATE TABLE Timer(
	timer_ID		INT(5) AUTO_INCREMENT,
	time_start		TIMESTAMP,
	time_end		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	duration		TEXT,
	primary key(timer_ID)
);

-- Relationships
CREATE TABLE done(
	task_ID			INT(5),
	timer_ID		INT(5),
	foreign key (task_ID) references Tasks(task_ID),
	foreign key (timer_ID) references Timer(timer_ID)
);

CREATE TABLE achieved(
	user_ID			INT(5),
	ach_ID			INT(5),
	date_achieved	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	foreign key (user_ID) references User(user_ID),
	foreign key (ach_ID) references Achievements(ach_ID)
);

CREATE TABLE groups(
	user_ID			INT(5),
	label_ID		INT(5),
	foreign key (user_ID) references User(user_ID),
	foreign key (label_ID) references Labels(labels_ID)
);

CREATE TABLE breakdown(
	task_ID1		INT(5),
	task_ID2		INT(5),
	foreign key (task_ID1) references Tasks(task_ID),
	foreign key (task_ID2) references Tasks(task_ID)
);

CREATE TABLE tag(
	label_ID		INT(5),
	task_ID			INT(5),
	foreign key (label_ID) references Label(label_ID),
	foreign key (task_ID) references Task(task_ID)
);

CREATE TABLE todo(
	user_ID			INT(5),
	task_ID 		INT(5),
	foreign key (user_ID) references User(user_ID),
	foreign key (task_ID) references Task(task_ID)
)