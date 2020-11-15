# Projection
SELECT userID, name, age, location, email, phone FROM Users;

# Division 
# Find the helpseeker that has booked an appointment with all counsellors
SELECT name
FROM Users U, Helpseeker H
WHERE U.userID = H.userID AND
	NOT EXISTS (
		(SELECT C.userID
		 FROM Counsellors C)
		EXCEPT
		(SELECT C.userID
		 FROM Counsellors C, Appointment A 
		 WHERE C.userID = A.counsellorID AND
		 	   H.userID = A.helpSeekerID)
	);