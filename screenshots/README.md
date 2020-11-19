# Screenshots Explained

## Insert
**Before:** User goes to signup page and creates an account either as a HelpSeeker or Counsellor.

**After:** Account details is inserted into the database and user is redirected to their profile page.

## Delete
**Before:** User navigates to delete page with buttons that will either execute the delete query, or take them back to safety.

**After:** User presses the delete button, the user's account details are deleted from related tables in the database, and user is redirected to login page.

## Update
**Before:** User enters new profile details in the edit profile page.

**After:** User account details are updated in the database with new information entered by the user. User is redirected to profile page where they can see their updated information. 

## Selection
**Before:** User navigates to the "Lookup" page and inputs a user id in the search bar and presses the search button.

**After:** Page returns a user's basic information based on the searched id, or returns no user found if invalid id id entered.

## Projection
**Before:** User clicks any of the directory pages on the navigation bar (in this case, it's hotlines).

**After:** User is greeted with a table projecting a list of the all of the hotlines avaliable on the platform. 

## Join
**Before:** User clicks the "View Appointments" tab under the "Appointments" category on the navigation bar.

**After:** The appointments table is joined with the user table on the userID (which is provided by the user when they first login onto our platform) to display all of the appointments related to the user.

## Aggregation With Group By
**Before:** User clicks the "View Reviews" tab under the "Reviews" category in the navigation bar. 

**After:** At the bottom of the page, user is greeted with a table that shows the average rating grouped by each counsellor based on that counsellor's reviews.

## Aggregation With Having
**Before:** A counsellor (type of user) clicks the "Profile" tab on the navigation bar. 

**After:** A counsellor can see their average rating (based on their reviews) and number of distinct patients they've helped (based on their appointments).

## Nested Aggregation with Group By
**Before:** User navigates to the "Top Counsellor" page under the "Leaderboard" category in the navigation bar.

**After:** The page returns an alert box that shows who the top rated cousenllor (counsellor with highest average rating) is.

## Division 
**Before:** User navigates to the "Most Active Counsellor" page under the "Leaderboard" category in the navigation bar.

**After:** The page returns an alert box that shows who the most active cousenllor (booked an appointment with all help seekers) is.