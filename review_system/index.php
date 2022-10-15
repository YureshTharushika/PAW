 <?php

 
?>


<!DOCTYPE html>
<html>
<head>
	
	
	<title>Dog selling web site</title>
	<link rel="stylesheet" type="text/css" href="deco.css">
	

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <!-- font awsome -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

     <style>
  /* Make the image fully responsive */

/*.success {background-color: #4CAF50;}  Green 
.success:hover {background-color: #46a049;}*/

body{
  background-image: url("images/cate/bg104.jpg");
  background-size:108%;

}

.social{
	display: inline;
	padding: 5%;
}

 .carousel-inner img {
 	padding: 0px 0px 30px;
 }

.food-search{
    background-color:#e3f2fd ;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    padding: 0% 3% 3%;
}

.food-search input[type="search"]{
    width: 50%;
    height: 30px;
    font-size: 1rem;
    border: none;
    border-radius: 7px;
}
 
 .category{
 	margin:70px 0;
 	
 }
 .small_category{
 	max-width: 1080px;
 	margin:auto;
 	padding: 10px;
 	padding-right: 25px;
 	padding-left: 77px;
 }

 .col-sm-6 {

 /	/*flex-basis: 20%;*/
 	min-width: 150px;
 	margin-bottom: 300px;


 }

  .col-sm-6  img{
  	width: 100%;
  	padding: 3px;
  	margin-left:10px;
  	margin-right: 80px;
  	transition: transform 0.5s;
    border:8px solid #00000010;

  }

  .title{
  
  	text-align: center;
  	margin:0 auto 80px;
    position: relative;
  	line-height: 60px;
  	color: #000000;


  }
  .title:after{

  	content: '';
  	background:#ff523b;
  	width: 80px;
  	height:5px;
  	border-radius: 5px;
  	position: absolute;
  	bottom: 0;
  	left: 50%;
  	transform: translateX(-50%);
  }
  h4{
  	font-weight: normal;
  	color: #555;

  }

  .col-sm-6 p{
  	font-size: 14px;

  }
  .rating .fa{
  	color: #ff523b;
  }

   .col-sm-6:hover {
   	transform:translateY(-5px); 


   }
.social ul{
    list-style-type: none;
}
.social ul li{
    display: inline;
    padding-left: 1%;
}
 
#sicon{
	font-family: cursive;
		color: blue;
	 font-style: italic;
	 padding: 8px;
	 font-weight:  bold;
	 font-color:red;
}

 #container{
  position: absolute;
  top:20%;
  left: 1%;
  transform: translateY(-50%, -50%);
  text-align: center;

}
#container h1{

  color: #fff;
  font-size: 36px;
  margin-bottom: 40px;


}
.button{

  background: #fff;
  padding 10px 15px;
  color:  #ffb3b3;
  font-weight: bolder;
  text-transform: uppercase;
  font-size: 18px;
  /*border-radius:5px;*/
 /*box-shadow: 6px 6px 29px -4px rgba(0,0,0,0.75);*/
 margin-top: 25px;
 text-decoration: none;
 /*transition: 0.4s;*/

}
.button:hover{

  background: #ffb3b3;
  color:#ffb3b3;

}
#popup{
  /*background: rgba(0,0,0,0.6);*/
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  display:none;
  justify-content: center;
  align-items: center;
  text-align: center;


}
#popup-content{

    height: 250px;
    width: 500px;
    background:  #B6B6B4;
    padding: 20px;
    border-radius: 5px;
    position: relative;


}



#close{
  position: absolute;
  top: -15px;
  right: -15px;
  background: #B6B6B4;
  height: 20px;
  width: 20px;
  border-radius: 50%;
  box-shadow:6px 6px 29px -4px rgba(0,0,0.75);
 cursor:pointer; 


}
/*input{

  margin:20px auto;
  display: block;
  width: 50%;
  padding: 8px;
  border: 1px solid gray;

}*/
 	 </style>
 
 

