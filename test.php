<div>
<p>This is a test page showing all of the users in the users table.</p>
	
	<table>
		<tr>
			<th class='border-class'>userID</th>
			<th class='border-class'>password</th>
			<th class='border-class'>name</th>
			<th class='border-class'>age</th>
			<th class='border-class'>location</th>
			<th class='border-class'>email</th>
			<th class='border-class'>phone</th>
		</tr>

	<?php
		include 'connect.php';
		$conn = OpenCon();
		$sql = "SELECT * FROM Users";
		$result = $conn->query($sql);

		// output data of each row
		while($row = $result->fetch_assoc()) { 
			echo "<tr>
					<td class='border-class'>".$row["userID"]."</td>
					<td class='border- class'>".$row["password"]."</td>
					<td class='border- class'>".$row["name"]."</td>
					<td class='border- class'>".$row["age"]."</td>
					<td class='border- class'>".$row["location"]."</td>
					<td class='border- class'>".$row["email"]."</td>
					<td class='border- class'>".$row["phone"]."</td>
				  </tr>";
		}

		CloseCon($conn);
	?>

	</table>
<div>