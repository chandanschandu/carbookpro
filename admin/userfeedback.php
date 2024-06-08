<?php
session_start();
if(!isset($_SESSION["s_name"])) {
    header("location: login.php");
    exit; // stop further execution
}

// Database connection
$db = mysqli_connect("127.0.0.1:3308", "root", "", "car_showroom");

// Check if the form is submitted for deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_feedback"])) {
    $feedback_id = $_POST["feedback_id"];
    
    // Perform deletion
    $delete_query = "DELETE FROM feedback WHERE name = ?";
      $stmt = mysqli_prepare($db, $delete_query);
       mysqli_stmt_bind_param($stmt, "s", $feedback_id);
       mysqli_stmt_execute($stmt);
         mysqli_stmt_close($stmt);
}

// Retrieve feedback data from the database
$query = "SELECT * FROM feedback";
$result = mysqli_query($db, $query);

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Admin Page - Feedback</title>
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        .delete-button {
    background-color: #ff0000; /* Red color for delete button */
    color: #ffffff; /* White text color */
    border: none; /* Remove button border */
    padding: 5px 10px; /* Add padding for button */
    border-radius: 5px; /* Add rounded corners */
    cursor: pointer; /* Change cursor to pointer on hover */
    transition: background-color 0.3s ease; /* Smooth transition for background color */
}

.delete-button:hover {
    background-color: #cc0000; /* Darker red color on hover */
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
            
           <div>
             <h3> Welcome <?=$_SESSION['s_name'];?> !! </h3>
         </div>
            
            <div class="menu-main">
            
               <ul class="dc_css3_menu">
               <li class="active"><a href="admin.php">Home</a></li>
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
                <h2>Feedback Received</h2>
            </div>

            <div class="container-fluid row">
                <div class="col-md-1"></div>

                <div class="col-md-10">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Feedback</th>
                                <th>Action</th> <!-- New column for action -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Loop through the fetched data and display it in table rows
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>".$row['name']."</td>";
                                echo "<td>".$row['email']."</td>";
                                echo "<td>".$row['text']."</td>";
                                echo "<td>
                                        <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                                            <input type='hidden' name='feedback_id' value='".$row['name']."'>
                                            <input type='submit' name='delete_feedback' value='Delete' class='delete-button'>

                                        </form>
                                      </td>"; // Form for delete action
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-1"></div>
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
