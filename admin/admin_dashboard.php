<?php session_start(); ?>
<?php require_once("inc/connection.php"); ?>


<?php

  if(!isset($_SESSION['user_id']))
    {
      header('Location: ../index.php');
    }

  $query1 = "SELECT ID FROM admin ORDER BY ID";
  $result1 = mysqli_query($connect, $query1);
  $admin_count = mysqli_num_rows($result1);


  $query2 = "SELECT ID FROM seller WHERE IsDeleted=0 ORDER BY ID";
  $result2 = mysqli_query($connect, $query2);
  $seller_count = mysqli_num_rows($result2);


  $query3 = "SELECT AddId FROM advertisement WHERE IsApproved='true' AND IsDeleted=0 ORDER BY AddId";
  $result3 = mysqli_query($connect, $query3);
  $published_advertisement_count = mysqli_num_rows($result3);


  $query4 = "SELECT AddId FROM advertisement WHERE IsApproved='false' AND IsDeleted=0 ORDER BY AddId";
  $result4 = mysqli_query($connect, $query4);
  $pending_advertisement_count = mysqli_num_rows($result4);

  
?>

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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/Admin_page_css.css">
    <link rel="shortcut icon" href="images/shortcut_img/shortcut.png">
    
    <title>Dashboard</title>
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
    
    <h4><?php echo $first_name ?></h4> 
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
      <div class="overview_boxes">
        
        <div class="box" >
          <a href="advertisement_published.php?user_id=<?php echo $user_id ?>"><i class="fas fa-ad one"></i></a>
            <div class="left_side">
              <div class="number"><?php echo $published_advertisement_count ?></div>
              <div class="box_topic">Currently Published Advertisements</div>
  
            </div><!--end of left_side -->
          
  
        </div><!--end of box -->
        
        <div class="box">
        <a href="advertisement_pending.php?user_id=<?php echo $user_id ?>"><i class="fas fa-ad two"></i></a>
            <div class="left_side">
              <div class="number"> <?php echo $pending_advertisement_count ?> </div>
              <div class="box_topic">Waiting Approval</div>
  
            </div><!--end of left_side -->
          
  
        </div><!--end of box -->
        
        <div class="box">
        <a href="seller.php?user_id=<?php echo $user_id ?>"><i class="fas fa-user three"></i></a>
            <div class="left_side">
              <div class="number"><?php echo $seller_count ?></div>
              <div class="box_topic">Sellers</div>
  
            </div><!--end of left_side -->
          
  
        </div><!--end of box -->

        <div class="box">
          <a href="https://sandbox.payhere.lk/account/" target="_blank"><i class="fas fa-dollar-sign four"></i></a>
            <div class="left_side">
              <div class="number">@</div>
              <div class="box_topic">Revenue</div>
  
            </div><!--end of left_side -->
          
  
        </div><!--end of box -->

        <div class="box">
        <a href="admin.php?user_id=<?php echo $user_id ?>"><i class="fas fa-user-cog five"></i></a>
            <div class="left_side">
              <div class="number"><?php echo $admin_count ?> </div>
              <div class="box_topic">Admins</div>
  
            </div><!--end of left_side -->
          
  
        </div><!--end of box -->

        <div class="box">
        <i class="fas fa-chart-line six"></i>
            <div class="left_side">
              <div class="number"><a href="http://www.alexa.com/siteinfo/paw.lk"><script type="text/javascript" src="http://xslt.alexa.com/site_stats/js/t/a?url=paw.lk"></script></a></div>
              <div class="box_topic">Traffic Rank</div>
  
            </div><!--end of left_side -->
          
  
        </div><!--end of box -->

        
        
      </div><!--end of overview_boxes -->
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