INSERT INTO 
	Users (password, name, age, location, email, phone)
VALUES 
	('klajsdj', 'Dr. Hans B', 50, 'Canada', 'hans@gmail.com', '7802341234'),
	('oqwieuiu11', 'Jamie P', 54, 'Canada', 'jamiep@mail.com', '1129028874'),
	('Asdsio00d', 'Tyler C', 45, 'Canada', 'tyler@yahoo.com', '5564782346'),
	('Poioifeqh10', 'Qing W', 58, 'Canada', 'qing@gmail.com', '8990297563'),
	('ilovepizza', 'Miranda K', 33, 'Canada', 'miranda@gmail.com', '9926374837'),
	('klajOOOpsadj', 'Andy P', 45, 'Canada', 'andyp0103@gmail.com', '9901231928'),
	('091ABC39', 'Piper L', 20, 'Canada', 'pip@gmail.com', NULL),
	('ABCDe12', 'Katrina L', 31, 'Canada', 'cat001123@gmail.com', NULL),
	('lalllaooiqwe', 'Daniel D', 16, 'Canada', 'dan@gmail.com', NULL),
	('laksdjkljf01', 'Jamie L', 18, 'Canada', 'jamiel@gmail.com', NULL),
	('abc123de', 'Alex B', 29, 'Canada', 'alexb66@gmail.com','1992223893'),
	('lJ8ijerkjk', 'Shannon A', 19, 'Canada', 'shan@gmail.com','7770939999'),
	('009asdop', 'Layla L', 78, 'Canada', 'layla0011@gmail.com', '7789928391'),
	('jkasdhashd', 'Bella L', 20, 'Canada', 'bellalol@gmail.com', NULL),
	('ilovefun00', 'Kayla C', NULL, 'Canada', 'kay@gmail.com', NULL);
	
INSERT INTO
	HelpSeeker(userID, numCounsellors, numReviews)
VALUES
	(7,1,2),
	(9,1,1),
	(11,1,1),
	(12,1,0),
	(8,0,0),
	(15,1,1),
	(10,1,0),
	(13,0,0),
	(14,1,0);

INSERT INTO
	CounsellorYearsExperience(yearsExperience, level)
VALUES
	(5, 'beginner'),
	(10, 'bronze'),
	(15, 'silver'),
	(20, 'gold'),
	(25, 'platinum');

INSERT INTO
	Counsellor(userID, yearsExperience, certification, numPatients)
VALUES
	(1, 10, 'certified',1),
	(2, 15, 'certified',2),
	(3, 10, 'certified',0),
	(4, 25, 'certified',2),
	(5, 5, 'in progress', 0),
	(6, 10, 'certified', 0);

INSERT INTO
	Appointment (appointmentID, counsellorID, helpSeekerID, meetingPlatform, date, startTime, endTime)
VALUES
	(1, 1, 7, 'Zoom', '2020-01-10', '11:00', '11:30'),
	(2, 2, 9, 'Zoom', '2020-10-29', '15:30', '16:00'),
	(3, 2, 11, 'Zoom', '2020-11-06', '10:00', '11:00'),
	(4, 4, 12, 'Zoom', '2020-11-21', '10:15', '11:00'),
	(5, 4, 15, 'Hangouts', '2020-12-01', '12:00', '12:45');

INSERT INTO
	Review (reviewID, reviewAuthor, counsellor, rating, feedback)
VALUES
	(1, 7, 1, 4, 'Great counsellor'),
	(2, 9, 2, 3, "Was good but didn't have many open slots"),
	(3, 11, 2, 4, NULL),
	(4, 12, 4, 3, NULL),
	(5, 15, 4, 5, "nice!");

INSERT INTO
	TypesOfHelp (helpType, description)
VALUES
	('General', 'General help for any concerns that one might have'),
	('Suicide', 'Help for those contemplating suicide'),
	('Addiction', 'Support for those struggling with addiction'),
	('Medical', 'Medical support for those with mental illness'),
	('Anxiety/Depression', 'General help for those struggling with anxiety/depression');

INSERT INTO
	Hotline (phoneNum, typeOfHelp, name)
VALUES
	('7789900098', 'General', 'General Hotline'),
	('7786675362', 'Addiction', 'Addiction Hotline'),
	('7780938825', 'Suicide', 'Canada Suicide Prevention'),
	('0984378897', 'General', 'OT General'),
	('5637829283', 'Suicide', 'Suicide Hotline');


INSERT INTO
	PostalCode (postalCode, city)
VALUES
	('V6R2H1', 'Vancouver'),
	('V7H0K1', 'Vancouver'),
	('V9P0J1', 'Vancouver'),
	('M4B1K1', 'Toronto'),
	('T8M0L1', 'Edmonton');


INSERT INTO
	ResourceCentre (centreID,centreName,address,email,postalCode,phoneNum)
VALUES
	('Helping Hands', '1234 Albert Dr', 'hhands@gmail.com', 'V6R2H1', '7789987836'),
	('Addiction Centre', '45 Garneau St', 'centreaddiction@gmail.com', 'V7H0K1','7786673847'),
	('Vancouver General', '9012 Vic St', 'vgeneralhos@gmail.com', 'V9P0J1', '7788893748'),
	('ON Medical', '1 Queens Way', 'onmedical@gmail.com', 'M4B1K1', '6457239182'),
	('Support Centre', '67 Whyte Ave', 'supportcentrewhyte@gmail.com', 'T8M0L1', '7800998372');



