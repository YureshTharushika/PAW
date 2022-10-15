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

  if(isset($_POST['upload']) )
  {
  	$target = "img/ProPic/".basename($_FILES['image']['name']);

  	$image = $_FILES['image']['name'];

  	//$sql = "INSERT INTO admin (ProfilePicture) VALUES ('$image') WHERE ID = '{$user_id}' LIMIT 1";
  	$sql = "UPDATE admin SET ProfilePicture = '{$image}' WHERE ID = '{$user_id}' LIMIT 1";

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
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/Admin_page_css.css">
    <link rel="shortcut icon" href="images/shortcut_img/shortcut.png">

	<title>Update Profile Picture</title>
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
					
				<label class="loggedin_mail">Signed In as <span>
					<?php echo $email ?></span></label>
				</div>



		</header>


    <div id="sidebar" class="sidebar">
    
    <center>
      <div>
      	<?php
      	  $sql = "SELECT * FROM admin WHERE ID ={$user_id} LIMIT 1";

      	  $res = mysqli_query($connect,$sql);

      	  if(mysqli_num_rows($res) > 0)
      	  {
      	  	while($images = mysqli_fetch_assoc($res)) { ?>
      	       <div class="admin_pro_pic">
                  <img src="img/ProPic/<?=$images['ProfilePicture']?>">
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


            <div class="propic_and_form">
                        <?php
                          $sql = "SELECT * FROM admin WHERE ID ={$user_id} LIMIT 1";

                          $res = mysqli_query($connect,$sql);

                          if(mysqli_num_rows($res) > 0)
                          {
                            while($images = mysqli_fetch_assoc($res)) { ?>
                              <div class="admin_pro_pic_preview">
                                  <img src="img/ProPic/<?=$images['ProfilePicture']?>" style="width: 250px; height: 250px;border-radius: 50%;">
                              </div>

                          
                        <?php } }?>
        
      




                        <form action="change_profile_picture.php?user_id=<?php echo $user_id ?>" method="post" enctype="multipart/form-data">

                          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                        
                          <input type="file" class="custom-file-input" name="image">

                          <input type="submit" class="propic_upload_btn" name="upload" value="Upload" >


                        </form>

                        <a href = "modify_admin.php?user_id=<?php echo $user_id?>" > < Back to Details</a>

      
          </div><!--end of propic_and_form -->

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





