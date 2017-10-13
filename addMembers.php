<?php

$con = mysqli_connect('localhost','root','');

mysqli_select_db($con, 'final-group-chat');

$user = $_GET['user'];
$group = $_GET['group'];

$query = mysqli_query($con, "SELECT user_id FROM user WHERE user_name = '".$user."'");

while ($row = mysqli_fetch_array($query))
		{
			mysqli_query($con, "INSERT INTO users_groups (user_id, group_id) VALUES ('".$row['user_id']."', $group)");
		}

?>