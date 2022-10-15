<?php require_once("inc/connection.php"); ?>
<?php require_once("inc/function.php"); ?>

<?php 


if (isset($_POST['register'])){
           
    //Createdata();



    $FirstName  = $_POST['FirstName'];
    $LastName   = $_POST['LastName'];
    $Email      = $_POST['email'];
    $Location   = $_POST['location'];
    $pass       = $_POST['password'];
    $cpassword  = $_POST['cpassword'];
    $UserRole = "user";
    $isActive = 1;


    //Checking required fields


    if(!is_email($_POST['email']))
    {
    $errors[] = "Email Address is Invalid";
    }

    $email = mysqli_real_escape_string($connect,$_POST['email']);
    $query = "SELECT * FROM seller WHERE Email='{$email}' LIMIT 1";
    $result_set = mysqli_query($connect,$query);

    if($result_set)
    {
    if(mysqli_num_rows($result_set) == 1)
    {
        $errors[] = 'Email Address is already exists';
    }
    }

    if(empty($errors))
    {
    $FirstName = mysqli_real_escape_string($connect,$_POST['FirstName']);
    $LastName = mysqli_real_escape_string($connect,$_POST['LastName']);
    $email = mysqli_real_escape_string($connect,$_POST['email']);
    $location = mysqli_real_escape_string($connect,$_POST['location']);
    $pass = mysqli_real_escape_string($connect,$_POST['password']);
    $cpassword = mysqli_real_escape_string($connect,$_POST['password']);


    //Validate password strength
    $uppercase = preg_match("#[A-Z]+#", $pass);
    $lowercase = preg_match("#[a-z]+#", $pass);
    $number    = preg_match("#[0-9]+#", $pass);

    $hashed_password = sha1($pass);

    if($uppercase && $lowercase && $number && strlen($hashed_password) >= 8) 
    {
    $query = "INSERT INTO seller (FirstName,LastName,Email,Location,Password,UserRole,IsActive,IsDeleted) VALUES ('{$FirstName}','{$LastName}','{$email}','{$location}','{$hashed_password}','user',1,0)";

    $result = mysqli_query($connect, $query);

    if($result)
    {
        header("location:login.php?registered successfully");
    }
    else
    {
    
    $errors[] = 'Failed to add the new record';
    }

    }

    else
    {
    $errors[] = 'Password is should contains<br> - Atleast 1 Uppercase Letter<br> - Atleast 1 Lowercase Letter<br> - Atleast 1 digit<br> - Atleast 8 Characters';
    }





    

    }

    }else{

        echo("not working");
    }



        // if (isset($_POST['register'])){
                
        //     //Createdata();



        //     $FirstName  = $_POST['FirstName'];
        //     $LastName   = $_POST['LastName'];
        //     $Email      = $_POST['email'];
        //     $Location   = $_POST['location'];
        //     $pass       = $_POST['password'];
        //     $cpassword  = $_POST['cpassword'];
        //     $UserRole = "user";
        //     $isActive = 1;


        // //Checking required fields


        // if(!is_email($_POST['email']))
        // {
        // $errors[] = "Email Address is Invalid";
        // }

        // $email = mysqli_real_escape_string($connect,$_POST['email']);
        // $query = "SELECT * FROM seller WHERE Email='{$email}' LIMIT 1";
        // $result_set = mysqli_query($connect,$query);

        // if($result_set)
        // {
        // if(mysqli_num_rows($result_set) == 1)
        // {
        //     $errors[] = 'Email Address is already exists';
        // }
        // }

        // if(empty($errors))
        // {
        // $FirstName = mysqli_real_escape_string($connect,$_POST['FirstName']);
        // $LastName = mysqli_real_escape_string($connect,$_POST['LastName']);
        // $email = mysqli_real_escape_string($connect,$_POST['email']);
        // $location = mysqli_real_escape_string($connect,$_POST['location']);
        // $pass = mysqli_real_escape_string($connect,$_POST['password']);
        // $cpassword = mysqli_real_escape_string($connect,$_POST['password']);


        // //Validate password strength
        // $uppercase = preg_match("#[A-Z]+#", $pass);
        // $lowercase = preg_match("#[a-z]+#", $pass);
        // $number    = preg_match("#[0-9]+#", $pass);

        // $hashed_password = sha1($pass);

        // if($uppercase && $lowercase && $number && strlen($hashed_password) >= 8) 
        // {
        // $query = "INSERT INTO seller (FirstName,LastName,Email,Location,Password,UserRole,IsActive,IsDeleted) VALUES ('{$FirstName}','{$LastName}','{$email}','{$location}','{$hashed_password}','user',1,0)";

        // $result = mysqli_query($connect, $query);

        // if($result)
        // {
        //     header("location:login.php?registered successfully");
        // }
        // else
        // {
        
        // $errors[] = 'Failed to add the new record';
        // }

        // }

        // else
        // {
        // $errors[] = 'Password is should contains<br> - Atleast 1 Uppercase Letter<br> - Atleast 1 Lowercase Letter<br> - Atleast 1 digit<br> - Atleast 8 Characters';
        // }





        

        // }

        // }else{

        //     echo("not working");
        // }

?>