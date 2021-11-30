<?php
    session_start();

    include_once "connect.php";
    $_SESSION['client_id'] = 1; 
    
    function check_login($conn){
        
        if(isset($_SESSION['client_id'])){
            $id = $_SESSION['client_id'];
            $query = "SELECT * FROM `client` WHERE `client_id` = '$id' LIMIT 1";

            $result = mysqli_query($conn, $query);

            if($result && mysqli_num_rows($result) > 0 ){
                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
        }
    }
    
    function get_order(){
        $id = $_SESSION['client_id'];
        $query = "SELECT `order_id` FROM `workorder` WHERE `client_id`='$id' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if($result && mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['order_id'] = $row['order_id'];
        } else {
            echo "No order found!";
        }
    }

    $user = check_login($conn);
    get_order();
    // print_r ($user);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Page</title>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="explore.css">

</head>
<body>
    <nav id="nav">
        <div class="navbar">
            <img src="img/logo.png" alt="Logo">
            <a href="#" class="active">Explore</a>
            <a href="#" >Bookings</a>
        </div >
        <div class="navbar2">
            <img src="img/profile-user 1.png" alt="Profile">
            <img src="img/image 1.png" alt="Image">
        </div>
    </nav>
    <main>
        <div class="content">
            <h3>Explore Tattoos</h3>
        
            <div class="search">
                <div class="search1">
                    <input type="text" name="" id="" placeholder="Search">
                    <span>|</span> 
                    <select name="" id="" >
                    <option selected>Most Relevant</option>
                    </select>
                </div>
                <div class="search2">
                    <span> Filter </span>
                    <img src="img/settings.png" alt="Filter">
                </div>
            </div>
            <div class="contd">
                <?php
                    $display = "SELECT * FROM `tattoo`";
                    $displayimg = mysqli_query($conn,$display); 
                                    
                    if(mysqli_num_rows($displayimg)> 0){
                        while($img_row = mysqli_fetch_assoc( $displayimg)){
                            $img=$img_row['tattoo_image'] ;
                            $name=$img_row['tattoo_name'];
                            $price=$img_row['tattoo_price'];
                            $desc=$img_row['tattoo_description'];
                            $color=$img_row['color_scheme'];
                            $id=$img_row['tattoo_id'];
                            
                ?>
                    <div class="pics">
                        
                        <a class="f_pics" href="#<?php echo $name?>" class="btn ">
                            <img src="img/<?=$img?>" alt="<?php echo "Image"." ".$name?>" class="card">
                        </a> 
                       
                        
                        <div id="<?php echo $name?>" class="tattoo_detail">
                            <div class="cont">
                                <a href="" class="close" >x</a>
                                <img src="img/<?=$img?>">    
                                <div>
                                    <h2><?php echo $name?></h2>
                                    <br>
                                    <h3><?php echo "₱".$price ?></h3>
                                    <p><?php echo $desc?></p>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt architecto nemo totam dolorem illo cumque minima, omnis unde dolor. </p>
                                    
                                    <form action="order.php" method="post" class="form1">
                                        <input type="hidden" name="client_id" value="<?php echo $id ?>">
                                        <p> Color: </br> <?php echo  $color ?></p>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Select size</option>
                                            <option value="1">Extra small</option>
                                            <option value="2">Small</option>
                                            <option value="3">Medium</option>
                                            <option value="4">Large</option>
                                            <option value="5">Large Plus</option>
                                        </select>
                                        <br>
                                        <button type="submit" name="order_item">Add Order List</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>    
                     
                <?php
                        }
                    }
                    
                ?>
            </div>
        </div>
    </main>

    <!-- <script text='text/javascript'>
        $(document).ready(function(){
            $('.user').click(function(){
                var user = $(this).data('tattoo_id');
                alert(user)
            });
        });
    </script> -->
    <script src="explore.js"></script>
</body>
</html>