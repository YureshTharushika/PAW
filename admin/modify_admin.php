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
   $last_name= '';
   $email= '';
   $password='';


   if(isset($_GET['user_id']))
   {
   	$user_id = mysqli_real_escape_string($connect,$_GET['user_id']);
   	$query = "SELECT * FROM admin WHERE ID= {$user_id} LIMIT 1";

   	if($user_id != $_SESSION['user_id'])
    {
	   header("Location: admin.php?Can't Edit details of other Admins&&user_id=".$_SESSION['user_id']);
    }

   	$result_set = mysqli_query($connect,$query);

   	if($result_set)
   	 {
       if(mysqli_num_rows($result_set) == 1)
       {
       	//User Found
       	$result = mysqli_fetch_assoc($result_set);
       	$first_name = $result['FirstName'];
       	$last_name = $result['LastName'];
       	$email = $result['Email'];
       }
       else
       {
       	header("Location: admin.php?error=query_failed");
       }
   	 }

   	 else
   	 {
        header("Location: admin.php?error=query_failed");
   	 }
   }

   if(isset($_POST['submit']))
   {
   	 $user_id = $_POST['user_id'];
   	 $first_name = $_POST['first_name'];
   	 $last_name = $_POST['last_name'];
   	 $email = $_POST['email'];



   	 $req_fields = array('user_id','first_name','last_name','email');

   	 foreach($req_fields as $field)
   	 {
   	 	if(empty(trim($_POST[$field])))
   	 	{
   	 		$errors[] = $field . " is required";
   	 	}
   	 }

   	 $max_len_fields = array('first_name' => 50, 'last_name' => 100, 'email' => 100);

   	 foreach($max_len_fields as $field => $max_len)
   	 {
   	 	if(strlen(trim($_POST[$field])) > $max_len)
   	 	{
   	 		$errors[] = $field . ' must be less than ' . $max_len . ' characters.';
   	 	}
   	 }

   	 if(!is_email($_POST['email']))
   	 {
   	 	$errors[] = 'Email Address in Invalid';
   	 }

   	 $email = mysqli_real_escape_string($connect,$_POST['email']);
   	 $query = "SELECT * FROM admin WHERE Email='{$email}' AND ID != {$user_id} LIMIT 1";
   	 $result_set = mysqli_query($connect,$query);

   	 if($result_set)
   	 {
   	 	if(mysqli_num_rows($result_set) == 1)
   	 	{
   	 		$errors[] = 'Email Address already Exists';
   	 	}
   	 }

   	 if(empty($errors))
   	 {
   	 	$first_name = mysqli_real_escape_string($connect,$_POST['first_name']);
   	 	$last_name = mysqli_real_escape_string($connect,$_POST['last_name']);
   	 	//Email Address is already Sanitized

   	 	$query = "UPDATE admin SET FirstName='{$first_name}', LastName='{$last_name}', Email='{$email}' WHERE ID = {$user_id} LIMIT 1";

   	 	$result_set = mysqli_query($connect,$query);

   	 	if($result_set)
   	 	{
   	 	  header("Location: admin.php?user_modified_corect&&user_id=$user_id");
   	 	}

   	 	else
   	 	{
   	 		$errors[] = "Failed to modify the record";
   	 	}
   	 }

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
    
    <title>Modify Admin Details</title>
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


<div id="content" class="content">
 		<div class="home-content">
			
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

						<div class="admincontent">
							<form class="adminform" action="modify_admin.php?user_id=<?php echo $user_id ?>" method="post">

								<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

								<div class="label_and_input">
								<label for="first_name">First Name:</label><br>
								<input type="text" name="first_name" id="first_name" placeholder="First Name" <?php echo 'value="' . $first_name . '"'; ?> >
								</div>

								<div class="label_and_input">
								<label for="last_name">Last Name:</label><br>
								<input type="text" name="last_name" id="last_name" placeholder="Last Name" <?php echo 'value="' . $last_name . '"'; ?> >
								</div>

								<div class="label_and_input">
								<label for="email">Email Address:</label><br>
								<input type="email" name="email" id="email" placeholder="Email Address" <?php echo 'value="' . $email . '"'; ?> >
								</div>

								

								
								<div class="admin_submit_button">
								<button type="submit" name="submit">Save</button>
								</div>
							
					
							</form>



							<a href = "change_password_admin.php?user_id=<?php echo $user_id?>" class="admin_change_password_btn"> Change Password ></a>

							<a href = "change_profile_picture.php?user_id=<?php echo $user_id?>" class="admin_change_propic_btn"> Update Profile Picture ></a>
							
								
							</div><!--end of admincontent -->

							
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






