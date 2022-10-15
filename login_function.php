

<?php 
						use \PHPMailer\PHPMailer\PHPMailer;
						use \PHPMailer\PHPMailer\SMTP;
						use \PHPMailer\PHPMailer\Exception;
						
					
// ++++++++++++++++++++++++++++===register function+++++++++++++++++++++++++++++++=
	
	function emptyInputSignup($FirstName,$LastName,$Email,$Location,$pass,$cpassword){
		$result;
		if(empty($FirstName)||empty($LastName)||empty($Email)||empty($Location)||empty($password)||empty($cpassword)){
			$result= true;
			
		}
		else
		{
			$result= false;
		}
		return $result;
	}



		function invalidUid($FirstName){
		$result;
		if(!preg_match("/^[a-zA-Z0-9]*$/",$FirstName,$LastName)){
			$result= true;
		}
		else
		{
			$result= false;
		}
		return $result;
	}

		function invalidEmail($Email){
		$result;
		if(!filter_var($Email,FILTER_VALIDATE_EMAIL)){
			$result= true;
		}
		else
		{
			$result= false;
		}
		return $result;
	}


		function pwdMatch($pass,$cpassword){
		$result;
		if($pass!==$cpassword){
			$result= true;
		}

		else
		{
			$result= false;
		}
		return $result;
	}



	

		

		function uidExist($conn,$FirstName,$Email){
		$result;
			$sql = "SELECT * FROM seller WHERE FirstName = ? OR Email =?;";
			$stmt = mysqli_stmt_init($conn);

			if(!mysqli_stmt_prepare($stmt,$sql)){
					header("location:index.php?error=stmtfailed");
					exit();

			}
		
		mysqli_stmt_bind_param($stmt ,"ss",$FirstName,$Email);	
		
		mysqli_stmt_execute($stmt);
		$resultDate = mysqli_stmt_get_result($stmt);


		if($row =mysqli_fetch_assoc($resultDate)){

				return $row;


		}else{
			$result = false;
			return $result;
		}

			mysqli_stmt_close($stmt);
		}

			

			function  createUser($conn,$FirstName,$LastName,$Email,$Location,$cpassword,$UserRole,$VerificationCode){

		$result;



			 $sql = "INSERT INTO seller (FirstName,LastName,Email,Location,password,Userrole,VerificationCode) VALUES (?,?,?,?,?,?,?);";

		


			$stmt = mysqli_stmt_init($conn);

			if(!mysqli_stmt_prepare($stmt,$sql)){
					header("location:login.php?error=stmtfailed");
					exit(); 

			}



	  		
		
			 $VerificationCode = sha1($Email . time());
        $verification_url = 'http://localhost:8080/campus_project.php/verify.php?code='.$VerificationCode;


						//Load Composer's autoloader
						require 'email_verification/vendor/autoload.php';
						require 'email_verification/vendor/phpmailer/phpmailer/src/SMTP.php';
						require 'email_verification/vendor/phpmailer/phpmailer/src/Exception.php';

					

						//Create an instance; passing `true` enables exceptions
						$mail = new PHPMailer(true);

						try {
						    //Server settings
						  //  $mail->SMTPDebug = 1;                      //Enable verbose debug output
						    $mail->isSMTP();                                            //Send using SMTP
						    $mail->Host       = "smtp.gmail.com";                     //Set the SMTP server to send through
						    $mail->SMTPAuth   = true;     
						                                  //Enable SMTP authentication
						    $mail->Username   = 'paw.lk.help@gmail.com';                     //SMTP username
						    $mail->Password   = 'Paw.lk2021';
						   // $mail->addReplyTo('rajithasck@gmail.com', 'rajitha');                               //SMTP password
						    $mail->SMTPSecure = 'tsl';            //Enable implicit TLS encryption
						    $mail->Port       = 587;             //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

						  
						    $mail->setFrom('paw.lk.help@gmail.com','Paw.lk');
						    $mail->addAddress($Email);     //Add a recipient



						    $body = $verification_url;
						   // $body = 'Thank you .<br> Paw.lk';

						    //Content
						    $mail->isHTML(true);                                  //Set email format to HTML
						    $mail->Subject = 'Email verification';
						    $mail->Body    =  $body;
						    $mail->AltBody = strip_tags($body);

						    $mail->send();
						   $errors[] = 'Check your emails';
	
						    // echo 'Please check your email';
						} catch (Exception $e) {
						    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
						     $status ='<p> class="error">check your email</p>';
						      
						}



				// $hashedPwd = password_hash($cpassword, PASSWORD_DEFAULT );
						$hashedPwd = sha1($cpassword);

		
		mysqli_stmt_bind_param($stmt ,"sssssss",$FirstName,$LastName,$Email,$Location,$hashedPwd,$UserRole,$VerificationCode);	
		
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		 session_start();
			
			 $_SESSION['name'] = $FirstName;


				 echo "<script>alert('Check your Emails.!')</script>";
				//header("location:index.php");			    
				$status ='<p> class="success">check your email</p>';
		exit();	
	}


