<!DOCTYPE html>
<html>
<head>
    <title>Form</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>
    <div class='contact-title'>
        <h1>Insert image</h1>
        <h2>Fill in the submission form</h2>
    </div>
    <div class="contact-form">
        <form id='contact-form' method="POST" action="../includes/request_inc.php">
        <input name="start_date" type="date" class="form-control" placeholder="Date from" required>
        <br>
        <input name="end_date" type="date" class="form-control" placeholder="Date to" required>
        <br>
        <textarea name="reason" class="form-control" placeholder="Reason" rows = "5" cols = "50" name = "reason" required>
         </textarea>
         <br>
        <!-- <input name="reason" type="text" class="form-control" placeholder="Reason" required>
        <br> -->
            <input type="submit" name="submit_btn" class="form-control submit" value="Submit"> 
    </div>
</body>
</html>