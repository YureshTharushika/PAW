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




<!DOCTYPE html>
<html>
<head>
  
  
  <title>PAW.LK</title>
  
  <link rel="stylesheet" type="text/css" href="css/homepage_style.css">
  <link rel="shortcut icon" href="images/login_page/shortcut.png">

    

    
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

  <!-- search bar -->

    <div >
            <form class="search_box" name="search_form" method="POST" action="index.php" >
                <input type="search" name="search" placeholder="Search..." required>
                
                <button type="submit" name="submit" value="Search" ><i class="fas fa-search"></i></button>
            </form>
    </div>

               <!-- search bar End--> 
              


          
    </section> 

    
<section>
    <div class="main_text">
      <h1>
        WOOF! WOOF!
      </h1>

      <p>Pick the most suitable pet for yourself!</p>

     

      <div class="main_btns">
        <a class="ad_btn"
            <?php
             if(isset($_SESSION['seller_id']))
             {
              echo "<a href=\"postAdvertisement.php?seller_id=$seller_id\">POST YOUR AD!</a>";
             }  

             else if(isset($_SESSION['user_id']))
             {
              echo "<a href=\"index.php?user_id=$user_id\">POST YOUR AD!</a>";
             }
             else{

               echo "<a href=\"login.php\">POST YOUR AD!</a>";

             }

            ?>


        </a>

      </div>

    </div>


</section>
      
<section id="services">

    <div class="services_heading">
      <span>Services</span>
      <Strong>Pet Facts</Strong>

    </div>

    <div class="services_container">

    <div class="service_box">
              <i class="fas fa-paw"></i>
              <Strong>Dogs don’t sweat like we do</Strong>
              <p>While dogs do sweat, don’t expect them to be getting damp armpits any time soon.
                 Where humans sweat watery liquid to cool down, dogs produce a pheromone laden oily substance that us humans can’t detect 
                 (dogs know it’s there because of that great sense of smell). 
                 The only place that dogs sweat like us is on their paws, so instead they pant to cool down.
              </p>
        </div>

        <div class="service_box">
              <i class="fas fa-dog"></i>
              <Strong>Dogs have a great sense of smell</Strong>
              <p>According to PBS, a Bloodhound’s sense of smell is so spot on that it can be admitted as evidence in a court of law.
                 Now if you thought that was an incredible dog fact, prepare to have your mind blown.
                  Bloodhounds can also follow tracks that are over 300 hours old and can stay on a trail for over 130 miles!
              </p>
        </div>

        <div class="service_box">
              <i class="fas fa-crosshairs"></i>
              <Strong>The most successful hunter in the world</Strong>
              <p>The African Hunting Dog is the most successful land hunter in the world. 
                They’re successful in 50-70% of their hunts, which makes them consistently the best mammalian hunter, 
                they even hold the current Guinness World Record for it.
                
              </p>
        </div>

        <div class="service_box">
              <i class="fas fa-heartbeat"></i>
              <Strong>Don’t share chocolate with your dog</Strong>
              <p>Chocolate can be very deadly to dogs due to containing the ingredient, theobromine.
                 Dogs cannot metabolize theobromine and ingesting chocolate could cause a severely 
                 toxic buildup in their system which could become fatal.
              </p>
        </div>

        <div class="service_box">
              <i class="fas fa-notes-medical"></i>
              <Strong>Petting a dog is good for your health</Strong>
              <p>Petting a dog can actually benefit your physical and mental health. 
                Studies have shown that petting a dog for 15 minutes can lower blood pressure by 10%,
                 can help lower feelings of stress, depression, and combat loneliness.
              </p>
        </div>

        <div class="service_box">
              <i class="fas fa-clock"></i>
              <Strong>Dogs have a sense of time</Strong>
              <p>Dogs can tell the difference between one hour and six hours. 
                With enough conditioning and training, your dog will be able to forecast their daily activities
                such as walks and meals as long as they occur around the same time each day.
              </p>
        </div>

    </div>

     <div class="main_btns">

          <?php
             if(isset($_SESSION['seller_id']))
             {
              echo "<a href=\"pet database/pet_database.php?seller_id=$seller_id\" class=\"ad_btn\">PET ARCHIVE</a>";
             } 

             else if(isset($_SESSION['user_id']))
             {
              echo "<a href=\"pet database/pet_database.php?user_id=$user_id\" class=\"ad_btn\">PET ARCHIVE</a>";
             } 

             else
             {

               echo "<a href=\"pet database/pet_database.php\"class=\"ad_btn\">PET ARCHIVE</a>";

             }

          ?>
        

      </div>
