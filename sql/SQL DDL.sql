CREATE TABLE Users (
	userID		int			 	PRIMARY KEY AUTO_INCREMENT,
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
	level			varchar(100)            NOT NULL
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
	appointmentID	int			 PRIMARY KEY AUTO_INCREMENT,
    counsellorID	int				NOT NULL,
	helpSeekerID	int				NOT NULL,
	meetingPlatform varchar(50),
	date			date,
	startTime		time,
	endTime			time,
	FOREIGN KEY (counsellorID) REFERENCES Counsellor(userID) ON DELETE CASCADE,
	FOREIGN KEY (helpSeekerID) REFERENCES HelpSeeker(userID) ON DELETE CASCADE
);
	
CREATE TABLE Review (
	reviewID		int			PRIMARY KEY AUTO_INCREMENT,
	reviewAuthor	int			NOT NULL,
	counsellor 		int			NOT NULL,
	rating			int,
	feedback		varchar(10000),
	FOREIGN KEY (reviewAuthor) REFERENCES HelpSeeker(userID),
	FOREIGN KEY (counsellor) REFERENCES Counsellor(userID) ON DELETE CASCADE
);

CREATE TABLE TypesOfHelp (
	helpType		varchar(50)	PRIMARY KEY,
	description		varchar(10000)
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
CREATE TABLE Hotline (
	phoneNum		char(12)        PRIMARY KEY,
	typeOfHelp		varchar(50)     DEFAULT "General",
	name			varchar(100),
	FOREIGN KEY (typeOfHelp) REFERENCES TypesOfHelp(helpType) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE PostalCode (
  postalCode		char(8) 		   PRIMARY KEY,
  city			varchar(50)
);

CREATE TABLE ResourceCentre (
	centreID		int			   PRIMARY KEY AUTO_INCREMENT,
	centreName		varchar(125),
  	address 		varchar(50)           NOT NULL,
  	email			varchar(80)	   UNIQUE NOT NULL,
  	postalCode		char(80)              NOT NULL,
  	phoneNum		char(12)              NOT NULL,
  	FOREIGN KEY (postalCode) REFERENCES postalCode(postalCode) ON DELETE CASCADE 
);

CREATE TABLE FavouriteCentre (
	helpSeekerID	int		NOT NULL,
	centreID		int		NOT NULL,
	PRIMARY KEY (helpSeekerID, centreID),
	FOREIGN KEY (helpSeekerID) REFERENCES HelpSeeker(userID) ON DELETE CASCADE,
	FOREIGN KEY (centreID) REFERENCES ResourceCentre(centreID) ON DELETE CASCADE
);

CREATE TABLE FavouriteHotline (
	helpSeekerID	int			NOT NULL,
	hotlineNum		char(12)   	NOT NULL,
	PRIMARY KEY (helpSeekerID, hotlineNum),
	FOREIGN KEY (helpSeekerID) REFERENCES HelpSeeker(userID) ON DELETE CASCADE,
	FOREIGN KEY (hotlineNum) REFERENCES Hotline(phoneNum) ON DELETE CASCADE
);

CREATE TABLE RecommendedCentre (
	counsellorID	int		NOT NULL,
	centreID		int		NOT NULL,
	PRIMARY KEY (counsellorID, centreID),
	FOREIGN KEY (counsellorID) REFERENCES Counsellor(userID) ON DELETE CASCADE,
	FOREIGN KEY (centreID) REFERENCES ResourceCentre(centreID) ON DELETE CASCADE
);

CREATE TABLE RecommendedHotline (
	counsellorID	int			NOT NULL,
	hotlineNum		char(12)	NOT NULL,
	PRIMARY KEY (counsellorID, hotlineNum),
	FOREIGN KEY (counsellorID) REFERENCES Counsellor(userID) ON DELETE CASCADE,
	FOREIGN KEY (hotlineNum) REFERENCES Hotline(phoneNum) ON DELETE CASCADE
);

CREATE TABLE BlogPost (
	postID			int             PRIMARY KEY AUTO_INCREMENT,
	postAuthor		int             NOT NULL,
	date			date            NOT NULL,
	content			varchar(10000) 	NOT NULL,
	likes			int,
	FOREIGN KEY (postAuthor) REFERENCES Users(userID) ON DELETE
      CASCADE
);

CREATE TABLE Belongs (
	commentID        int AUTO_INCREMENT,
	postID           int,
	content          varchar(256)    NOT NULL,
	PRIMARY KEY (commentID, postID),
	FOREIGN KEY (postID) REFERENCES BlogPost(postID) ON DELETE
      CASCADE
);
