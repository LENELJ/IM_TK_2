<?php
session_start();

include_once "connect.php";

if(isset($_POST['order_item'])){
    $id=$_POST['client_id'];

    if(isset($_SESSION['order_id'])){
        $order_id=$_SESSION['order_id'];
    } else {
        // insert into order
        $uniq= uniqid();
        $date=date("Y-m-d");

        $insert= "INSERT INTO `workorder` (`order_id`,`client_id`,`order_date`) 
                  VALUES ('$uniq','$id','$date')";
        $order="SELECT `order_id` 
                FROM `workorder`, `tattoo` 
                WHERE `tattoo`.`tattoo_id`='$id' 
                AND `workorder`.`client_id`='client id'
                AND `workorder`.`order_date`=current date LIMIT 1";
        $query= mysqli_query($conn,$order);
        $row = mysqli_fetch_assoc($query);
        $order_id = $row['order_id'];
    }
    // insert into order_item
    
}


?>