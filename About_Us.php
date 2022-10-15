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
  
  
  <title>About Us</title>
  <link rel="stylesheet" type="text/css" href="css/about_us.css">
  <link rel="shortcut icon" href="images/login_page/shortcut.png">
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/52bfdd00c0.js" crossorigin="anonymous"></script>

    <!-- font awsome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">







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
<!-- About Us -->

 <div class="about-section">
  <label>About Us</label><br>
  <h1>Welcome to  PAW.LK Pet Advertising Website!</h1><br>
  <h2>The Best Solution for All Your Pet Related Needs!</h2>
</div><!--about-section End-->



    <div class="para">
    <p> <b style="font-size: 36px;">S</b>ince you're currently visiting our website, we can assume that you're either looking to buy a new pet or advertise one for sale. Perhaps your dog or cat just gave birth to a litter and you're looking to sell those puppies or kittens.Maybe you just want to hang out and browse some of the pet forums. Whatever the reason you're here,<b> we welcome you and hope that you'll find value in our website.</b> Many of our members have expressed to us how pleased they've been with our advertising system.Our most popular categories are dogs, cats, puppies and kittens.Through the years, hundred of visitors have perused our pages with the intent of buying and selling their pets.  Seller who will order the advertisement to be published in our site can also provide pet-related products information to this website in order to expand their marketing reach.If you'd like to get involved too, all you need to do is register for an account, or if you already have one, log in.</p> <br>



    <br>




    <h1 style="color:    #2874a6  ;">The Best Marketplace for Buying and Selling Pets </h1>

    <p>Buying and selling pets can be tough and end up costing you more money than it should. Sellers want to use cost-effective sources to demonstrate how awesome the pets are they are offering. Potential owners want to find the local sources for the specific type of pet they really want. PAW.lk brings the best features to buyers and sellers in one site. 
    </p> 
    </div><!--para End-->





<div class="tiles">
  <div class="column2">
    <div class="card1">
        <h1 style="color:  #2874a6 ;">Find Local Buyers for Your Pet </h1>
        <p>Whether you have one pet to sell or are a professional breeder you want a way to get your pets out in the local community. 
          Local pet sales are easier on both the owner and pet. It reduces the stress involved in traveling with pets. 
          You are guaranteed to make contact with larger numbers of individuals serious about finding the pets you have to offer. 
          Using PAW.LK is the simplest solution to finding the best home for your pet.
        </p> <br>
        
      </div><!--card1 End-->
    </div><!--column2 End-->
  



    <div class="column2">
      <div class="card1">
          <h1 style="color:  #2874a6 ;">Place Pet Ads at Affordable Cost</h1>

          <p>The cost of advertising your pets locally and through nationwide venues can strain your budget. 
            Newspapers and local publications can be the most costly of all choices.Also they are not effective in current market field either. 
            You can post information about your pets on law cost that are read by people interested in taking the next step in pet ownership.
            Choose one that is specialized to the pet market.
          </p> <br>

          
        </div><!--card1 End-->
      </div><!--column2 End-->
  



        <div class="column2">
          <div class="card1">
              <h1 style="color:  #2874a6 ;">Quickly Find Local Pets for Sale</h1>

              <p>Our site is priceless when you are looking for a specific type of dogs and cats. 
                Rather than pouring through a pet category you can choose from categories that separate the different types of dogs and cats. 
                You won’t have to look over tons of dog posts to find the specific type you want to purchase. 
                Find the desired pet, accessories or as close to your location with affordable prices as soon as possible. 
              </p>

            </div><!--card1 End-->
          </div><!--column2 End-->
  </div><!--row End-->











  
   


    <div class="about-section">
      <h1>Why PAW.lk is Best?</h1><br>
      <p>While we do require administrator approval for every ad that's posted, all ads are generally approved within short time with about 95% of members having to wait no more than a hour. The reason we require approval is to screen the ads that are placed. For each ad, we perform various checks that we've deemed to be the most important throughout the years. We know how to keep our website clean and clear of fraudulent advertisements.As long as you behave and don't spam our website, we'll allow you to post as many ads as you wish. We have no limits here. We may suggest how to best consolidate ads and a few other things from time to time, but as long our ads are clean, honest and of quality, we'll allow you to post as you please. 
    </p><br>
      <p>Join with  PAW.LK Online Pet Advertsing Platform to Post Your Ads Today!</p>
    </div><!--about-section End-->


<br><br>

<h1 style="text-align:center; color:  #2874a6 ;">Our Team</h1>
<div class="admin_pics">
  
    <div class="card">
      <img src="images/about_us/admin1.jpg">
      <div class="container">
        <h2>M.G.S.I.Sewwandi</h2>
        <p class="title">Undergraduate Student of UWU</p>
        <p>mgsimasha1@gmail.com</p><br>
        
      </div><!--container End -->
    </div><!--card End -->
 
  
    <div class="card">
      <img src="images/about_us/admin2.jpeg">
      <div class="container">
        <h2>R.M.R.S.C.Kumara </h2>
        <p class="title">Undergraduate Student of UWU</p>
        <p>rajithasck@gmail.com</p><br>
      </div><!--container End -->
    </div><!--card End -->
  

 
    <div class="card">
      <img src="images/about_us/admin3.jpg">
      <div class="container">
        <h2>K.Y.T.Dilshan</h2>
        <p class="title">Undergraduate Student of UWU</p>
        <p>yureshtharushike@gmail.com</p><br>
      </div><!--container End -->
    </div><!--card End -->
 

  
    <div class="card">
      <img src="images/about_us/admin4.jpeg">
      <div class="container">
        <h2>C.J.M.H.Bandara</h2>
        <p class="title">Undergraduate student of UWU</p>
       
        <p>chathurajmhb7@gmail.com</p><br>
      </div><!--container End -->
    </div><!--card End -->
 
</div><!--admin_pics End -->
  


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