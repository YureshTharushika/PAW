<?php session_start() ?>
<?php require_once("inc/connection.php"); ?>
<?php require_once("inc/function.php"); ?>

<?php

 if(!isset($_SESSION['user_id']))
   {
   header('Location: ../index.php');
   }

   $errors = array();
   
   $user_id= '';
   $first_name= '';
   $email= '';

   if(isset($_GET['user_id']))
   {
    $user_id = mysqli_real_escape_string($connect,$_GET['user_id']);
    $query = "SELECT * FROM admin WHERE ID= {$user_id} LIMIT 1";

    $result_set = mysqli_query($connect,$query);

    if($result_set)
     {
       if(mysqli_num_rows($result_set) == 1)
       {
        $result = mysqli_fetch_assoc($result_set);
        $first_name = $result['FirstName'];
        $email = $result['Email'];
       }
       else
       {
        header("Location: ../index.php?error=query_failed");
       }
     }

     else
     {
        header("Location: ../index.php?error=query_failed");
     }
   }

?>

<?php
 
  if(!isset($_SESSION['user_id']))
  {
  	header('Location: ../index.php');
  }

  if(isset($_GET['add_id']))
  {
  	$add_id = mysqli_real_escape_string($connect,$_GET['add_id']);
  	
  		$query = "UPDATE advertisement SET IsApproved = 'true' WHERE AddId = {$add_id} LIMIT 1";
  		$result = mysqli_query($connect,$query);

      $query1 = "UPDATE advertisement SET PublishedAt = NOW() WHERE AddId = {$add_id} LIMIT 1";
      $result1 = mysqli_query($connect,$query1);

  		if($result && $result1)
  		{
  			header("Location: advertisement_pending.php?msg=advertisemet_approved&&user_id=$user_id");
  		}
  		else
  		{
  			header('Location: advertisement_pending.php?error=approved_failed');
  		}
  	
  }

  else
  {
  	header('Location: advertisement_pending.php');
  }

?>

<?php mysqli_close($connect); ?>