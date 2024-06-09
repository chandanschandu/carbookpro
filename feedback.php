<?php 
session_start();
if(!isset($_SESSION["s_name"]))
{
    header("location: login.php");
}

// Database connection
$db = mysqli_connect("127.0.0.1:3308", "root", "", "car_showroom");

// Check if the form is submitted
if(isset($_POST['submit_feedback'])) {
    // Receive input values from the form
    $name = $_SESSION['s_name']; // Assuming you want to store the name of the user submitting the feedback
    $email = $_POST['email'];
    $feedback_text = $_POST['feedback'];

    // Insert feedback into the database
    $query = "INSERT INTO feedback (name, email, text) VALUES ('$name', '$email', '$feedback_text')";
    mysqli_query($db, $query);

    // Display success message
    $message = "Thank you for your feedback!";
    echo "<script type='text/javascript'>alert('$message');</script>";
}

?>

<!DOCTYPE HTML>
<html>
<head>
<title>Feedback Form</title>
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
            
           <div>
             <h3> Welcome <?=$_SESSION['s_name'];?> !! </h3>
         </div>
            
            <div class="menu-main">
            
               <ul class="dc_css3_menu">
                     <li class="active"><a href="indexlogin.php">Home</a></li>
                    
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
          <h2>Leave us your feedback !
          </h2>
        </div>
      
        <div class="container-fluid row">
          
            <div class="col-md-3"></div>
          
      
          <div class="col-md-6">
           
            <form class="text-center" action="" method="post" >
                    
                <div>
                    <label>Email:</label><br>
                    <input type="email" name="email" required>
                </div>
</br>

                <div>
                    <label>Feedback:</label><br>
                    <textarea name="feedback" rows="4" cols="50" required></textarea>
                </div>

                
                <div><br>
                    <button type="submit" name="submit_feedback" class="btn btn-primary">Submit Feedback</button>
                </div>
            </form>     
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
