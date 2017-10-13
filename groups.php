<?php 

$userName = $_GET['name'];

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'final-group-chat');

echo "Groups of ".$userName;
echo "<br>";

$query2 = mysqli_query($con, "SELECT * FROM user WHERE user_name = '".$userName."'");

while ($row1 = mysqli_fetch_array($query2))
{
	$query = "SELECT * FROM `users_groups` WHERE user_id = ".$row1['user_id']."";

	$result = mysqli_query($con, $query);
	while ($row = mysqli_fetch_array($result))
	{
		$sql = mysqli_query($con, "SELECT * FROM groups WHERE group_id = ".$row['group_id']."");
		while($row2 = mysqli_fetch_array($sql))
		{
			if ($row['read_chats'] < $row2['total_chats'])
			{
				$unread = $row2['total_chats'] - $row['read_chats'];
				echo $unread;
			}
			
			echo "<a href='chats.php?user=".urlencode($row1['user_id'])."&group=".urlencode($row2['group_id'])."'>". $row2['group_name']."</a><br>";
		}
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Groups</title>
</head>
<body>

<form action='NewGroup.php?nname=<?php echo $userName ?>' method="POST">
	<button type="submit">New Group</button>
</form>

</body>
</html>