<?php 

	if(isset($_POST['login'])){
		
		$email= $_POST['email'];
		$pass = $_POST['password'];

		require_once 'registerpage.php';
		require_once 'login_function.php';

		 if(emptyInputlogin($email,$pass) !== false){

            header("location:login.php?error=emptyinput");
		 
            exit();
        }


        loginUser($conn ,$email ,$pass);

			
		 header('location:login.php');
		exit();
	}

?>