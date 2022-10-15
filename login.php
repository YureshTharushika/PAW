
<?php 
   
    include("login_function.php");
   
    $status = '';

    session_start();
    
     
                                                                      
    
 ?>


<!DOCTYPE html>
<html>
    <head>
        <title>Login and Register</title>
   
            <link rel="stylesheet" href="css/login_and_register.css">
            <link rel="shortcut icon" href="images/login_page/shortcut.png">
            <link rel="preconnect" href="https://fonts.googleapis.com">
    

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


 
    <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <script src="https://kit.fontawesome.com/52bfdd00c0.js" crossorigin="anonymous"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    

    </head>


<body>
                       
   
            
<section id="main">

                <!-- navigation bar -->
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
            
</section> 

<section>
            

                             
        
                
                                    
                            <div id="login-form" class="container">
                            
                            
                                    <div class="switch" >
                            
                                    
                                                    <?php 
                                                        $var2 =  " ";

                                                        if(isset(($_GET["erro"]))){
                                                    
                                                        if($_GET["erro"]== "verifyyourPassword"){
                                                             $var2 ="The password that you've entered is incorrect.!";
                                                        }

                                                        else if($_GET['erro']=="verifyyourEmail"){
                                                             $var2 ="Please use registered Email.!";

                                                        } 
                                                    }
                                                    ?>
                                            <div class="login" onClick="tab1();">
                                                Login
                                            </div><!--end of login -->     
        
                                                            <?php
                                                                    $var = "";



                                                                    if(isset($_GET["error"])){
                                                                
                                                                    if($_GET["error"]== "emptyinput"){
                                                                       
                                                                       // $var =" alert('Plz fill all the details.!');";
                                                                          $var ="Plz fill all the details.!";
                                                                    }

                                                                    else if($_GET['error']=="invaliuid"){
                                                                       // echo "<script>alert(' Choose a proper username.!')</script>";
                                                                          $var ="Choose a proper username.!";
                                                                       
                                                                    } 
                                                                    else if($_GET['error']=="invalidEmail"){
                                                                       // echo "<script>alert(' Choose a proper Email.!')</script>";
                                                                          $var ="Choose a proper Email.!";
                                                                    }
                                                                    else if($_GET['error']=="stamtfailed"){
                                                                    //echo "<script>alert('Choose a proper username.!')</script>";
                                                                     $var ="Choose a proper username.!";
                                                                    }
                                                                    else if($_GET['error']=="passwordsdontmatch"){
                                                                      //  echo "<script>alert('password doesn't match.!')</script>";
                                                                         $var ="password doesn't match.!";
                                                                    }
                                                                    else if($_GET['error']=="usernametaken"){

                                                                         $var ="Use another Email or username.!";

                                                                      

                                                                    }
                                                                }
                                    
                                                            ?>

                    
                    
                                                <div class="signup" onClick="tab2();">   
                                                Register
                                                </div><!--end of signup -->
                
                            
                                    </div><!--end of switch -->


                                    <div class="outer">
                                          <div class="form">
                                                <div id=page>
                                                  


                                                                 <h3 style="color: red"><?php echo $var2; ?></h3>

                                                 
                                                 
                                                        <form id="login" class="input-group-login" action="loginpage.php" method="POST">
                                                        <label id="head_label" >LogIn </label>
                                                        <div class="element">
                                                            <input type="text" class="input-field" placeholder="Email"  name="email" required name="email">
                                                            <span id="form_icons" class="fas fa-user"></span>
                                                        </div>
                                                        <div class="element">
                                                            <input type="Password" class="input-field" placeholder="Enter Password"  name="password" required name="password">
                                                            <span id="form_icons" class="fas fa-lock"></span>
                                                        </div>
                                                       
                                                        <button type="submit" class="submit-btn" name="login" value="login">Log In</button>
                                                        </form>

                                                      
                                                         
                                                        
                                                         
                                                </div>
                                                <div id=page>

                                                    <form id="register" class="input-group-register" action="regisoperation.php"  method="post">
                                                        <div class="alert" role="alert" >
                                                            <h3 style="color: red"><?php echo $var; ?></h3>
                                                        </div>
                                                     
                                                    <label id="head_label">Register</label>
                                                    <div class="element">
                                                        <input type="text"  class="input-field" placeholder="FirstName"  required name="FirstName"value="" name="FirstName" >
                                                        <span id="form_icons" class="fas fa-user"></span>  
                                                    </div>
                                                    <div class="element">
                                                        <input type="text"  class="input-field" placeholder="LastName"  required name="LastName"value="" name="LastName" >
                                                        <span id="form_icons" class="fas fa-user"></span>  
                                                    </div>
                                                    <div class="element">
                                                        <input type="text" class="input-field" placeholder="Enter Email Address" required name="email" value="" name="email">
                                                        <span id="form_icons" class="fas fa-envelope"></span>   
                                                    </div>
                                                    <div class="element">
                                                        <input type="text" class="input-field" placeholder="Enter Location" required name="location" value="" name="location">
                                                        <span id="form_icons" class="fas fa-home"></span> 
                                                    </div>
                                                    <div class="element">
                                                        <input type="Password" class="input-field" placeholder="Enter a Password"   name ="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                                        <span id="form_icons" class="fas fa-lock"></span>    
                                                    </div>
                                                    <div class="element">
                                                        <input type="Password" class="input-field" placeholder="Confirm Password"  name="cpassword">
                                                        <span id="form_icons" class="fas fa-lock"></span>
                                                    </div>
                                                 
                                                    <button type="submit" class="submit-btn" name="register" value="logi">Get Started</button>



                                                    </form>
                                                     <?php echo "$status"; ?>
                                                        
                                                </div>
                                            </div><!--end of form -->
                                    </div><!--end of outer -->

                            </div><!--end of container -->
                
        
        
        </section>
    
        <script>

      

       


                const login = document.querySelector(".login");
                const signup = document.querySelector(".signup");
                const form = document.querySelector(".form");
                const switchs = document.querySelector(".switch");


            function tab2(){
                form.style.marginLeft = "-100%";
                login.style.background = "none";
                login.style.color = "#0C090A";
                signup.style.background = "#0C090A"
                signup.style.color = "#fff";
            }


            function tab1(){
                form.style.marginLeft = "0";
                signup.style.background = "none";
                signup.style.color = "#0C090A";
                login.style.background = "#0C090A"
                login.style.color = "#fff";
            }

        </script>


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
  <?php 

        if(isset($_GET["error"])){
            echo "
         tab2();
            ";
        }
 ?>
    </script>

</body>
</html>