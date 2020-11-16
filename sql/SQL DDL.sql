CREATE TABLE Users (
	userID		int			 PRIMARY KEY AUTO_INCREMENT,
	password	varchar(50) 	NOT NULL,
	name		varchar(100) 	NOT NULL,
	age			int,
	location	varchar(125),
	email		varchar(80) 	UNIQUE NOT NULL,
	phone		char(12)
);

CREATE TABLE HelpSeeker (
	userID			int			PRIMARY KEY,
	numCounsellors	int,
	numReviews		int,
	FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE
);

CREATE TABLE CounsellorYearsExperience (
	yearsExperience	int 		    		PRIMARY KEY,
	level			varchar(100)             NOT NULL
);

CREATE TABLE Counsellor (
	userID				int		     PRIMARY KEY,
	yearsExperience		int,
	certification		varchar(500)    NOT NULL,
	numPatients			int,			
	FOREIGN KEY (userID) REFERENCES Users(userID) ON DELETE CASCADE,
	FOREIGN KEY (yearsExperience) REFERENCES CounsellorYearsExperience(yearsExperience) ON DELETE CASCADE
);

CREATE TABLE Appointment (
	appointmentID	int			 PRIMARY KEY,
	counsellorID	int				NOT NULL,
	helpSeekerID	int				NOT NULL,
	meetingPlatform varchar(50)		NOT NULL,
	date			date			NOT NULL,
	startTime		time 			NOT NULL,
	endTime			time 			NOT NULL,
	FOREIGN KEY (counsellorID) REFERENCES Counsellor(userID) ON DELETE CASCADE,
	FOREIGN KEY (helpSeekerID) REFERENCES HelpSeeker(userID) ON DELETE CASCADE
);

CREATE TABLE Review (
	reviewID		int			PRIMARY KEY,
	reviewAuthor	int			NOT NULL,
	counsellor 		int			NOT NULL,
	rating			int			NOT NULL,
	feedback		varchar(100000),
	FOREIGN KEY (reviewAuthor) REFERENCES HelpSeeker(userID),
	FOREIGN KEY (counsellor) REFERENCES Counsellor(userID) ON DELETE CASCADE
);

CREATE TABLE Hotline (
	phoneNum		char(12)        PRIMARY KEY,
	typeOfHelp		varchar(50)     DEFAULT "General",
	name			varchar(100)    NOT NULL,
	FOREIGN KEY (typeOfHelp) REFERENCES TypesOfHelp(helpType) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE TypesOfHelp (
	helpType		varchar(50)	PRIMARY KEY,
	description		varchar(100000)
);

CREATE TABLE PostalCode (
postalCode		char(8) 		   PRIMARY KEY,
city			varchar(50)        NOT NULL
);

CREATE TABLE ResourceCentre (
	centreID		int				PRIMARY KEY AUTO_INCREMENT,
	centreName		varchar(125)          NOT NULL,
address 		varchar(50)           NOT NULL,
email			varchar(80)		UNIQUE NOT NULL,
postalCode		char(80)              NOT NULL,
phoneNum		char(12)              NOT NULL,
FOREIGN KEY (postalCode) REFERENCES postalCode(postalCode) ON DELETE CASCADE 
);