// +++++++++++++++++++++++++++++login function+++++++++++++++++++++++++++++++

	function emptyInputlogin($email,$pass){
		$result;
		if(empty($email)||empty($pass)){
			$result= true;
			
		}
		else
		{
			$result= false;
		}
		return $result;
	}

	
	function loginUser($conn,$email,$pass){

		$uidExist = uidExist($conn,$email,$pass);

		if(!$uidExist === false)
		{

			header('location:login.php?error=Wronglogin');
			exit();
		}
		else
		{
			//echo "$pass";
		}

		

	$sql = "SELECT * FROM seller WHERE Email = ?";
			$stmt = mysqli_stmt_init($conn);
			mysqli_stmt_prepare($stmt, $sql);


			mysqli_stmt_bind_param($stmt,'s',$email);

			
			mysqli_stmt_execute($stmt);
			
			$result = mysqli_stmt_get_result($stmt);
			
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);


	
			if(!empty($row))
			{
				
					 if($row['IsActive']==true){	
					
					// if( password_verify($pass, $row['Password']))
					// {
							$hashed_password = sha1($pass);
			$query = "SELECT * FROM seller WHERE Email='$email' AND Password='$hashed_password' AND IsDeleted=0";
			$result_set1 = mysqli_query($conn, $query);

			
			
				
			
		
  		
  			if(mysqli_num_rows($result_set1) == 1)
  			{

							        $email_id  =$row['Email'];
									$seller_id =$row['ID'];
			 			 			$password  =$row['Password'];
			 			 			$Fname     =$row['FirstName'];
			 			 			$Lname     =$row['LastName'];
			 			 			$location  =$row['Location'];

			 			 			
							
									 session_start();
									   $_SESSION['seller_id'] = $seller_id;
									   $_SESSION['email_id']  = $email_id;
									   $_SESSION['Fname']     = $Fname;
									   $_SESSION['Lname']     = $Lname;
									   $_SESSION['location']  = $location;

									
									$query3 = "UPDATE seller SET LastLogIn = NOW() WHERE ID={$_SESSION['seller_id']} LIMIT 1";

    		                        $result_set3 = mysqli_query($conn, $query3);
									    
									header('location:index.php?seller_id=' . $_SESSION['seller_id']);
								
						
						exit();
							
					
						}
						else
					{
						
						 header("location:login.php?erro=verifyyourPassword");
						// echo "<script> alert('Wrong password.')</script>";
							 exit();
			}			
							
				
					
					}

					
		
		}			

		else
		{

			//	header("location: login.php?error=rowisempty");

				

						// session_start();	

		
			$hashed_password = sha1($pass);

			 
            require_once("inc/connection.php"); 

            

		$query1 = "SELECT * FROM admin WHERE Email='$email' AND Password='$hashed_password' AND UserRole = 'Admin' LIMIT 1";
			$result_set1 = mysqli_query($connect, $query1);
		
  		if($result_set1)
  		{
  			if(mysqli_num_rows($result_set1) == 1)
  			{
  				session_start();
    			$user = mysqli_fetch_assoc($result_set1);
    			$_SESSION['user_id'] = $user['ID'];
    			$_SESSION['first_name'] = $user['FirstName'];

    			$query3 = "UPDATE admin SET LastLogIn = NOW() WHERE ID={$_SESSION['user_id']} LIMIT 1";

    			$result_set3 = mysqli_query($connect, $query3);

    			if(!$result_set1)
    			{
    				die('Database query Failed.');
    			}

    			
    			if($result_set1)
    			{
    				header('Location: index.php?user_id=' . $_SESSION['user_id']);
    			}
    					


  			}

  			else
  			{
    				 header("location:login.php?erro=verifyyourEmail");
    			// echo "<script> alert('Wrong password.')</script>";
    			$errors[] = 'Invalid Username / Password';
  			}
    			
  		}

  		else
  		{
  			//echo "error";
  			$errors[] = 'Database Query Failed';
  		}


  		
	

				exit();
	}			


}

 ?>