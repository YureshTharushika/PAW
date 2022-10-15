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
        header("Location: seller_dashboard.php?error=query_failed");
       }
     }

     else
     {
        header("Location: seller_dashboard.php?error=query_failed");
     }
   }

   if(isset($_POST['submit']))
   {
     $seller_id = $_POST['seller_id'];
     $first_name = $_POST['first_name'];
     $last_name = $_POST['last_name'];
     $email = $_POST['email'];
     $home_town = $_POST['home_town'];

     $req_fields = array('seller_id','first_name','last_name','email','home_town');

     foreach($req_fields as $field)
     {
      if(empty(trim($_POST[$field])))
      {
        $errors[] = $field . " is required";
      }
     }

     $max_len_fields = array('first_name' => 50, 'last_name' => 100, 'email' => 100, 'home_town' => 50);

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
     $query = "SELECT * FROM seller WHERE Email='{$email}' AND ID != {$seller_id} LIMIT 1";
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
      $home_town = mysqli_real_escape_string($connect,$_POST['home_town']);

      $query = "UPDATE seller SET FirstName='{$first_name}', LastName='{$last_name}', Email='{$email}', Location='{$home_town}' WHERE ID = {$seller_id} LIMIT 1";

      $result_set = mysqli_query($connect,$query);


      if($result_set)
      {
        header('Location:seller_modify.php?seller_id='. $_SESSION['seller_id']);
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
  <title>Edit My Profile</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
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
   <a href="seller_dashboard.php?seller_id=<?php echo $seller_id?>"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
   <a href="advertisements_seller.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-ad"></i><span>My Advertisements</span></a>
   <a href="seller_modify.php?seller_id=<?php echo $seller_id?>"><i class="fas fa-user-edit"></i><span>Edit My Profile</span></a>
   <a href="seller_change_password.php?seller_id=<?php echo $seller_id?>"><i class="fas fa-unlock-alt"></i></i><span>Change Password</span></a>
   <a href="../index.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-home"></i></i><span>Home</span></a>
   <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Log Out</span></a>

</div>
 
 
 
 <div id="content" class="content">
   <form class="userform" action="seller_modify.php?seller_id=<?php echo $seller_id ?>" method="post">

        
        
        <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
        
        <div class="userform_details">
          
        <div class="input_box">
        <label for="first_name">Enter New First Name:</label>
        <input type="text" name="first_name" id="first_name" placeholder="First Name" <?php echo 'value="' . $first_name . '"'; ?> >
        </div>

        <div class="input_box">
        <label for="last_name">Enter New Last Name:</label>
        <input type="text" name="last_name" id="last_name" placeholder="Last Name" <?php echo 'value="' . $last_name . '"'; ?> >
        </div>

        <div class="input_box">
        <label for="email">Enter New Email Address:</label>
        <input type="email" name="email" id="email" placeholder="Email Address" <?php echo 'value="' . $email . '"'; ?> >
        </div>

        <div class="input_box">
        <label for="home_town">Enter New Home Town:</label>
        <input type="text" name="home_town" id="home_town" placeholder="Email Address" <?php echo 'value="' . $home_town . '"'; ?> >
        </div>


        
        </div >

       
        
              <div class="modify_buttons">
                  <button type="submit" name="submit">Update Details</button>
              </div>
        
    </form>  

              <div class="change_propic_button">
              <a href = "change_profile_picture.php?seller_id=<?php echo $seller_id?>" > Update Profile Picture ></a>
              </div>
              
  </div>
  


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
  
  <Script>


function toggleSidebar(){

  document.getElementById("sidebar").classList.toggle('active');
  document.getElementById("header").classList.toggle('active');
  document.getElementById("content").classList.toggle('active');
}

</Script>


</body>

</html>