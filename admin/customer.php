<?php
    // Database configuration
    $db_host = "127.0.0.1:3308";
    $db_user = "root";
    $db_pass = "";
    $db_name = "car_showroom";

    // Establish database connection
    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Delete customer using email
    if(isset($_POST['delete_customer'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $sql = "DELETE FROM customer WHERE email = '$email'";
        if(mysqli_query($conn, $sql)) {
            echo "Customer with email $email deleted successfully.";
        } else {
            echo "Error deleting customer: " . mysqli_error($conn);
        }
    }

    // Update customer information
    if(isset($_POST['update_customer'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $pass = mysqli_real_escape_string($conn, $_POST['pass']);
        
        $sql = "UPDATE customer SET name='$name', address='$address', phone='$phone', pass='$pass' WHERE email='$email'";
        if(mysqli_query($conn, $sql)) {
            echo "<script>alert('Customer information updated successfully.');</script>";
        } else {
            echo "Error updating customer information: " . mysqli_error($conn);
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Customer Management</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style>
    .customer-form {
    width: 300px;
    margin: 0 auto;
}

.customer-form label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

.customer-form input[type='text'] {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.customer-form button {
    width: 50%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.customer-form .btn-primary {
    background-color: #007bff;
    color: #fff;
    margin-right: 10px;
}

.customer-form .btn-danger {
    background-color: #dc3545;
    color: #fff;
}

/* Add animation */
@keyframes slideIn {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.customer-form {
    animation: slideIn 0.5s ease-in-out;
}

    </style>


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
               <li class="active"><a href="admin.php">Home</a></li>
                     <!-- Add other menu items as needed -->
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
                <h2>Customer Management</h2>
            </div>
            <div class="container-fluid row">
                <div class="col-md-12">
                    <h3>Customers List</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM customer";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row["name"] . "</td>";
                                    echo "<td>" . $row["email"] . "</td>";
                                    echo "<td>" . $row["address"] . "</td>";
                                    echo "<td>" . $row["phone"] . "</td>";
                                    echo "<td>" . $row["pass"] . "</td>";
                                    echo "<td>
                                    <form method='post' class='customer-form'>
                                    <input type='hidden' name='email' value='" . $row["email"] . "'>
                                    <label for='name'>Name:</label>
                                    <input type='text' name='name' value='" . $row["name"] . "'>
                                    <label for='address'>Address:</label>
                                    <input type='text' name='address' value='" . $row["address"] . "'>
                                    <label for='phone'>Phone no:</label>
                                    <input type='text' name='phone' value='" . $row["phone"] . "'>
                                    <label for='pass'>Password:</label>
                                    <input type='text' name='pass' value='" . $row["pass"] . "'>
                                    <button type='submit' name='update_customer' class='btn btn-primary'>Update</button></br>
                                    <button type='submit' name='delete_customer' class='btn btn-danger'>Delete</button>
                                </form>
                                
                                        </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>No customers found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
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
                                  <li>Please read our Terms and Conditions </li>
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
