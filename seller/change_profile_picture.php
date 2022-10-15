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
   $email= '';

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

  if(isset($_POST['upload']) )
  {
  	$target = "img/ProPic/".basename($_FILES['image']['name']);

  	$image = $_FILES['image']['name'];

  	//$sql = "INSERT INTO admin (ProfilePicture) VALUES ('$image') WHERE ID = '{$user_id}' LIMIT 1";
  	$sql = "UPDATE seller SET ProfilePicture = '{$image}' WHERE ID = '{$seller_id}' LIMIT 1";

  	mysqli_query($connect,$sql);

  	if(move_uploaded_file($_FILES['image']['tmp_name'], $target))
  	{
  		$msg = "Image Uploaded Successfully";
  	}
  	else
  	{
  		$msg = "There was a problem uploading image";
  	}
  }
  
  

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Change Profile Picture</title>

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

        <div class="seller_pro_pic_preview">
      	      <?php
                $sql = "SELECT * FROM seller WHERE ID ={$seller_id} LIMIT 1";

                $res = mysqli_query($connect,$sql);

                if(mysqli_num_rows($res) > 0)
                {
                  while($images = mysqli_fetch_assoc($res)) { ?>
                    <div class="pro_pic_preview">
                        <img src="img/ProPic/<?=$images['ProfilePicture']
                        ?>" style="width: 250px; height: 250px;border:1px solid #fbc02d;border-radius:50%;object-fit: cover;">
                    </div>




          <form action="change_profile_picture.php?seller_id=<?php echo $seller_id ?>" method="post" enctype="multipart/form-data">

            <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
                          
            <input type="file" class="custom-file-input" name="image">

            <input type="submit" class="file_upload_button" name="upload" value="Upload" >


          </form>

            <a href = "seller_modify.php?seller_id=<?php echo $seller_id?>" > < Back to Details</a>

        

      	  
      	        <?php } }?>
        
      </div><!--end of seller_pro_pic_preview -->
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





