<?php
session_start();

if(isset($_POST["login"])) {
    // Your existing login code here
}

if(isset($_POST["forgot_password"])) {
    $useremail = $_POST['useremail'];
    
    // Check if the email exists in the database
    $db = mysqli_connect("127.0.0.1:3308", "root", "", "car_showroom");
    $query = mysqli_query($db, "SELECT * FROM customer WHERE email = '".$email."'");
    $numrows = mysqli_num_rows($query);

    if($numrows == 1) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32));

        // Store the token in the database with the user's email and timestamp
        $timestamp = time();
        mysqli_query($db, "INSERT INTO password_reset (email, token, timestamp) VALUES ('$useremail', '$token', '$timestamp')");

        // Send an email to the user with a link to reset their password
        $reset_link = "http://yourwebsite.com/reset_password.php?token=".$token;
        $subject = "Password Reset";
        $message = "Click the following link to reset your password: ".$reset_link;
        // Use mail() function to send the email
        
        echo "An email has been sent to your email address with instructions to reset your password.";
    } else {
        echo "No user found with that email address.";
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>

<h2>Forgot Password</h2>
<form method="post" action="">
    <label>Email</label>
    <input type="email" name="useremail" required>
    <button type="submit" name="forgot_password">Reset Password</button>
</form>

</body>
</html>
