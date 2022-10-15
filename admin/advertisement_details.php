<?php session_start(); 

 
 
    
   $seller_id = $_SESSION['seller_id'];
   $email = $_SESSION['email_id'];
   $name = $_SESSION['Fname'];
   $Lname =  $_SESSION['Lname'];
   $location = $_SESSION['location'];
   
   include("../login_function.php");
   include("../userprofiledb.php");
   require_once("inc/connection.php"); 
   require_once("inc/function.php");
   
    $sql = "SELECT * FROM advertisement WHERE Seller_ID ={$seller_id}";

    $result = mysqli_query($con,$sql);
    $resultCheck = mysqli_num_rows($result);

     if($resultCheck > 0){

       ($row = mysqli_fetch_assoc($result));
        
       

       if(!isset($_SESSION['$name']))
   {
  // header('Location: seller_login.php');
   }

   $errors = array();
   
   $seller_id= '';
   $first_name= '';
   $last_name= '';
  // $email= '';
   $home_town= ''; 
   $password='';

           ?>
          
          <div class="avatar">
             <img src="../profilepic_uploads/<?php echo $row['ProImage'] ?>"width='100%' height='58%' >
          </div><?php

}
          
          
           if($resultCheck > 0){

       while($row = mysqli_fetch_assoc($result)){
        
        echo $row['Title'];
        echo "<br>";
        echo $row['Details'];
         echo "<br>";
        echo $row['Price']; echo "<br>";
        echo $row['Contact']; echo "<br>";
        echo $row['Category'];

      
         }
     }
      

    ?>