<!DOCTYPE HTML>
<html>
<head>
<title>Delete Car and Display Available Cars</title>
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
                     <li class="active"><a href="admincars.php">Home</a></li>
                   
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
                <h2>Delete the Available Cars</h2>
            </div>
            <div class="container-fluid row">
                <div class="col-md-6">
                    <h3>Delete Car</h3>
                    <form class="text-center" action="" method="get">
                        <label>Select Car Model Number to Delete:</label><br>
                        <select name="model">
                            <?php
                            $db = mysqli_connect("127.0.0.1:3308", "root", "", "car_showroom");
                            $getcars = mysqli_query($db, "SELECT * FROM model");
                            while ($row = mysqli_fetch_assoc($getcars)) {
                                $dbmodelno = $row['model'];
                                $dbmodelname = $row['name'];
                                echo "<option value='$dbmodelno'>$dbmodelno</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" name="delete" class="btn btn-danger">Delete Car</button>
                    </form>
                    <?php
                    if (isset($_GET['delete'])) {
                        // Database connection
                        $db = mysqli_connect("127.0.0.1:3308", "root", "", "car_showroom");

                        // Sanitize input
                        $model = mysqli_real_escape_string($db, $_GET['model']);

                        // SQL query to delete the car based on the model
                        $query = "DELETE FROM car WHERE model = '$model'";

                        // Execute query
                        if (mysqli_query($db, $query)) {
                            echo "<p>Car with model number $model deleted successfully.</p>";
                        } else {
                            echo "<p>Error deleting car: " . mysqli_error($db) . "</p>";
                        }

                        // Close database connection
                        mysqli_close($db);
                    }
                    ?>
                </div>
                <div class="col-md-6">
                    <h3>Available Cars</h3>
                    <table class="table table-bordered table-responsive table-striped table-hover table-condensed text-center">
                        <tr>
                            <th class="text-center">Car Model No</th>
                            <th class="text-center">Car Name</th>
                            <th class="text-center">No. Available</th>
                        </tr>
                        <?php
                                 $db = mysqli_connect("127.0.0.1:3308","root","","car_showroom");
            
                                    //to get his orders     
                                    $getcars= mysqli_query($db, "SELECT * from model");
                                    $numrows3 =mysqli_num_rows($getcars);
                                    if($numrows3 !=0)
                                    {
                                        while($row3=mysqli_fetch_assoc($getcars))
                                        {
                                                        $dbmodelno=$row3['model'];
                                                         $dbmodelname=$row3['name'];
														 
                                                        
                                                    // get his car model name
                                                $getcarnumbers = mysqli_query($db, "SELECT * from car where model = '".$dbmodelno."'");
                                                $numrows2 =mysqli_num_rows($getcarnumbers);

                                                            echo "<tr>" ;
                                                            echo "<td>$dbmodelno</td>";
                                                           echo "<td>$dbmodelname</td>";
                                                           echo "<td> $numrows2</td>";  
                                                            echo" </tr>";
                                        }
                                    }
                                      
                            ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div class="wrap">
        <div class="footer-top">                
                
        </div>
