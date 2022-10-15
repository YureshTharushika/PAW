<?php session_start(); ?>
<?php require_once("inc/connection.php"); ?>
<?php require_once("inc/function.php"); ?>

<?php

 if(!isset($_SESSION['user_id']))
   {
   header('Location: ../index.php');
   }

   $errors = array();
   
   $user_id= '';
   $seller_id= '';
   $first_name= '';
   $first_name1= '';
   $last_name= '';
   $email= '';
   $email1= '';
   $location= ''; 
   $password='';

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
        $first_name1 = $result['FirstName'];
        //$last_name = $result['LastName'];
        $email1 = $result['Email'];
        //$location = $result['Location'];
       }
       else
       {
        //header("Location: seller.php?error=query_failed&&user_id=$user_id");
       }
     }

     else
     {
       // header("Location: seller.php?error=query_failed&&user_id=$user_id");
     }
   }

?>

<?php

  if(isset($_GET['seller_id']))
  {
    $seller_id = mysqli_real_escape_string($connect,$_GET['seller_id']);

    //if($user_id == $_SESSION['user_id'])
    //{
      //header('Location: seller.php?cannot delete the current user' ); 
    //}
    //else
    
      $query = "SELECT * FROM seller WHERE ID = {$seller_id} LIMIT 1";

      $result_set = mysqli_query($connect,$query);

      if($result_set)
      {
        if(mysqli_num_rows($result_set) == 1)
       {
        $result = mysqli_fetch_assoc($result_set);
        $first_name = $result['FirstName'];
        $last_name = $result['LastName'];
        $email = $result['Email'];
        $location = $result['Location'];
       }
       else
       {
        header("Location: seller.php?error=query_failed&&user_id=$user_id");
       }
       
      }
      else
      {
        header("Location: seller.php?error=query_failed&&user_id=$user_id");
      }
    
  }

  else
  {
    header("Location: seller.php?user_id=$user_id");
  }

?>




<?php

 if(!isset($_SESSION['user_id']))
 {
  header('Location: ../index.php');
 } 

 $advertisement_list = '';
 $search = '';


 $query = "SELECT * FROM advertisement WHERE SellerId = {$seller_id} ORDER BY AddId DESC";


  $users = mysqli_query($connect,$query);

  if($users)
  {
    while($user = mysqli_fetch_assoc($users))
    {

      $advertisement_list .= "<tr>";
      $advertisement_list .= "<td>Ad {$user['AddId']} </td>";
      $advertisement_list .= "<td> {$user['Category']} </td>";
      $advertisement_list .= "<td> {$user['Title']} </td>";
      $advertisement_list .= "<td> {$user['Details']} </td>";
      $advertisement_list .= "<td> {$user['Price']} </td>";
      $advertisement_list .= "<td> {$user['Contact']} </td>";
      $advertisement_list .= "<td> {$user['PostedAt']} </td>";
      $advertisement_list .= "<td>S {$user['SellerId']} </td>";
      $advertisement_list .= "<td> {$user['IsApproved']} </td>";
      //$advertisement_list .= "<td> <img src=\"../uploads{$user['Image']}\" style=\"width:500px;height50px;\"></td>";
      $advertisement_list .= "<td> <img src=\"../uploads/{$user['Image']}\" style=\"width:100px;height:100px;\"></td>";
      $advertisement_list .= "</tr>";
    }
  }

  else
  {
    echo "Database Query Failed!";
  }

?>




<!DOCTYPE>

<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/Admin_page_css.css">
    <link rel="shortcut icon" href="images/shortcut_img/shortcut.png">
    
    <title>Seller Profile View</title>

</head>

<body>
  
<header id="header" class = "header">

<div class="hamberger" onclick="toggleSidebar()">
<i class="fas fa-bars" ></i>
</div>

<div class="left_area">
  PAW.LK
</div>

<div class="right_area" >
  
<label class="loggedin_mail">Signed In as <span><?php echo $email1 ?></span></label>
</div>



</header>



<div id="sidebar" class="sidebar">
    
    <center>
      <div class="admin_pro_pic">
        <?php
          $sql = "SELECT * FROM admin WHERE ID ={$user_id} LIMIT 1";

          $res = mysqli_query($connect,$sql);

          if(mysqli_num_rows($res) > 0)
          {
            while($images = mysqli_fetch_assoc($res)) { ?>
               <div class="admin_pro_pic">
                  <img src="img/ProPic/<?=$images['ProfilePicture']?>" >
               </div>

          
        <?php } }?>
      </div>
    
    <h4><?php echo $first_name1 ?></h4> 
    </center>
    <a href="admin_dashboard.php?user_id=<?php echo $user_id ?>"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
    <a href="advertisements.php?user_id=<?php echo $user_id ?>"><i class="fas fa-ad"></i><span>Advertiesments</span></a>
    <a href="seller.php?user_id=<?php echo $user_id ?>"><i class="fas fa-user"></i><span>Sellers</span></a>
    <a href="admin.php?user_id=<?php echo $user_id ?>"><i class="fas fa-user-cog"></i><span>Admins</span></a>
    <a href="add_new_admin.php?user_id=<?php echo $user_id ?>"><i class="fas fa-user-plus"></i></i></i><span>Add New Admin</span></a>
    
    <a href="../index.php?user_id=<?php echo $user_id ?>"><i class="fas fa-home"></i><span>Home</span></a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Log Out</span></a>
 
 </div><!--End of sidebar-->
  
  


 <div id="content" class="content">
 		<div class="home-content">

  

   <div class = "sellerview_profile_picture">

     <?php
          $sql = "SELECT * FROM seller WHERE ID ={$seller_id} LIMIT 1";

          $res = mysqli_query($connect,$sql);

          if(mysqli_num_rows($res) > 0)
          {
            while($images = mysqli_fetch_assoc($res)) { ?>
               <div class="admin_pro_pic">
                  <img src="../seller/img/ProPic/<?=$images['ProfilePicture']?>" >
               </div>

          
      <?php } }?>

   </div>

   <h1 id="sellerview_sellername"><?php echo $first_name; ?></h1>

   <?php
     
     if (!empty($errors))
        {
         echo '<div class="errmsg">';
         echo '<b>There were error(s) on your form.</b> <br>';

         foreach($errors as $error)
           {
            echo '- ' . $error . '<br>';
           }
         echo '</div>';

        }

   ?>
 
    

        <div class="seller_personal_details">
          <p>Seller Id : S <?php echo $seller_id ?></p> <br>
          <p>First Name : <?php echo $first_name ?></p> <br>
          <p>Last Name : <?php echo $last_name ?></p> <br>
          <p>Email Address : <?php echo $email ?></p> <br>
          <p>Location : <?php echo $location ?></p> <br>

        </div>

   
   <table id="sellerTable" class="masterlist">

      <tr id="tableHeader">
        <th>Add Id</th>
        <th>Category</th>
        <th>Title</th>
        <th>Details</th>
        <th>Price</th>
        <th>Contact</th>
        <th>Posted Time</th>
        <th>Seller Id</th>
        <th>Is Approved</th>
        <th>Image</th>
      </tr>

      <?php echo $advertisement_list ?>

    </table>

  
  </div><!--end of home-content -->
</div><!--end of content -->


<Script>


function toggleSidebar(){

  document.getElementById("sidebar").classList.toggle('active');
  document.getElementById("header").classList.toggle('active');
  document.getElementById("content").classList.toggle('active');
}

</Script>
  
</body>

</html>