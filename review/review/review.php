<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

	// retriving the data to te database
	require 'db_connection.php';		
	$query = "SELECT * FROM rating ";

	$result = mysqli_query($conn,$query);
	
	 
   // getting seller total


		




    $name = $_POST["name"];
    $rating = $_POST["rating"];
 
    $sql = "INSERT INTO rating (Email,Rate,SellerId) VALUES ('$name','$rating','$_POST['id']')";
    if (mysqli_query($conn, $sql))
    {
        echo "New Rate added successfully";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    mysqli_close($conn);
}

?>