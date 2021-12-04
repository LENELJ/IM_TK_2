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

        $insert= "INSERT INTO `workorder` (`order_id`,`client_id`) 
                  VALUES ('$uniq','$id')";

        if (mysqli_query($conn, $insert)) {
            $order="SELECT `order_id` 
                FROM `workorder`, `tattoo` 
                WHERE `tattoo`.`tattoo_id`='$id' 
                AND `workorder`.`client_id`='client id'
                AND `workorder`.`order_date`=current date LIMIT 1";

            $query= mysqli_query($conn,$order);
            $row = mysqli_fetch_assoc($query);
            $order_id = $row['order_id'];

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
        // insert into order_item
    $unID=uniqid();
    $ins_order= "INSERT INTO `order_item`(`item_id`,`order_id`,`tattoo_id`) 
                VALUES ('$unID','$order_id','$client_id')";

    mysqli_query($conn,$ins_order);
    
}

mysqli_close($conn);
?>