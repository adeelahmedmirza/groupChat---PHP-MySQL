<?php 

// $userName = $_GET['nname'];

$con = mysqli_connect('localhost','root','');

mysqli_select_db($con, 'final-group-chat');

echo "<label>Add Members</label></br></br>";

if(isset($_POST['insertGroup']))
{
	if($_POST['groupName'] != "" && $_GET['nname'] != "")
	{
		
		$userName = $_GET['nname'];
		$groupName = $_POST['groupName'];

		$query2 = mysqli_query($con, "SELECT user_id FROM user WHERE user_name = '".$userName."'");

		while ($row1 = mysqli_fetch_array($query2))
		{
			$query1 = mysqli_query($con, "INSERT INTO groups (group_name, creator_id) VALUES ('$groupName', '".$row1['user_id']."')");
			$creatorId = $row1['user_id'];
		}

		$query3 = mysqli_query($con, "SELECT group_id FROM groups WHERE group_name = '$groupName'");

		while ($row = mysqli_fetch_array($query3))
		{
			$newGroupId = $row['group_id'];
		}

		$query = "SELECT * FROM `user`";
		echo "new group id is ".$newGroupId;
		$result = mysqli_query($con, $query);
		while ($row = mysqli_fetch_array($result))
		{
			echo "<a href='addMembers.php?user=".urlencode($row['user_name'])."&group=".urlencode($newGroupId)."'>". $row['user_name']."</a><br>";
		}
		echo "</br></br>";
		mysqli_query($con, "INSERT INTO users_groups (user_id, group_id) VALUES ('$creatorId', '$newGroupId')");	
	}
	else
		echo "nname or groupName missing";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>NEW GROUP</title>
</head>
<body>
	<form name = "groupForm" method="POST">
		<label>Enter Group Name:</label></br></br>
		<input type="text" name="groupName"></br></br>
		<button name="insertGroup" type="submit">Submit</button>
	</form>
</body>
</html>