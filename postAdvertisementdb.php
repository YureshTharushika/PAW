<?php 

        
	
	$server ="localhost";
	$user  	= "root";
	$password ="";
	$database ="petshop";


	$con = mysqli_connect($server,$user,$password,$database);

	if(!$con){

		echo "Error";
}
else{

	//echo"database connect sucessfully";
}

// -------------       normal advertisement phtos adding       -----------------

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["Image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
       
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["Image"]["tmp_name"]);
        if($check !== false) {
          //  echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        }

        if (move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file)) {
            // echo  htmlspecialchars( basename( $_FILES["Image"]["name"]));
          } else {
            echo "Sorry, there was an error uploading your file.";
          }




     

                  

	

	if(isset($_POST['upload'])){

		
	
		    $Category =	$_POST['category'];
			$Title    =	$_POST['title'];
			$Details  =	$_POST['description'];
			$Location = $_POST['location'];
			$Adprice  = $_POST['price'];
			$Contact  = $_POST['contact'];
			$Image    = $_FILES["Image"]["name"];
		
	
      
      $seller_id = $_SESSION['seller_id'];

      if( $Category =='pets'){
		$sql = "INSERT INTO advertisement (Category,Title,Details,Location,Price,Contact,Image,PostedAt,PublishedAt,SellerId,IsApproved,IsDeleted,Payment) VALUES ('$Category','$Title','$Details','$Location','$Adprice','$Contact','$Image',NOW(),'0000-00-00 00:00:00','{$_SESSION['seller_id']}','false',0,1000)";
		
        
				$result= mysqli_query($con,$sql);
				if($result){

					

					 $query = "SELECT * FROM advertisement WHERE IsDeleted=0 ORDER BY AddId";
       
                       $advertisements = mysqli_query($con,$query);

                      if($advertisements)
                      {
       	                while($add = mysqli_fetch_assoc($advertisements))
       	                {
       	 	               $add_id = $add['AddId'];
       	 	              

       	 	            }
                      }

					
       	 	         header("location: payment/payment.php?add_id=$add_id&&seller_id=$seller_id");
       	               

					
					
				}
				else{
					header('location:index.php');
				}

		}
		else if($Category =='accessories'){	

			$sql = "INSERT INTO advertisement (Category,Title,Details,Location,Price,Contact,Image,PostedAt,PublishedAt,SellerId,IsApproved,IsDeleted,Payment) VALUES ('$Category','$Title','$Details','$Location','$Adprice','$Contact','$Image',NOW(),'0000-00-00 00:00:00','{$_SESSION['seller_id']}','false',0,600)";
		
        
				$result= mysqli_query($con,$sql);

				if($result){

					 $query = "SELECT * FROM advertisement WHERE IsDeleted=0 ORDER BY AddId";
       
                       $advertisements = mysqli_query($con,$query);

                      if($advertisements)
                      {
       	                while($add = mysqli_fetch_assoc($advertisements))
       	                {
       	 	               $add_id = $add['AddId'];
       	 	              

       	 	            }
                      }

					
       	 	         header("location: payment/payment.php?add_id=$add_id&&seller_id=$seller_id");
       	               

					
					
				}
				else{
					header('location:index.php');
				}

		}
		else if($Category =='food items'){	

			$sql = "INSERT INTO advertisement (Category,Title,Details,Location,Price,Contact,Image,PostedAt,PublishedAt,SellerId,IsApproved,IsDeleted,Payment) VALUES ('$Category','$Title','$Details','$Location','$Adprice','$Contact','$Image',NOW(),'0000-00-00 00:00:00','{$_SESSION['seller_id']}','false',0,800)";
		
        
				$result= mysqli_query($con,$sql);
				if($result){

					 $query = "SELECT * FROM advertisement WHERE IsDeleted=0 ORDER BY AddId";
       
                       $advertisements = mysqli_query($con,$query);

                      if($advertisements)
                      {
       	                while($add = mysqli_fetch_assoc($advertisements))
       	                {
       	 	               $add_id = $add['AddId'];
       	 	              

       	 	            }
                      }

					
       	 	         header("location: payment/payment.php?add_id=$add_id&&seller_id=$seller_id");
       	               

					
					
				}
				else{
					header('location:index.php');
				}

		}
				else if($Category =='medicines'){	


					$sql = "INSERT INTO advertisement (Category,Title,Details,Location,Price,Contact,Image,PostedAt,PublishedAt,SellerId,IsApproved,IsDeleted,Payment) VALUES ('$Category','$Title','$Details','$Location','$Adprice','$Contact','$Image',NOW(),'0000-00-00 00:00:00','{$_SESSION['seller_id']}','false',0,400)";
		
        
				$result= mysqli_query($con,$sql);
				if($result){

					 $query = "SELECT * FROM advertisement WHERE IsDeleted=0 ORDER BY AddId";
       
                       $advertisements = mysqli_query($con,$query);

                      if($advertisements)
                      {
       	                while($add = mysqli_fetch_assoc($advertisements))
       	                {
       	 	               $add_id = $add['AddId'];
       	 	              

       	 	            }
                      }

					
       	 	         header("location: payment/payment.php?add_id=$add_id&&seller_id=$seller_id");
       	               

					
					
				}
				else{
					header('location:index.php');
				}

		}
	}
}


 ?>
