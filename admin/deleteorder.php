<?php
session_start();
if (!isset($_SESSION["admin_name"])) {
    header("location: adminlogin.php");
}
?>

<!DOCTYPE HTML>
<html>
<head>
<title>Delete Orders</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<div class="header">    
    <div class="wrap"> 
        <div class="header-bot">
             <div class="logo">
                 <a href="index.html"><img src="images/logo.png" alt="" style="width:450px; height: 160px;"></a>
             </div>
             
             <div class="cart">    
            
                <div class="menu-main">    
                   <ul class="dc_css3_menu">
                         <li class="active"><a href="adminorders.php">Home</a></li>
                       
                    </ul>
                    
                 <div class="clear"></div>
                </div>    
                            
            </div>    
            
            
            <div class="clear"></div> 
           </div>
          </div>    
    </div>
    <div class="header-bottom">
        <div class="wrap">
            <div class="page-not-found">
                <div class="text-center">
                    <h2>Order Summary</h2>
                </div>
              
                <div class="container-fluid row">
                  
                    <div class="col-md-3"></div>
                  
                    <div class="s">
                        <table class="table table-bordered table-responsive table-striped table-hover table-condensed text-center">
                            <tr>
                                <th>Order Number</th>
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Car Model</th>
                                <th>Date of Order</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $db = mysqli_connect("127.0.0.1:3308", "root", "", "car_showroom");
                            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
                                $order_id = $_POST['sale_id'];
                                $delete_query = mysqli_query($db, "DELETE FROM sale2 WHERE sale_id = '$order_id'");
                                if ($delete_query) {
                                    echo "<script>alert('Order deleted successfully');</script>";
                                    header("refresh:0.1; url=adminorders.php");
                                } else {
                                    echo "<script>alert('Failed to delete order');</script>";
                                }
                            }
                            $getorders = mysqli_query($db, "SELECT * FROM sale2");
                            if (mysqli_num_rows($getorders) > 0) {
                                while ($row = mysqli_fetch_assoc($getorders)) {
                                    $dbsaleid = $row['sale_id'];
                                    $dbcustomerid = $row['customer_id'];
                                    $carnumber = $row['carmodel'];
                                    $date = $row['ordertime'];
                                    
                                    $getusercarname = mysqli_query($db, "SELECT name FROM model WHERE model = '$carnumber'");
                                    $row2 = mysqli_fetch_assoc($getusercarname);
                                    $dbusercarname = $row2['name'];
                                    
                                    $getusername = mysqli_query($db, "SELECT name FROM customer WHERE c_id = '$dbcustomerid'");
                                    $row3 = mysqli_fetch_assoc($getusername);
                                    $dbusername = $row3['name'];
                            ?>
                            <tr>
                                <td><?php echo $dbsaleid; ?></td>
                                <td><?php echo $dbcustomerid; ?></td>
                                <td><?php echo $dbusername; ?></td>
                                <td><?php echo $dbusercarname; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                    <form method="post" action="">
                                        <input type="hidden" name="sale_id" value="<?php echo $dbsaleid; ?>">
                                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='6'>No orders found</td></tr>";
                            }
                            ?>
                        </table>
                    </div>
                    
                    <div class="col-md-3"></div>
                
                </div>   
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="wrap">
           <div class="footer-top">             
                <div class="col_1_of_5 span_1_of_5">
                    <div class="footer-grid twitts">
                    <h3>Our Company</h3>
                        <div class="f_menu">
                             <ul>
                                  <li>This is a CAR selling dealer</li>
                                  <li>Please read our Terms and Conditions</li>
                             </ul>
                        </div>
                   </div>
                </div>
                
                <div class="col_1_of_5 span_1_of_5">
                    <div class="footer-grid twitts">
                        <h3>Get in touch</h3>
                        <ul class="follow_icon">
                            <li><a href="#" style="opacity: 1;"><img src="images/follow_icon.png" alt=""></a></li>
                            <li><a href="#" style="opacity: 1;"><img src="images/follow_icon1.png" alt=""></a></li>
                            <li><a href="#" style="opacity: 1;"><img src="images/follow_icon2.png" alt=""></a></li>
                            <li><a href="#" style="opacity: 1;"><img src="images/follow_icon3.png" alt=""></a></li>
                            <li><a href="#" style="opacity: 1;"><img src="images/follow_icon4.png" alt=""></a></li>
                            <li><a href="#" style="opacity: 1;"><img src="images/follow_icon5.png" alt=""></a></li>
                        </ul>
                        <p>+1 111-111-1111</p>
                        <span>support@autoexpress.com</span>
                    </div>
                </div>
                <div class="clear"></div>
        </div>
    </div>
</div>      
</body>
</html>
