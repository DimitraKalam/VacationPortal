<?php
 session_start();
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form</title>
    <link rel="stylesheet" type="text/css" href="../css/request_signup_style.css">
</head>
<body>
    <div class="go_back">
            <form action="main_admin.php">
                <input id="go_back" type="submit" href="main_admin.php" name='go_back' class="go_back" value="Go Back"> 
            </form>
        <br>
    </div>
    <div class='contact-title'>
        <h1>Fill in the submission form</h1>
    </div>
    <div>
        <form method="POST" action="../includes/request_inc.php">
        <input name="start_date" type="date" class="form-control" placeholder="Date from" required>
        <br>
        <input name="end_date" type="date" class="form-control" placeholder="Date to" required>
        <br>
        <textarea name="reason" class="form-control" placeholder="Reason" rows = "3" cols = "50" name = "reason" required>
         </textarea>
         <br>
        <input type="submit" name="submit_btn" class="form-control submit" value="Submit"> 
    </div>
</body>
</html>