</head>
<body>


	<!-- header tag -->
	 <div class="Header">
	 	<!-- <h1>Dog online shopping wall</h1> -->


	 </div>




		<!-- navigation bar -->
<nav class="navbar navbar-light navbar-expand-lg" style="background-color: #e3f2fd; ">
  <div class="container-fluid">
  	<img src="images/main_icon/icon.jpeg" width="5%" height="5%">


  	<div id="scon">
    <a class="navbar-brand"  href="#" style="color:#000000;padding:30px;font-size: 30px; ">PAW.LK</a>
    </div>



     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
      
   	 <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
       		 <li class="nav-item">
          			<a class="nav-link active" aria-current="page" href="index.php">Home</a>
      		  </li>
        	  <li class="nav-item">
          			<a class="nav-link active" aria-current="page" href="About_Us.php">About Us</a>
        	  </li>
            

           

     <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Services
                    </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          	  <li><a class="dropdown-item" href="login.php">Place an ad</a></li>
              <li><a class="dropdown-item" href="seller_modify.php">Lost and Found</a></li>
              <li><a class="dropdown-item" href="admin/seller.php">Adopt a dog</a></li>
               <li><a class="dropdown-item" href="review/index.php
                ">Pet collection</a></li>
              <li><a class="dropdown-item" href="Contact_us.php">Questions</a></li>
               <li><a class="dropdown-item" href="payment/payment.php">Payment</a></li>
         	  </ul>
      </li>
          <li class="nav-item">

         
           </li>	
           <li>
           	<a class="nav-link" href="login.php">Login</a>
        	</li>
        	<li class="nav-item">
          		<a class="nav-link" href="Chatbox/ChatBox/index.php">Live chat</a>
      	   </li>     <!--signup finish  -->
          
     
  
    </ul>
    
    </div>
  </div>
</nav>  
						<!-- navigation bar end -->
							 <?php


           
              ?>


         

							<!-- search bar -->
  <section class="food-search text-center">
        <div class="container">
          <div class="row">
            <div class="col-9">
            <form name="search_form" method="POST" action="index.php" >
                <input type="search" name="search" placeholder="Search for Pets..." required>
                <input type="submit" name="submit" value="Search" class="btn btn-outline-success">
            </form>
              </div>
            <div class="col-4">

               <!-- <h3 class="card-title" style=" font-family:Jazz LET, fantasy;" > <?php echo $email ?></h3> -->
                 
              


            </div>
        </div>
        </div>
    </section>








				<!-- image tag -->
