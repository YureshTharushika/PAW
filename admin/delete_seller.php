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

  if(isset($_GET['seller_id']))
  {
  	$seller_id = mysqli_real_escape_string($connect,$_GET['seller_id']);

  	//if($user_id == $_SESSION['user_id'])
  	//{
  		//header('Location: seller.php?cannot delete the current user' ); 
  	//}
  	//else
  	
  		$query = "UPDATE seller SET IsDeleted=1 WHERE ID = {$seller_id} LIMIT 1";

  		$result = mysqli_query($connect,$query);

  		if($result)
  		{
  			header("Location: seller.php?msg=user_deleted&&user_id=$user_id");
  		}
  		else
  		{
  			header("Location: seller.php?error=delete_failed&&user_id=$user_id");
  		}
  	
  }

  else
  {
  	header('Location: seller.php?user_id=$user_id');
  }

?>

<?php mysqli_close($connect); ?>