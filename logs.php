<?php

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'final-group-chat');

$group = $_GET['group'];

$query = mysqli_query($con, "SELECT * FROM chats WHERE group_id = '$group' ORDER BY chat_id DESC");

while($row = mysqli_fetch_array($query))
{
	echo "USER ID: " . $row['user_id'] . "MESSAGE: " . $row['message'] . "</br>";
}

?>