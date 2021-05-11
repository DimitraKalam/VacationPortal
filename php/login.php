<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>
<body>
    <div class='contact-title'>
        <h1>Insert image</h1>
        <h2>Please sign in with your credentials</h2>
    </div>
    <div class="contact-form">
        <form id='contact-form' method="POST" action="../includes/login_inc.php">
        <input name="email" type="email" class="form-control" placeholder="Email" required>
        <br>
        <input name="password" type="password" class="form-control" placeholder="Password" required>
        <br>
            <input type="submit" name="login_btn" class="form-control submit" value="Login"> 
    </div>
</body>
</html>