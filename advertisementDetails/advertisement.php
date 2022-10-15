 <?php

     session_start();
     require_once("inc/connection.php"); 
  
 ?>

<?php
   
   $user_id= '';
   $first_name1= '';
   $email= '';

   if(isset($_GET['user_id']))
   {
    $user_id = mysqli_real_escape_string($connect,$_GET['user_id']);
    $query1 = "SELECT * FROM admin WHERE IsDeleted=0 AND ID={$user_id} ORDER BY ID";

    $result_set1 = mysqli_query($connect,$query1);

    if($result_set1)
     {
       if(mysqli_num_rows($result_set1) == 1)
       {
        $result1 = mysqli_fetch_assoc($result_set1);
        $first_name1 = $result1['FirstName'];
        $email = $result1['Email'];
       }
       
     }

   }

?>


<?php
  //   if(!$_SESSION['email_id']){

  //    // header("location:index.php");
  //   }





      $seller_id= '';
      $first_name= '';
      $email_id = '';
      

      if(isset($_GET['seller_id']))
      {
        $seller_id = mysqli_real_escape_string($connect,$_GET['seller_id']);
                  
        $query = "SELECT * FROM seller WHERE IsDeleted=0 AND ID={$seller_id} ORDER BY ID";
       
                       $sellers = mysqli_query($connect,$query);

                      if($sellers)
                      {
                        while($seller = mysqli_fetch_assoc($sellers))
                        {
                         $seller_id = $seller['ID'];
                         $first_name = $seller['FirstName'];
                         $email_id = $seller['Email'];

                        }
                      }

       }

 
?>

<?php


      $s_id= '';
      $seller_first_name= '';
      

      if(isset($_GET['SID']))
      {
        $s_id = mysqli_real_escape_string($connect,$_GET['SID']);
                  
        $query = "SELECT * FROM seller WHERE IsDeleted=0 AND ID={$s_id} ORDER BY ID";
       
                       $sellers = mysqli_query($connect,$query);

                      if($sellers)
                      {
                        while($seller = mysqli_fetch_assoc($sellers))
                        {
                         $seller_first_name = $seller['FirstName'];

                        }
                      }

       }

 
?>


<?php 

 include("../login_function.php");
 include("../postAdvertisementdb.php");

    
//$sID = $_GET['AddId'];
$sID = $_GET['AddId'];  
   
   $sql = "SELECT * FROM advertisement WHERE AddId = $sID";
      // $sql = "SELECT advertisement.Title,advertisement.Image, advertisement.Details, advertisement.Price,seller.FirstName,advertisement.Contact
      // FROM  seller , advertisement
      //  WHERE advertisement.AddId = $sID " ;

    $result = mysqli_query($con,$sql);
    $resultCheck = mysqli_num_rows($result);

  

 
                  

?>
<!DOCTYPE html>
<html>
<head>
<title>More Details</title>
  
  <link rel="stylesheet" type="text/css" href="../css/ad_more_details.css">
  <link rel="shortcut icon" href="../images/login_page/shortcut.png">

    

    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/52bfdd00c0.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
 

</head>
<body> 

