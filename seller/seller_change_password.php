<?php session_start(); ?>
<?php require_once("inc/connection.php"); ?>
<?php require_once("inc/function.php"); ?>

<?php

  if(!isset($_SESSION['seller_id']))
  {
  	header('Location: ../index.php');
  }

  $errors = array();

  $seller_id = '';
  $first_name = '';
  $last_name = '';
  $email = '';
  $home_town = '';
  $password = '';

  if(isset($_GET['seller_id']))
  {
  	$seller_id = mysqli_real_escape_string($connect,$_GET['seller_id']);

  	$query = "SELECT * FROM seller WHERE ID={$seller_id} LIMIT 1";
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
  			header('Location: seller_dashboard.php?error=user_not_found');
  		}
  	}
  	else
  	{
       header('Location: seller_dashboard.php?error=query_failed'); 
  	}

  }

  if(isset($_POST['submit']))
  {
  	$seller_id = $_POST['seller_id'];
  	$password = $_POST['password'];

  	$req_fields = array('seller_id','password');

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
        $query = "UPDATE seller SET Password = '{$hashed_password}' WHERE ID = {$seller_id} LIMIT 1";

        $result_set = mysqli_query($connect,$query);

        if($result_set)
         {
          header("Location: seller_change_password.php?password_changed_successful&&seller_id=$seller_id");
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
	<title>Change Password</title>
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
   
   <h4><?php echo $first_name; ?></h4> 
   </center>

   <a href="seller_dashboard.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
   <a href="advertisements_seller.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-ad"></i><span>My Advertisements</span></a>
   <a href="seller_modify.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-user-edit"></i><span>Edit My Profile</span></a>
   <a href="seller_change_password.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-unlock-alt"></i></i><span>Change Password</span></a>
   <a href="../index.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-home"></i><span>Home</span></a>
   <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Log Out</span></a>

</div>
  
   
<div id="content" class="content">

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
   
        <form class="userform" action="seller_change_password.php?seller_id=<?php echo $seller_id ?>" method="post">
        
          
        <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">

        <div class="userform_details">

          <div class="input_box">
          <label for="password">New Password:</label>
          <input type="password" name="password" id="password" placeholder="Enter New Password">
          </div>

          <div class="input_box1">
          <label for="showpassword">Show Password</label>
          <input type="checkbox" name="showpassword" id="showpassword">
          </div>

          </div >

         

          <div class="modify_buttons">
          <button  type="submit" name="submit">Update Password</button>
          </div>

        </form>
        
    
  </div>
   

   


	

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