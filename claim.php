<?php
//Getting value of post parameter
$room=$_POST['room'];

//Checking the string length
if(strlen($room)>20 or strlen($room)<2){
	$message = "2 se 20 tak only";
	echo '<script language="javascript">;';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/chatroom";';
	echo '</script>;';
}
//Checking whether room name is alphanumeric
else if(!ctype_alnum($room)){
	$message = "no aur character only";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/chatroom";';
	echo '</script>;';
}
else {
	//conect to database
	include 'db_connect.php';
 }
//check if room already exist

$sql = 	"SELECT * FROM `rooms` WHERE  roomname ='$room' " ;
$result = mysqli_query ($conn ,$sql);
if($result){

	if(mysqli_num_rows($result) >0){
		$message = "change room name";
		echo '<script language="javascript">';
		echo 'alert("'.$message.'");';
		echo 'window.location="http://localhost/chatroom";';
		echo '</script>;';
	}
	else{
		$sql ="INSERT INTO `rooms` ( `roomname`) VALUES ('$room');";
			if(mysqli_query ($conn ,$sql)){
				$message = "All done ";
				echo '<script language="javascript">';
				echo 'alert("'.$message.'");';
				echo 'window.location="http://localhost/chatroom/rooms.php?roomname= ' .$room .'"; ';
				echo '</script>;';
			}

	}
}
else{
	echo "Error:". mysqli_error($conn);
}

?>




