# Projection
SELECT userID, name, age, location, email, phone FROM Users;
SELECT name, phoneNum, typeOfHelp FROM Hotline;

# Join
SELECT name, date, startTime, endTime, meetingPlatform
FROM users U, appointment A
WHERE U.userID = A.counsellorID AND 
	 A.helpSeekerID = $_SESSION["userID"];

SELECT name, date, startTime, endTime, meetingPlatform
FROM users U, appointment A
WHERE U.userID = A.helpSeekerID AND 
	  A.counsellorID = $_SESSION["userID"];

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
