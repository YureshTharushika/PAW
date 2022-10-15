<?php session_start(); ?>
<?php require_once("inc/connection.php"); ?>

<?php
  if(!isset($_SESSION['seller_id']))
   {
   header('Location: ../index.php');
   }

   //$errors = array();
   
   $add_id= '';
   $seller_id = '';
   $category= '';
   $title= '';
   $first_name='';
   $last_name='';
   $email= '';
   $contact='';
   $location='';
   $payment='';


   if(isset($_GET['add_id']))
   {
    $add_id = mysqli_real_escape_string($connect,$_GET['add_id']);
    $query = "SELECT * FROM advertisement WHERE AddId= {$add_id} LIMIT 1";
   

    $result_set = mysqli_query($connect,$query);

    if($result_set)
   {
       if(mysqli_num_rows($result_set) == 1)
       {
        //User Found
        $result = mysqli_fetch_assoc($result_set);
        $category = $result['Category'];
        $title = $result['Title'];
        $contact = $result['Contact'];
        $payment = $result['Payment'];
        $location = $result['Location'];
        //$email = $result['Email'];
       }
       
     }

     
   }

   if(isset($_GET['seller_id']))
   {
    $seller_id = mysqli_real_escape_string($connect,$_GET['seller_id']);
    $query1 = "SELECT * FROM seller WHERE ID= {$seller_id} LIMIT 1";

    $result_set1 = mysqli_query($connect,$query1);

    if($result_set1)
     {
       if(mysqli_num_rows($result_set1) == 1)
       {
        //User Found
        $result1 = mysqli_fetch_assoc($result_set1);
        $first_name = $result1['FirstName'];
        $last_name = $result1['LastName'];
        $email = $result1['Email'];

        //$email = $result['Email'];
       }

     }

   }
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>



body {
 
  margin: 0;
  width: 100vw;
  height: 100vh;
  background:   #dee5ed  ;
  display: flex;
  align-items: center;
  text-align: center;
  justify-content: center;
 
  
  font-family: poppins;
}

.container {
  position: relative;
  width: 800px;
  height: auto;
  min-height: 100%;
  border-radius: 20px;
  padding: 40px;
  margin-top: 420px;
  box-sizing: border-box;
  background: #ecf0f3;
  box-shadow: 14px 14px 20px  rgba(0, 0, 0, 0.2), -14px -14px 20px  rgba(0, 0, 0, 0.2) ;
}

.container form{

  
  display: flex;
  flex-direction: column;
}

.brand-logo {
  height: 100px;
  width: 100px;
 background-image: url("../images/login_page/shortcut.png");
 background-position: center;
 background-size: 100px;
  margin: auto;
  border-radius: 50%;
  box-sizing: border-box;
  box-shadow: 7px 7px 10px #cbced1, -7px -7px 10px white;
}

.brand-title {
  margin-top: 10px;
  font-weight: 900;
  font-size: 1.8rem;
  color:  #085bed   ;
  letter-spacing: 1px;
}


input[type=submit] {

  margin: auto;
  color: white;
  margin-top: 20px;
  background:  #085bed  ;
  height: 40px;
  border-radius: 15px;
  border-color: white;
  cursor: pointer;
  font-weight: 900;
  box-shadow: 6px 6px 6px #cbced1, -6px -6px 6px white;
  transition: 0.5s;
  width: 40%;
}

input[type=submit]:hover {
  box-shadow: none;
  background-color:  #02c023 ;}



input[type=text] {

  margin: 10px 0px;
  background: #ecf0f3;
  padding: 10px;
  height: 20px;
  width: 150px;
  font-size: 14px;
  border-radius: 50px;
  box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px white;
  border: none;
  outline: none;
 
}



label{
  margin: 10px 0px;
  width: 250px;
  font-size: 18px;
  display: inline-block;
  text-align: left;
  
}




</style>
</head>


<body>

        <div class="container">
              <div class="brand-logo"></div>
              <div class="brand-title">PAW.LK</div>


              <form method="post" action="https://sandbox.payhere.lk/pay/checkout">   
                  <input type="hidden" name="merchant_id" value="1217738">    
                  <input type="hidden" name="return_url" value="http://localhost/Paw.lk/index.php?seller_id=<?php echo $seller_id ?>">
                  <input type="hidden" name="cancel_url" value="http://localhost/Paw.lk/index.php?seller_id=<?php echo $seller_id ?>">
                  <input type="hidden" name="notify_url" value="http://localhost/Paw.lk/payment/notify.php?seller_id=<?php echo $seller_id ?>">  
                  
                  <h3>Item Details</h3>
                  <div class="item_details">
                  <div>
                  <label>Advertisement Topic</label>
                  <input type="text" name="order_id" value="<?php echo $title ?> " readonly>
                  </div>
                  <div>
                  
                  <label>Advertisement Category</label>
                  <input type="text" name="items" value="<?php echo $category ?>" readonly>
                  </div>
                  <div>
                  <label>Currency Type</label>
                  <input type="text" name="currency" value="LKR" readonly>
                  </div>
                  <div>
                  <label>Advertisement Price</label>
                  <input type="text" name="amount" value="<?php echo $payment ?>" readonly>
                  </div>

                  </div>  
                  <br>
                  <h3>Customer Details</h3>

                  <div>
                  <label>First Name</label>
                  <input type="text" name="first_name" value="<?php echo $first_name ?>" readonly>
                  </div>

                  <div>
                  <label>Last Name</label>
                  <input type="text" name="last_name" value="<?php echo $last_name ?>" readonly>
                  </div>

                  <div>
                  <label>E-mail</label>
                  <input type="text" name="email" value="<?php echo $email ?>" readonly>
                  </div>

                  <div>
                  <label>Contact Number</label>
                  <input type="text" name="phone" value="<?php echo $contact ?>" readonly>
                  </div>

                  <div>
                  <label>Address</label>
                  <input type="text" name="address" value="<?php echo $location ?>" readonly>
                  </div>

                  <div>
                  <label>Location</label>
                  <input type="text" name="city" value="Sri Lanka" readonly>
                  </div>

                  
                  
                  <input type="hidden" name="country" value="Sri Lanka">
                  
                  <input type="submit" value="Pay Now">   
              </form>

        </div> 
</body>
</html>