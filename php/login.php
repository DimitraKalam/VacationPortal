<?php
session_start();

include("connection.php");
include("functions.php");


if($_SERVER['REQUEST_METHOD']=="POST")
{
    //SOMETHING WAS POSTED
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {
        //read from database
        $query = "select * from users where user_name = '$user_name' limit 1";
        
        $result = mysqli_query($con,$query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                 $user_data = mysqli_fetch_assoc($result);
                 
                 if($user_data['password'] == $password)
                 {
                     $_SESSION['user_id'] = $user_data['user_id'];
                     header("Location: index.php");
                    die;
                }
            }
        }

    echo "Please enter the correct name or password!";

    }else{
        echo "Please enter some valid information!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css"
</head>
<body>
    <div class='contact-title'>
        <h1>Insert image</h1>
        <h2>Please sign in with your credentials</h2>
    </div>
    <div class="contact-form">
        <form id='contact-form' method="POST" action="">
        <input name="name" type="text" class="form-control" placeholder="Your Name" required>
        <br>
        <input name="email" type="email" class="form-control" placeholder="Your Email" required>
        <br>
            <input type="submit" class="form-control submit" value="Login"> 
    </div>
</body>
</html>