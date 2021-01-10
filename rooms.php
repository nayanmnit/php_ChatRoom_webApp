<?php
// get parameters
$roomname = $_GET['roomname'];

//Connecting to the database
include 'db_connect.php';

//Execute sql to check whether room exists
$sql = 	"SELECT * FROM `rooms` WHERE  roomname ='$roomname' " ; 

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


?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/product.css" rel="stylesheet">
<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.anyClass{
	height:350px;
	overflow-y: scroll;
}





</style>
</head>
<body>

<h2>Chat Messages - <?php echo $roomname; ?></h2>

<div class="container">
	<div class="anyClass">
  <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
  <p>Hello. How are you today?</p>
  <span class="time-right"></span>
  </div>
</div>



<input type = "text" class = "form-control" name="usermsg" id="usermsg" placeholder="Add message"><br>
<button class="btn btn-default" name="submitmsg" id="submitmsg">Send</button>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

<script type="text/javascript">
//Check for new messages every  1 sec
setInterval(runFunction,1000);
function runFunction()
{
   $.post("htcon.php", {room:'<?php echo $roomname ?>'},
   		function(data, status)
   		{
   			document.getElementsByClassName('anyClass')[0].innerHTML =data;
   		}

   	)
}

var input = document.getElementById("usermsg");

// Using enter key to submit .Credits : w3 school
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
    event.preventDefault();
    document.getElementById("submitmsg").click();
  }
});

//if user submits the form Get the input field
	$("#submitmsg").click(function(){
		var clientmsg = $("#usermsg").val();
	   $.post("postmsg.php",{text: clientmsg , room:'<?php echo $roomname ?>' , ip:' <?php echo $_SERVER['REMOTE_ADDR'] ?>'},
	   function(data, status){
		    document.getElementsByClassName('anyClass')[0].innerHTML = data;});
	   $("#usermsg").val("");
	   return false;
    });

</script>
</body>
</html>