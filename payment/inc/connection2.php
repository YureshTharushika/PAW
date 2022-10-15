<?php 

  $connect2 = mysqli_connect("localhost","root","","chatapp");

  if(mysqli_connect_errno())
  {
  	die("Connection Failed" . mysqli_connect_error());
  }

  else
  {
  	//echo "Connection Successful";
  }

?>