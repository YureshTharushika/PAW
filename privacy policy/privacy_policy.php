<?php

 session_start(); 

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


<!DOCTYPE html>
<html>
<head>
    
  <title>Privacy Policy</title>
	
	<link rel="stylesheet" type="text/css" href="privacy_policy.css">
  <link rel="shortcut icon" href="../images/login_page/shortcut.png">

		
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <script src="https://kit.fontawesome.com/52bfdd00c0.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
 
 </head>

     
<body>
                             
                                     

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
                       echo "<a href=\"../pet database/pet_database.php?seller_id=$seller_id\"><i class=\"fas fa-dog\"></i> Pet Archive</a>";
                      } 

                      else if(isset($_SESSION['user_id']))
                      {
                       echo "<a href=\"../pet database/pet_database.php?user_id=$user_id\"><i class=\"fas fa-dog\"></i> Pet Archive</a>";
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
                  echo "<a href=\"../admin/admin_dashboard.php?user_id=$user_id\">$first_name1's Dashboard ></a>";
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



<section>

    <div class="inside-content">
        <h2>Privacy Policy</h2>

        <p>This page is used to inform visitors regarding our policies with the collection,use,and disclosure of Personal
            information if anyone decided to use our service.additionally what we tolerate in our website including 
            how to setup an proper advertiesment without getting disqualified.
        </p>

        <p>If you chose to use our service,then you agree to the collection and use of information in relation to this policy.
            The personal information that we collect is used for providing and improving the service.
            we will not use or share your information with anyone except as described in this privacy policy.

        </p>
        <label>
            Information Collection and Use
        </label>

        <p>
            For a better experience while using our service,we may require you to provide us with certain 
            identifiable, including name,email contact number.The information that we request retained on our database
            and is not  shared with any third parties by us in any way.
        </p>

        <label>
            Cookies
        </label>

        <p>
           Cookies are files with a small amount of data that are commonly used as anonymous unique identifiers.
           These are sent to your browser from the websites that you visit and are stored on your device's internal memory.
            Our website does not use these "cookies" explicitly.However,we may use third party code and libraries
            that use "cookies" to collect information and improve their services.You have the option to either accept
            or refuse these cookies and know when a cookie is being sent to your device.If you choose to refuse our cookies
            you may not be able to use some portions of this service. 
        </p>

        <label>
            Service Providers
        </label>

        <p>
            We may employ third party companies and individuals due to the following reasons:

        </p>
            <ul>
                <li>To facilitate our service</li>
                <li>To provide the service on our behalf</li>
                <li>To perform service related services</li>
                <li>To assist us in analyzing how our service is used</li>
            </ul>
        <p>  
            We want to inform users of our website that these third parties have access to your personal information.
            The reason is to perform the tasks assigned to them on our behalf.
            However,they are obligated not to disclose or use the information for any other purpose.
        </p>


        <label>
            Security
        </label>

        <p>
            We value your trust in providing us your personal information,thus we are striving to use commercially
            acceptable means of protecting it.But remember that no method of transmission over the internet or 
            method of electronic storage is 100% secure and reliable and we cannot guarantee its absoloute security. 
        </p>

        <label>
            Links to Other Sites
        </label>

        <p>
            Our website may contains links to other sites.If you click on a third party link,you will be directed to that site.
            Note that these external sites are not operated by us.Therefore we strongly advice you to review the privacy policy of these websites.
            We have no control over and assume no responsibility for the content,privacy policies or practices of any third party
            sites or services.
        </p>

        <label>
            Children's Privacy
        </label>

        <p>
            These services do not address anyone under the age 18.We do not knowingly collect personally identifiable
            information from individuals under 18.In the case we discover that a individual under 18 has provided us with 
            personal information we immediately delete this from our servers.If you are parent or guardian and you are aware that
            your children has provided us with personal information,please contact us so that we will be able to neccessary actions.
        </p>

        <label>
            Advertiesment Approval
        </label>

        <p>
            Whenever you setup an advertiesment and submit,it will be on hold in the admin panel for a breif 
            period of time.Your advertiesment will be reviewed by the admin before published.
            Admin has the full authority to disqualify and delete your advertiesment without any further notice
            by any means necessary if it  incorporates any inappropriate material. THERE WILL BE NO REFUNDS.
            Your Advertiesment will be disqualified if it incorporates one or more things listed below here.

            <ul>
                <li>Posting about vehicles,real states or any other things that directly does not relate to pets</li>
                <li>Illegal drugs medicine or pet related accessories</li>
                <li>Pornography</li>
                <li>Child related content(equipment media or any other) </li>
                <li>Weapons and Firearms</li>
                <li>Video games,movies,tv shows or any other media content</li>
                <li>Illegal pets or exotic animals</li>
                <li>When the photograph does not represent the topic or description</li>
                <li>When the photograph does not represent the actual item or pet</li>
                <li>If any of the topic or description contains hatespeech or racist comments</li>
                
            </ul>
            
        </p>

        <label>
            Validity period of an Advertiesment
        </label>

        <p>
            When an advertiesment is placed by a seller it will be reviewed by the admin.
            If the advertiesment is approved and published on the site it will be kept on the site for 30 days
            starting from the day it was published on the site.After that time period the advertiesment will be 
            expired and removed from the site without any further notice.If you wish to keep your advertiesment
            any longer than 30 days you will have to pay the full payment again.
        </p>

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
                <li>
                  <?php
                    if(isset($_SESSION['seller_id']))
                    {
                     echo "<a href=\"privacy_policy.php?seller_id=$seller_id\" >Privacy Policy</a>";
                    } 

                    else if(isset($_SESSION['user_id']))
                    {
                     echo "<a href=\"privacy_policy.php?user_id=$user_id\" >Privacy Policy</a>";
                    } 

                    else
                    {

                     echo "<a href=\"privacy_policy.php\">Privacy Policy</a>";

                     }

                   ?>     
                </li>
                <li>
                    <?php
                      if(isset($_SESSION['seller_id']))
                      {
                       echo "<a href=\"../pet database/pet_database.php?seller_id=$seller_id\">Pet Archive</a>";
                      } 

                      else if(isset($_SESSION['user_id']))
                      {
                       echo "<a href=\"../pet database/pet_database.php?user_id=$user_id\">Pet Archive</a>";
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