<section id="main">
<nav >
  
  

      <div class="logo">
          <img src="../images/login_page/icon.jpg" >

          <label >PAW.LK</label>
      </div>

        <ul class="nav_links" >
              <li >
                <?php

                        if(!isset($_SESSION['seller_id']) AND !isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"../index.php\"><i class=\"fas fa-home\"></i> Home</a>";
                        }

                        else if(isset($_SESSION['seller_id']))
                        {
                          echo "<a href=\"../index.php?seller_id=$seller_id\"><i class=\"fas fa-home\"></i> Home</a>";
                        }

                        else if(isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"../index.php?user_id=$user_id\"><i class=\"fas fa-home\"></i> Home</a>";
                        }

                  ?>
              </li>

              <li >

                  <?php

                         
                        if(!isset($_SESSION['seller_id']) AND !isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"../About_Us.php\"><i class=\"fas fa-info-circle\"></i> About Us</a>";
                        }

                        else if(isset($_SESSION['seller_id']))
                        {
                          echo "<a href=\"../About_Us.php?seller_id=$seller_id\"><i class=\"fas fa-info-circle\"></i> About Us</a>";
                        }

                        else if(isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"../About_Us.php?user_id=$user_id\"><i class=\"fas fa-info-circle\"></i> About Us</a>";
                        }

                      ?>
                </li>
            
          
                  

                
                <li>
                    <?php
                      if(isset($_SESSION['seller_id']))
                      {
                        echo "<a href=\"../pet database/pet_database.php?seller_id=$seller_id\" ><i class=\"fas fa-dog\"></i> Pet Archive</a>";
                      } 

                      else if(isset($_SESSION['user_id']))
                      {
                        echo "<a href=\"../pet database/pet_database.php?user_id=$user_id\" ><i class=\"fas fa-dog\"></i> Pet Archive</a>";
                      } 

                      else
                      {

                        echo "<a href=\"../pet database/pet_database.php\"><i class=\"fas fa-dog\"></i> Pet Archive</a>";

                      }

                    ?>
                </li>
                
                <li>
                      <?php

                        //if(!isset($_SESSION['user_id']) || !isset($_SESSION['seller_id'])) 
                        if(!isset($_SESSION['seller_id']) AND !isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"../login.php\"><i class=\"fas fa-sign-in-alt\"></i> Login</a>";
                        }

                        else if(isset($_SESSION['seller_id']))
                        {
                          echo "<a href=\"../logout.php\"><i class=\"fas fa-sign-out-alt\"></i> Log Out</a>";
                        }  

                        else if(isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"../logout.php\"><i class=\"fas fa-sign-out-alt\"></i> Log Out</a>";
                        }

                      ?>    
                
                </li>
                 

               

           
        </ul>
        <div class="burger">
          <div></div>
          <div></div>
          <div></div>

        </div>
  

</nav>
<!-- navigation bar end -->

<!-- Dashboard and Email -->

           <div class="dashboard_and_email a">

                <?php

                if(isset($_SESSION['seller_id']))
                {
                  echo "<a href=\"../seller/seller_dashboard.php?seller_id=$seller_id\">$first_name's Dashboard ></a>";
                }  

                else if(isset($_SESSION['user_id']))
                {
                  echo "<a href=\"../admin/admin_dashboard.php?user_id=$user_id\">$first_name1's Dashboard > </a>";
                }


                ?>
          
           </div>


           <div class="dashboard_and_email b">
             
              <?php
                if(isset($_SESSION['seller_id']))
                {
                  echo $email_id;
                }  

                else if(isset($_SESSION['user_id']))
                {
                  echo $email;
                }
              ?>

           </div> 

  <!-- Dashboard and Email End-->
        
    </section> 




 <?php  
    // if($resultCheck > 0){

       while($row = mysqli_fetch_assoc($result)){

      ?>
       

<section id="main_content">
  <div class="content">
              <div class="top_banner">
                <h1> <?php  echo $row['Title']; ?></h1> 
              </div>
              <div class="top_banner">
                <h4>Posted <?php echo $row['PublishedAt']; ?>  <?php echo $row['Location']; ?></h4>
              </div>


              <div class="img_and_pvtdetails">
                    <div class="img_container">
                      <img src="../uploads/<?php echo $row['Image'] ?>">
                    </div>
                    <div class="detail_boxes">
                    <hr>
                          <div class="box">
                                <div class="row">
                                <i class="fas fa-phone-square-alt one"></i>
                                </div>
                                
                                <div class="row">
                                  <h3><?php  echo $row['Contact']; ?></h3>
                                </div> 
                          </div><!-- End of box-->
                          <hr>
                          <div class="box">
                                <div class="row">
                                <i class="fas fa-user-circle two"></i>
                                </div>
                                
                                <div class="row">
                                  <h3><?php echo $seller_first_name; ?></h3>
                                </div> 
                          </div><!-- End of box-->
                          <hr>
                          <div class="box">
                                <div class="row">
                                <i class="fas fa-star three"></i>
                                </div>
                                
                                <div class="row">
                                   

                                    <?php
                                       $addid = $row['AddId'];
                                       $SID = $row['SellerId'];


                                       if(!isset($_SESSION['seller_id']) AND !isset($_SESSION['user_id']))
                                       {
                                        echo "<a href=\"../review/index.php?id=$SID\" class=\"anchour_tag\">Review</a>";
                                       }

                                       else if(isset($_SESSION['seller_id']))
                                       {
                                         echo "<a href=\"../review/index.php?id=$SID&&seller_id=$seller_id\" class=\"anchour_tag\">Review</a>";
                                       }

                                       else if(isset($_SESSION['user_id']))
                                       {
                                         echo "<a href=\"../review/index.php?id=$SID&&user_id=$user_id\" class=\"anchour_tag\">Review</a>";
                                       }
                      

                                       ?>

                                   
                                </div> 
                          </div><!-- End of box-->
                          <hr>
                    </div><!-- End of detail_boxes-->
              </div><!-- End of img_and_pvtdetails-->
              
              
              <div class="price_and_description">
                  <h1>Rs <?php  echo $row['Price']; ?></h1><br><br>
                  <h2>Description</h2><br>
                  <h3><?php  echo $row['Details']; ?></h3>
              </div>
      
     
              <h2><?php ?></h2>
                
              
                  
              <div class="box">
                  
                  <!-- <div class="column2"><?php  echo $row['FirstName']; ?></div>  -->
              </div><!-- End of box-->

            
   
              <div>

                
              </div>

  </div><!-- End of content--> 
            <?php

                

}


            ?> 


 


