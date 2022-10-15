<?php session_start(); ?>
<?php require_once("inc/connection.php"); ?>
<?php require_once("inc/function.php"); ?>

<?php

 if(!isset($_SESSION['seller_id']))
   {
   header('Location: ../index.php');
   }

   $errors = array();
   
   $seller_id= '';
   $first_name= '';
   $last_name= '';
   $email= '';
   $home_town= ''; 
   $password='';

   if(isset($_GET['seller_id']))
   {
    $seller_id = mysqli_real_escape_string($connect,$_GET['seller_id']);
    $query = "SELECT * FROM seller WHERE ID= {$seller_id} LIMIT 1";

    $result_set = mysqli_query($connect,$query);

    if($result_set)
     {
       if(mysqli_num_rows($result_set) == 1)
       {
        $result = mysqli_fetch_assoc($result_set);
        $first_name = $result['FirstName'];
        $last_name = $result['LastName'];
        $email = $result['Email'];
        $home_town = $result['Location'];
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

  $query1 = "SELECT AddId FROM advertisement WHERE IsApproved='true' AND SellerId={$seller_id} ORDER BY AddId";
  $result1 = mysqli_query($connect, $query1);
  $seller_published_advertisement_count = mysqli_num_rows($result1);

  $query2 = "SELECT AddId FROM advertisement WHERE IsApproved='false' AND SellerId={$seller_id} ORDER BY AddId";
  $result2 = mysqli_query($connect, $query2);
  $seller_pending_advertisement_count = mysqli_num_rows($result2);

  $query3 = "SELECT SUM(Rate) AS count FROM rating WHERE SellerId={$seller_id} ";
  $result3 = mysqli_query($connect, $query3);
  $row = mysqli_fetch_assoc($result3);
  $rating_star_count = $row['count'];

  $query4 = "SELECT Id FROM rating WHERE SellerId={$seller_id} ";
  $result4 = mysqli_query($connect, $query4);
  $seller_review_count = mysqli_num_rows($result4);

  if($seller_review_count > 0)
  {
    $rating = bcdiv($rating_star_count,$seller_review_count,1);
  }
  

?>

<!DOCTYPE>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="../images/login_page/shortcut.png">


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
         
       <label class="loggedin_mail">Signed In as <span><?php echo $email ?></span></label>
    </div>

  </header>



  
<div id="sidebar" class="sidebar">

   <center>
   <div class="seller_pro_pic">
        <?php
          $sql = "SELECT * FROM seller WHERE ID ={$seller_id} LIMIT 1";

          $res = mysqli_query($connect,$sql);

          if(mysqli_num_rows($res) > 0)
          {
            while($images = mysqli_fetch_assoc($res)) { ?>
               <div class="pro_pic">
                  <img src="img/ProPic/<?=$images['ProfilePicture']?>" >
                </div>

          
        <?php } }?>
        
      </div>
   
   <h4><?php echo $first_name  ?></h4> 
   </center>

   <a href="seller_dashboard.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
   <a href="advertisements_seller.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-ad"></i><span>My Advertisements</span></a>
   <a href="seller_modify.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-user-edit"></i><span>Edit My Profile</span></a>
   <a href="seller_change_password.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-unlock-alt"></i></i><span>Change Password</span></a>
   <a href="../index.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-home"></i><span>Home</span></a>
   <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Log Out</span></a>

</div><!--End of sidebar-->





  
   
<div id="content" class="content">
    
  <div class="home-content">
    <div class="overview_boxes">
      <div class="box">
         <a href="advertisements_seller_approved.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-ad one"></i></a>
          <div class="left_side">
            <div class="number"><?php echo $seller_published_advertisement_count ?></div>
            <div class="box_topic">Currently Published</div>

          </div><!--end of left_side -->
        

      </div><!--end of box -->
      
      <div class="box">
        <a href="advertisements_seller_pending.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-ad two"></i></a>
          <div class="left_side">
            <div class="number"><?php echo $seller_pending_advertisement_count ?></div>
            <div class="box_topic">Waiting Approval</div>

          </div><!--end of left_side -->
        

      </div><!--end of box -->
      
      <div class="box">
      <i class="far fa-star"></i>
          <div class="left_side">
            <div class="number">

              <?php 
              if($seller_review_count == 0)
              {
                echo "0";
              }

              else
              {
                echo $rating; 
              }
              
              ?>
                
            </div>
            <div class="box_topic">Rating</div>

          </div><!--end of left_side -->
        

      </div><!--end of box -->
      
      


    </div><!--end of overview_boxes -->
  </div><!--end of home-content -->
</div><!--end of content -->

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
<input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>" >

  
<Script>


    function toggleSidebar(){

      document.getElementById("sidebar").classList.toggle('active');
      document.getElementById("header").classList.toggle('active');
      document.getElementById("content").classList.toggle('active');
    }

  </Script>
 

</body>

</html>