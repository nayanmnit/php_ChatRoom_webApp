<?php
// get parameters
$roomname = $_GET['roomname'];

//Connecting to the database
include 'db_connect.php';

//Execute sql to check whether room exists
$sql = 	"SELECT * FROM `rooms` WHERE  roomname ='$room' " ; 

$result = mysqli_query($conn ,$sql);
if($result){
	//Check if room exists
	if(mysqli_num_rows($result) > 0){
		$message = "this room does not exists try creating a new one";
		echo '<script language="javascript">';
		echo 'alert("'.$message.'");';
		echo 'window.location="http://localhost/chatroom";';
		echo '</script>;';
	}
}
else{
	echo "Error : ".mysqli_error($conn);
}

echo "start the game";

?>