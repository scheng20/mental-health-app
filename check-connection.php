<?php
	include 'connect.php';
	$conn = OpenCon();
	echo "Connected Successfully"; CloseCon($conn);
?>