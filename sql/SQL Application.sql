# Projection
SELECT userID, name, age, location, email, phone FROM Users;
SELECT name, phoneNum, typeOfHelp FROM Hotline;

# Selection
SELECT yearsExperience, certification, numPatients
FROM counsellor
WHERE userID = $_SESSION["userID"];

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

# Delete
DELETE FROM Users WHERE userID = $_SESSION['userID'];

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

# Division 
# Find the helpseeker that has booked an appointment with all counsellors
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

# Find the counsellor that has booked an appointment with all help seekers
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
