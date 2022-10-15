
<?php
	
	  include("../login_function.php");
	  
	 //  session_start();


	 //  $seller_id = $_SESSION['seller_id'];
	 //  	if(!$_SESSION['seller_id']){

		// 	header("location:index.php");

		// }

require 'db_connection.php';
	// retriving the data to te database
		
	// $query = "SELECT * FROM rating ";
   $query = "SELECT rating.Email, rating.Rate,seller.FirstName
      FROM   rating,seller " ;

	$result = mysqli_query($conn,$query);

	$sID = "";




if ($_SERVER["REQUEST_METHOD"] == "POST"){
	 
   // getting seller total

	$sID = $_POST['id'];
    $name = $_POST["name"];
    $rating = $_POST["rating"];




if(!(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i" ,$name)))
{


    echo "<script> alert('Invalid Email.!')</script>";
}else{
    // Return Success - Valid Email






    $query1 = "SELECT * FROM rating WHERE Email='$name' WHERE SellerId = $sID";
   

			$result_set1 = mysqli_query($conn, $query1);
		
  		
  			if(mysqli_num_rows($result_set1) == 1)
  			{
  				 echo "<script> alert('Use another Email.!')</script>";
  				
  			}
  		else{
 
    $sql = "INSERT INTO rating (Email,Rate,SellerId) VALUES ('$name','$rating','$sID');";

    if (mysqli_query($conn, $sql))
    {
        // echo "New Rate added successfully";
       // echo "$name";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    // mysqli_close($conn);
}
}
}else{

	$sID = $_GET['id'];
}

// require 'db_connection.php';




$query = "SELECT SUM(Rate) AS 'sumrate' FROM rating WHERE SellerId = $sID";


$res = mysqli_query($conn,$query);
echo mysqli_error($conn);
$data = mysqli_fetch_array($res);



	
//$sqk = "SELECT COUNT(SellerId) FROM rating WHERE SellerId = $sID";
$sqk = "SELECT COUNT(SellerId) As total FROM rating WHERE SellerId = $sID";

$res2 = mysqli_query($conn,$sqk);
echo mysqli_error($conn);
$data2 = mysqli_fetch_array($res2);



	
?>






<!DOCTYPE html>
<html>
<head>
	<title>Rating</title>
	<!-- ===========      Rating   ======= -->






  <link rel="stylesheet" href="../css/review.css">
  <link rel="shortcut icon" href="../images/login_page/shortcut.png">





    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">


	<!-- ==================== -->

  
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  

		
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

   

    <!-- font awsome -->
    
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
                          echo "<a href=\"..\index.php\">Home</a>";
                        }

                        else if(isset($_SESSION['seller_id']))
                        {
                          echo "<a href=\"..\index.php?seller_id=$seller_id\">Home</a>";
                        }

                        else if(isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"..\index.php?user_id=$user_id\">Home</a>";
                        }

                  ?>
              </li>

              <li >

                  <?php

                         
                        if(!isset($_SESSION['seller_id']) AND !isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"..\About_Us.php\">About Us</a>";
                        }

                        else if(isset($_SESSION['seller_id']))
                        {
                          echo "<a href=\"..\About_Us.php?seller_id=$seller_id\">About Us</a>";
                        }

                        else if(isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"..\About_Us.php?user_id=$user_id\">About Us</a>";
                        }

                      ?>
                </li>
            
          
                  

                
                <li>
                    <?php
                      if(isset($_SESSION['seller_id']))
                      {
                        echo "<a href=\"..\pet database/pet_database.php?seller_id=$seller_id\" >Pet Archive</a>";
                      } 

                      else if(isset($_SESSION['user_id']))
                      {
                        echo "<a href=\"..\pet database/pet_database.php?user_id=$user_id\" >Pet Archive</a>";
                      } 

                      else
                      {

                        echo "<a href=\"..\pet database/pet_database.php\">Pet Archive</a>";

                      }

                    ?>
                </li>
                
                <li>
                      <?php

                        //if(!isset($_SESSION['user_id']) || !isset($_SESSION['seller_id'])) 
                        if(!isset($_SESSION['seller_id']) AND !isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"..\login.php\">Login</a>";
                        }

                        else if(isset($_SESSION['seller_id']))
                        {
                          echo "<a href=\"..\logout.php\">Log Out</a>";
                        }  

                        else if(isset($_SESSION['user_id']))
                        {
                          echo "<a href=\"..\logout.php\">Log Out</a>";
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

    <div class="full-page"> 
            
 


			<div class="container" style="padding-bottom: 50px; margin-bottom: 80px; border-radius:20px; padding-right: 50px; padding-left: 50px;">
				
				<h1 class="mt-5 mb-5" style="padding-top: 20px; padding-left: 20px;">USER WITH RATING SYSTEM</h1>
				<div class="card" style="padding-top: 50px; padding-bottom: 80px;border-radius: 15px;">
					<div class="card-reader">
						
						<div class="class-body">
							<div class="row">
								<div class="col-sm-4 text-center">
									
									<h1 class="text-warning mt-4 ">
										<b><span id="average_rating"><?php echo round($data['sumrate'] / $data2['total'],1) ?></span>/ 5</b></h1>
										<div class="m-3">
                       							<i class="fa fa-star"> </i>
							                    <i class="fa fa-star"> </i>
						                        <i class="fa fa-star"> </i> 
						                        <i class="fa fa-star"> </i>	
						                        <i class="fa fa-star-o"></i>
											
										</div>
										<h3><span id="total_review"><?php echo $data['sumrate']; ?> </span>Review</h3>
									
								</div>
								
								<div class="col-sm-4 text-center">
									
									<h1 class="mt-4 mb-3">Put a Review Here</h1>
									<button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
								</div> 
							</div>
						</div>
					</div>
					<div class="mt-5" id="review_content"></div> 
				</div>
			

			</div>
						<hr><br><br>


							<?php

						$resultCheck = mysqli_num_rows($result);
						 if($resultCheck > 0){

					       while($row = mysqli_fetch_assoc($result)){
					       	?>
					        
					        <div class="container" style="background-color:  #fbfbfb; border-radius: 20px;">
					  <div class="brand-logo" style="padding-top: 20px;"><img src="6.jpg"></div>
					  
					  <div class="sec">
					    <div class="sec1"><h4> <?php echo $row['Email'];?></h4></div>
					    <div class="sec2">
					    	<div><?php echo $row['Rate'];?></div>
					    <div ><?php  echo $row['FirstName'];?></div></div>
					    <div style="text-align: right; padding-bottom: 10px;padding-right: 10px;"></div>
					  </div>
					</div> 
					<?php 
						}

						}else{
						echo "wrong fetaching";
					}
					?>	
				
    <br><br>
             

                     
		
</body>
</html>


<script type="text/javascript">
	
	$(document).ready(function(){ 

var rating_data =0;
$('#add_review').click(function(){
	$('#review_modal').modal('show');

});

	
	});

	
</script>

<div id="review_modal" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
<div class="container" id="" style="margin-bottom: 2px; margin-top: 2px;">
  <div class="row">
 
<form action="index.php" method="post">
 
    <div style="padding-top:  15px;">
        <h3>Rating System</h3>
    </div>
 
    <div>
         <h5>Email</h5>
        <input type="text" name="name">
    </div>
 
         <div class="rateyo" id= "rating"
         data-rateyo-rating="4"
         data-rateyo-num-stars="5"
         data-rateyo-score="3">
         </div>

 
    <span class='result'>0</span>
    <input type="hidden" name="rating">
    <input type="hidden" value="<?php echo $sID ?>" name="id" >
 
    </div>
 
    <div class="submit-btn"><input type="submit" name="add"> </div>
 
</form>
</div>
</div>
</div>
</div>
</div>

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







<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
 
<script>
 
 
    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });
 
</script>
</body>
 
</html>
