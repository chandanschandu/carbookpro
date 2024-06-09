<!DOCTYPE HTML>
<html>
<head>
<title>User Account Registration</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                     <li class="active"><a href="index.php">Home</a></li>
                     <li><a href="about.html">About</a></li>
                     <li><a href="services.php">Brands</a></li>
                     <li><a href="contact.php">Contact</a></li>
                     <li><a href="login.php">Login</a></li>
                     <li><a href="register.php">Signup</a></li>
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
          <h2>User Account Registration</h2>
        </div>
      
        <div class="container-fluid row">
          
            <div class="col-md-3"></div>
          
      
          <div class="col-md-6">
          
        <form class="text-center" action="register.php" method="post" onsubmit="return validateForm()">
                    
           <div>
               <label>Name</label>
      <input type="text" class="form-control transparent-input" size="50" placeholder="YOUR NAME " name="username" id="username" required>
             </div>
            
            <div><br/>
               <label>Email</label>
      <input type="email" class="form-control transparent-input" size="50" placeholder="YOUR EMAIL" name="useremail" id="useremail" required>
             </div>
             
             
            <div><br/>
               <label>Address</label>
      <input type="text" class="form-control transparent-input" size="50" placeholder="YOUR ADDRESS" name="useraddress" id="useraddress" required>
             </div>
             
             
            <div><br/>
               <label>Phone</label>
      <input type="tel" class="form-control transparent-input" size="50" placeholder="YOUR PHONE NUMBER" name="userphone" id="userphone" required>
             </div>
 
            <div><br/>
               <label>PASSWORD</label>
      <input type="password" class="form-control transparent-input" size="50" placeholder="PASSWORD PLEASE" name="pass" id="pass" required>
             </div>
 
            <div><br/>
                <button type="submit" name="reg" class="btn btn-warning" value="reg">Sign up</button>
             </div>
         </form>     
          </div>
          
            <div class="col-md-3"></div>
        
        </div>   
        </div>
    </div>
</div>

<script>
function validateForm() {
    var name = document.getElementById("username").value;
    var email = document.getElementById("useremail").value;
    var address = document.getElementById("useraddress").value;
    var phone = document.getElementById("userphone").value;
    var password = document.getElementById("pass").value;

    // Check if name contains digits
    var nameRegex = /\d/;
    if (nameRegex.test(name)) {
        alert("Name should not contain digits");
        return false;
    }

    // Check if email is valid
    var emailRegex = /\S+@\S+\.\S+/;
    if (!emailRegex.test(email)) {
        alert("Invalid email address");
        return false;
    }

    // Check if phone number has 10 digits
    var phoneRegex = /^\d{10}$/;
    if (!phoneRegex.test(phone)) {
        alert("Phone number must be 10 digits");
        return false;
    }

    return true;
}
</script>

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
<?php 
$db=mysqli_connect("127.0.0.1:3308","root","","car_showroom");

// REGISTER USER
if(isset($_POST['reg'])) 
{
    
    
	// receive all input values from the form
    $username = $_POST['username'];
	$useremail = $_POST['useremail'];
	$password = $_POST['pass'];
    $userphone = $_POST['userphone'];
    $useraddress = $_POST['useraddress'];
    
    if($useremail!='' || $username!=''|| $password!=''|| $userphone!=''|| $useraddress!='' )
    {
       $query = "CALL register('$username','$useremail','$password','$userphone','$useraddress')";
        
		mysqli_query($db, $query);
        
        $message = "registration done ! ";
         echo "<script type='text/javascript'>alert('$message');</script>";
        
      
    }
	
		

		
	
	
}

 ?>