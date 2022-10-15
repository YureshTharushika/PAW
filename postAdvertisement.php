<?php 
     
    session_start();
    include("login_function.php");
    include("postAdvertisementdb.php");
    
    $seller_id = $_SESSION['seller_id'];
    $email = $_SESSION['email_id'];
    $name = $_SESSION['Fname'];
    $Lname =  $_SESSION['Lname'];
    $location = $_SESSION['location'];


    if(!$_SESSION['email_id']){

      header("location:seller_login.php");
    }

  ?>

  <?php

    require_once("inc/connection.php"); 


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

<!DOCTYPE html>
<html>
<head>
    
  <title>Post an Ad</title>
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/advertiesment.css">
  <link rel="shortcut icon" href="images/login_page/shortcut.png">

    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">

   

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
    <script src="https://kit.fontawesome.com/52bfdd00c0.js" crossorigin="anonymous"></script>
    
    
 
 </head>

     
<body>
                             
 
<section id="main">
<nav >
  
  

      <div class="logo">
          <img src="images/login_page/icon.jpg" >

          <label >PAW.LK</label>
      </div>

        <ul class="nav_links" >
              <li >
                <?php

                        if(!isset($_SESSION['seller_id']) AND !isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"index.php\"><i class=\"fas fa-home\"></i> Home</a>";
                        }

                        else if(isset($_SESSION['seller_id']))
                        {
                          echo "<a href=\"index.php?seller_id=$seller_id\"><i class=\"fas fa-home\"></i> Home</a>";
                        }

                        else if(isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"index.php?user_id=$user_id\"><i class=\"fas fa-home\"></i> Home</a>";
                        }

                  ?>
              </li>

              <li >

                  <?php

                         
                        if(!isset($_SESSION['seller_id']) AND !isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"About_Us.php\"><i class=\"fas fa-info-circle\"></i> About Us</a>";
                        }

                        else if(isset($_SESSION['seller_id']))
                        {
                          echo "<a href=\"About_Us.php?seller_id=$seller_id\"><i class=\"fas fa-info-circle\"></i> About Us</a>";
                        }

                        else if(isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"About_Us.php?user_id=$user_id\"><i class=\"fas fa-info-circle\"></i> About Us</a>";
                        }

                      ?>
                </li>
            
          
                  

                
                <li>
                    <?php
                      if(isset($_SESSION['seller_id']))
                      {
                        echo "<a href=\"pet database/pet_database.php?seller_id=$seller_id\" ><i class=\"fas fa-dog\"></i> Pet Archive</a>";
                      } 

                      else if(isset($_SESSION['user_id']))
                      {
                        echo "<a href=\"pet database/pet_database.php?user_id=$user_id\" ><i class=\"fas fa-dog\"></i> Pet Archive</a>";
                      } 

                      else
                      {

                        echo "<a href=\"pet database/pet_database.php\"><i class=\"fas fa-dog\"></i> Pet Archive</a>";

                      }

                    ?>
                </li>
                
                <li>
                      <?php

                        //if(!isset($_SESSION['user_id']) || !isset($_SESSION['seller_id'])) 
                        if(!isset($_SESSION['seller_id']) AND !isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"login.php\"><i class=\"fas fa-sign-in-alt\"></i> Login</a>";
                        }

                        else if(isset($_SESSION['seller_id']))
                        {
                          echo "<a href=\"logout.php\"><i class=\"fas fa-sign-out-alt\"></i> Log Out</a>";
                        }  

                        else if(isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"logout.php\"><i class=\"fas fa-sign-out-alt\"></i> Log Out</a>";
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
                  echo "<a href=\"seller/seller_dashboard.php?seller_id=$seller_id\">$first_name's Dashboard ></a>";
                }  

                else if(isset($_SESSION['user_id']))
                {
                  echo "<a href=\"admin/admin_dashboard.php?user_id=$user_id\">$first_name1's Dashboard > </a>";
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


    <section>
      <!-- Pricing Table-->

<div id="generic_price_table">   
  <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!--PRICE HEADING START-->
                    <div class="price-heading clearfix">
                        <h1>Our Pricings</h1>
                    </div>
                    <!--//PRICE HEADING END-->
                </div>
            </div>
        </div>
        <div class="container">
            
            <!--BLOCK ROW START-->
            <div class="row">
                <div class="col-md-3">
                
                  <!--PRICE CONTENT START-->
                    <div class="generic_content clearfix">
                        
                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">
                        
                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">
                            
                              <!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span>pets</span>
                                </div>
                                <!--//HEAD END-->
                                
                            </div>
                            <!--//HEAD CONTENT END-->
                            
                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix">  
                                <span class="price">
                                    <span class="sign">Rs</span>
                                    <span class="currency">900</span>
                                    <span class="cent">.00</span>
                                    <span class="month">/MON</span>
                                </span>
                            </div>
                            <!--//PRICE END-->
                            
                        </div>                            
                        <!--//HEAD PRICE DETAIL END-->
                        
                        <!--FEATURE LIST START-->
                        <div class="generic_feature_list">
                          <ul>
                              <li><span><i class="fas fa-check-square"></i></span> Dogs</li>
                                <li><span><i class="fas fa-check-square"></i></span> Cats</li>
                                <li><span><i class="fas fa-check-square"></i></span> Birds</li>
                                <li><span><i class="fas fa-check-square"></i></span> Fish</li>
                                <li><span><i class="fas fa-plus-square"></i></span> Many more</li>
                            </ul>
                        </div>
                        <!--//FEATURE LIST END-->
                        
                        <!--BUTTON START
                        <div class="generic_price_btn clearfix">
                          <a class="" href="">Pick</a>
                        </div>
                        //BUTTON END-->
                        
                    </div>
                    <!--//PRICE CONTENT END-->
                        
                </div>
                
                <div class="col-md-3">
                
                <!--PRICE CONTENT START-->
                  <div class="generic_content clearfix">
                      
                      <!--HEAD PRICE DETAIL START-->
                      <div class="generic_head_price clearfix">
                      
                          <!--HEAD CONTENT START-->
                          <div class="generic_head_content clearfix">
                          
                            <!--HEAD START-->
                              <div class="head_bg"></div>
                              <div class="head">
                                  <span>accessories</span>
                              </div>
                              <!--//HEAD END-->
                              
                          </div>
                          <!--//HEAD CONTENT END-->
                          
                          <!--PRICE START-->
                          <div class="generic_price_tag clearfix">  
                              <span class="price">
                                  <span class="sign">Rs</span>
                                  <span class="currency">600</span>
                                  <span class="cent">.00</span>
                                  <span class="month">/MON</span>
                              </span>
                          </div>
                          <!--//PRICE END-->
                          
                      </div>                            
                      <!--//HEAD PRICE DETAIL END-->
                      
                      <!--FEATURE LIST START-->
                      <div class="generic_feature_list">
                        <ul>
                            <li><span><i class="fas fa-check-square"></i></span> Toys</li>
                              <li><span><i class="fas fa-check-square"></i></span> Cages</li>
                              <li><span><i class="fas fa-check-square"></i></span> Leashes</li>
                              <li><span><i class="fas fa-check-square"></i></span> Collars</li>
                              <li><span><i class="fas fa-plus-square"></i></i></span> Many more</li>
                          </ul>
                      </div>
                      <!--//FEATURE LIST END-->
                      
                      <!--BUTTON START
                      <div class="generic_price_btn clearfix">
                        <a class="" href="">Pick</a>
                      </div>
                      //BUTTON END-->
                      
                  </div>
                  <!--//PRICE CONTENT END-->
                      
              </div>
              
                <div class="col-md-3">
                
                  <!--PRICE CONTENT START-->
                    <div class="generic_content clearfix">
                        
                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">
                        
                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">
                            
                              <!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span>food items</span>
                                </div>
                                <!--//HEAD END-->
                                
                            </div>
                            <!--//HEAD CONTENT END-->
                            
                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix">  
                                <span class="price">
                                    <span class="sign">Rs</span>
                                    <span class="currency">800</span>
                                    <span class="cent">.00</span>
                                    <span class="month">/MON</span>
                                </span>
                            </div>
                            <!--//PRICE END-->
                            
                        </div>                            
                        <!--//HEAD PRICE DETAIL END-->
                        
                        <!--FEATURE LIST START-->
                        <div class="generic_feature_list">
                          <ul>
                              <li><span><i class="fas fa-check-square"></i></span> Treats</li>
                                <li><span><i class="fas fa-check-square"></i></span> Raw Food</li>
                                <li><span><i class="fas fa-check-square"></i></span> Canned Food</li>
                                <li><span><i class="fas fa-check-square"></i></span> Supplements</li>
                                <li><span><i class="fas fa-plus-square"></i></span> Many more</li>
                            </ul>
                        </div>
                        <!--//FEATURE LIST END-->
                        
                        <!--BUTTON START
                        <div class="generic_price_btn clearfix">
                          <a class="" href="">Pick</a>
                        </div>
                        //BUTTON END-->
                        
                    </div>
                    <!--//PRICE CONTENT END-->
                        
                </div>
                <div class="col-md-3">
                
                <!--PRICE CONTENT START-->
                  <div class="generic_content clearfix">
                      
                      <!--HEAD PRICE DETAIL START-->
                      <div class="generic_head_price clearfix">
                      
                          <!--HEAD CONTENT START-->
                          <div class="generic_head_content clearfix">
                          
                            <!--HEAD START-->
                              <div class="head_bg"></div>
                              <div class="head">
                                  <span>medicine</span>
                              </div>
                              <!--//HEAD END-->
                              
                          </div>
                          <!--//HEAD CONTENT END-->
                          
                          <!--PRICE START-->
                          <div class="generic_price_tag clearfix">  
                              <span class="price">
                                  <span class="sign">Rs</span>
                                  <span class="currency">400</span>
                                  <span class="cent">.00</span>
                                  <span class="month">/MON</span>
                              </span>
                          </div>
                          <!--//PRICE END-->
                          
                      </div>                            
                      <!--//HEAD PRICE DETAIL END-->
                      
                      <!--FEATURE LIST START-->
                      <div class="generic_feature_list">
                        <ul>
                            <li><span><i class="fas fa-check-square"></i></span> Vitamins</li>
                              <li><span><i class="fas fa-check-square"></i></span> Steroids</li>
                              <li><span><i class="fas fa-check-square"></i></span> Antibiotics</li>
                              <li><span><i class="fas fa-check-square"></i></span> Antiparasitics</li>
                              <li><span><i class="fas fa-plus-square"></i></span> Many more</li>
                          </ul>
                      </div>
                      <!--//FEATURE LIST END-->
                      
                      <!--BUTTON START
                      <div class="generic_price_btn clearfix">
                        <a class="" href="">Pick</a>
                      </div>
                      //BUTTON END-->
                      
                  </div>
                  <!--//PRICE CONTENT END-->
                      
              </div>
              
            </div>  
            <!--//BLOCK ROW END-->
            
        </div>
    </section>             
  
</div>


<!-- Pricing Table End-->
    </section>

<!--Advertisement-->

    <section class="advertiesment_form">

      <div class="form_outer_div">

        <h3>Setup Your Advertiesment</h3>
                  <form class="ad_form" action="" method="POST" enctype="multipart/form-data">


                        
                                     
                                <div  class="form_inner_div">
                                  <label class="form-label">Select Your Category</label>
                                      <select class="form-select" id="floatingSelect"  name="category" value="category">
                                          <option selected ></option>
                                          <option value="pets">Pets</option>
                                          <option value="accessories">Accessories</option>
                                          <option value="food items">Food items</option>
                                          <option value="medicines">Medicines and vitamins</option>
                                      </select>
                                      
                                </div>
                             

                              
                                  
                                <div class="form_inner_div" name="title" >
                                  <label class="form-label">Advertiesment Title</label>
                                  <input type="text" id="form3" class="form-control"  value="" name="title" placeholder="">

                                </div>

                                <div class="form_inner_div" name="contact">
                                  <label class="form-label" >Contact No</label>
                                  <input type="text" id="form3" class="form-control" name="contact" placeholder="Customers Can Reach You On This Number" >

                                </div>
                                 
                                  <div  class="form_inner_div">
                                  <label class="form-label">Select Your location</label>
                                      <select class="form-select" id="floatingSelect"  name="location" value="location">
                                        
                                              <option   value="">All Location</option>
                                              <option   value="Colombo">Colombo</option>
                                              <option   value="Gampaha">Gampaha</option>
                                              <option   value="Kalutara">Kalutara</option>
                                              <option   value="Kandy">Kandy</option>
                                              <option   value="Matale">Matale</option>
                                              <option   value="NuwaraEliya">NuwaraEliya</option>
                                              <option   value="Galle">Galle</option>
                                              <option   value="Matara">Matara</option>
                                              <option   value="Hambanthota">Hambanthota</option>
                                              <option   value="Jaffna">Jaffna</option>
                                              <option   value="Mannar">Mannar</option>       
                                              <option   value="Mulathivu">Mulathivu</option>     
                                              <option   value="Vauniya">Vauniya</option>     
                                              <option   value="Kilinochchi">Kilinochchi</option>     
                                              <option   value="Batticaloa">Batticaloa</option>     
                                              <option   value="Ampara">Ampara</option>     
                                              <option   value="Trincomalee">Trincomalee</option>     
                                              <option   value="Kurunegala">Kurunegala</option>     
                                              <option   value="Puttalam">Puttalam</option>     
                                              <option   value="Anuradhapura">Anuradhapura</option>     
                                              <option   value="Polonnaruwa">Polonnaruwa</option>     
                                              <option   value="Badulla">Badulla</option>     
                                              <option   value="Monaragala">Monaragala</option>     
                                              <option   value="Rathnapura">Rathnapura</option>     
                                              <option   value="Kegalle">Kegalle</option>
                                           
                                            
                                            </select>
                                                                  
                                   </div>

                               

                                <div class="form_inner_div" name="description">
                                  <label for="exampleFormControlTextarea1" class="form-label" name="description">Advertiesment Description <textarea class="form-control" id="exampleFormControlTextarea1"  rows="3" name="description" value="description" placeholder="Tell Us Something About Your Advertiesment"></textarea></label>
                                  
                                </div>

                                <div class="form_inner_div">
                                  <label class="form-label" >Upload A Photo Of Your Item</label>
                                  <input type="file" name="Image" id="submit" class="form-control">
                                  </div>  

                               
                                
                                
                                <div class="form_inner_div" name="contact">
                                  <label class="form-label" >How Much Do You Want For Your Item?</label>
                                  <input type="text"  class="form-control" name="price" id="inlineFormInputGroup" placeholder="Rs">
                                </div>
                                
                              
                                <div class="disclaimer" name="contact">
                                  
                                  
                                  <label  ><i class="fas fa-exclamation-triangle"></i>DISCLAIMER !</label><br>
                                  <label  >Your advertiesment will be reviewed by the admin before published.
                                            Admin has the full authority to disqualify and delete your advertiesment without further notice
                                            by any means necessary if it  incorporates any inappropriate material.<strong>THERE WILL BE NO REFUNDS.</strong>We recommend you check our <span>
                                            <?php
                                              if(isset($_SESSION['seller_id']))
                                              {
                                                echo "<a href=\"privacy policy/privacy_policy.php?seller_id=$seller_id\" style='color: white ;'>Privacy Policy</a>";
                                              } 

                                              else if(isset($_SESSION['user_id']))
                                              {
                                                echo "<a href=\"privacy policy/privacy_policy.php?user_id=$user_id\" style='color: white ;'>Privacy Policy</a>";
                                              } 

                                              else
                                              {

                                                echo "<a href=\"privacy policy/privacy_policy.php\" style='color: white ;'>Privacy Policy</a>";

                                                }

                                              ?>
                                            </span>  before submitting the advertiesment.</label>
                                            <br>
                                 
                                </div>
                                

                                
                                <div class="btn">
                                  <input type="submit" name="upload" value="Post My Ad" >    
                                </div>
                  </form>
                </div>

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
        <li><?php
           if(isset($_SESSION['seller_id']))
           {
            echo "<a href=\"privacy policy/privacy_policy.php?seller_id=$seller_id\">Privacy Policy</a>";
           } 

           else if(isset($_SESSION['user_id']))
           {
            echo "<a href=\"privacy policy/privacy_policy.php?user_id=$user_id\">Privacy Policy</a>";
           } 

           else
           {

            echo "<a href=\"privacy policy/privacy_policy.php\">Privacy Policy</a>";

            }

          ?>
          </li>
        <li>
        <?php
                  if(isset($_SESSION['seller_id']))
                  {
                    echo "<a href=\"pet database/pet_database.php?seller_id=$seller_id\" >Pet Archive</a>";
                  } 

                  else if(isset($_SESSION['user_id']))
                  {
                    echo "<a href=\"pet database/pet_database.php?user_id=$user_id\" >Pet Archive</a>";
                  } 

                  else
                  {

                    echo "<a href=\"pet database/pet_database.php\">Pet Archive</a>";

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
                                