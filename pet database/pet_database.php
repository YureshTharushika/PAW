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
  
  
  <title>Pet Archive</title>

           
                  
  
  <link rel="stylesheet" type="text/css" href="pet_database.css">
  <link rel="shortcut icon" href="../images/login_page/shortcut.png">

    

    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/52bfdd00c0.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
 
 

</head>
<body>


  <section id="main">
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
              echo "<a href=\"pet_database.php?seller_id=$seller_id\"><i class=\"fas fa-dog\"></i> Pet Archive</a>";
             } 

             else if(isset($_SESSION['user_id']))
             {
              echo "<a href=\"pet_database.php?user_id=$user_id\"><i class=\"fas fa-dog\"></i> Pet Archive</a>";
             } 

             else
             {

               echo "<a href=\"pet_database.php\"><i class=\"fas fa-dog\"></i> Pet Archive</a>";

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
</section>    
<!-- navigation bar end -->

<section id="dashboard_and_email_section">
<!-- Dashboard and Email -->
<hr>
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
                <hr>
</section>     



<section>      
        <div class="Topic_label">

            <label for="">Dog Database</label>
        </div>
    
</section>


<section id="pet_details">
    
    
    
    
    <div class="pet_text">
            <span>Doggo</span>
            <h3>American Bulldog</h3>
            <h2>Loyal / Self-Confident</h2>
            <label><i class="fas fa-ruler-vertical"></i>22-25 inches (males)/20-23 inches (females)</label>
            <label><i class="fas fa-weight-hanging"></i>75-100 pounds (males)/60-80 pounds (females)</label>
            <label><i class="fas fa-heartbeat"></i>10 - 12 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                American Bulldogs are a well-balanced athletic dog that demonstrate great strength, endurance, agility, and a friendly attitude.
                Historically, they were bred to be a utility dog used for working the farm.
                The American Bulldog is a descendant of the English Bulldog. It is believed that the bulldog was in America as early as the 17th century. 
                They came to the United States in the 1800s, with immigrants who brought their working bulldogs with them. 
                Small farmers and ranchers used this all-around working dog for many tasks including farm guardians, stock dogs, and catch dogs. 
                The breed largely survived, particularly in the southern states, due to its ability to bring down and catch feral pigs.
                The breed we know as the American Bulldog was originally known by many different names before the name American Bulldog became the standard. 
                In different parts of the South he was known as the White English Southern Bulldog, but most commonly just ""bulldog."" The breed was not called a bulldog because of a certain look, but because they did real bulldog work.
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/American_Bulldog.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Akita</h3>
            <h2>Dignified / Courageous / Profoundly Loyal</h2>
            <label><i class="fas fa-ruler-vertical"></i>26-28 inches (male)/24-26 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>100-130 pounds (male)/70-100 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>10-13 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                Akita is muscular, double-coated dogs of ancient Japanese lineage famous for her dignity, courage, and loyalty. In her native land, she's venerated as family protectors and symbols of good health, happiness, and long life.
Akitas are burly, heavy-boned spitz-type dogs of imposing stature. Standing 24 to 28 inches at the shoulder, Akitas have a dense coat that comes in several colors, including white. The head is broad and massive, and is balanced in the rear by a full, curled-over tail. The erect ears and dark, shining eyes contribute to an expression of alertness, a hallmark of the breed. Akitas are quiet, fastidious dogs. Wary of strangers and often intolerant of other animals, Akitas will gladly share their silly, affectionate side with family and friends. They thrive on human companionship. The large, independent-thinking Akita is hardwired for protecting those they love. They must be well socialized from birth with people and other dogs.
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Akita.jpg" alt="Advertiesment image">

    </div>

</section>





<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Australian Shepherd</h3>
            <h2>Smart / Work-Oriented / Exuberant</h2>
            <label><i class="fas fa-ruler-vertical"></i>20-23 inches (male)/18-21 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>50-65 pounds (male)/40-55 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>12-15 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                The Australian Shepherd, a lean, tough ranch dog, is one of those 'only in America' stories: a European breed perfected in California by way of Australia. Fixtures on the rodeo circuit, they are closely associated with the cowboy life.
                The Australian Shepherd, the cowboy's herding dog of choice, is a medium-sized worker with a keen, penetrating gaze in the eye. Aussie coats offer different looks, including merle (a mottled pattern with contrasting shades of blue or red). In all ways, they're the picture of rugged and agile movers of stock. Aussies exhibit an irresistible impulse to herd, anything: birds, dogs, kids. This strong work drive can make Aussies too much dog for a sedentary pet owner. Aussies are remarkably intelligent, quite capable of hoodwinking an unsuspecting novice owner. In short, this isn't the pet for everyone. But if you're looking for a brainy, tireless, and trainable partner for work or sport, your search might end here.   
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Australian_Shepherd.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Beagle</h3>
            <h2>Merry / Friendly / Curious</h2>
            <label><i class="fas fa-ruler-vertical"></i>13 inches & under 13-15 inches</label>
            <label><i class="fas fa-weight-hanging"></i>under 20 pounds (13 inches & under)/20-30 pounds (13-15 inches)</label>
            <label><i class="fas fa-heartbeat"></i>10-15 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                Not only is the Beagle an excellent hunting dog and loyal companion, it is also happy-go-lucky, funny, and'thanks to its pleading expression'cute. They were bred to hunt in packs, so they enjoy company and are generally easygoing.
                There are two Beagle varieties: those standing under 13 inches at the shoulder, and those between 13 and 15 inches. Both varieties are sturdy, solid, and 'big for their inches,' as dog folks say. They come in such pleasing colors as lemon, red and white, and tricolor. The Beagle's fortune is in his adorable face, with its big brown or hazel eyes set off by long, houndy ears set low on a broad head. A breed described as 'merry' by its fanciers, Beagles are loving and lovable, happy, and companionable'all qualities that make them excellent family dogs. No wonder that for years the Beagle has been the most popular hound dog among American pet owners. These are curious, clever, and energetic hounds who require plenty of playtime.
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Beagle.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Bloodhound</h3>
            <h2>Independent / Inquisitive / Friendly</h2>
            <label><i class="fas fa-ruler-vertical"></i>25-27 inches (male)/23-25 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>90-110 pounds (male)/80-100 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>10-12 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                The world famous 'Sleuth Hound' does one thing better than any creature on earth: find people who are lost or hiding. An off-duty Bloodhound is among the canine kingdom's most docile citizens, but he's relentless and stubborn on scent. &nbsp;
Bloodhounds are large, substantial dogs standing 23 to 27 inches at the shoulder and weighing up to 110 pounds. Their most famous features are a long, wrinkled face with loose skin; huge, drooping ears; and warm, deep-set eyes that complete an expression of solemn dignity. Coat colors can be black and tan, liver and tan, or red. Powerful legs allow Bloodhounds to scent over miles of punishing terrain. As pack dogs, Bloodhounds enjoy company, including other dogs and kids. They are easygoing, but their nose can sometimes lead them into trouble. A strong leash and long walks in places where they can enjoy sniffing around are recommended. Bloodhounds are droolers, and obedience training these sensitive sleuths can be a challenge. 
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Bloodhound.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Border Collie</h3>
            <h2>Smart / Affectionate / Energetic</h2>
            <label><i class="fas fa-ruler-vertical"></i>19-22 inches (male)/18-21 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>30-55 pounds</label>
            <label><i class="fas fa-heartbeat"></i>12-15 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                A remarkably bright workaholic, the Border Collie is an amazing dog'maybe a bit too amazing for owners without the time, energy, or means to keep it occupied. These energetic dogs will settle down for cuddle time when the workday is done.
Borders are athletic, medium-sized herders standing 18 to 22 inches at the shoulder. The overall look is that of a muscular but nimble worker unspoiled by passing fads. Both the rough coat and the smooth coat come in a variety of colors and patterns. The almond eyes are the focus of an intelligent expression'an intense gaze, the Border's famous 'herding eye', is a breed hallmark. On the move, Borders are among the canine kingdom's most agile, balanced, and durable citizens. The intelligence, athleticism, and trainability of Borders have a perfect outlet in agility training. Having a job to perform, like agility'or herding or obedience work'is key to Border happiness. Amiable among friends, they may be reserved with strangers. 
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Border_Collie.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Boxer
            </h3>
            <h2>Fun-Loving / Bright / Active</h2>
            <label><i class="fas fa-ruler-vertical"></i>23-25 inches (male)/21.5-23.5 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>65-80 pounds (male)/females are about 15 pounds less than male</label>
            <label><i class="fas fa-heartbeat"></i>10-12 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                Loyalty, affection, intelligence, work ethic, and good looks: Boxers are the whole doggy package. Bright and alert, sometimes silly, but always courageous, the Boxer has been among America's most popular dog breeds for a very long time.
                A well-made Boxer in peak condition is an awesome sight. A male can stand as high as 25 inches at the shoulder; females run smaller. Their muscles ripple beneath a short, tight-fitting coat. The dark brown eyes and wrinkled forehead give the face an alert, curious look. The coat can be fawn or brindle, with white markings. Boxers move like the athletes they are named for: smooth and graceful, with a powerful forward thrust. Boxers are upbeat and playful. Their patience and protective nature have earned them a reputation as a great dog with children. They take the jobs of watchdog and family guardian seriously and will meet threats fearlessly. Boxers do best when exposed to a lot of people and other animals in early puppyhood.  
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Boxer.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Bulldog</h3>
            <h2>Calm / Courageous / Friendly</h2>
            <label><i class="fas fa-ruler-vertical"></i>14-15 inches</label>
            <label><i class="fas fa-weight-hanging"></i>50 pounds (male)/40 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>8-10 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                Kind but courageous, friendly but dignified, the Bulldog is a thick-set, low-slung, well-muscled bruiser whose 'sourmug' face is the universal symbol of courage and tenacity. These docile, loyal companions adapt well to town or country.
                You can't mistake a Bulldog for any other breed. The loose skin of the head, furrowed brow, pushed-in nose, small ears, undershot jaw with hanging chops on either side, and the distinctive rolling gait all practically scream 'I'm a Bulldog!' The coat, seen in a variety of colors and patterns, is short, smooth, and glossy. Bulldogs can weigh up to 50 pounds, but that won't stop them from curling up in your lap, or at least trying to. But don't mistake their easygoing ways for laziness'Bulldogs enjoy brisk walks and need regular moderate exercise, along with a careful diet, to stay trim. Summer afternoons are best spent in an air-conditioned room as a Bulldog's short snout can cause labored breathing in hot and humid weather.  
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Bulldog.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Bullmastiff</h3>
            <h2>Brave / Affectionate / Loyal</h2>
            <label><i class="fas fa-ruler-vertical"></i>25-27 inches (male)/24-26 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>110-130 pounds (male)/100-120 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>7-9 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                Fearless at work, docile at home, the Bullmastiff is a large, muscular guarder who pursued and held poachers in Merry Old England'merry, we suppose, for everyone but poachers. Bullmastiffs are the result of Bulldog and Mastiff crosses.
                The Bullmastiff isn't quite as large as his close cousin the Mastiff. Still, standing as high as 27 inches at the shoulder and weighing between 100 and 130 pounds, this is still a whole lot of dog. After the first impression made by the Bullmastiff's size, it is the large, broad head that conveys the breed's essence: the dark eyes, high-set V-shaped ears, and broad, deep muzzle all combine to present the intelligence, alertness, and confidence that make the Bullmastiff a world-class protector and family companion. Coats come in fawn, red, or brindle. These are biddable and reliable creatures, but as with any large guarding dog, owners must begin training and socialization early, while the puppy is still small enough to control.
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Bullmastiff.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Chihuahua</h3>
            <h2>Graceful / Charming / Sassy</h2>
            <label><i class="fas fa-ruler-vertical"></i>5-8 inches</label>
            <label><i class="fas fa-weight-hanging"></i>not exceeding 6 pounds</label>
            <label><i class="fas fa-heartbeat"></i>14-16 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                The Chihuahua is a tiny dog with a huge personality. A national symbol of Mexico, these alert and amusing "purse dogs" stand among the oldest breeds of the Americas, with a lineage going back to the ancient kingdoms of pre-Columbian times.
                The Chihuahua is a balanced, graceful dog of terrier-like demeanor, weighing no more than 6 pounds. The rounded "apple" head is a breed hallmark. The erect ears and full, luminous eyes are acutely expressive. Coats come in many colors and patterns, and can be long or short. The varieties are identical except for coat. Chihuahuas possess loyalty, charm, and big-dog attitude. Even tiny dogs require training, and without it this clever scamp will rule your household like a little Napoleon. Compact and confident, Chihuahuas are ideal city pets. They are too small for roughhousing with kids, and special care must be taken in cold weather, but Chihuahuas are adaptable'as long as they get lots of quality time in their preferred lap.  
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Chihuahua.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Cocker Spaniel</h3>
            <h2>Happy / Smart / Gentle</h2>
            <label><i class="fas fa-ruler-vertical"></i>14.5-15.5 inches (male)/13.5-14.5 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>25-30 pounds (male)/20-25 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>10-14 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                The merry and frolicsome Cocker Spaniel, with his big, dreamy eyes and impish personality, is one of the world's best-loved breeds. They were developed as hunting dogs, but Cockers gained their wide popularity as all-around companions.
                Those big, dark eyes; that sweet expression; those long, lush ears that practically demand to be touched'no wonder the Cocker spent years as America's most popular breed. The Cocker is the AKC's smallest sporting spaniel, standing about 14 to 15 inches. The coat comes in enough colors and patterns to please any taste. The well-balanced body is sturdy and solid, and these quick, durable gundogs move with a smooth, easy gait. Cockers are eager playmates for kids and are easily trained as companions and athletes. They are big enough to be sporty, but compact enough to be portable. A Cocker in full coat rewards extra grooming time by being the prettiest dog on the block. These energetic sporting dogs love playtime and brisk walks.
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Cocker_Spaniel.jpg" alt="Advertiesment image">

    </div>

</section>



<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Collie</h3>
            <h2>Graceful / Devoted / Proud</h2>
            <label><i class="fas fa-ruler-vertical"></i>24-26 inches (male)/22-24 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>60-75 pounds (male)/50-65 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>12-14 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                The majestic Collie, thanks to a hundred years as a pop-culture star, is among the world's most recognizable and beloved dog breeds. The full-coated 'rough' Collie is the more familiar variety, but there is also a sleek 'smooth' Collie.
                The Collie is a large but lithe herder standing anywhere from 22 to 26 inches tall. The rough variety boasts one of the canine kingdom's most impressively showy coats; the smooth coat's charms are subtler but no less satisfying. Coat colors in both varieties are sable and white, tricolor, blue merle, or white. Collie fanciers take pride in their breed's elegant wedge-shaped head, whose mobile ears and almond eyes convey a wide variety of expressions. Collies are famously fond of children and make wonderful family pets. These swift, athletic dogs thrive on companionship and regular exercise. With gentle training, they learn happily and rapidly. The Collie's loyalty, intelligence, and sterling character are the stuff of legend.   
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Collie.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Dachshund</h3>
            <h2>Spunky / Curious / Friendly</h2>
            <label><i class="fas fa-ruler-vertical"></i>8-9 inches (standard)/5-6 inches (miniature)</label>
            <label><i class="fas fa-weight-hanging"></i>16-32 pounds (standard)/11 pounds & under (miniature)</label>
            <label><i class="fas fa-heartbeat"></i>12-16 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                The famously long, low silhouette, ever-alert expression, and bold, vivacious personality of the Dachshund have made him a superstar of the canine kingdom. Dachshunds come in two sizes and in three coat types of various colors and patterns.
                The word 'icon' is terribly overworked, but the Dachshund'with his unmistakable long-backed body, little legs, and big personality'is truly an icon of purebred dogdom. Dachshunds can be standard-sized (usually 16 to 32 pounds) or miniature (11 pounds or under), and come in one of three coat types: smooth, wirehaired, or longhaired. Dachshunds aren't built for distance running, leaping, or strenuous swimming, but otherwise these tireless hounds are game for anything. Smart and vigilant, with a big-dog bark, they make fine watchdogs. Bred to be an independent hunter of dangerous prey, they can be brave to the point of rashness, and a bit stubborn, but their endearing nature and unique look has won millions of hearts the world over.
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Dachshund.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Dalmatian</h3>
            <h2>Outgoing / Dignified / Smart</h2>
            <label><i class="fas fa-ruler-vertical"></i>19-24 inches</label>
            <label><i class="fas fa-weight-hanging"></i>45-70 pounds</label>
            <label><i class="fas fa-heartbeat"></i>11-13 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                The dignified Dalmatian, dogdom's citizen of the world, is famed for his spotted coat and unique job description. During their long history, these "coach dogs" have accompanied the horse-drawn rigs of nobles, gypsies, and firefighters.
                The Dalmatian's delightful, eye-catching spots of black or liver adorn one of the most distinctive coats in the animal kingdom. Beneath the spots is a graceful, elegantly proportioned trotting dog standing between 19 and 23 inches at the shoulder. Dals are muscular, built to go the distance; the powerful hindquarters provide the drive behind the smooth, effortless gait. The Dal was originally bred to guard horses and coaches, and some of the old protective instinct remains. Reserved and dignified, Dals can be aloof with strangers and are dependable watchdogs. With their preferred humans, Dals are bright, loyal, and loving house dogs. They are strong, active athletes with great stamina'a wonderful partner for runners and hikers.  
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Dalmatian.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Doberman Pinscher
            </h3>
            <h2>Alert / Fearless / Loyal</h2>
            <label><i class="fas fa-ruler-vertical"></i>26-28 inches (male)/24-26 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>75-100 pounds (male)/60-90 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>10-12 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                Sleek and powerful, possessing both a magnificent physique and keen intelligence, the Doberman Pinscher is one of dogkind's noblemen. This incomparably fearless and vigilant breed stands proudly among the world's finest protection dogs.
                Dobermans are compactly built dogs'muscular, fast, and powerful'standing between 24 to 28 inches at the shoulder. The body is sleek but substantial, and is covered with a glistening coat of black, blue, red, or fawn, with rust markings. These elegant qualities, combined with a noble wedge-shaped head and an easy, athletic way of moving, have earned Dobermans a reputation as royalty in the canine kingdom. A well-conditioned Doberman on patrol will deter all but the most foolish intruder.  
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Doberman_Pinscher.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>German Shepherd Dog</h3>
            <h2>Smart / Confident / Courageous</h2>
            <label><i class="fas fa-ruler-vertical"></i>24-26 inches (male)/22-24 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>65-90 pounds (male)/50-70 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>7-10 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                Generally considered dogkind's finest all-purpose worker, the German Shepherd Dog is a large, agile, muscular dog of noble character and high intelligence. Loyal, confident, courageous, and steady, the German Shepherd is truly a dog lover's delight.
                German Shepherd Dogs can stand as high as 26 inches at the shoulder and, when viewed in outline, presents a picture of smooth, graceful curves rather than angles. The natural gait is a free-and-easy trot, but they can turn it up a notch or two and reach great speeds. There are many reasons why German Shepherds stand in the front rank of canine royalty, but experts say their defining attribute is character: loyalty, courage, confidence, the ability to learn commands for many tasks, and the willingness to put their life on the line in defense of loved ones. German Shepherds will be gentle family pets and steadfast guardians, but, the breed standard says, there's a 'certain aloofness that does not lend itself to immediate and indiscriminate friendships.'  
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/German_Shepherd.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Golden Retriever</h3>
            <h2>Intelligent / Friendly / Devoted</h2>
            <label><i class="fas fa-ruler-vertical"></i>23-24 inches (male)/21.5-22.5 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>65-75 pounds (male)/55-65 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>10-12 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                The Golden Retriever, an exuberant Scottish gundog of great beauty, stands among America's most popular dog breeds. They are serious workers at hunting and field work, as guides for the blind, and in search-and-rescue, enjoy obedience and other competitive events, and have an endearing love of life when not at work.
                The Golden Retriever is a sturdy, muscular dog of medium size, famous for the dense, lustrous coat of gold that gives the breed its name. The broad head, with its friendly and intelligent eyes, short ears, and straight muzzle, is a breed hallmark. In motion, Goldens move with a smooth, powerful gait, and the feathery tail is carried, as breed fanciers say, with a 'merry action.' The most complete records of the development of the Golden Retriever are included in the record books that were kept from 1835 until about 1890 by the gamekeepers at the Guisachan (pronounced Gooeesicun) estate of Lord Tweedmouth at Inverness-Shire, Scotland. These records were released to public notice in Country Life in 1952, when Lord Tweedmouth's great-nephew, the sixth Earl of Ilchester, historian and sportsman, published material that had been left by his ancestor. They provided factual confirmation to the stories that had been handed down through generations. Goldens are outgoing, trustworthy, and eager-to-please family dogs, and relatively easy to train. They take a joyous and playful approach to life and maintain this puppyish behavior into adulthood. These energetic, powerful gundogs enjoy outdoor play. For a breed built to retrieve waterfowl for hours on end, swimming and fetching are natural pastimes.   
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Golden_Retriever.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Great Dane</h3>
            <h2>Friendly / Patient / Dependable</h2>
            <label><i class="fas fa-ruler-vertical"></i>30-32 inches (male)/28-30 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>140-175 pounds (male)/110-140 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>7-10 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                The easygoing Great Dane, the mighty 'Apollo of Dogs,' is a total joy to live with'but owning a dog of such imposing size, weight, and strength is a commitment not to be entered into lightly. This breed is indeed great, but not a Dane.
                As tall as 32 inches at the shoulder, Danes tower over most other dogs'and when standing on their hind legs, they are taller than most people. These powerful giants are the picture of elegance and balance, with the smooth and easy stride of born noblemen. The coat comes in different colors and patterns, perhaps the best-known being the black-and-white patchwork pattern known as 'harlequin.' Despite their sweet nature, Danes are alert home guardians. Just the sight of these gentle giants is usually enough to make intruders think twice. But those foolish enough to mistake the breed's friendliness for softness will meet a powerful foe of true courage and spirit. Patient with kids, Danes are people pleasers who make friends easily.  
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Great_Dane.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Labrador Retriever</h3>
            <h2>Friendly / Active / Outgoing</h2>
            <label><i class="fas fa-ruler-vertical"></i>22.5-24.5 inches (male)/21.5-23.5 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>65-80 pounds (male)/55-70 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>10-12 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                The sweet-faced, lovable Labrador Retriever is America's most popular dog breed. 
                Labs are friendly, outgoing, and high-spirited companions who have more than enough affection to go around for a family looking for a medium-to-large dog.
                The sturdy, well-balanced Labrador Retriever can, depending on the sex, stand from 21.5 to 24.5 inches at the shoulder and weigh between 55 to 80 pounds. 
                The dense, hard coat comes in yellow, black, and a luscious chocolate. The head is wide, the eyes glimmer with kindliness, and the thick, tapering 'otter tail' seems to be forever signaling the breed's innate eagerness. 
                Labs are famously friendly. They are companionable housemates who bond with the whole family, and they socialize well with neighbor dogs and humans alike. But don't mistake his easygoing personality for low energy: 
                The Lab is an enthusiastic athlete that requires lots of exercise, like swimming and marathon games of fetch, to keep physically and mentally fit. 
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Labrador_Retriever.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Mastiff</h3>
            <h2>Courageous / Dignified / Good-Natured</h2>
            <label><i class="fas fa-ruler-vertical"></i>30 inches & up (male)/27.5 inches & up (female)</label>
            <label><i class="fas fa-weight-hanging"></i>160-230 pounds (male)/120-170 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>6-10 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                The colossal Mastiff belongs to a canine clan as ancient as civilization itself. A massive, heavy-boned dog of courage and prodigious strength, the Mastiff is docile and dignified but also a formidable protector of those they hold dear.
                For the uninitiated, a face-to-face encounter with these black-masked giants can be startling. A male stands at least 30 inches at the shoulder and can outweigh many a full-grown man. The rectangular body is deep and thickly muscled, covered by a short double coat of fawn, apricot, or brindle stripes. The head is broad and massive, and a wrinkled forehead accentuates an alert, kindly expression. Mastiffs are patient, lovable companions and guardians who take best to gentle training. Eternally loyal Mastiffs are protective of family, and a natural wariness of strangers makes early training and socialization essential. Mastiffs are magnificent pets, but acquiring a powerful giant-breed dog is commitment not to be taken lightly.  
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Mastiff.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Pomeranian</h3>
            <h2>Lively / Bold / Inquisitive</h2>
            <label><i class="fas fa-ruler-vertical"></i>6-7 inches</label>
            <label><i class="fas fa-weight-hanging"></i>3-7 pounds</label>
            <label><i class="fas fa-heartbeat"></i>12-16 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                The tiny Pomeranian, long a favorite of royals and commoners alike, has been called the ideal companion. The glorious coat, smiling, foxy face, and vivacious personality have helped make the Pom one of the world's most popular toy breeds.
                The Pomeranian combines a tiny body (no more than seven pounds) and a commanding big-dog demeanor. The abundant double coat, with its frill extending over the chest and shoulders, comes in almost two dozen colors, and various patterns and markings, but is most commonly seen in orange or red. Alert and intelligent, Pomeranians are easily trained and make fine watchdogs and perky pets for families with children old enough to know the difference between a toy dog and a toy. Poms are active but can be exercised with indoor play and short walks, so they are content in both the city and suburbs. They will master tricks and games with ease, though their favorite activity is providing laughs and companionship to their special human.   
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Pomeranian.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Pug</h3>
            <h2>Loving / Charming / Mischievous</h2>
            <label><i class="fas fa-ruler-vertical"></i>10-13 inches</label>
            <label><i class="fas fa-weight-hanging"></i>14-18 pounds</label>
            <label><i class="fas fa-heartbeat"></i>13-15 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                Once the mischievous companion of Chinese emperors, and later the mascot of Holland's royal House of Orange, the small but solid Pug is today adored by his millions of fans around the world. Pugs live to love and to be loved in return.
                The Pug's motto is the Latin phrase 'multum in parvo' (a lot in a little)'an apt description of this small but muscular breed. They come in three colors: silver or apricot-fawn with a black face mask, or all black. The large round head, the big, sparkling eyes, and the wrinkled brow give Pugs a range of human-like expressions'surprise, happiness, curiosity'that have delighted owners for centuries. Pug owners say their breed is the ideal house dog. Pugs are happy in the city or country, with kids or old folks, as an only pet or in a pack. They enjoy their food, and care must be taken to keep them trim. They do best in moderate climates'not too hot, not too cold'but, with proper care, Pugs can be their adorable selves anywhere. 
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Pug.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Rottweiler</h3>
            <h2>Loyal / Loving / Confident Guardian</h2>
            <label><i class="fas fa-ruler-vertical"></i>24-27 inches (male)/22-25 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>95-135 pounds (male)/80-100 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>9-10 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                The Rottweiler is a robust working breed of great strength descended from the mastiffs of the Roman legions. A gentle playmate and protector within the family circle, the Rottie observes the outside world with a self-assured aloofness.
                A male Rottweiler will stand anywhere from 24 to 27 muscular inches at the shoulder; females run a bit smaller and lighter. The glistening, short black coat with smart rust markings add to the picture of imposing strength. A thickly muscled hindquarters powers the Rottie's effortless trotting gait. A well-bred and properly raised Rottie will be calm and confident, courageous but not unduly aggressive. The aloof demeanor these world-class guardians present to outsiders belies the playfulness, and downright silliness, that endear Rotties to their loved ones. (No one told the Rottie he's not a toy breed, so he is liable plop onto your lap for a cuddle.) Early training and socialization will harness a Rottie's territorial instincts in a positive way.  
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Rottweiler.jpg" alt="Advertiesment image">

    </div>