</section>




<section id="filter">
          <div class="filter_label_and_input_section">
              <?php

                if(!isset($_SESSION['seller_id']) AND !isset($_SESSION['user_id']))
                {

                  echo "<form action=\"index.php\" method=\"GET\" >";
                        echo "<div class=\"sort_and_filter\" > ";
                        echo  "<label for= \"\">Sort results by Location:</label>";
                            echo "<select name=\"categories\" id=\"categories\">";
                              echo "<option   value=\"\">All Location</option>";
                              echo "<option   value=\"Colombo\">Colombo</option>";
                              echo "<option   value=\"Gampaha\">Gampaha</option>";
                              echo "<option   value=\"Kalutara\">Kalutara</option>";
                              echo "<option   value=\"Kandy\">Kandy</option>";
                              echo "<option   value=\"Matale\">Matale</option>";
                              echo "<option   value=\"NuwaraEliya\">Nuwara-Eliya</option>";
                              echo "<option   value=\"Galle\">Galle</option>";
                              echo "<option   value=\"Matara\">Matara</option>";
                              echo "<option   value=\"Hambanthota\">Hambanthota</option>";
                              echo "<option   value=\"Jaffna\">Jaffna</option>";
                              echo "<option   value=\"Mannar\">Mannar</option>" ;     
                              echo "<option   value=\"Mulathivu\">Mulathivu</option>" ;    
                              echo "<option   value=\"Vauniya\">Vauniya</option> "  ;  
                              echo "<option   value=\"Kilinochchi\">Kilinochchi</option> " ;   
                              echo "<option   value=\"Batticaloa\">Batticaloa</option> " ;  
                              echo "<option   value=\"Ampara\">Ampara</option> " ;   
                              echo "<option   value=\"Trincomalee\">Trincomalee</option> "  ; 
                              echo "<option   value=\"Kurunegala\">Kurunegala</option> "   ; 
                              echo "<option   value=\"Puttalam\">Puttalam</option>" ;    
                              echo "<option   value=\"Anuradhapura\">Anuradhapura</option>"  ;   
                              echo "<option   value=\"Polonnaruwa\">Polonnaruwa</option>"   ;  
                              echo "<option   value=\"Badulla\">Badulla</option>"   ;  
                              echo "<option   value=\"Monaragala\">Monaragala</option>" ;    
                              echo "<option   value=\"Rathnapura\">Rathnapura</option> "    ;
                              echo "<option   value=\"Kegalle\">Kegalle</option>";             
                            echo "</select>";
                        echo "<button type=\"submit\" class=\"filter_btn\" >Filter</button>";
                        echo "</div>";          
                  echo "</form>";


                }



                else if(isset($_SESSION['seller_id']))
                {

                  echo "<form action=\"index.php?seller_id=$seller_id\" method=\"GET\" >";
                  echo "<input type=\"hidden\" name=\"seller_id\" value=$seller_id>";
                        echo "<div class=\"sort_and_filter\" > ";
                        echo  "<label for= \"\">Sort results by Location:</label>";
                            echo "<select name=\"categories\" id=\"categories\">";
                              echo "<option   value=\"\">All Location</option>";
                              echo "<option   value=\"Colombo\">Colombo</option>";
                              echo "<option   value=\"Gampaha\">Gampaha</option>";
                              echo "<option   value=\"Kalutara\">Kalutara</option>";
                              echo "<option   value=\"Kandy\">Kandy</option>";
                              echo "<option   value=\"Matale\">Matale</option>";
                              echo "<option   value=\"NuwaraEliya\">Nuwara-Eliya</option>";
                              echo "<option   value=\"Galle\">Galle</option>";
                              echo "<option   value=\"Matara\">Matara</option>";
                              echo "<option   value=\"Hambanthota\">Hambanthota</option>";
                              echo "<option   value=\"Jaffna\">Jaffna</option>";
                              echo "<option   value=\"Mannar\">Mannar</option>" ;     
                              echo "<option   value=\"Mulathivu\">Mulathivu</option>" ;    
                              echo "<option   value=\"Vauniya\">Vauniya</option> "  ;  
                              echo "<option   value=\"Kilinochchi\">Kilinochchi</option> " ;   
                              echo "<option   value=\"Batticaloa\">Batticaloa</option> " ;  
                              echo "<option   value=\"Ampara\">Ampara</option> " ;   
                              echo "<option   value=\"Trincomalee\">Trincomalee</option> "  ; 
                              echo "<option   value=\"Kurunegala\">Kurunegala</option> "   ; 
                              echo "<option   value=\"Puttalam\">Puttalam</option>" ;    
                              echo "<option   value=\"Anuradhapura\">Anuradhapura</option>"  ;   
                              echo "<option   value=\"Polonnaruwa\">Polonnaruwa</option>"   ;  
                              echo "<option   value=\"Badulla\">Badulla</option>"   ;  
                              echo "<option   value=\"Monaragala\">Monaragala</option>" ;    
                              echo "<option   value=\"Rathnapura\">Rathnapura</option> "    ;
                              echo "<option   value=\"Kegalle\">Kegalle</option>";      
                            echo "</select>";
                        echo "<button type=\"submit\" class=\"filter_btn\" >Filter</button>";
                        echo "</div>";         
                  echo "</form>";

                }



              else if(isset($_SESSION['user_id']))
                {

                  echo "<form action=\"index.php?user_id=<?php echo $user_id ?>\" method=\"get\" >";
                  echo "<input type=\"hidden\" name=\"user_id\" value=$user_id>";
                        echo "<div class=\"sort_and_filter\" > ";
                        echo  "<label for= \"\">Sort results by Location:</label>";
                            echo "<select name=\"categories\" id=\"categories\">";
                              echo "<option   value=\"\">All Location</option>";
                              echo "<option   value=\"Colombo\">Colombo</option>";
                              echo "<option   value=\"Gampaha\">Gampaha</option>";
                              echo "<option   value=\"Kalutara\">Kalutara</option>";
                              echo "<option   value=\"Kandy\">Kandy</option>";
                              echo "<option   value=\"Matale\">Matale</option>";
                              echo "<option   value=\"NuwaraEliya\">Nuwara-Eliya</option>";
                              echo "<option   value=\"Galle\">Galle</option>";
                              echo "<option   value=\"Matara\">Matara</option>";
                              echo "<option   value=\"Hambanthota\">Hambanthota</option>";
                              echo "<option   value=\"Jaffna\">Jaffna</option>";
                              echo "<option   value=\"Mannar\">Mannar</option>" ;     
                              echo "<option   value=\"Mulathivu\">Mulathivu</option>" ;    
                              echo "<option   value=\"Vauniya\">Vauniya</option> "  ;  
                              echo "<option   value=\"Kilinochchi\">Kilinochchi</option> " ;   
                              echo "<option   value=\"Batticaloa\">Batticaloa</option> " ;  
                              echo "<option   value=\"Ampara\">Ampara</option> " ;   
                              echo "<option   value=\"Trincomalee\">Trincomalee</option> "  ; 
                              echo "<option   value=\"Kurunegala\">Kurunegala</option> "   ; 
                              echo "<option   value=\"Puttalam\">Puttalam</option>" ;    
                              echo "<option   value=\"Anuradhapura\">Anuradhapura</option>"  ;   
                              echo "<option   value=\"Polonnaruwa\">Polonnaruwa</option>"   ;  
                              echo "<option   value=\"Badulla\">Badulla</option>"   ;  
                              echo "<option   value=\"Monaragala\">Monaragala</option>" ;    
                              echo "<option   value=\"Rathnapura\">Rathnapura</option> "    ;
                              echo "<option   value=\"Kegalle\">Kegalle</option>";          
                            echo "</select>";
                        echo "<button type=\"submit\" class=\"filter_btn\" >Filter</button>";
                        echo "</div>";        
                echo "</form>";

                }
                  

              ?>





                        <?php
                            if(isset($_GET['categories'])){
                                  $var = $_GET['categories'];

                                  $mysqli = new PDO("mysql:host=localhost;dbname=petshop",'root','');
                      
                                $result = $mysqli ->query("SELECT * FROM  advertisement WHERE Location like '%{$var}%' AND IsDeleted = 0 AND IsApproved='true' ORDER BY AddId DESC;") or die($mysqli -> error);

                                    


                            ?>    



              </div><!-- End of filter_label_and_input_section -->


</section>







<section id="advertiesment">

    <div  class="grid_container">

       
            <?php
           while($data = $result -> fetch())
             {
             ?>
               
           
                <div class="grid_item">
                      <div class="ad_img">
                                
                                <img src="uploads/<?php echo $data['Image']  ?>">
                          
                      </div><!-- ad_img End -->

                      <div class="ad_text">
                              <span>Ad</span>
                    
                              <h3><?php echo"{$data['Title']}";?></h3> 
                              <h2>Rs.<?php echo"{$data['Price']}";?></h2>
                              <h4><?php echo"{$data['Location']}";?></h4>
                            

                              
                    

                              <div class="sub_ad_btn">

                                     

                                       <?php
                                       $addid = $data['AddId'];
                                       $SID = $data['SellerId'];


                                       if(!isset($_SESSION['seller_id']) AND !isset($_SESSION['user_id']))
                                       {
                                        echo "<a href=\"advertisementDetails/advertisement.php?AddId=$addid&&SID=$SID\" class=\"more_details_btns\">More Details</a>";
                                       }

                                       else if(isset($_SESSION['seller_id']))
                                       {
                                         echo "<a href=\"advertisementDetails/advertisement.php?AddId=$addid&&SID=$SID&&seller_id=$seller_id\" class=\"more_details_btns\">More Details</a>";
                                       }

                                       else if(isset($_SESSION['user_id']))
                                       {
                                         echo "<a href=\"advertisementDetails/advertisement.php?AddId=$addid&&SID=$SID&&user_id=$user_id\" class=\"more_details_btns\">More Details</a>";
                                       }
                      

                                       ?>

                                    
                    
                              </div><!-- sub_ad_btn End -->

                        </div><!-- ad_text End -->

      
                </div><!-- grid_item End -->

           
                          
                          
                          <?php
                            
                          } 
                          ?>
      </div><!-- grid_container End -->
                         
          

</section>
 
                 
   
                <?php
                      
                }else{
                 ?> 
                
            <!-- filter not having details -->

              <!-- <script>alert(' Choose a proper username.!')</script>; -->
    <?php

           
              $mysqli = new PDO("mysql:host=localhost;dbname=petshop",'root','');
            
                 $server ="localhost";
                  $user   = "root";
                  $password ="";
                  $database ="petshop";


                $con = mysqli_connect($server,$user,$password,$database);
         
               $sql = "SELECT * FROM advertisement WHERE IsDeleted = 0 AND IsApproved='true' ORDER BY AddId DESC";

    
               


                $result = mysqli_query($con,$sql);
                $resultCheck = mysqli_num_rows($result);
                   

               if($resultCheck > 0){

              $row = mysqli_fetch_assoc($result);


               if($row['IsApproved'] == 'true'){
                if(isset($_POST['submit'])){
                $str = $_POST['search'];


              $result = $mysqli ->query("SELECT * FROM  advertisement  WHERE Category like '%{$str}%' AND IsDeleted = 0 AND IsApproved='true' ORDER BY AddId DESC;") or die($mysqli -> error);

               ?>


<section id="advertiesment">

    <div  class="grid_container">

       
            <?php
           while($data = $result -> fetch())
             {
             ?>
               
           
                <div class="grid_item">
                      <div class="ad_img">
                                
                                <img src="uploads/<?php echo $data['Image']  ?>">
                          
                      </div><!-- ad_img End -->

                      <div class="ad_text">
                              <span>Ad</span>
                    
                              <h3> <?php echo"{$data['Title']}";?></h3> 
                              <h2>Rs.<?php echo"{$data['Price']}";?></h2>
                              <h4><?php echo"{$data['Location']}";?></h4>
                            

                              
                    

                               <div class="sub_ad_btn">

                                       

                                       <?php
                                       $addid = $data['AddId'];
                                       $SID = $data['SellerId'];


                                       if(!isset($_SESSION['seller_id']) AND !isset($_SESSION['user_id']))
                                       {
                                        echo "<a href=\"advertisementDetails/advertisement.php?AddId=$addid&&SID=$SID\" class=\"more_details_btns\">More Details</a>";
                                       }

                                       else if(isset($_SESSION['seller_id']))
                                       {
                                         echo "<a href=\"advertisementDetails/advertisement.php?AddId=$addid&&SID=$SID&&seller_id=$seller_id\" class=\"more_details_btns\">More Details</a>";
                                       }

                                       else if(isset($_SESSION['user_id']))
                                       {
                                         echo "<a href=\"advertisementDetails/advertisement.php?AddId=$addid&&SID=$SID&&user_id=$user_id\" class=\"more_details_btns\">More Details</a>";
                                       }
                      

                                       ?>

                                    
                    
                              </div><!-- sub_ad_btn End -->

                        </div><!-- ad_text End -->

      
                </div><!-- grid_item End -->

           
                          
                          
                          <?php
                            
                          } 
                          ?>
      </div><!-- grid_container End -->
                         
          

</section>
                      <?php
                        }else{


                        $result = $mysqli ->query("SELECT * FROM  advertisement WHERE IsDeleted = 0 AND IsApproved='true' ORDER BY AddId DESC; ") or die($mysqli -> error);
                      ?>




<section id="advertiesment">

    <div  class="grid_container">

       
            <?php
           while($data = $result -> fetch())
             {
             ?>
               
           
                <div class="grid_item">
                      <div class="ad_img">
                                
                                <img src="uploads/<?php echo $data['Image']  ?>">
                          
                      </div><!-- ad_img End -->

                      <div class="ad_text">
                              <span>Ad</span>
                    
                              <h3> <?php echo"{$data['Title']}";?></h3> 
                              <h2>Rs.<?php echo"{$data['Price']}";?></h2>
                              <h4><?php echo"{$data['Location']}";?></h4>
                            

                              
                    

                            <div class="sub_ad_btn">

                                    

                                       <?php
                                       $addid = $data['AddId'];
                                       $SID = $data['SellerId'];


                                       if(!isset($_SESSION['seller_id']) AND !isset($_SESSION['user_id']))
                                       {
                                        echo "<a href=\"advertisementDetails/advertisement.php?AddId=$addid&&SID=$SID\" class=\"more_details_btns\">More Details</a>";
                                       }

                                       else if(isset($_SESSION['seller_id']))
                                       {
                                         echo "<a href=\"advertisementDetails/advertisement.php?AddId=$addid&&SID=$SID&&seller_id=$seller_id\" class=\"more_details_btns\">More Details</a>";
                                       }

                                       else if(isset($_SESSION['user_id']))
                                       {
                                         echo "<a href=\"advertisementDetails/advertisement.php?AddId=$addid&&SID=$SID&&user_id=$user_id\" class=\"more_details_btns\">More Details</a>";
                                       }
                      

                                       ?>
                                       

                                    
                                     
                    
                              </div><!-- sub_ad_btn End -->

                        </div><!-- ad_text End -->

      
                </div><!-- grid_item End -->

           
                          
                          
                          <?php
                            
                          } 
                          ?>
      </div><!-- grid_container End -->
                         
          

</section>
                      <?php
                                    }
                                  }
                                  else{

                      ?>




                      <?php

                                            
                                              }
                                            

                                        } 
                                    ?>

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
