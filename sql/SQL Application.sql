# Insert
INSERT INTO Users (password, name, age, location, email, phone)
	VALUES ('password', 'name', 0, 'location', 'email', 'phone')

INSERT INTO Appointment (counsellorID, helpSeekerID, meetingPlatform,
							date, startTime, endTime)
	VALUES (0, 0, 'meetingPlatform', 'date', 'startTime', 'endTime')

INSERT INTO Counsellor (userID, yearsExperience, certification)
	VALUES (0, 0, 'certification')

INSERT INTO HelpSeeker (userID, numCounsellors, numReviews)
	VALUES (0, 0, 0)

# Delete
DELETE FROM Users WHERE userID = $_SESSION['userID'];

# Update
UPDATE Users 
SET email = '$email',
	password = '$password',
	name = '$name',
	age = '$age',
	phone = '$phone'
WHERE userID = $_SESSION["userID"];

UPDATE Counsellor
SET yearsExperience = '$experience',
	certification = '$certification'
WHERE userID =.$_SESSION["userID"];

# Selection
SELECT name, age, location, email, phone 
FROM Users 
WHERE userID = $searchID;

SELECT name, age, location, email, phone 
FROM Users 
WHERE userID = $_SESSION["userID"];

SELECT yearsExperience, certification
FROM Counsellor
WHERE userID = $_SESSION["userID"];

SELECT COUNT(DISTINCT A.helpSeekerID) AS numOfPatients
FROM Appointment A
GROUP BY A.counsellorID
HAVING A.counsellorID = 0

# Projection
SELECT userID, name, age, location, email, phone FROM Users;
SELECT name, phoneNum, typeOfHelp FROM Hotline;

# Join
SELECT name, date, startTime, endTime, meetingPlatform
FROM Users U, Appointment A
WHERE U.userID = A.counsellorID AND 
	  A.helpSeekerID = $_SESSION["userID"];

SELECT name, date, startTime, endTime, meetingPlatform
FROM Users U, Appointment A
WHERE U.userID = A.helpSeekerID AND 
	  A.counsellorID = $_SESSION["userID"];

SELECT U1.name AS author, U2.name AS receiver, rating, feedback
FROM Users U1, Users U2, Review R
WHERE U1.userID = R.reviewAuthor AND
	  U2.userID = R.counsellor;

SELECT name, rating, feedback
FROM Users U, Review R
WHERE U.userID = R.counsellor AND
	  R.reviewAuthor = $_SESSION["userID"];

SELECT name, rating, feedback
FROM Users U, Review R
WHERE U.userID = R.reviewAuthor AND
	  R.counsellor = $_SESSION["userID"];

SELECT level
FROM Counsellor C, Counselloryearsexperience CY
WHERE C.yearsExperience = CY.yearsExperience AND 
	  C.userID = $_SESSION["userID"];

SELECT RC.centreName, RC.address, RC.email, RC.phoneNum
FROM ResourceCentre RC, FavouriteCentre FC
WHERE RC.centreID = FC.centreID AND 
	  FC.helpSeekerID = $_SESSION["userID"];

SELECT RC.centreName, RC.address, RC.email, RC.phoneNum
FROM ResourceCentre RC, RecommendedCentre REC
WHERE RC.centreID = REC.centreID AND 
	  REC.counsellorID = $_SESSION["userID"];

SELECT HL.name, HL.phoneNum, HL.typeOfHelp
FROM Hotline HL, FavouriteHotline FH
WHERE HL.phoneNum = FH.hotlineNum AND
	  FH.helpSeekerID = $_SESSION["userID"];

SELECT HL.name, HL.phoneNum, HL.typeOfHelp
FROM Hotline HL, RecommendedHotline RH
WHERE HL.phoneNum = RH.hotlineNum AND
	  RH.counsellorID = $_SESSION["userID"];

# Aggregation with Group By
SELECT U.name, AVG(R.rating) AS avgRating
FROM Review R, Users U
WHERE U.userID = R.counsellor
GROUP BY U.name;

# Aggregation with Having
SELECT AVG(R.rating)
FROM review R
GROUP BY R.counsellor
HAVING R.counsellor = $_SESSION["userID"];

SELECT COUNT(DISTINCT A.helpSeekerID) AS numOfPatients
FROM Appointment A
GROUP BY A.counsellorID
HAVING A.counsellorID = $_SESSION["userID"];

# Nested Aggregation with Group By
SELECT U.name, AVG(rating)
FROM Review R, Users U
WHERE R.counsellor = U.userID
GROUP BY U.name
HAVING AVG(rating) >= ALL (SELECT AVG(rating)
			   			   FROM Review R2
			   			   GROUP BY R2.counsellor);

# Division 
SELECT name
FROM Users U, Helpseeker H
WHERE U.userID = H.userID AND
	NOT EXISTS (
		(SELECT C.userID
		 FROM Counsellor C)
		EXCEPT
		(SELECT C.userID
		 FROM Counsellor C, Appointment A 
		 WHERE C.userID = A.counsellorID AND
		 	   H.userID = A.helpSeekerID)
	);

SELECT name
FROM Users U, Counsellor C
WHERE U.userID = C.userID AND
	NOT EXISTS (
		(SELECT H.userID
		 FROM HelpSeeker H)
		EXCEPT
		(SELECT H.userID
		 FROM Helpseeker H, Appointment A 
		 WHERE C.userID = A.counsellorID AND
		 	   H.userID = A.helpSeekerID)
	);