<div id="demo" class="carousel slide" data-ride="carousel">
  <ul class="carousel-indicators">
    <li data-target="images/4.jpg" data-slide-to="0" class="active"></li>
    <li data-target="images/5.jpg" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/10.jpg" alt="Los Angeles" width="100%" height="700">
      <div class="carousel-caption">
        <h3>Welcome</h3>
        <p>You can find any thing as you wish</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="images/23.jpg" alt="Chicago" width="100%" height="700">
      <div class="carousel-caption">
        <h3>Food item</h3>
        <p>See check this out!</p>
      </div>   
    </div>
    <div class="carousel-item">
      <img src="images/26.jpg" alt="New York" width="100%" height="700">
      <div class="carousel-caption">
        <h3></h3>
        <p></p>
      </div>   
    </div>
     <div class="carousel-item">
      <img src="images/12.jpg" alt="New York" width="100%" height="700">
      <div class="carousel-caption">
        <h3></h3>
        <p></p>
      </div>   
    </div>
  </div>
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>


 



					
 							<!--          products     ----->

							<div class="small_category">
				<div class="container-fluid" id="category">
    

         <div class="row">
                    
                        <div class="col-sm-3">
                          <table border="0">
                        <tr>
                        <th>test
                        </th>
                        </tr>
                          <tr>
                            <td>Select Foreign Agent Country</td>
                            <td></td>
                            <td>
                        <select>
                            <option value="US">United States</option>
                            <option value="AUD">Australia</option>
                            <option value="AUD">Australia</option>
                            <option value="AUD">Australia</option>
                            <option value="AUD">Australia</option>
                        </select> 
                            </td>
                          </tr>
                            <td>
                            <button type="submit"><a href="showDB.php">submit</a></button>
                            </td>

                        </table>

                        </div>

                  </div>

    <h2 class="title">Featured product</h2>
    <div class="row">
     
      

                     <div class="row">
     
             <!-- <a href="LinkToImage"> -->
            <?php

              $mysqli = new mysqli("localhost","root","","petshop");
              $mysqli = new PDO("mysql:host=localhost;dbname=petshop",'root','');
               
                if(isset($_POST['submit'])){
                $str = $_POST['search'];


                $result =("SELECT * FROM Advertisement INNER JOIN seller ON Advertisement.Seller_ID = seller.id;") or die($mysqli -> error);
                                           

              // $result = $mysqli ->query("SELECT * FROM  advertisement  WHERE Category like '%{$str}%'") or die($mysqli -> error);

               
           while($data = $result -> fetch())
             {
             ?>
                     <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">

                      
                       <img src="uploads/<?php echo $data['Image']  ?>"width='100%' height='58%' >

                     </div>

                  </div>
                        <div class="row">
                           <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">
                        <?php echo"<h4> {$data['Title']}</h4>";?>
                         <?php echo"<h5> {$data['Contact']}</h5>";?>
                           <?php echo"<h5> {$data['Price']}</h5>";?>
                            <?php echo"<h5> {$data['Details']}</h5>";?>

 
          
              
                
                         <div class="rating"> 
                             
                         
                   
                        <i class="fa fa-star"> </i>
                        <i class="fa fa-star"> </i> 
                        <i class="fa fa-star"> </i>
                        <i class="fa fa-star"> </i>
                        <i class="fa fa-star-o"></i>


                          </div>
                   
                  </div>
             </div><!-- </a>cmain di closing -->
      
                <?php
                      
                     } 

                   }else{


                      $result = $mysqli ->query("SELECT * FROM  advertisement ") or die($mysqli -> error);

               
           while($data = $result -> fetch())
             {
             ?>

                    <div class="row">
                       <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">
                           <img src="uploads/<?php echo $data['Image']  ?>"width='100%' height='58%' >
                      </div>
                       </div>

                    </div>
                    
                      
                        
                      
                      <div class="row">
                         <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">
                        <?php echo"<h4> {$data['Title']}</h4>";?>
                        <?php echo"<h5> {$data['Contact']}</h5>";?>
                        <?php echo"<h5> {$data['Price']}</h5>";?>
                      

                           
                     
             <div class="rating"> 
                        <i class="fa fa-star"> </i>
                        <i class="fa fa-star"> </i> 
                        <i class="fa fa-star"> </i>
                        <i class="fa fa-star"> </i>
                        <i class="fa fa-star-o"></i>
                        <!-- ======================================= -->
                           <!--   <div class="row"> 
 
            
                       
                            <div id="container" >

                            <h1>Give us your valueble review</h1>

                              <a href="#" class="" id="button">Review</a>



                    
                          <div id="popup">
                            
                              <div id="popup-content">
                                  <img src="close.jpg" alt="close" id="close">

                                   <form action="login.php" method="post">
 
                                        <div>
                                            <h3> Rating System</h3>
                                        </div>
                                     
                                        <div>
                                             <label>Email</label>
                                            <input type="text" name="name">
                                       
                                             <div class="rateyo" id= "rating"
                                             data-rateyo-rating="4"
                                             data-rateyo-num-stars="5"
                                             data-rateyo-score="3">
                                             </div>
                                     
                                        <span class='result'>0</span>
                                        <input type="hidden" name="rating">
                                     
                                       
                                     
                                        <input type="submit" name="add"> 
                                      
                                        
                                     </div>
                                       <a href="" class="button">Review</a>
                                    </form>

                              </div>

                           </div>

                        


                          </div>
                         </div>
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
                   
                   <script type="text/javascript">
                     

                      document.getElementById("button").addEventListener("click", function(){

                        document.querySelector("#popup").style.display = "flex";
                      })

                      document.querySelector("#close").addEventListener("click",function(){

                        document.querySelector("#popup").style.display ="none";



                      })
                   </script>
                    </div>

                      
    
             </div> -->

                        <!-- ======================================= -->

                    </div>

      <!-- </a> -->
            </div>
       </div>
                <?php
                      
                     } 




                   } 
              ?>
               
       
        <div class=" col-lg-3 ">
      
            <img style="width: 100%; height: 90%; border:8px solid #00000010;" alt="AltText" src="images/cate/cat2.jpg" class="img-responsive">
   
        	  <h4> Leather dog coller</h4>
        	   <p>&50.00</p>
        	  						<a href=""> </a>
									  <div class="rating"> 
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>	
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star-o"></i>

									  </div>

        </div>

      

        <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">
        <a href="LinkToImage">
            <img style="width: 100%; height: 90%; border:8px solid #00000010;" alt="AltText"src="images/cate/cat3.jpg" class="img-responsive">
        </a>
        					 <h4> Leather dog coller</h4>
        					  <p>&50.00</p>
        	  						<a href=""> </a>
									  <div class="rating"> 
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>	
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star-o"></i>

									  </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">
        <a href="LinkToImage">
            <img style="width: 100%; height: 90%; border:8px solid #00000010;" alt="AltText" src="images/cate/cat4.jpg" class="img-responsive">
        </a>

        				 <h4> Leather dog coller</h4>
        				  <p>&50.00</p>
        	  						<a href=""> </a>
									  <div class="rating"> 
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>	
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star-o"></i>

									  </div>
        </div>


    			<!--                 Latest Products                       -->
    			

    			<h2 class="title">Latest product</h2>
    			<div class="row">
        <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">
        <a href="LinkToImage">
            <img style="width: 100%; height: 90%; border:8px solid #00000010;" alt="AltText" src="images/cate/cat9.jpg" class="img-responsive">

        </a>

        		 <h4> Leather dog coller</h4>
        		 <p>&50.00</p>
        	  						<a href=""> </a>
									  <div class="rating"> 
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>	
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star-o"></i>

									  </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">
        <a href="LinkToImage">
            <img style="width: 100%; height: 90%; border:8px solid #00000010;" alt="AltText" src="images/cate/cat8.jpg" class="img-responsive">
        </a>
        	  <h4> Leather dog coller</h4>
        	   <p>&50.00</p>
        	  						<a href=""> </a>
									  <div class="rating"> 
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>	
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star-o"></i>

									  </div>

        </div>

        <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">
        <a href="LinkToImage">
            <img style="width: 100%; height: 90%; border:8px solid #00000010;" alt="AltText"src="images/cate/cat10.jpg" class="img-responsive">
        </a>
        					 <h4> Leather dog coller</h4>
        					  <p>&50.00</p>
        	  						<a href=""> </a>
									  <div class="rating"> 
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>	
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star-o"></i>

									  </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">
        <a href="LinkToImage">
            <img style="width: 100%; height: 90%; border:8px solid #00000010;" alt="AltText" src="images/cate/cat12.jpg" class="img-responsive">
        </a>

        				 <h4> Leather dog coller</h4>
        				  <p>&50.00</p>
        	  						<a href=""> </a>
									  <div class="rating"> 
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>	
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star-o"></i>

									  </div>
        </div>




        <!-----------------------    new row------------------- -->
        	<div class="row">
        <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">
        <a href="LinkToImage">
            <img style="width: 100%; height: 90%; border:8px solid #00000010;" alt="AltText" src="images/cate/cat13.jpg" class="img-responsive">

        </a>

        		 <h4> Leather dog coller</h4>
        		 <p>&50.00</p>
        	  						<a href=""> </a>
									  <div class="rating"> 
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>	
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star-o"></i>

									  </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">
        <a href="LinkToImage">
            <img style="width: 100%; height: 90%; border:8px solid #00000010;" alt="AltText" src="images/cate/cat14.jpg" class="img-responsive">
        </a>
        	  <h4> Leather dog coller</h4>
        	   <p>&50.00</p>
        	  						<a href=""> </a>
									  <div class="rating"> 
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>	
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star-o"></i>

									  </div>

        </div>

        <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">
        <a href="LinkToImage">
            <img style="width: 100%; height: 90%; border:8px solid #00000010;" alt="AltText"src="images/cate/cat15.jpg" class="img-responsive">
        </a>
        					 <h4> Leather dog coller</h4>
        					  <p>&50.00</p>
        	  						<a href=""> </a>
									  <div class="rating"> 
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>	
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star-o"></i>

									  </div>
        </div>

        <div class="col-sm-6 col-md-4 col-lg-3 col-xs-12">
        <a href="LinkToImage">
            <img style="width: 100%; height: 90%; border:8px solid #00000010;" alt="AltText" src="images/cate/cat16.jpg" class="img-responsive">
        </a>

        				 <h4> Leather dog coller</h4>
        				  <p>&50.00</p>
        	  						<a href=""> </a>
									  <div class="rating"> 
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>	
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star"> </i>
									  		<i class="fa fa-star-o"></i>

									  </div>
        </div>







  </div><!---Latest product  row tag----->
