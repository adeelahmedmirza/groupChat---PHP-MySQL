<?php

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'final-group-chat');

$message = $_REQUEST['message'];
$userid = $_REQUEST['user'];
$groupid = $_REQUEST['group'];

mysqli_query($con, "INSERT INTO chats (message, user_id, group_id) VALUES ('$message', '$userid', '$groupid')");

mysqli_query($con, "UPDATE groups SET total_chats = total_chats + 1 WHERE group_id = '".$groupid."'");

$query = mysqli_query($con, "SELECT * from chats ORDER BY chat_id DESC");

while ($row = mysqli_fetch_array($query))
{
	echo "USER ID: " . $row['user_id'] . "MESSAGE: " . $row['message'] . "</br>";
}

?>