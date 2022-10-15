<?php session_start(); ?>
<?php require_once("inc/connection.php"); ?>
<?php require_once("inc/function.php"); ?>

<?php

  if(!isset($_SESSION['user_id']))
  {
  	header('Location: ../index.php');
  }

  $errors = array();

  $user_id = '';
  $first_name = '';
  $last_name = '';
  $email = '';
  $password = '';

  if(isset($_GET['user_id']))
  {
  	$user_id = mysqli_real_escape_string($connect,$_GET['user_id']);

  	$query = "SELECT * FROM admin WHERE ID={$user_id} LIMIT 1";
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
  			header("Location: admin.php?error=user_not_found&&user_id=$user_id");
  		}
  	}
  	else
  	{
       header("Location: admin.php?error=query_failed&&user_id=$user_id"); 
  	}

  }

  if(isset($_POST['submit']))
  {
  	$user_id = $_POST['user_id'];
  	$password = $_POST['password'];

  	$req_fields = array('user_id','password');

  	foreach ($req_fields as $field) 
  	{
  		if(empty(trim($_POST[$field])))
  		{
  			$errors[] = $field . " is required"; 
  		}
  	}

    $max_len_fields = array('password' => 40);

    foreach ($max_len_fields as $field => $max_len) 
    {
    	if(strlen(trim($_POST[$field])) > $max_len)
    	{
    		$errors[] = $field . ' must be less than ' . $max_len . ' characters.';
    	}
    }

    if(empty($errors))
    {
    	$password = mysqli_real_escape_string($connect, $_POST['password']);

      //Validate password strength
      $uppercase = preg_match("#[A-Z]+#", $password);
      $lowercase = preg_match("#[a-z]+#", $password);
      $number    = preg_match("#[0-9]+#", $password);

    	$hashed_password = sha1($password);

      if($uppercase && $lowercase && $number && strlen($hashed_password) >= 8) 
      {
        $query = "UPDATE admin SET Password = '{$hashed_password}' WHERE ID = {$user_id} LIMIT 1";

        $result_set = mysqli_query($connect,$query);

        if($result_set)
         {
          header("Location: admin.php?password_changed_successful&&user_id=$user_id");
         }
        else
         {
          $errors[] = 'Failed to update the Password';
         }

      }

      else
      {
        $errors[] = 'Password is should contains<br> - Atleast 1 Uppercase Letter<br> - Atleast 1 Lowercase Letter<br> - Atleast 1 digit<br> - Atleast 8 Characters';
      }
    	

    	
    	
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
    
    <title>Change Admin Password</title>

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

      <?php

          if(!empty($errors))
          {
            echo '<div class="errmsg">';
            echo '<b>There were error(s) on your form.</b> <br>';

            foreach ($errors as $error) 
            {
              echo '- ' . $error . '<br>';
            }

            echo '</div>';
          }

      ?>

		<form class="adminform" action="change_password_admin.php?user_id=<?php echo $user_id ?>" method="post">

			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

				<div class="label_and_input">
				<label for="first_name">First Name:</label><br>
				<input type="text" name="first_name" id="first_name" <?php echo 'value="' . $first_name . '"'; ?> disabled>
				</div>

				<div class="label_and_input">
				<label for="last_name">Last Name:</label><br>
				<input type="text" name="last_name" id="last_name" <?php echo 'value="' . $last_name . '"'; ?> disabled>
				</div>
				<div class="label_and_input">
				<label for="email">Email:</label><br>
				<input type="email" name="email" id="email" <?php echo 'value="' . $email . '"'; ?> disabled>
				</div>

				<div class="label_and_input">
				<label for="password">New Password:</label><br>
				<input type="password" name="password" id="password" placeholder="New Password">
				</div>

				<div class="label_and_input">
				<label for="showpassword">Show Password</label>
				<input type="checkbox" name="showpassword" id="showpassword" style="width:20px; height:20px;">
				</div>

				<div class="admin_submit_button">
				<button type="submit" name="submit">Update Password</button>
				</div>

		</form>

		
		

   </div><!--end of home-content -->
</div><!--end of content -->



<Script>


function toggleSidebar(){

  document.getElementById("sidebar").classList.toggle('active');
  document.getElementById("header").classList.toggle('active');
  document.getElementById("content").classList.toggle('active');
}

</Script>

	<script src="js/jquery.js"></script>
    <script>
      $(document).ready(function(){
          $('#showpassword').click(function(){
            if( $('#showpassword').is(':checked') ){
             $('#password').attr('type','text');
            } else{
              $('#password').attr('type','password');
            }
          });
        });
    </script>  

</body>

</html>

<?php mysqli_close($connect); ?>