</section>




<!--  footer-->
  
<footer>

    <div class="footer_container">

      <div class="sec aboutus">

        <h2>About Us</h2>
        <p>Are you looking for a pet? or trying to sell them?
          Whatever the case PAW.LK is the best online advertising platform for you.
          Pets,Pet accessories,medicine and  vitmins or food items... Everything you need.
          We are happy to help you at anytime.Now you can contact us through social media.</p>
          <ul class="sci">
        <li><a href="https://www.facebook.com/PAWLK-104761881878118"><i class="fab fa-facebook-f"></i></a></li>
        <li><a href="https://www.instagram.com/chanuka117/"><i class="fab fa-instagram"></i></a></li>
        
      </ul>
      </div>
      
      <div class="sec quick_links">

        <h2>Quick Access</h2>
        
          <ul >
            <li><a href="http://www.uwu.ac.lk/">Uva Wellassa University</a></li>

            <li>
              <?php
               if(isset($_SESSION['seller_id']))
               {
                echo "<a href=\"../privacy policy/privacy_policy.php?seller_id=$seller_id\">Privacy Policy</a>";
               } 

               else if(isset($_SESSION['user_id']))
               {
                echo "<a href=\"../privacy policy/privacy_policy.php?user_id=$user_id\">Privacy Policy</a>";
               } 

               else
               {

                echo "<a href=\"../privacy policy/privacy_policy.php\">Privacy Policy</a>";

                }

              ?>
              </li>


            <li>

            <?php
                      if(isset($_SESSION['seller_id']))
                      {
                        echo "<a href=\"../pet database/pet_database.php?seller_id=$seller_id\" >Pet Archive</a>";
                      } 

                      else if(isset($_SESSION['user_id']))
                      {
                        echo "<a href=\"../pet database/pet_database.php?user_id=$user_id\" >Pet Archive</a>";
                      } 

                      else
                      {

                        echo "<a href=\"../pet database/pet_database.php\">Pet Archive</a>";

                      }

                    ?>
            </li>
          </ul>
      </div>

      <div class="sec contact">

        <h2>Contact Info</h2>
        
          <ul class="info">
            <li>
              <span><i class="fas fa-phone-alt"></i></span>
              <p><a href="tel:+94766616878">+94766616878</a><br>
                <a href="tel:+94713162166">+94713162166</a></p>
            </li>
            <li>
              <span><i class="fas fa-envelope"></i></span>
              <p><a href="mailto:paw.lk.help@gmail.com">paw.lk.help@gmail.com</a></p>
            </li>
            
          </ul>
      </div>

    </div>

</footer>
 
    

    <!-- footer End -->
   



    <script>
    
    const navSlide =() =>{

      const burger = document.querySelector('.burger');
      const nav = document.querySelector('.nav_links');
      const navLinks = document.querySelectorAll('.nav_links li');

      burger.addEventListener('click',() =>{

        nav.classList.toggle('nav-active');
        
        navLinks.forEach((link, index) =>{
        if(link.style.animation){
          link.style.animation = '';
        }else {
          link.style.animation = `navLinkFade 0.5s ease forwards ${index / 7 + 0.3 }s`;
        }

      });
      });

    }

    navSlide();


    </script>
 
</body>
</html>
