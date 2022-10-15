<?php session_start(); ?>
<?php require_once("inc/connection.php"); ?>

<?php 
   if(isset($_GET['add_id']))
    {
      $add_id = mysqli_real_escape_string($connect,$_GET['add_id']);
    }
    
?>

<?php

$merchant_id         = $_POST['merchant_id'];
$order_id             = $_POST['order_id'];
$payhere_amount     = $_POST['payhere_amount'];
$payhere_currency    = $_POST['payhere_currency'];
$status_code         = $_POST['status_code'];
$md5sig                = $_POST['md5sig'];

$merchant_secret = '8hixKhMarKf4pG55nNOlk58X3pnJGl2194EwxFf0k61m'; // Replace with your Merchant Secret (Can be found on your PayHere account's Settings page)

$local_md5sig = strtoupper (md5 ( $merchant_id . $order_id . $payhere_amount . $payhere_currency . $status_code . strtoupper(md5($merchant_secret)) ) );

if (($local_md5sig === $md5sig) AND ($status_code == 2) ){
        //TODO: Update your database as payment success

        $query = "UPDATE advertisement SET IsPaymentDone = \"true\" WHERE AddId = {$add_id} LIMIT 1";

        $result_set = mysqli_query($connect,$query);
}

?>