</div><!--- Featured product row tag----->
</div><!---container fulid tag----->
</div><!---small category tag----->	






<br>

<br>

<br>
	 <!-- image tag -->
	<div class="image my-5">
		
		<h2 class="text-center fw-light"><b>About Us<b></h2>
		

	</div>
	
	<div class="container-fluid my-3">
			 <div class="row">
			 		<div class="col-6">
			 			<img src="images/14.jpg" alt="nature" style="width:80%; height: 100%;">

			 		</div>
			 		<div class=" col-6">
			 			
			 		<p>	Dogs noses are wet to help absorb scent chemicals. ...
						Newfoundlands are amazing lifeguards. ...
						The Beatles song 'A Day in the Life' has a frequency only dogs can hear. ...
						Three dogs survived the Titanic sinking. ...
						A Bloodhound's sense of smell can be used as evidence in court.
					</p>
						
					<!-- for more details -->
						<form action="About_Us.php">
							<input type="submit" class="btn btn-outline-success"    value="For more details"name="">
							</button>
						
						</form>
			 		</div>

			 </div>
			 <!-- Services -->
			 <section>
			 <div class="image my-5">
		
		<h2 class="text-center fw-light my-5">Services</h2>

					<!-- for more services-->
						<!-- Example single danger button -->
					<div class="text-center">
					<div class="btn-group button al">
  					<button type="button" class="btn btn-Secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    					Action
  					</button>
  			<ul class="dropdown-menu">
    				<li><a class="dropdown-item" href="#">Choose your dog</a></li>
            	  <li><a class="dropdown-item" href="userprofile.php">Place an ad</a></li>
              <li><a class="dropdown-item" href="#">Lost and Found</a></li>
              <li><a class="dropdown-item" href="#">Adopt a dog</a></li>
               <li><a class="dropdown-item" href="#">Pet collection</a></li>
              <li><a class="dropdown-item" href="Contact_us.php">Questions</a></li>




          	 
            <!-- <li><hr class="dropdown-divider"></li> -->
            <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
          </ul>
  				</div>
  				</div>

 				 </div>									
			</section>
		

						


























									<!--  footer-->
	

 <!-- <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section> -->
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
   <!--  <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">UWU</a></p>
        </div>
    </section> -->
</body>
</html>