<?php session_start(); ?>
<?php require_once("inc/connection.php"); ?>
<?php require_once("inc/function.php"); ?>

<?php

  if(!isset($_SESSION['seller_id']))
  {
   header('Location: ../index.php');
  }

  $advertisement_list = '';
  $search = '';
  $seller_id= '';
  $first_name= '';
  $email = '';

  if(isset($_GET['seller_id']))
   {
    $seller_id = mysqli_real_escape_string($connect,$_GET['seller_id']);
    $query = "SELECT * FROM seller WHERE ID= {$seller_id} LIMIT 1";

    $result_set = mysqli_query($connect,$query);

    if($result_set)
     {
       if(mysqli_num_rows($result_set) == 1)
       {
        $result = mysqli_fetch_assoc($result_set);
        $first_name = $result['FirstName'];
        $email = $result['Email'];
       }
       else
       {
        header("Location: ../index.php?error=query_failed");
       }
     }

     else
     {
        header("Location: ../index.php?error=query_failed");
     }
   }


  if (isset($_GET['search']))
  {
   $search = mysqli_real_escape_string($connect,$_GET['search']);

   $query = "SELECT * FROM advertisement WHERE (Category LIKE '%{$search}%' or Title LIKE '%{$search}%') AND IsDeleted = 0 ORDER BY AddId DESC";
  }

 else
  {
   $query = "SELECT * FROM advertisement WHERE SellerId={$seller_id} ORDER BY AddId DESC";
  }

  $users = mysqli_query($connect,$query);

  if($users)
  {
   while($user = mysqli_fetch_assoc($users))
   {
      $advertisement_list .= "<tr>";
      $advertisement_list .= "<td>Ad {$user['AddId']} </td>";
      $advertisement_list .= "<td> {$user['Category']} </td>";
      $advertisement_list .= "<td> {$user['Title']} </td>";
      $advertisement_list .= "<td> {$user['Details']} </td>";
      $advertisement_list .= "<td> {$user['Price']} </td>";
      $advertisement_list .= "<td> {$user['Contact']} </td>";
      $advertisement_list .= "<td> {$user['PostedAt']} </td>";
      $advertisement_list .= "<td> {$user['IsApproved']} </td>";
      $advertisement_list .= "<td> <img src=\"../uploads/{$user['Image']}\" style=\"width:100px;height:100px;border:1px solid black;border-radius:10px\"></td>";
      //$advertisement_list .= "<td> <a href = \"delete_advertisement.php?advertisement_id={$user['AddId']}\"onclick=\"return confirm('Are you sure?');\"><button style=\"width:90px;\">Delete</button></a> </td>";
      $advertisement_list .= "</tr>";
   }
  }

  else
  {
   echo "Database Query Failed!";
  }

?>

<!DOCTYPE>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>My Advertiesments</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="../images/login_page/shortcut.png">

</head>

<body>


  
<header id="header" class = "header">
    <div class="hamberger" onclick="toggleSidebar()">
      <i class="fas fa-bars" ></i>
      </div>
   
    <div class="left_area">
        PAW.LK
    </div>
    
    <div class="right_area" >
         
       <label class="loggedin_mail">Signed In as <span><?php echo $email ?></span></label>
    </div>

  </header>

  
<div class="sidebar" id="sidebar">

   <center>

   <div class="seller_pro_pic">
        <?php
          $sql = "SELECT * FROM seller WHERE ID ={$seller_id} LIMIT 1";

          $res = mysqli_query($connect,$sql);

          if(mysqli_num_rows($res) > 0)
          {
            while($images = mysqli_fetch_assoc($res)) { ?>
               <div class="pro_pic">
                  <img src="img/ProPic/<?=$images['ProfilePicture']?>" >
               </div>

          
        <?php } }?>
        
      </div>

   <h4><?php echo $first_name; ?></h4> 
   
   </center>

   <a href="seller_dashboard.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
   <a href="advertisements_seller.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-ad"></i><span>My Advertisements</span></a>
   <a href="seller_modify.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-user-edit"></i><span>Edit My Profile</span></a>
   <a href="seller_change_password.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-unlock-alt"></i></i><span>Change Password</span></a>
   <a href="../index.php?seller_id=<?php echo $seller_id ?>"><i class="fas fa-home"></i><span>Home</span></a>
   <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span>Log Out</span></a>

</div>
  
   
<div id="content" class="content">

   <div class="home-content">

         <div class = "search">

            <form action="advertisements_seller.php?seller_id=<?php echo $seller_id; ?>" method="get">

               <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
               
                  <input type="text" name="search" id="search" placeholder="Category or Title and press Enter" value="<?php echo $search ?>" required autofocus>
                  

            </form>

            <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">

            <a  href="advertisements_seller.php?seller_id=<?php echo $seller_id; ?>"><button>REFRESH</button></a>

         </div><!--End of search-->
         
         <table id="sellerTable" class="masterlist">

         <tr id="tableHeader">
            <th>Advertisement ID</th>
            <th>Category</th>
            <th>Title</th>
            <th>Details</th>
            <th>Price</th>
            <th>Contact</th>
            <th>Posted Time</th>
            <th>Is Approved</th>
            <th>Image</th>
         </tr>

         <?php echo $advertisement_list ?>

         </table>


       </div><!--end of home-content -->

</div><!--end of content -->


 
<Script>


    function toggleSidebar(){

      document.getElementById("sidebar").classList.toggle('active');
      document.getElementById("header").classList.toggle('active');
      document.getElementById("content").classList.toggle('active');
    }

  </Script>

</body>

</html>