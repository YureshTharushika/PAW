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

  	
  		$query1 = "UPDATE advertisement SET IsDeleted=1 WHERE AddId = {$add_id} LIMIT 1";

  		$result1 = mysqli_query($connect,$query1);

      $query2 = "UPDATE advertisement SET IsApproved='deleted' WHERE AddId = {$add_id} LIMIT 1";

      $result2 = mysqli_query($connect,$query2);

  		if($result1 && $result2)
  		{
  			header("Location: advertisement_published.php?msg=advertisement_deleted&&user_id=$user_id");
  		}
  		else
  		{
  			header("Location: advertisement_published.php?error=advertisement_delete_failed&&user_id=$user_id");
  		}
  	
  }

  else
  {
  	header("Location: advertisement_published.php?user_id=$user_id");
  }

?>

<?php mysqli_close($connect); ?>