</section>


<section id="pet_details">

    <div class="pet_text">
            <span>Doggo</span>
            <h3>Saint Bernard</h3>
            <h2>Inquisitive / Playful / Charming</h2>
            <label><i class="fas fa-ruler-vertical"></i>28-30 inches (males)/26-28 inches (female)</label>
            <label><i class="fas fa-weight-hanging"></i>140-180 pounds (male)/120-140 pounds (female)</label>
            <label><i class="fas fa-heartbeat"></i>8-10 years</label>
           
            <h4>About the Breed</h4>
            <br>
            <p>
                The Saint Bernard does not rank very high in AKC registrations, but the genial giant of the Swiss Alps is nonetheless among the world's most famous and beloved breeds. Saints are famously watchful and patient 'nanny dogs' for children.
                Not ranked particularly high in AKC registrations, this genial giant is nonetheless among the world's most famous and beloved breeds. The Saint's written standard abounds with phrases like 'very powerful,' 'extraordinarily muscular,' 'imposing,' and 'massive.' A male stands a minimum 27.5 inches at the shoulder; females will be smaller and more delicately built. The huge head features a wrinkled brow, a short muzzle, and dark eyes, combining to give Saints the intelligent, friendly expression that was such a welcome sight to stranded Alpine travelers.   
            </p>

            

    </div>

    <div class="pet_img">

        <img src="images/Saint_Bernard.jpg" alt="Advertiesment image">

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
                echo "<a href=\"../privacy policy/privacy_policy.php?seller_id=$seller_id\" class=\"ad_btn\">Privacy Policy</a>";
               } 

               else if(isset($_SESSION['user_id']))
               {
                echo "<a href=\"../privacy policy/privacy_policy.php?user_id=$user_id\" class=\"ad_btn\">Privacy Policy</a>";
               } 

               else
               {

                echo "<a href=\"../privacy policy/privacy_policy.php\">Privacy Policy</a>";

                }

              ?>
            </li>


            <li>
             <?php
             if(isset($_SESSION['seller_id']))
             {
              echo "<a href=\"pet_database.php?seller_id=$seller_id\">Pet Archive</a>";
             } 

             else if(isset($_SESSION['user_id']))
             {
              echo "<a href=\"pet_database.php?user_id=$user_id\">Pet Archive</a>";
             } 

             else
             {

               echo "<a href=\"pet_database.php\">Pet Archive</a>";

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
