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
	(12,2,0),
	(8,1,0),
	(15,2,1),
	(10,2,0),
	(13,1,0),
	(14,2,0);

INSERT INTO
	CounsellorYearsExperience(yearsExperience, level)
VALUES
	(5, 'beginner'),
	(10, 'bronze'),
	(15, 'silver'),
	(20, 'gold'),
	(25, 'platinum');

INSERT INTO
	Counsellor(userID, yearsExperience, certification)
VALUES
	(1, 10, 'certified'),
	(2, 15, 'certified'),
	(3, 10, 'certified'),
	(4, 25, 'certified'),
	(5, 5, 'in progress'),
	(6, 10, 'certified');

INSERT INTO
	Appointment (counsellorID, helpSeekerID, meetingPlatform, date, startTime, endTime)
VALUES
	(1, 7, 'Zoom', '2020-01-10', '11:00', '11:30'),
	(2, 9, 'Zoom', '2020-10-29', '15:30', '16:00'),
	(2, 11, 'Zoom', '2020-11-06', '10:00', '11:00'),
	(4, 12, 'Zoom', '2020-11-21', '10:15', '11:00'),
	(4, 15, 'Hangouts', '2020-12-01', '12:00', '12:45'),
	(2, 7, 'Skype', '2020-12-15', '11:15', '12:00'),
	(3, 7, 'Skype', '2020-12-16', '11:15', '12:00'),
	(4, 7, 'Skype', '2020-12-17', '11:15', '12:00'),
	(5, 7, 'Skype', '2020-12-18', '11:15', '12:00'),
	(6, 7, 'Skype', '2020-12-19', '11:15', '12:00'),
	(2, 12, 'Hangouts', '2020-12-20', '13:15', '14:00'),
	(2, 8, 'Hangouts', '2020-12-21', '13:15', '14:00'),
	(2, 15, 'Hangouts', '2020-12-22', '13:15', '14:00'),
	(2, 10, 'Hangouts', '2020-12-23', '13:15', '14:00'),
	(2, 13, 'Hangouts', '2020-12-24', '13:15', '14:00'),
	(2, 14, 'Hangouts', '2020-12-25', '13:15', '14:00');

INSERT INTO
	Review (reviewAuthor, counsellor, rating, feedback)
VALUES
	(7, 1, 4, 'Great counsellor'),
	(9, 2, 3, "Was good but didn't have many open slots"),
	(11, 2, 4, NULL),
	(12, 4, 3, NULL),
	(15, 4, 5, "nice!"),
	(10, 1, 5, "Amazing help");

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
	ResourceCentre (centreName,address,email,postalCode,phoneNum)
VALUES
	('Helping Hands', '1234 Albert Dr', 'hhands@gmail.com', 'V6R2H1', '7789987836'),
	('Addiction Centre', '45 Garneau St', 'centreaddiction@gmail.com', 'V7H0K1','7786673847'),
	('Vancouver General', '9012 Vic St', 'vgeneralhos@gmail.com', 'V9P0J1', '7788893748'),
	('ON Medical', '1 Queens Way', 'onmedical@gmail.com', 'M4B1K1', '6457239182'),
	('Support Centre', '67 Whyte Ave', 'supportcentrewhyte@gmail.com', 'T8M0L1', '7800998372');

INSERT INTO
	FavouriteCentre (helpSeekerID, centreID)
VALUES
	(7,1),
	(9,2),
	(11,3),
	(12,4),
	(15,5);

INSERT INTO
	FavouriteHotline (helpSeekerID, hotlineNum)
VALUES
	(7,'7789900098'),
	(9,'7789900098'),
	(11,'7786675362'),
	(12,'5637829283'),
	(15,'0984378897');

INSERT INTO
	RecommendedCentre (counsellorID, centreID)
VALUES
	(1,1),
	(2,2),
	(2,3),
	(4,4),
	(4,5);

INSERT INTO
	RecommendedHotline (counsellorID, hotlineNum)
VALUES
	(1,'7780938825'),
	(1,'7789900098'),
	(3,'7789900098'),
	(3,'7786675362'),
	(5,'0984378897');

INSERT INTO 
	BlogPost (postAuthor, date, content, likes)
VALUES
	(12, '2019-01-20', 'Thanks everyone for following my blog! Really appreciate all the support on this website.', 100),
	(11, '2020-01-01', 'Happy new year! :)', 90),
	(15, '2020-09-05', 'Hope everyone is staying safe and doing well!', 87),
	(9, '2018-07-10', 'First post on here!', 1),
	(7, '2020-05-19', 'not feeling too great these days :( but i’m glad i have this community', 671);

INSERT INTO 
	Belongs (postID, content)
VALUES
	(2, 'That’s great!'),
	(4, 'thanks'),
	(3, 'Glad you’re feeling better'),
	(5, ':)'),
	(1, 'good advice!')